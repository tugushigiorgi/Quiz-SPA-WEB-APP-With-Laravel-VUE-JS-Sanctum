<?php

namespace App\Http\Controllers;

class QuizObject
{


    public $id ;
    public $user_id;

    public  String $quizpicture;
    public String $author;
    public String $title;
    public int $total_questions;
    public bool $is_owner;
    public bool $is_published;
    /**
     * @param $id
     * @param String $quizpicture
     * @param String $author
     * @param String $total_questions
     */
    public function __construct($is_published, $user_id,$title,$is_owner,$id, string $quizpicture, string $author, int $total_questions)
    {
        $this->is_published=$is_published;
        $this->user_id=$user_id;
         $this->title= $title;
        $this->is_owner=$is_owner;
        $this->id = $id;
        $this->quizpicture = $quizpicture;
        $this->author = $author;
        $this->total_questions = $total_questions;
    }


}
