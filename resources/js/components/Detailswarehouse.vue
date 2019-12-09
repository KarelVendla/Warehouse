<template>
    <div class="container">
        <div v-if="warehouse.temperature > 100" class="border border-danger">
            <h4 class="text-danger">Status: {{warehouse.status}}<br>
            Warehouse is away from your location</h4>
        </div>
        <h1 >Warehouse</h1>
        <form method="GET">
    
            <table class="table-borderless col mx-md-auto">
    
                <tr>
    
                    <td>
    
                        <input type="submit" @click.prevent="SaveWarehouse()" class="btn btn-danger" value="Save"/>
    
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
    props: {
        wareHouses: {
            type: Number
        }
    },
    data() {
        return {
            url: 'https://routing.openstreetmap.de/routed-car/route/v1/driving/24.7329844855764,59.44288165;26.9726713,59.3572456?overview=false',
            ManagerCoordinates: '',
            Warehouse: '',
            warehouse: {
                id: this.wareHouses,
                name: '',
                longitude: '',
                latitude: ''
            }
        };
    },
    created() {
        this.getLongLatOfManager();
        this.getWarehouse();
    },
    methods: {  
        getLongLatOfManager()  {  

            axios.get('/api/managers/')
                .then(response => {
                    this.ManagerCoordinates = response.data;
                    console.log(response)
                });
        },
        getWarehouse()  {  

            axios.get('/api/warehouses/' + this.warehouse.id)
                .then(response => {
                    this.Warehouse = response.data;
                    console.log(response)
                });
        },
        SaveWarehouse() {
            if(this.warehouse.name.length > 0 || this.warehouse.longitude.length > 0 || this.warehouse.latitude.length > 0) {

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
}
</script>
