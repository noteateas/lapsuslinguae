<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WhyLearnALanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $reasons = array('Travel','Education','Brain Training','Family & Friends','Job Opportunities');
    private $id_names = array('travel','education','brain-training','family-and-friends','job-opportunities');

    public function run()
    {
        /*for($i = 0; $i < count($this->reasons); $i++){
            DB::table('why_learn_a_language')->insert([
                'title' => $this->reasons[$i],
                'id_name' => $this->id_names[$i]
            ]);
        }*/
    }
}
