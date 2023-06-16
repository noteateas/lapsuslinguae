<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WordTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $types = ['nouns','verbs','adjectives','pronouns','adverbs','prepositions','determiners','conjunctions'];

    public function run()
    {
        for($i = 0; $i<count($this->types); $i++){
            DB::table('word_types')->insert([
                'name' => $this->types[$i]
            ]);
        }
    }

}
