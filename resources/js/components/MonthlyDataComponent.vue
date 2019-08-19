<template>
    <div class="card">
        <canvas id="lineChart"></canvas>
    </div>
</template>
<script>
    export default {

        props: ['lables', 'users', 'articles', 'threads', 'posts', 'tracks'],
        methods:{
            resizeCanvas(canvas){
                canvas.style.width ='35%';
                canvas.style.height='35%';
                // canvas.width  = canvas.offsetWidth;
                // canvas.height = canvas.offsetHeight;
            },
        },
        mounted() {
            this.canvas = document.getElementById("lineChart");
            this.ctx = this.canvas.getContext("2d");
            this.resizeCanvas(this.canvas);

            let lineChart = new Chart(this.ctx , {
            options: {
                elements: {
                    line: {
                        tension: 0, // disables bezier curves
                    }
                }
            },
                type: 'bar',
                data: {
                    datasets:[
                        {
                            label: 'Signups',
                            data: [this.users],
                            backgroundColor: ['rgba(255, 99, 132, 0.2)'],
                        },
                        {
                            label: 'Created Articles',
                            data: [this.articles],
                            backgroundColor: ['rgba(255, 192, 132, 0.2)'],
                        },
                        {
                            label: 'Created Threads',
                            data: [this.threads],
                            backgroundColor: ['rgba(255, 255, 132, 0.2)'],
                        },
                        {
                            label: 'Created Posts',
                            data: [this.posts],
                            backgroundColor: ['rgba(192, 255, 68, 0.2)'],
                        },
                        {
                            label: 'Featured Content',
                            data: [this.posts],
                            backgroundColor: ['rgba(99, 132, 255, 0.2)'],
                        },
                        {
                            label: 'Track Submissions',
                            data: [this.tracks],
                            backgroundColor: ['rgba(192, 132, 255, 0.2)'],
                        },
                    ]
                }
            });
        }
    }
</script>
