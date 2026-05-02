<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/GuestLayout.vue';
import {
  ArrowLeft,
  ArrowRight,
  BadgeCheck,
  BarChart3,
  Bell,
  Bookmark,
  CalendarDays,
  CheckCircle2,
  Clock3,
  Eye,
  Globe2,
  Hash,
  Heart,
  Image as ImageIcon,
  Mail,
  MessageCircle,
  MessageSquare,
  MousePointerClick,
  Phone,
  Play,
  Send,
  Share2,
  ShieldCheck,
  Sparkles,
  Target,
  TrendingUp,
  UsersRound,
  Video,
  Zap,
} from 'lucide-vue-next';

defineOptions({ layout: MainLayout });

const contactEmail = 'Contact@kotavacom.com';
const contactPhoneDisplay = '+229 93 37 49 63';
const contactPhoneHref = 'tel:+22993374963';

const activeIndex = ref(0);
let intervalId = null;

const socialModes = [
  {
    code: 'SOC-01',
    title: 'Stratégie Social Media',
    label: 'Audit · objectifs · calendrier',
    format: 'Strategy',
    icon: Target,
    visual: 'strategy',
    accent: 'bg-brand-blue',
    glow: 'bg-brand-blue/30',
    caption: 'Définir les bons messages, les bons formats et les bons canaux avant de publier.',
    tags: ['Audit', 'KPI', 'Calendrier', 'Cibles'],
  },
  {
    code: 'SOC-02',
    title: 'Création de contenu',
    label: 'Posts · reels · carrousels · stories',
    format: 'Create',
    icon: ImageIcon,
    visual: 'content',
    accent: 'bg-brand-orange',
    glow: 'bg-brand-orange/25',
    caption: 'Créer des contenus qui arrêtent le scroll et renforcent la perception de marque.',
    tags: ['Design', 'Copywriting', 'Reels', 'Carrousels'],
  },
  {
    code: 'SOC-03',
    title: 'Community Management',
    label: 'Messages · commentaires · proximité',
    format: 'Commu',
    icon: UsersRound,
    visual: 'community',
    accent: 'bg-brand-emerald',
    glow: 'bg-brand-emerald/25',
    caption: 'Animer la communauté, répondre vite et transformer l’audience en relation.',
    tags: ['DM', 'Commentaires', 'Veille', 'Engagement'],
  },
  {
    code: 'SOC-04',
    title: 'Campagnes Ads',
    label: 'Ciblage · budget · conversion',
    format: 'Ads',
    icon: MousePointerClick,
    visual: 'ads',
    accent: 'bg-brand-blue',
    glow: 'bg-brand-blue/30',
    caption: 'Booster les bons contenus avec des campagnes publicitaires suivies et optimisées.',
    tags: ['Ciblage', 'A/B Test', 'Leads', 'ROI'],
  },
  {
    code: 'SOC-05',
    title: 'Influence Marketing',
    label: 'Créateurs · ambassadeurs · collaborations',
    format: 'Collab',
    icon: Sparkles,
    visual: 'influence',
    accent: 'bg-brand-orange',
    glow: 'bg-brand-orange/25',
    caption: 'Activer les bons relais pour gagner en portée, crédibilité et conversation.',
    tags: ['Créateurs', 'Brief', 'Partenariat', 'Reach'],
  },
  {
    code: 'SOC-06',
    title: 'Reporting & Insights',
    label: 'Analyse · recommandations · croissance',
    format: 'Data',
    icon: BarChart3,
    visual: 'report',
    accent: 'bg-brand-emerald',
    glow: 'bg-brand-emerald/25',
    caption: 'Mesurer les performances et transformer les données en décisions éditoriales.',
    tags: ['Dashboard', 'Engagement', 'Croissance', 'Reco'],
  },
];

const platforms = [
  { name: 'Instagram', label: 'Visuel & engagement', icon: Heart },
  { name: 'LinkedIn', label: 'B2B & autorité', icon: UsersRound },
  { name: 'Facebook', label: 'Communauté', icon: MessageCircle },
  { name: 'TikTok', label: 'Viralité', icon: Video },
  { name: 'YouTube', label: 'Vidéo longue', icon: Play },
  { name: 'X / Twitter', label: 'Conversation', icon: Hash },
];

const contentFormats = [
  { title: 'Reels', label: 'vidéo courte', icon: Video, tone: 'bg-brand-orange' },
  { title: 'Carrousels', label: 'éducation', icon: ImageIcon, tone: 'bg-brand-blue' },
  { title: 'Stories', label: 'proximité', icon: MessageCircle, tone: 'bg-brand-emerald' },
  { title: 'Posts', label: 'image de marque', icon: Sparkles, tone: 'bg-white' },
  { title: 'Ads', label: 'conversion', icon: MousePointerClick, tone: 'bg-brand-orange' },
  { title: 'Reporting', label: 'pilotage', icon: BarChart3, tone: 'bg-brand-blue' },
];

