<template>
    <div id="background">

        <div id="content" class="col-lg-8 mx-auto">




            <div class="hero">
                    <h1 class="pt-5 pb-5">Upcoming Tournaments</h1>
            </div>




            <div  class="card" v-for="(tournament,i) in tournaments"  v-bind:key="tournament.id">
                <router-link v-if="!tournament.ended" v-bind:to="'tournament/'+ tournament.id">
                    <h5  class="card-header">
                       Turnaj v hre  {{tournament.name | to-uppercase}}
                    </h5>
                </router-link>



                <h4 v-if="tournament.ended" class="card-title" >
                    Turnaj  {{tournament.name}}  Ukonceny
                </h4>

                <p v-if="!tournament.ended" class="card-body">

                   Dátum turnaja :  {{tournament.start_date.slice(8,10)}}

                    -{{tournament.start_date.slice(5,7)}}

                    -{{tournament.start_date.slice(0,4)}}

                </p>

                <p v-if="!tournament.ended" class="card-body">
                   Hodina ziaciatku :    {{tournament.start_date.slice(-8)}}

                </p>

                <div class="ml-2">

                    <small  v-if="!tournament.ended">Adresa konania :  {{tournament.place}}</small>

                    <div class="mb-1" v-if="isAdmin">
                        <b-button v-on:click="deleteTournament(tournament.id)" variant="danger">Delete</b-button>
                        <b-button v-if="!tournament.ended" v-on:click="showForm(tournament.id)" variant="warning">Update</b-button>


                </div>



                </div>
                <!--<div class="mt-2">-->
                    <!--<b-form-group v-if="tournament.id === isShow"-->
                                  <!--id="fieldset1"-->
                                  <!--description="Changing the tournament."-->
                                  <!--label="Change Tournament"-->
                                  <!--label-for="input1">-->
                        <!--&lt;!&ndash;:invalid-feedback="invalidFeedback"-->
                        <!--:valid-feedback="validFeedback"-->
                        <!--:state="state"&ndash;&gt;-->

                        <!--<b-form-input class="mb-2" id="input"  v-model.trim="tournament.name"></b-form-input>-->
                        <!--<b-form-input class="mb-2" id="input"  v-model.trim="tournament.place"></b-form-input>-->
                        <!--<b-form-input class="mb-2" id="input" type="datetime-local"  v-model.trim="tournament.start_date"></b-form-input>-->

                        <!--<b-button v-on:click="editTournament(tournament)">Confirm</b-button>-->

                    <!--</b-form-group>-->

                <!--</div>-->

                <div class="mt-2 ml-2 mr-2" v-if="tournament.id === isShow">
                   <form    action="#" @submit.prevent="validateBeforeSubmit(tournaments[i])">
                        <div class="">
                            <label for="exampleInputName">Tournament name</label>
                            <input v-model="tournaments[i].name" type="text" class="form-control" id="exampleInputName"  name="name" v-validate="'required'">
                            <span  class="errorV" >{{ errors.first('name') }}</span>
                        </div>

                        <div class="">
                            <label for="exampleInputEmail">Address</label>
                            <input v-model="tournaments[i].place" type="address" class="form-control" id="exampleInputEmail"  name="address" v-validate="'required'">
                            <span class="errorV" >{{ errors.first('address') }}</span>
                        </div>
                        <div class="">
                            <label for="exampleInputNickname">Start Date</label>
                            <input v-model="tournaments[i].start_date" type="datetime-local" class="form-control" id="exampleInputNickname"  name="start_date" v-validate="'required'">
                            <span class="errorV">{{ errors.first('start_date') }}</span>
                        </div>




                        <!--<div v-if="serverErrors">-->
                        <!--<div  class="alert alert-danger" role="alert" v-for="(value,key) in serverErrors" :key="key">{{value[0]}}</div>-->
                        <!--</div>-->

                        <!--<div  v-if="successMessage"  class="alert alert-success" role="alert" >{{ successMessage }}</div>-->

                        <button type="submit" class="btn-submit btn btn-dark btn-lg col-md-12 col-lg-12 mb-2">Confirm</button>
                    </form>
                </div>

              </div>






            <router-link v-if="isAdmin" to="/addTournament"> <b-button   id="addTournament" size="lg" class="mt-5 mx-auto" variant="success">Add Tournament</b-button></router-link>

        </div>





    </div>
</template>

<script>
    export default {
        data() {
            return {

                tournaments: [],
                isShow:0,
                tournament:{
                    name:'',
                    place:'',
                    start_date:'',
                    ended:'',
                    time:''

                },
                tournament_id:'',
                show:true




            }

        },


        created(){
            this.fetchTournaments();

        },

        computed:{

            isAdmin() {
                return this.$store.getters.admin;
            },


        },


        methods: {
            fetchTournaments() {
                fetch('api/tournaments')
                    .then(res => res.json())
                    .then(res => {
                    console.log(res.data);
                    this.tournaments = res.data;
                    console.log(this.tournaments)

                })
            },

            deleteTournament(id){
                if(confirm('Are you sure?')){
                     fetch('api/tournament/' + id, {
                        method: 'delete'
                    })
                        .then(res =>res.json())
                         .then(res =>{
                            console.log(res.data);
                            this.fetchTournaments();
                            alert('Tournament deleted');
                    })
                }
            },

            editTournament(tournament){
                this.tournament=tournament;
                this.tournament.tournament_id = tournament.id;
                console.log(this.tournament );
                     fetch('api/tournament',{
                        method: 'put',
                        body: JSON.stringify(this.tournament),
                         headers: {
                             'content-type': 'application/json'
                         }

                    })
                        .then(res =>res.json())
                         .then(res =>{
                             console.log(res.data);
                             this.fetchTournaments();
                            alert('Tournament updated');
                            this.isShow=0;
                        })
                },

            showForm(id){
                if(id === this.isShow) {
                    this.isShow = 0;
                } else {
                    this.isShow = (id);
                }



            },
            validateBeforeSubmit(tournament) {
                this.$validator.validateAll().then((result) => {
                    if (result) {

                        this.editTournament(tournament);

                    }


                });
            }

        }
    }


</script>

<style scoped>





    .card{
        margin-bottom: 10px;
    }

    @media (min-width: 1400px) {
        .card {
            margin-left: 10px;
        }
    }

    button{
        margin-bottom: 3px;
        margin-top: 10px;
    }

    h5:hover{
        color:grey;
    }

    .red{
        color:red;
    }

    #addTournament{
        display: flex;
        text-align: center;
    }



    #background{
         background: url(../../roll-the-dice-craps-board-game-points-122427.jpeg);
         background-size: cover;
         /*margin-left: -29px;*/
         /*margin-right:-30px;*/
         /*margin-bottom:-30px;*/

     }

    @media (max-width: 768px) {
        .hero h1 {
            font-size: 2em;
        }
    }



</style>
