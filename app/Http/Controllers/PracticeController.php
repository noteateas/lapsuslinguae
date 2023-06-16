<?php

namespace App\Http\Controllers;

use App\Models\MainLevel;
use App\Models\Sentence;
use App\Models\Task;
use App\Models\TaskInfo;
use App\Models\User;
use App\Models\UserProgress;
use App\Models\UserTask;
use App\Models\Word;
use App\Models\WordCategory;
use Illuminate\Http\Request;
use Nette\Utils\Paginator;
use Psy\Util\Json;

class PracticeController extends BaseController
{
    public function index(Request $request){
        $user_id = $request->session()->get('user')->id;
        $user = User::where('id', $user_id)->first();
        $userTasks = $user->userTasks;
        $tasks = Task::all();

        $date_today = date('Y-m-d');
        $userProgress = UserProgress::where('user_id', $user_id)->where('date', $date_today)->first();

        if($userProgress == null){
            $currentUserProgress = 0;
        }
        else{
            $currentUserProgress = $userProgress->quantity_done;
        }

        $total = 0;
        foreach ($userTasks as $userTask){
            $total += $userTask->levels_finished;
        }
        foreach($tasks as $task){
            $task->finished = false;
            $task->levels_finished = 0;

            /** Task Translation **/
            foreach ($task->translations as $translation){
                if($translation->language->id == 2){
                    $task->srb_translation = $translation->text;
                }
            }
        }
        if($userTasks){
            foreach($userTasks as $userTask){
                foreach($tasks as $task){
                    if($userTask->task_id == $task->id && $userTask->finished == true){
                        $task->finished = true;
                    }
                    if($userTask->task_id == $task->id){
                        $task->levels_finished = $userTask->levels_finished;
                    }

                }
            }
        }

        /** put in main levels finished*/
        $user_id = $request->session()->get('user')->id;
        $finishedUsersTasks = UserTask::where('user_id',$user_id)->where('finished',1)->get();
        $beginner_level_finished = false;
        $intermediate_level_finished = false;

        if($finishedUsersTasks != null){
            $main_levels = MainLevel::all();
            $beginner_level_id = $main_levels->where('title','beginner')->first()->id;
            $intermediate_level_id = $main_levels->where('title','intermediate')->first()->id;

            $total_beginner_tasks = count(Task::where('main_level_id',$beginner_level_id)->get());
            $total_intermediate_tasks = count(Task::where('main_level_id',$intermediate_level_id)->get());

            if($finishedUsersTasks){
                $beginnerTasks = 0;
                $intermediateTasks = 0;
                foreach($finishedUsersTasks as $userTask){
                    if($userTask->task->main_level_id == $beginner_level_id){
                        $beginnerTasks++;
                    }
                    if($userTask->task->main_level_id == $intermediate_level_id){
                        $intermediateTasks++;
                    }

                }
                if($beginnerTasks == $total_beginner_tasks){
                    $beginner_level_finished = true;
                }
                else if($intermediateTasks == $total_intermediate_tasks){
                    $intermediate_level_finished = true;
                }
            }
        }

        $this->data['beginner_level_finished'] = $beginner_level_finished;
        $this->data['intermediate_level_finished'] = $intermediate_level_finished;
        $this->data['tasks'] = $tasks;
        $this->data['levelsFinished'] = $total;
        $this->data['currentUserProgress'] = $currentUserProgress;

        return view ('client.pages.practice.index', $this->data);
    }

    public function exitTask(Request $request){
        if($request->session()->has('sentences')){
            $request->session()->remove('sentences');
        }
        if($request->session()->has('current_challenge')){
            $request->session()->remove('current_challenge');
        }
        if($request->session()->has('challenges_quantity')){
            $request->session()->remove('challenges_quantity');
        }
        if($request->session()->has('progress')){
            $request->session()->remove('progress');
        }

        return redirect()->route('practice');
    }

