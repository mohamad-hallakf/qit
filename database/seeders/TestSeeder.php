<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Test;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = array(
            [
                'content' => 'laravel framework based on ..?',
                'right' => 'php',
                'wrong1' => 'java',
                'wrong2' =>  'c++',
                'wrong3' =>  'Ruby'
            ],
            [
                'content' => 'Vue js framework based on ..?',
                'right' => 'java script',
                'wrong1' => 'java',
                'wrong2' =>  'c++',
                'wrong3' =>  'c#'
            ],
            [
                'content' => 'Node js framework based on ..?',
                'right' => 'java script',
                'wrong1' => 'python',
                'wrong2' =>  'php',
                'wrong3' =>  'c#'
            ],
            [
                'content' => 'django framework based on ..?',
                'right' => 'python',
                'wrong1' => 'java',
                'wrong2' =>  'php',
                'wrong3' =>  'c'
            ],
        );
        DB::table('questions')->insert($questions);
        $test=new Test();
        $test->name= 'Programming Languages';
        $test->save();
        $test->questions()->attach([1,2,3,4]);
    }
}
