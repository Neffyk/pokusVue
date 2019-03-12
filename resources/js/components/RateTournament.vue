<template>
    <div class=" mt-5 ml-5 mr-5">
        <div v-for="(winnerNames,i) in 3">

        <label class="mt-2"> {{i+1}}.miesto</label>

        <b-form-select v-model="winnersNames[i]" :options="signedUsersNickNames"/>

        </div>


        <div v-for="(winnersName,i) in winnersNames">
            <div class="listOfWinners">
                <div class="row mt-3">
                    <p >{{i+1}}.miesto : </p>
                    <p class="rankedPlayers">{{winnersName}}</p>
                </div>
            </div>
        </div>



        <b-button v-on:click="fillWinners">Confirm places</b-button>


        <!--<ul v-for="signedUser in signedUsers">-->
            <!--<li>{{signedUser.user_id}}</li>-->
        <!--</ul>-->

    </div>
</template>

<script>
    export default {
        data() {
            return {

                tournament_id : this.$route.params.id,

                signedUsers:[],
                signedUsersNickNames:[],

                winnersNames:[],
                winners:[],
                score:''




            }
        },

        created() {
            this.signedUsers = this.$store.getters.getFetchTournamentUsers;
            console.log(this.signedUsers);
            this.signedUsersNickNames = this.signedUsers.map( ({nickname})=>nickname);
            console.log(this.signedUsersNickNames);

        },

        methods:{
            fillWinners() {


                // if prve meno z winnersname je v signed users nicknames tak winner prirdat to user id
                for (let k = 0; k < this.winnersNames.length; k++) {
                   for(let l = 0 ; l < this.signedUsers.length; l++) {
                       // console.log('meno vyhercu ' + this.winnersNames[k]);
                       // console.log( ' meno prehladavaneho' + this.signedUsers[l].nickname);
                       if(this.winnersNames[k] === this.signedUsers[l].nickname ) {

                           if(k==0) {
                               this.score = 10;
                           }
                           if(k==1){
                               this.score=5;
                           }
                           if(k==2){
                               this.score=2;
                           }

                           this.winners.push({id:this.signedUsers[l].id , score:this.score});

                          //
                       }
                   }
                }







                this.addPointsToWinners(this.winners);
            },

            addPointsToWinners(winners){
                for (let i = 0; i < this.winners.length; i++) {

                    console.log('v mtode kukaj' + winners[i]);
                        fetch('/api/addPoints',{
                            method: 'put',
                            body: JSON.stringify(winners[i]),
                            headers: {
                                'content-type': 'application/json'
                            }
                        })
                            .then(res =>res.json())
                            .then(res =>{
                                console.log(res.data);
                                // this.endTournament(this.tournament_id)
                            })
                }
                this.deleteTournament(this.tournament_id);
            },

            deleteTournament(id){
                if(confirm('Are you sure?')){
                    fetch('/api/tournament/' + id, {
                        method: 'delete'
                    })
                        .then(res =>res.json())
                        .then(res =>{
                           this.$router.push({name:'tournaments'});
                        })
                }
            },


            // endTournament(id){
            //     fetch('/api/endTournament/' +id, {
            //         method: 'put',
            //     })
            //         .then(res=> res.json())
            //         .then(res=> {
            //             console.log(res.data);
            //         })
            // }




        }

    }
</script>

<style scoped>

    .rankedPlayers{
        margin-left: 10px;
        font-weight:bold;
        color: black;
    }
    .listOfWinners{
        margin-left: 14px;
    }
</style>