const contentLoop = [
  {
    title: 'Planifier',
    text: 'Angles, objectifs, rubriques, calendrier et priorités.',
    icon: CalendarDays,
  },
  {
    title: 'Créer',
    text: 'Visuels, textes, vidéos courtes, stories et carrousels.',
    icon: ImageIcon,
  },
  {
    title: 'Publier',
    text: 'Diffusion adaptée aux codes de chaque plateforme.',
    icon: Send,
  },
  {
    title: 'Optimiser',
    text: 'Analyse, recommandations et amélioration continue.',
    icon: TrendingUp,
  },
];

const metrics = [
  { value: '+300%', label: 'engagement potentiel', icon: Heart },
  { value: '24/7', label: 'présence sociale', icon: Clock3 },
  { value: 'ROI', label: 'campagnes suivies', icon: TrendingUp },
  { value: 'A+', label: 'qualité contenu', icon: BadgeCheck },
];

const calendarDays = [
  { day: 'Lun', type: 'Post', color: 'bg-brand-blue' },
  { day: 'Mar', type: 'Story', color: 'bg-brand-emerald' },
  { day: 'Mer', type: 'Reel', color: 'bg-brand-orange' },
  { day: 'Jeu', type: 'Ads', color: 'bg-brand-blue' },
  { day: 'Ven', type: 'Live', color: 'bg-brand-orange' },
  { day: 'Sam', type: 'Commu', color: 'bg-brand-emerald' },
  { day: 'Dim', type: 'Report', color: 'bg-white' },
];

const deliverables = [
  { title: 'Calendrier éditorial', label: 'planning mensuel' },
  { title: 'Créations visuelles', label: 'posts & stories' },
  { title: 'Vidéos courtes', label: 'reels & shorts' },
  { title: 'Community management', label: 'messages & commentaires' },
  { title: 'Campagnes Ads', label: 'ciblage & budget' },
  { title: 'Reporting', label: 'résultats & actions' },
];

const floatingReactions = [
  'left-[7%] top-[18%]',
  'left-[17%] bottom-[18%]',
  'left-[37%] top-[12%]',
  'right-[11%] top-[20%]',
  'right-[17%] bottom-[24%]',
  'left-[62%] bottom-[13%]',
  'left-[75%] top-[44%]',
  'left-[48%] bottom-[36%]',
];

const activeMode = computed(() => socialModes[activeIndex.value] || socialModes[0]);

const setActive = (index) => {
  activeIndex.value = index;
};

onMounted(() => {
  intervalId = window.setInterval(() => {
    activeIndex.value = (activeIndex.value + 1) % socialModes.length;
  }, 2700);
});

onUnmounted(() => {
  if (intervalId) {
    window.clearInterval(intervalId);
  }
});
</script>

