<template>
    <div class="mt-5 offset-md-2 col-md-8 offset-lg-4 col-lg-4">
        <form   action="#" @submit.prevent="validateBeforeSubmit">
            <div class="form-group">

                <div  v-if="successMessage"  class="alert alert-success" role="alert" >{{ successMessage }}</div>

                <h2 class="mb-3">Please Sign in to continue</h2>
                <label for="exampleInputEmail1">Email address</label>
                <input  v-model="user.username" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email" v-validate="'required'">
                <span class="errorV">{{ errors.first('email') }}</span>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input v-model="user.password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" v-validate="'required|min:6'">
                <span class="errorV">{{ errors.first('password') }}</span>
            </div>

            <div  v-if="serverError"  class="alert alert-danger" role="alert" >{{ serverError }}</div>



            <button type="submit" class="btn-submit btn btn-primary btn-lg col-md-12 col-lg-12 mt-3">Login</button>
        </form>



    </div>

</template>

<script>
    export default {

        props:{
            dataSuccessMessage:{
                type:String,
            }
        },

        data() {
            return {
                user:{
                    username:'',
                    password:''
                },

                serverError:'',
                successMessage:this.dataSuccessMessage


            }
        },
        methods: {

            login(user) {
                this.user=user;
                this.$store.dispatch('retrieveToken',{
                    user
                })
                    .then(res => {
                        this.$store.dispatch('getUser',
                            {user});
                        this.$router.push({name:'app'})
                    })
                    .catch(error=>{
                        this.serverError = error.response.data;
                        this.successMessage='';
                    })

            },

            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {

                        this.login(this.user);

                    }


                });
            }






        }
    }
</script>


<style >

    /*.server-error{*/
        /*margin-bottom : 12px;*/
        /*font-size: 16px;*/
        /*padding: 10px 16px;*/
        /*color:#a94442;*/
        /*background: #F3DEDE;*/
        /*border-radius: 4px;*/
    /*}*/


    .errorV{
        color:red;
    }




</style>
