import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios'

Vue.use(Vuex);
axios.defaults.baseURL = 'http://apilar.test/api'


export const store = new Vuex.Store({
    state: {
        token: localStorage.getItem('access_token') || null,
        user: JSON.parse(localStorage.getItem('user')) || null,
        assignedUsers:[],
        // tournamentState:''
    },
    getters: {

        admin(state){

            if(state.user.role === 'admin') {
                return true
            } else {
                return false;
            }
        },

        loggedIn(state){
            return state.token != null;
        },
        getUser(state){
            return state.user;
        },
        getFetchTournamentUsers(state){
            return state.assignedUsers;
        },
        // getFetchTournamentState(state) {
        //    return state.tournamentState;
        //
        // }

    },
    mutations: {

        retrieveToken(state, token){
            state.token = token;
        },
        destroyToken(state){
            state.token = null;
            state.user_id=0;
        },
        getUser(state,user) {
            state.user=user;
        },
        fetchTournamentUsers(state,assignedUsers){
            state.assignedUsers=assignedUsers;
        },
        assign(state,newAssignedUser){

        },
        // fetchTournamentState(state,tournamentState) {
        //    state.tournamentState = tournamentState;
        //
        // }

    },
    actions: {

        retrieveToken(context, credentials) {

            return new Promise((resolve, reject) => {

                axios.post('login', {
                    username: credentials.user.username,
                    password: credentials.user.password,
                })
                    .then(res => {
                            resolve(res);
                            console.log(res);
                            const token = res.data.access_token;
                            localStorage.setItem('access_token', token);
                            context.commit('retrieveToken', token);

                    }).catch(error => {
                    console.log(error);
                    reject(error);
                })

            })

        },

        destroyToken(context) {
            if (context.getters.loggedIn) {
                return new Promise((resolve, reject) => {

                    fetch('api/logout', {
                        method: 'post',
                        headers: {
                            'accept': 'application/json',
                            'Authorization': 'Bearer ' + this.state.token
                        }
                    })
                        .then(res => {
                            console.log(res);
                            resolve(res);
                            res.json().then(res => {
                                console.log(res);
                                localStorage.removeItem('access_token');
                                context.commit('destroyToken');

                            })

                        }).catch(error => {
                        localStorage.removeItem('access_token')
                        context.commit('destroyToken');
                        reject(error);
                    })

                })
            }
        },

        register(context,data){
            return new Promise((resolve, reject) => {

                axios.post('register', {
                    name: data.user.name,
                    email: data.user.email,
                    nickname: data.user.nickname,
                    password: data.user.password
                })
                    .then(res => {
                        resolve(res);

                    }).catch(error => {
                    reject(error);
                })

            })
        },

        getUser(context,credentials) {
                fetch('api/user/' + credentials.user.username)
                    .then(res => res.json())
                    .then(res => {
                        console.log(res);
                        const user = res.data;
                        localStorage.setItem('user', JSON.stringify(user));
                        console.log(user)
                        context.commit('getUser',user);

                    })

        },

        fetchTournamentUsers(context , data) {
                fetch('/api/assigned/' +data)
                    .then(res => res.json())
                    .then(res => {
                        console.log(res);
                            const assignedUsers = res;
                            context.commit('fetchTournamentUsers',assignedUsers);

                        })
            },

        assign(context,data){

            return new Promise((resolve, reject) => {



            axios.post('assign',{
                user_id: data.tournamentUser.user_id,
                tournament_id : data.tournamentUser.tournament_id

            })
                .then(res =>{
                    resolve(res);
                    const newAssignedUser = res.data;
                    context.commit('assign',newAssignedUser);
                    store.dispatch('fetchTournamentUsers',data.tournamentUser.tournament_id);
                })
                .catch(error=> {
                    reject(error);
                })
            })
        },


        // fetchTournamentState(context,data) {
        //     fetch('/api/tournament/' + data.id)
        //         .then(res => res.json())
        //         .then(res => {
        //
        //             const tournamentState = res.data.ended;
        //             context.commit('fetchTournamentState' , tournamentState);
        //
        //         })
        //
        // }

    }


})
