<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/GuestLayout.vue';
import {
  ArrowRight,
  ArrowUpRight,
  Award,
  BadgeCheck,
  CalendarDays,
  CheckCircle2,
  Clock3,
  Globe2,
  Layers3,
  Mail,
  MessageCircle,
  Palette,
  Phone,
  Rocket,
  Send,
  ShieldCheck,
  Sparkles,
  Star,
  Target,
  TrendingUp,
  UsersRound,
  Video,
  Wand2,
  Zap,
} from 'lucide-vue-next';

defineOptions({ layout: MainLayout });

const contactEmail = 'Contact@kotavacom.com';
const contactPhoneDisplay = '+229 93 37 49 63';
const contactPhoneHref = 'tel:+22993374963';

const services = [
  {
    number: '01',
    title: 'Stratégie & Conseil',
    subtitle: 'Clarifier, positionner, structurer.',
    text: 'Audit, positionnement, stratégie de communication et plan d’action pour guider votre marque avec précision.',
    href: '/services/strategie-conseil',
    icon: Target,
    color: 'text-brand-emerald',
    bg: 'bg-brand-emerald',
    glow: 'bg-brand-emerald/20',
    visual: 'strategy',
    features: ['Audit de marque', 'Positionnement', 'Plan de communication'],
  },
  {
    number: '02',
    title: 'Branding & Design',
    subtitle: 'Créer une identité qui marque.',
    text: 'Logo, identité visuelle, charte graphique, supports print et digitaux pour rendre votre marque reconnaissable.',
    href: '/services/branding-design',
    icon: Palette,
    color: 'text-brand-orange',
    bg: 'bg-brand-orange',
    glow: 'bg-brand-orange/20',
    visual: 'branding',
    features: ['Logo', 'Charte graphique', 'Supports visuels'],
  },
  {
    number: '03',
    title: 'Digital & Web',
    subtitle: 'Construire une présence digitale solide.',
    text: 'Sites web, interfaces, plateformes et optimisation SEO pour rendre votre marque visible, crédible et accessible.',
    href: '/services/digital-web',
    icon: Globe2,
    color: 'text-brand-blue',
    bg: 'bg-brand-blue',
    glow: 'bg-brand-blue/20',
    visual: 'digital',
    features: ['Site vitrine', 'UX/UI Design', 'SEO'],
  },
  {
    number: '04',
    title: 'Production Audiovisuelle',
    subtitle: 'Produire du contenu qui capte.',
    text: 'Photo, vidéo, motion design et formats courts pour raconter votre marque avec un rendu professionnel.',
    href: '/services/audiovisuel',
    icon: Video,
    color: 'text-brand-orange',
    bg: 'bg-brand-orange',
    glow: 'bg-brand-orange/20',
    visual: 'video',
    features: ['Photo', 'Vidéo', 'Motion design'],
  },
  {
    number: '05',
    title: 'Événementiel & RP',
    subtitle: 'Créer des expériences visibles.',
    text: 'Événements, relations publiques, relations presse et activations terrain pour renforcer votre impact.',
    href: '/services/evenementiel',
    icon: CalendarDays,
    color: 'text-brand-emerald',
    bg: 'bg-brand-emerald',
    glow: 'bg-brand-emerald/20',
    visual: 'event',
    features: ['Événements', 'RP', 'Influence'],
  },
  {
    number: '06',
    title: 'Social Media & Contenu',
    subtitle: 'Publier, engager, convertir.',
    text: 'Planning éditorial, création de contenu, community management et campagnes sponsorisées.',
    href: '/services/social-media',
    icon: MessageCircle,
    color: 'text-brand-emerald',
    bg: 'bg-brand-emerald',
    glow: 'bg-brand-emerald/20',
    visual: 'social',
    features: ['Contenu', 'Community management', 'Ads'],
  },
];

