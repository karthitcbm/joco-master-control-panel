<template>
   <div class="menu-container"> 
    <v-tabs>
    <v-tab>Vehicle Assignment Control</v-tab>
    <v-tab>Inventory & Quality Control</v-tab>
    <v-tab>Ticketing Platform</v-tab>
  </v-tabs>
   </div>
</template>

<script>
  export default {
    data: () => ({ value: 'recent' }),
  }
</script>
<style scoped>
.v-item-group.v-bottom-navigation {
  box-shadow: none !important;
}
.menu-container {
  width: 100%;
  margin: 0px auto;
}
</style>