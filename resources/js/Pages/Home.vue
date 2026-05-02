<script setup>
import { Head } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

import HeroSection from '@/Components/Home/HeroSection.vue';
import StatsSection from '@/Components/Home/StatsSection.vue';
import ServicesShowcase from '@/Components/Home/ServicesShowcase.vue';
import StudioLiveSection from '@/Components/Home/StudioLiveSection.vue';
import PortfolioSection from '@/Components/Home/PortfolioSection.vue';
import BlogSection from '@/Components/Home/BlogSection.vue';
import FinalCtaSection from '@/Components/Home/FinalCtaSection.vue';

defineProps({
  realisations: {
    type: Array,
    default: () => [],
  },
  actualites: {
    type: Array,
    default: () => [],
  },
  stats: {
    type: Object,
    default: () => ({}),
  },
});

const pageTitle = 'KOTAVA Communication — Agence de communication, branding et digital';

const seoDescription =
  'KOTAVA Communication est une agence de communication basée à Cotonou, spécialisée en stratégie, branding, design, digital, production audiovisuelle, événementiel, relations publiques et social media.';

const seoKeywords =
  'KOTAVA Communication, agence de communication Bénin, agence communication Cotonou, branding, design graphique, stratégie de communication, marketing digital, production audiovisuelle, événementiel, relations publiques, social media, agence créative, identité visuelle, création de contenu, communication digitale';

const siteUrl = 'https://www.kotavacom.com';
const ogImage = '/logo.png';
</script>

<template>
  <GuestLayout>
    <Head :title="pageTitle">
      <meta name="description" :content="seoDescription" />
      <meta name="keywords" :content="seoKeywords" />
      <meta name="author" content="KOTAVA Communication" />
      <meta name="robots" content="index, follow" />
      <meta name="language" content="fr" />
      <meta name="theme-color" content="#1E3A8A" />

      <link rel="canonical" :href="siteUrl" />

      <meta property="og:type" content="website" />
      <meta property="og:locale" content="fr_FR" />
      <meta property="og:site_name" content="KOTAVA Communication" />
      <meta property="og:url" :content="siteUrl" />
      <meta property="og:title" :content="pageTitle" />
      <meta property="og:description" :content="seoDescription" />
      <meta property="og:image" :content="ogImage" />

      <meta name="twitter:card" content="summary_large_image" />
      <meta name="twitter:title" :content="pageTitle" />
      <meta name="twitter:description" :content="seoDescription" />
      <meta name="twitter:image" :content="ogImage" />
    </Head>

    <main class="relative overflow-hidden bg-brand-dark">
      <HeroSection />

      <StatsSection
        :stats="stats"
        :realisations="realisations"
        :actualites="actualites"
      />

      <ServicesShowcase />

      

      <PortfolioSection :realisations="realisations" />

      <BlogSection :actualites="actualites" />

      <FinalCtaSection />
    </main>
  </GuestLayout>
</template>
