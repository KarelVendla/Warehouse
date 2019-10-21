<template>
    <div id="warehouses" class="container">

    <h1>Warehouses</h1>
    <!--TODO: Button for going to warehouse details page-->

    <table class="table-bordered">
        <tr class="thead-dark">
            <th scope="col">Name</th>
            <th scope="col">Longitude</th>
            <th scope="col">Latitude</th>
            <th scope="col">Status</th>
        </tr>
        <tr v-for="(whouse) in warehouse" v-bind:key="whouse.id">
            <td>{{warehouse.name}}</td>
            <td>{{warehouse.longitude}}</td>
            <td>{{warehouse.latitude}}</td>
            <td>{{warehouse.status}}</td>
        </tr>
    </table>
    <br>
    <h1>My Location</h1>
    <form v-on:submit:prevent="addLocation">
    <table class="table">
      <tr>
        <td>Longitude</td>
      </tr>
      <tr>
        <td><input v-model="Managerlng" type="text" id="mlngInput" class="form-control" placeholder="Add longitude"></td>
      </tr>
      <tr>
        <td>Latitude</td>
      </tr>
      <tr>
        <td><input v-model="Managerlat" type="text" id="mlatInput" class="form-control" placeholder="Add latitude"></td>
      </tr>
      <tr>
        <td><button v:on:click="saveLocation()" class="btn btn-danger">Save</button></td>
      </tr>
    </table>
    </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            manager: {
            id: '',
            Managerlng: '',
            Managerlat: ''
            },
        }    
    },

    created() {
        this.fetchWarehouses();
    }
}
</script>