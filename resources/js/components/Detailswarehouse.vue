<template>
    <div>
    
        <h1>Warehouse</h1>
        <form method="GET">
    
            <table class="table">
    
                <tr>
    
                    <td>
    
                        <input type="submit" @click.prevent="saveWarehouse()" class="btn btn-danger" value="Save"/>
    
                    </td>
    
                </tr>
    
                <tr>
    
                    <td>Name</td>
                </tr>
    
                <tr>
    
                    <td>
    
                        <input v-model="warehouse.name" type="text" class="form-control" placeholder="Name" />
    
                    </td>
    
                </tr>
    
                <tr>
    
                    <td>Longitude</td>
    
                </tr>
    
                <tr>
    
                    <td>
    
                        <input v-model.number="warehouse.longitude" type="number" step="any" class="form-control" placeholder="Longitude" />
    
                    </td>
    
                </tr>
    
                <tr>
    
                    <td>Latitude</td>
    
                </tr>
    
                <tr>
    
                    <td>
    
                        <input v-model.number="warehouse.latitude" type="number" step="any" class="form-control" placeholder="Latitude" />
    
                    </td>
    
                </tr>
    
            </table>
    
        </form>
    
    </div>
</template>

<script>
export default {
    data() {
        return {
            warehouses: [],
            warehouse: {
                id: this.$route.params.warehouseID,
                name: '',
                longitude: '',
                latitude: ''
            }
        };
    },
    methods: {
        saveWarehouse() {
            axios.put('/api/warehouse/' + this.warehouse.id, this.warehouse)
                .then(response => {
                    alert('Warehouse updated')
                    console.log(response);
                })
                .catch(error => {
                    console.log(error.response)
                });
        } 
    }
}
</script>
