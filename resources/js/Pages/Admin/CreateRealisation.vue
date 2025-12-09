<template>
  <div>
    <h1>Liste des réalisations</h1>
    <a href="/admin/realisations/create">Ajouter une nouvelle réalisation</a>
    <table>
      <thead>
        <tr>
          <th>Titre</th>
          <th>Client</th>
          <th>Statut</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="realisation in realisations" :key="realisation.id">
          <td>{{ realisation.title }}</td>
          <td>{{ realisation.client }}</td>
          <td>{{ realisation.published ? 'Publié' : 'Brouillon' }}</td>
          <td>
            <a :href="`/admin/realisations/${realisation.id}/edit`">Modifier</a>
            <button @click="deleteRealisation(realisation.id)">Supprimer</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    realisations: Array
  },
  methods: {
    deleteRealisation(id) {
      if (confirm("Êtes-vous sûr de vouloir supprimer cette réalisation ?")) {
        this.$inertia.delete(`/admin/realisations/${id}`);
      }
    }
  }
};
</script>
