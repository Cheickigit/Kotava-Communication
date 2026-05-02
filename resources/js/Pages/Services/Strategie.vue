<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/GuestLayout.vue';
import {
  ArrowLeft,
  ArrowRight,
  ArrowUpRight,
  BarChart3,
  CheckCircle2,
  ClipboardList,
  Compass,
  FileText,
  Flag,
  Lightbulb,
  Mail,
  Map,
  MessageCircle,
  Phone,
  PieChart,
  Search,
  Sparkles,
  Target,
  TrendingUp,
  UsersRound,
} from 'lucide-vue-next';

defineOptions({ layout: MainLayout });

const contactEmail = 'Contact@kotavacom.com';
const contactPhoneDisplay = '+229 93 37 49 63';
const contactPhoneHref = 'tel:+22993374963';

const activeZone = ref(0);
let intervalId = null;

const zones = [
  {
    title: 'Marché',
    label: 'Comprendre le terrain',
    icon: Search,
    x: 'left-[12%]',
    y: 'top-[20%]',
    color: 'text-brand-emerald',
    bg: 'bg-brand-emerald',
  },
  {
    title: 'Marque',
    label: 'Clarifier l’identité',
    icon: Target,
    x: 'right-[14%]',
    y: 'top-[24%]',
    color: 'text-brand-orange',
    bg: 'bg-brand-orange',
  },
  {
    title: 'Audience',
    label: 'Identifier les bonnes cibles',
    icon: UsersRound,
    x: 'left-[10%]',
    y: 'bottom-[22%]',
    color: 'text-brand-blue',
    bg: 'bg-brand-blue',
  },
  {
    title: 'Message',
    label: 'Structurer le discours',
    icon: MessageCircle,
    x: 'right-[12%]',
    y: 'bottom-[20%]',
    color: 'text-brand-emerald',
    bg: 'bg-brand-emerald',
  },
];

const activeItem = computed(() => zones[activeZone.value] || zones[0]);

const modules = [
  {
    title: 'Audit stratégique',
    label: 'État des lieux',
    icon: Search,
    visual: 'audit',
    items: ['SWOT', 'Benchmark', 'Diagnostic'],
  },
  {
    title: 'Positionnement',
    label: 'Territoire de marque',
    icon: Target,
    visual: 'position',
    items: ['Promesse', 'Différence', 'Cibles'],
  },
  {
    title: 'Plan d’action',
    label: 'Roadmap claire',
    icon: ClipboardList,
    visual: 'roadmap',
    items: ['Priorités', 'Canaux', 'Actions'],
  },
  {
    title: 'Stratégie digitale',
    label: 'Présence cohérente',
    icon: PieChart,
    visual: 'digital',
    items: ['Contenus', 'Réseaux', 'Campagnes'],
  },
  {
    title: 'Conseil croissance',
    label: 'Leviers business',
    icon: TrendingUp,
    visual: 'growth',
    items: ['Acquisition', 'Conversion', 'Fidélisation'],
  },
  {
    title: 'Pilotage KPI',
    label: 'Mesure & décision',
    icon: BarChart3,
    visual: 'kpi',
    items: ['Indicateurs', 'Reporting', 'Optimisation'],
  },
];

const roadmap = [
  {
    step: '01',
    title: 'Observer',
    text: 'Marché, concurrence, marque, publics.',
    icon: Search,
  },
  {
    step: '02',
    title: 'Décider',
    text: 'Positionnement, message, angle.',
    icon: Compass,
  },
  {
    step: '03',
    title: 'Planifier',
    text: 'Actions, priorités, calendrier.',
    icon: Map,
  },
  {
    step: '04',
    title: 'Piloter',
    text: 'KPI, ajustements, résultats.',
    icon: BarChart3,
  },
];