<template>
  <Head title="Social Media & Contenu — KOTAVA Communication">
    <meta
      name="description"
      content="KOTAVA Communication accompagne les marques en stratégie social media, création de contenu, community management, campagnes publicitaires, influence marketing et reporting."
    />
  </Head>

  <main class="relative overflow-hidden bg-[#050816] text-white">
    <!-- SOCIAL CONTENT OS -->
    <section class="relative isolate min-h-screen overflow-hidden px-3 pb-12 pt-28 sm:px-4 lg:px-6 lg:pt-32">
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_14%_16%,rgba(30,58,138,0.32),transparent_28%),radial-gradient(circle_at_86%_78%,rgba(16,185,129,0.18),transparent_30%),radial-gradient(circle_at_54%_42%,rgba(249,115,22,0.17),transparent_34%),linear-gradient(180deg,#050816_0%,#08111F_52%,#050816_100%)]"></div>

      <div class="absolute left-[7%] top-0 h-[80%] w-[18%] -skew-x-12 bg-gradient-to-b from-brand-blue/25 via-brand-blue/[0.045] to-transparent blur-2xl"></div>
      <div class="absolute right-[10%] top-0 h-[80%] w-[20%] skew-x-12 bg-gradient-to-b from-brand-emerald/20 via-brand-emerald/[0.04] to-transparent blur-2xl"></div>

      <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute left-1/2 top-[10%] hidden -translate-x-1/2 select-none text-[10vw] font-black uppercase leading-none tracking-[-0.12em] text-white/[0.025] lg:block">
          CONTENT OS
        </div>

        <div
          v-for="(item, index) in floatingReactions"
          :key="item"
          :class="['reaction-bubble absolute flex h-11 w-11 items-center justify-center rounded-2xl border border-white/10 bg-white/[0.07] backdrop-blur', item]"
          :style="{ animationDelay: `${index * 150}ms` }"
        >
          <Heart v-if="index % 4 === 0" :size="15" class="text-brand-orange" />
          <MessageCircle v-else-if="index % 4 === 1" :size="15" class="text-brand-emerald" />
          <Share2 v-else-if="index % 4 === 2" :size="15" class="text-white" />
          <Hash v-else :size="15" class="text-brand-blue" />
        </div>
      </div>

      <div class="site-container relative z-10">
        <Link
          href="/services"
          class="mb-7 inline-flex items-center gap-2 text-sm font-black text-white/[0.62] transition hover:-translate-x-1 hover:text-brand-orange"
        >
          <ArrowLeft :size="18" />
          Retour aux services
        </Link>

        <div class="grid gap-5 lg:grid-cols-[0.46fr_0.76fr_0.46fr] lg:items-stretch">
          <!-- Composer panel -->
          <aside class="relative overflow-hidden rounded-[2.6rem] border border-white/10 bg-white/[0.055] p-6 backdrop-blur-2xl">
            <div class="absolute -right-24 -top-24 h-72 w-72 rounded-[5rem] bg-brand-blue/20 blur-3xl"></div>

            <div class="relative flex min-h-[690px] flex-col justify-between gap-8">
              <div>
                <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-orange">
                  <MessageSquare :size="14" />
                  Social Content OS
                </div>

                <h1 class="mt-6 text-5xl font-black leading-[0.88] tracking-[-0.08em] text-white sm:text-6xl lg:text-7xl">
                  Faire vivre votre marque
                  <span class="block bg-gradient-to-r from-brand-blue via-white to-brand-emerald bg-clip-text text-transparent">
                    dans le feed.
                  </span>
                </h1>

                <p class="mt-6 text-sm leading-7 text-white/[0.60]">
                  Stratégie, contenu, community management, publicité, influence et reporting :
                  on construit un système social cohérent, pas des publications isolées.
                </p>
              </div>

              <div class="rounded-[2rem] border border-white/10 bg-black/[0.36] p-5">
                <div class="flex items-center justify-between">
                  <div>
                    <div class="text-[10px] font-black uppercase tracking-[0.18em] text-white/[0.38]">
                      Post composer
                    </div>
                    <div class="mt-2 text-2xl font-black tracking-[-0.055em] text-white">
                      Campagne active
                    </div>
                  </div>

                  <Bell :size="22" class="text-brand-orange" />
                </div>

                <div class="mt-5 rounded-[1.4rem] border border-white/10 bg-white/[0.06] p-4">
                  <p class="text-sm leading-6 text-white/[0.58]">
                    “Construire une présence sociale qui attire, engage et convertit.”
                  </p>

                  <div class="mt-4 flex flex-wrap gap-2">
                    <span class="rounded-xl bg-brand-blue/30 px-3 py-2 text-[10px] font-black uppercase tracking-[0.12em]">
                      #Brand
                    </span>
                    <span class="rounded-xl bg-brand-emerald/30 px-3 py-2 text-[10px] font-black uppercase tracking-[0.12em]">
                      #Growth
                    </span>
                    <span class="rounded-xl bg-brand-orange/30 px-3 py-2 text-[10px] font-black uppercase tracking-[0.12em]">
                      #Content
                    </span>
                  </div>
                </div>

                <div class="mt-5 grid gap-3">
                  <Link
                    href="/contact"
                    class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] bg-brand-orange px-5 py-4 text-sm font-black text-white shadow-orange transition hover:-translate-y-0.5 hover:bg-brand-orange/90"
                  >
                    Booster mes réseaux
                    <ArrowRight :size="18" />
                  </Link>

                  <a
                    :href="contactPhoneHref"
                    class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] border border-white/10 bg-white/[0.08] px-5 py-4 text-sm font-black text-white transition hover:-translate-y-0.5 hover:bg-white/[0.12]"
                  >
                    <Phone :size="18" />
                    Audit social média
                  </a>
                </div>
              </div>
            </div>
          </aside>

          <!-- Central phone -->
          <section class="relative min-h-[740px]">
            <div :class="['absolute left-1/2 top-1/2 h-[86%] w-[70%] -translate-x-1/2 -translate-y-1/2 rounded-[6rem] blur-3xl transition duration-700', activeMode.glow]"></div>

            <div class="social-phone absolute left-1/2 top-1/2 z-20 w-full max-w-[440px] -translate-x-1/2 -translate-y-1/2 overflow-hidden rounded-[3.3rem] border border-white/10 bg-white/[0.08] p-4 shadow-[0_45px_160px_rgba(0,0,0,0.50)] backdrop-blur-2xl">
              <div class="relative min-h-[660px] overflow-hidden rounded-[2.7rem] border border-white/10 bg-[#080D15] p-5">
                <div class="absolute inset-0 bg-[linear-gradient(120deg,rgba(255,255,255,0.07)_0,transparent_24%,rgba(16,185,129,0.10)_52%,transparent_78%)]"></div>

                <div class="relative z-10 flex items-center justify-between border-b border-white/10 pb-4">
                  <div class="flex items-center gap-3">
                    <div :class="['flex h-12 w-12 items-center justify-center rounded-2xl text-white', activeMode.accent]">
                      <component :is="activeMode.icon" :size="23" />
                    </div>

                    <div>
                      <div class="text-[10px] font-black uppercase tracking-[0.20em] text-white/[0.38]">
                        Live feed
                      </div>

                      <div class="text-base font-black tracking-[-0.035em] text-white">
                        {{ activeMode.title }}
                      </div>
                    </div>
                  </div>

                  <div class="rounded-xl border border-brand-emerald/30 bg-brand-emerald/[0.12] px-3 py-2 text-[10px] font-black uppercase tracking-[0.14em] text-brand-emerald">
                    {{ activeMode.format }}
                  </div>
                </div>

                <!-- Stories -->
                <div class="relative z-10 mt-5 flex gap-3 overflow-hidden">
                  <div
                    v-for="platform in platforms.slice(0, 5)"
                    :key="platform.name"
                    class="shrink-0 text-center"
                  >
                    <div class="story-ring flex h-14 w-14 items-center justify-center rounded-2xl bg-white/[0.07]">
                      <component :is="platform.icon" :size="18" class="text-brand-orange" />
                    </div>

                    <div class="mt-2 w-14 truncate text-[9px] font-black uppercase tracking-[0.08em] text-white/[0.40]">
                      {{ platform.name }}
                    </div>
                  </div>
                </div>

                <!-- Main post -->
                <div class="relative z-10 mt-6 overflow-hidden rounded-[2rem] border border-white/10 bg-black/[0.34]">
                  <div class="relative min-h-[330px] p-5">
                    <div v-if="activeMode.visual === 'strategy'" class="absolute inset-0 p-5">
                      <div class="grid h-full grid-cols-3 gap-3">
                        <div class="rounded-[1.6rem] bg-brand-blue/45"></div>
                        <div class="rounded-[1.6rem] bg-brand-emerald/30"></div>
                        <div class="rounded-[1.6rem] bg-brand-orange/30"></div>
                        <div class="col-span-2 rounded-[1.6rem] bg-white/[0.08]"></div>
                        <div class="rounded-[1.6rem] bg-brand-blue/30"></div>
                      </div>
                      <Target :size="48" class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-white" />
                    </div>

                    <div v-else-if="activeMode.visual === 'content'" class="absolute inset-0 p-5">
                      <div class="reel-scroll grid h-full grid-cols-2 gap-3">
                        <div class="rounded-[1.8rem] bg-brand-orange/40"></div>
                        <div class="rounded-[1.8rem] bg-white/[0.10]"></div>
                        <div class="rounded-[1.8rem] bg-brand-emerald/30"></div>
                        <div class="rounded-[1.8rem] bg-brand-blue/40"></div>
                      </div>
                      <Video :size="48" class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-white" />
                    </div>

                    <div v-else-if="activeMode.visual === 'community'" class="absolute inset-0 flex items-center justify-center p-5">
                      <div class="relative h-64 w-64">
                        <div class="community-orbit absolute inset-0 rounded-full border border-dashed border-brand-emerald/40"></div>
                        <div class="absolute left-1/2 top-1/2 flex h-24 w-24 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-[2rem] bg-brand-emerald text-white">
                          <UsersRound :size="42" />
                        </div>
                        <div class="absolute left-4 top-8 h-12 w-12 rounded-2xl bg-white/[0.12]"></div>
                        <div class="absolute right-6 top-14 h-10 w-10 rounded-2xl bg-brand-orange/40"></div>
                        <div class="absolute bottom-8 left-12 h-11 w-11 rounded-2xl bg-brand-blue/45"></div>
                        <div class="absolute bottom-12 right-10 h-9 w-9 rounded-2xl bg-white/[0.16]"></div>
                      </div>
                    </div>

                    <div v-else-if="activeMode.visual === 'ads'" class="absolute inset-0 p-5">
                      <div class="grid h-full grid-cols-[0.75fr_1.25fr] gap-4">
                        <div class="rounded-[1.8rem] bg-white p-4 text-slate-950">
                          <MousePointerClick :size="24" class="text-brand-blue" />
                          <div class="mt-28 h-2 rounded-full bg-slate-200"></div>
                          <div class="mt-2 h-2 w-2/3 rounded-full bg-slate-200"></div>
                        </div>

                        <div class="flex items-end gap-3">
                          <div class="h-20 flex-1 rounded-xl bg-brand-blue/40"></div>
                          <div class="h-36 flex-1 rounded-xl bg-brand-emerald/40"></div>
                          <div class="h-52 flex-1 rounded-xl bg-brand-orange/45"></div>
                        </div>
                      </div>
                    </div>

                    <div v-else-if="activeMode.visual === 'influence'" class="absolute inset-0 p-5">
                      <div class="relative h-full rounded-[2rem] bg-gradient-to-br from-brand-orange/30 to-brand-emerald/20">
                        <Sparkles :size="56" class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-white" />
                        <div class="absolute left-6 top-6 rounded-2xl bg-white px-4 py-3 text-sm font-black text-slate-950">Collab</div>
                        <div class="absolute bottom-6 right-6 rounded-2xl bg-brand-orange px-4 py-3 text-sm font-black text-white">Reach ↑</div>
                      </div>
                    </div>

                    <div v-else class="absolute inset-0 p-5">
                      <div class="space-y-5">
                        <div>
                          <div class="flex justify-between text-xs font-black uppercase tracking-[0.14em] text-white/[0.38]">
                            <span>Engagement</span>
                            <span>88%</span>
                          </div>
                          <div class="mt-2 h-2 rounded-full bg-white/[0.08]">
                            <div class="social-meter h-full rounded-full bg-brand-emerald"></div>
                          </div>
                        </div>

                        <div>
                          <div class="flex justify-between text-xs font-black uppercase tracking-[0.14em] text-white/[0.38]">
                            <span>Reach</span>
                            <span>74%</span>
                          </div>
                          <div class="mt-2 h-2 rounded-full bg-white/[0.08]">
                            <div class="social-meter-alt h-full rounded-full bg-brand-orange"></div>
                          </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 pt-6">
                          <div class="rounded-2xl bg-white p-4 text-slate-950">
                            <BarChart3 :size="24" class="text-brand-blue" />
                            <div class="mt-12 text-sm font-black">KPI</div>
                          </div>

                          <div class="rounded-2xl bg-brand-emerald/35 p-4">
                            <TrendingUp :size="24" class="text-white" />
                            <div class="mt-12 text-sm font-black text-white">Growth</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="relative z-10 border-t border-white/10 p-5">
                    <div class="flex items-center justify-between">
                      <div class="flex gap-3">
                        <Heart :size="20" class="text-brand-orange" />
                        <MessageCircle :size="20" class="text-white/[0.55]" />
                        <Send :size="20" class="text-white/[0.55]" />
                      </div>

                      <Bookmark :size="20" class="text-brand-emerald" />
                    </div>

                    <h3 class="mt-4 text-2xl font-black tracking-[-0.055em] text-white">
                      {{ activeMode.title }}
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-white/[0.56]">
                      {{ activeMode.caption }}
                    </p>

                    <div class="mt-4 flex flex-wrap gap-2">
                      <span
                        v-for="tag in activeMode.tags"
                        :key="tag"
                        class="rounded-xl border border-white/10 bg-white/[0.07] px-3 py-2 text-[10px] font-black uppercase tracking-[0.12em] text-white/[0.55]"
                      >
                        #{{ tag }}
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Notifications -->
            <div class="notification-card absolute left-0 top-16 z-10 hidden w-64 rotate-[-8deg] rounded-[2rem] border border-white/10 bg-white p-5 text-slate-950 shadow-2xl lg:block">
              <Heart :size="23" class="text-brand-orange" />
              <div class="mt-5 text-2xl font-black tracking-[-0.06em]">+ Engagement</div>
              <div class="mt-1 text-xs font-bold uppercase tracking-[0.16em] text-slate-400">Audience active</div>
            </div>

            <div class="notification-card-delay absolute bottom-20 right-0 z-10 hidden w-64 rotate-[7deg] rounded-[2rem] border border-white/10 bg-brand-emerald p-5 text-white shadow-2xl lg:block">
              <TrendingUp :size="24" />
              <div class="mt-8 text-2xl font-black tracking-[-0.06em]">Growth loop</div>
              <div class="mt-1 text-xs font-bold uppercase tracking-[0.16em] text-white/[0.65]">Post · Analyse · Optimise</div>
            </div>
          </section>

          <!-- Control panel -->
          <aside class="relative overflow-hidden rounded-[2.6rem] border border-white/10 bg-white/[0.055] p-5 backdrop-blur-2xl">
            <div class="absolute -bottom-24 -right-20 h-72 w-72 rounded-[4rem] bg-brand-emerald/20 blur-3xl"></div>

            <div class="relative">
              <div class="flex items-center justify-between gap-3">
                <div>
                  <div class="text-[10px] font-black uppercase tracking-[0.22em] text-white/[0.36]">
                    Content control
                  </div>

                  <div class="mt-2 text-2xl font-black tracking-[-0.06em] text-white">
                    Feed Engine
                  </div>
                </div>

                <Zap :size="27" class="text-brand-orange" />
              </div>

              <div class="mt-6 grid grid-cols-2 gap-3">
                <div
                  v-for="item in metrics"
                  :key="item.label"
                  class="rounded-[1.4rem] border border-white/10 bg-black/[0.35] p-4"
                >
                  <component :is="item.icon" :size="20" class="text-brand-orange" />

                  <div class="mt-5 text-xl font-black text-white">
                    {{ item.value }}
                  </div>

                  <div class="mt-1 text-[10px] font-bold uppercase tracking-[0.12em] text-white/[0.42]">
                    {{ item.label }}
                  </div>
                </div>
              </div>

              <div class="mt-5 space-y-2">
                <button
                  v-for="(mode, index) in socialModes"
                  :key="mode.title"
                  type="button"
                  :class="[
                    'w-full rounded-[1.2rem] border p-3 text-left transition',
                    activeIndex === index
                      ? 'border-brand-orange/50 bg-brand-orange/[0.16]'
                      : 'border-white/10 bg-white/[0.045] hover:bg-white/[0.09]'
                  ]"
                  @click="setActive(index)"
                >
                  <div class="flex items-center justify-between gap-3">
                    <component
                      :is="mode.icon"
                      :size="18"
                      :class="activeIndex === index ? 'text-brand-orange' : 'text-white/[0.40]'"
                    />

                    <span class="text-[10px] font-black uppercase tracking-[0.14em] text-white/[0.36]">
                      {{ mode.code }}
                    </span>
                  </div>

                  <div
                    :class="[
                      'mt-3 text-sm font-black',
                      activeIndex === index ? 'text-white' : 'text-white/[0.56]'
                    ]"
                  >
                    {{ mode.format }}
                  </div>
                </button>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </section>

    <!-- PLATFORM CODES -->
    <section class="relative isolate overflow-hidden px-3 py-14 sm:px-4 lg:px-6">
      <div class="absolute inset-0 bg-[linear-gradient(180deg,#050816,#08111F_54%,#050816)]"></div>

      <div class="site-container relative z-10">
        <div class="grid gap-8 lg:grid-cols-[0.42fr_1.58fr] lg:items-start">
          <div>
            <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-orange">
              <Globe2 :size="15" />
              Codes plateformes
            </div>

            <h2 class="mt-5 text-4xl font-black leading-[0.95] tracking-[-0.06em] text-white sm:text-5xl">
              Chaque réseau a
              <span class="block text-brand-orange">son propre langage.</span>
            </h2>

            <p class="mt-5 text-sm leading-7 text-white/[0.55]">
              Le même message ne doit pas être publié de la même manière partout.
            </p>
          </div>

          <div class="grid gap-3 md:grid-cols-3">
            <div
              v-for="platform in platforms"
              :key="platform.name"
              class="group relative min-h-48 overflow-hidden rounded-[2rem] border border-white/10 bg-white/[0.055] p-5 backdrop-blur-xl transition hover:-translate-y-1 hover:bg-white/[0.09]"
            >
              <div class="absolute -right-16 -top-16 h-44 w-44 rounded-[3rem] bg-brand-blue/20 blur-3xl transition group-hover:scale-125"></div>

              <component :is="platform.icon" :size="26" class="relative text-brand-orange" />

              <h3 class="relative mt-16 text-2xl font-black tracking-[-0.055em] text-white">
                {{ platform.name }}
              </h3>

              <p class="relative mt-1 text-xs font-bold uppercase tracking-[0.13em] text-white/[0.42]">
                {{ platform.label }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CALENDAR + LOOP -->
    <section class="relative isolate overflow-hidden px-3 py-14 pb-20 sm:px-4 lg:px-6 lg:pb-24">
      <div class="site-container relative z-10">
        <div class="grid gap-5 lg:grid-cols-[1.1fr_0.9fr]">
          <div class="relative overflow-hidden rounded-[2.8rem] border border-white/10 bg-white/[0.06] p-6 backdrop-blur-2xl">
            <div class="absolute -right-24 -top-24 h-80 w-80 rounded-[5rem] bg-brand-blue/20 blur-3xl"></div>

            <div class="relative">
              <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-orange">
                <CalendarDays :size="14" />
                Calendrier éditorial
              </div>

              <h2 class="mt-5 max-w-2xl text-4xl font-black leading-[0.95] tracking-[-0.06em] text-white">
                Le contenu doit avoir
                <span class="block text-brand-orange">un rythme de publication.</span>
              </h2>

              <div class="mt-8 grid grid-cols-2 gap-3 sm:grid-cols-7">
                <div
                  v-for="item in calendarDays"
                  :key="item.day"
                  class="min-h-48 rounded-[1.6rem] border border-white/10 bg-black/[0.35] p-4"
                >
                  <div class="text-[10px] font-black uppercase tracking-[0.16em] text-white/[0.36]">
                    {{ item.day }}
                  </div>

                  <div :class="['mt-10 h-16 rounded-[1.2rem]', item.color]"></div>

                  <div class="mt-8 text-sm font-black text-white">
                    {{ item.type }}
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="relative overflow-hidden rounded-[2.8rem] border border-white/10 bg-white/[0.06] p-6 backdrop-blur-2xl">
            <div class="absolute -bottom-24 -right-20 h-80 w-80 rounded-[4rem] bg-brand-emerald/15 blur-3xl"></div>

            <div class="relative">
              <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald">
                <TrendingUp :size="14" />
                Growth loop
              </div>

              <div class="mt-6 space-y-3">
                <div
                  v-for="(step, index) in contentLoop"
                  :key="step.title"
                  class="rounded-[1.6rem] border border-white/10 bg-black/[0.35] p-4"
                >
                  <div class="flex items-start gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white text-brand-blue">
                      <component :is="step.icon" :size="21" />
                    </div>

                    <div>
                      <div class="text-[10px] font-black uppercase tracking-[0.18em] text-white/[0.32]">
                        0{{ index + 1 }}
                      </div>

                      <h3 class="mt-1 text-base font-black text-white">
                        {{ step.title }}
                      </h3>

                      <p class="mt-1 text-sm leading-6 text-white/[0.52]">
                        {{ step.text }}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- FORMATS -->
          <div class="relative overflow-hidden rounded-[2.8rem] border border-white/10 bg-white/[0.06] p-6 backdrop-blur-2xl lg:col-span-2">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_18%,rgba(30,58,138,0.18),transparent_30%),radial-gradient(circle_at_86%_80%,rgba(249,115,22,0.13),transparent_32%)]"></div>

            <div class="relative grid gap-8 lg:grid-cols-[0.42fr_1.58fr] lg:items-center">
              <div>
                <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-orange">
                  <Hash :size="14" />
                  Formats sociaux
                </div>

                <h2 class="mt-5 text-4xl font-black leading-[0.95] tracking-[-0.06em] text-white">
                  Un message.
                  <span class="block text-brand-orange">Plusieurs formats.</span>
                </h2>
              </div>

              <div class="grid gap-3 md:grid-cols-3">
                <div
                  v-for="format in contentFormats"
                  :key="format.title"
                  class="rounded-[1.7rem] border border-white/10 bg-black/[0.35] p-5"
                >
                  <div
                    :class="[
                      'flex h-12 w-12 items-center justify-center rounded-2xl',
                      format.tone,
                      format.tone === 'bg-white' ? 'text-brand-blue' : 'text-white'
                    ]"
                  >
                    <component :is="format.icon" :size="23" />
                  </div>

                  <div class="mt-14 text-xl font-black text-white">
                    {{ format.title }}
                  </div>

                  <div class="mt-1 text-xs font-bold uppercase tracking-[0.12em] text-white/[0.42]">
                    {{ format.label }}
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- CTA -->
          <div class="relative overflow-hidden rounded-[2.8rem] border border-white/10 bg-white/[0.065] p-6 backdrop-blur-2xl lg:col-span-2 sm:p-8">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_18%,rgba(30,58,138,0.18),transparent_30%),radial-gradient(circle_at_86%_80%,rgba(16,185,129,0.14),transparent_32%)]"></div>

            <div class="relative grid gap-8 lg:grid-cols-[0.86fr_1.14fr] lg:items-center">
              <div>
                <div class="flex h-16 w-16 items-center justify-center rounded-[1.4rem] bg-brand-orange text-white shadow-orange">
                  <MessageSquare :size="28" />
                </div>

                <h2 class="mt-6 text-4xl font-black leading-[0.95] tracking-[-0.06em] text-white sm:text-5xl">
                  Vos réseaux deviennent
                  <span class="block bg-gradient-to-r from-brand-blue via-white to-brand-emerald bg-clip-text text-transparent">
                    un vrai actif commercial.
                  </span>
                </h2>

                <p class="mt-4 max-w-xl text-sm leading-7 text-white/[0.60]">
                  Contenu, animation, publicité, influence et reporting : chaque action sert une progression mesurable.
                </p>
              </div>

              <div>
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
                  <div
                    v-for="item in deliverables"
                    :key="item.title"
                    class="rounded-[1.5rem] border border-white/10 bg-black/[0.35] p-4"
                  >
                    <BadgeCheck :size="19" class="text-brand-emerald" />

                    <div class="mt-5 text-lg font-black text-white">
                      {{ item.title }}
                    </div>

                    <div class="mt-1 text-xs font-bold uppercase tracking-[0.12em] text-white/[0.40]">
                      {{ item.label }}
                    </div>
                  </div>
                </div>

                <div class="mt-5 grid gap-3 sm:grid-cols-3">
                  <Link
                    href="/contact"
                    class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] bg-brand-orange px-5 py-4 text-sm font-black text-white shadow-orange transition hover:-translate-y-0.5 hover:bg-brand-orange/90 sm:col-span-3"
                  >
                    Obtenir une stratégie sociale
                    <ArrowRight :size="18" />
                  </Link>

                  <a
                    :href="contactPhoneHref"
                    class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] border border-white/10 bg-white/[0.08] px-5 py-4 text-sm font-black text-white transition hover:-translate-y-0.5 hover:bg-white/[0.12] sm:col-span-3 lg:col-span-1"
                  >
                    <Phone :size="18" />
                    Appeler
                  </a>

                  <a
                    :href="`mailto:${contactEmail}`"
                    class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] border border-white/10 bg-white/[0.08] px-5 py-4 text-sm font-black text-white transition hover:-translate-y-0.5 hover:bg-white/[0.12] sm:col-span-3 lg:col-span-2"
                  >
                    <Mail :size="18" />
                    {{ contactEmail }}
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div class="grid gap-3 lg:col-span-2 sm:grid-cols-4">
            <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.055] p-5 backdrop-blur">
              <Heart :size="22" class="text-brand-orange" />
              <div class="mt-3 text-sm font-black text-white">Engagement boosté</div>
            </div>

            <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.055] p-5 backdrop-blur">
              <Eye :size="22" class="text-brand-emerald" />
              <div class="mt-3 text-sm font-black text-white">Visibilité accrue</div>
            </div>

            <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.055] p-5 backdrop-blur">
              <BarChart3 :size="22" class="text-brand-orange" />
              <div class="mt-3 text-sm font-black text-white">ROI suivi</div>
            </div>

            <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.055] p-5 backdrop-blur">
              <ShieldCheck :size="22" class="text-brand-emerald" />
              <div class="mt-3 text-sm font-black text-white">Image maîtrisée</div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<style scoped>
