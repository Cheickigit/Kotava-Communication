<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {
  ArrowRight,
  ArrowUpRight,
  BarChart3,
  BookOpen,
  CalendarDays,
  Camera,
  CheckCircle2,
  Globe2,
  Mail,
  Megaphone,
  MessageCircle,
  Palette,
  Phone,
  PlayCircle,
  Rocket,
  Search,
  Sparkles,
  Target,
  TrendingUp,
  UsersRound,
  Video,
  Wand2,
  Zap,
  MonitorSmartphone,
  PenTool,
  BadgeCheck,
  Eye,
  Layers3,
  MousePointerClick,
  ShieldCheck,
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

const contactEmail = 'Contact@kotavacom.com';
const contactPhoneDisplay = '+33 70 89 99 00';
const contactPhoneHref = 'tel:+33708999900';

const services = [
  {
    icon: Target,
    title: 'Stratégie & Conseil',
    href: '/services/strategie-conseil',
    label: 'Positionnement',
    short: 'Clarifier la vision, l’offre et le message.',
    speech: 'Nous commençons par la stratégie : positionnement, ciblage, promesse et architecture de communication.',
    accent: 'from-brand-blue to-brand-emerald',
  },
  {
    icon: Palette,
    title: 'Branding & Design',
    href: '/services/branding-design',
    label: 'Identité visuelle',
    short: 'Créer une identité forte, cohérente et mémorable.',
    speech: 'Nous construisons des identités visuelles premium : logo, charte graphique, univers de marque et assets.',
    accent: 'from-brand-emerald to-brand-orange',
  },
  {
    icon: Globe2,
    title: 'Digital & Web',
    href: '/services/digital-web',
    label: 'Web & UX/UI',
    short: 'Déployer des expériences digitales élégantes.',
    speech: 'Nous concevons des sites, interfaces et écosystèmes digitaux pensés pour la performance et l’image.',
    accent: 'from-brand-blue to-brand-orange',
  },
  {
    icon: Video,
    title: 'Production Audiovisuelle',
    href: '/services/audiovisuel',
    label: 'Photo · Vidéo',
    short: 'Produire des contenus premium à fort impact.',
    speech: 'Photo, vidéo, motion design et contenus premium : nous donnons du relief à votre image.',
    accent: 'from-brand-emerald to-brand-blue',
  },
  {
    icon: CalendarDays,
    title: 'Événementiel & RP',
    href: '/services/evenementiel',
    label: 'Activation',
    short: 'Créer des temps forts qui marquent les esprits.',
    speech: 'Nous pilotons les activations, événements, relations presse et expériences de marque à forte visibilité.',
    accent: 'from-brand-orange to-brand-emerald',
  },
  {
    icon: MessageCircle,
    title: 'Social Media',
    href: '/services/social-media',
    label: 'Audience',
    short: 'Créer la conversation et faire grandir la communauté.',
    speech: 'Nous animons votre présence sociale avec une ligne éditoriale forte, des campagnes et des contenus performants.',
    accent: 'from-brand-blue to-brand-emerald',
  },
];

const studioPillars = [
  {
    icon: Search,
    title: 'Diagnostic',
    desc: 'Analyse du marché, de la marque et du contexte.',
  },
  {
    icon: PenTool,
    title: 'Création',
    desc: 'Concept, direction artistique et production.',
  },
  {
    icon: MonitorSmartphone,
    title: 'Déploiement',
    desc: 'Digital, contenus, supports et dispositifs.',
  },
  {
    icon: BarChart3,
    title: 'Performance',
    desc: 'Mesure, ajustement et montée en puissance.',
  },
];

const dynamicCapsules = [
  { icon: Eye, title: 'Vision claire', value: 'Brand clarity' },
  { icon: BadgeCheck, title: 'Image premium', value: 'Premium identity' },
  { icon: MousePointerClick, title: 'Activation ciblée', value: 'Audience focus' },
  { icon: ShieldCheck, title: 'Cohérence globale', value: 'Unified system' },
];

const avatars = [
  { initials: 'ST', label: 'Strategy' },
  { initials: 'BR', label: 'Brand' },
  { initials: 'UX', label: 'Digital' },
  { initials: 'CM', label: 'Content' },
];

const visualStats = computed(() => [
  {
    value: props.stats?.total_realisations ? `${props.stats.total_realisations}+` : `${props.realisations?.length || 0}+`,
    label: 'Projets',
    icon: CheckCircle2,
  },
  {
    value: props.stats?.total_clients ? `${props.stats.total_clients}+` : '360°',
    label: 'Marques',
    icon: UsersRound,
  },
  {
    value: props.stats?.total_actualites ? `${props.stats.total_actualites}+` : `${props.actualites?.length || 0}+`,
    label: 'Contenus',
    icon: BookOpen,
  },
  {
    value: '6',
    label: 'Expertises',
    icon: Rocket,
  },
]);

const featuredProjects = computed(() => props.realisations?.slice(0, 5) || []);
const latestArticles = computed(() => props.actualites?.slice(0, 3) || []);

const fallbackProjects = [
  { title: 'Brand Identity', label: 'Direction artistique' },
  { title: 'Digital Launch', label: 'Campagne digitale' },
  { title: 'Media Content', label: 'Production contenu' },
  { title: 'Growth Campaign', label: 'Activation marque' },
  { title: 'Social System', label: 'Présence réseaux' },
];

const activeServiceIndex = ref(0);
let serviceInterval = null;

const activeService = computed(() => services[activeServiceIndex.value]);

const setActiveService = (index) => {
  activeServiceIndex.value = index;
};

const startServiceRotation = () => {
  serviceInterval = setInterval(() => {
    activeServiceIndex.value = (activeServiceIndex.value + 1) % services.length;
  }, 3200);
};

onMounted(() => {
  startServiceRotation();
});

onUnmounted(() => {
  if (serviceInterval) {
    clearInterval(serviceInterval);
  }
});

const formatDate = (dateString) => {
  if (!dateString) return 'Actualité';

  const date = new Date(dateString);

  if (Number.isNaN(date.getTime())) {
    return dateString;
  }

  return date.toLocaleDateString('fr-FR', {
    day: 'numeric',
    month: 'short',
    year: 'numeric',
  });
};

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

    <!-- HERO -->
    <section class="relative isolate overflow-hidden bg-white pt-[clamp(5.5rem,7vw,8rem)]">
      <div class="absolute inset-0 bg-grid-soft"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_12%_18%,rgba(30,58,138,0.16),transparent_28%),radial-gradient(circle_at_82%_12%,rgba(16,185,129,0.16),transparent_30%),radial-gradient(circle_at_52%_88%,rgba(249,115,22,0.13),transparent_26%)]"></div>
      <div class="absolute inset-0 bg-gradient-to-b from-white/90 via-white/80 to-slate-50/95"></div>

      <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <img src="/logo.png" alt="" class="floating-logo left-[4%] top-[12%] h-16 w-auto opacity-[0.08]" />
        <img src="/logo.png" alt="" class="floating-logo floating-logo-slow right-[5%] top-[18%] h-20 w-auto opacity-[0.07]" />
        <img src="/logo.png" alt="" class="floating-logo floating-logo-reverse bottom-[12%] left-[8%] h-14 w-auto opacity-[0.08]" />
        <img src="/logo.png" alt="" class="floating-logo bottom-[18%] right-[12%] h-16 w-auto opacity-[0.06]" />

        <div class="morph-orb left-[12%] top-[30%] bg-brand-blue/[0.15]"></div>
        <div class="morph-orb morph-orb-two right-[10%] top-[24%] bg-brand-emerald/[0.15]"></div>
        <div class="morph-orb morph-orb-three bottom-[6%] left-[45%] bg-brand-orange/[0.15]"></div>
      </div>

      <div class="site-container relative z-10 flex min-h-[calc(100svh-6rem)] items-center pb-[clamp(3rem,7vw,6rem)]">
        <div class="grid w-full gap-[clamp(2rem,5vw,5rem)] lg:grid-cols-12 lg:items-center">
          <div class="lg:col-span-5">
            <div class="inline-flex items-center gap-2 rounded-2xl border border-brand-emerald/20 bg-white/80 px-4 py-2 text-xs font-black uppercase tracking-[0.22em] text-brand-blue shadow-sm backdrop-blur">
              <Sparkles :size="14" />
              Creative communication studio
            </div>

            <h1 class="mt-6 text-[clamp(3.1rem,6vw,5.4rem)] font-black leading-[0.92] tracking-tight text-brand-ink">
              Marque.
              <span class="block gradient-brand-text">Image.</span>
              <span class="block">Impact.</span>
            </h1>

            <p class="mt-6 max-w-xl text-base leading-8 text-brand-gray sm:text-lg">
              Une communication visuelle, stratégique et digitale pensée pour faire émerger les marques ambitieuses.
            </p>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
              <Link href="/contact" class="btn-primary">
                Démarrer un projet
                <ArrowRight :size="18" />
              </Link>

              <Link href="/portfolio" class="btn-secondary">
                Voir le studio
                <ArrowUpRight :size="18" />
              </Link>
            </div>

            <div class="mt-8 grid gap-3 sm:grid-cols-[auto_1fr] sm:items-center">
              <div class="flex -space-x-3">
                <div
                  v-for="avatar in avatars"
                  :key="avatar.initials"
                  class="flex h-12 w-12 items-center justify-center rounded-2xl border-2 border-white bg-gradient-to-br from-brand-blue to-brand-emerald text-xs font-black text-white shadow-sm"
                >
                  {{ avatar.initials }}
                </div>
              </div>

              <div class="rounded-2xl border border-slate-200 bg-white/80 p-4 shadow-sm backdrop-blur">
                <div class="text-sm font-black text-brand-ink">Studio intégré</div>
                <div class="text-xs font-semibold text-brand-gray">Stratégie · Branding · Digital · Contenu</div>
              </div>
            </div>
          </div>

          <div class="lg:col-span-7">
            <div class="visual-stage">
              <div class="orbital-ring orbital-ring-one"></div>
              <div class="orbital-ring orbital-ring-two"></div>
              <div class="orbital-ring orbital-ring-three"></div>

              <div class="visual-core">
                <div class="visual-core-top">
                  <div>
                    <span class="text-xs font-black uppercase tracking-[0.22em] text-brand-emerald">Kotava OS</span>
                    <h2 class="mt-2 text-2xl font-black text-white">Brand experience system</h2>
                  </div>

                  <img src="/logo_horizontal.png" alt="" class="h-10 w-10 object-contain" />
                </div>

                <div class="visual-dashboard">
                  <div class="visual-bar h-[72%]"></div>
                  <div class="visual-bar h-[52%]"></div>
                  <div class="visual-bar h-[88%]"></div>
                  <div class="visual-bar h-[64%]"></div>
                  <div class="visual-bar h-[76%]"></div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                  <div
                    v-for="item in visualStats.slice(0, 2)"
                    :key="item.label"
                    class="rounded-2xl border border-white/10 bg-white/[0.07] p-4"
                  >
                    <component :is="item.icon" :size="20" class="text-brand-emerald" />
                    <div class="mt-3 text-3xl font-black text-white">{{ item.value }}</div>
                    <div class="mt-1 text-xs font-semibold text-white/55">{{ item.label }}</div>
                  </div>
                </div>
              </div>

              <div class="floating-panel panel-a">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-brand-blue text-white">
                  <Target :size="20" />
                </div>
                <div>
                  <div class="text-sm font-black text-brand-ink">Positionnement</div>
                  <div class="text-xs text-brand-gray">Message clair</div>
                </div>
              </div>

              <div class="floating-panel panel-b">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-brand-orange text-white">
                  <Palette :size="20" />
                </div>
                <div>
                  <div class="text-sm font-black text-brand-ink">Identité</div>
                  <div class="text-xs text-brand-gray">Design mémorable</div>
                </div>
              </div>

              <div class="floating-panel panel-c">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-brand-emerald text-white">
                  <TrendingUp :size="20" />
                </div>
                <div>
                  <div class="text-sm font-black text-brand-ink">Croissance</div>
                  <div class="text-xs text-brand-gray">Audience engagée</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0 translate-y-1/2">
          <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white/70 py-4 shadow-sm backdrop-blur">
            <div class="marquee-track">
              <div
                v-for="i in 2"
                :key="i"
                class="marquee-group"
              >
                <span v-for="service in services" :key="`${i}-${service.title}`" class="marquee-item">
                  <img src="/logo_horizontal.png" alt="" class="h-5 w-5 object-contain" />
                  {{ service.title }}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- STATS -->
    <section class="relative bg-brand-dark pt-24 text-white sm:pt-28">
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(16,185,129,0.18),transparent_30%),radial-gradient(circle_at_bottom_right,rgba(249,115,22,0.12),transparent_30%)]"></div>
      <div class="absolute inset-0 opacity-[0.07] bg-grid-soft"></div>

      <div class="site-container relative">
        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
          <div
            v-for="item in visualStats"
            :key="item.label"
            class="group overflow-hidden rounded-[1.75rem] border border-white/10 bg-white/[0.06] p-5 backdrop-blur transition hover:-translate-y-1 hover:bg-white/[0.09]"
          >
            <div class="flex items-center justify-between">
              <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/10 text-brand-emerald">
                <component :is="item.icon" :size="22" />
              </div>

              <img src="/logo_horizontal.png" alt="" class="h-7 w-7 object-contain opacity-60" />
            </div>

            <div class="mt-6 text-4xl font-black text-white">{{ item.value }}</div>
            <div class="mt-1 text-sm font-semibold text-white/55">{{ item.label }}</div>
          </div>
        </div>
      </div>
    </section>

    <!-- SERVICES REWORKED -->
    <section class="relative overflow-hidden bg-brand-dark py-20 text-white sm:py-24 lg:py-28">
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_10%_20%,rgba(16,185,129,0.16),transparent_22%),radial-gradient(circle_at_90%_70%,rgba(249,115,22,0.10),transparent_22%)]"></div>
      <div class="absolute inset-0 opacity-[0.06] bg-grid-soft"></div>

      <div class="site-container relative">
        <div class="grid gap-8 lg:grid-cols-12 lg:items-center">
          <div class="lg:col-span-5">
            <div class="eyebrow-dark">
              <PlayCircle :size="15" />
              Services en mouvement
            </div>

            <h2 class="mt-5 text-4xl font-black tracking-tight text-white sm:text-5xl">
              Un avatar guide votre visite et présente nos expertises une à une.
            </h2>

            <p class="mt-5 max-w-xl text-base leading-8 text-white/65">
              Plus vivant, plus immersif, plus agence. Cette zone met réellement en scène les services au lieu de simplement les lister.
            </p>

            <div class="mt-8 service-stage">
              <div class="service-avatar-shell">
                <div class="service-avatar-glow"></div>

                <div class="service-avatar">
                  <div class="avatar-halo"></div>

                  <div class="avatar-head">
                    <div class="avatar-eye"></div>
                    <div class="avatar-eye"></div>
                    <div class="avatar-smile"></div>
                  </div>

                  <div class="avatar-body">
                    <div class="avatar-badge">
                      <img src="/logo_horizontal.png" alt="" class="h-5 w-5 object-contain" />
                    </div>
                  </div>

                  <div class="avatar-arm avatar-arm-left"></div>
                  <div class="avatar-arm avatar-arm-right"></div>
                </div>
              </div>

              <div class="service-speech">
                <div class="inline-flex items-center gap-2 rounded-xl bg-white px-3 py-2 text-xs font-black uppercase tracking-[0.18em] text-brand-blue ring-1 ring-slate-200">
                  <component :is="activeService.icon" :size="14" />
                  {{ activeService.label }}
                </div>

                <h3 class="mt-4 text-2xl font-black text-brand-ink sm:text-3xl">
                  {{ activeService.title }}
                </h3>

                <p class="mt-4 text-sm leading-7 text-brand-gray sm:text-base">
                  {{ activeService.speech }}
                </p>

                <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                  <Link :href="activeService.href" class="btn-primary">
                    Découvrir ce service
                    <ArrowRight :size="18" />
                  </Link>

                  <Link href="/services" class="btn-secondary">
                    Voir tous les services
                    <ArrowUpRight :size="18" />
                  </Link>
                </div>
              </div>
            </div>
          </div>

          <div class="lg:col-span-7">
            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
              <button
                v-for="(service, index) in services"
                :key="service.title"
                type="button"
                @click="setActiveService(index)"
                class="service-orbit-card group text-left"
                :class="activeServiceIndex === index ? 'service-orbit-card-active' : ''"
              >
                <div class="service-orbit-line"></div>

                <div class="relative">
                  <div
                    class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br text-white shadow-lg"
                    :class="service.accent"
                  >
                    <component :is="service.icon" :size="24" />
                  </div>

                  <div class="mt-7 flex items-start justify-between gap-3">
                    <div>
                      <h3 class="text-xl font-black text-white">
                        {{ service.title }}
                      </h3>
                      <p class="mt-2 text-sm font-semibold text-white/45">
                        {{ service.label }}
                      </p>
                    </div>

                    <div
                      class="flex h-9 w-9 items-center justify-center rounded-xl border border-white/10 text-white/40 transition group-hover:border-brand-orange/40 group-hover:text-brand-orange"
                    >
                      <ArrowRight :size="16" />
                    </div>
                  </div>

                  <p class="mt-5 text-sm leading-7 text-white/60">
                    {{ service.short }}
                  </p>

                  <div class="mt-6 flex items-center gap-2">
                    <div
                      v-for="dot in 3"
                      :key="dot"
                      class="h-2 w-2 rounded-full"
                      :class="activeServiceIndex === index && dot === 2 ? 'bg-brand-orange' : 'bg-white/20'"
                    ></div>
                  </div>
                </div>
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- STUDIO VIVANT REWORKED -->
    <section class="relative overflow-hidden bg-slate-50 py-20 sm:py-24 lg:py-28">
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_20%,rgba(30,58,138,0.08),transparent_28%),radial-gradient(circle_at_15%_70%,rgba(16,185,129,0.08),transparent_28%)]"></div>

      <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <img src="/logo.png" alt="" class="floating-logo left-[5%] top-[16%] h-14 w-auto opacity-[0.05]" />
        <img src="/logo.png" alt="" class="floating-logo floating-logo-reverse right-[4%] bottom-[12%] h-20 w-auto opacity-[0.05]" />
      </div>

      <div class="site-container relative">
        <div class="mb-10 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
          <div>
            <div class="eyebrow">
              <Layers3 :size="15" />
              Studio vivant
            </div>

            <h2 class="section-title mt-5 max-w-3xl">
              Un espace créatif qui montre comment la marque prend forme.
            </h2>
          </div>

          <div class="flex flex-wrap gap-3">
            <Link href="/about" class="btn-secondary">
              Notre approche
              <ArrowRight :size="17" />
            </Link>

            <Link href="/contact" class="btn-primary">
              Brief créatif
              <ArrowRight :size="17" />
            </Link>
          </div>
        </div>

        <div class="studio-lab">
          <div class="studio-lab-main">
            <div class="studio-screen">
              <div class="studio-screen-top">
                <div>
                  <div class="text-xs font-black uppercase tracking-[0.18em] text-brand-emerald">
                    Creative workflow
                  </div>
                  <h3 class="mt-2 text-3xl font-black text-white">
                    Le laboratoire de marque KOTAVA
                  </h3>
                </div>

                <div class="flex items-center gap-2">
                  <span class="screen-dot bg-brand-emerald"></span>
                  <span class="screen-dot bg-brand-orange"></span>
                  <span class="screen-dot bg-white/35"></span>
                </div>
              </div>

              <div class="studio-screen-grid">
                <div class="screen-panel screen-panel-large">
                  <div class="flex items-center justify-between">
                    <div class="text-sm font-black text-white">Brand board</div>
                    <Sparkles :size="18" class="text-brand-emerald" />
                  </div>

                  <div class="mt-5 screen-bars">
                    <div class="screen-bar h-[72%]"></div>
                    <div class="screen-bar h-[48%]"></div>
                    <div class="screen-bar h-[88%]"></div>
                    <div class="screen-bar h-[60%]"></div>
                  </div>
                </div>

                <div class="screen-panel">
                  <div class="text-sm font-black text-white">Assets</div>
                  <div class="mt-4 grid grid-cols-2 gap-3">
                    <div class="asset-box bg-brand-blue"></div>
                    <div class="asset-box bg-brand-emerald"></div>
                    <div class="asset-box bg-brand-orange"></div>
                    <div class="asset-box bg-white/20"></div>
                  </div>
                </div>

                <div class="screen-panel">
                  <div class="text-sm font-black text-white">Flow</div>
                  <div class="mt-4 space-y-3">
                    <div class="flow-pill">Brief</div>
                    <div class="flow-pill">Design</div>
                    <div class="flow-pill">Déploiement</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="studio-floating studio-floating-a">
              <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-brand-blue text-white">
                <Search :size="20" />
              </div>
              <div>
                <div class="text-sm font-black text-brand-ink">Analyse</div>
                <div class="text-xs text-brand-gray">Observation & diagnostic</div>
              </div>
            </div>

            <div class="studio-floating studio-floating-b">
              <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-brand-orange text-white">
                <Wand2 :size="20" />
              </div>
              <div>
                <div class="text-sm font-black text-brand-ink">Création</div>
                <div class="text-xs text-brand-gray">Concept & design</div>
              </div>
            </div>

            <div class="studio-floating studio-floating-c">
              <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-brand-emerald text-white">
                <TrendingUp :size="20" />
              </div>
              <div>
                <div class="text-sm font-black text-brand-ink">Croissance</div>
                <div class="text-xs text-brand-gray">Activation & performance</div>
              </div>
            </div>
          </div>

          <div class="studio-lab-side">
            <div class="studio-side-card">
              <div class="text-xs font-black uppercase tracking-[0.18em] text-brand-blue">
                Pipeline créatif
              </div>

              <div class="mt-6 space-y-4">
                <div
                  v-for="pillar in studioPillars"
                  :key="pillar.title"
                  class="flex items-start gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-4"
                >
                  <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-white text-brand-blue shadow-sm">
                    <component :is="pillar.icon" :size="20" />
                  </div>

                  <div>
                    <div class="text-base font-black text-brand-ink">{{ pillar.title }}</div>
                    <div class="mt-1 text-sm leading-6 text-brand-gray">{{ pillar.desc }}</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="studio-side-card studio-side-card-dark">
              <div class="text-xs font-black uppercase tracking-[0.18em] text-brand-emerald">
                Valeur créée
              </div>

              <div class="mt-6 grid gap-3 sm:grid-cols-2 lg:grid-cols-1">
                <div
                  v-for="item in dynamicCapsules"
                  :key="item.title"
                  class="rounded-2xl border border-white/10 bg-white/[0.06] p-4"
                >
                  <component :is="item.icon" :size="18" class="text-brand-emerald" />
                  <div class="mt-3 text-sm font-black text-white">{{ item.title }}</div>
                  <div class="mt-1 text-xs font-semibold text-white/55">{{ item.value }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- PORTFOLIO -->
    <section class="relative overflow-hidden bg-white py-20 sm:py-24 lg:py-28">
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_15%_25%,rgba(16,185,129,0.08),transparent_28%),radial-gradient(circle_at_85%_70%,rgba(30,58,138,0.08),transparent_28%)]"></div>

      <div class="site-container relative">
        <div class="mb-10 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
          <div>
            <div class="eyebrow">
              <Camera :size="15" />
              Réalisations dynamiques
            </div>

            <h2 class="section-title mt-5 max-w-3xl">
              Les projets publiés dans l’administration apparaissent ici automatiquement.
            </h2>
          </div>

          <Link href="/portfolio" class="btn-dark">
            Voir le portfolio
            <ArrowRight :size="18" />
          </Link>
        </div>

        <div v-if="featuredProjects.length" class="portfolio-grid">
          <Link
            v-for="(project, index) in featuredProjects"
            :key="project.id"
            :href="`/portfolio/${project.slug}`"
            :class="['project-card group', index === 0 ? 'project-card-large' : '']"
          >
            <img
              v-if="project.image"
              :src="project.image"
              :alt="project.titre"
              class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-105"
            />

            <div v-else class="absolute inset-0 bg-brand-radial-dark"></div>

            <div class="absolute inset-0 bg-gradient-to-t from-brand-dark via-brand-dark/35 to-transparent"></div>

            <div class="absolute left-5 top-5">
              <div class="inline-flex items-center gap-2 rounded-xl bg-white/[0.12] px-3 py-1.5 text-xs font-black uppercase tracking-wide text-white backdrop-blur">
                <img src="/logo_horizontal.png" alt="" class="h-4 w-4 object-contain" />
                {{ project.client || 'Projet KOTAVA' }}
              </div>
            </div>

            <div class="absolute bottom-5 left-5 right-5">
              <h3 class="text-2xl font-black text-white">
                {{ project.titre }}
              </h3>

              <p class="mt-2 line-clamp-2 max-w-xl text-sm leading-6 text-white/70">
                {{ project.description }}
              </p>

              <div class="mt-4 inline-flex items-center gap-2 text-sm font-black text-white">
                Voir
                <ArrowRight :size="16" class="transition group-hover:translate-x-1" />
              </div>
            </div>
          </Link>
        </div>

        <div v-else class="portfolio-grid">
          <div
            v-for="(project, index) in fallbackProjects"
            :key="project.title"
            :class="['project-card group', index === 0 ? 'project-card-large' : '']"
          >
            <div class="absolute inset-0 bg-brand-radial-dark"></div>
            <div class="absolute inset-0 opacity-20 bg-grid-soft"></div>
            <img src="/logo.png" alt="" class="absolute right-6 top-6 h-20 w-auto opacity-[0.15]" />

            <div class="absolute bottom-5 left-5 right-5">
              <div class="inline-flex rounded-xl bg-white/[0.12] px-3 py-1.5 text-xs font-black uppercase tracking-wide text-white backdrop-blur">
                {{ project.label }}
              </div>

              <h3 class="mt-3 text-2xl font-black text-white">
                {{ project.title }}
              </h3>

              <p class="mt-3 text-sm leading-6 text-white/65">
                Publie tes réalisations depuis le dashboard pour remplacer ces visuels automatiquement.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ACTUALITES -->
    <section class="relative overflow-hidden bg-slate-50 py-20 sm:py-24">
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(249,115,22,0.08),transparent_25%),radial-gradient(circle_at_80%_80%,rgba(16,185,129,0.08),transparent_25%)]"></div>

      <div class="site-container relative">
        <div class="mb-10 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
          <div>
            <div class="eyebrow">
              <BookOpen :size="15" />
              Actualités dynamiques
            </div>

            <h2 class="section-title mt-5 max-w-3xl">
              Les dernières publications de KOTAVA Communication.
            </h2>
          </div>

          <Link href="/blog" class="btn-secondary">
            Voir le blog
            <ArrowRight :size="18" />
          </Link>
        </div>

        <div v-if="latestArticles.length" class="grid gap-5 lg:grid-cols-3">
          <Link
            v-for="(article, index) in latestArticles"
            :key="article.id"
            :href="`/blog/${article.slug}`"
            :class="[
              'article-card group',
              index === 0 ? 'lg:col-span-2' : ''
            ]"
          >
            <div class="relative min-h-[280px] overflow-hidden bg-brand-light">
              <img
                v-if="article.image"
                :src="article.image"
                :alt="article.titre"
                class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-105"
              />

              <div v-else class="absolute inset-0 bg-brand-radial"></div>
              <div class="absolute inset-0 bg-gradient-to-t from-brand-dark/80 via-brand-dark/20 to-transparent"></div>

              <div class="absolute left-5 top-5 rounded-xl bg-white/90 px-3 py-1.5 text-xs font-black uppercase tracking-[0.18em] text-brand-blue backdrop-blur">
                {{ formatDate(article.date || article.date_publication) }}
              </div>

              <div class="absolute bottom-5 left-5 right-5">
                <h3 class="text-2xl font-black text-white">
                  {{ article.titre }}
                </h3>

                <p class="mt-3 line-clamp-2 text-sm leading-6 text-white/70">
                  {{ article.extrait }}
                </p>

                <div class="mt-4 inline-flex items-center gap-2 text-sm font-black text-white">
                  Lire
                  <ArrowRight :size="16" class="transition group-hover:translate-x-1" />
                </div>
              </div>
            </div>
          </Link>
        </div>

        <div v-else class="rounded-[2rem] border border-dashed border-slate-300 bg-white p-8 text-center shadow-sm">
          <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-brand-light text-brand-blue">
            <BookOpen :size="30" />
          </div>

          <h3 class="mt-5 text-xl font-black text-brand-ink">
            Aucune actualité publiée pour le moment.
          </h3>

          <p class="mx-auto mt-3 max-w-xl text-sm leading-7 text-brand-gray">
            Les articles publiés depuis le tableau de bord apparaîtront automatiquement dans cette section.
          </p>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="relative overflow-hidden bg-white py-20 sm:py-24 lg:py-28">
      <div class="site-container">
        <div class="relative overflow-hidden rounded-[2rem] bg-brand-dark p-8 text-white shadow-soft sm:p-10 lg:p-14">
          <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(16,185,129,0.22),transparent_30%),radial-gradient(circle_at_bottom_right,rgba(249,115,22,0.15),transparent_30%)]"></div>
          <div class="absolute inset-0 opacity-[0.06] bg-grid-soft"></div>

          <img src="/logo.png" alt="" class="absolute -right-10 -top-10 h-52 w-auto opacity-[0.06]" />
          <img src="/logo.png" alt="" class="absolute -bottom-12 left-10 h-48 w-auto opacity-[0.05]" />

          <div class="relative grid gap-10 lg:grid-cols-12 lg:items-center">
            <div class="lg:col-span-8">
              <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/5 px-4 py-2 text-xs font-black uppercase tracking-[0.22em] text-brand-emerald">
                <Sparkles :size="14" />
                Ready to build
              </div>

              <h2 class="mt-6 max-w-4xl text-4xl font-black tracking-tight text-white sm:text-5xl lg:text-6xl">
                Votre marque mérite une présence qui marque les esprits.
              </h2>

              <div class="mt-8 grid gap-3 sm:grid-cols-3">
                <div class="rounded-2xl border border-white/10 bg-white/[0.06] p-4">
                  <MousePointerClick :size="22" class="text-brand-emerald" />
                  <div class="mt-3 text-sm font-black text-white">Brief</div>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/[0.06] p-4">
                  <BadgeCheck :size="22" class="text-brand-emerald" />
                  <div class="mt-3 text-sm font-black text-white">Stratégie</div>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/[0.06] p-4">
                  <Rocket :size="22" class="text-brand-emerald" />
                  <div class="mt-3 text-sm font-black text-white">Déploiement</div>
                </div>
              </div>
            </div>

            <div class="flex flex-col gap-3 lg:col-span-4">
              <Link href="/contact" class="btn-primary">
                Lancer le projet
                <ArrowRight :size="18" />
              </Link>

              <a :href="contactPhoneHref" class="btn-light">
                <Phone :size="18" />
                {{ contactPhoneDisplay }}
              </a>

              <a :href="`mailto:${contactEmail}`" class="btn-light">
                <Mail :size="18" />
                {{ contactEmail }}
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </GuestLayout>
</template>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.floating-logo {
  position: absolute;
  animation: floatingLogo 16s ease-in-out infinite;
  will-change: transform;
}

