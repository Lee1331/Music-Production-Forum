<template>
    <li class="nav-item">
        <i class="fa fa-bell">
            <span style="color:red">
                {{unreadnotifications}}
            </span>
        </i>
    </li>
</template>
<script>
export default {
    props:['unreadnotifications', 'userid'],
    mounted(){
        //console.log('mounted');
        Echo.private('App.User.' + this.userid)
            .notification((notification) => {
                //console.log(notification.type);
            });
    }
}
</script>
