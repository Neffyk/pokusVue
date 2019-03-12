<template>
<div class="col-lg-8 mx-auto" >
    <h1>Evidencia Hracov</h1>
    <hr>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th >Name</th>
            <th >Email</th>
            <th >Nickname</th>
            <th >Role</th>
            <th >Score</th>
            <th >Delete</th>
            <th >Update</th>
        </tr>
        </thead>

        <tbody v-for="(user , i)  in users">
        <tr>
            <th scope="row">{{user.id}}</th>
            <td>{{user.name}}</td>
            <td>{{user.email}}</td>
            <td>{{user.nickname}}</td>
            <td>{{user.role}}</td>
            <td>{{user.score}}</td>
            <td><b-button  v-on:click="deleteUser(user.id)" variant="danger">Delete</b-button></td>
            <td><b-button v-on:click="showForm(user.id)" variant="warning">Update</b-button></td>
        </tr>

        <tr v-if="user.id === isShow">
            <td colspan="4"><form    action="#" @submit.prevent="validateBeforeSubmit(users[i])">
                <div class="">
                    <label for="exampleInputName">Name</label>
                    <input v-model="users[i].name" type="text" class="form-control" id="exampleInputName"  name="name" v-validate="'required'">
                    <span  class="errorV" >{{ errors.first('name') }}</span>
                </div>

                <div class="">
                    <label for="exampleInputEmail">Email</label>
                    <input v-model="users[i].email" type="email" class="form-control" id="exampleInputEmail" placeholder="Email" name="email" v-validate="'required'">
                    <span class="errorV" >{{ errors.first('email') }}</span>
                </div>
                <div class="">
                    <label for="exampleInputNickname">Nickname</label>
                    <input v-model="users[i].nickname" type="text" class="form-control" id="exampleInputNickname"  name="nickname" v-validate="'required'">
                    <span class="errorV">{{ errors.first('nickname') }}</span>
                </div>

                <div class="">
                    <label for="exampleInputRole">Role</label>
                    <input v-model="users[i].role" type="text" class="form-control" id="exampleInputRole" name="role">
                </div>

                <div class="">
                    <label for="exampleInputScore">Score</label>
                    <input v-model="users[i].score" type="text" class="form-control" id="exampleInputScore" name="score" v-validate="'integer'">
                    <span class="errorV" >{{ errors.first('score') }}</span>
                </div>



                <!--<div v-if="serverErrors">-->
                    <!--<div  class="alert alert-danger" role="alert" v-for="(value,key) in serverErrors" :key="key">{{value[0]}}</div>-->
                <!--</div>-->

                <!--<div  v-if="successMessage"  class="alert alert-success" role="alert" >{{ successMessage }}</div>-->

                <button type="submit" class="btn-submit btn btn-dark btn-lg col-md-12 col-lg-12 mt-3">Confirm</button>
            </form></td>
        </tr>

        </tbody>
    </table>
</div>
</template>

<script>
    export default {
        data() {
            return {


                users: [],
                user:{
                    id:'',
                    name:'',
                    email:'',
                    nickname:'',
                    role:'',
                    score:''
                },
                isShow:0,
                user_id:''
            }
        },
        created() {
            this.fetchUsers();
        },

        methods: {
            fetchUsers() {
                fetch('api/users')
                    .then(res => res.json())
                    .then(res => {
                        this.users = res.data;
                        console.log(this.users);

                    })
            },
            deleteUser(id){

                if(confirm('Are you sure?')){
                    fetch('api/user/' + id, {
                        method: 'delete'
                    })
                        .then(res =>res.json())
                        .then(res =>{
                            console.log(res.data);
                            this.fetchUsers();
                            alert('Tournament deleted');
                        })
                }
            },
            showForm(id){
                if(id === this.isShow) {
                    this.isShow = 0;
                } else {
                    this.isShow = (id);
                }
            },
            editUser(user){
                this.user=user;
                this.user.user_id = user.id;
                console.log(this.user );
                fetch('api/user',{
                    method: 'put',
                    body: JSON.stringify(this.user),
                    headers: {
                        'content-type': 'application/json'
                    }

                })
                    .then(res =>res.json())
                    .then(res =>{
                        console.log(res.data);
                        this.fetchUsers();
                        alert('User updated');
                        this.isShow=0;
                    })
            },
            validateBeforeSubmit(user) {
                this.$validator.validateAll().then((result) => {
                    if (result) {

                        this.editUser(user);

                    }


                });
            }

        }
    }
</script>

<style scoped>

</style>
