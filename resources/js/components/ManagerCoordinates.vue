<template>
    <div id="manager" class="container">
    
        <h1>My Location</h1>
        <form method="GET">
    
            <table class="table">
                <tr>
    
                    <td>Longitude</td>
                </tr>
    
                <tr>
    
                    <td><input v-model.number="manager.longitude" type="number" step="any" class="form-control" placeholder="Add longitude"></td>
    
                </tr>
    
                <tr>
    
                    <td>Latitude</td>
    
                </tr>
    
                <tr>
    
                    <td><input v-model.number="manager.latitude" type="number" step="any" class="form-control" placeholder="Add latitude"></td>
    
                </tr>
    
                <tr>
    
                    <td><input  type="submit" @click.prevent="saveLocation()" class="btn btn-danger"/></td>
    
                </tr>
    
            </table>
    
        </form>
    
    </div>
</template>

<script>
export default {
    data() {
        return {
            managers: [],
            manager: {
                longitude: '',
                latitude: ''
            }
        };
    },
    methods: {
        saveLocation() {
            axios.put('/api/manager', this.$data.manager)
                .then(response => {
                    alert('Location updated')
                    console.log(response);


                    this.manager.longitude = '';
                    this.manager.latitude = '';
                })
                .catch(error => {
                    console.log(error.response)
                });
        }
    }

}
</script>
