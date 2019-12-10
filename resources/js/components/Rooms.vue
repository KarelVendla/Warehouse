<template>
    <div>
        <h1>Rooms</h1>
        <button class="btn btn-outline-info" data-toggle="modal" data-target="#addNewRoom">Add Room</button>
    
        <table>  
            <tr>
                <th>Name</th>
    
                <th>Temperature</th>
    
                <th></th>
            </tr>
            <tr v-for="room in rooms" v-bind:key="room.id">
                <td>{{room.name}}</td>
                <td class="text-center">{{room.temperature}}</td>
                <td><button type="submit" @click.prevent="DeleteRoom(room.id)" class="btn btn-danger">Delete</button></td> 
            </tr>
        </table>

        <div class="modal fade" id="addNewRoom" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Room</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form method="GET">
                            <table class="table">
                                <tr>
                                    <td>Name</td>
                                </tr>
                                <tr>
                                    <td><input v-model="room.name" type="text" class="form-control" placeholder="Name"></td>
                                </tr>
                                <tr>
                                    <td><input type="submit" @click.prevent="AddRoom()" class="btn btn-primary" value="Save" data-dismiss="modal"/></td>
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
    props: {
        wareHouses: {
            type: Number
        }
    },
    data() {
        return {
            rooms: [],
            room: {
                id: '',
                name: '',
                temperature: '',
                warehouseid: this.wareHouses
            },
            warehouse: {
                id: this.wareHouses,
                name: '',
                longitude: '',
                latitude: '',
                status: '',
                temperature: ''
            }
        };
    },
    created() {
        this.fetchrooms();
    },
    methods: {
        fetchrooms() {
            fetch('/api/rooms/' + this.warehouse.id)
                .then(response => response.json())
                .then(response => {
                    this.rooms = response.data;
                    this.SetWarehouseTemperature();
                })
                .then(response => {
                    console.log(response);
                })
        },
        AddRoom() {
            axios.post('/api/room', this.$data.room)
                .then(response => {
                    console.log(response);
                    this.fetchrooms();
                    this.SetWarehouseTemperature();
                    this.room.name = '';
                })
                .catch(error => {
                    console.log(error.response);
                });
        },
        DeleteRoom(id) {
            axios.delete('/api/room/' + id)
                .then(response => {
                    this.fetchrooms();
                    this.SetWarehouseTemperature();
                    console.log("Successfully deleted")
                });
        },
        WarehouseTemperature() {
            this.warehouse.temperature = Math.max.apply(
                null,this.rooms.map(
                    function(o)
                    {return o.temperature;}));

            this.warehouse.status = this.warehouse.temperature >= 100 ? "HIGH"
                                        : this.warehouse.temperature < 0 ? '-'
                                        : this.warehouse.temperature < 50 ? "OK"
                                        : this.warehouse.temperature < 100 ? "MEDIUM" : null;
        },
        SetWarehouseTemperature()  {  
            
            this.WarehouseTemperature();

            axios.put('/api/warehouse/' + this.warehouse.id, this.warehouse)
                .then(response => {
                    console.log(response)
                });

        }
    }
}
</script>