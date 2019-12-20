<template>
    <div id="manager" class="container">
        <h1>My Location</h1>
        <form method="GET">
    
            <table class="table">
                <tr>
    
                    <td>Longitude</td>
                </tr>
    
                <tr>
    
                    <td><input v-model.number="getManager.longitude" type="number" step="any" class="form-control" placeholder="Add longitude"></td>
    
                </tr>
    
                <tr>
    
                    <td>Latitude</td>
    
                </tr>
    
                <tr>
    
                    <td><input v-model.number="getManager.latitude" type="number" step="any" class="form-control" placeholder="Add latitude"></td>
    
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
    mounted() {
        this.fetchLocation();
    },
    methods: {
        saveLocation() {
            this.$store.dispatch('UPDATE_MANAGERLOCATION');
        },
        fetchLocation() {
            this.$store.dispatch('GET_MANAGERLOCATION')
        },
    },
    computed: {
        getManager() {
            return this.$store.getters.GET_MANAGER
        }
    }
}
</script>
