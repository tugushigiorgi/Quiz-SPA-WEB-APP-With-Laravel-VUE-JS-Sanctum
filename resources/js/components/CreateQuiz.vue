<template>

    <heading>
    <div class="mainwrapper">

        <div class="Heading">Create New Quiz </div>


        <div class="Heading">{{formerror}} </div>



        <div class="wrapper">

            <div class="inputWrapper">

                <div class="inputConteiner">
                    <div class="inputHeading">Enter quiz name </div>
                    <input v-model="Quizname"  class="inputfield" type="text"  >
                </div>

                <div class="inputConteiner">
                    <div class="inputHeading">Enter Quiz Logo  Picture Link </div>
                    <input  v-model="Quizlogolink"  class="inputfield" type="text"  >
                </div>

                <button class="Addquestionbtn" @click="ModalVisibility=true">+ Add question  </button>





                <div class="Questinwrapper">

                    <ul class="questionlist">

                        <li class="question_li"  v-for="item in QuestionArray" :key="item" >



                            <div class="aqtualanswersection">{{ item.Question }} </div>
                            <button class="listbtn updatebtn" @click="PrepareModelToUpdateNewlyAddedQuestion(item)">Update</button>
                            <button @click="DeleteAddedQuestion(item)" class="listbtn deletebtn">Delete</button>


                        </li>
                        <!-- <li class="question_li" >



<div>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt at voluptatum officiis vitae quam nam soluta,  </div>
<button class="listbtn deletebtn">Delete</button>
<button class="listbtn updatebtn">Update</button>

</li> -->


                    </ul>

                </div>
            </div>
        </div>



        <!-- Modal to add new question -->
        <div   v-if=" ModalVisibility" id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <button @click="ModalVisibility=false" class="close">&times;</button>
                <div class="ModalHeading">Add new Question</div>

                <div class="inputConteiner">
                    <div class="inputHeading formodal  ">Enter Image Link </div>
                    <input  class="inputfield formodalinput fc" type="text"  >
                </div>
                <div class="inputConteiner">
                    <div class="inputHeading formodal fc ">Enter Question </div>
                    <input  v-model=" Question" class="inputfield formodalinput fc " type="text"  >
                </div>


                <ul class="questionlistul">

                    <li>
                        <div class="inputConteiner">
                            <div class="inputHeading formodal">Enter Answer 1 (Correct) </div>
                            <input v-model="firstcorrectanswer"  class="inputfield fc "   type="text"  >
                        </div>
                    </li>
                    <li>
                        <div class="inputConteiner">
                            <div class="inputHeading formodal">Enter Answer 2 </div>
                            <input  v-model="secondanswer" class="inputfield fc " type="text"  >
                        </div>
                    </li>
                    <li>
                        <div class="inputConteiner">
                            <div class="inputHeading formodal">Enter Answer 3 </div>
                            <input  v-model="thirdanswer" class="inputfield fc " type="text"  >
                        </div>
                    </li>
                    <li>
                        <div class="inputConteiner">
                            <div class="inputHeading formodal">Enter Answer 4 </div>
                            <input  v-model="fourthanswer" class="inputfield fc " type="text"  >
                        </div>
                    </li>

                </ul>

                <div style="display:grid;place-items:center">
                    <button class="savbtnmodal" @click="SavenewQuestion()">Save</button>
                </div>



            </div>

        </div>

        <!-- Modal to update new question -->
        <div   v-if=" ModalVisibility" id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <button @click="ModalVisibility=false" class="close">&times;</button>
                <div class="ModalHeading">Add new Question</div>

                <div class="inputConteiner">
                    <div class="inputHeading formodal  ">Enter Image Link </div>
                    <input  v-model="QuestionImageLink" class="inputfield formodalinput fc" type="text"  >
                </div>
                <div class="inputConteiner">
                    <div class="inputHeading formodal fc ">Enter Question </div>
                    <input  v-model=" Question" class="inputfield formodalinput fc " type="text"  >
                </div>


                <ul class="questionlistul">

                    <li>
                        <div class="inputConteiner">
                            <div class="inputHeading formodal">Enter Answer 1 (Correct) </div>
                            <input v-model="this.firstcorrectanswer"  class="inputfield fc "   type="text"  >
                        </div>
                    </li>
                    <li>
                        <div class="inputConteiner">
                            <div class="inputHeading formodal">Enter Answer 2 </div>
                            <input  v-model="secondanswer" class="inputfield fc " type="text"  >
                        </div>
                    </li>
                    <li>
                        <div class="inputConteiner">
                            <div class="inputHeading formodal">Enter Answer 3 </div>
                            <input  v-model="thirdanswer" class="inputfield fc " type="text"  >
                        </div>
                    </li>
                    <li>
                        <div class="inputConteiner">
                            <div class="inputHeading formodal">Enter Answer 4 </div>
                            <input  v-model="fourthanswer" class="inputfield fc " type="text"  >
                        </div>
                    </li>

                </ul>

                <div style="display:grid;place-items:center">
                    <button class="savbtnmodal" @click="SavenewQuestion()">Save</button>
                </div>



            </div>

        </div>
        <div   v-if=" UpdateModalvisibility" id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <button @click=" UpdateModalvisibility=false" class="close">&times;</button>
                <div class="ModalHeading">Update  Question</div>

                <div class="inputConteiner">
                    <div class="inputHeading formodal  ">Enter Image Link </div>
                    <input  v-model="toupdateQuestionImageLink" class="inputfield formodalinput fc" type="text"  >
                </div>
                <div class="inputConteiner">
                    <div class="inputHeading formodal fc ">Enter Question </div>
                    <input  v-model="toupdateQuestion" class="inputfield formodalinput fc " type="text"  >
                </div>


                <ul class="questionlistul">

                    <li>
                        <div class="inputConteiner">
                            <div class="inputHeading formodal">Enter Answer 1 (Correct) </div>
                            <input v-model="toupdatefirstcorrectanswer"  class="inputfield fc "   type="text"  >
                        </div>
                    </li>
                    <li>
                        <div class="inputConteiner">
                            <div class="inputHeading formodal">Enter Answer 2 </div>
                            <input  v-model="toupdatesecondanswer" class="inputfield fc " type="text"  >
                        </div>
                    </li>
                    <li>
                        <div class="inputConteiner">
                            <div class="inputHeading formodal">Enter Answer 3 </div>
                            <input  v-model="toupdatethirdanswer" class="inputfield fc " type="text"  >
                        </div>
                    </li>
                    <li>
                        <div class="inputConteiner">
                            <div class="inputHeading formodal">Enter Answer 4 </div>
                            <input  v-model="toupdatefourthanswer" class="inputfield fc " type="text"  >
                        </div>
                    </li>

                </ul>

                <div style="display:grid;place-items:center">
                    <button class="savbtnmodal" @click="updateNewQuestion()">Update</button>
                </div>



            </div>

        </div>




        <div style="display:grid;place-items:center">
            <button class="QuizSavebtn" @click="SaveQuiz()">Save </button>
        </div>

    </div>
    </heading>