const deliverables = [
  {
    title: 'Diagnostic',
    text: 'Une lecture claire de votre situation actuelle.',
    icon: FileText,
  },
  {
    title: 'Plateforme stratégique',
    text: 'Positionnement, promesse, cibles et messages.',
    icon: Target,
  },
  {
    title: 'Roadmap 90 jours',
    text: 'Un plan d’action court, lisible et exploitable.',
    icon: Flag,
  },
  {
    title: 'Tableau KPI',
    text: 'Les bons indicateurs pour piloter les décisions.',
    icon: BarChart3,
  },
];

const stats = [
  { value: '360°', label: 'lecture complète' },
  { value: '90j', label: 'plan exploitable' },
  { value: '4', label: 'axes de décision' },
  { value: 'KPI', label: 'pilotage clair' },
];

const setActive = (index) => {
  activeZone.value = index;
};

onMounted(() => {
  intervalId = window.setInterval(() => {
    activeZone.value = (activeZone.value + 1) % zones.length;
  }, 2800);
});

onUnmounted(() => {
  if (intervalId) {
    window.clearInterval(intervalId);
  }
});
</script>

<template>
  <Head title="Stratégie & Conseil — KOTAVA Communication">
    <meta
      name="description"
      content="KOTAVA Communication accompagne les marques dans leur audit stratégique, positionnement, plan de communication, stratégie digitale et pilotage KPI."
    />
  </Head>

  <main class="relative overflow-hidden bg-brand-dark text-white">
    <!-- HERO / STRATEGIC MAP -->
    <section class="relative isolate overflow-hidden pb-12 pt-32 sm:pb-16 lg:pt-36">
      <div class="absolute inset-0 bg-grid-dark opacity-25"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_12%_18%,rgba(16,185,129,0.16),transparent_28%),radial-gradient(circle_at_88%_72%,rgba(249,115,22,0.14),transparent_30%),radial-gradient(circle_at_50%_42%,rgba(30,58,138,0.38),transparent_36%)]"></div>
      <div class="absolute inset-x-0 top-0 h-52 bg-gradient-to-b from-brand-dark via-brand-dark/90 to-transparent"></div>

      <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute left-1/2 top-[18%] hidden -translate-x-1/2 select-none text-[10vw] font-black uppercase leading-none tracking-[-0.1em] text-white/[0.025] lg:block">
          STRATEGY MAP
        </div>
      </div>

      <div class="site-container relative z-10">
        <Link
          href="/services"
          class="mb-7 inline-flex items-center gap-2 text-sm font-black text-white/[0.62] transition hover:-translate-x-1 hover:text-brand-emerald"
        >
          <ArrowLeft :size="18" />
          Retour aux services
        </Link>

        <div class="mx-auto max-w-5xl text-center">
          <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald backdrop-blur">
            <Compass :size="14" />
            Cabinet de décision stratégique
          </div>

          <h1 class="mt-6 text-5xl font-black leading-[0.9] tracking-[-0.065em] text-white sm:text-6xl lg:text-7xl">
            Transformer les idées floues
            <span class="block bg-gradient-to-r from-brand-emerald via-white to-brand-orange bg-clip-text text-transparent">
              en décisions claires.
            </span>
          </h1>

          <p class="mx-auto mt-6 max-w-2xl text-base leading-8 text-white/[0.64]">
            Audit, positionnement, feuille de route, messages, canaux et KPI :
            nous construisons une stratégie simple à comprendre et facile à exécuter.
          </p>

          <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">
            <Link
              href="/contact"
              class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] bg-brand-orange px-6 py-4 text-sm font-black text-white shadow-orange transition hover:-translate-y-0.5 hover:bg-brand-orange/90"
            >
              Demander un diagnostic
              <ArrowRight :size="18" />
            </Link>

            <a
              :href="contactPhoneHref"
              class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] border border-white/10 bg-white/[0.08] px-6 py-4 text-sm font-black text-white transition hover:-translate-y-0.5 hover:bg-white/[0.12]"
            >
              <Phone :size="18" />
              Consultation directe
            </a>
          </div>
        </div>

        <!-- Carte stratégique centrale -->
        <div class="strategy-board relative mx-auto mt-12 max-w-6xl overflow-hidden rounded-[2.8rem] border border-white/10 bg-white/[0.055] p-5 shadow-[0_35px_120px_rgba(0,0,0,0.34)] backdrop-blur-2xl sm:p-6">
          <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,rgba(16,185,129,0.11),transparent_38%)]"></div>

          <div class="relative grid gap-5 lg:grid-cols-[0.85fr_1.15fr] lg:items-stretch">
            <!-- Decision card -->
            <div class="rounded-[2.1rem] border border-white/10 bg-slate-950/65 p-5">
              <div class="flex items-center justify-between gap-4">
                <div>
                  <div class="text-[10px] font-black uppercase tracking-[0.2em] text-white/[0.36]">
                    Zone active
                  </div>

                  <div class="mt-3 flex items-center gap-3">
                    <div :class="['flex h-14 w-14 items-center justify-center rounded-2xl text-white', activeItem.bg]">
                      <component :is="activeItem.icon" :size="25" />
                    </div>

                    <div>
                      <div class="text-2xl font-black tracking-[-0.04em] text-white">
                        {{ activeItem.title }}
                      </div>
                      <div class="text-sm font-semibold text-white/[0.50]">
                        {{ activeItem.label }}
                      </div>
                    </div>
                  </div>
                </div>

                <Sparkles :size="22" class="text-brand-orange" />
              </div>

              <div class="mt-6 grid grid-cols-2 gap-3">
                <div
                  v-for="item in stats"
                  :key="item.label"
                  class="rounded-[1.35rem] border border-white/10 bg-white/[0.06] p-4"
                >
                  <div class="text-3xl font-black tracking-[-0.06em] text-white">
                    {{ item.value }}
                  </div>
                  <div class="mt-1 text-xs font-bold uppercase tracking-[0.11em] text-white/[0.42]">
                    {{ item.label }}
                  </div>
                </div>
              </div>

              <div class="mt-5 overflow-hidden rounded-[1.5rem] border border-white/10 bg-brand-dark/70 p-4">
                <div class="flex items-center justify-between text-xs font-black uppercase tracking-[0.16em] text-white/[0.38]">
                  <span>Clarté stratégique</span>
                  <span>92%</span>
                </div>

                <div class="mt-3 h-2 rounded-full bg-white/[0.08]">
                  <div class="strategy-meter h-full rounded-full bg-brand-emerald"></div>
                </div>
              </div>
            </div>

            <!-- Visual map -->
            <div class="relative min-h-[420px] overflow-hidden rounded-[2.1rem] border border-white/10 bg-slate-950/55 p-5">
              <div class="absolute left-1/2 top-1/2 h-[78%] w-[78%] -translate-x-1/2 -translate-y-1/2 rounded-full border border-dashed border-white/10"></div>
              <div class="absolute left-1/2 top-1/2 h-[52%] w-[52%] -translate-x-1/2 -translate-y-1/2 rounded-full border border-white/10"></div>
              <div class="absolute left-1/2 top-1/2 h-[26%] w-[26%] -translate-x-1/2 -translate-y-1/2 rounded-full border border-white/10"></div>

              <div class="absolute left-1/2 top-1/2 h-[1px] w-[86%] -translate-x-1/2 bg-white/10"></div>
              <div class="absolute left-1/2 top-1/2 h-[86%] w-[1px] -translate-y-1/2 bg-white/10"></div>

              <div class="strategy-pulse absolute left-1/2 top-1/2 h-36 w-36 -translate-x-1/2 -translate-y-1/2 rounded-[2.2rem] border border-brand-emerald/30"></div>

              <div class="absolute left-1/2 top-1/2 z-10 flex h-24 w-24 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-[1.7rem] bg-brand-orange text-white shadow-orange">
                <Compass :size="38" />
              </div>

              <button
                v-for="(zone, index) in zones"
                :key="zone.title"
                type="button"
                :class="[
                  'absolute z-20 rounded-[1.35rem] border p-4 text-left transition',
                  zone.x,
                  zone.y,
                  activeZone === index
                    ? 'border-brand-emerald/50 bg-brand-emerald/15 shadow-[0_0_35px_rgba(16,185,129,0.18)]'
                    : 'border-white/10 bg-brand-dark/85 hover:bg-white/[0.08]'
                ]"
                @click="setActive(index)"
              >
                <component
                  :is="zone.icon"
                  :size="20"
                  :class="activeZone === index ? zone.color : 'text-white/[0.45]'"
                />

                <div
                  :class="[
                    'mt-3 text-sm font-black',
                    activeZone === index ? 'text-white' : 'text-white/[0.60]'
                  ]"
                >
                  {{ zone.title }}
                </div>
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- MODULES / PRESTATIONS -->
    <section class="relative isolate overflow-hidden py-12 sm:py-14 lg:py-16">
      <div class="absolute inset-0 bg-grid-dark opacity-20"></div>

      <div class="site-container relative z-10">
        <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
          <div>
            <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald">
              <ClipboardList :size="15" />
              Modules de conseil
            </div>

            <h2 class="mt-4 max-w-3xl text-4xl font-black leading-[0.95] tracking-[-0.055em] sm:text-5xl">
              Moins de discours.
              <span class="text-brand-orange"> Plus de décisions.</span>
            </h2>
          </div>

          <p class="max-w-sm text-sm leading-7 text-white/[0.55]">
            Chaque module livre une réponse concrète à un problème stratégique.
          </p>
        </div>

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
          <div
            v-for="module in modules"
            :key="module.title"
            class="group relative overflow-hidden rounded-[2rem] border border-white/10 bg-white/[0.055] p-5 backdrop-blur-xl transition duration-300 hover:-translate-y-1 hover:bg-white/[0.09]"
          >
            <div class="absolute -right-14 -top-14 h-44 w-44 rounded-[3rem] bg-brand-emerald/15 blur-3xl transition group-hover:scale-125"></div>

            <div class="relative">
              <div class="flex items-center justify-between">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-brand-emerald text-white">
                  <component :is="module.icon" :size="24" />
                </div>

                <ArrowUpRight :size="18" class="text-white/[0.28] transition group-hover:translate-x-1 group-hover:-translate-y-1 group-hover:text-brand-orange" />
              </div>

              <div class="mt-5 overflow-hidden rounded-[1.45rem] border border-white/10 bg-slate-950/45 p-4">
                <div v-if="module.visual === 'audit'" class="relative flex h-28 items-center justify-center">
                  <div class="h-24 w-24 rounded-full border border-brand-emerald/30"></div>
                  <div class="absolute h-16 w-16 rounded-full border border-white/10"></div>
                  <Search :size="26" class="absolute text-brand-orange" />
                </div>

                <div v-else-if="module.visual === 'position'" class="relative h-28 rounded-2xl bg-white/[0.04]">
                  <div class="absolute left-1/2 top-0 h-full w-[1px] -translate-x-1/2 bg-white/10"></div>
                  <div class="absolute left-0 top-1/2 h-[1px] w-full -translate-y-1/2 bg-white/10"></div>
                  <div class="absolute left-[62%] top-[28%] h-10 w-10 rounded-2xl bg-brand-orange"></div>
                  <div class="absolute left-[18%] top-[58%] h-8 w-8 rounded-xl bg-brand-emerald/50"></div>
                </div>

                <div v-else-if="module.visual === 'roadmap'" class="grid h-28 grid-cols-4 gap-2">
                  <div class="rounded-xl bg-brand-blue/35"></div>
                  <div class="rounded-xl bg-brand-emerald/40"></div>
                  <div class="rounded-xl bg-brand-orange/35"></div>
                  <div class="rounded-xl bg-white/[0.10]"></div>
                </div>

                <div v-else-if="module.visual === 'digital'" class="space-y-3">
                  <div class="grid grid-cols-3 gap-2">
                    <div class="h-16 rounded-xl bg-brand-blue/35"></div>
                    <div class="h-16 rounded-xl bg-brand-emerald/40"></div>
                    <div class="h-16 rounded-xl bg-brand-orange/35"></div>
                  </div>
                  <div class="h-2 rounded-full bg-white/[0.12]">
                    <div class="h-full w-4/5 rounded-full bg-brand-emerald"></div>
                  </div>
                </div>

                <div v-else-if="module.visual === 'growth'" class="flex h-28 items-end gap-3">
                  <div class="h-10 flex-1 rounded-xl bg-brand-blue/35"></div>
                  <div class="h-16 flex-1 rounded-xl bg-brand-emerald/40"></div>
                  <div class="h-24 flex-1 rounded-xl bg-brand-orange/40"></div>
                </div>

                <div v-else class="grid h-28 grid-cols-[1fr_0.8fr] gap-3">
                  <div class="rounded-2xl bg-white p-4 text-slate-950">
                    <BarChart3 :size="22" class="text-brand-blue" />
                    <div class="mt-8 h-2 rounded-full bg-slate-200"></div>
                    <div class="mt-2 h-2 w-2/3 rounded-full bg-slate-200"></div>
                  </div>
                  <div class="grid gap-2">
                    <div class="rounded-xl bg-brand-emerald/35"></div>
                    <div class="rounded-xl bg-brand-orange/30"></div>
                  </div>
                </div>
              </div>

              <h3 class="mt-5 text-xl font-black tracking-[-0.035em] text-white">
                {{ module.title }}
              </h3>

              <p class="mt-1 text-sm font-bold text-brand-emerald">
                {{ module.label }}
              </p>

              <div class="mt-4 flex flex-wrap gap-2">
                <span
                  v-for="item in module.items"
                  :key="item"
                  class="inline-flex items-center gap-1.5 rounded-xl border border-white/10 bg-white/[0.07] px-3 py-2 text-[10px] font-black uppercase tracking-[0.12em] text-white/[0.52]"
                >
                  <CheckCircle2 :size="13" class="text-brand-emerald" />
                  {{ item }}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ROADMAP + LIVRABLES -->
    <section class="relative isolate overflow-hidden py-12 sm:py-14 lg:py-16">
      <div class="site-container relative z-10">
        <div class="grid gap-5 lg:grid-cols-[1.05fr_0.95fr]">
          <div class="relative overflow-hidden rounded-[2.4rem] border border-white/10 bg-white/[0.06] p-6 backdrop-blur-2xl">
            <div class="absolute -right-24 -top-24 h-80 w-80 rounded-[5rem] bg-brand-emerald/15 blur-3xl"></div>

            <div class="relative">
              <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald">
                <Map :size="14" />
                Roadmap
              </div>

              <h2 class="mt-5 text-4xl font-black leading-[0.95] tracking-[-0.055em] text-white">
                Une méthode courte,
                <span class="block text-brand-orange">orientée décision.</span>
              </h2>

              <div class="mt-7 grid gap-3 sm:grid-cols-4">
                <div
                  v-for="item in roadmap"
                  :key="item.title"
                  class="rounded-[1.5rem] border border-white/10 bg-slate-950/40 p-4"
                >
                  <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-brand-blue">
                    <component :is="item.icon" :size="21" />
                  </div>

                  <div class="mt-5 text-[10px] font-black uppercase tracking-[0.18em] text-white/[0.32]">
                    {{ item.step }}
                  </div>

                  <h3 class="mt-1 text-base font-black text-white">
                    {{ item.title }}
                  </h3>

                  <p class="mt-2 text-xs leading-5 text-white/[0.52]">
                    {{ item.text }}
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="relative overflow-hidden rounded-[2.4rem] border border-white/10 bg-white/[0.06] p-6 backdrop-blur-2xl">
            <div class="absolute -bottom-24 -right-20 h-80 w-80 rounded-[4rem] bg-brand-orange/15 blur-3xl"></div>

            <div class="relative">
              <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald">
                <FileText :size="14" />
                Livrables
              </div>

              <div class="mt-6 grid gap-3 sm:grid-cols-2">
                <div
                  v-for="item in deliverables"
                  :key="item.title"
                  class="rounded-[1.5rem] border border-white/10 bg-slate-950/35 p-5"
                >
                  <component :is="item.icon" :size="23" class="text-brand-emerald" />

                  <h3 class="mt-5 text-lg font-black text-white">
                    {{ item.title }}
                  </h3>

                  <p class="mt-2 text-xs leading-5 text-white/[0.52]">
                    {{ item.text }}
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- CTA -->
          <div class="relative overflow-hidden rounded-[2.4rem] border border-white/10 bg-white/[0.065] p-6 backdrop-blur-2xl lg:col-span-2 sm:p-8">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_18%,rgba(16,185,129,0.16),transparent_30%),radial-gradient(circle_at_86%_80%,rgba(249,115,22,0.14),transparent_32%)]"></div>

            <div class="relative grid gap-6 lg:grid-cols-[1fr_0.8fr] lg:items-center">
              <div>
                <div class="flex h-16 w-16 items-center justify-center rounded-[1.4rem] bg-brand-orange text-white shadow-orange">
                  <Lightbulb :size="28" />
                </div>

                <h2 class="mt-6 text-4xl font-black leading-[0.95] tracking-[-0.055em] text-white sm:text-5xl">
                  Votre marque a besoin
                  <span class="block bg-gradient-to-r from-brand-emerald via-white to-brand-orange bg-clip-text text-transparent">
                    d’un cap plus clair ?
                  </span>
                </h2>

                <p class="mt-4 max-w-xl text-sm leading-7 text-white/[0.60]">
                  On analyse votre situation et on transforme vos objectifs en décisions,
                  priorités et actions concrètes.
                </p>
              </div>

              <div class="grid gap-3">
                <Link
                  href="/contact"
                  class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] bg-brand-orange px-6 py-4 text-sm font-black text-white shadow-orange transition hover:-translate-y-0.5 hover:bg-brand-orange/90"
                >
                  Demander un diagnostic
                  <ArrowRight :size="18" />
                </Link>

                <a
                  :href="contactPhoneHref"
                  class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] border border-white/10 bg-white/[0.08] px-6 py-4 text-sm font-black text-white transition hover:-translate-y-0.5 hover:bg-white/[0.12]"
                >
                  <Phone :size="18" />
                  {{ contactPhoneDisplay }}
                </a>

                <a
                  :href="`mailto:${contactEmail}`"
                  class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] border border-white/10 bg-white/[0.08] px-6 py-4 text-sm font-black text-white transition hover:-translate-y-0.5 hover:bg-white/[0.12]"
                >
                  <Mail :size="18" />
                  {{ contactEmail }}
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<style scoped>
@keyframes strategyBoard {
  0%, 100% {
    transform: translateY(0) rotate(0deg);
  }

  50% {
    transform: translateY(-8px) rotate(-0.25deg);
  }
}

@keyframes strategyPulse {
  0%, 100% {
    transform: translate(-50%, -50%) scale(0.82);
    opacity: 0.35;
  }

  50% {
    transform: translate(-50%, -50%) scale(1.15);
    opacity: 0.8;
  }
}

@keyframes strategyMeter {
  0% {
    width: 32%;
  }

  50% {
    width: 92%;
  }

  100% {
    width: 68%;
  }
}

.strategy-board {
  animation: strategyBoard 6s ease-in-out infinite;
}

.strategy-pulse {
  animation: strategyPulse 2.8s ease-in-out infinite;
}

.strategy-meter {
  animation: strategyMeter 3.4s ease-in-out infinite;
}
</style>
