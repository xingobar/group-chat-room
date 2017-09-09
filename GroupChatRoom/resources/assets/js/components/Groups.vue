<template>
     <dv>
         <group-chat v-for="group in groups" :group="group" :key="group.id"></group-chat>
     </dv>
</template>

<script>
    export default{
        props:['initialGroups','user'],

        data(){
            return{
                groups:[]
            }
        },

        mounted(){
            this.groups  = this.initialGroups;

            Bus.$on('groupCreated',(group)=>{
                this.groups.push(group);
            });

            this.listenForNewGroups();
        },

        methods:{
            listenForNewGroups(){
                Echo.private('users.'+ this.user.id)
                    .listen('GroupCreated',(e)=>{
                       this.groups.push(e.group);
                    });
            }
        },
        beforeDestory:function(){
            // [銷毀事件]
            // 在組件銷毀前清除 groupCreated 所有監聽
            Bus.$off('groupCreated');
        }
    }
</script>