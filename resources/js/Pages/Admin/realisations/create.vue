<template>
  <div>
    <h1>Create Realisation</h1>
    <form @submit.prevent="submitForm">
      <input v-model="form.title" placeholder="Title" />
      <input v-model="form.client" placeholder="Client" />
      <button type="submit">Save</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const form = ref({
  title: '',
  client: '',
});

const submitForm = () => {
  form.value.post(route('admin.realisations.store'));
};
</script>
