<template>
    <div class="mt-5 offset-md-2 col-md-8 offset-lg-4 col-lg-4">
        <form   action="#" @submit.prevent="validateBeforeSubmit">
            <div class="form-group">
                <h2 class="mb-3">Please Register to continue</h2>
                <label for="exampleInputName">Name</label>
                <input  v-model="user.name" type="text" class="form-control" id="exampleInputName"  placeholder="Enter your name"  name="name" v-validate="'required'">
                <span class="errorV" >{{ errors.first('name') }}</span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail">Email</label>
                <input v-model="user.email" type="email" class="form-control" id="exampleInputEmail" placeholder="Email" name="email" v-validate="'required|email'">
                <span class="errorV" >{{ errors.first('email') }}</span>
            </div>
            <div class="form-group">
                <label for="exampleInputNickname">Nickname</label>
                <input v-model="user.nickname" type="text" class="form-control" id="exampleInputNickname" placeholder="Nickname" name="nickname" v-validate="'required'">
                <span class="errorV">{{ errors.first('nickname') }}</span>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Password</label>
                <input v-model="user.password" type="password" class="form-control" id="exampleInputPassword" placeholder="Password" name="password" v-validate="'required|min:6'">
                <span class="errorV" >{{ errors.first('password') }}</span>
            </div>



            <div v-if="serverErrors">
                <div  class="alert alert-danger" role="alert" v-for="(value,key) in serverErrors" :key="key">{{value[0]}}</div>
            </div>

            <!--<div  v-if="successMessage"  class="alert alert-success" role="alert" >{{ successMessage }}</div>-->

            <button type="submit" class="btn-submit btn btn-primary btn-lg col-md-12 col-lg-12 mt-3">Register</button>
        </form>



    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: {
                    name: '',
                    email: '',
                    nickname:'',
                    password: '',

                },
                serverErrors:'',
                successMessage:''


            }
        },
        methods: {
            register(user) {
                this.user=user;
                this.$store.dispatch('register', {
                   user
                })
                    .then(res => {

                        this.successMessage= 'Registered Successfully'
                        this.$router.push({name:'login' , params:{dataSuccessMessage:this.successMessage}});

                    })
                    .catch(error=>{
                        this.serverErrors = Object.values(error.response.data.errors);
                    })
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {

                        this.register(this.user);

                    }


                });
            }
        }
    }
</script>
