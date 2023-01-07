<template>

    <heading>


    <div class="Main_wrapper">

        <button  @click="createquizpage()" href="/createquiz" class="CreateNewQuizBtn">Create New Quiz</button>

        <ul class="quizlistul">
            <li v-for="item in data" :key="item.id">
                <Quizitem  :ispublished="item.is_published"  :user_id="item.user_id"  :isowner="item.is_owner"  @startquiz="startquiz(item.id)"   @deleteitem=Deletethis(item)  :id=item.id  :Author= item.author :totalQuestion=item.total_questions  :Title=item.title :imglink=item.quizpicture ></Quizitem>

            </li>


        </ul>

    </div>

    </heading>
</template>

<script>

import Quizitem from './QuizItem'
import heading from './heading'
export default {

    components: {
        Quizitem,heading
    },
    data()
    {
        return{
        data:[],



    }},

    mounted(){



        axios.post('/')
            .then(response => {

                 this. data= response.data['mod']




            })
            .catch(error => {
                console.error(error);
            });

    }
    ,


    methods:{

        startquiz(id){




            axios.get('/quizpage/'+id,  {


            }).then(response => {
                 window.location =  '/quizpage/'+id;


            }).catch(error => {
                console.error(error);

            });



        },



        createquizpage(){





            let token = localStorage.getItem('access_token');
            console.log(token)
            axios.get('/createquiz',  {
                headers: {
                    'Authorization': 'Bearer ' + token,
                },
                withCredentials: true,
            }).then(response => {
                window.location = '/createquiz';



            }).catch(error => {
                console.error(error);

            });






        },
        Deletethis(obj){


            axios.delete('/deletequiz/'+obj.id)
                .then(response => {


                    this.data.splice(    this.data.indexOf(obj), 1);



                })
                .catch(error => {
                    console.error(error);
                });






        }

    }
}
</script>
<style scoped>


.quizlistul li {
    list-style: none;
    float: left;

    list-style: none;
    display:inline ;
}
 a{
     all: unset;
 }
.quizlistul{
    flex-wrap: wrap;


    align-items: center;

    display: flex;

    width: 100%;
    margin: auto;
    height: auto;
    padding: 0;
    background-color: rgba(24, 23, 37, 1);

}

.CreateNewQuizBtn{
    color:  black;
        background-color: white;

    padding: 15px;
    font-size: 25px;
    margin-left: 20px;
    cursor: pointer;
    border-radius: 10px;
    transition: 500ms;
    border-color: transparent;

}
.CreateNewQuizBtn:hover{
    color: white;
    background-color: rgba(24, 23, 37, 1);
    border-color: white;

}
.Main_wrapper{
    width: 100%;
    height: 100vh;
    background-color: rgba(24, 23, 37, 1);
    padding-top: 50px;

}



</style>
