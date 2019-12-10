<template>
        <div class="modal fade" id="AddNewWarehouse" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Warehouse</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>  
                    </div>
                    <div class="modal-body">
                        <form method="GET">
                            <table class="table">
                                <tr>
                                    <td>Name</td>
                                </tr>
                                <tr>
                                    <td><input v-model="warehouse.name" type="text" class="form-control" placeholder="Name"></td>
                                </tr>
                                <tr>
                                    <td>Longitude</td>
                                </tr>
                                <tr>
                                    <td><input v-model.number="warehouse.longitude" type="number" step="any" class="form-control" placeholder="Longitude"></td>
                                </tr>
                                 <tr>
                                        <td>Latitude</td>
                                </tr>
                                <tr>
                                    <td><input v-model.number="warehouse.latitude" type="number" step="any" class="form-control" placeholder="Latitude"></td>
    
                                </tr>
                                <tr>
                                    <td><input type="submit" @click.prevent="AddWarehouse()" class="btn btn-danger" value="Save" data-dismiss="modal"/></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
export default {
    data() {
        return {
            warehouse: {
                id: '',
                name: '',
                longitude: '',
                latitude: '',
                status: ''
            }
        }
    },
    methods: {
        AddWarehouse() {
            axios.post('api/warehouse', this.$data.warehouse) 
            .then(response => {
                console.log(response);
                this.fetchWarehouses();
                })
                .catch(error => {
                    console.log(error.response);
                });    
            }
    }
}
</script>