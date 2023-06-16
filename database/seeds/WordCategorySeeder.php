<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WordCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $categories = ['basics','object','food','number','color','question','day of the week','time of day',
        'place','body','clothing','family','job','household','politics','religion','medicine','school','history'];

    public function run()
    {
        for($i = 0; $i<count($this->categories); $i++){
            DB::table('word_categories')->insert([
                'name' => $this->categories[$i]
            ]);
        }
    }
}