.floating-logo-slow {
  animation-duration: 22s;
}

.floating-logo-reverse {
  animation-direction: reverse;
}

.morph-orb {
  position: absolute;
  height: clamp(14rem, 24vw, 22rem);
  width: clamp(14rem, 24vw, 22rem);
  border-radius: 35% 65% 60% 40%;
  filter: blur(48px);
  animation: morphOrb 14s ease-in-out infinite;
  will-change: transform, border-radius;
}

.morph-orb-two {
  animation-delay: 2s;
  animation-duration: 18s;
}

.morph-orb-three {
  animation-delay: 4s;
  animation-duration: 20s;
}

.visual-stage {
  position: relative;
  min-height: clamp(430px, calc(100svh - 150px), 700px);
  width: 100%;
  max-width: min(100%, 820px);
  margin-inline: auto;
  display: flex;
  align-items: center;
  justify-content: center;
  perspective: 1200px;
}

.visual-core {
  position: relative;
  z-index: 10;
  width: clamp(310px, 35vw, 500px);
  border-radius: clamp(1.5rem, 2vw, 2rem);
  padding: clamp(1rem, 1.4vw, 1.25rem);
  background:
    radial-gradient(circle at top left, rgba(16, 185, 129, 0.18), transparent 35%),
    radial-gradient(circle at bottom right, rgba(249, 115, 22, 0.16), transparent 35%),
    #0b1220;
  box-shadow: 0 40px 100px rgba(15, 23, 42, 0.24);
  transform: rotateY(-8deg) rotateX(4deg);
  animation: coreFloat 7s ease-in-out infinite;
  will-change: transform;
}

