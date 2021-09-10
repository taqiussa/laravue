<template>
    <div>
        <section>
            <h1>List User</h1>
            <router-link to='/user/create'>Registrasi</router-link>
            <ul>
                <li v-for="user in users">
                    <!-- <router-link :to="profile_uri(user.name)">{{user.name}}</router-link> -->
                    <a href="" @click.prevent="lihatuser(user.id)">{{user.name}}</a>
                </li>
            </ul>    
        </section>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                users: [],
            }
        },
        mounted() {
            this.getUsers()
            // fetch('/api/users')
            // .then(response => response.json())
            // .then(data => {
            //     this.users = data
            //     console.log(this.users)
            // })
        },
        methods: {
            getUsers() {
                axios.get('/api/users').then((response) => {
                this.users = response.data
                })
            },
            profile_uri(id){
                return '/user/'+ id
            },
            lihatuser(id){
                this.$router.push({
                    name: 'Profile',
                    params: {id: id}
                })
            }
        }
    }
</script>