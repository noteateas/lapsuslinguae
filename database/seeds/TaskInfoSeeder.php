<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task_info')->insert(array([
            'task_id' => '1',
            'intro' => 'Welcome to the Italian course! Remember that you can click on the words to see tips of possible translations.',
            'text' => "Personal pronouns

The subject pronouns in Italian are:

Io - I
Tu - Singular You (informal)
Lui - He
Lei - She / Singular You (formal)
Esso/Essa - It (archaic and literary)
Noi - We
Voi - Plural You / You all
Loro - They (speaking of people)

Articles

Articles have to match gender and number of the noun they refer to.

The singular determinate articles (the) are:

Lo - masculine, used before Z, S+consonant, GN, and some rarer consonant clusters.
Il - masculine, used before consonants except the above.
La - feminine, used before all consonants.
L' - an elision of the above used before vowels.
The indeterminate articles (a/an) are:

Uno - masculine, used before Z, S+consonant, GN, and some rarer consonant clusters.
Un - masculine, used in all other cases.
Una - feminine, used before all consonants.
Un' - feminine, used before vowels.
",
            'outro' => ''
        ]
        ));
    }
}
