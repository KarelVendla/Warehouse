<template>
  <div class="modal hide fade in" id="ShowWarehouseDetails" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Warehouse details</h4>
          <button type="submit" class="btn btn-outline-primary" @click="SaveAll()" data-dismiss="modal">Save</button>
        </div>
        <div class="modal-body">
          <div v-if="warehouse.temperature >= 100" class="border border-danger">
            <h4 class="text-danger">Status: {{warehouse.status}}<br>Warehouse is {{this.distance}} KM away from your location</h4>
          </div>
          <detailswarehouse v-bind:warehouseData="this.warehouse" />
          <rooms
            v-bind:warehouseData="this.warehouse"
            v-bind:roomsData="this.rooms"
            @getRooms="fetchrooms()"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import detailswarehouse from "../components/Detailswarehouse";
import rooms from "../components/Rooms";

export default {
  props: {
    warehouseID: {
      type: Number
    }
  },
  components: {
    detailswarehouse,
    rooms
  },
  data() {
    return {
      warehouse: {
        id: this.warehouseID,
        name: '',
        longitude: '',
        latitude: '',
        status: '',
        temperature: ''
      },
      rooms: [],
      distance: ''
    };
  },
  mounted() {
    this.fetchrooms();
    this.WarehouseTemperature();
    this.SendMapsData();
  },
  methods: {
    SendMapsData() {
      axios.post('/api/openmaps/' + this.warehouse.id)
        .then(response => {
          console.log(response.data);
          this.distance = response.data;
          console.log('OpenMaps: Data sent to backend')
        })
      .catch(error => {
        console.log(error);
        console.log('OpenMaps: Data could not be sent to backend');
      })
    },
    SaveAll() {
      this.SaveRooms();
      this.SaveWarehouse();
      this.$emit('getWarehouses');
      this.$emit('toggleModal');
    },
    clearWarehouse() {
      this.warehouse.id = '';
      this.warehouse.name = '';
      this.warehouse.longitude = '';
      this.warehouse.latitude = '';
      this.warehouse.status = '';
      this.warehouse.temperature = '';
      console.log('Warehouse: data cleared')
    },
    SaveRooms() {
      axios.put('/api/room', this.rooms)
      .then(response => {
        console.log(response);
        console.log('Rooms: data updated with:', this.rooms);
      })
      .catch(error => {
        console.log(error);
        console.log('Rooms: Failed to update');
      });
    },
    SaveWarehouse() {
      this.WarehouseTemperature();
        axios.put('/api/warehouse/' + this.warehouse.id, this.warehouse)
        .then(response => {
          console.log(response);
          console.log('Warehouse: Data updated with:', this.warehouse);
          })
          .catch(error => {
            console.log(error);
            console.log('Warehouse: Failed to update');
            });
    },
    fetchrooms() {
      fetch('/api/rooms/' + this.warehouse.id)
        .then(response => response.json())
        .then(response => {
          this.rooms = response.data;
          this.WarehouseTemperature();
          console.log('Rooms: Data retrieved');
        })
        .then(response => {
          console.log(response);
        });
    },
    WarehouseTemperature() {
      this.warehouse.temperature = Math.max.apply(
        null,
        this.rooms.map(function(o) {
          return o.temperature;
        })
      );

      this.warehouse.status =
        this.warehouse.temperature >= 100
          ? "HIGH"
          : this.warehouse.temperature < 0
          ? "-"
          : this.warehouse.temperature < 50
          ? "OK"
          : this.warehouse.temperature < 100
          ? "MEDIUM"
          : null;
    }
  }
};
</script>