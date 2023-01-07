<template>

    <heading>
    <div class="main">

        <div class="mainWrapper">
            <div class="questionpos">  {{currentanswerposition}}/{{  totalanswers}}</div>
            <div class="QuestionTitle">{{ Question }}</div>


            <img  class="questionImage" :src="Image">


            <div class="answersectiondiv">

                <ul class="answerul">
                    <li  class="answerli"  v-for="answer in  answerarray" :key="answer.id" >
                        <button class="Answerbtn   " @click="Checker(   answer  )"   :id="answer.id"  >
                            <div class="answersection">
                                <div class="answerdivtitl"> </div>
                                <div class="answerdiv">{{   answer['answertitle'] }}</div>

                            </div>

                        </button>
                    </li>


                </ul>



            </div>
            <Button @click="gotonextanswer()" id="nextbtn" class="nextbtn disabled ">Next  > </Button>
        </div>

    </div>
    </heading>

</template>

<script>

import heading from './heading'
export default {
    components: {heading},
    data() {

        return {
            userpoints:0,
            answerarray:[],
            currentanswerposition: 1,
            totalanswers:"",
            isanswertrue: "",
            Question: "not found",
            Image: "not found",
            firsquestion: "not found",
            secondquestion: "not found",
            thirdquestion: "not found",
            fourtquestion: "not found"

        }
    }, mounted() {

        const id = window.location.
        pathname.split('/')[2];

        axios.post('/quizpage/' + id)
            .then(response => {
                // Set the items data with the response data
                this.items = response.data;
                console.log(response.data)
                this.Question = response.data['question']['Question'];
                this.totalanswers=response.data['quantity']
                // this.firsquestion = response.data['answer'][0]["answertitle"]
                // this.secondquestion = response.data['answer'][1]["answertitle"]
                // this.thirdquestion = response.data['answer'][2]["answertitle"]
                // this.fourtquestion = response.data['answer'][3]["answertitle"]

                this.answerarray=(response.data['answer'])
                this.Image = response.data['question']['question_image'];

            })
            .catch(error => {
                console.error(error);
            });


    },


    methods: {
        gotonextanswer() {


            const id = window.location.pathname.split('/')[2];

            axios.post('/quizpage/' + id + "/next/" + this.currentanswerposition  )
                .then(response => {


                  if(response.data['nodata']){
                      window.location="/result/"+this.userpoints
                  }


                    console.log(response.data['quantity'])
                    this.Question = response.data['question']['Question'];

                    // this.firsquestion = response.data['answer'][0]["answertitle"]
                    // this.secondquestion = response.data['answer'][1]["answertitle"]
                    // this.thirdquestion = response.data['answer'][2]["answertitle"]
                    // this.fourtquestion = response.data['answer'][3]["answertitle"]
                    this.Image = response.data['question']['question_image'];
                    this.currentanswerposition += 1
                     this.answerarray=(response.data['answer'])


                })
                .catch(error => {
                    console.error(error);

                });




        },



    Checker( answer) {
            let id =  answer.id;

        let main =document.getElementById('nextbtn')

        main.classList.remove('disabled');
        var lis = document.querySelectorAll('li.answerli');
        let c = document.getElementById(  id);

        axios.post( "/checkanswer/"+answer.id)
            .then(response => {

                if(response.data['iscorrect']){
            this.userpoints+=1
                    c.classList.add('correctAnswer');
                }else{
                    c.classList.add('wrongAnswer');
                }

            })
            .catch(error => {
                console.error(error);
            });



        for (var i = 0; i < lis.length; i++) {

            var button = lis[i].querySelector('button');


            button.disabled = true;
        }


    }


}



}

</script>


<style scoped>



.nextbtn{

    float: right;
    font-size: 30px;
    margin-top: 20px;
    margin-right: 20px;
    padding: 10px;
    border-radius: 10px;
    background-color: white;
    cursor: pointer;
    border-color: transparent;
    width: 200px;
    transition: 500ms;
}
.nextbtn:hover{
    color: white;
    background-color: rgba(24, 23, 37, 1);
    border-color: white;
}
.disabled {
    pointer-events: none;
    color: rgb(56, 55, 55);
    border-color: transparent;
    background-color: rgba(81, 79, 79, 0.339);
}



.answersectiondiv{
    display: grid;
    place-items: center;
}

.answerdivtitl{
    color: white;
    margin-right: 10px;
    font-size: 25px;
    font-weight: bold;
}
.answerdiv{
    color: white;
    font-size: 25px;
}
.answersection{
    display: flex;
}
.answerul li{
    list-style: none;

}
.answerul{
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 15px;
}

.Answerbtn{

    background-color: transparent;
    cursor: pointer;
    width: 800px;
    border-color: white;
    padding: 10px;
    border-radius: 10px;
    border-style: groove;
}

.questionpos{
    color: white;
    font-size: 30px;
}
.QuestionTitle{
    color: white;
    font-size: 24px;
    min-width: 100%;
}

.main{
    display: grid;
    place-items: center;
    background-color: rgba(24, 23, 37, 1);
    padding-top: 80px;
    padding-bottom: 200px;
}


.mainWrapper{
    padding: 20px;
    border-color: white;
    border-style:groove;
    border-width: 1px;
    border-radius: 10px;

    height: 600px;
    min-width: 90%;

}
.questionImage{
    width: 100%;
    height: 300px;
    border-radius: 10px;
    margin-top: 20px;
    margin-bottom: 30px;

}
.correctAnswer{

    background-color: rgba(17, 228, 151, 1);
    border-color: transparent;
}
.wrongAnswer{

    background-color: rgb(228, 17, 17);
    border-color: transparent;

}
</style>