const stats = [
  { value: '6', label: 'Expertises', icon: Layers3 },
  { value: '100+', label: 'Projets réalisés', icon: Award },
  { value: '1000+', label: 'Contenus produits', icon: TrendingUp },
  { value: '360°', label: 'Vision de marque', icon: Target },
];

const process = [
  { title: 'Diagnostic', text: 'On analyse votre marque et votre contexte.', icon: Target },
  { title: 'Direction', text: 'On définit la stratégie et l’angle créatif.', icon: Wand2 },
  { title: 'Production', text: 'On crée les supports, contenus et expériences.', icon: Rocket },
  { title: 'Activation', text: 'On déploie, mesure et améliore.', icon: Zap },
];

const packs = [
  {
    title: 'Pack Branding',
    text: 'Identité visuelle professionnelle pour lancer ou repositionner votre marque.',
    icon: Palette,
    features: ['Logo + déclinaisons', 'Charte graphique', 'Supports essentiels'],
  },
  {
    title: 'Pack Digital',
    text: 'Présence web claire, moderne et optimisée pour votre activité.',
    icon: Globe2,
    features: ['Site responsive', 'UX/UI Design', 'SEO de base'],
  },
  {
    title: 'Pack Social Media',
    text: 'Réseaux sociaux structurés avec contenu régulier et reporting.',
    icon: MessageCircle,
    features: ['Planning éditorial', 'Création de contenus', 'Gestion réseaux sociaux'],
  },
  {
    title: 'Pack 360° Premium',
    text: 'Accompagnement global pour une communication complète et cohérente.',
    icon: Star,
    features: ['Stratégie', 'Branding', 'Web', 'Contenu'],
  },
];
</script>

