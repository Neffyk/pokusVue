<template>

</template>

<script>
    export default {

        created(){
            this.$store.dispatch('destroyToken')
                .then(res => {
                    if(res.ok) {
                        this.$router.push({name:'login'});
                    }

            })
        }

    }
</script>

<style scoped>

</style>
