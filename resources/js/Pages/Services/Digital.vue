<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/GuestLayout.vue';
import {
  ArrowLeft,
  ArrowRight,
  ArrowUpRight,
  CheckCircle2,
  Cloud,
  Code2,
  Cpu,
  Database,
  GitBranch,
  Globe2,
  Layers3,
  Mail,
  Monitor,
  Phone,
  Rocket,
  Server,
  ShieldCheck,
  ShoppingCart,
  Smartphone,
  Sparkles,
  Terminal,
  TrendingUp,
  UsersRound,
  Zap,
} from 'lucide-vue-next';

defineOptions({ layout: MainLayout });

const contactEmail = 'Contact@kotavacom.com';
const contactPhoneDisplay = '+229 93 37 49 63';
const contactPhoneHref = 'tel:+22993374963';

const activeIndex = ref(0);
let intervalId = null;

const solutions = [
  {
    number: '01',
    title: 'Site web',
    label: 'Vitrine / corporate',
    metric: 'SEO-ready',
    icon: Monitor,
    visual: 'web',
    gradient: 'from-brand-blue to-brand-emerald',
    glow: 'bg-brand-emerald/25',
    features: ['Landing page', 'Site vitrine', 'Pages services'],
    code: 'buildWebsite({ seo: true, speed: "fast" })',
  },
  {
    number: '02',
    title: 'Application',
    label: 'Mobile / portail',
    metric: 'Mobile-first',
    icon: Smartphone,
    visual: 'mobile',
    gradient: 'from-brand-emerald to-brand-orange',
    glow: 'bg-brand-orange/25',
    features: ['App mobile', 'Espace client', 'API'],
    code: 'createApp({ ios: true, android: true })',
  },
  {
    number: '03',
    title: 'E-commerce',
    label: 'Vente / marketplace',
    metric: 'Conversion',
    icon: ShoppingCart,
    visual: 'commerce',
    gradient: 'from-brand-orange to-brand-blue',
    glow: 'bg-brand-blue/25',
    features: ['Catalogue', 'Paiement', 'Commandes'],
    code: 'checkout({ secure: true, analytics: true })',
  },
  {
    number: '04',
    title: 'Performance',
    label: 'SEO / vitesse',
    metric: '<2s cible',
    icon: Zap,
    visual: 'speed',
    gradient: 'from-brand-blue to-brand-orange',
    glow: 'bg-brand-orange/25',
    features: ['Core Web Vitals', 'SEO', 'UX'],
    code: 'optimize({ lcp: "<2s", score: "A+" })',
  },
  {
    number: '05',
    title: 'Sécurité',
    label: 'Maintenance / monitoring',
    metric: 'SSL + backup',
    icon: ShieldCheck,
    visual: 'security',
    gradient: 'from-brand-emerald to-brand-blue',
    glow: 'bg-brand-emerald/25',
    features: ['SSL', 'Sauvegarde', 'Monitoring'],
    code: 'secureSystem({ backup: true, monitor: true })',
  },
  {
    number: '06',
    title: 'Formation',
    label: 'Support / autonomie',
    metric: 'Autonomie',
    icon: UsersRound,
    visual: 'training',
    gradient: 'from-brand-blue to-brand-emerald',
    glow: 'bg-brand-blue/25',
    features: ['Formation CMS', 'Documentation', 'Support'],
    code: 'trainTeam({ docs: true, support: true })',
  },
];

const stack = [
  { name: 'Vue / React', type: 'Frontend', icon: Code2 },
  { name: 'Laravel / Node', type: 'Backend', icon: Server },
  { name: 'Tailwind', type: 'Design system', icon: Layers3 },
  { name: 'SQL / NoSQL', type: 'Database', icon: Database },
  { name: 'Cloud', type: 'Hosting', icon: Cloud },
  { name: 'Git / Docker', type: 'Workflow', icon: GitBranch },
];

