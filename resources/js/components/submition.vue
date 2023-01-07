<template>


    <heading>
    <div class="mainwrapper">

        <div class="wrapper">

            <h1 class="headtitle">Your Quiz will be Published after Admin approves it</h1>


            <a  href="/" class="backbtn">Go back</a>
        </div>


    </div>
    </heading>
</template>



<script>
import heading from './heading'
export default{
    components: {heading},
    methods:{



    }

}

</script>

<style scoped>
a{
    all: unset;
}
.backbtn{
    font-size: 25px;
    margin-top: 30px;
    background-color: transparent;
    border-color: transparent;
    color: white;
    cursor: pointer;

}

.backbtn:hover{

    color: rgb(113, 112, 112);

}


.headtitle{
    color: white;
    font-size: 50px;
    margin-bottom: 30px;
    margin-top: 100px;
}
.scoretitle{

    color: white;
    font-size: 50px;


}
.mainwrapper{
    width: 100%;
    height: 100vh;
    background-color: rgba(24, 23, 37, 1);

}

.wrapper{
    display: grid;
    place-items: center;
    padding-top: 40px;

}
</style>
