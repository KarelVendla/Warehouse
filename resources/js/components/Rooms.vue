<template>
    <div>
    
        <button class="btn btn-outline-info" data-toggle="modal" data-target="#addNew">Add Room</button>
    
        <table>  
            <tr>
                <th>Name</th>
    
                <th>Temperature</th>
    
                <th></th>
            </tr>
            <tr class="" v-for="room in WarehouseRooms" v-bind:key="room.id">
                <td>{{room.name}}</td>
                <td>{{room.temperature}}</td>
                <td><button type="submit" @click.prevent="DeleteRoom(room.id)" class="btn btn-danger">Delete</button></td> 
            </tr>
        </table>
    
    
    
        <div class="modal fade" id="addNew" role="dialog">
    
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
                                    <td><input type="submit" @click.prevent="AddRoom()" class="btn btn-primary" value="Save"/></td>
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
    data() {
        return {
            rooms: [],
            room: {
                id: '',
                name: '',
                temperature: '',
                warehouseid: this.$route.params.warehouseID
            },
            warehouse: {
                warehouseStatus: '',
                warehouseID: this.$route.params.warehouseID
            }
        }
    },
    created() {
        this.fetchrooms();
        this.WarehouseStatus();
    },
    methods: {
        fetchrooms() {
            fetch('/api/rooms')
                .then(res => res.json())
                .then(res => {
                    this.rooms = res.data;
                });
        },

        AddRoom() {
            axios.post('/api/room', this.$data.room)
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.log(error.response)
                });
        },
        DeleteRoom(id) {
            axios.delete('/api/room/' + id)
                .then(response => {
                    alert('Room deleted')
                    console.log("Successfully deleted")
                });
        },
        WarehouseStatus() {


            //Return max temperature of object, if the objects warehouseid == warehouseID 

            //Returns infinity
            var maxTemp = Math.max.apply(Math,this.rooms.map(function(o){return o.temperature;}))

            console.log(maxTemp);

            //If maxTemp ... set warehouseStatus
            if (maxTemp >= 100) {
                this.$data.warehouse.warehouseStatus = "HIGH";
                console.log('status HiGH');
            } else if (maxTemp >= 55) {
                this.$data.warehouse.warehouseStatus = "MEDIUM";
                console.log('status MEDIUM');
                
            } else if (maxTemp < 55) {
                this.$data.warehouse.warehouseStatus = "OK";
                console.log('status OK');
                
            }
        }

    },
    computed: {

        //Return rooms that have warehouseid == warehouseID
        WarehouseRooms: function() {
            var WRooms = this.rooms.filter(room => room.warehouseid == this.warehouse.warehouseID);
            return WRooms;

        }
    }
}
</script>