<template>
    <div class="row">
        <div class="col-md-10 offset-1">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in users" :key="user.id" >
                                <td>{{ user.id }}</td>
                                <td><app-click-to-edit v-model="user.name" @input="updateName($event, user.id )"></app-click-to-edit></td>
                                <td><app-click-to-edit v-model="user.email" @input="updateEmail($event, user.id )"></app-click-to-edit></td>
                                <td>{{ user.roles[0] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Click2Edit from './Molecules/Click2Edit'
    export default {

        data() {
            return {
                users: [],
                postData: {
                    id: '',
                    row: '',
                    value: ''
                }
            }
        },
        methods: {
            updateName: function(event, id){
                this.postData.id = id;
                this.postData.value = event;

                axios.post('api/user/update/name', this.postData)
                .then(response => '')
                .catch(error => console.log(error))
            },
            updateEmail: function(event, id){
                this.postData.id = id;
                this.postData.value = event;

                axios.post('api/user/update/email', this.postData)
                .then(response => '')
                .catch(error => console.log(error))
            }

        },
        mounted() {
            axios.get('api/getusers')
                 .then(response => {
                    this.users =  response.data;
               }).catch(function (error) {
                    console.log(error);
                });
        },
        components: {
            'app-click-to-edit': Click2Edit
        }

    }
</script>
