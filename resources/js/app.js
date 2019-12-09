import './bootstrap';
import Vue from "vue";
import router from "./routes/Router";
import App from "./components/App";

const app = new Vue({
    el: '#app',
    components: {
        App
    },
    router
});