const architecture = [
  { title: 'Interface', value: 'UX/UI', icon: Monitor, position: 'lg:col-start-1 lg:row-start-1' },
  { title: 'Backend', value: 'API', icon: Server, position: 'lg:col-start-3 lg:row-start-1' },
  { title: 'Données', value: 'DB', icon: Database, position: 'lg:col-start-1 lg:row-start-3' },
  { title: 'Cloud', value: 'Deploy', icon: Cloud, position: 'lg:col-start-3 lg:row-start-3' },
];

const pipeline = [
  { title: 'Brief', icon: Sparkles },
  { title: 'UX', icon: Layers3 },
  { title: 'Code', icon: Terminal },
  { title: 'Test', icon: Cpu },
  { title: 'Launch', icon: Rocket },
];

const stats = [
  { value: 'Mobile', label: 'first', icon: Smartphone },
  { value: 'SEO', label: 'ready', icon: TrendingUp },
  { value: 'SSL', label: 'secure', icon: ShieldCheck },
  { value: '<2s', label: 'cible vitesse', icon: Zap },
];

const activeSolution = computed(() => solutions[activeIndex.value] || solutions[0]);

const setActive = (index) => {
  activeIndex.value = index;
};

onMounted(() => {
  intervalId = window.setInterval(() => {
    activeIndex.value = (activeIndex.value + 1) % solutions.length;
  }, 3200);
});

onUnmounted(() => {
  if (intervalId) {
    window.clearInterval(intervalId);
  }
});
</script>

