<template>
    <div class="card">
        <h3>Featured Content</h3>
        <canvas ref="canvas"></canvas>
    </div>
</template>
<script>
    export default {

        props: ['tracks', 'articles'],
        mounted() {
            this.ctx = this.$refs.canvas.getContext('2d');
            let pieChart = new Chart(this.ctx , {
                type: "doughnut",
                data: {

                    labels: ['Tracks', 'Articles'],
                    datasets:[
                        {
                        data: [
                                this.tracks, this.articles
                            ],
                        backgroundColor: ['#a3c7c9','#889d9e'],
                        }
                    ]
                }
            });
        }
    }
</script>