</template>

<script>

import heading from './heading'
import axios from 'axios';
export default{
    components:{
        heading
    },
    data(){
        return{
            ModalVisibility:false,
            UpdateModalvisibility:false,
            Quizname:"",
            Quizlogolink:"",
            QuestionArray:[],
            QuestionImageLink:"",
            Question:"",
            firstcorrectanswer:"",
            secondanswer:"",
            thirdanswer:"",
            fourthanswer:"",

            formerror:"",
            toupdateQuestionImageLink:"",
            toupdateQuestion:"",
            toupdatefirstcorrectanswer:"",
            toupdatesecondanswer:"",
            toupdatethirdanswer:"",
            toupdatefourthanswer:"",
            objtoupdate:""



        }

    },
    methods:{


        DeleteAddedQuestion(obj){

            this.QuestionArray.splice(   this.QuestionArray.indexOf(obj), 1);


        },

        PrepareModelToUpdateNewlyAddedQuestion(obj){
            this.objtoupdate=obj
            this.toupdateQuestionImageLink =obj.QuestionImageLink
            this.toupdateQuestion =obj. Question
            this.toupdatefirstcorrectanswer =obj. firstcorrectanswer
            this. toupdatesecondanswer =obj.secondanswer
            this.toupdatethirdanswer =obj.thirdanswer
            this. toupdatefourthanswer =obj.fourthanswer
            this.  UpdateModalvisibility=true



        },
        updateNewQuestion(){
            let data={ "QuestionImageLink":  this.toupdateQuestionImageLink,
                "Question":    this.toupdateQuestion,
                " firstcorrectanswer":this.toupdatefirstcorrectanswer,
                "secondanswer":this.toupdatesecondanswer,
                "thirdanswer":this.toupdatethirdanswer,
                " fourthanswer":this.toupdatefourthanswer


            }

            this.QuestionArray[this.QuestionArray.indexOf(this. objtoupdate)]=data
            this.  UpdateModalvisibility=false

            this.objtoupdate=""
            this.toupdateQuestionImageLink = ""
            this.toupdateQuestion = ""
            this.toupdatefirstcorrectanswer = ""
            this. toupdatesecondanswer = ""
            this.toupdatethirdanswer = ""
            this. toupdatefourthanswer = ""





        },







        SavenewQuestion(){


            let data={ "QuestionImageLink":this.QuestionImageLink,
                "Question":this.Question,
                "firstcorrectanswer":this.firstcorrectanswer,
                "secondanswer":this.secondanswer,
                "thirdanswer":this.thirdanswer,
                "fourthanswer":this.fourthanswer


            }
            this.QuestionArray.push(data)

            this.ModalVisibility=false
            this.QuestionImageLink=""
            this.Question=""
            this.firstcorrectanswer=""
            this.secondanswer=""
            this.thirdanswer=""
            this.fourthanswer=""


        },



        SaveQuiz(){




            axios.post('/createquiz', {


                quizname:  this.Quizname,
                quizlogo:this.Quizlogolink,
                questionarray:  this.QuestionArray,

            }, {


            }).then(response => {
                console.log(response)


                if (response.data['error']){
                    this.formerror="PLEASE FILL ALL THE FORM !!!!"

                }else{
                    if ( response.data.user_id ==1){
                        window.location = "/"

                    }else{

                        window.location = "/submition"
                    }



                }







            }).catch(function(error) {
                console.log(error);

            });







        }

    }


}


