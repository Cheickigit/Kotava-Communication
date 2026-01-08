<template>
  <div>
    <h1>Edit Realisation</h1>

    <form @submit.prevent="submitForm">
      <div>
        <label for="title">Title</label>
        <input type="text" v-model="realisation.title" id="title" required />
      </div>

      <div>
        <label for="client">Client</label>
        <input type="text" v-model="realisation.client" id="client" required />
      </div>

      <div>
        <label for="sector">Sector</label>
        <input type="text" v-model="realisation.sector" id="sector" required />
      </div>

      <div>
        <label for="country">Country</label>
        <input type="text" v-model="realisation.country" id="country" required />
      </div>

      <div>
        <label for="type">Type</label>
        <input type="text" v-model="realisation.type" id="type" required />
      </div>

      <div>
        <label for="completion_date">Completion Date</label>
        <input type="date" v-model="realisation.completion_date" id="completion_date" required />
      </div>

      <div>
        <label for="summary">Summary</label>
        <textarea v-model="realisation.summary" id="summary" required></textarea>
      </div>

      <div>
        <label for="description">Description</label>
        <textarea v-model="realisation.description" id="description" required></textarea>
      </div>

      <div>
        <label for="context">Context</label>
        <textarea v-model="realisation.context" id="context" required></textarea>
      </div>

      <div>
        <label for="solution">Solution</label>
        <textarea v-model="realisation.solution" id="solution" required></textarea>
      </div>

      <div>
        <label for="results">Results</label>
        <textarea v-model="realisation.results" id="results" required></textarea>
      </div>

      <button type="submit">Save</button>
    </form>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

// Props: realisation passed from the controller
const props = defineProps({
  realisation: Object,
});

// Setting up the form data
const realisation = ref({ ...props.realisation });

// Inertia form handling
const { post } = useForm();

const submitForm = () => {
  post(route('admin.realisations.update', realisation.value.id), {
    data: realisation.value,
    onSuccess: () => {
      // Handle success (e.g., redirect or show success message)
    },
  });
};
</script>

<style scoped>
/* Your custom styles */
</style>
