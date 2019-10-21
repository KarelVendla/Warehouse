<template>
    <div id="detailswarehouse" class="container">

    <h1>Warehouse</h1>
    <form v-on:submit:prevent="addWarehouse">
    <table class="table">
      <tr>
        <td><button v:on:click="saveWarehouse()" class="btn btn-danger">Save</button></td>
      </tr>
      <tr>
        <td>Name</td>
      </tr>
      <tr>
        <td><input v-model="wname" type="text" id="wnameinput" class="form-control" placeholder="Name"></td>
      </tr>
        <tr>
        <td>Longitude</td>
      </tr>
      <tr>
        <td><input v-model="wlng" type="text" id="wlonginput" class="form-control" placeholder="Longitude"></td>
      </tr>
      <tr>
        <td>Latitude</td>
      </tr>
      <tr>
        <td><input v-model="wlat" type="text" id="wlatinput" class="form-control" placeholder="Latitude"></td>
      </tr>
    </table>
    </form>

    <br>
    
    <table>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Temperature</th>
            <th scope="col"></th>
        </tr>
        <tr v-for="(room) in Rooms" v-bind:key="room.id">
            <td>{{warehouse.name}}</td>
            <td>{{warehouse.temperature}}</td>
            <td><button v:on:click="deleteRoom()" class="btn btn-danger">Delete</button></td>
        </tr>
    </table>


    </div>
</template>

<script>
export default {
    
}
</script>