<template>
    <div>
        <input id="trix" :name="name" :value="value" type="hidden">
        <trix-editor id="editor" input="trix" ref="trix"></trix-editor>
    </div>
</template>
<script>
    import Trix from 'trix';
    export default {
        props: ['name', 'value'],
        mounted(){
            this.$refs.trix.addEventListener('trix-change', function(event){
                //listen for the 'trix-change' event on the editor, if fired, emit the input message
            //document.getElementById('editor').addEventListener('trix-change', function(event){
                this.$emit('input', event.target.innerHTML);
            });
        },

    }
</script>
