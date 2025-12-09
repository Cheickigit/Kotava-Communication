<template>
  <div>
    <h2>Liste des Utilisateurs</h2>
    <table>
      <thead>
        <tr>
          <th>Nom</th>
          <th>Email</th>
          <th>Rôle</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id">
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.role }}</td>
          <td><button @click="editUser(user.id)">Modifier</button></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    users: Array,
  },
  methods: {
    editUser(userId) {
      // Logique pour éditer l'utilisateur, comme ouvrir un formulaire de modification
      console.log('Modifier l\'utilisateur', userId);
    },
  },
};
</script>
