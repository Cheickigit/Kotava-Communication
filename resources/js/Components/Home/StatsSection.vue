<script setup>
import { computed } from 'vue';
import { CheckCircle2, UsersRound, BookOpen, Rocket } from 'lucide-vue-next';

const props = defineProps({
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

const items = computed(() => [
  {
    value: props.stats?.total_realisations ? `${props.stats.total_realisations}+` : `${props.realisations.length}+`,
    label: 'Projets',
    icon: CheckCircle2,
  },
  {
    value: props.stats?.total_clients ? `${props.stats.total_clients}+` : '360°',
    label: 'Marques',
    icon: UsersRound,
  },
  {
    value: props.stats?.total_actualites ? `${props.stats.total_actualites}+` : `${props.actualites.length}+`,
    label: 'Contenus',
    icon: BookOpen,
  },
  {
    value: '6',
    label: 'Expertises',
    icon: Rocket,
  },
]);
</script>

<template>
  <section class="relative bg-brand-dark py-16 text-white">
    <div class="absolute inset-0 opacity-[0.07] bg-grid-soft"></div>

    <div class="site-container relative">
      <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div
          v-for="item in items"
          :key="item.label"
          class="rounded-2xl border border-white/10 bg-white/[0.06] p-5 backdrop-blur"
        >
          <component :is="item.icon" :size="24" class="text-brand-emerald" />
          <div class="mt-5 text-4xl font-black text-white">{{ item.value }}</div>
          <div class="mt-1 text-sm font-semibold text-white/55">{{ item.label }}</div>
        </div>
      </div>
    </div>
  </section>
</template>
