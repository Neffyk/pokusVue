<template>
<div id="content" class="col-lg-8  mx-auto">
    <div class="hero">
        <h1 class="pt-5 pb-5">Mine Tournaments</h1>
    </div>
    <div class="card" v-for="tournament in tournaments">
        <div class="card-header">{{tournament.name}}</div>
        <div class="card-body">  <b-button v-on:click="deleteAssignedTournament(tournament.pivot.tournament_id)">Odhlasit sa</b-button></div>
    </div>
</div>
</template>

<script>
    export default {
       data(){
           return {
                tournaments:[]
           }
       },

        created() {

          this.fetchAssignedUserTournaments()

        } ,

        methods:{
            fetchAssignedUserTournaments(){
                fetch('api/userAssignedTournaments/' + this.$store.getters.getUser.id)
                    .then(res => res.json())
                    .then(res => {
                        console.log(res);
                        this.tournaments = res;
                        console.log(this.tournaments);

                    })
            },

            deleteAssignedTournament(tournament_id){
                fetch('api/userAssignedTournament/' + tournament_id +'/'+ this.$store.getters.getUser.id  , {
                    method: 'delete'
                })
                    .then(res =>{
                        console.log(res);
                        this.fetchAssignedUserTournaments();
                    })

            },

        }



    }
</script>

<style scoped>
    .hero {
        color: rgba(0,0,0,.75);
        text-align: center;
        text-transform: uppercase;
        text-shadow: 1px 1px 0 #fff;


    }

</style>
