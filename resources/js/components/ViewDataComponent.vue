<template>
    <div class="card">
        <h3>Views</h3>
        <canvas ref="canvas"></canvas>
    </div>
</template>
<script>
    export default {
        props: ['articles', 'threads'],
        mounted() {
            this.ctx = this.$refs.canvas.getContext('2d');
            let pieChart = new Chart(this.ctx , {
                type: "doughnut",
                data: {
                    labels: ['Articles', 'Threads'],
                    datasets:[
                        {
                        data: [
                                this.articles, this.threads
                            ],
                        backgroundColor: ['#a3c7c9','#889d9e'],
                        }
                    ]
                }
            });
        }
    }
</script>
