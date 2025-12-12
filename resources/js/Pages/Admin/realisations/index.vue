<template>
  <div>
    <h1>Realisations</h1>
    <div v-for="realisation in realisations" :key="realisation.id">
      <div>{{ realisation.title }}</div>
      <div>{{ realisation.client }}</div>
      <Link :href="route('admin.realisations.edit', realisation.id)">Edit</Link>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';

defineProps({
  realisations: Array,
});
</script>
