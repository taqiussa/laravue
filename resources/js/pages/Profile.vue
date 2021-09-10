<template>
    <div>
        <section v-if="id">
            <h1>Hello {{detailuser.name}}</h1>
            <h2>Email : {{detailuser.email}}</h2>
            <router-link :to="{name: 'User'}">Kembali</router-link>
            <a href="" @click.prevent="handlingDelete">Hapus</a>
            <router-link :to="{name: 'Edit'}">Edit</router-link>
        </section>
    </div>
</template>
<script>
    export default {
        props: ['id'],
        data() {
            return {
                detailuser: [],
            }
        },
        mounted() {
            this.getUser()
        },
        methods: {
            getUser() {
                axios.get('/api/users/' + this.id).then((response) => {
                this.detailuser = response.data
                })
            },
            handlingDelete() {
                if(confirm('Apakah data ingin dihapus ?')){
                    axios.delete('/api/users/' + this.id).then((response) => {
                        if(response.data.status){
                            this.$noty.warning(response.data.message)
                            this.$router.push({
                                name: 'User'
                            })
                        }
                    })
                } else {
                    false
                }
            }
        }
    }
</script>