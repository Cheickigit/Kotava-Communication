<script setup>
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/GuestLayout.vue';

const services = [
  {
    title: 'Stratégie & Conseil',
    description: 'Audit de marque, stratégie marketing digitale et positionnement de marque',
    icon: 'target',
    features: [
      'Audit de marque complet',
      'Stratégie marketing digitale',
      'Positionnement de marque',
      'Analyse concurrentielle'
    ]
  },
  {
    title: 'Branding & Design',
    description: 'Identité visuelle complète, logo et charte graphique premium',
    icon: 'palette',
    features: [
      'Création de logo',
      'Charte graphique',
      'Identité visuelle',
      'Design print et digital'
    ]
  },
  {
    title: 'Digital & Web',
    description: 'Sites web vitrine et e-commerce, UX/UI design optimisé',
    icon: 'globe',
    features: [
      'Sites web sur mesure',
      'E-commerce',
      'UX/UI Design',
      'Applications web'
    ]
  },
  {
    title: 'Production Audiovisuel',
    description: 'Tournage vidéo, photographie et motion design professionnel',
    icon: 'video',
    features: [
      'Vidéos corporate',
      'Photographie professionnelle',
      'Motion design',
      'Montage vidéo'
    ]
  },
  {
    title: 'Événementiel & RP',
    description: 'Organisation d\'événements et stratégie d\'influence',
    icon: 'calendar',
    features: [
      'Organisation d\'événements',
      'Relations publiques',
      'Stratégie d\'influence',
      'Gestion de crise'
    ]
  },
  {
    title: 'Social Media & Contenu',
    description: 'Gestion réseaux sociaux et campagnes publicitaires ciblées',
    icon: 'megaphone',
    features: [
      'Gestion des réseaux sociaux',
      'Création de contenu',
      'Campagnes publicitaires',
      'Community management'
    ]
  }
];
</script>

<template>
  <Head title="Nos Services - KOTAVA Communication" />

  <MainLayout>
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-teal-600 to-emerald-600 py-20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
          Nos Services <span class="text-emerald-200">Premium</span>
        </h1>
        <p class="text-xl text-white/90 max-w-3xl mx-auto">
          Une gamme complète de solutions pour propulser votre marque vers l'excellence digitale
        </p>
      </div>
    </section>

    <!-- Services Grid -->
    <section class="py-20 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div
            v-for="service in services"
            :key="service.title"
            class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2"
          >
            <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-teal-600 to-emerald-600 flex items-center justify-center mb-6">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
              </svg>
            </div>

            <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ service.title }}</h3>
            <p class="text-gray-600 mb-6">{{ service.description }}</p>

            <ul class="space-y-2">
              <li v-for="feature in service.features" :key="feature" class="flex items-center text-gray-700">
                <svg class="w-5 h-5 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ feature }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
  </MainLayout>
</template>
