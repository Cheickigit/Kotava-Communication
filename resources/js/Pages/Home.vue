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

const seoDescription =
  'KOTAVA Communication est une agence de communication spécialisée en stratégie, branding, design, digital, production audiovisuelle, événementiel, relations publiques et social media.';
</script>

<template>
  <GuestLayout>
    <Head title="KOTAVA Communication — Agence de communication, branding et digital">
      <meta name="description" :content="seoDescription" />
      <meta
        name="keywords"
        content="KOTAVA Communication, agence de communication, branding, design, stratégie de communication, digital, audiovisuel, social media, événementiel, relations publiques, agence créative"
      />
      <meta property="og:title" content="KOTAVA Communication — Agence de communication, branding et digital" />
      <meta property="og:description" :content="seoDescription" />
      <meta property="og:image" content="/logo.png" />
      <meta name="twitter:image" content="/logo.png" />
    </Head>

    <HeroSection />

    <StatsSection
      :stats="stats"
      :realisations="realisations"
      :actualites="actualites"
    />

    <ServicesShowcase />

    <StudioLiveSection />

    <PortfolioSection :realisations="realisations" />

    <BlogSection :actualites="actualites" />

    <FinalCtaSection />
  </GuestLayout>
</template>
