<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Models\WordCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Psy\Util\Json;

class RecapController extends BaseController
{
    private $words;

    public function __construct(){
        $this->words = Word::all();
    }

    public function index(Request $request, Word $words){

        $words = $words->newQuery();
        $word_categories = WordCategory::all();

        if($request->has('search_word')){
            $text = $request->get('search_word');
            $words->where('text','like','%'.$text.'%');

        }
        if($request->has('word_categories')) {
            $word_cat_id = $request->get('word_categories');
            if($word_cat_id !== '0'){
                $words->where('word_category_id',$word_cat_id);
            }
        }

        $words = $words->paginate(10)->withQueryString();
        //dd($words);
        $data['words'] = $words;
        $data['word_categories'] = $word_categories;
        return view("client.pages.recap", $data);
    }

    public function search(Request $request){
        $search_text = $request->search_word;
        $category_id = $request->word_category_id;

        try{
            if(empty($search_text)){
                if($category_id === '0'){
                    $words = Word::all();
                }
                else{
                    $words = Word::where('word_category_id', $category_id)->get();
                }
            }
            else{
                if($category_id == '0'){
                    $words = Word::where('text','like', '%'.$search_text.'%')->get();
                }
                else{
                    $words = Word::where('text','like', '%'.$search_text.'%')->where('word_category_id', $category_id)->get();
                }
            }

            foreach ($words as $word) {
                foreach ($word->translations as $translation){
                    if($translation->language_id == 1){
                        $word->translation = $translation->text;
                    }
                }
            }

            $result = array('success' => 'success', 'words' => $words);
            return response()->json($result);

        }
        catch (\Exception $ex) {
            $result = array('success' => 'fail', 'text' => $ex->getMessage());
            return Json::encode($result);
        }
    }
}



