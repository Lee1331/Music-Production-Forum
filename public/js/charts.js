

let numUsersCanvas = document.getElementById("numUsersGraph");
let ctx = numUsersCanvas.getContext("2d");
//let userCount = JSON.parse("{{ json_encode($userCount) }}");
let data = {
    labels: ['Jan', 'Feb', 'Mar'],
    datasets:[
        {
            data: [
                //userCount
                10, 30 , 40
            ]
        }
    ]
}
let numUsersGraph = new Chart(ctx , {
    type: "line",
    data: data,
});



/*
import test from "./ChartsComponent.vue"
import Vue from 'vue';
import userCountGraph from './components/ChartsCompnent.vue';
new Vue({
    el: 'body',
    components: {userCountGraph}
});*/
