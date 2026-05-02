<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {
  ArrowRight,
  Award,
  BarChart3,
  Briefcase,
  Calendar,
  Camera,
  CheckCircle2,
  ChevronRight,
  ExternalLink,
  Filter,
  Globe2,
  Image as ImageIcon,
  Layers3,
  Mail,
  MapPin,
  Palette,
  Phone,
  Rocket,
  Search,
  Sparkles,
  Star,
  Target,
  Users,
  Zap,
} from 'lucide-vue-next';
import { computed, onMounted, onUnmounted } from 'vue';

defineOptions({ layout: GuestLayout });

const props = defineProps({
  realisations: {
    type: Object,
    default: () => ({
      data: [],
      links: [],
      meta: {},
    }),
  },
  featuredProjects: {
    type: Array,
    default: () => [],
  },
  recentProjects: {
    type: Array,
    default: () => [],
  },
  stats: {
    type: Object,
    default: () => ({}),
  },
  categories: {
    type: Array,
    default: () => [],
  },
  currentFilter: {
    type: String,
    default: 'all',
  },
  filters: {
    type: Array,
    default: () => [],
  },
  meta: {
    type: Object,
    default: () => ({}),
  },
});

const contactEmail = 'Contact@kotavacom.com';
const contactPhoneDisplay = '+229 93 37 49 63';
const contactPhoneHref = 'tel:+22993374963';
const whatsappHref = 'https://wa.me/22993374963';

const projects = computed(() => props.realisations?.data || []);
const paginationLinks = computed(() => props.realisations?.links || []);

const filterItems = computed(() => {
  const items = props.filters?.length ? props.filters : props.categories;

  return items?.length
    ? items
    : [
        {
          id: 'all',
          name: 'Tous les projets',
          count: projects.value.length,
        },
      ];
});

const pageTitle = computed(() => props.meta?.title || 'Portfolio - KOTAVA Communication');

const pageDescription = computed(() =>
  props.meta?.description ||
  'Découvrez les réalisations de KOTAVA Communication : branding, stratégie, digital, social media, audiovisuel, événementiel et dispositifs de communication.'
);

const heroProject = computed(() => props.featuredProjects?.[0] || projects.value?.[0] || null);

const highlightedProjects = computed(() => {
  const source = props.featuredProjects?.length ? props.featuredProjects : projects.value;

  return source.slice(0, 3);
});

const statsCards = computed(() => [
  {
    value: props.stats?.total_projects || 0,
    label: 'Projets publiés',
    detail: 'Réalisations sélectionnées',
    icon: CheckCircle2,
  },
  {
    value: props.stats?.total_clients || 0,
    label: 'Clients accompagnés',
    detail: 'Marques, structures et institutions',
    icon: Users,
  },
  {
    value: props.stats?.featured_projects || 0,
    label: 'Projets premium',
    detail: 'Références mises en avant',
    icon: Star,
  },
  {
    value: `${props.stats?.success_rate || 100}%`,
    label: 'Exécution maîtrisée',
    detail: 'Projets livrés et valorisés',
    icon: Award,
  },
]);

const expertiseCards = [
  {
    title: 'Stratégie',
    text: 'Cadrage, positionnement, message, canaux et logique de performance.',
    icon: Target,
    metric: 'Vision',
  },
  {
    title: 'Branding',
    text: 'Identités visuelles, univers de marque, cohérence graphique et mémorisation.',
    icon: Palette,
    metric: 'Image',
  },
  {
    title: 'Digital',
    text: 'Sites, plateformes, tunnels, contenus web et dispositifs orientés conversion.',
    icon: Globe2,
    metric: 'Conversion',
  },
  {
    title: 'Audiovisuel',
    text: 'Photos, vidéos, capsules, motion design et formats adaptés aux plateformes.',
    icon: Camera,
    metric: 'Attention',
  },
];

const processCards = [
  {
    step: '01',
    title: 'Comprendre',
    text: 'Objectifs, cible, contexte, contraintes et niveau d’ambition.',
  },
  {
    step: '02',
    title: 'Concevoir',
    text: 'Direction créative, structure narrative, angles et livrables clés.',
  },
  {
    step: '03',
    title: 'Produire',
    text: 'Design, contenu, digital, audiovisuel et déclinaisons opérationnelles.',
  },
  {
    step: '04',
    title: 'Valoriser',
    text: 'Publication, diffusion, mesure, amélioration et capitalisation.',
  },
];

