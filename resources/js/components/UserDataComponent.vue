<template>
    <div class="card">
        <h3>User Data</h3>
        <canvas ref="canvas"></canvas>
    </div>
</template>
<script>
    export default {
        props: ['users', 'threads', 'posts'],
        mounted() {
            this.ctx = this.$refs.canvas.getContext('2d');
            let pieChart = new Chart(this.ctx , {
                type: "doughnut",
                data: {
                    labels: ['Users', 'Threads', 'Posts'],
                    datasets:[
                        {
                        data: [
                                this.users, this.threads, this.posts,
                            ],
                        backgroundColor: ['#a3c7c9','#889d9e', '#5c6b6d'],
                        }
                    ]
                }
            });
        }
    }
</script>
