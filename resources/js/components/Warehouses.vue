<template>
    <div>
        <h1>Warehouses</h1>
        <button class="btn btn-outline-info m-1" data-toggle="modal" data-target="#AddNewWarehouse">Add Warehouse</button>
        <table class="table-borderless col mx-md-auto">
            <tr>
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
                    <button v-on:click="toggleDetails()" @click="setwarehouseID(warehouse.id)" class="btn btn-outline-primary" data-toggle="modal" data-target="#ShowWarehouseDetails" >Details</button>
                </td>
            </tr>
        </table>
        <!--Add warehouse modal-->
        <addwarehouse-modal/>

        <!--Warehouse details modal-->
        <warehousedetails-modal v-bind:wareHouses="this.warehouseID" v-if="toggleDetail"/>
    </div>
</template>
<script>
import warehousedetailsModal from '../modals/WarehouseDetailsModal.vue';
import addwarehouseModal from '../modals/AddWarehouseModal.vue';

export default {
    components: {
            addwarehouseModal,
            warehousedetailsModal
        },
    data() {
        return {
            toggleDetail: false,
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
    created() {
        this.fetchWarehouses();
    },
    methods: {
        toggleDetails() {
            this.toggleDetail = !this.toggleDetail;
        },
        setwarehouseID(id) {
            this.warehouseID = id;
        },
        fetchWarehouses() {
            fetch('api/warehouses')
                .then(res => res.json())
                .then(res => {
                    this.warehouses = res.data;
                });
        }
    }
}
</script>
