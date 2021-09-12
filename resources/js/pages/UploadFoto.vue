<template>
    <div>
        <h3>
            Upload Photo
        </h3>
        <img :src="previewimg" width="100">
        <div class="input-group">
            <input type="file" name="foto" @change="upload">
        </div>
        <button @click.prevent="submit">Upload</button>
    </div>
</template>
<script>
export default {
    props:['id'],
    data() {
        return {
            previewimg: null,
            foto: null
        }
    },
    methods: {
        upload(event) {
            let files = event.target.files[0]
            this.previewimg = URL.createObjectURL(files)
            this.foto = files
        },
        submit() {
            let formData = new FormData()
            formData.append('foto', this.foto)
            axios.post('/api/users/foto/' +this.id, formData).then((response) => {
                if(response.data.status){
                    this.$noty.success(response.data.message)
                    this.$router.push({
                    name: 'Profile',
                    params: {id: this.id}
                    })
                }
            })
        }
    }
}
</script>