<template>
    <div class="wrapper">

        <!-- Sidebar  -->
        <nav v-if="loggedIn" id="sidebar" v-bind:class="active" >
            <div class="sidebar-header">
                <h3 v-on:click="toggleClass">Board Gaming SR</h3>
                <strong v-on:click="toggleClass">BG</strong>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <router-link :to="{ name:'home'}" exact>
                        <i class="fas fa-home"></i>
                        Home
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name:'tournaments'}" exact>
                        <i class="fas fa-dice"></i>
                        {{tournaments}}
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name:'rankings'}" exact>
                        <i class="far fa-list-alt"></i>
                        Rankings
                    </router-link>
                </li>
                <li v-if="isAdmin">
                    <router-link :to="{ name:'users'}" exact>
                        <i class="fas fa-users"></i>
                        Users
                    </router-link>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">


            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">

                    <button v-if="loggedIn"  v-on:click="toggleClass"  type="button" id="sidebarCollapse" class="btn btn-dark btn-outline-light" >
                        <i class="fas fa-align-left"></i>
                        <!--<span>Toggle Sidebar</span>-->
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li v-if="!loggedIn"  class="nav-item">
                                <router-link class="nav-link" :to="{ name:'register'}">Register</router-link>
                            </li>
                            <li v-if="!loggedIn"  class="nav-item">
                                <router-link class="nav-link" :to="{ name:'login'}">Login</router-link>
                            </li>

                            <li v-if="loggedIn"  class="nav-item">
                               <router-link class="nav-link" to="">{{nickname}}</router-link>
                            </li>

                            <li v-if="loggedIn"  class="nav-item">
                                <router-link class="nav-link" :to="{name:'mineTournament'}">Mine Tournaments</router-link>
                            </li>

                            <li v-if="loggedIn"  class="nav-item">
                                <router-link class="nav-link" :to="{ name:'logout'}">Logout</router-link>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
            <transition name="router-animation" enter-active-class="animated fadeIn faster"
                        leave-active-class="animated fadeOut faster" mode="out-in">
            <router-view> </router-view>
            </transition>

        </div>
    </div>
</template>

<script>



    export default {

        name:'app',

        data(){

            return {
                active:'',
                logged:false,
                tournaments:'Tourna.',

            }
        },



        computed:{
            loggedIn() {
                return this.$store.getters.loggedIn
            },

            nickname: function() {
                return this.$store.getters.getUser.nickname;
            },

            isAdmin() {
                return this.$store.getters.admin;
            }



        },


        /*created(){
            this.id= this.$store.getters.getId;
        },*/

        methods:{
            toggleClass() {
                if(this.active.match('active')){
                    this.active='';
                    this.tournaments='Tournaments';
                } else {
                    this.active='active'
                    this.tournaments='Tourname.'
                }
            },



        }




    }
</script>