const orbitItems = [
  'Branding',
  'Digital',
  'Social media',
  'Audiovisuel',
  'Événementiel',
  'Conseil',
];

const particles = Array.from({ length: 26 }, (_, index) => ({
  id: index,
  left: `${(index * 37) % 100}%`,
  top: `${(index * 53) % 100}%`,
  delay: `${(index % 8) * 0.42}s`,
  duration: `${13 + (index % 7) * 2}s`,
}));

const filterHref = (id) => id === 'all' ? '/portfolio' : `/portfolio?filter=${id}`;

const projectHref = (project) => project?.slug ? `/portfolio/${project.slug}` : '/portfolio';

const projectImage = (project) => project?.cover_image || project?.image || null;

const formatStat = (value) => {
  if (typeof value === 'number') {
    return value > 0 ? value : '0';
  }

  return value || '0';
};

let observer = null;

onMounted(() => {
  observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate-in');
      }
    });
  }, { threshold: 0.12 });

  document.querySelectorAll('.animate-on-scroll').forEach((element) => observer.observe(element));
});

onUnmounted(() => {
  if (observer) {
    observer.disconnect();
  }
});
</script>

<template>
  <Head :title="pageTitle">
    <meta name="description" :content="pageDescription" />
    <meta
      name="keywords"
      :content="meta?.keywords || 'portfolio KOTAVA Communication, réalisations branding, stratégie de communication, agence digitale Bénin, social media, audiovisuel, événementiel, Cotonou'"
    />
    <meta property="og:title" :content="pageTitle" />
    <meta property="og:description" :content="pageDescription" />
    <meta property="og:type" content="website" />
  </Head>

  <main class="overflow-hidden bg-[#07101d] text-white">
    <!-- HERO -->
    <section class="relative isolate min-h-[92vh] overflow-hidden px-4 pb-20 pt-24 sm:px-6 lg:px-8">
      <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_18%_18%,rgba(249,115,22,0.28),transparent_28%),radial-gradient(circle_at_85%_10%,rgba(16,185,129,0.20),transparent_30%),radial-gradient(circle_at_50%_95%,rgba(30,58,138,0.50),transparent_38%),linear-gradient(135deg,#07101d_0%,#10235f_48%,#06131f_100%)]"></div>
      <div class="absolute inset-0 -z-10 bg-[linear-gradient(rgba(255,255,255,0.045)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.045)_1px,transparent_1px)] bg-[size:44px_44px] opacity-45"></div>
      <div class="absolute left-1/2 top-0 -z-10 h-[38rem] w-[38rem] -translate-x-1/2 rounded-full bg-brand-orange/10 blur-3xl"></div>

      <div
        v-for="particle in particles"
        :key="particle.id"
        class="portfolio-particle absolute h-1.5 w-1.5 rounded-full bg-white/40"
        :style="{
          left: particle.left,
          top: particle.top,
          animationDelay: particle.delay,
          animationDuration: particle.duration
        }"
      ></div>

      <div class="relative z-10 mx-auto grid max-w-7xl items-center gap-12 lg:min-h-[calc(92vh-9rem)] lg:grid-cols-[1fr_0.92fr]">
        <div class="animate-on-scroll">
          <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-xs font-black uppercase tracking-[0.18em] text-white/70 backdrop-blur">
            <Sparkles :size="16" class="text-brand-orange" />
            Portfolio stratégique
          </div>

          <h1 class="mt-7 max-w-5xl text-5xl font-black leading-[0.92] tracking-[-0.08em] text-white sm:text-6xl lg:text-7xl xl:text-8xl">
            Nos projets ne décorent pas les marques.
            <span class="block text-brand-orange">Ils les positionnent.</span>
          </h1>

          <p class="mt-7 max-w-2xl text-lg leading-8 text-white/68 sm:text-xl">
            Une sélection de réalisations conçues pour clarifier une identité, augmenter la visibilité, renforcer la crédibilité et transformer l’attention en opportunités.
          </p>

          <div class="mt-8 flex flex-wrap gap-2">
            <span
              v-for="item in orbitItems"
              :key="item"
              class="rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-xs font-black uppercase tracking-[0.12em] text-white/55 backdrop-blur"
            >
              {{ item }}
            </span>
          </div>

          <div class="mt-10 flex flex-col gap-3 sm:flex-row">
            <a
              href="#projets"
              class="group inline-flex items-center justify-center gap-3 rounded-2xl bg-brand-orange px-6 py-4 text-sm font-black text-white shadow-[0_18px_50px_rgba(249,115,22,0.30)] transition hover:-translate-y-1 hover:bg-brand-orange/90"
            >
              Explorer les réalisations
              <ArrowRight :size="18" class="transition group-hover:translate-x-1" />
            </a>

            <a
              :href="whatsappHref"
              target="_blank"
              rel="noopener noreferrer"
              class="inline-flex items-center justify-center gap-3 rounded-2xl border border-white/10 bg-white/[0.08] px-6 py-4 text-sm font-black text-white backdrop-blur transition hover:-translate-y-1 hover:bg-white/[0.12]"
            >
              <Phone :size="18" />
              Discuter du projet
            </a>
          </div>

          <div class="mt-10 grid max-w-3xl gap-3 sm:grid-cols-3">
            <div
              v-for="stat in statsCards.slice(0, 3)"
              :key="stat.label"
              class="rounded-2xl border border-white/10 bg-white/[0.06] p-4 backdrop-blur"
            >
              <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-orange text-white">
                  <component :is="stat.icon" :size="18" />
                </div>

                <div>
                  <p class="text-2xl font-black tracking-[-0.04em] text-white">
                    {{ formatStat(stat.value) }}
                  </p>
                  <p class="text-xs font-bold text-white/45">
                    {{ stat.label }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- HERO VISUAL -->
        <div class="animate-on-scroll relative">
          <div class="absolute -inset-8 rounded-[3rem] bg-brand-orange/20 blur-3xl"></div>

          <div class="relative overflow-hidden rounded-[2.7rem] border border-white/10 bg-white/[0.08] p-4 shadow-2xl backdrop-blur-2xl">
            <div class="relative overflow-hidden rounded-[2.15rem] bg-[#08111f]">
              <div class="absolute inset-x-0 top-0 z-20 flex items-center justify-between border-b border-white/10 bg-white/[0.04] px-5 py-4 backdrop-blur">
                <div class="flex items-center gap-2">
                  <span class="h-3 w-3 rounded-full bg-red-400"></span>
                  <span class="h-3 w-3 rounded-full bg-yellow-300"></span>
                  <span class="h-3 w-3 rounded-full bg-emerald-400"></span>
                </div>

                <div class="inline-flex items-center gap-2 rounded-xl bg-brand-orange/15 px-3 py-1.5 text-xs font-black text-brand-orange">
                  <Rocket :size="14" />
                  Portfolio live
                </div>
              </div>

              <div class="pt-14">
                <div class="relative h-[30rem] overflow-hidden">
                  <img
                    v-if="projectImage(heroProject)"
                    :src="projectImage(heroProject)"
                    :alt="heroProject?.title"
                    class="absolute inset-0 h-full w-full object-cover opacity-85"
                  />

                  <div v-else class="absolute inset-0 flex items-center justify-center bg-[radial-gradient(circle_at_30%_20%,rgba(249,115,22,0.24),transparent_30%),linear-gradient(135deg,#0f172a,#07101d)]">
                    <div class="text-center">
                      <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-brand-orange text-white">
                        <ImageIcon :size="34" />
                      </div>
                      <p class="mt-4 text-sm font-bold text-white/45">
                        Visuel de référence
                      </p>
                    </div>
                  </div>

                  <div class="absolute inset-0 bg-gradient-to-t from-[#07101d] via-[#07101d]/30 to-transparent"></div>

                  <div class="absolute bottom-0 left-0 right-0 p-6">
                    <div class="flex flex-wrap gap-2">
                      <span class="rounded-xl bg-white/90 px-3 py-2 text-xs font-black text-slate-950">
                        {{ heroProject?.category || 'Projet KOTAVA' }}
                      </span>

                      <span v-if="heroProject?.featured" class="rounded-xl bg-brand-orange px-3 py-2 text-xs font-black text-white">
                        En vedette
                      </span>
                    </div>

                    <h2 class="mt-4 text-3xl font-black leading-tight tracking-[-0.05em] text-white">
                      {{ heroProject?.title || 'Une direction créative pensée pour performer.' }}
                    </h2>

                    <p class="mt-3 line-clamp-2 max-w-xl text-sm leading-6 text-white/60">
                      {{ heroProject?.short_description || 'Explorez les projets publiés par KOTAVA Communication et découvrez notre manière de transformer une idée en dispositif visible, crédible et mesurable.' }}
                    </p>

                    <Link
                      v-if="heroProject?.slug"
                      :href="projectHref(heroProject)"
                      class="mt-5 inline-flex items-center gap-2 rounded-2xl bg-white px-5 py-3 text-sm font-black text-slate-950 transition hover:bg-brand-orange hover:text-white"
                    >
                      Voir l’étude de cas
                      <ChevronRight :size="17" />
                    </Link>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="absolute -bottom-6 -left-4 hidden rounded-[2rem] border border-white/10 bg-white/[0.08] p-4 backdrop-blur-xl sm:block">
            <div class="flex items-center gap-3">
              <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500 text-white">
                <BarChart3 :size="22" />
              </div>
              <div>
                <p class="text-xs font-black uppercase tracking-[0.14em] text-white/40">
                  Impact
                </p>
                <p class="text-lg font-black text-white">
                  Créatif + mesurable
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FEATURE STRIP -->
    <section class="relative border-y border-white/10 bg-white/[0.035] px-4 py-6 sm:px-6 lg:px-8">
      <div class="mx-auto grid max-w-7xl gap-4 md:grid-cols-4">
        <div
          v-for="stat in statsCards"
          :key="stat.label"
          class="animate-on-scroll rounded-[1.5rem] border border-white/10 bg-white/[0.05] p-5 backdrop-blur transition hover:-translate-y-1 hover:bg-white/[0.075]"
        >
          <div class="flex items-center justify-between gap-4">
            <div>
              <p class="text-3xl font-black tracking-[-0.05em] text-white">
                {{ formatStat(stat.value) }}
              </p>
              <p class="mt-1 text-sm font-black text-white/75">
                {{ stat.label }}
              </p>
              <p class="mt-1 text-xs leading-5 text-white/40">
                {{ stat.detail }}
              </p>
            </div>

            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-brand-orange text-white">
              <component :is="stat.icon" :size="20" />
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- PROJECTS -->
    <section id="projets" class="relative overflow-hidden px-4 py-20 sm:px-6 lg:px-8">
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_12%_18%,rgba(16,185,129,0.11),transparent_25%),radial-gradient(circle_at_90%_40%,rgba(249,115,22,0.10),transparent_28%)]"></div>

      <div class="relative mx-auto max-w-7xl">
        <div class="animate-on-scroll flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">
          <div>
            <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-xs font-black uppercase tracking-[0.16em] text-brand-orange">
              <Filter :size="15" />
              Sélection dynamique
            </div>

            <h2 class="mt-5 max-w-3xl text-4xl font-black tracking-[-0.06em] text-white sm:text-5xl">
              Des références construites avec méthode, pas seulement avec esthétique.
            </h2>

            <p class="mt-5 max-w-2xl text-base leading-7 text-white/55">
              Filtrez les réalisations par expertise, ouvrez une fiche projet et consultez le contexte, la solution, les résultats et les visuels associés.
            </p>
          </div>

          <a
            :href="`mailto:${contactEmail}`"
            class="inline-flex items-center justify-center gap-3 rounded-2xl bg-brand-orange px-6 py-4 text-sm font-black text-white shadow-[0_18px_50px_rgba(249,115,22,0.25)] transition hover:-translate-y-1 hover:bg-brand-orange/90"
          >
            <Mail :size="18" />
            Proposer un projet
          </a>
        </div>

        <div class="animate-on-scroll mt-8 flex gap-3 overflow-x-auto pb-3 portfolio-no-scrollbar">
          <Link
            v-for="item in filterItems"
            :key="item.id"
            :href="filterHref(item.id)"
            :class="[
              'inline-flex shrink-0 items-center gap-2 rounded-2xl px-4 py-3 text-sm font-black transition',
              currentFilter === item.id
                ? 'bg-brand-orange text-white shadow-[0_14px_35px_rgba(249,115,22,0.22)]'
                : 'border border-white/10 bg-white/[0.06] text-white/65 hover:bg-white/[0.10] hover:text-white'
            ]"
          >
            {{ item.name }}
            <span
              :class="[
                'rounded-lg px-2 py-0.5 text-xs',
                currentFilter === item.id ? 'bg-white/20 text-white' : 'bg-white/[0.08] text-white/45'
              ]"
            >
              {{ item.count || 0 }}
            </span>
          </Link>
        </div>

        <div v-if="projects.length" class="mt-12 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
          <Link
            v-for="(project, index) in projects"
            :key="project.id"
            :href="projectHref(project)"
            class="animate-on-scroll group overflow-hidden rounded-[2rem] border border-white/10 bg-white/[0.06] shadow-2xl shadow-black/10 backdrop-blur transition duration-500 hover:-translate-y-2 hover:border-brand-orange/40 hover:bg-white/[0.09]"
            :style="{ transitionDelay: `${index * 40}ms` }"
          >
            <div class="relative h-72 overflow-hidden bg-[#0b1524]">
              <img
                v-if="projectImage(project)"
                :src="projectImage(project)"
                :alt="project.title"
                class="h-full w-full object-cover opacity-85 transition duration-700 group-hover:scale-110 group-hover:opacity-100"
              />

              <div v-else class="flex h-full w-full items-center justify-center bg-[radial-gradient(circle_at_30%_20%,rgba(249,115,22,0.18),transparent_32%),linear-gradient(135deg,#0f172a,#07101d)]">
                <ImageIcon :size="42" class="text-white/25" />
              </div>

              <div class="absolute inset-0 bg-gradient-to-t from-[#07101d] via-[#07101d]/30 to-transparent"></div>

              <div class="absolute left-5 top-5 flex flex-wrap gap-2">
                <span class="rounded-xl bg-white/90 px-3 py-2 text-xs font-black text-slate-950 backdrop-blur">
                  {{ project.category }}
                </span>

                <span v-if="project.featured" class="rounded-xl bg-brand-orange px-3 py-2 text-xs font-black text-white">
                  En vedette
                </span>
              </div>

              <div class="absolute bottom-5 left-5 right-5">
                <p class="flex items-center gap-2 text-xs font-black uppercase tracking-[0.15em] text-white/55">
                  <Briefcase :size="14" />
                  {{ project.client || 'Projet client' }}
                </p>

                <h3 class="mt-2 line-clamp-2 text-2xl font-black tracking-[-0.05em] text-white">
                  {{ project.title }}
                </h3>
              </div>
            </div>

            <div class="p-6">
              <p class="line-clamp-3 text-sm leading-6 text-white/55">
                {{ project.short_description || project.description }}
              </p>

              <div class="mt-6 grid grid-cols-2 gap-3">
                <div class="rounded-2xl bg-white/[0.05] p-3">
                  <p class="text-[0.65rem] font-black uppercase tracking-[0.14em] text-white/35">
                    Secteur
                  </p>
                  <p class="mt-1 truncate text-sm font-black text-white/80">
                    {{ project.sector || project.category || 'Communication' }}
                  </p>
                </div>

                <div class="rounded-2xl bg-white/[0.05] p-3">
                  <p class="text-[0.65rem] font-black uppercase tracking-[0.14em] text-white/35">
                    Livraison
                  </p>
                  <p class="mt-1 truncate text-sm font-black text-white/80">
                    {{ project.completion_date || project.created_at || 'Réalisé' }}
                  </p>
                </div>
              </div>

              <div class="mt-6 flex items-center justify-between border-t border-white/10 pt-5">
                <div class="flex items-center gap-2 text-xs font-bold text-white/40">
                  <MapPin :size="15" />
                  {{ project.country || 'Bénin' }}
                </div>

                <div class="inline-flex items-center gap-2 text-sm font-black text-brand-orange">
                  Voir le projet
                  <ChevronRight :size="17" class="transition group-hover:translate-x-1" />
                </div>
              </div>
            </div>
          </Link>
        </div>

        <div v-else class="animate-on-scroll mt-12 rounded-[2rem] border border-white/10 bg-white/[0.06] p-12 text-center backdrop-blur">
          <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-white/[0.08] text-white/35">
            <Search :size="30" />
          </div>

          <h3 class="mt-6 text-2xl font-black text-white">
            Aucun projet disponible
          </h3>

          <p class="mt-3 text-white/50">
            Aucune réalisation publiée ne correspond actuellement à ce filtre.
          </p>

          <Link
            href="/portfolio"
            class="mt-6 inline-flex items-center justify-center rounded-2xl bg-brand-orange px-5 py-3 text-sm font-black text-white"
          >
            Réinitialiser le filtre
          </Link>
        </div>

        <div v-if="paginationLinks.length > 3" class="mt-10 flex flex-wrap justify-center gap-2">
          <component
            :is="link.url ? Link : 'span'"
            v-for="(link, index) in paginationLinks"
            :key="index"
            :href="link.url || undefined"
            :class="[
              'rounded-xl px-4 py-2 text-sm font-black transition',
              link.active
                ? 'bg-brand-orange text-white'
                : link.url
                  ? 'border border-white/10 bg-white/[0.06] text-white/65 hover:bg-white/[0.10] hover:text-white'
                  : 'bg-white/[0.04] text-white/30'
            ]"
            v-html="link.label"
          />
        </div>
      </div>
    </section>

    <!-- FEATURED PROJECTS -->
    <section v-if="highlightedProjects.length" class="relative overflow-hidden border-y border-white/10 bg-[#08111f] px-4 py-20 sm:px-6 lg:px-8">
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_20%,rgba(249,115,22,0.14),transparent_30%),radial-gradient(circle_at_20%_90%,rgba(16,185,129,0.12),transparent_34%)]"></div>

      <div class="relative mx-auto max-w-7xl">
        <div class="animate-on-scroll mb-10 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
          <div>
            <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-xs font-black uppercase tracking-[0.16em] text-emerald-400">
              <Star :size="15" />
              Références fortes
            </div>

            <h2 class="mt-5 max-w-3xl text-4xl font-black tracking-[-0.06em] text-white sm:text-5xl">
              Les projets qui incarnent notre niveau d’exigence.
            </h2>
          </div>

          <Link href="/contact" class="inline-flex items-center gap-2 text-sm font-black text-brand-orange">
            Travailler avec KOTAVA
            <ExternalLink :size="17" />
          </Link>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
          <Link
            v-for="project in highlightedProjects"
            :key="project.id"
            :href="projectHref(project)"
            class="animate-on-scroll group rounded-[2rem] border border-white/10 bg-white/[0.06] p-4 backdrop-blur transition hover:-translate-y-2 hover:border-brand-orange/40 hover:bg-white/[0.09]"
          >
            <div class="h-52 overflow-hidden rounded-[1.5rem] bg-[#101b2d]">
              <img
                v-if="projectImage(project)"
                :src="projectImage(project)"
                :alt="project.title"
                class="h-full w-full object-cover opacity-85 transition duration-700 group-hover:scale-110 group-hover:opacity-100"
              />

              <div v-else class="flex h-full items-center justify-center">
                <ImageIcon :size="34" class="text-white/25" />
              </div>
            </div>

            <div class="p-2 pt-5">
              <p class="text-xs font-black uppercase tracking-[0.15em] text-brand-orange">
                {{ project.category || 'Projet' }}
              </p>

              <h3 class="mt-2 text-2xl font-black tracking-[-0.05em] text-white">
                {{ project.title }}
              </h3>

              <p class="mt-3 line-clamp-2 text-sm leading-6 text-white/50">
                {{ project.short_description }}
              </p>

              <div class="mt-6 inline-flex items-center gap-2 text-sm font-black text-white/75">
                Consulter
                <ChevronRight :size="17" class="transition group-hover:translate-x-1" />
              </div>
            </div>
          </Link>
        </div>
      </div>
    </section>

    <!-- METHOD -->
    <section class="relative overflow-hidden px-4 py-20 sm:px-6 lg:px-8">
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,rgba(30,58,138,0.20),transparent_38%)]"></div>

      <div class="relative mx-auto max-w-7xl">
        <div class="animate-on-scroll text-center">
          <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-xs font-black uppercase tracking-[0.16em] text-white/55">
            <Layers3 :size="15" class="text-brand-orange" />
            Méthode KOTAVA
          </div>

          <h2 class="mx-auto mt-5 max-w-3xl text-4xl font-black tracking-[-0.06em] text-white sm:text-5xl">
            Chaque réalisation est pensée comme un actif de croissance.
          </h2>

          <p class="mx-auto mt-5 max-w-2xl text-base leading-7 text-white/50">
            Nous ne livrons pas uniquement un support. Nous construisons une pièce cohérente dans un système de marque.
          </p>
        </div>

        <div class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
          <div
            v-for="item in expertiseCards"
            :key="item.title"
            class="animate-on-scroll rounded-[2rem] border border-white/10 bg-white/[0.06] p-6 backdrop-blur transition hover:-translate-y-2 hover:bg-white/[0.09]"
          >
            <div class="flex items-center justify-between">
              <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-orange text-white">
                <component :is="item.icon" :size="22" />
              </div>

              <span class="rounded-xl bg-white/[0.06] px-3 py-1 text-xs font-black uppercase tracking-[0.13em] text-white/35">
                {{ item.metric }}
              </span>
            </div>

            <h3 class="mt-6 text-xl font-black text-white">
              {{ item.title }}
            </h3>

            <p class="mt-3 text-sm leading-6 text-white/50">
              {{ item.text }}
            </p>
          </div>
        </div>

        <div class="mt-12 grid gap-5 lg:grid-cols-4">
          <div
            v-for="item in processCards"
            :key="item.step"
            class="animate-on-scroll relative overflow-hidden rounded-[2rem] border border-white/10 bg-white/[0.045] p-6"
          >
            <div class="absolute -right-4 -top-6 text-8xl font-black tracking-[-0.08em] text-white/[0.04]">
              {{ item.step }}
            </div>

            <p class="text-sm font-black text-brand-orange">
              Étape {{ item.step }}
            </p>

            <h3 class="mt-4 text-xl font-black text-white">
              {{ item.title }}
            </h3>

            <p class="mt-3 text-sm leading-6 text-white/50">
              {{ item.text }}
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="relative overflow-hidden px-4 py-20 text-white sm:px-6 lg:px-8">
      <div class="absolute inset-0 bg-brand-orange"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(255,255,255,0.22),transparent_28%),radial-gradient(circle_at_90%_80%,rgba(7,16,29,0.45),transparent_34%)]"></div>
      <div class="absolute inset-x-0 top-0 h-px bg-white/20"></div>

      <div class="relative mx-auto max-w-5xl text-center">
        <Sparkles :size="44" class="mx-auto mb-6" />

        <h2 class="text-4xl font-black leading-tight tracking-[-0.06em] sm:text-5xl lg:text-6xl">
          Votre prochain projet peut devenir une référence.
        </h2>

        <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-white/85">
          Présentez-nous votre besoin. Nous construisons une approche claire, créative et mesurable pour transformer votre ambition en réalisation visible.
        </p>

        <div class="mt-10 flex flex-col justify-center gap-3 sm:flex-row">
          <Link
            href="/contact"
            class="inline-flex items-center justify-center gap-3 rounded-2xl bg-white px-6 py-4 text-sm font-black text-brand-orange transition hover:-translate-y-1 hover:bg-slate-950 hover:text-white"
          >
            <Mail :size="18" />
            Démarrer un projet
          </Link>

          <a
            :href="contactPhoneHref"
            class="inline-flex items-center justify-center gap-3 rounded-2xl border border-white/30 bg-white/10 px-6 py-4 text-sm font-black text-white transition hover:-translate-y-1 hover:bg-white/20"
          >
            <Phone :size="18" />
            {{ contactPhoneDisplay }}
          </a>
        </div>

        <div class="mt-8 text-sm font-bold text-white/75">
          {{ contactEmail }}
        </div>
      </div>
    </section>
  </main>
</template>

<style scoped>
@keyframes portfolioParticle {
  0%, 100% {
    transform: translate3d(0, 0, 0) scale(1);
    opacity: 0.25;
  }

  50% {
    transform: translate3d(22px, -36px, 0) scale(1.55);
    opacity: 0.68;
  }
}

.portfolio-particle {
  animation: portfolioParticle linear infinite;
}

.animate-on-scroll {
  opacity: 0;
  transform: translateY(24px);
  transition: opacity 0.7s ease, transform 0.7s ease;
}

.animate-on-scroll.animate-in {
  opacity: 1;
  transform: translateY(0);
}

.portfolio-no-scrollbar {
  scrollbar-width: none;
}

.portfolio-no-scrollbar::-webkit-scrollbar {
  display: none;
}

.line-clamp-2,
.line-clamp-3 {
  display: -webkit-box;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.line-clamp-2 {
  -webkit-line-clamp: 2;
}

.line-clamp-3 {
  -webkit-line-clamp: 3;
}
</style>