<template>
  <Head title="Services — KOTAVA Communication">
    <meta
      name="description"
      content="Découvrez les services de KOTAVA Communication : stratégie, branding, design, digital, audiovisuel, événementiel, relations publiques et social media."
    />
  </Head>

  <main class="relative overflow-hidden bg-brand-dark text-white">
    <!-- HERO COMPACT -->
    <section class="relative isolate overflow-hidden pb-14 pt-32 sm:pb-16 lg:pt-36">
      <div class="absolute inset-0 bg-grid-dark opacity-30"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_8%_18%,rgba(16,185,129,0.18),transparent_28%),radial-gradient(circle_at_92%_70%,rgba(249,115,22,0.15),transparent_28%),radial-gradient(circle_at_50%_45%,rgba(30,58,138,0.34),transparent_34%)]"></div>
      <div class="absolute inset-x-0 top-0 h-48 bg-gradient-to-b from-brand-dark via-brand-dark/90 to-transparent"></div>

      <div class="site-container relative z-10">
        <div class="grid gap-8 lg:grid-cols-[1fr_0.78fr] lg:items-end">
          <div>
            <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald backdrop-blur">
              <Sparkles :size="14" />
              Services KOTAVA
            </div>

            <h1 class="mt-6 max-w-5xl text-5xl font-black leading-[0.9] tracking-[-0.065em] text-white sm:text-6xl lg:text-7xl">
              Des expertises connectées
              <span class="block bg-gradient-to-r from-brand-emerald via-white to-brand-orange bg-clip-text text-transparent">
                pour construire une marque forte.
              </span>
            </h1>

            <p class="mt-6 max-w-2xl text-base leading-8 text-white/[0.64]">
              Stratégie, identité, digital, audiovisuel, événementiel et social media :
              nous structurons votre communication autour d’une seule direction claire.
            </p>
          </div>

          <div class="rounded-[2rem] border border-white/10 bg-white/[0.06] p-5 backdrop-blur-xl">
            <div class="grid grid-cols-2 gap-3">
              <div
                v-for="item in stats"
                :key="item.label"
                class="rounded-[1.4rem] border border-white/10 bg-slate-950/35 p-4"
              >
                <component :is="item.icon" :size="20" class="text-brand-emerald" />
                <div class="mt-4 text-3xl font-black tracking-[-0.05em] text-white">
                  {{ item.value }}
                </div>
                <div class="mt-1 text-xs font-bold text-white/[0.48]">
                  {{ item.label }}
                </div>
              </div>
            </div>

            <div class="mt-4 flex flex-col gap-3 sm:flex-row lg:flex-col">
              <Link
                href="/contact"
                class="inline-flex flex-1 items-center justify-center gap-2 rounded-[1.15rem] bg-brand-orange px-5 py-3.5 text-sm font-black text-white shadow-orange transition hover:-translate-y-0.5 hover:bg-brand-orange/90"
              >
                Démarrer un projet
                <ArrowRight :size="18" />
              </Link>

              <a
                :href="contactPhoneHref"
                class="inline-flex flex-1 items-center justify-center gap-2 rounded-[1.15rem] border border-white/10 bg-white/[0.08] px-5 py-3.5 text-sm font-black text-white transition hover:-translate-y-0.5 hover:bg-white/[0.12]"
              >
                <Phone :size="18" />
                {{ contactPhoneDisplay }}
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- SERVICES STRUCTURÉS -->
    <section class="relative isolate overflow-hidden py-14 sm:py-16 lg:py-20">
      <div class="absolute inset-0 bg-grid-dark opacity-20"></div>

      <div class="site-container relative z-10">
        <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
          <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald">
              <Layers3 :size="15" />
              Nos pôles
            </div>

            <h2 class="mt-4 text-4xl font-black leading-[0.95] tracking-[-0.055em] sm:text-5xl">
              Une structure claire,
              <span class="text-brand-orange"> pas une liste dispersée.</span>
            </h2>
          </div>

          <p class="max-w-md text-sm leading-7 text-white/[0.55]">
            Chaque service est pensé comme un levier précis dans une stratégie globale.
          </p>
        </div>

        <div class="grid gap-4 lg:grid-cols-12">
          <Link
            v-for="(service, index) in services"
            :key="service.title"
            :href="service.href"
            :class="[
              'group relative overflow-hidden rounded-[2rem] border border-white/10 bg-white/[0.06] p-5 backdrop-blur-xl transition duration-300 hover:-translate-y-1 hover:bg-white/[0.10] hover:shadow-[0_28px_80px_rgba(0,0,0,0.25)]',
              index === 0 || index === 1 ? 'lg:col-span-6' : 'lg:col-span-3'
            ]"
          >
            <div :class="['absolute -right-16 -top-16 h-48 w-48 rounded-[3rem] blur-3xl transition duration-300 group-hover:scale-125', service.glow]"></div>

            <div class="relative flex h-full flex-col">
              <div class="flex items-start justify-between gap-4">
                <div :class="['flex h-14 w-14 items-center justify-center rounded-2xl text-white shadow-lg', service.bg]">
                  <component :is="service.icon" :size="25" />
                </div>

                <div class="rounded-xl bg-white/[0.08] px-3 py-2 text-[10px] font-black uppercase tracking-[0.16em] text-white/[0.42]">
                  {{ service.number }}
                </div>
              </div>

              <!-- Illustration personnalisée -->
              <div class="mt-5 overflow-hidden rounded-[1.5rem] border border-white/10 bg-slate-950/45 p-4">
                <div v-if="service.visual === 'strategy'" class="space-y-3">
                  <div class="h-2 w-3/4 rounded-full bg-brand-emerald"></div>
                  <div class="grid grid-cols-3 gap-2">
                    <div class="h-16 rounded-2xl bg-white/[0.08]"></div>
                    <div class="h-16 rounded-2xl bg-brand-emerald/30"></div>
                    <div class="h-16 rounded-2xl bg-white/[0.08]"></div>
                  </div>
                  <div class="h-2 w-1/2 rounded-full bg-white/[0.18]"></div>
                </div>

                <div v-else-if="service.visual === 'branding'" class="grid grid-cols-[0.8fr_1.2fr] gap-3">
                  <div class="rounded-2xl bg-white p-4">
                    <div class="h-10 w-10 rounded-xl bg-brand-orange"></div>
                    <div class="mt-4 h-2 w-full rounded-full bg-slate-200"></div>
                    <div class="mt-2 h-2 w-2/3 rounded-full bg-slate-200"></div>
                  </div>
                  <div class="grid gap-2">
                    <div class="rounded-xl bg-brand-emerald/40"></div>
                    <div class="rounded-xl bg-brand-orange/40"></div>
                  </div>
                </div>

                <div v-else-if="service.visual === 'digital'" class="rounded-2xl border border-white/10 bg-white/[0.08] p-3">
                  <div class="flex gap-1.5">
                    <span class="h-2 w-2 rounded-full bg-brand-orange"></span>
                    <span class="h-2 w-2 rounded-full bg-brand-emerald"></span>
                    <span class="h-2 w-2 rounded-full bg-white/30"></span>
                  </div>
                  <div class="mt-4 grid grid-cols-[0.7fr_1.3fr] gap-3">
                    <div class="h-20 rounded-xl bg-brand-blue/50"></div>
                    <div class="space-y-2">
                      <div class="h-3 rounded-full bg-white/20"></div>
                      <div class="h-3 w-4/5 rounded-full bg-white/12"></div>
                      <div class="h-10 rounded-xl bg-brand-emerald/30"></div>
                    </div>
                  </div>
                </div>

                <div v-else-if="service.visual === 'video'" class="relative flex h-32 items-center justify-center rounded-2xl bg-gradient-to-br from-brand-orange/35 to-brand-blue/40">
                  <div class="absolute left-4 top-4 h-7 w-20 rounded-full bg-white/15"></div>
                  <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white text-brand-orange">
                    <Video :size="28" />
                  </div>
                </div>

                <div v-else-if="service.visual === 'event'" class="grid grid-cols-3 gap-2">
                  <div class="h-28 rounded-2xl bg-brand-emerald/35"></div>
                  <div class="h-28 rounded-2xl bg-white/[0.08]"></div>
                  <div class="h-28 rounded-2xl bg-brand-orange/30"></div>
                </div>

                <div v-else class="space-y-3">
                  <div class="flex gap-2">
                    <div class="h-12 w-12 rounded-2xl bg-brand-emerald"></div>
                    <div class="flex-1 rounded-2xl bg-white/[0.08]"></div>
                  </div>
                  <div class="grid grid-cols-4 gap-2">
                    <div class="h-10 rounded-xl bg-brand-orange/40"></div>
                    <div class="h-10 rounded-xl bg-white/[0.08]"></div>
                    <div class="h-10 rounded-xl bg-brand-blue/40"></div>
                    <div class="h-10 rounded-xl bg-brand-emerald/40"></div>
                  </div>
                </div>
              </div>

              <div class="mt-5">
                <h3 class="text-xl font-black tracking-[-0.035em] text-white">
                  {{ service.title }}
                </h3>

                <p :class="['mt-2 text-sm font-black', service.color]">
                  {{ service.subtitle }}
                </p>

                <p class="mt-3 line-clamp-3 text-sm leading-7 text-white/[0.58]">
                  {{ service.text }}
                </p>
              </div>

              <div class="mt-5 flex flex-wrap gap-2">
                <span
                  v-for="feature in service.features"
                  :key="feature"
                  class="rounded-xl border border-white/10 bg-white/[0.07] px-3 py-2 text-[10px] font-black uppercase tracking-[0.13em] text-white/[0.50]"
                >
                  {{ feature }}
                </span>
              </div>

              <div class="mt-auto pt-6">
                <div class="inline-flex items-center gap-2 text-sm font-black text-brand-orange">
                  Voir le service
                  <ArrowUpRight
                    :size="18"
                    class="transition group-hover:translate-x-1 group-hover:-translate-y-1"
                  />
                </div>
              </div>
            </div>
          </Link>
        </div>
      </div>
    </section>

    <!-- MÉTHODE + PACKS EN UNE SECTION COMPACTE -->
    <section class="relative isolate overflow-hidden py-14 sm:py-16 lg:py-20">
      <div class="site-container relative z-10">
        <div class="grid gap-5 lg:grid-cols-[0.9fr_1.1fr]">
          <!-- Process -->
          <div class="relative overflow-hidden rounded-[2.3rem] border border-white/10 bg-white/[0.06] p-6 backdrop-blur-2xl">
            <div class="absolute -right-20 -top-20 h-72 w-72 rounded-[4rem] bg-brand-emerald/15 blur-3xl"></div>

            <div class="relative">
              <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald">
                <Rocket :size="14" />
                Méthode
              </div>

              <h2 class="mt-5 text-4xl font-black leading-[0.95] tracking-[-0.055em] text-white">
                Une méthode simple,
                <span class="block text-brand-orange">sans dispersion.</span>
              </h2>

              <div class="mt-6 space-y-3">
                <div
                  v-for="(step, index) in process"
                  :key="step.title"
                  class="flex gap-4 rounded-[1.5rem] border border-white/10 bg-slate-950/35 p-4"
                >
                  <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white text-brand-blue">
                    <component :is="step.icon" :size="21" />
                  </div>

                  <div>
                    <div class="flex items-center gap-2">
                      <span class="text-[10px] font-black uppercase tracking-[0.18em] text-white/[0.32]">
                        0{{ index + 1 }}
                      </span>
                      <h3 class="text-base font-black text-white">
                        {{ step.title }}
                      </h3>
                    </div>

                    <p class="mt-1 text-sm leading-6 text-white/[0.55]">
                      {{ step.text }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Packs -->
          <div class="relative overflow-hidden rounded-[2.3rem] border border-white/10 bg-white/[0.06] p-6 backdrop-blur-2xl">
            <div class="absolute -bottom-24 -right-20 h-80 w-80 rounded-[4rem] bg-brand-orange/15 blur-3xl"></div>

            <div class="relative">
              <div class="mb-5 flex items-end justify-between gap-4">
                <div>
                  <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald">
                    <BadgeCheck :size="14" />
                    Packs
                  </div>

                  <h2 class="mt-4 text-3xl font-black tracking-[-0.05em] text-white">
                    Offres structurées
                  </h2>
                </div>

                <Link
                  href="/contact"
                  class="hidden rounded-[1rem] bg-brand-orange px-4 py-3 text-xs font-black text-white shadow-orange transition hover:-translate-y-0.5 sm:inline-flex"
                >
                  Devis
                </Link>
              </div>

              <div class="grid gap-3 sm:grid-cols-2">
                <div
                  v-for="pack in packs"
                  :key="pack.title"
                  class="rounded-[1.5rem] border border-white/10 bg-slate-950/35 p-4"
                >
                  <div class="flex items-start gap-3">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-white/[0.09] text-brand-emerald">
                      <component :is="pack.icon" :size="20" />
                    </div>

                    <div>
                      <h3 class="text-base font-black text-white">
                        {{ pack.title }}
                      </h3>

                      <p class="mt-1 text-xs leading-5 text-white/[0.50]">
                        {{ pack.text }}
                      </p>
                    </div>
                  </div>

                  <div class="mt-4 space-y-2">
                    <div
                      v-for="feature in pack.features"
                      :key="feature"
                      class="flex items-center gap-2 text-xs font-semibold text-white/[0.62]"
                    >
                      <CheckCircle2 :size="14" class="text-brand-emerald" />
                      {{ feature }}
                    </div>
                  </div>
                </div>
              </div>

              <Link
                href="/contact"
                class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-[1.15rem] bg-white px-5 py-3 text-sm font-black text-brand-blue transition hover:-translate-y-0.5"
              >
                Construire mon pack
                <ArrowRight :size="17" />
              </Link>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- PUBLIC + CTA -->
    <section class="relative isolate overflow-hidden py-14 pb-20 sm:py-16 lg:pb-24">
      <div class="site-container relative z-10">
        <div class="grid gap-5 lg:grid-cols-[0.85fr_1.15fr]">
          <div class="relative overflow-hidden rounded-[2.3rem] border border-white/10 bg-white/[0.06] p-6 backdrop-blur-2xl">
            <div class="absolute -right-20 -top-20 h-72 w-72 rounded-[4rem] bg-brand-blue/20 blur-3xl"></div>

            <div class="relative">
              <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald">
                <UsersRound :size="14" />
                Public cible
              </div>

              <h2 class="mt-5 text-4xl font-black leading-[0.95] tracking-[-0.055em] text-white">
                Pour les marques qui veulent passer un cap.
              </h2>

              <p class="mt-4 text-sm leading-7 text-white/[0.58]">
                Nous accompagnons startups, PME, institutions, entreprises en croissance
                et porteurs de projets avec des solutions adaptées à leur niveau de maturité.
              </p>

              <div class="mt-6 grid grid-cols-2 gap-3">
                <div class="rounded-[1.5rem] border border-white/10 bg-slate-950/35 p-5">
                  <div class="text-5xl font-black tracking-[-0.08em] text-brand-emerald">70%</div>
                  <div class="mt-2 text-sm font-bold text-white/[0.62]">Marché africain</div>
                </div>

                <div class="rounded-[1.5rem] border border-white/10 bg-slate-950/35 p-5">
                  <div class="text-5xl font-black tracking-[-0.08em] text-brand-orange">30%</div>
                  <div class="mt-2 text-sm font-bold text-white/[0.62]">International</div>
                </div>
              </div>
            </div>
          </div>

          <div class="relative overflow-hidden rounded-[2.3rem] border border-white/10 bg-white/[0.065] p-6 backdrop-blur-2xl sm:p-8">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_18%,rgba(16,185,129,0.16),transparent_30%),radial-gradient(circle_at_86%_80%,rgba(249,115,22,0.14),transparent_32%)]"></div>

            <div class="relative grid gap-6 lg:grid-cols-[1fr_0.8fr] lg:items-center">
              <div>
                <div class="flex h-16 w-16 items-center justify-center rounded-[1.4rem] bg-brand-orange text-white shadow-orange">
                  <Send :size="28" />
                </div>

                <h2 class="mt-6 text-4xl font-black leading-[0.95] tracking-[-0.055em] text-white sm:text-5xl">
                  Besoin d’une solution
                  <span class="block bg-gradient-to-r from-brand-emerald via-white to-brand-orange bg-clip-text text-transparent">
                    sur mesure ?
                  </span>
                </h2>

                <p class="mt-4 max-w-xl text-sm leading-7 text-white/[0.60]">
                  Parlons de votre projet et construisons l’offre la plus adaptée à vos objectifs,
                  votre marché et votre budget.
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

        <div class="mt-5 grid gap-3 sm:grid-cols-3">
          <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.06] p-5 backdrop-blur">
            <BadgeCheck :size="22" class="text-brand-emerald" />
            <div class="mt-3 text-sm font-black text-white">Conseil clair</div>
          </div>

          <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.06] p-5 backdrop-blur">
            <Clock3 :size="22" class="text-brand-orange" />
            <div class="mt-3 text-sm font-black text-white">Exécution structurée</div>
          </div>

          <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.06] p-5 backdrop-blur">
            <ShieldCheck :size="22" class="text-brand-emerald" />
            <div class="mt-3 text-sm font-black text-white">Qualité maîtrisée</div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>