.visual-core-top {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 1rem;
  border-radius: clamp(1.1rem, 1.6vw, 1.5rem);
  border: 1px solid rgba(255, 255, 255, 0.1);
  padding: clamp(1rem, 1.4vw, 1.25rem);
  background: rgba(255, 255, 255, 0.06);
}

.visual-dashboard {
  margin-top: 1rem;
  height: clamp(170px, 23vw, 230px);
  display: flex;
  align-items: end;
  gap: clamp(0.5rem, 1vw, 0.85rem);
  border-radius: clamp(1.1rem, 1.6vw, 1.5rem);
  padding: clamp(0.75rem, 1.2vw, 1rem);
  background: rgba(255, 255, 255, 0.06);
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.visual-bar {
  flex: 1;
  min-height: 25%;
  border-radius: 1rem 1rem 0.4rem 0.4rem;
  background: linear-gradient(180deg, #10B981, #1E3A8A);
  animation: barPulse 3s ease-in-out infinite;
  transform-origin: bottom;
}

.visual-bar:nth-child(2) { animation-delay: 0.3s; }
.visual-bar:nth-child(3) { animation-delay: 0.6s; }
.visual-bar:nth-child(4) { animation-delay: 0.9s; }
.visual-bar:nth-child(5) { animation-delay: 1.2s; }

.orbital-ring {
  position: absolute;
  border-radius: 999px;
  border: 1px solid rgba(30, 58, 138, 0.12);
  animation: rotateRing 24s linear infinite;
  pointer-events: none;
}

.orbital-ring-one {
  width: clamp(360px, 42vw, 560px);
  height: clamp(360px, 42vw, 560px);
}

.orbital-ring-two {
  width: clamp(420px, 52vw, 700px);
  height: clamp(250px, 30vw, 420px);
  transform: rotate(-18deg);
  animation-duration: 30s;
}

.orbital-ring-three {
  width: clamp(300px, 34vw, 470px);
  height: clamp(430px, 50vw, 680px);
  transform: rotate(22deg);
  animation-duration: 34s;
  animation-direction: reverse;
}

.floating-panel {
  position: absolute;
  z-index: 20;
  display: flex;
  align-items: center;
  gap: 0.85rem;
  width: clamp(185px, 15vw, 225px);
  border-radius: 1.5rem;
  border: 1px solid rgba(226, 232, 240, 0.9);
  background: rgba(255, 255, 255, 0.88);
  padding: clamp(0.8rem, 1vw, 1rem);
  box-shadow: 0 24px 70px rgba(15, 23, 42, 0.12);
  backdrop-filter: blur(18px);
  animation: panelFloat 6s ease-in-out infinite;
  will-change: transform;
}

.panel-a {
  left: clamp(-2rem, -2vw, 0rem);
  top: clamp(4rem, 12vw, 6rem);
}

.panel-b {
  right: clamp(-2rem, -2vw, 0rem);
  top: clamp(13rem, 22vw, 16rem);
  animation-delay: 1s;
}

.panel-c {
  left: clamp(0rem, 4vw, 3.5rem);
  bottom: clamp(4rem, 10vw, 7rem);
  animation-delay: 2s;
}

.marquee-track {
  display: flex;
  width: max-content;
  animation: marquee 22s linear infinite;
}

.marquee-group {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding-right: 0.75rem;
}

.marquee-item {
  display: inline-flex;
  align-items: center;
  gap: 0.65rem;
  border-radius: 1rem;
  background: #ffffff;
  padding: 0.75rem 1rem;
  font-size: 0.8rem;
  font-weight: 900;
  color: #1E3A8A;
  box-shadow: inset 0 0 0 1px rgba(226, 232, 240, 0.9);
  white-space: nowrap;
}

/* SERVICES NEW */
.service-stage {
  margin-top: 2rem;
  display: grid;
  gap: 1rem;
  grid-template-columns: minmax(120px, 150px) minmax(0, 1fr);
  align-items: center;
  border-radius: 2rem;
  border: 1px solid rgba(226, 232, 240, 0.12);
  background: rgba(255, 255, 255, 0.9);
  padding: 1rem;
  box-shadow: 0 24px 80px rgba(15, 23, 42, 0.18);
}

.service-avatar-shell {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 200px;
}

.service-avatar-glow {
  position: absolute;
  height: 140px;
  width: 140px;
  border-radius: 999px;
  background: radial-gradient(circle, rgba(16,185,129,0.35), rgba(30,58,138,0.15), transparent 70%);
  filter: blur(10px);
  animation: pulseHalo 3.5s ease-in-out infinite;
}

.service-avatar {
  position: relative;
  width: 120px;
  height: 150px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.avatar-halo {
  position: absolute;
  top: 0.25rem;
  width: 96px;
  height: 96px;
  border-radius: 999px;
  border: 1px dashed rgba(16, 185, 129, 0.4);
  animation: spinSlow 10s linear infinite;
}

.avatar-head {
  position: relative;
  z-index: 2;
  margin-top: 1rem;
  height: 56px;
  width: 56px;
  border-radius: 999px;
  background: linear-gradient(180deg, #ffffff, #dbeafe);
  box-shadow: 0 10px 30px rgba(15, 23, 42, 0.12);
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.45rem;
}

.avatar-eye {
  width: 6px;
  height: 6px;
  border-radius: 999px;
  background: #1E3A8A;
  margin-top: -4px;
}

.avatar-smile {
  position: absolute;
  bottom: 14px;
  width: 18px;
  height: 8px;
  border-bottom: 2px solid #10B981;
  border-radius: 0 0 999px 999px;
}

.avatar-body {
  position: relative;
  margin-top: 0.7rem;
  width: 88px;
  height: 68px;
  border-radius: 1.5rem;
  background: linear-gradient(135deg, #1E3A8A, #10B981);
  box-shadow: 0 18px 40px rgba(15, 23, 42, 0.2);
}

.avatar-badge {
  position: absolute;
  right: -6px;
  top: -8px;
  display: flex;
  height: 30px;
  width: 30px;
  align-items: center;
  justify-content: center;
  border-radius: 999px;
  background: white;
  box-shadow: 0 8px 22px rgba(15, 23, 42, 0.12);
}

.avatar-arm {
  position: absolute;
  top: 82px;
  width: 16px;
  height: 54px;
  border-radius: 999px;
  background: linear-gradient(180deg, #10B981, #1E3A8A);
}

.avatar-arm-left {
  left: 10px;
  transform: rotate(28deg);
  animation: armWaveLeft 3.2s ease-in-out infinite;
}

.avatar-arm-right {
  right: 10px;
  transform: rotate(-28deg);
  animation: armWaveRight 3.2s ease-in-out infinite;
}

.service-speech {
  position: relative;
  border-radius: 1.5rem;
  background: linear-gradient(180deg, #ffffff, #f8fafc);
  padding: 1.25rem;
  box-shadow: inset 0 0 0 1px rgba(226, 232, 240, 0.9);
}

.service-speech::before {
  content: '';
  position: absolute;
  left: -8px;
  top: 34px;
  width: 18px;
  height: 18px;
  background: #ffffff;
  transform: rotate(45deg);
  box-shadow: -1px 1px 0 rgba(226, 232, 240, 0.8);
}

.service-orbit-card {
  position: relative;
  overflow: hidden;
  min-height: 255px;
  border-radius: 1.8rem;
  border: 1px solid rgba(255, 255, 255, 0.12);
  background: rgba(255, 255, 255, 0.06);
  padding: 1.4rem;
  backdrop-filter: blur(16px);
  transition: all 0.3s ease;
}

.service-orbit-card:hover,
.service-orbit-card-active {
  transform: translateY(-8px);
  background: rgba(255, 255, 255, 0.09);
  border-color: rgba(16, 185, 129, 0.35);
  box-shadow: 0 25px 80px rgba(15, 23, 42, 0.18);
}

.service-orbit-line {
  position: absolute;
  right: -25px;
  top: -25px;
  width: 120px;
  height: 120px;
  border-radius: 2rem;
  background: radial-gradient(circle, rgba(16,185,129,0.18), transparent 68%);
  filter: blur(10px);
}

/* STUDIO VIVANT NEW */
.studio-lab {
  display: grid;
  gap: 1rem;
  grid-template-columns: minmax(0, 1.55fr) minmax(320px, 0.85fr);
}

.studio-lab-main {
  position: relative;
  min-height: 640px;
  overflow: hidden;
  border-radius: 2rem;
  background:
    radial-gradient(circle at top left, rgba(16,185,129,0.12), transparent 26%),
    radial-gradient(circle at bottom right, rgba(249,115,22,0.10), transparent 24%),
    linear-gradient(180deg, #ffffff, #f8fafc);
  border: 1px solid rgba(226, 232, 240, 0.9);
  box-shadow: 0 30px 90px rgba(15, 23, 42, 0.08);
  padding: 1.5rem;
}

.studio-screen {
  position: relative;
  z-index: 2;
  width: min(100%, 640px);
  margin: 2rem auto 0;
  border-radius: 2rem;
  padding: 1.25rem;
  background:
    radial-gradient(circle at top left, rgba(16,185,129,0.18), transparent 32%),
    radial-gradient(circle at bottom right, rgba(249,115,22,0.14), transparent 32%),
    #0b1220;
  box-shadow: 0 45px 100px rgba(15, 23, 42, 0.22);
  transform: perspective(1200px) rotateX(4deg) rotateY(-6deg);
}

.studio-screen-top {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 1rem;
}

.screen-dot {
  display: inline-flex;
  width: 10px;
  height: 10px;
  border-radius: 999px;
}

.studio-screen-grid {
  margin-top: 1rem;
  display: grid;
  gap: 0.9rem;
  grid-template-columns: 1.3fr 0.7fr;
}

.screen-panel {
  border-radius: 1.4rem;
  border: 1px solid rgba(255,255,255,0.08);
  background: rgba(255,255,255,0.06);
  padding: 1rem;
  min-height: 180px;
}

.screen-panel-large {
  grid-row: span 2;
  min-height: 380px;
}

.screen-bars {
  display: flex;
  align-items: end;
  gap: 0.75rem;
  height: 260px;
}

.screen-bar {
  flex: 1;
  min-height: 25%;
  border-radius: 1rem 1rem 0.45rem 0.45rem;
  background: linear-gradient(180deg, #10B981, #1E3A8A);
  animation: barPulse 3s ease-in-out infinite;
}

.asset-box {
  height: 64px;
  border-radius: 1rem;
  box-shadow: inset 0 0 0 1px rgba(255,255,255,0.08);
}

.flow-pill {
  border-radius: 1rem;
  background: rgba(255,255,255,0.1);
  padding: 0.8rem 1rem;
  font-size: 0.85rem;
  font-weight: 800;
  color: white;
}

.studio-floating {
  position: absolute;
  z-index: 3;
  display: flex;
  align-items: center;
  gap: 0.85rem;
  width: 220px;
  border-radius: 1.4rem;
  border: 1px solid rgba(226,232,240,0.9);
  background: rgba(255,255,255,0.94);
  padding: 0.9rem;
  box-shadow: 0 22px 60px rgba(15, 23, 42, 0.12);
  backdrop-filter: blur(14px);
  animation: panelFloat 6s ease-in-out infinite;
}

.studio-floating-a {
  left: 1.2rem;
  top: 1.5rem;
}

.studio-floating-b {
  right: 1.5rem;
  top: 11rem;
  animation-delay: 1s;
}

.studio-floating-c {
  left: 2rem;
  bottom: 1.5rem;
  animation-delay: 2s;
}

.studio-lab-side {
  display: grid;
  gap: 1rem;
}

.studio-side-card {
  border-radius: 2rem;
  border: 1px solid rgba(226, 232, 240, 0.9);
  background: white;
  padding: 1.25rem;
  box-shadow: 0 20px 60px rgba(15, 23, 42, 0.06);
}

.studio-side-card-dark {
  background:
    radial-gradient(circle at top left, rgba(16,185,129,0.18), transparent 30%),
    radial-gradient(circle at bottom right, rgba(249,115,22,0.12), transparent 30%),
    #0b1220;
  border-color: rgba(255,255,255,0.06);
}

/* PORTFOLIO / ARTICLES */
.portfolio-grid {
  display: grid;
  gap: 1rem;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  grid-auto-rows: clamp(230px, 18vw, 300px);
}

.project-card {
  position: relative;
  overflow: hidden;
  border-radius: 1.85rem;
  background: #0b1220;
  box-shadow: 0 18px 50px rgba(15, 23, 42, 0.12);
  min-height: 230px;
}

.project-card-large {
  grid-column: span 2;
  grid-row: span 2;
}

.article-card {
  overflow: hidden;
  border-radius: 2rem;
  border: 1px solid rgba(226, 232, 240, 0.9);
  background: #ffffff;
  box-shadow: 0 18px 50px rgba(15, 23, 42, 0.08);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.article-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 28px 80px rgba(15, 23, 42, 0.13);
}

/* ANIMATIONS */
@keyframes floatingLogo {
  0%, 100% {
    transform: translate3d(0, 0, 0) rotate(0deg);
  }
  25% {
    transform: translate3d(20px, -16px, 0) rotate(4deg);
  }
  50% {
    transform: translate3d(-10px, -28px, 0) rotate(-3deg);
  }
  75% {
    transform: translate3d(-18px, 8px, 0) rotate(4deg);
  }
}

@keyframes morphOrb {
  0%, 100% {
    transform: translate(0, 0) scale(1);
    border-radius: 35% 65% 60% 40%;
  }
  50% {
    transform: translate(18px, -16px) scale(1.08);
    border-radius: 62% 38% 42% 58%;
  }
}

@keyframes coreFloat {
  0%, 100% {
    transform: rotateY(-8deg) rotateX(4deg) translateY(0);
  }
  50% {
    transform: rotateY(-4deg) rotateX(2deg) translateY(-14px);
  }
}

@keyframes panelFloat {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-14px);
  }
}

@keyframes rotateRing {
  to {
    transform: rotate(360deg);
  }
}

@keyframes barPulse {
  0%, 100% {
    opacity: 0.75;
    transform: scaleY(1);
  }
  50% {
    opacity: 1;
    transform: scaleY(1.06);
  }
}

@keyframes marquee {
  to {
    transform: translateX(-50%);
  }
}

@keyframes pulseHalo {
  0%, 100% {
    transform: scale(1);
    opacity: 0.8;
  }
  50% {
    transform: scale(1.08);
    opacity: 1;
  }
}

@keyframes spinSlow {
  to {
    transform: rotate(360deg);
  }
}

@keyframes armWaveLeft {
  0%, 100% {
    transform: rotate(28deg);
  }
  50% {
    transform: rotate(10deg);
  }
}

@keyframes armWaveRight {
  0%, 100% {
    transform: rotate(-28deg);
  }
  50% {
    transform: rotate(-8deg);
  }
}

/* RESPONSIVE */
@media (max-width: 1280px) {
  .floating-panel {
    width: 190px;
  }

  .panel-a {
    left: -0.75rem;
  }

  .panel-b {
    right: -0.75rem;
  }

  .visual-core {
    width: clamp(320px, 38vw, 450px);
  }
}

@media (max-width: 1180px) {
  .visual-stage {
    min-height: auto;
    padding-block: 2rem;
  }

  .floating-panel {
    display: none;
  }

  .visual-core {
    width: min(100%, 520px);
    transform: none;
  }

  .orbital-ring-two,
  .orbital-ring-three {
    display: none;
  }

  .studio-lab {
    grid-template-columns: 1fr;
  }

  .studio-lab-main {
    min-height: auto;
  }

  .studio-screen {
    transform: none;
    width: 100%;
  }

  .studio-floating {
    display: none;
  }
}

@media (max-width: 1024px) {
  .portfolio-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }

  .project-card-large {
    grid-column: span 2;
    grid-row: span 1;
  }

  .service-stage {
    grid-template-columns: 1fr;
    justify-items: center;
  }

  .service-speech::before {
    display: none;
  }
}

@media (max-width: 640px) {
  .visual-stage {
    min-height: auto;
    padding-block: 1rem 2rem;
  }

  .orbital-ring {
    display: none;
  }

  .visual-core {
    width: 100%;
    border-radius: 1.5rem;
    padding: 1rem;
  }

  .visual-dashboard {
    height: 170px;
  }

  .portfolio-grid {
    grid-template-columns: 1fr;
    grid-auto-rows: 340px;
  }

  .project-card-large {
    grid-column: span 1;
    grid-row: span 1;
  }

  .marquee-track {
    animation-duration: 18s;
  }

  .studio-screen-grid {
    grid-template-columns: 1fr;
  }

  .screen-panel-large {
    grid-row: span 1;
    min-height: 240px;
  }

  .screen-bars {
    height: 160px;
  }

  .service-orbit-card {
    min-height: auto;
  }
}

@media (min-width: 1600px) {
  .visual-stage {
    min-height: 760px;
  }

  .visual-core {
    width: 540px;
  }

  .floating-panel {
    width: 240px;
  }

  .portfolio-grid {
    grid-auto-rows: 320px;
  }
}

@media (prefers-reduced-motion: reduce) {
  .floating-logo,
  .morph-orb,
  .visual-core,
  .floating-panel,
  .orbital-ring,
  .visual-bar,
  .marquee-track,
  .service-avatar-glow,
  .avatar-halo,
  .avatar-arm,
  .studio-floating,
  .screen-bar {
    animation: none !important;
  }
}
</style>
