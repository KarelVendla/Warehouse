<template>
    <div>
        <h1>Warehouses</h1>
        <button class="btn btn-outline-info m-1" data-toggle="modal" data-target="#AddNewWarehouse" @click="toggleModals('add')">Add Warehouse</button>
        <table class="table-borderless col mx-md-auto">
            <tr>
                <th>Name</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th>Status</th>
                <th></th>
            </tr>
            
            <tr v-for="warehouse in getWarehouses" v-bind:key="warehouse.id" class="align-content-center"> 
                <td>{{ warehouse.name }}</td>
                <td>{{ warehouse.longitude }}</td>
                <td>{{ warehouse.latitude }}</td>
                <td>{{ warehouse.status }}</td>
                <td>   
                    <button v-on:click="toggleModals('details')" @click="setwarehouseID(warehouse.id)" class="btn btn-outline-primary" data-toggle="modal" data-target="#ShowWarehouseDetails" >Details</button>
                </td>
            </tr>
        </table>
        <!--Add warehouse modal-->
        <addwarehouse-modal @getWarehouses="fetchWarehouses()" @toggleModal="toggleModals('add')" v-if="GetToggleAdd"/>

        <!--Warehouse details modal-->
        <warehousedetails-modal @getWarehouses="fetchWarehouses()" @toggleModal="toggleModals('details')" :warehouseID="this.warehouseID" v-if="GetToggleDetail"/>
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
            warehouseID: ''
        };
    },
    mounted() {
        this.fetchWarehouses();
    },
    methods: {
        toggleModals(modal) {
            this.$store.dispatch('TOGGLEMODALS',modal);
        },
        setwarehouseID(id) {
            this.warehouseID = id;
        },
        fetchWarehouses() {
            this.$store.dispatch('GET_WAREHOUSES');
        }
    },
    computed: {
        getWarehouses() {
            return this.$store.getters.GET_WAREHOUSES;
        },
        GetToggleDetail() {
            return this.$store.getters.GET_TOGGLEDETAIL;
        },
        GetToggleAdd() {
            return this.$store.getters.GET_TOGGLEADD;
        }
    }
}
</script>
