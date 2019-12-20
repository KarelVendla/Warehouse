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
                <!--ID becomes undefined when there are no rooms-->
                <tr v-for="room in getRooms" :key="room.id">
                    <td>
                        <input
                            class="form-control"
                            v-model="room.name"
                        />
                    </td>
                    <td>
                        <input
                            class="form-control"
                            v-model.number="room.temperature"
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
    //Pass down as prop or use computed ?
    methods: {
       async AddRoom() {
        await this.$store.dispatch('ADD_ROOM', this.getWarehouse.id);
        },
        DeleteRoom(id) {
            this.$store.dispatch('DELETE_ROOM', id);
        }
    },
    computed: {
        getWarehouse() {
            return this.$store.getters.GET_WAREHOUSE
        },
        getRooms() {
            return this.$store.getters.GET_ROOMS
        }
    }
};
</script>
