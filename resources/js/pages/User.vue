<template>
    <div>
        <section v-if="name">
            <h1>Hello {{name}}</h1>
            <router-link :to="{name: 'User'}">Kembali</router-link>
        </section>
        <section v-else>
            <h1>List User</h1>
            <ul>
                <li v-for="user in users">
                    <!-- <router-link :to="profile_uri(user.name)">{{user.name}}</router-link> -->
                    <a href="" @click.prevent="lihatuser(user.name)">{{user.name}}</a>
                </li>
            </ul>    
        </section>
    </div>
</template>
<script>
    export default {
        props: ['name'],
        data() {
            return {
                users: [
                    {id:1, name:'Taqius'},
                    {id:2, name:'Shofi'},
                    {id:3, name:'Albastomi'},
                ]
            }
        },
        methods: {
            profile_uri(name){
                return '/user/'+ name.toLowerCase()
            },
            lihatuser(name){
                // this.$router.push('/user/'+name.toLowerCase())
                this.$router.push({
                    name: 'User',
                    params: {name: name.toLowerCase()}
                })
            }
        }
    }
</script>