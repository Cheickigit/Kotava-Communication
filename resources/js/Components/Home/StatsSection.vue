<script setup>
import { computed } from 'vue';
import {
  ArrowUpRight,
  BadgeCheck,
  BookOpen,
  CheckCircle2,
  Rocket,
  Sparkles,
  UsersRound,
  Zap,
} from 'lucide-vue-next';

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

const formatNumber = (value, fallback) => {
  if (value !== undefined && value !== null && Number(value) > 0) {
    return `${value}+`;
  }

  return fallback;
};

const items = computed(() => [
  {
    value: formatNumber(props.stats?.total_realisations, '100+'),
    label: 'Projets réalisés',
    short: 'Branding, digital, contenu, campagnes.',
    icon: CheckCircle2,
    color: 'text-brand-emerald',
    bg: 'bg-brand-emerald',
    glow: 'bg-brand-emerald/20',
  },
  {
    value: formatNumber(props.stats?.total_clients, '360°'),
    label: 'Vision de marque',
    short: 'Une approche globale et cohérente.',
    icon: UsersRound,
    color: 'text-brand-blue',
    bg: 'bg-brand-blue',
    glow: 'bg-brand-blue/20',
  },
  {
    value: formatNumber(props.stats?.total_contenus || props.stats?.contenus_produits, '1000+'),
    label: 'Contenus produits',
    short: 'Visuels, vidéos, supports et campagnes.',
    icon: BookOpen,
    color: 'text-brand-orange',
    bg: 'bg-brand-orange',
    glow: 'bg-brand-orange/20',
  },
  {
    value: '6',
    label: 'Expertises intégrées',
    short: 'Stratégie, design, web, audiovisuel, event, social.',
    icon: Rocket,
    color: 'text-brand-emerald',
    bg: 'bg-brand-emerald',
    glow: 'bg-brand-emerald/20',
  },
]);
</script>

<template>
  <section class="relative isolate overflow-hidden bg-brand-dark py-16 text-white sm:py-20">
    <!-- Background cohérent -->
    <div class="absolute inset-0 bg-grid-dark opacity-35"></div>

    <div class="absolute inset-0 bg-[radial-gradient(circle_at_8%_20%,rgba(16,185,129,0.14),transparent_28%),radial-gradient(circle_at_92%_76%,rgba(249,115,22,0.12),transparent_28%),radial-gradient(circle_at_50%_50%,rgba(30,58,138,0.26),transparent_34%)]"></div>

    <div class="absolute inset-x-0 top-0 h-24 bg-gradient-to-b from-brand-dark to-transparent"></div>
    <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-brand-dark to-transparent"></div>

    <div class="site-container relative z-10">
      <div class="relative overflow-hidden rounded-[2.4rem] border border-white/10 bg-white/[0.055] p-4 shadow-[0_30px_90px_rgba(0,0,0,0.24)] backdrop-blur-2xl sm:p-5 lg:p-6">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_18%,rgba(16,185,129,0.12),transparent_28%),radial-gradient(circle_at_86%_80%,rgba(249,115,22,0.10),transparent_30%)]"></div>

        <div class="absolute -left-20 -top-20 h-72 w-72 rounded-[4rem] bg-brand-emerald/15 blur-3xl"></div>
        <div class="absolute -bottom-24 -right-20 h-80 w-80 rounded-[4rem] bg-brand-orange/15 blur-3xl"></div>

        <div class="relative grid gap-4 lg:grid-cols-[0.75fr_1.25fr] lg:items-stretch">
          <!-- Bloc identité -->
          <div class="relative overflow-hidden rounded-[2rem] border border-white/10 bg-slate-950/70 p-5 backdrop-blur-xl">
            <div class="absolute -right-16 -top-16 h-52 w-52 rounded-[3rem] bg-brand-blue/25 blur-3xl"></div>

            <div class="relative flex h-full flex-col justify-between gap-8">
              <div>
                <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald">
                  <Sparkles :size="14" />
                  Impact KOTAVA
                </div>

                <h2 class="mt-5 text-3xl font-black leading-[0.95] tracking-[-0.05em] text-white sm:text-4xl">
                  Des chiffres qui traduisent une dynamique créative.
                </h2>
              </div>

              <div class="grid grid-cols-2 gap-3">
                <div class="rounded-[1.3rem] border border-white/10 bg-white/[0.07] p-4">
                  <BadgeCheck :size="21" class="text-brand-emerald" />
                  <div class="mt-3 text-sm font-black text-white">
                    Approche claire
                  </div>
                </div>

                <div class="rounded-[1.3rem] border border-white/10 bg-white/[0.07] p-4">
                  <Zap :size="21" class="text-brand-orange" />
                  <div class="mt-3 text-sm font-black text-white">
                    Impact visible
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Stats -->
          <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div
              v-for="item in items"
              :key="item.label"
              class="group relative overflow-hidden rounded-[2rem] border border-white/10 bg-white/[0.07] p-5 backdrop-blur-xl transition duration-300 hover:-translate-y-1 hover:bg-white/[0.10] hover:shadow-[0_24px_70px_rgba(0,0,0,0.22)]"
            >
              <div :class="['absolute -right-12 -top-12 h-36 w-36 rounded-[2.8rem] blur-3xl transition duration-300 group-hover:scale-125', item.glow]"></div>

              <div class="relative">
                <div class="flex items-center justify-between gap-4">
                  <div :class="['flex h-13 w-13 items-center justify-center rounded-2xl text-white shadow-lg', item.bg]">
                    <component :is="item.icon" :size="23" />
                  </div>

                  <ArrowUpRight
                    :size="18"
                    class="text-white/30 transition group-hover:translate-x-1 group-hover:-translate-y-1 group-hover:text-brand-orange"
                  />
                </div>

                <div class="mt-7 text-5xl font-black leading-none tracking-[-0.06em] text-white">
                  {{ item.value }}
                </div>

                <div class="mt-3 text-base font-black text-white">
                  {{ item.label }}
                </div>

                <p class="mt-2 text-sm leading-6 text-white/50">
                  {{ item.short }}
                </p>

                <div class="mt-5 h-1.5 overflow-hidden rounded-full bg-white/10">
                  <div :class="['h-full w-3/4 rounded-full', item.bg]"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
