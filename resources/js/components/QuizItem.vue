<template>


    <div class="main">
        <div class="controllerdiv">


            <div v-if="isowner">

            <button class="listbtn deletebtn"  @click="DeleteItem()">Delete</button>
            <button  @click="updatepage()"  class="listbtn updatebtn" >Update</button>
            </div>


            <div v-if="this.user_id===1">



                <button @click="publishbtn()" class="listbtn   published"  v-if="ispublishedbtn==false" >Publish</button>
                <button @click="unpublishbtn()" class="listbtn  publish " v-if="ispublishedbtn" >Unpublish</button>
            </div>
        </div>
        <div class="heading">
            <div class="quizname"> {{ Title }}</div>
            <button @click="GotoQuizpage()" class="Startbtn">Start</button>
        </div>


        <div class="mainContent">

            <img  :src="this.imglink">
        </div>
        <div class="quizinfo">

            <div class="quizinfoItem">
                <div>
                                <span class="material-symbols-outlined iocn">
person
</span>
                    <div style="font-weight:bold">Author</div>

                </div>

                <div> {{ Author }}</div>
            </div>
            <div class="quizinfoItem">
                <div>
                                <span class="material-symbols-outlined iocn">

quiz

</span>
                    <div style="font-weight:bold">Total Questions</div>

                </div>

                <div>{{ totalQuestion }}</div>
            </div>


        </div>



    </div>

</template>


<script>

export default{




    props:['Title', "Author","imglink","totalQuestion","id","isowner" ,"user_id","ispublished"],

    data(){
        return{
            ispublishedbtn: this.ispublished

        }
    },

    methods:{

        updatepage(){

            window.location='/updatequiz/'+this.id;
        },

        DeleteItem(){

            this.$emit('deleteitem')
        },


        GotoQuizpage(){

            this.$emit('startquiz')
        },
        unpublishbtn(){


            axios.post('/makequiz_un_publish/' + this.id)
                .then(response => {
                    this.ispublishedbtn=false

                })
                .catch(error => {
                    console.error(error);
                });






        },
        publishbtn(){
            axios.post('/makequizpublish/' + this.id)
                .then(response => {
                    this.ispublishedbtn=true

                })
                .catch(error => {
                    console.error(error);
                });






        }



    }
}


</script>

<style scoped>
.published{
    background-color:  rgb(0, 136, 86);

}
.publish{
    background-color: rgb(255, 0, 174);
}
.publish:hover{
    background-color: rgb(169, 2, 116);

}
.publishedtitle{
    margin-left: 5px;
    font-size: 20px;
    font-weight: bold;
}
.checkdiv{
    display: flex;
    align-items: center;
}
.controllerdiv{
    display: flex;
    align-items: center;
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
.iocn{
    font-weight:bold;
    font-size: 30px;
}
.quizinfoItem div{
    display: flex;
    align-items: center;
    font-size: 23px;
}
.quizinfoItem{
    margin-bottom: 10px;
    display: flex;
    justify-content: space-between;
}
.mainContent img{
    width: 400px;
    height: 300px;
    border-radius: 10px;
    margin-bottom: 10px;
}

.mainContent{

    display: grid;
    place-items: center;
    padding-top: 10px;
    overflow-x: hidden;
}
.quizname{
    font-weight: bold;
    font-size: 20px;
}
.heading{
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.main{
    width: 400px;
    height: 450px;
    background-color: white;
    border-radius: 10px;
    margin: 20px;
    padding: 15px;
    min-width: 400px;
    min-height: 490px;
    max-height: 450px;
    cursor: pointer;
    box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
}

.main:hover{
    opacity: 0.9;
}
.Startbtn{
    font-size: 25px;
    padding: 10px;
    background-color: rgba(24, 23, 37, 1);
    color: white;
    width: 100px;
    cursor: pointer;
    border-radius: 10px;
    border-color: transparent;
    float: right;
    min-width: 100px;
}
.Startbtn:hover{

    background-color: rgb(72, 71, 71);

}
</style>
