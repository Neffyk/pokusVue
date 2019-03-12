<template>
    <div id="content" class="col-lg-8 mx-auto mt-5">
        <h1>Add a new tournament</h1>
        <!--<b-form-group-->
                <!--id="fieldset1"-->
                <!--description="Adding new Tournament"-->
                <!--label="Enter new tournament data"-->
                <!--:invalid-feedback="invalidFeedback"-->
                <!--:valid-feedback="validFeedback"-->
                <!--:state="state"-->


        <!--&gt;-->
            <!--<b-form-input placeholder="Enter tournament name" class="mb-2" id="input1" :state="state" v-model.trim="tournament.name"></b-form-input>-->
            <!--<b-form-input placeholder="Enter tournament adress" class="mb-2" id="input1" :state="state" v-model.trim="tournament.place"></b-form-input>-->
            <!--<b-form-input placeholder="Enter tournament start date ex. 2019-08-22" class="mb-2" id="input1" :state="state" v-model.trim="tournament.start_date"></b-form-input>-->

            <!--<router-link to="/tournaments"><b-button v-on:click="addTournament(tournament)">Confirm</b-button></router-link>-->
        <!--</b-form-group>-->

        <div class="mt-2">
            <form    action="#" @submit.prevent="validateBeforeSubmit">
                <div class="">
                    <label for="exampleInputName">Tournament name</label>
                    <input v-model="tournament.name" type="text" class="form-control" id="exampleInputName"  name="name" v-validate="'required'">
                    <span  class="errorV" >{{ errors.first('name') }}</span>
                </div>

                <div class="">
                    <label for="exampleInputEmail">Address</label>
                    <input v-model="tournament.place" type="address" class="form-control" id="exampleInputEmail"  name="address" v-validate="'required'">
                    <span class="errorV" >{{ errors.first('address') }}</span>
                </div>
                <div class="">
                    <label for="exampleInputNickname">Start Date</label>
                    <input v-model="tournament.start_date" type="datetime-local" class="form-control" id="exampleInputNickname"  name="start_date" v-validate="'required'">
                    <span class="errorV">{{ errors.first('start_date') }}</span>
                </div>




                <!--<div v-if="serverErrors">-->
                <!--<div  class="alert alert-danger" role="alert" v-for="(value,key) in serverErrors" :key="key">{{value[0]}}</div>-->
                <!--</div>-->

                <!--<div  v-if="successMessage"  class="alert alert-success" role="alert" >{{ successMessage }}</div>-->

                <button type="submit" class="btn-submit btn btn-primary btn-lg col-md-12 col-lg-12 mt-3">Add Tournament</button>
            </form>
        </div>

    </div>
</template>

<script>
    export default {





        data(){
            return {
                tournament:{
                    name:'',
                    place:'',
                    start_date:''
                }

            }
        },

        methods:{
            addTournament(tournament){
                this.tournament=tournament;
                console.log(this.tournament );
                fetch('api/tournament',{
                    method: 'post',
                    body: JSON.stringify(this.tournament),
                    headers: {
                        'content-type': 'application/json'
                    }

                })
                    .then(res =>res.json())
                    .then(res =>{
                        console.log(res.data);
                        this.isShow=0;
                        alert('Tournament Added');
                        this.$router.push({name:'tournaments'});
                    })
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {

                        this.addTournament(this.tournament);

                    }


                });
            },
        }

    }
</script>

<style scoped>

</style>
