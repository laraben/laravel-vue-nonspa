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
                                <th>Role Name</th>
                                <th style="width:15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(role, index) in roles" :key="role.id" >
                                <td>{{ index + 1 }}</td>
                                <td><app-click-to-edit v-model="role.name" @input="updateRoleName($event, role.id )"></app-click-to-edit></td>
                                <td><button class="btn btn-sm btn-danger" @click="deleteItem(index,role.id)">Delete</button></td>
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
                roles: [],
                postData: {
                    id: '',
                    value: ''
                },
                showModal: false,
            }
        },
        methods: {
            updateRoleName: function(event, id){
                this.postData.id = id;
                this.postData.value = event;

                axios.post('/api/role/update/name', this.postData)
                .then(response => '')
                .catch(error => console.log(error))
            },
            deleteItem: function(index,id){
                this.postData.id = id;
                this.postData.value = null;

                axios.post('/api/role/destroy', this.postData)
                .then(response => this.$delete(this.roles, index))
                .catch(error => console.log(error))

            }

        },
        mounted() {
            axios.get('/api/getroles')
                 .then(response => {
                    this.roles =  response.data;
               }).catch(function (error) {
                    console.log(error);
                });
        },
        components: {
            'app-click-to-edit': Click2Edit
        }

    }
</script>
