
import './bootstrap';
import { createApp } from 'vue';

import homeview from './components/HomeView';
import  register from './components/Register'
import login from './components/login'
import createquiz from './components/CreateQuiz'
import quizpage from './components/QuizPage'
import updatequiz from './components/updatequiz'
import submition from './components/submition'
import result from './components/result'



const homeApp = createApp({});
homeApp.component('homeview', homeview );
homeApp.mount('#app') ;



const registerapp = createApp({});
registerapp.component('register', register );
registerapp.mount('#app2') ;


const loginapp = createApp({});
loginapp.component('login',  login );
loginapp.mount('#app3') ;


const createquizapp = createApp({});
createquizapp.component('createquiz',   createquiz  );
createquizapp.mount('#app4') ;


const  quizpageapp = createApp({});
quizpageapp.component('quizpage',   quizpage );
quizpageapp.mount('#app5') ;

const   updatequizapp = createApp({});
updatequizapp.component('updatequiz',  updatequiz );
updatequizapp.mount('#app6') ;


const    submitionapp = createApp({});
submitionapp.component('submition',   submition );
submitionapp.mount('#app7') ;


const  resultapp = createApp({});
resultapp.component('result',    result );
resultapp.mount('#app8') ;





