<template>
    <div class="row mt-5 ml-5 mr-5">
        <div class="col-lg-6">
            <div>
                <h1>{{tournament.name}}</h1>
                <h2>{{tournament.place}}</h2>
                <h3>{{tournament.start_date}}</h3>

            </div>
            <router-link v-if="isAdmin"  class="" v-bind:to="'/rateTournament/' + this.id"> <b-button variant="primary">Rate Tournament</b-button></router-link>
        </div>

        <div  class="col-lg-6">
            <assigned-users></assigned-users>
        </div>

    </div>
</template>

<script>

    import AssignedUsers from './AssignedUsers.vue'

    export default {

        components:{
          'assigned-users':AssignedUsers
        },

        computed:{

            isAdmin() {
                return this.$store.getters.admin;
            },


        },

        data() {
            return {
                id: this.$route.params.id,
                tournament: {},


            }
        },

        created() {
            this.fetchTournament();
        },

        methods: {
            fetchTournament() {
                fetch('/api/tournament/' + this.id)
                    .then(res => res.json())
                    .then(res => {
                        console.log(res);
                        this.tournament = res.data;

                    })

            }
        }
    }





</script>

<style scoped>

    /*#buttons{*/
        /*margin-top: 15px;*/
    /*}*/

</style>