    public function taskInfoIndex($task_id){
        $task = Task::where('id',$task_id)->first();
        $task_info = TaskInfo::where('task_id',$task_id)->first();

        $translations = $task_info->translations;

        foreach ($translations as $translation){
            if($translation->language_id == 1){
                //eng
                $task_info->eng_translation = $translation;
            }
            else if($translation->language_id == 2){
                //srb
                $task_info->srb_translation = $translation;
            }
        }

        /** Task Translation **/
        foreach ($task->translations as $translation){
            if($translation->language->id == 2){
                $task->srb_translation = $translation->text;
            }
        }

        $this->data['task'] = $task;
        $this->data['task_info'] = $task_info;
        return view ('client.pages.practice.task-info', $this->data);
    }

    public function streak($request,$user_id,$date_today){
        $user = User::where('id',$user_id)->first();
        $all_user_progress = UserProgress::where('user_id',$user_id);
        $progress_today = $all_user_progress->where('date',$date_today)->first();
        if($progress_today->quantity_done == 1){
            //new user_progress row was just inserted; challenge was just finished
            $user->streak = $user->streak + 1;
            $user->save();
            $request->session()->get('user')->streak = $user->streak;
        }
    }
    public function insertUserProgress($user_id,$date_today){
        $userProgress = UserProgress::where('user_id',$user_id)->where('date',$date_today)->first();
        if($userProgress != null){
            $userProgress->quantity_done = $userProgress->quantity_done + 1;
        }
        else{
            $userProgress = new UserProgress;
            $userProgress->user_id = $user_id;
            $userProgress->quantity_done = 1;
            $userProgress->date = $date_today;
        }
        $userProgress->save();
    }
    public function insertUserTask($request,$user_id,$task_id){
        $userTask = UserTask::where('user_id', $user_id)->where('task_id',$task_id)->first();
        $task = Task::where('id',$task_id)->first();
        $level_quantity = $task->level_quantity;

        if($userTask != null){
            if($userTask->levels_finished < $level_quantity){
                $userTask->levels_finished = $userTask->levels_finished + 1;
                if($userTask->levels_finished === $level_quantity){
                    $userTask->finished = '1';
                }
            }
        }
        else{
            $userTask = new UserTask;
            $userTask->user_id = $request->session()->get('user')->id;
            $userTask->task_id = $task_id;
            $userTask->finished = 0;
            $userTask->levels_finished = 1;
        }
        $userTask->save();
    }

    //redirecting functions
    public function task(Request $request, $task_id){
        $user_id = $request->session()->get('user')->id;
        $user_language_id = $request->session()->get('user')->language_id;
        $userTask = UserTask::where('user_id',$user_id)->where('task_id',$task_id)->first();
        $difficulty_id = 1;
        $task_title = Task::where('id',$task_id)->first()->title;
        if($task_title == 'basics 2' || $task_title == 'questions 2' || $task_title == 'food 2'){
            $difficulty_id = 2;
        }
        if($task_title == 'basics 2'){

        }
        if($task_title == 'questions 2'){

        }
        if($task_title == 'food 2'){

        }

        if($userTask){
            if($userTask->finished){
                return $this->task_matching_pairs($request, $difficulty_id,$task_title, $user_language_id);
            }
            else{
                if($userTask->levels_finished == 1){
                    return $this->task_write_in($request, $task_id, $difficulty_id);
                }
                if($userTask->levels_finished == 2){
                    return $this->task_missing_word($request, $task_id, $difficulty_id, $user_language_id);
                }
                if($userTask->levels_finished == 3 || $userTask->levels_finished == 4){
                    return $this->task_matching_pairs($request, $difficulty_id,$task_title, $user_language_id);
                }
            }
        }
        else{
            return $this->task_matching_pairs($request, $difficulty_id,$task_title,$user_language_id);
        }
    }
    public function checkAnswer(Request $request, $task_id){
        $type = $request->session()->get('type');
        $user_language_id = $request->session()->get('user')->language_id;

        if($type == 'select_the_matching_pairs'){
            return $this->checkAnswer_matching_pairs($request, $task_id, $user_language_id);
        }
        else if($type == 'write_this_in_english'){
            return $this->checkAnswer_write_in($request, $task_id, $user_language_id);
        }
        else if($type == 'select_the_missing_word'){
            return $this->checkAnswer_mising_word($request, $task_id);
        }
    }