</script>

<style scoped>
.QuizSavebtn{
    font-size: 30px;
    width: 200px;
    cursor: pointer;
    padding: 10px;
    font-weight: bold;
    border-radius: 10px;
    border-color: transparent;
    margin-top: 120px;
    transition: 400ms;}

.QuizSavebtn:hover{
    color: white;
    border-color: white;
    background-color: rgba(24, 23, 37, 1); ;

}
.aqtualanswersection{
    min-width: 540px;
}
.savbtnmodal{
    font-size: 25px;
    width: 150px;
    height: 50px;
    border-radius: 10px;
    background-color: rgba(24, 23, 37, 1);
    color: white;
    margin-top: 20px;
    cursor: pointer;
    transition: 500ms;

}
.savbtnmodal:hover{
    background-color: rgb(255, 255, 255);

    color: rgb(0, 0, 0);
    border-color: black;
}



.ModalHeading{

    font-weight: bold;
    font-size: 30px;
    text-align: center;

}
.questionlistul{

    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 15px;
}

.questionlistul li{
    list-style: none;

}


.listbtn{
    font-size: 15px;
    padding: 10px;
    margin: 5px;
    border-radius: 10px;
    border-color: transparent;
    cursor: pointer;
    color: white;
    transition: 500ms;
}
.updatebtn{
    background-color: rgb(132, 67, 236);


}
.updatebtn:hover{

    background-color: rgb(98, 5, 246);
}

.deletebtn:hover{

    background-color: rgb(255, 0, 0);
}

.deletebtn{
    background-color: rgb(223, 66, 66);
}


.question_li{
    cursor: pointer;
    list-style: none;
    background-color: white;
    color: black;
    border-radius: 10px;
    padding: 10px;
    width: 700px;
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}
.Addquestionbtn{
    font-size: 25px;
    padding: 10px;
    border-radius: 10px;
    border-color: transparent;
    cursor: pointer;
    margin-bottom: 20px;
    transition: 500ms;
}
.Addquestionbtn:hover{

    background-color:  rgba(24, 23, 37, 1);
    border-color: white;
    color: white;
}


.inputConteiner{

    margin-bottom: 30px;
}
.inputfield{
    width: 700px;
    height: 50px;
    border-color: white;
    border-width: 1px;
    color: white;
    font-size: 30px;
    padding: 5px;
    border-radius: 10px;
    background-color:  rgba(24, 23, 37, 1);

}
.inputHeading{
    color: white;
    font-size: 26px;
    margin-bottom: 10px;

}



.wrapper{

    display: grid;
    place-items: center;

}
.Heading{
    color: white;
    font-size: 50px;
    font-weight: bold;
    text-align: center;
    margin-bottom: 90px;

}
.mainwrapper{
    background-color: rgba(24, 23, 37, 1);
    padding: 20px;
    height: 100vh;
}
body{
    background-color: rgba(24, 23, 37, 1);
}
.modal {

    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
}


.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    height: 690px;

    border-radius: 10px;
}


.close {
    color: rgb(0, 0, 0);
    float: right;
    border-color: transparent;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: rgb(82, 80, 80);
    text-decoration: none;
    cursor: pointer;
}
.formodal{
    color: black;
}
.formodalinput{
    width: 100%;

}

.fc{
    background-color: white;
    border-color: black;
    border-width: 2px;
    color: black;

}
</style>
