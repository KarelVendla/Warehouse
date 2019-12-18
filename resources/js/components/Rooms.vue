<template>
    <div>
        <h1>Rooms</h1>
        <button class="btn btn-outline-info" @click.prevent="AddRoom()">
            Add Room
        </button>
        <form method="GET">
            <table>
                <tr>
                    <th>Name</th>

                    <th>Temperature</th>

                    <th></th>
                </tr>
                <tr v-for="room in roomsData" :key="room.id">
                    <td>
                        <input
                            class="form-control"
                            v-model="room.name"
                            :placeholder="room.name"
                        />
                    </td>
                    <td>
                        <input
                            class="form-control"
                            v-model.number="room.temperature"
                            :placeholder="room.temperature"
                        />
                    </td>
                    <td>
                        <button
                            type="submit"
                            @click.prevent="DeleteRoom(room.id)"
                            class="btn btn-danger">
                            Delete
                        </button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        warehouseData: Object,
        roomsData: Array
    },
    data() {
        return {};
    },
    methods: {
        AddRoom() {
            axios.post("/api/room", {
                    warehouseid: this.warehouseData.id
                })
                .then(response => {
                    console.log(response);
                    this.$emit("getRooms");
                    this.WarehouseTemperature();
                })
                .catch(error => {
                    console.log(this.warehouseData.id);
                    console.log(error.response);
                });
        },
        DeleteRoom(id) {
            axios.delete("/api/room/" + id).then(response => {
                console.log("Successfully deleted");
                this.$emit("getRooms");
            });
        }
    }
};
</script>
