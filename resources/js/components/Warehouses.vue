<template>
    <div>
        <h1>Warehouses</h1>
        <button type="button" class="btn btn-outline-info m-1" data-toggle="modal" data-target="#addNew">Add Warehouse</button>
        <table class="table-borderless col mx-md-auto">
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
                <td>   
                    <button v-on:click="setwarehouseID(warehouse.id)" @click="toggleComponents" class="btn btn-outline-primary" data-toggle="modal" data-target="#showDetails" >Details</button>
                </td>
            </tr>
        </table>
    
        <!--Add warehouse modal-->
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

        <!--Warehouse details modal-->
        <div class="modal fade" id="showDetails" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Warehouse details</h4>
                    </div>
                    <div class="modal-body" v-if="toggleComponent">
                        <detailswarehouse v-bind:wareHouses="this.warehouseID"/>
                        <rooms v-bind:wareHouses="this.warehouseID"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</template>
<script>

import detailswarehouse from './Detailswarehouse.vue';
import Rooms from './Rooms.vue';

export default {
    components: {
            detailswarehouse,
            Rooms
        },
    data() {
        return {
            toggleComponent: false,
            warehouses: [],
            warehouseID: '',
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
        setwarehouseID(id) {
            this.warehouseID = id;
        },
        toggleComponents() {
            this.toggleComponent = !this.toggleComponent;
        },
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
    }
}
</script>
