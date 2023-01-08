<?php

namespace App\Http\Controllers;


use App\Models\answers;
use App\Models\question;
use App\Models\quiz;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class QuizController extends Controller
{




    function indexpage(){

        if (Auth::user()) {
            $userId = Auth::user()->id;

            if ( $userId==1){
                $array=[];
                $data = DB::table('users')
                    ->join('quiz', 'users.id', '=', 'quiz.user_id')
                    ->select('users.id', 'quiz.name', 'quiz.quizlogo', 'users.email', 'quiz.id as quiz_id','quiz.is_published')
                    ->orderBy('created_at', 'desc')
                    ->get()
                    ->toArray();
                for ($i=0;$i<count($data);$i+=1) {
                    $total = DB::table("question")->where("quiz_id",  $data[$i]->quiz_id)->count();
                    //ADMIN IS BOSS SO HE IS OWNER TO DELETE WHATEVER HE/SHE WANTS


                    $obj = new QuizObject(  $data[$i]->is_published, $userId,  $data[$i]->name,true,$data[$i]->quiz_id, $data[$i]->quizlogo,  $data[$i]->email, $total);

                    $array[] =     $obj;
                }


                return response()->json( [ "mod"=>$array]);
            }


            else{
                $array=[];
                $data = DB::table('users')
                    ->join('quiz', 'users.id', '=', 'quiz.user_id')
                    ->select('users.id', 'quiz.name', 'quiz.quizlogo', 'users.email', 'quiz.id as quiz_id')
                    ->whereRaw('is_published = 1')
                    ->orderBy('created_at', 'desc')
                    ->get()
                    ->toArray();
                for ($i=0;$i<count($data);$i+=1) {
                    $total = DB::table("question")->where("quiz_id",  $data[$i]->quiz_id)->count();
                    $isowner=false;
                    if($data[$i]->id==$userId){


                        $obj = new QuizObject( true,  $userId,$data[$i]->name ,true,$data[$i]->quiz_id, $data[$i]->quizlogo,  $data[$i]->email, $total);
                        $array[] =     $obj;
                    }else{
                        $obj = new QuizObject( true,  $userId,$data[$i]->name ,false,$data[$i]->quiz_id, $data[$i]->quizlogo,  $data[$i]->email, $total);
                        $array[] =     $obj;

                    }


                }


                return response()->json( [ "mod"=>$array]);
            }



        }

         else{

             $array=[];
             $data = DB::table('users')
                 ->join('quiz', 'users.id', '=', 'quiz.user_id')
                 ->select('users.id', 'quiz.name', 'quiz.quizlogo', 'users.email', 'quiz.id as quiz_id','quiz.is_published')
                 ->orderBy('created_at', 'desc')
                 ->whereRaw('is_published = 1')
                 ->get()
                 ->toArray();
             for ($i=0;$i<count($data);$i+=1) {
                 $total = DB::table("question")->where("quiz_id",  $data[$i]->quiz_id)->count();



                 $obj = new QuizObject(  $data[$i]->is_published, 0,  $data[$i]->name,false,$data[$i]->quiz_id, $data[$i]->quizlogo,  $data[$i]->email, $total);

                 $array[] =     $obj;
             }


             return response()->json( [ "mod"=>$array]);


         }
    }






    function  CreatenewQuiz(Request $request){



            if ( $request->quizlogo &&  $request-> quizname &&  $request->questionarray ){







             $quiz=new quiz ;
        $quiz->name=$request-> quizname;
        $quiz->user_id =   Auth::user()->id;
        $quiz->quizlogo=$request->quizlogo;
            if ( $quiz->user_id==1){
                $quiz->is_published=true;

            }else{
                $quiz->is_published=false;
            }

        if($quiz->save()){

           $quiz_id=$quiz->id;

           for ($i=0;$i<count($request-> questionarray);$i+=1){

                $question=new  question;
               $question->quiz_id= $quiz_id;
               $question->Question=$request->questionarray[$i]['Question'];
                $question->question_image=$request->questionarray[$i]['QuestionImageLink'];
               if($question->save()){
                   $Correctanswer=new answers;
                     $Correctanswer->question_id=$question->id;
                   $Correctanswer->answertitle=$request->questionarray[$i]['firstcorrectanswer'];
                   $Correctanswer->iscorrect=true;

                   $Correctanswer->save();


                   $secondanswer=new answers;
                   $secondanswer->question_id=$question->id;
                   $secondanswer->answertitle=$request->questionarray[$i]['secondanswer'];
                   $secondanswer->iscorrect=false;
                   $secondanswer->save();


                   $thirdanswer=new answers;
                   $thirdanswer->question_id=$question->id;
                   $thirdanswer ->answertitle=$request->questionarray[$i]['thirdanswer'];
                   $thirdanswer ->iscorrect=false;
                    $thirdanswer->save();




                   $fourthanswer=new answers;
                   $fourthanswer->question_id=$question->id;
                   $fourthanswer->answertitle=$request->questionarray[$i]['fourthanswer'];
                   $fourthanswer->iscorrect=false;
                   $fourthanswer->save();

               }



           }



        }
                $userId = Auth::user()->id;
       return response()->json([
            'message' => 'success ',
           'user_id'=>$userId

        ]);

            }



        return response()->json([
            'error' => 'შეავსეთ ყველა ველი ',
        ]);

    }











    function UpdateQuiz(Request $request,$id)
    {


    //shevcvlae am metodit radgan ELOQUENT modelis metodebs ar aimportebs da errorebia
        $result = DB::table('quiz')
            ->where('id', $id)
            ->update([
                'name' => $request->quizname,
                'quizlogo' => $request->quizlogo
            ]);



        if ( $result) {


            DB::table('question')->where('quiz_id',    $id)->delete();
            for ($i = 0; $i < count($request->questionarray); $i += 1) {

                $question = new  question;
                $question->quiz_id =  $id;
                $question->Question = $request->questionarray[$i]['questionname'];
                $question->question_image = $request->questionarray[$i]['questionimage'];

                if ($question->save()) {


                    $Correctanswer = new answers;
                    $Correctanswer->question_id = $question->id;
                    $Correctanswer->answertitle = $request->questionarray[$i]['Answers'][0]['answertitle'];
                    $Correctanswer->iscorrect = true;
                    $Correctanswer->save();



                    $secondanswer = new answers;
                    $secondanswer->question_id = $question->id;
                    $secondanswer->answertitle = $request->questionarray[$i]['Answers'][1]['answertitle'];
                    $secondanswer->iscorrect = false;
                    $secondanswer->save();


                    $thirdanswer = new answers;
                    $thirdanswer->question_id = $question->id;
                    $thirdanswer->answertitle = $request->questionarray[$i]['Answers'][2]['answertitle'];
                    $thirdanswer->iscorrect = false;
                    $thirdanswer->save();


                    $fourthanswer = new answers;
                    $fourthanswer->question_id = $question->id;
                    $fourthanswer->answertitle = $request->questionarray[$i]['Answers'][3]['answertitle'];
                    $fourthanswer->iscorrect = false;
                    $fourthanswer->save();

                }


            }


        }



        return response()->json(["success"]);
    }



    function getdataForUpdatePage($id){

        $quiz=DB::table("quiz")->where("id",$id)->first();

        $questions=DB::table('question')->where('quiz_id',$id)->get();


        $data=[];

        for ($i=0;$i<count($questions);$i+=1){


             $modal=new \App\Http\Controllers\Question($questions[$i]->question_image,$questions[$i]->Question,DB::table('answer')->where('question_id',  $questions[$i]->id)->get()->toArray());

            $data[] = $modal;
        }




        return response()->json(["quiz"=>$quiz,"array"=>$data]);



    }



    function  assignquiz(Request $request,$id)
    {

        $count=DB::table('question')->where('quiz_id',   $id)->count();


        $question = DB::table('question')->where('quiz_id', $id)->first();

        $answer = DB::table('answer')->where('question_id',   $question->id)
            ->orderBy(DB::raw('RAND()'))
                ->get();


            return response()->json(["answer"=> $answer,"question"=>  $question,"quantity"=>  $count ]);

    }


    function answerchecker($id){

        $answer = DB::table('answer')->where('id',  $id)->first();

        if(  $answer->iscorrect){

            return response()->json(["iscorrect"=>true]);


        }

        return response()->json(["iscorrect"=>false]);

    }








    function   getnextanswer(Request $request,$id,$position){


        $count=DB::table('question')->where('quiz_id',   $id)->count();




        if(  $position<$count){

            $question = DB::table('question')->where('quiz_id', $id)
                ->skip($position)->take(1)->first();


            $answer = DB::table('answer')->where('question_id',   $question->id)
                ->orderBy(DB::raw('RAND()'))
                ->get();


            return response()->json(["answer"=> $answer,"question"=>  $question ,"quantity"=>  $count]);
        }


        return response()->json(["nodata"=>true]);








    }


    function MakeQuizPublished($id){


        if (Auth::user()) {
            $userId = Auth::user()->id;

            if ( $userId ==1){

                $quiz=quiz::find($id);
                $quiz->is_published=true;
                $quiz->save();
            }
        }


    }

    function MakeQuizUNPublished($id){

        if (Auth::user()) {
            $userId = Auth::user()->id;

            if ( $userId ==1){
        $quiz=quiz::find($id);
        $quiz->is_published=false;
        $quiz->save();}}
    }





    function deleteQuiz($id){

        DB::table('quiz')->where('id',  $id)->delete();

        return response()->json("Success");



    }





}
