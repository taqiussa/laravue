<template>
    <div>
        <h1>Edit User</h1>
        <form @submit.prevent="handleUpdate" method="POST" action="/users">
            <div class="input-group">
                <label>Name</label>
                <input type="text" v-model="form.name">
                <div v-if="errors.name">
                    {{ errors.name[0] }}
                </div>
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="text" v-model="form.email">
                <div v-if="errors.email">
                    {{ errors.email[0] }}
                </div>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</template>
<script>
    export default {
        props: ['id'],
        data() {
            return {
                form: {
                    name: '',
                    email: '',
                },
                errors:{
                
                }
            }
        },
        methods: {
            handleUpdate() {
                axios.put('/api/users/' +this.id,this.form)
                .then((response) => {
                    if(response.data.status){
                        console.log(response)
                        this.$noty.success(response.data.message)
                        this.$router.push({
                            name: 'User',
                        })
                    }
                })
                .catch((error) => {
                    console.log(error.response)
                    if(error.response.status == 422){
                        this.errors = error.response.data.errors
                    }
                })
            },
            getUser() {
                axios.get('/api/users/' + this.id).then((response) => {
                    this.form = {
                        name: response.data.name,
                        email: response.data.email
                    }
                })
            }
        },
        mounted() {
            this.getUser()
        }
    }
</script>
<style>
    .input-group{
        margin-bottom: 5px;
    }
</style>