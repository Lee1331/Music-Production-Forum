<style scoped>
.waveform-canvas{
    width: 100%;
    /* width: 300px; */
    height: 300px;
}
.progress-slider-container{
    display: flex;
    width: 350px;
}
.progress-slider-background {
    /* width: 100%; */
    width: 350px;
    height: 10px;
    margin-top: 6px;
    background-color: red;

}
.progress-slider {
    /* width: 0%; */
    width: 0;
    height: 10px;
    background-color: #489A53;
}
.controls{
    width: 100%;
    display: inline-flex;
}
.buttons{
    width: 25%;
    display: flex;
}
.buttons button{
    width: 50%;
    height: 100%;
}
.pause, .volume-muted{
    display: none;
}

.volume-slider-container{
    width: 50%;

}
.volume-slider-background {
    margin-top: 5%;
    width: 100%;
    height: 10px;
    background-color: red;
}
.volume-slider {
    margin-top: 5%;
    width: 0;
    height: 10px;
    background-color: #489A53;
}
.volume-percentage {
    margin-top: 2px;

}

@media only screen and (max-width: 768px) {
    .progress-slider-container{
        width: 150px;
    }
    .progress-slider-background{
        width: 150px;
    }
}
</style>

<template>
    <div class="container">
        <div class="card">

            <canvas class="waveform-canvas"></canvas>
            <div class="card-body">
                <h5 class="card-title">Submitted by
                    <a :href="this.userpath" class="user-link text-primary">
                        {{this.user}}
                    </a>
                </h5>
                <p class="card-text">Title - {{this.title}}</p>
                <p class="card-text">Genre - {{this.genre}}</p>
                <div class="controls">
                    <div class="buttons">
                        <button @click="play();" class="play"><i class="fas fa-play"></i></button>
                        <button @click="pause();" class="pause"><i class="fas fa-pause"></i></button>
                        <button v-on:click="mute()" class="volume"><i class="fa fa-volume-up"></i></button>
                        <button v-on:click="unMute()" class="volume-muted"><i class="fa fa-volume-off"></i></button>
                    </div>
                    <div class="volume-slider-container" @mousedown="volumeSliderMouseDown"  @mousemove="volumeSliderMouseMove" @mouseup="volumeSliderMouseUp">
                        <div class="volume-slider-background">
                            <div class="volume-slider"></div>
                        </div>
                    </div>
                    <div class="volume-percentage"></div>
                </div>

                <div class="progress-slider-container" @mousedown="ProgressSliderMouseDown"  @mousemove="ProgressSliderMouseMove" @mouseup="ProgressSliderMouseUp">
                    <p class="current-time"></p>
                    <div class="progress-slider-background">
                        <div class="progress-slider"></div>
                    </div>
                    <p class="remaining-time"></p>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['track', 'path', 'counter', 'user', 'userpath' , 'genre', 'title', 'image'],
        data:function(){
            return {
                trackElement: null,
                audioSrc: null,
                mouseDown: false,
            }
        },
        mounted(){
            this.trackElement = new Audio();
            this.trackElement.src = this.path;

            this.audioCtx = new (window.AudioContext || window.webkitAudioContext)();
            this.audioSrc = this.audioCtx.createMediaElementSource(this.trackElement);

            this.volumeSliderBackgroundElement = document.getElementsByClassName('volume-slider-background')[this.counter];
            this.volumeSliderElement = document.getElementsByClassName('volume-slider')[this.counter];
            this.volumeElement = document.getElementsByClassName('volume')[this.counter];
            this.volumePercentageElement = document.getElementsByClassName('volume-percentage')[this.counter];
            this.volumeMutedElement = document.getElementsByClassName('volume-muted')[this.counter];

            this.remainingTimeElement = document.getElementsByClassName('remaining-time')[this.counter];
            this.currentTimeElement = document.getElementsByClassName('current-time')[this.counter];
            this.progressSliderElement = document.getElementsByClassName('progress-slider')[this.counter];

        },
        methods:{
            //volume sliders
            volumeSliderMouseDown() {
                //the user has pressed their mouse button
                this.mouseDown = true;
            },
            volumeSliderMouseMove(event) {
                //if the user has pressed their mouse button
                if(this.mouseDown === true){
                    this.updateVolumePos(event);
                }
            },
            volumeSliderMouseUp(event){
                //the user has released their mouse button
                this.mouseDown = false;
                    this.updateVolumePos(event);
            },
            //progress sliders
            ProgressSliderMouseDown() {
                //the user has pressed their mouse button
                this.mouseDown = true;
            },
            ProgressSliderMouseMove(event) {
                //if the user has pressed their mouse button
                if(this.mouseDown === true){
                    this.updateSliderPos(event);
                }
            },
            ProgressSliderMouseUp(event){
                //the user has released their mouse button
                this.mouseDown = false;
                this.updateSliderPos(event);
            },

            updateSliderPos(mouse){
                let percentage = mouse.offsetX / this.volumeSliderBackgroundElement.offsetWidth * 100;
                let seconds = this.trackElement.duration * (percentage / 100);
                this.trackElement.currentTime = seconds;
            },
            updateVolumePos(mouse){
                let volume = mouse.offsetX / this.volumeSliderBackgroundElement.offsetWidth;
                if(volume >= 0 && volume <= 1){
                    this.trackElement.volume = volume;
                }
            },
            formatTime(duration){
                let length = Math.round(duration);
                let minutes = Math.floor(length / 60);
                let seconds = length - minutes * 60;

                return minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
            },
            play(){
                //create the audio context, and setup the canvas
                this.setup();
                //play the audio
                this.trackElement.play();
                //display volume updates on the DOM
                this.updateVolume();

                //the arrow functions arent constrained to object scope, which allows us to call 'this' on the vue object even though we are inside the audio player object
                this.trackElement.ontimeupdate = (event) => {
                    this.updateTime();
                };
                this.trackElement.onclick = (event) => {
                    this.updateTime();
                };
                this.volumeSliderBackgroundElement.onvolumechange = (event) => {
                    this.updateVolume();
                };
                this.volumeSliderBackgroundElement.ondrag = (event) => {
                    this.updateVolume();
                };
                this.volumeSliderBackgroundElement.onclick = (event) => {
                    this.updateVolume();
                };

                document.getElementsByClassName('play')[this.counter].style.display = "none";
                document.getElementsByClassName('pause')[this.counter].style.display = "inline";
            },
            pause(){
                this.trackElement.pause();
                document.getElementsByClassName('pause')[this.counter].style.display = "none";
                document.getElementsByClassName('play')[this.counter].style.display = "inline";
            },
            mute(){
                this.trackElement.muted = true;
                this.volumeElement.style.display = "none";
                this.volumeMutedElement.style.display = "inline";
                this.volumeSliderElement.style.display = "none";
                this.volumeSliderBackgroundElement.style.display = "none";
                this.volumePercentageElement.style.display = "none";
            },
            unMute(){
                this.trackElement.muted = false;
                this.volumeMutedElement.style.display = "none";
                this.volumeElement.style.display = "inline";
                this.volumeSliderElement.style.display = "block";
                this.volumeSliderBackgroundElement.style.display = "block";
                this.volumePercentageElement.style.display = "inline";
            },

            updateTime(){
                let currentTime = this.formatTime(this.trackElement.currentTime);
                this.currentTimeElement.innerHTML = currentTime;

                //The currentTime variable isn't being used in remainingTime as the rounded off values will display an incorrect remaining time
                let remainingTime = this.formatTime(this.trackElement.duration - this.trackElement.currentTime);
                this.remainingTimeElement.innerHTML = remainingTime;

                //get percentage of the track progression
                let progress = this.trackElement.currentTime / this.trackElement.duration  * 100;
                this.progressSliderElement.style.width = progress + "%";
            },
            updateVolume(){
                let volume = this.trackElement.volume * 100;
                this.volumeSliderElement.style.width = volume + "%";
                this.volumePercentageElement.innerHTML = Math.round(volume) + "%";
            },
            setup(){
                //audio
                this.audioCtx.resume();
                let analyser = this.audioCtx.createAnalyser();
                this.audioSrc.connect(analyser);
                this.audioSrc.connect(this.audioCtx.destination);
                let buffer = analyser.frequencyBinCount;
                let frequencyData = new Uint8Array(buffer);

                //canvas
                this.canvas = document.getElementsByClassName('waveform-canvas')[this.counter];
                let ctx = this.canvas.getContext('2d');
                let width = ctx.canvas.scrollWidth;
                let height = ctx.canvas.scrollHeight;
                ctx.canvas.style.background = 'url(../images/' + this.image +') no-repeat center';
                ctx.canvas.style.backgroundSize = '300px 300px';

                //display frequency data in the canvas
                function render() {
                    //clear the canvas to clear previous data
                    ctx.clearRect(0, 0, width, height);

                    //keep looping until the track has ended
                    requestAnimationFrame(render);
                    analyser.getByteFrequencyData(frequencyData);

                    //variables for plotting/dispaying the frequency data
                    let barWidth = (100 / buffer) * 2.5;
                    let barHeight;
                    let frequencyPosition = 0;

                    for(let i = 0; i < buffer; i++) {
                        //specify the height of the frequency bars
                        barHeight = frequencyData[i];
                        ctx.fillStyle = '#304E75';

                        //plot the first frequency, and display the waveform at the bottom of the canvas
                        ctx.fillRect(frequencyPosition, (height/2)-(barHeight/2), barWidth, 255);
                        //display the rest of the frequency data
                        frequencyPosition += barWidth + 1;
                    }
                };
                render();
            }
        }
    }
</script>