@keyframes reactionBubble {
  0%, 100% {
    transform: translate3d(0, 0, 0) rotate(0deg) scale(1);
    opacity: 0.35;
  }

  50% {
    transform: translate3d(18px, -24px, 0) rotate(12deg) scale(1.08);
    opacity: 0.85;
  }
}

@keyframes socialPhone {
  0%, 100% {
    transform: translate(-50%, -50%) rotate(-1deg);
  }

  50% {
    transform: translate(-50%, calc(-50% - 12px)) rotate(1deg);
  }
}

@keyframes notificationCard {
  0%, 100% {
    transform: translateY(0) rotate(-8deg);
  }

  50% {
    transform: translateY(-14px) rotate(-4deg);
  }
}

@keyframes notificationCardDelay {
  0%, 100% {
    transform: translateY(0) rotate(7deg);
  }

  50% {
    transform: translateY(14px) rotate(3deg);
  }
}

@keyframes storyRing {
  0%, 100% {
    box-shadow: 0 0 0 0 rgba(249, 115, 22, 0.24);
  }

  50% {
    box-shadow: 0 0 0 8px rgba(249, 115, 22, 0);
  }
}

@keyframes communityOrbit {
  0% {
    transform: rotate(0deg) scale(1);
  }

  50% {
    transform: rotate(180deg) scale(1.08);
  }

  100% {
    transform: rotate(360deg) scale(1);
  }
}

@keyframes reelScroll {
  0%, 100% {
    transform: translateY(0);
  }

  50% {
    transform: translateY(-18px);
  }
}

@keyframes socialMeter {
  0% {
    width: 28%;
  }

  50% {
    width: 88%;
  }

  100% {
    width: 62%;
  }
}

@keyframes socialMeterAlt {
  0% {
    width: 24%;
  }

  50% {
    width: 74%;
  }

  100% {
    width: 54%;
  }
}

.reaction-bubble {
  animation: reactionBubble 7s ease-in-out infinite;
}

.social-phone {
  animation: socialPhone 7s ease-in-out infinite;
}

.notification-card {
  animation: notificationCard 6s ease-in-out infinite;
}

.notification-card-delay {
  animation: notificationCardDelay 6.5s ease-in-out infinite;
}

.story-ring {
  animation: storyRing 2.4s ease-in-out infinite;
}

.community-orbit {
  animation: communityOrbit 16s linear infinite;
}

.reel-scroll {
  animation: reelScroll 4.4s ease-in-out infinite;
}

.social-meter {
  animation: socialMeter 3.4s ease-in-out infinite;
}

.social-meter-alt {
  animation: socialMeterAlt 3.6s ease-in-out infinite;
}
</style>