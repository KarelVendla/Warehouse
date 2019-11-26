<template>
    <div>
        <h1>Warehouses</h1>
        <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#addNew">Add Warehouse</button>
        <table class="table-borderless col mx-md-n3">
            <tr class="">
                <th>Name</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th>Status</th>
                <th></th>
            </tr>
            <tr v-for="warehouse in warehouses" v-bind:key="warehouse.id" class="align-content-center">
                <td>{{ warehouse.name }}</td>
                <td>{{ warehouse.longitude }}</td>
                <td>{{ warehouse.latitude }}</td>
                <td>{{ warehouse.status }}</td>
                <td><router-link :to="'/details/' + warehouse.id">Details</router-link></td>
            </tr>
        </table>
    
        <!--Modal-->
        <div class="modal fade" id="addNew" role="dialog">
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
    
    </div>
</template>

<script>
export default {
    data() {
        return {
            isHidden: 'true',
            warehouses: [],
            warehouse: {
                id: '',
                name: '',
                longitude: '',
                latitude: '',
                status: ''
            }
        };
    },
    //Do something when component is created
    created() {
        this.fetchWarehouses();

    },

    methods: {
        fetchWarehouses() {
            fetch('api/warehouses')
                .then(res => res.json())
                .then(res => {
                    this.warehouses = res.data;
                });
        },
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
    },
    computed: {
        Warning: function() {
            var Temp = this.warehouses.filter(warehouse => warehouse.status == 'HIGH');
            this.isHidden = 'false';
            
        }
    },
};
</script>
