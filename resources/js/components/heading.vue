<template>


    <nav  >


        <div class="headerlogo">
            Quiz Portal

        </div>


        <ul >
            <li>

                <a class="headerbtn"  href="/">
                    <div>home   </div>


                </a>



            </li>
            <li>

                <a class="headerbtn"   v-if="islogged==false"   href="/register">
                    <div>Register </div>


                </a>



            </li>
            <li>
                <a class="headerbtn"   v-if="islogged==false" href="/login">
                    <div>Log in </div>


                </a>

            </li>

            <li>
                <button class="headerbtn"   v-if="islogged==true "   @click="logout()">
                    <div>Log out</div>
                    <span class="material-symbols-outlined icn">
login
</span>
                </button>
            </li>

            <li>




            </li>




        </ul>

    </nav>

    <slot  ></slot>
</template>

<script>




import axios from "axios";

export default{


    data(){
        return {

      islogged:   true
        }
    },


        mounted() {


            if ( localStorage.getItem("token")){

                this. islogged=true
            }else{
                this. islogged= false

            }


        },




    methods:{



            logout(){



                let token = localStorage.getItem('access_token');

                fetch('/logout', {
                    headers: {
                        'Authorization': 'Bearer ' + token,
                    },
                }).then(response => {
                    localStorage.removeItem('token');
                    window.location='/login'

                });










            },




    }

}


</script>

<style scoped>
a{
    all: unset;
}
.icn{
    font-size: 35px;
}
.headerlogo{
    font-weight: bold;
    font-size: 30px;
}

nav  {

    padding : 15px;


    height: 60px;
    display:flex;
    align-items: center;

    justify-content: space-between;
    background-color: rgba(17, 228, 151, 1);


}
nav ul li{
    cursor: pointer;
    display:flex;
    align-items: center;
    list-style: none;
    font-weight: bold;
    font-size: 30px;
}


.headerbtn{
    margin-left: 20px;
    background-color: transparent;
    border-color: transparent;
    cursor: pointer;
    font-weight: bold;
    font-size: 30px;
    display:flex;
    align-items: center;
    padding: 10px;
    border-radius: 10px;
    transition: 500ms;

}

.headerbtn:hover{

    color: white;
    background-color: rgba(24, 23, 37, 1);


}
nav ul{
    display: flex;
    justify-content: space-between;

}

</style>
