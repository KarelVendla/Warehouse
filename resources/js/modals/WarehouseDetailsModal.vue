<template>
  <div class="modal fade" id="ShowWarehouseDetails" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Warehouse details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>
        <div class="modal-body">
          <detailswarehouse  v-bind:wareHouses="this.warehouseID"/>
          <rooms  v-bind:wareHouses="this.warehouseID"/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import detailswarehouse from '../components/Detailswarehouse';
import rooms from '../components/Rooms';

export default {
  props: {
        wareHouses: {
            type: Number
        }
    },
    components: {
      detailswarehouse,
      rooms
    },
    data() {
      return {
        warehouseID: this.wareHouses
      }
    }
};
</script>