<template>
  <Head title="Digital & Web — KOTAVA Communication">
    <meta
      name="description"
      content="KOTAVA Communication conçoit des sites web, applications, plateformes digitales, e-commerce, SEO, maintenance et solutions digitales sur mesure."
    />
  </Head>

  <main class="relative overflow-hidden bg-brand-dark text-white">
    <!-- HERO DIGITAL PRODUCT LAB -->
    <section class="relative isolate overflow-hidden pb-12 pt-32 sm:pb-14 lg:pt-36">
      <div class="absolute inset-0 bg-grid-dark opacity-30"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_8%_20%,rgba(16,185,129,0.18),transparent_28%),radial-gradient(circle_at_92%_72%,rgba(249,115,22,0.15),transparent_30%),radial-gradient(circle_at_48%_44%,rgba(30,58,138,0.40),transparent_36%)]"></div>
      <div class="absolute inset-x-0 top-0 h-52 bg-gradient-to-b from-brand-dark via-brand-dark/90 to-transparent"></div>

      <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute inset-x-0 top-[15%] hidden select-none text-center text-[12vw] font-black uppercase leading-none tracking-[-0.1em] text-white/[0.025] lg:block">
          DIGITAL OS
        </div>

        <div class="digital-orb absolute left-[10%] top-[28%] h-3 w-3 rounded-lg bg-brand-emerald/60"></div>
        <div class="digital-orb animation-delay-700 absolute right-[12%] top-[22%] h-2.5 w-2.5 rounded-lg bg-brand-orange/60"></div>
        <div class="digital-orb animation-delay-1000 absolute bottom-[18%] left-[22%] h-2 w-2 rounded-lg bg-white/35"></div>
        <div class="digital-orb animation-delay-1500 absolute bottom-[24%] right-[30%] h-3 w-3 rounded-lg bg-brand-blue/70"></div>
      </div>

      <div class="site-container relative z-10">
        <Link
          href="/services"
          class="mb-7 inline-flex items-center gap-2 text-sm font-black text-white/[0.62] transition hover:-translate-x-1 hover:text-brand-emerald"
        >
          <ArrowLeft :size="18" />
          Retour aux services
        </Link>

        <div class="grid gap-8 lg:grid-cols-[0.82fr_1.18fr] lg:items-center">
          <div>
            <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald backdrop-blur">
              <Terminal :size="14" />
              Digital Product Lab
            </div>

            <h1 class="mt-6 max-w-4xl text-5xl font-black leading-[0.9] tracking-[-0.065em] text-white sm:text-6xl lg:text-7xl">
              On transforme vos idées
              <span class="block bg-gradient-to-r from-brand-emerald via-white to-brand-orange bg-clip-text text-transparent">
                en produits digitaux.
              </span>
            </h1>

            <p class="mt-6 max-w-xl text-base leading-8 text-white/[0.64]">
              Sites, apps, plateformes, e-commerce et systèmes web conçus pour être rapides,
              utiles, beaux et exploitables.
            </p>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
              <Link
                href="/contact"
                class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] bg-brand-orange px-6 py-4 text-sm font-black text-white shadow-orange transition hover:-translate-y-0.5 hover:bg-brand-orange/90"
              >
                Lancer mon projet
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

            <div class="mt-8 grid grid-cols-2 gap-3 sm:grid-cols-4">
              <div
                v-for="item in stats"
                :key="item.label"
                class="rounded-[1.3rem] border border-white/10 bg-white/[0.055] p-4 backdrop-blur"
              >
                <component :is="item.icon" :size="19" class="text-brand-emerald" />
                <div class="mt-3 text-xl font-black text-white">
                  {{ item.value }}
                </div>
                <div class="text-[11px] font-bold uppercase tracking-[0.12em] text-white/[0.42]">
                  {{ item.label }}
                </div>
              </div>
            </div>
          </div>

          <!-- Digital cockpit -->
          <div class="relative">
            <div class="absolute left-1/2 top-1/2 h-[106%] w-[88%] -translate-x-1/2 -translate-y-1/2 rounded-[5rem] bg-gradient-to-br from-brand-blue/25 via-brand-emerald/20 to-brand-orange/20 blur-3xl"></div>

            <div class="digital-float relative overflow-hidden rounded-[2.6rem] border border-white/10 bg-white/[0.06] p-4 shadow-[0_35px_110px_rgba(0,0,0,0.34)] backdrop-blur-2xl sm:p-5">
              <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_18%,rgba(16,185,129,0.15),transparent_32%),radial-gradient(circle_at_86%_82%,rgba(249,115,22,0.14),transparent_34%)]"></div>

              <div class="relative grid gap-4 lg:grid-cols-[1.05fr_0.95fr]">
                <!-- main screen -->
                <div class="rounded-[2rem] border border-white/10 bg-slate-950/80 p-4">
                  <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                      <span class="h-2.5 w-2.5 rounded-full bg-brand-orange"></span>
                      <span class="h-2.5 w-2.5 rounded-full bg-brand-emerald"></span>
                      <span class="h-2.5 w-2.5 rounded-full bg-white/[0.25]"></span>
                    </div>

                    <div class="rounded-xl bg-brand-emerald/10 px-3 py-1.5 text-[10px] font-black uppercase tracking-[0.16em] text-brand-emerald">
                      building
                    </div>
                  </div>

                  <div class="mt-5 flex items-center gap-3">
                    <div :class="['flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br text-white', activeSolution.gradient]">
                      <component :is="activeSolution.icon" :size="23" />
                    </div>

                    <div>
                      <div class="text-xl font-black tracking-[-0.04em] text-white">
                        {{ activeSolution.title }}
                      </div>
                      <div class="text-xs font-bold text-white/[0.45]">
                        {{ activeSolution.label }}
                      </div>
                    </div>
                  </div>

                  <div class="mt-5 overflow-hidden rounded-[1.6rem] border border-white/10 bg-white/[0.055] p-4">
                    <div v-if="activeSolution.visual === 'web'" class="grid min-h-[210px] grid-cols-[0.78fr_1.22fr] gap-4">
                      <div class="rounded-[1.25rem] bg-brand-blue/40 p-3">
                        <Globe2 :size="24" class="text-white" />
                        <div class="mt-20 h-2 rounded-full bg-white/[0.25]"></div>
                        <div class="mt-2 h-2 w-2/3 rounded-full bg-white/[0.15]"></div>
                      </div>

                      <div class="space-y-3">
                        <div class="h-3 rounded-full bg-white/[0.20]"></div>
                        <div class="h-3 w-4/5 rounded-full bg-white/[0.12]"></div>
                        <div class="grid grid-cols-2 gap-3">
                          <div class="h-32 rounded-[1rem] bg-brand-emerald/35"></div>
                          <div class="h-32 rounded-[1rem] bg-brand-orange/30"></div>
                        </div>
                      </div>
                    </div>

                    <div v-else-if="activeSolution.visual === 'mobile'" class="flex min-h-[210px] items-center justify-center gap-5">
                      <div class="h-48 w-28 rounded-[1.8rem] border border-white/10 bg-white/[0.10] p-2 shadow-2xl">
                        <div class="h-full rounded-[1.35rem] bg-brand-emerald/35 p-3">
                          <div class="h-2 w-1/2 rounded-full bg-white/40"></div>
                          <div class="mt-20 h-12 rounded-xl bg-white/20"></div>
                        </div>
                      </div>

                      <div class="h-40 w-28 rounded-[1.8rem] border border-white/10 bg-white/[0.08] p-2">
                        <div class="h-full rounded-[1.35rem] bg-brand-orange/30"></div>
                      </div>
                    </div>

                    <div v-else-if="activeSolution.visual === 'commerce'" class="grid min-h-[210px] grid-cols-[1fr_0.9fr] gap-4">
                      <div class="rounded-[1.4rem] bg-white p-4 text-slate-950">
                        <ShoppingCart :size="24" class="text-brand-orange" />
                        <div class="mt-20 h-2 rounded-full bg-slate-200"></div>
                        <div class="mt-2 h-2 w-2/3 rounded-full bg-slate-200"></div>
                        <div class="mt-4 h-10 rounded-xl bg-brand-orange"></div>
                      </div>

                      <div class="grid gap-3">
                        <div class="rounded-[1rem] bg-brand-emerald/35"></div>
                        <div class="rounded-[1rem] bg-brand-blue/35"></div>
                      </div>
                    </div>

                    <div v-else-if="activeSolution.visual === 'speed'" class="min-h-[210px]">
                      <div class="grid h-40 grid-cols-5 items-end gap-3">
                        <div class="h-16 rounded-xl bg-brand-blue/35"></div>
                        <div class="h-28 rounded-xl bg-brand-emerald/40"></div>
                        <div class="h-36 rounded-xl bg-brand-orange/35"></div>
                        <div class="h-24 rounded-xl bg-white/[0.10]"></div>
                        <div class="h-32 rounded-xl bg-brand-emerald/25"></div>
                      </div>

                      <div class="mt-5 h-2 rounded-full bg-white/[0.12]">
                        <div class="digital-progress h-full rounded-full bg-brand-emerald"></div>
                      </div>
                    </div>

                    <div v-else-if="activeSolution.visual === 'security'" class="relative flex min-h-[210px] items-center justify-center rounded-[1.4rem] bg-gradient-to-br from-brand-blue/30 to-brand-emerald/35">
                      <div class="digital-pulse absolute h-32 w-32 rounded-[2rem] border border-brand-emerald/30"></div>
                      <div class="relative flex h-24 w-24 items-center justify-center rounded-[1.6rem] bg-white text-brand-blue">
                        <ShieldCheck :size="42" />
                      </div>
                    </div>

                    <div v-else class="min-h-[210px] space-y-4">
                      <div class="flex gap-3">
                        <div class="h-16 w-16 rounded-2xl bg-brand-emerald"></div>
                        <div class="flex-1 rounded-2xl bg-white/[0.08]"></div>
                      </div>

                      <div class="grid grid-cols-4 gap-3">
                        <div class="h-20 rounded-xl bg-brand-orange/40"></div>
                        <div class="h-20 rounded-xl bg-white/[0.08]"></div>
                        <div class="h-20 rounded-xl bg-brand-blue/40"></div>
                        <div class="h-20 rounded-xl bg-brand-emerald/40"></div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- right dashboard -->
                <div class="grid gap-4">
                  <div class="rounded-[1.8rem] border border-white/10 bg-slate-950/70 p-4">
                    <div class="flex items-center justify-between">
                      <div class="text-[10px] font-black uppercase tracking-[0.18em] text-white/[0.38]">
                        Runtime
                      </div>
                      <Cpu :size="18" class="text-brand-emerald" />
                    </div>

                    <div class="mt-4 rounded-[1.2rem] bg-white/[0.06] p-3 font-mono text-[11px] leading-6 text-white/[0.65]">
                      <div class="text-brand-emerald">~/kotava-lab</div>
                      <div>{{ activeSolution.code }}</div>
                      <div class="text-brand-orange">status: ready</div>
                    </div>
                  </div>

                  <div class="grid grid-cols-2 gap-3">
                    <button
                      v-for="(solution, index) in solutions"
                      :key="solution.title"
                      type="button"
                      :class="[
                        'rounded-[1.2rem] border p-3 text-left transition',
                        activeIndex === index
                          ? 'border-brand-emerald/40 bg-brand-emerald/15'
                          : 'border-white/10 bg-white/[0.055] hover:bg-white/[0.09]'
                      ]"
                      @click="setActive(index)"
                    >
                      <component
                        :is="solution.icon"
                        :size="18"
                        :class="activeIndex === index ? 'text-brand-emerald' : 'text-white/[0.40]'"
                      />
                      <div
                        :class="[
                          'mt-3 text-xs font-black',
                          activeIndex === index ? 'text-white' : 'text-white/[0.55]'
                        ]"
                      >
                        {{ solution.title }}
                      </div>
                    </button>
                  </div>

                  <div class="rounded-[1.8rem] border border-white/10 bg-white/[0.06] p-4">
                    <div class="text-[10px] font-black uppercase tracking-[0.18em] text-white/[0.38]">
                      Metric
                    </div>
                    <div class="mt-3 text-3xl font-black tracking-[-0.06em] text-white">
                      {{ activeSolution.metric }}
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="absolute -left-4 bottom-8 hidden rounded-[1.3rem] border border-white/10 bg-white p-4 text-slate-950 shadow-2xl lg:block [transform:rotate(-6deg)]">
              <Sparkles :size="19" class="text-brand-orange" />
              <div class="mt-2 text-sm font-black">Prototype prêt</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ARCHITECTURE MAP -->
    <section class="relative isolate overflow-hidden py-12 sm:py-14 lg:py-16">
      <div class="absolute inset-0 bg-grid-dark opacity-20"></div>

      <div class="site-container relative z-10">
        <div class="grid gap-5 lg:grid-cols-[0.95fr_1.05fr]">
          <div class="relative overflow-hidden rounded-[2.4rem] border border-white/10 bg-white/[0.06] p-6 backdrop-blur-2xl">
            <div class="absolute -right-24 -top-24 h-80 w-80 rounded-[5rem] bg-brand-emerald/15 blur-3xl"></div>

            <div class="relative">
              <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald">
                <Layers3 :size="14" />
                Architecture
              </div>

              <h2 class="mt-5 text-4xl font-black leading-[0.95] tracking-[-0.055em] text-white">
                Pas juste une page web.
                <span class="block text-brand-orange">Un système propre.</span>
              </h2>

              <p class="mt-4 max-w-lg text-sm leading-7 text-white/[0.58]">
                Interface, API, base de données, cloud, sécurité et maintenance :
                tout est pensé comme un ensemble cohérent.
              </p>

              <div class="mt-6 flex flex-wrap gap-2">
                <span
                  v-for="feature in activeSolution.features"
                  :key="feature"
                  class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/[0.07] px-3 py-2 text-[10px] font-black uppercase tracking-[0.13em] text-white/[0.55]"
                >
                  <CheckCircle2 :size="13" class="text-brand-emerald" />
                  {{ feature }}
                </span>
              </div>
            </div>
          </div>

          <div class="relative overflow-hidden rounded-[2.4rem] border border-white/10 bg-white/[0.06] p-6 backdrop-blur-2xl">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,rgba(16,185,129,0.10),transparent_38%)]"></div>

            <div class="relative grid min-h-[420px] grid-cols-1 gap-4 lg:grid-cols-3 lg:grid-rows-3">
              <div class="absolute left-1/2 top-1/2 hidden h-[68%] w-[68%] -translate-x-1/2 -translate-y-1/2 rounded-[3rem] border border-dashed border-white/10 lg:block"></div>
              <div class="absolute left-1/2 top-1/2 hidden h-36 w-36 -translate-x-1/2 -translate-y-1/2 rounded-[2rem] bg-brand-orange/15 blur-2xl lg:block"></div>

              <div class="relative z-10 hidden items-center justify-center rounded-[1.8rem] border border-white/10 bg-slate-950/55 p-5 lg:col-start-2 lg:row-start-2 lg:flex">
                <div class="text-center">
                  <Globe2 :size="30" class="mx-auto text-brand-orange" />
                  <div class="mt-3 text-sm font-black text-white">Digital Core</div>
                </div>
              </div>

              <div
                v-for="node in architecture"
                :key="node.title"
                :class="[
                  'relative z-10 rounded-[1.8rem] border border-white/10 bg-slate-950/55 p-5',
                  node.position
                ]"
              >
                <component :is="node.icon" :size="24" class="text-brand-emerald" />
                <div class="mt-6 text-2xl font-black text-white">
                  {{ node.value }}
                </div>
                <div class="mt-1 text-sm font-bold text-white/[0.45]">
                  {{ node.title }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- PIPELINE + STACK -->
    <section class="relative isolate overflow-hidden py-12 pb-20 sm:py-14 lg:pb-24">
      <div class="site-container relative z-10">
        <div class="grid gap-5 lg:grid-cols-[1fr_1fr]">
          <div class="relative overflow-hidden rounded-[2.4rem] border border-white/10 bg-white/[0.06] p-6 backdrop-blur-2xl">
            <div class="absolute -bottom-24 -right-20 h-80 w-80 rounded-[4rem] bg-brand-orange/15 blur-3xl"></div>

            <div class="relative">
              <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald">
                <Rocket :size="14" />
                Pipeline
              </div>

              <div class="mt-6 grid gap-3 sm:grid-cols-5">
                <div
                  v-for="(step, index) in pipeline"
                  :key="step.title"
                  class="relative overflow-hidden rounded-[1.5rem] border border-white/10 bg-slate-950/45 p-4 text-center"
                >
                  <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-brand-blue">
                    <component :is="step.icon" :size="21" />
                  </div>

                  <div class="mt-4 text-[10px] font-black uppercase tracking-[0.18em] text-white/[0.32]">
                    0{{ index + 1 }}
                  </div>

                  <div class="mt-1 text-sm font-black text-white">
                    {{ step.title }}
                  </div>
                </div>
              </div>

              <div class="mt-6 overflow-hidden rounded-[1.4rem] border border-white/10 bg-slate-950/50 px-4 py-3">
                <div class="digital-marquee flex min-w-max gap-7 text-[11px] font-black uppercase tracking-[0.18em] text-white/[0.42]">
                  <span>Prototype</span>
                  <span>UX/UI</span>
                  <span>Frontend</span>
                  <span>Backend</span>
                  <span>API</span>
                  <span>SEO</span>
                  <span>Security</span>
                  <span>Deploy</span>
                  <span>Prototype</span>
                  <span>UX/UI</span>
                  <span>Frontend</span>
                  <span>Backend</span>
                  <span>API</span>
                </div>
              </div>
            </div>
          </div>

          <div class="relative overflow-hidden rounded-[2.4rem] border border-white/10 bg-white/[0.06] p-6 backdrop-blur-2xl">
            <div class="absolute -right-24 -top-24 h-80 w-80 rounded-[5rem] bg-brand-blue/20 blur-3xl"></div>

            <div class="relative">
              <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald">
                <Terminal :size="14" />
                Stack
              </div>

              <div class="mt-6 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                <div
                  v-for="tech in stack"
                  :key="tech.name"
                  class="group rounded-[1.5rem] border border-white/10 bg-slate-950/35 p-4 transition hover:-translate-y-1 hover:bg-white/[0.08]"
                >
                  <component :is="tech.icon" :size="22" class="text-brand-emerald" />

                  <div class="mt-4 text-sm font-black text-white">
                    {{ tech.name }}
                  </div>

                  <div class="mt-1 text-xs font-bold text-white/[0.42]">
                    {{ tech.type }}
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="relative overflow-hidden rounded-[2.4rem] border border-white/10 bg-white/[0.065] p-6 backdrop-blur-2xl lg:col-span-2 sm:p-8">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_18%,rgba(16,185,129,0.16),transparent_30%),radial-gradient(circle_at_86%_80%,rgba(249,115,22,0.14),transparent_32%)]"></div>

            <div class="relative grid gap-6 lg:grid-cols-[1fr_0.8fr] lg:items-center">
              <div>
                <div class="flex h-16 w-16 items-center justify-center rounded-[1.4rem] bg-brand-orange text-white shadow-orange">
                  <Mail :size="28" />
                </div>

                <h2 class="mt-6 text-4xl font-black leading-[0.95] tracking-[-0.055em] text-white sm:text-5xl">
                  On construit votre
                  <span class="block bg-gradient-to-r from-brand-emerald via-white to-brand-orange bg-clip-text text-transparent">
                    prochain produit digital ?
                  </span>
                </h2>

                <p class="mt-4 max-w-xl text-sm leading-7 text-white/[0.60]">
                  Site, app, e-commerce ou plateforme : on part de votre besoin réel et on conçoit une solution exploitable.
                </p>
              </div>

              <div class="grid gap-3">
                <Link
                  href="/contact"
                  class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] bg-brand-orange px-6 py-4 text-sm font-black text-white shadow-orange transition hover:-translate-y-0.5 hover:bg-brand-orange/90"
                >
                  Obtenir un devis
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
@keyframes digitalFloat {
  0%, 100% {
    transform: translateY(0) rotate(0deg);
  }

  50% {
    transform: translateY(-10px) rotate(0.35deg);
  }
}

