export default {
    state: {
        manager: {
            longitude: '',
            latitude: ''
        },
        warehouse: {
            id: '',
            name: '',
            longitude: '',
            latitude: '',
            status: '',
            temperature: ''
        },
        distance: '',
        toggleDetail: false,
        toggleAdd: false,
        rooms: [],
        warehouses: []
    },
    mutations: {
        TOGGLEDETAIL (state) {
            state.toggleDetail = !state.toggleDetail;
        },
        TOGGLEADD (state) {
            state.toggleAdd = !state.toggleAdd;
        },
        SET_MANAGER ({manager}, payload) {
            manager.longitude = payload.longitude;
            manager.latitude = payload.latitude;
        },
        SET_WAREHOUSE ({warehouse}, payload) {
            warehouse.id = payload.id;
            warehouse.name = payload.name;
            warehouse.longitude = payload.longitude;
            warehouse.latitude = payload.latitude;
            warehouse.status = payload.status;
            warehouse.temperature = payload.temperature;
        },
        SET_WAREHOUSES (state, payload) {
            state.warehouses = payload;
        },
        SET_ROOMS (state, payload) {
            state.rooms = payload;
        },
        SET_ROOM (state, payload) {
            console.log(payload);
            state.rooms.push(payload);
        },
        SET_DISTANCE (state, payload) {
            state.distance = payload;
        }
    },
    getters: {
        GET_TOGGLEDETAIL (state) {
            return state.toggleDetail;
        },
        GET_TOGGLEADD (state) {
            return state.toggleAdd;
        },
         GET_MANAGER (state) {
            return state.manager;
        },
        GET_WAREHOUSE (state, getters) {

            state.warehouse.temperature = Math.max.apply(
                null,
                getters.GET_ROOMS.map(function(o) {
                    return o.temperature;
                })
            );

            state.warehouse.status = getStatus(state.warehouse.status,state.warehouse.temperature);

            return state.warehouse;
        },
        GET_WAREHOUSES (state) {
            return state.warehouses;
        },
        GET_ROOMS (state) {
            return state.rooms;
        },
        GET_DISTANCE (state) {
            return state.distance;
        }
    },
    actions: {
        TOGGLEMODALS ({commit}, modal) {
            modal == 'add' ? commit('TOGGLEADD') : commit('TOGGLEDETAIL');
        },
        //MANAGER
        GET_MANAGERLOCATION ({commit}) {
            axios.get('/api/managers')
            .then(response => {
                commit('SET_MANAGER', response.data.data[0]);
                console.log('Manager: Location retrieved');
            })
            .catch( () => {
                console.log('Manager: Failed to retrieve');
            })
        },
        //When empty string entered, state not updated (?)
        UPDATE_MANAGERLOCATION ({state}) {
            axios.put('/api/manager', state.manager)
            .then( () => {
                console.log('Manager: Location updated');
            })
            .catch( () => {
                console.log('Manager: Failed to update');
            })
        },

        //WAREHOUSE

        ADD_WAREHOUSE ({dispatch},payload) {
            axios.post('/api/warehouse', payload)
            .then(response =>{
                console.log(response);
                console.log('Warehouse: New added successfully');
                dispatch('GET_WAREHOUSES');
            })
            .catch(error => {
                console.log(warehouse);
                console.log(error);
                console.log('Warehouse: Failed to add');
            });
        },

        GET_WAREHOUSE ({commit}, id) {
            axios.get('/api/warehouses/' + id)
            .then(response => {
                commit('SET_WAREHOUSE', response.data.data[0]);
                console.log('Warehouse: Retrieved Successfully');
            })
            .catch(error => {
                console.log(error);
                console.log('Warehouse: Failed to retrieve');
            });
        },

        GET_WAREHOUSES ({commit}) {
            axios.get('/api/warehouses')
            .then(response => {
                commit('SET_WAREHOUSES', response.data.data);
                console.log('Warehouse(s): Retrieved successfully');
            })
            .catch(error => {
                console.log(error);
                console.log('Warehouse(s): Failed to retrieve');
            });
        },
        UPDATE_WAREHOUSE ({state}, id) {
            return axios.put('/api/warehouse/' + id, state.warehouse)
            .then(response => {
                console.log('Warehouse: Data updated with', state.warehouse);
                console.log(response);
            })
            .catch(error => {
                console.log('Warehouse: Failed to update');
                console.log(error);
            })
        },

        //ROOM
        ADD_ROOM ({commit}, id) {
            axios.post('api/room', {
                warehouseid: id
            })
            .then(response => {
                console.log(response.data);
                commit('SET_ROOM', response.data.data);
                console.log('Room: Successfully added new');
            })
            .catch(error => {
                console.log(error);
                console.log('Room: Failed to add new');
            });
        },

        GET_ROOMS ({commit}, id) {
            axios.get('/api/rooms/' + id)
            .then(response => {
                commit('SET_ROOMS', response.data.data);
                console.log('Room: Retrieved successfully');
            })
            .catch(error => {
                console.log(error);
                console.log('Room: Failed to retrieve');
            });
        },

        UPDATE_ROOMS ({state}) {
            return axios.put('/api/room', state.rooms)
            .then(response => {
                console.log(response);
                console.log('Room: Data updated with', state.rooms);
            })
            .catch(error => {
                console.log(error);
                console.log(state.rooms);
                console.log('Room: Failed to update data');
            });
        },
        DELETE_ROOM ({dispatch, state},id) {
            return axios.delete('/api/room/' + id)
            .then(response =>{
                console.log(response);
                console.log('Room: Successfully deleted');
                dispatch('GET_ROOMS', state.warehouse.id);
            })
            .catch(error => {
                console.log(id);
                console.log(error);
                console.log('Room: Failed to delete');
            })
        },

        //OPENMAPS
        OPENMAPSDATA({commit}, id) {
            axios.post('/api/openmaps/' + id)
            .then(response => {
                console.log(response);
                commit('SET_DISTANCE', response.data);
                console.log('OpenMaps: Data retrieved')
            })
            .catch(error => {
                console.log(error);
                console.log('OpenMaps: Failed to retrieve');

            })
        }
    }
};

function getStatus (status, temperature) {

    if (temperature >= 100) {
        status = 'HIGH';
    } else if (temperature < 0) {
        status = '-';
    } else if (temperature < 50) {
        status = 'OK';
    } else if (temperature < 100) {
        status = 'MEDIUM';
    }

    return status;
}