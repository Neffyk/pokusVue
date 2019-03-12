<template>
    <div id="background">
        <div class="hero">
            <h1 class="pt-5 pb-5">Player Rankings</h1>
        </div>
        <div id="content" class="col-lg-8 mx-auto">
            <b-table  responsive hover :fields="fieldsT" :items="sortedUsers">
                <template slot="index" slot-scope="data">
                    {{data.index + 1}}
                </template>
            </b-table>
        </div>
    </div>
</template>

<script>



    export default {
        data() {
            return {

                fieldsT: [
                  'index',
                    'nickname',
                    'score'
                ],

                users: []
            }
        },

        computed: {
            sortedUsers: function() {
                function compare(a, b) {
                    if (a.score > b.score)
                        return -1;
                    if (a.score < b.score)
                        return 1;
                    return 0;
                }

                return this.users.sort(compare);
            }
        },


        created() {
            this.fetchUsers();



        },

        methods: {
            fetchUsers() {
                fetch('api/rankings')
                    .then(res => res.json())
                    .then(res => {
                        console.log(res.data);
                        this.users = res.data;
                        console.log(this.users);

                    })
            }

        }
    }
</script>

<style scoped>

    #content{
        font-size: 19px;
    }

    .hero {
        color: rgba(0,0,0,.75);
        text-align: center;
        text-transform: uppercase;
        text-shadow: 1px 1px 0 #fff;


    }


    #background{
        background: url(../../Competition-shutterstock_166745825.jpg);
        background-size: cover;
        z-index: -5;
        /*margin-left: -29px;*/
        /*margin-right:-30px;*/
        /*margin-bottom:-30px;*/

    }
</style>
