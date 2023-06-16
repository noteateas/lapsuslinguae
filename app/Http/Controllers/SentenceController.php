<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditSentenceRequest;
use App\Http\Requests\InsertSentenceRequest;
use App\Models\Sentence;
use App\Models\SentenceTranslation;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SentenceController extends BaseController
{
    private $sentences;
    private $tasks;

    public function __construct(){
        $this->sentences = Sentence::all();
        $this->tasks = Task::all();
    }

    public function index(Request $request, Sentence $sentences, Task $tasks)
    {
        $sentences = $sentences->newQuery();

        if($request->has('search-word')){
            $text = $request->get('search-word');
            $sentences->where('text','like','%'.$text.'%');
        }
        if($request->has('tasks')) {
            $task_id = $request->get('tasks');
            if($task_id !== '0'){
                $sentences->where('task_id',$task_id);
            }
        }

        $sentences = $sentences->paginate(10)->withQueryString();

        $this->data['sentences'] = $sentences;
        $this->data['tasks'] = $tasks->get();

        return view('admin.pages.sentences.index', $this->data);
    }

    public function create(Task $tasks)
    {
        $this->data['tasks'] = $tasks->get();
        return view('admin.pages.sentences.create', $this->data);
    }

    public function store(InsertSentenceRequest $request)
    {
        try {
            $text = $request->get('text');
            $task_id = $request->get('task_id');
            $eng_translation = $request->get('eng_translation');
            $srb_translation = $request->get('srb_translation');

            $sentence = new Sentence;
            $sentence->text = $text;
            $sentence->task_id = $task_id;

            $sentence->save();

            $translation = new SentenceTranslation();
            $translation->sentence_id = $sentence->id;
            $translation->language_id = 1; //english
            $translation->text = $eng_translation;
            $translation->save();

            $translation = new SentenceTranslation();
            $translation->sentence_id = $sentence->id;
            $translation->language_id = 2; //serbian
            $translation->text = $srb_translation;
            $translation->save();

            return redirect()->route('sentences.index')->with('success', "Successfully added.");
        }
        catch(\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with('fail', 'Error inserting the sentence');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id, Task $tasks)
    {
        try{
            $sentence = Sentence::find($id);
            $translations = $sentence->translations;

            foreach ($translations as $translation){
                if($translation->language_id == 1){
                    //eng

                    $eng_translation = $translation;
                }
                else if($translation->language_id == 2){
                    //srb
                    $srb_translation = $translation;
                }
            }

            $this->data['sentence'] = $sentence;
            $this->data['tasks'] = $tasks->get();
            $this->data['eng_translation'] = $eng_translation;
            $this->data['srb_translation'] = $srb_translation;

            if($sentence){
                return view('admin.pages.sentences.edit', $this->data);
            }
            else{
                return back();
            }
        }
        catch(\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with('fail', $ex);
        }
    }

    public function update(EditSentenceRequest $request, $id)
    {
        try {
            $text = $request->get('text');
            $task_id = $request->get('task_id');
            $eng_translation = $request->get('eng_translation');
            $srb_translation = $request->get('srb_translation');

            $sentence= Sentence::find($id);
            $all_sentences = Sentence::all();

            foreach ($all_sentences as $sen){
                if($sen->id != $id && $sen->text == $text){
                    $this->data['sentence'] = $sentence;
                    $this->data['tasks'] = Task::all();
                    $this->data['fail'] = 'Sentence already exists';

                    return view('admin.pages.sentences.edit', $this->data);
                }
            }
            $sentence->text = $text;
            $sentence->task_id = $task_id;
            $sentence->save();

            $translation = SentenceTranslation::where('sentence_id',$sentence->id)
                ->where('language_id',1)->first(); //english
            $translation->text = $eng_translation;
            $translation->save();

            $translation = SentenceTranslation::where('sentence_id',$sentence->id)
                ->where('language_id',2)->first(); //serbian
            $translation->text = $srb_translation;
            $translation->save();

            return redirect()->route('sentences.index')->with("success", "Successfully edited.");
        }
        catch(\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with('fail', $ex);
        }
    }

    public function destroy($id)
    {
        try{
            $translations = SentenceTranslation::where('sentence_id',$id)->get();
            foreach ($translations as $translation){
                SentenceTranslation::destroy($translation->id);
            }
            Sentence::destroy($id);
            return redirect()->back()->with("success", "Successfully deleted.");
        }
        catch(\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with('fail', $ex);
        }
    }
}
