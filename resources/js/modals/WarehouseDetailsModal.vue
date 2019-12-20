<template>
  <div class="modal hide fade in" id="ShowWarehouseDetails" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Warehouse details</h4>
          <button type="submit" class="btn btn-outline-primary" @click="SaveAll()" data-dismiss="modal">Save</button>
        </div>
        <div class="modal-body">
          <div v-if="getWarehouse.temperature >= 100" class="border border-danger">
            <h4 class="text-danger">Status: {{getWarehouse.status}}<br>Warehouse is {{this.getDistance}} KM away from your location</h4>
          </div>
          <detailswarehouse/>
          <rooms
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
  mounted() {
    this.fetchData();
    this.SendMapsData();
  },
  methods: {
    async fetchData() {
      await this.fetchWarehouse();
      this.fetchrooms();

    },
    fetchrooms() {
      this.$store.dispatch('GET_ROOMS', this.warehouseID);
    },
    fetchWarehouse() {
      this.$store.dispatch('GET_WAREHOUSE', this.warehouseID)
    },
    SaveWarehouse() {
      return this.$store.dispatch('UPDATE_WAREHOUSE', this.warehouseID);
    },
    SaveRooms() {
      return this.$store.dispatch('UPDATE_ROOMS');
    },
    SendMapsData() {
      this.$store.dispatch('OPENMAPSDATA', this.warehouseID);
    },
    async SaveAll() {
      await this.SaveRooms();
      await this.SaveWarehouse();
      this.$store.dispatch('GET_WAREHOUSES');
      this.$emit('toggleModal');
    }
  },
  computed: {
    getWarehouse() {
      return this.$store.getters.GET_WAREHOUSE
      },
    getRooms() {
      return this.$store.getters.GET_ROOMS
    },
    getDistance() {
      return this.$store.getters.GET_DISTANCE
    }
  }
};
</script>