@keyframes digitalOrb {
  0%, 100% {
    transform: translate3d(0, 0, 0) scale(1);
    opacity: 0.35;
  }

  50% {
    transform: translate3d(18px, -22px, 0) scale(1.35);
    opacity: 0.8;
  }
}

@keyframes digitalPulse {
  0%, 100% {
    transform: scale(0.82);
    opacity: 0.35;
  }

  50% {
    transform: scale(1.15);
    opacity: 0.8;
  }
}

@keyframes digitalProgress {
  0% {
    width: 24%;
  }

  50% {
    width: 88%;
  }

  100% {
    width: 64%;
  }
}

@keyframes digitalMarquee {
  0% {
    transform: translateX(0);
  }

  100% {
    transform: translateX(-45%);
  }
}

.digital-float {
  animation: digitalFloat 5.8s ease-in-out infinite;
}

.digital-orb {
  animation: digitalOrb 7s ease-in-out infinite;
}

.digital-pulse {
  animation: digitalPulse 2.4s ease-in-out infinite;
}

.digital-progress {
  animation: digitalProgress 3.2s ease-in-out infinite;
}

.digital-marquee {
  animation: digitalMarquee 18s linear infinite;
}

.animation-delay-700 {
  animation-delay: 700ms;
}

.animation-delay-1000 {
  animation-delay: 1000ms;
}

.animation-delay-1500 {
  animation-delay: 1500ms;
}
</style>
