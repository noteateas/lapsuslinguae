<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditWordRequest;
use App\Http\Requests\InsertWordRequest;
use App\Models\Word;
use App\Models\WordCategory;
use App\Models\WordTranslation;
use App\Models\WordType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class WordController extends BaseController
{
    private $words;
    private $word_categories;

    public function __construct(){
        $this->words = Word::all();
        $this->word_categories = WordCategory::all();
    }

    public function index(Request $request, Word $words, WordCategory $word_categories, WordType $word_types)
    {
        $words = $words->newQuery();

        if($request->has('search-word')){
            $text = $request->get('search-word');
            $words->where('text','like','%'.$text.'%');
        }
        if($request->has('word_categories')) {
            $word_cat_id = $request->get('word_categories');
            if($word_cat_id !== '0'){
                $words->where('word_category_id',$word_cat_id);
            }
        }
        if($request->has('word_types')) {
            $word_type_id = $request->get('word_types');
            if($word_type_id !== '0'){
                $words->where('word_type_id',$word_type_id);
            }
        }

        $words = $words->paginate(10)->withQueryString();

        $this->data['words'] = $words;
        $this->data['word_categories'] = $word_categories->get();
        $this->data['word_types'] = $word_types->get();

        return view('admin.pages.words.index', $this->data);
    }

    public function create(WordCategory $word_categories, WordType $word_types)
    {
        $this->data['word_categories'] = $word_categories->get();
        $this->data['word_types'] = $word_types->get();

        return view('admin.pages.words.create', $this->data);
    }

    public function store(InsertWordRequest $request)
    {
        try {
            $text = $request->get('text');
            $word_category_id = $request->get('word_category_id');
            $word_type_id = $request->get('word_type_id');
            $eng_translation = $request->get('eng_translation');
            $srb_translation = $request->get('srb_translation');
            $audio_file = $request->file('audio_file');

            $word = new Word();
            $word->text = $text;
            $word->word_category_id = $word_category_id;
            $word->word_type_id = $word_type_id;

            $destinationPath = 'assets/audio/words'; //goes directly to the public folder where assets are
            $myaudio = $audio_file->getClientOriginalName();
            $audio_file->move(public_path($destinationPath), $myaudio);

            $word->audio_file = $myaudio;

            $word->save();

            $translation = new WordTranslation();
            $translation->word_id = $word->id;
            $translation->language_id = 1; //english
            $translation->text = $eng_translation;
            $translation->save();

            $translation = new WordTranslation();
            $translation->word_id = $word->id;
            $translation->language_id = 2; //serbian
            $translation->text = $srb_translation;
            $translation->save();

            return redirect()->route('words.index')->with('success', 'Successfully added.');
        }
        catch(\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with('fail', 'Error inserting the sentence.');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id, WordCategory $word_categories, WordType $word_types)
    {
        try{
            $word = Word::find($id);
            $translations = $word->translations;
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

            if($word){
                $this->data['word'] = $word;
                $this->data['word_categories'] = $word_categories->get();
                $this->data['word_types'] = $word_types->get();
                $this->data['eng_translation'] = $eng_translation;
                $this->data['srb_translation'] = $srb_translation;

                return view('admin.pages.words.edit', $this->data);
            }
            else{
                return back();
            }
        }
        catch(\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with('fail', "Error connecting to database");
        }
    }

    public function update(EditWordRequest $request, $id)
    {
        try {
            $text = $request->get('text');
            $word_category_id = $request->get('word_category_id');
            $word_type_id = $request->get('word_type_id');
            $eng_translation = $request->get('eng_translation');
            $srb_translation = $request->get('srb_translation');
            $audio_file = $request->file('audio_file');

            $word = Word::find($id);
            $all_words = Word::all();

            foreach ($all_words as $w){
                if($w->id != $id && $w->text == $text){
                    $this->data['word'] = $word;
                    $this->data['word_categories'] = WordCategory::all();
                    $this->data['word_types'] = WordType::all();
                    $this->data['fail'] = 'Word already exists';

                    return view('admin.pages.words.edit', $this->data);
                }
            }

            $word->text = $text;
            $word->word_category_id = $word_category_id;
            $word->word_type_id = $word_type_id;

            if($audio_file != null){
                $destinationPath = 'audio/words'; //goes directly to the public folder where assets are
                $myaudio = $audio_file->getClientOriginalName();
                $audio_file->move(public_path($destinationPath), $myaudio);

                $word->audio_file = $myaudio;
            }

            $word->save();

            $translation = WordTranslation::where('word_id',$word->id)
                ->where('language_id',1)->first(); //english
            $translation->text = $eng_translation;
            $translation->save();

            $translation = WordTranslation::where('word_id',$word->id)
                ->where('language_id',2)->first(); //serbian
            $translation->text = $srb_translation;
            $translation->save();

            return redirect()->route('words.index')->with("success", "Successfully edited.");
        }
        catch(\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with('fail', $ex);
        }
    }

    public function destroy($id)
    {
        try{
            //dd($id);
            $translations = WordTranslation::where('word_id',$id)->get();
            foreach ($translations as $translation){
                WordTranslation::destroy($translation->id);
            }
            Word::destroy($id);
            return redirect()->back()->with("success", "Successfully deleted.");
        }
        catch(\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->with('fail', $ex . "Error deleting the entry");
        }
    }
}
