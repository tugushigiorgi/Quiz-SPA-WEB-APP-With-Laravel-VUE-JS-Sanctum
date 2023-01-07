<?php

namespace App\Http\Controllers;


//This class made to just response from controller to update View
class Question
{
    public   String  $questionname;
    public String $questionimage;
    public array $Answers=[];

    public function __construct($questionimage, $questionname,$Answers)
    {
        $this->questionimage=$questionimage;
        $this->questionname=$questionname;
        $this->Answers=$Answers;


    }


}
