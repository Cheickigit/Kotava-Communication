<template>
  <div>
    <h1>Realisation Details</h1>
    <div>
      <p><strong>Title:</strong> {{ realisation.title }}</p>
      <p><strong>Client:</strong> {{ realisation.client }}</p>
      <p><strong>Sector:</strong> {{ realisation.sector }}</p>
      <p><strong>Country:</strong> {{ realisation.country }}</p>
      <p><strong>Type:</strong> {{ realisation.type }}</p>
      <p><strong>Completion Date:</strong> {{ realisation.completion_date }}</p>
      <p><strong>Description:</strong> {{ realisation.description }}</p>
      <p><strong>Results:</strong> {{ realisation.results }}</p>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';

defineProps({
  realisation: Object,
});
</script>

<style scoped>
/* Style spécifique pour ce composant */
</style>
