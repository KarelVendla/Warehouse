<template>
  <div class="container">
    <div id="warehouses">
      <warehouses />
    </div>
    <div id="ManagerCoordinates">
      <location />
    </div>
  </div>
</template>

<script>
import Warehouses from "./Warehouses.vue";
import location from "./ManagerCoordinates.vue";

export default {
  components: {
    Warehouses,
    location
  }
};
</script>