    //write this in english/serbian
    public function task_write_in(Request $request, $task_id, $difficulty_id){
        $current_challenge = 1;
        $challenges_quantity = 3;
        $words = Word::inRandomOrder()->take(rand(1,3))->get();
        foreach ($words as $word){
            $word->translations;
        }
        $sentences = Sentence::where('task_id',$task_id)->where('difficulty_id',$difficulty_id)->take(5)->get();

        $request->session()->put('type','write_this_in_english');
        $request->session()->put('current_challenge', $current_challenge);
        $request->session()->put('challenges_quantity',$challenges_quantity);
        $request->session()->put('sentences', $sentences);
        $request->session()->put('progress', 0);

        $this->data['sentence'] = $sentences[$current_challenge - 1];
        $this->data['current_challenge'] = $current_challenge;
        $this->data['challenges_quantity'] = $challenges_quantity;
        $this->data['type'] = 'write_this_in_english';
        $this->data['words'] = $words;

        return view ('client.pages.practice.task', $this->data);
    }
    public function checkAnswer_write_in(Request $request, $task_id, $user_language_id){
        $sentences = $request->session()->get('sentences');
        $user_answer = $request->user_answer;
        $sentence_id = $request->sentence_id;
        $stylized_user_answer = strtolower(trim($user_answer));

        //get sentence translation in serbian or english
        $sentence = Sentence::where('id',$sentence_id)->first();
        $translations = $sentence->translations;
        foreach ($translations as $translation){
            if($translation->language->id == $user_language_id){
                $lang_translation = $translation->text;
                $stylized_translation = strtolower(trim($translation->text));
                break;
            }
        }

        //if answer is correct
        if($stylized_user_answer == $stylized_translation){
            $current_challenge = $request->session()->get('current_challenge');
            $challenges_quantity = $request->session()->get('challenges_quantity');
            $this->data['challenges_quantity'] = $challenges_quantity;

            //finished the level
            if($current_challenge == $challenges_quantity){
                $user_id = $request->session()->get('user')->id;
                $date_today = date('Y-m-d');

                //insert in userProgress table-daily progress;quantity and date of what's been done
                $this->insertUserProgress($user_id,$date_today);

                //streak
                $this->streak($request,$user_id,$date_today);

                //add info about finished level of a task,and if all levels in the task are finished
                $this->insertUserTask($request,$user_id,$task_id);

                $this->data['task_id'] = $task_id;

                $returnHTML = view('client.components.practice.finishedchallenge',$this->data)->render();// or method that you prefere to return data + RENDER is the key here
                return response()->json( array('finished' => true, 'html'=>$returnHTML) );
            }
            else{
                $current_challenge = $current_challenge + 1;
                $request->session()->put('current_challenge', $current_challenge);
                $nextSentence = $sentences[$current_challenge - 1];

                $this->data['sentence'] = $nextSentence;
                $this->data['words'] = Word::inRandomOrder()->take(rand(1,3))->get();
                $this->data['current_challenge'] = $current_challenge;

                $returnHTML = view('client.components.practice.write-this-in-english',$this->data)->render();// or method that you prefer to return data + RENDER is the key here
                return response()->json( array('success' => true, 'html'=>$returnHTML) );
            }
        }
        else{
            $result = array('correct' => false, 'translation' => $lang_translation);
            return Json::encode($result);
        }
    }

