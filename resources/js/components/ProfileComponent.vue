<template>
    <div class="card">
        <div class="card-header">User's Information</div>
        <div class="card-body">
            <div class="alert alert-info" role="alert">
                Name : {{ name }}<br>
                Email : {{ email }}
            </div>
            <div v-if="$can('edit posts')">You can edit posts.</div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                name: '',
                email: '',
            }
        },

        mounted() {
            axios.get('/api/user')
                 .then(response => {
                    this.name = response.data.name;
                    this.email = response.data.email;
               }).catch(function (error) {
                    console.log(error);
                });

        }

    }
</script>