<style>
    /*
  DEMO STYLE
*/


    @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";
    body {
        font-family: 'Poppins', sans-serif;
        background: #fafafa;
    }

    p {
        font-family: 'Poppins', sans-serif;
        font-size: 1.1em;
        font-weight: 300;
        line-height: 1.7em;
        color: #999;
    }

    a,
    a:hover,
    a:focus {
        color: inherit;
        text-decoration: none;
        transition: all 0.3s;
    }

    .navbar {
        /*padding: 15px 10px;*/
        background: #fff;
        border: none;
        border-radius: 0;
        /*margin-bottom: 40px;*/
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    }

    .navbar-btn {
        box-shadow: none;
        outline: none !important;
        border: none;
    }

    .line {
        width: 100%;
        height: 1px;
        border-bottom: 1px dashed #ddd;
        margin: 40px 0;
    }

    i,
    span {
        display: inline-block;
    }

    /* ---------------------------------------------------
        SIDEBAR STYLE
    ----------------------------------------------------- */

    .wrapper {
        display: flex;
        align-items: stretch;
    }

    #sidebar {
        min-width: 250px;
        max-width: 250px;
        background: #E6E6E6;
        color: #606f7b;
        transition: all 0.3s;
    }

    #sidebar.active {
        min-width: 80px;
        max-width: 80px;
        text-align: center;
    }

    #sidebar.active .sidebar-header h3,
    #sidebar.active .CTAs {
        display: none;
    }

    #sidebar.active .sidebar-header strong {
        display: block;
    }

    #sidebar ul li a {
        text-align: left;
    }

    #sidebar.active ul li a {
        padding: 20px 10px;
        text-align: center;
        font-size: 0.85em;
    }

    #sidebar.active ul li a i {
        margin-right: 0;
        display: block;
        font-size: 1.8em;
        margin-bottom: 5px;
    }

    #sidebar.active ul ul a {
        padding: 10px !important;
    }

    #sidebar.active .dropdown-toggle::after {
        top: auto;
        bottom: 10px;
        right: 50%;
        -webkit-transform: translateX(50%);
        -ms-transform: translateX(50%);
        transform: translateX(50%);
    }

    #sidebar .sidebar-header {
        padding: 20px;
        background: #ddd;
    }

    #sidebar .sidebar-header strong {
        display: none;
        font-size: 1.8em;
    }

    #sidebar ul.components {
        padding: 20px 0;
        border-bottom: 1px solid #ddd;
    }

    #sidebar ul li a {
        padding: 10px;
        font-size: 1.1em;
        display: block;
    }

    #sidebar ul li a:hover {
        color: #171a1d;
        background: #fff;
    }

    #sidebar ul li a i {
        margin-right: 10px;
    }

    #sidebar ul li.active>a,
    a[aria-expanded="true"] {
        color: #fff;
        background: #6d7fcc;
    }

    #sidebarCollapse{
        color:white;
    }



    a[data-toggle="collapse"] {
        position: relative;
    }

    .dropdown-toggle::after {
        display: block;
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
    }

    ul ul a {
        font-size: 0.9em !important;
        padding-left: 30px !important;
            background: #6d7fcc;
    }



    a.article,
    a.article:hover {
        background: #6d7fcc !important;
        color: #fff !important;
    }


    a.router-link-exact-active{
        color:black;
        font-weight:bold;
    }



    .hero {
        color: #fff;
        text-align: center;
        text-transform: uppercase;
        text-shadow: 1px 1px 0 rgba(0,0,0,.75);


    }
    .hero h1 {
        font-size: 4em;
        font-weight: bold;
        margin: 0;
        padding: 0;
    }







    /* ---------------------------------------------------
        CONTENT STYLE
    ----------------------------------------------------- */

    #content {
        width: 100%;
        /*padding: 20px;*/
        min-height: 100vh;
        transition: all 0.3s;
        /*margin-left: 10px;*/


    }

    /* ---------------------------------------------------
        MEDIAQUERIES
    ----------------------------------------------------- */

    @media (max-width: 768px) {
        #sidebar {
            min-width: 80px;
            max-width: 80px;
            text-align: center;
            margin-left: -80px !important;
        }
        .dropdown-toggle::after {
            top: auto;
            bottom: 10px;
            right: 50%;
            -webkit-transform: translateX(50%);
            -ms-transform: translateX(50%);
            transform: translateX(50%);
        }
        #sidebar.active {
            margin-left: 0 !important;
        }
        #sidebar .sidebar-header h3,
        #sidebar .CTAs {
            display: none;
        }
        #sidebar .sidebar-header strong {
            display: block;
        }
        #sidebar ul li a {
            padding: 20px 10px;
        }
        #sidebar ul li a span {
            font-size: 0.85em;
        }
        #sidebar ul li a i {
            margin-right: 0;
            display: block;
        }
        #sidebar ul ul a {
            padding: 10px !important;
        }
        #sidebar ul li a i {
            font-size: 1.3em;
        }
        #sidebar {
            margin-left: 0;
        }
        #sidebarCollapse span {
            display: none;
        }

        #content{
            width: 100%;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
            margin-left: 0px;
        }




    }
</style>