    //select the missing word
    public function task_missing_word(Request $request, $task_id,$difficulty_id, $user_language_id){
        $current_challenge = 1;
        $challenges_quantity = 3;
        $this->data['words'] = Word::inRandomOrder()->take(3)->get();
        $sentences = Sentence::where('task_id',$task_id)
            ->where('text','like','% %')
            ->where('difficulty_id',$difficulty_id)
            ->take($challenges_quantity)
            ->offset(3)
            ->get();

        $current_sentence = $sentences[$current_challenge-1]->text;
        $words_from_the_current_sentence = explode(" ",$current_sentence);
        $random_id = array_rand($words_from_the_current_sentence);
        $answer = $words_from_the_current_sentence[$random_id];

        $words_from_the_current_sentence[$random_id] = "_______";
        $sentence= implode(" ", $words_from_the_current_sentence);

        $request->session()->put('type','select_the_missing_word');
        $request->session()->put('current_challenge', $current_challenge);
        $request->session()->put('challenges_quantity',$challenges_quantity);
        $request->session()->put('sentences', $sentences);
        $request->session()->put('progress', 0);
        //za select the missing word
        $request->session()->put('answer', $answer);

        $this->data['challenges_quantity'] = $challenges_quantity;
        $this->data['current_challenge'] = $current_challenge;
        $this->data['sentence'] = $sentence;
        $this->data['type'] = 'select_the_missing_word';
        //za select the missing word
        $this->data['answer'] = $answer;

        return view ('client.pages.practice.task', $this->data);
    }
    public function checkAnswer_mising_word(Request $request, $task_id){
        $current_challenge = $request->session()->get('current_challenge');
        $challenges_quantity = $request->session()->get('challenges_quantity');
        $sentences = $request->session()->get('sentences');
        $answer = $request->session()->get('answer');
        $stylized_answer = strtolower((trim($answer)));

        $user_answer = $request->user_answer;
        $stylized_user_answer = strtolower(trim($user_answer));

        //checking if answer is correct
        if($stylized_user_answer == $stylized_answer){
            //finished the level
            if($current_challenge == $challenges_quantity){
                $user_id = $request->session()->get('user')->id;
                $date_today = date('Y-m-d');

                //insert in userProgress table-daily progress;quantity and date of what's been done
                $this->insertUserProgress($user_id,$date_today);

                //streak
                $this->streak($request,$user_id,$date_today);

                //add info about finished level of a task,and if all levels in the task are finished
                $this->insertUserTask($request,$user_id,$task_id);

                $this->data['task_id'] = $task_id;
                //for select the missing word
                $request->session()->forget('answer');

                $returnHTML = view('client.components.practice.finishedchallenge',$this->data)->render();// or method that you prefere to return data + RENDER is the key here
                return response()->json( array('finished' => true, 'html'=>$returnHTML) );
            }
            else{
                $current_challenge = $current_challenge + 1;
                $request->session()->put('current_challenge', $current_challenge);
                $nextSentence = $sentences[$current_challenge - 1]->text;

                $words_from_the_next_sentence = explode(" ",$nextSentence);
                $random_id = array_rand($words_from_the_next_sentence);
                $answer = $words_from_the_next_sentence[$random_id];
                $words_from_the_next_sentence[$random_id] = "_______";
                $sentence= implode(" ", $words_from_the_next_sentence);

                $request->session()->put('answer', $answer);

                $this->data['sentence'] = $sentence;
                $this->data['words'] = Word::inRandomOrder()->take(3)->get();
                $this->data['answer'] = $answer;
                $this->data['current_challenge'] = $current_challenge;
                $this->data['challenges_quantity'] = $challenges_quantity;

                $returnHTML = view('client.components.practice.select-the-missing-word',$this->data)->render();// or method that you prefer to return data + RENDER is the key here
                return response()->json( array('success' => true, 'html' => $returnHTML) );
            }

        }
        else{
            $result = array('correct' => false, 'translation' => $answer);
            return Json::encode($result);
        }
    }

