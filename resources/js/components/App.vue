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
import warehouses from "./Warehouses.vue";
import location from "./ManagerCoordinates.vue";

export default {
  components: {
    warehouses,
    location
  }
};
</script>
