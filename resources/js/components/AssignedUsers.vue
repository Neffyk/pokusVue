<template>
    <div>
        <h1>Prihlaseny na turnaj</h1>
        <ul v-for="assignedUser in assignedUsers">
            <li>{{assignedUser.nickname}}</li>

        </ul>

        <div id="buttons">
            <b-button v-on:click="assign(tournamentUser)">Pridat sa</b-button>
        </div>

    </div>
</template>

<script>
    export default {
        name: "assignedUsers",

        data(){
            return{
                id: this.$route.params.id,
                tournamentUser:{
                    user_id:0,
                    tournament_id:0
                }
            }
        },

        computed:{
            assignedUsers: function () {
                return this.$store.getters.getFetchTournamentUsers;
            }

        },


        created() {
            this.$store.dispatch('fetchTournamentUsers',this.id)

        },

       methods: {
           assign(tournamentUser) {
                 this.tournamentUser.user_id = this.$store.getters.getUser.id;
                 this.tournamentUser.tournament_id = this.id;


                 this.$store.dispatch('assign', {
                     tournamentUser
                 }).then(res => {
                     alert('you have signed in this tournament')
                 }).catch(error=> {
                     alert('already signed in this tournament');
                 });


           }
        }
    }
</script>

<style scoped>

</style>