    //select the matching pairs
    public function task_matching_pairs(Request $request,$difficulty_id,$task_title, $user_language_id){
        $current_challenge = 1;
        $challenges_quantity = 3;

        if($task_title == 'basics 2'){
            $task_title = 'basics';
        }
        else if($task_title == 'questions 2'){
            $task_title = 'questions';
        }
        else if($task_title == 'food 2'){
            $task_title = 'food';
        }
        $word_cat_id = WordCategory::where('name',$task_title)->first()->id;

        $words = Word::where('word_category_id',$word_cat_id)
            ->where('difficulty_id',$difficulty_id)
            ->inRandomOrder()
            ->take(4 * $challenges_quantity)
            ->get();

        foreach ($words as $word){
            $translations = $word->translations;
            foreach ($translations as $translation){
                if($translation->language->id == $user_language_id){
                    $english_translation = $translation->text;
                    $stylized_translation = strtolower(trim($english_translation));

                    $word->translation_id = $translation->id;
                    $word->translation_text = $stylized_translation;
                    break;
                }
            }
        }

        $request->session()->put('words', $words);
        $slice_degree = 4;
        $first_four_words = $words->slice(0, $slice_degree);
        $words_left = $words->slice($slice_degree);

        $this->data['words'] = $first_four_words;
        $this->data['type'] = 'select_the_matching_pairs';
        $this->data['challenges_quantity'] = $challenges_quantity;
        $this->data['current_challenge'] = $current_challenge;

        $request->session()->put('type','select_the_matching_pairs');
        $request->session()->put('words', $words);
        $request->session()->put('words_left', $words_left);
        $request->session()->put('current_challenge', $current_challenge);
        $request->session()->put('challenges_quantity', $challenges_quantity);
        $request->session()->put('slice_degree', $slice_degree);
        $request->session()->put('progress', 0);

        return view ('client.pages.practice.task', $this->data);
    }
    public function checkAnswer_matching_pairs(Request $request, $task_id,$user_language_id){
        $answer = $request->answer;
        $all_words = $request->session()->get('words');
        $slice_degree = $request->session()->get('slice_degree');
        $words = $request->session()->get('words_left');

        $correct = true;
        $answer_it_word_ids = array();
        foreach($answer as $el){
            array_push($answer_it_word_ids, $el['it_word_id']);
            foreach ($all_words as $word){
                if($el['it_word_id'] == $word->id){
                    if($el['translation_id'] != $word->translation_id){
                        $correct = false;
                    }
                }
            }
        }
        try{
            if($correct){
                $current_challenge = $request->session()->get('current_challenge');
                $challenges_quantity = $request->session()->get('challenges_quantity');

                //finished the level
                if($current_challenge == $challenges_quantity){
                    $this->data['task_id'] = $task_id;
                    $user_id = $request->session()->get('user')->id;
                    $date_today = date('Y-m-d');

                    //insert in userProgress table-daily progress;quantity and date of what's been done
                    $this->insertUserProgress($user_id,$date_today);

                    //streak
                    $this->streak($request,$user_id,$date_today);

                    //add info about finished level of a task,and if all levels in the task are finished
                    $this->insertUserTask($request,$user_id,$task_id);

                    $this->data['task_id'] = $task_id;
                    //for select the missing word
                    $request->session()->forget('answer');

                    $returnHTML = view('client.components.practice.finishedchallenge',$this->data)->render();// or method that you prefere to return data + RENDER is the key here
                    return response()->json( array('finished' => true, 'html'=>$returnHTML) );
                }
                else{
                    $current_challenge = $current_challenge + 1;
                    $request->session()->put('current_challenge', $current_challenge);
                    $this->data['current_challenge'] = $current_challenge;
                    $this->data['challenges_quantity'] = $challenges_quantity;

                    $first_four_words = $words->slice(0, $slice_degree);
                    $this->data['words'] = $first_four_words;

                    $words_left = $words->slice($slice_degree);
                    $request->session()->put('words_left',$words_left);

                    $returnHTML = view('client.components.practice.select-the-matching-pairs',$this->data)->render();// or method that you prefer to return data + RENDER is the key here
                    return response()->json(array('success' => true, 'html' => $returnHTML));
                }
            }
            else{
                $words = Word::whereIn('id',$answer_it_word_ids)->get();
                foreach ($words as $word){
                    $translations = $word->translations;
                    foreach ($translations as $translation){
                        if($translation->language->id == $user_language_id){
                            $english_translation = $translation->text;
                            $stylized_translation = strtolower(trim($english_translation));

                            $word->translation_id = $translation->id;
                            $word->translation_text = $stylized_translation;
                            break;
                        }
                    }
                }

                $result = array('success' => false, 'words' => $words);
                return Json::encode($result);
            }
        }
        catch (\Exception $ex) {
            $result = array('failure' => true, 'text' => $ex->getMessage());
            return Json::encode($result);
        }
    }
}
