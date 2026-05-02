<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/GuestLayout.vue';
import {
  ArrowLeft,
  ArrowRight,
  BadgeCheck,
  CalendarDays,
  Camera,
  CheckCircle2,
  Clock3,
  Globe2,
  Mail,
  MapPin,
  Megaphone,
  MessageCircle,
  Mic,
  Phone,
  QrCode,
  Radio,
  Send,
  ShieldCheck,
  Sparkles,
  Star,
  Ticket,
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

const eventModes = [
  {
    code: 'PASS-01',
    title: 'Événement corporate',
    label: 'Conférence · séminaire · soirée institutionnelle',
    badge: 'Corporate',
    icon: UsersRound,
    accent: 'bg-brand-emerald',
    glow: 'bg-brand-emerald/[0.24]',
    objective: 'Créer un moment professionnel, fluide, élégant et aligné avec votre image.',
    items: ['Accueil', 'Scène', 'Invités', 'Coordination'],
  },
  {
    code: 'PASS-02',
    title: 'Lancement produit',
    label: 'Annonce · démonstration · activation',
    badge: 'Launch',
    icon: Star,
    accent: 'bg-brand-orange',
    glow: 'bg-brand-orange/[0.24]',
    objective: 'Mettre votre nouveauté en scène pour générer attention, désir et conversation.',
    items: ['Concept', 'Démo', 'Médias', 'Activation'],
  },
  {
    code: 'PASS-03',
    title: 'Relations presse',
    label: 'Journalistes · médias · retombées',
    badge: 'RP',
    icon: Megaphone,
    accent: 'bg-brand-blue',
    glow: 'bg-brand-blue/[0.30]',
    objective: 'Transformer votre actualité en visibilité médiatique crédible et structurée.',
    items: ['Communiqué', 'Presse', 'Interview', 'Suivi'],
  },
  {
    code: 'PASS-04',
    title: 'Événement hybride',
    label: 'Présentiel · live · replay',
    badge: 'Hybrid',
    icon: Globe2,
    accent: 'bg-brand-emerald',
    glow: 'bg-brand-emerald/[0.24]',
    objective: 'Étendre l’expérience au-delà du lieu physique avec du live et du contenu réutilisable.',
    items: ['Streaming', 'Replay', 'Interaction', 'Diffusion'],
  },
  {
    code: 'PASS-05',
    title: 'Influence & partenariats',
    label: 'Ambassadeurs · créateurs · relais',
    badge: 'Influence',
    icon: TrendingUp,
    accent: 'bg-brand-orange',
    glow: 'bg-brand-orange/[0.24]',
    objective: 'Créer des relais humains et digitaux autour de votre événement.',
    items: ['Créateurs', 'Partenaires', 'Social', 'ROI'],
  },
  {
    code: 'PASS-06',
    title: 'Crise & réputation',
    label: 'Veille · message · image',
    badge: 'Crisis',
    icon: ShieldCheck,
    accent: 'bg-brand-blue',
    glow: 'bg-brand-blue/[0.30]',
    objective: 'Préparer les bons messages et protéger votre image en contexte sensible.',
    items: ['Veille', 'Réponse', 'Porte-parole', 'Image'],
  },
];

const journey = [
  {
    time: 'Avant',
    title: 'Créer l’attente',
    text: 'Concept, invitations, médias, partenaires et teasing.',
    icon: CalendarDays,
  },
  {
    time: 'Pendant',
    title: 'Maîtriser le moment',
    text: 'Accueil, scène, timing, régie, animation et expérience invités.',
    icon: Mic,
  },
  {
    time: 'Live',
    title: 'Amplifier en direct',
    text: 'Live posting, photos, vidéos, presse, stories et interactions.',
    icon: Radio,
  },
  {
    time: 'Après',
    title: 'Faire durer l’impact',
    text: 'Aftermovie, retombées, reporting, contenus et suivi relationnel.',
    icon: Send,
  },
];

const experienceDesk = [
  {
    title: 'Invitation',
    label: 'RSVP, badges, invités',
    icon: Ticket,
  },
  {
    title: 'Lieu',
    label: 'Plan, scène, accueil',
    icon: MapPin,
  },
  {
    title: 'Médias',
    label: 'Presse, influence, RP',
    icon: Megaphone,
  },
  {
    title: 'Contenu',
    label: 'Photo, vidéo, live',
    icon: Camera,
  },
];

const deliverables = [
  { title: 'Concept event', label: 'angle & expérience' },
  { title: 'Guest list', label: 'invités & RSVP' },
  { title: 'Kit presse', label: 'médias & message' },
  { title: 'Live content', label: 'posts & stories' },
  { title: 'Aftermovie', label: 'souvenir premium' },
  { title: 'Reporting', label: 'impact & retombées' },
];

const proof = [
  { title: 'Logistique cadrée', icon: BadgeCheck },
  { title: 'Expérience premium', icon: Sparkles },
  { title: 'Retombées médias', icon: Megaphone },
  { title: 'Suivi post-event', icon: Clock3 },
];

const confetti = [
  'left-[8%] top-[18%] bg-brand-orange',
  'left-[18%] top-[72%] bg-brand-emerald',
  'left-[38%] top-[12%] bg-white',
  'right-[12%] top-[20%] bg-brand-orange',
  'right-[20%] bottom-[24%] bg-brand-emerald',
  'left-[58%] bottom-[16%] bg-brand-blue',
  'left-[74%] top-[42%] bg-white',
  'left-[46%] bottom-[38%] bg-brand-orange',
];

const activeMode = computed(() => eventModes[activeIndex.value] || eventModes[0]);

const setActive = (index) => {
  activeIndex.value = index;
};

onMounted(() => {
  intervalId = window.setInterval(() => {
    activeIndex.value = (activeIndex.value + 1) % eventModes.length;
  }, 2800);
});

onUnmounted(() => {
  if (intervalId) {
    window.clearInterval(intervalId);
  }
});
</script>

<template>
  <Head title="Événementiel & RP — KOTAVA Communication">
    <meta
      name="description"
      content="KOTAVA Communication conçoit et organise des événements corporate, lancements produits, relations presse, campagnes d’influence, événements hybrides et dispositifs RP."
    />
  </Head>

  <main class="relative overflow-hidden bg-[#06070B] text-white">
    <!-- EVENT PASSPORT HERO -->
    <section class="relative isolate min-h-screen overflow-hidden px-3 pb-10 pt-28 sm:px-4 lg:px-6 lg:pt-32">
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_16%,rgba(249,115,22,0.20),transparent_28%),radial-gradient(circle_at_86%_78%,rgba(16,185,129,0.16),transparent_30%),linear-gradient(180deg,#06070B_0%,#08111F_50%,#06070B_100%)]"></div>

      <div class="absolute left-[10%] top-0 h-[76%] w-[20%] -skew-x-12 bg-gradient-to-b from-brand-orange/[0.20] via-brand-orange/[0.04] to-transparent blur-2xl"></div>
      <div class="absolute right-[12%] top-0 h-[78%] w-[22%] skew-x-12 bg-gradient-to-b from-brand-emerald/[0.18] via-brand-emerald/[0.04] to-transparent blur-2xl"></div>

      <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div
          v-for="(item, index) in confetti"
          :key="item"
          :class="['event-confetti absolute h-3 w-2 rounded-[0.25rem]', item]"
          :style="{ animationDelay: `${index * 180}ms` }"
        ></div>

        <div class="absolute left-1/2 top-[12%] hidden -translate-x-1/2 select-none text-[10vw] font-black uppercase leading-none tracking-[-0.12em] text-white/[0.025] lg:block">
          EVENT PASS
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

        <div class="grid gap-8 lg:grid-cols-[0.72fr_1.28fr] lg:items-center">
          <div>
            <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-orange backdrop-blur">
              <Ticket :size="14" />
              Event Passport Experience
            </div>

            <h1 class="mt-6 max-w-4xl text-5xl font-black leading-[0.88] tracking-[-0.075em] text-white sm:text-6xl lg:text-7xl">
              Un événement doit
              <span class="block bg-gradient-to-r from-brand-orange via-white to-brand-emerald bg-clip-text text-transparent">
                exister avant le jour J.
              </span>
            </h1>

            <p class="mt-6 max-w-xl text-base leading-8 text-white/[0.64]">
              Concept, invités, scène, médias, influence, live et contenus post-event :
              nous créons une expérience complète, pas une simple organisation.
            </p>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
              <Link
                href="/contact"
                class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] bg-brand-orange px-6 py-4 text-sm font-black text-white shadow-orange transition hover:-translate-y-0.5 hover:bg-brand-orange/90"
              >
                Planifier mon événement
                <ArrowRight :size="18" />
              </Link>

              <a
                :href="contactPhoneHref"
                class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] border border-white/10 bg-white/[0.08] px-6 py-4 text-sm font-black text-white transition hover:-translate-y-0.5 hover:bg-white/[0.12]"
              >
                <Phone :size="18" />
                Conseil événementiel
              </a>
            </div>
          </div>

          <!-- Passport composition -->
          <div class="relative min-h-[720px]">
            <div :class="['absolute left-1/2 top-1/2 h-[86%] w-[72%] -translate-x-1/2 -translate-y-1/2 rounded-[6rem] blur-3xl transition duration-700', activeMode.glow]"></div>

            <!-- Big invitation pass -->
            <div class="event-pass absolute left-1/2 top-1/2 z-20 w-full max-w-[620px] -translate-x-1/2 -translate-y-1/2 overflow-hidden rounded-[3rem] border border-white/10 bg-white/[0.07] p-5 shadow-[0_45px_150px_rgba(0,0,0,0.45)] backdrop-blur-2xl">
              <div class="relative overflow-hidden rounded-[2.4rem] border border-white/10 bg-[#080D15] p-6">
                <div class="absolute inset-0 bg-[linear-gradient(115deg,rgba(255,255,255,0.08)_0,transparent_24%,rgba(249,115,22,0.14)_52%,transparent_78%)]"></div>

                <div class="relative z-10 flex items-start justify-between gap-5 border-b border-white/10 pb-6">
                  <div>
                    <div class="text-[10px] font-black uppercase tracking-[0.24em] text-brand-orange">
                      Invitation officielle
                    </div>

                    <h2 class="mt-3 text-4xl font-black leading-[0.9] tracking-[-0.07em] text-white sm:text-5xl">
                      {{ activeMode.title }}
                    </h2>

                    <p class="mt-3 max-w-sm text-sm leading-6 text-white/[0.56]">
                      {{ activeMode.label }}
                    </p>
                  </div>

                  <div :class="['flex h-16 w-16 shrink-0 items-center justify-center rounded-[1.4rem] text-white', activeMode.accent]">
                    <component :is="activeMode.icon" :size="30" />
                  </div>
                </div>

                <div class="relative z-10 mt-6 grid gap-5 lg:grid-cols-[0.68fr_0.32fr]">
                  <div>
                    <div class="rounded-[2rem] border border-white/10 bg-black/[0.32] p-5">
                      <div class="flex items-center justify-between gap-4">
                        <div>
                          <div class="text-[10px] font-black uppercase tracking-[0.18em] text-white/[0.36]">
                            Objectif
                          </div>

                          <p class="mt-3 text-sm leading-6 text-white/[0.62]">
                            {{ activeMode.objective }}
                          </p>
                        </div>

                        <Sparkles :size="26" class="shrink-0 text-brand-orange" />
                      </div>
                    </div>

                    <div class="mt-4 grid grid-cols-2 gap-3">
                      <div
                        v-for="item in activeMode.items"
                        :key="item"
                        class="rounded-[1.3rem] border border-white/10 bg-white/[0.055] p-4"
                      >
                        <CheckCircle2 :size="16" class="text-brand-emerald" />
                        <div class="mt-4 text-sm font-black text-white">
                          {{ item }}
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="rounded-[2rem] border border-white/10 bg-white p-4 text-slate-950">
                    <div class="flex items-center justify-between">
                      <div>
                        <div class="text-[9px] font-black uppercase tracking-[0.18em] text-slate-400">
                          Access
                        </div>
                        <div class="mt-1 text-2xl font-black tracking-[-0.07em]">
                          VIP
                        </div>
                      </div>

                      <QrCode :size="32" class="text-brand-blue" />
                    </div>

                    <div class="mt-8 space-y-2">
                      <div class="h-2 rounded-[999px] bg-slate-200"></div>
                      <div class="h-2 w-4/5 rounded-[999px] bg-slate-200"></div>
                      <div class="h-2 w-2/3 rounded-[999px] bg-slate-200"></div>
                    </div>

                    <div class="mt-8 rounded-[1.2rem] bg-brand-orange px-4 py-3 text-center text-xs font-black uppercase tracking-[0.16em] text-white">
                      {{ activeMode.badge }}
                    </div>
                  </div>
                </div>

                <div class="relative z-10 mt-6 flex flex-wrap items-center justify-between gap-4 border-t border-white/10 pt-5">
                  <div>
                    <div class="text-[10px] font-black uppercase tracking-[0.20em] text-white/[0.36]">
                      {{ activeMode.code }}
                    </div>
                    <div class="mt-1 text-sm font-bold text-white/[0.55]">
                      Expérience conçue par KOTAVA
                    </div>
                  </div>

                  <div class="flex gap-2">
                    <span class="h-3 w-12 rounded-[999px] bg-brand-orange"></span>
                    <span class="h-3 w-12 rounded-[999px] bg-brand-emerald"></span>
                    <span class="h-3 w-12 rounded-[999px] bg-white"></span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Floating RSVP cards -->
            <div class="guest-float absolute left-0 top-12 z-10 hidden w-56 rotate-[-8deg] rounded-[2rem] border border-white/10 bg-white p-5 text-slate-950 shadow-2xl lg:block">
              <Ticket :size="22" class="text-brand-orange" />
              <div class="mt-5 text-2xl font-black tracking-[-0.06em]">RSVP</div>
              <div class="mt-1 text-xs font-bold uppercase tracking-[0.16em] text-slate-400">Invités confirmés</div>
            </div>

            <div class="guest-float-delay absolute bottom-12 right-0 z-10 hidden w-64 rotate-[7deg] rounded-[2rem] border border-white/10 bg-brand-orange p-5 text-white shadow-2xl lg:block">
              <Megaphone :size="24" />
              <div class="mt-8 text-2xl font-black tracking-[-0.06em]">Media push</div>
              <div class="mt-1 text-xs font-bold uppercase tracking-[0.16em] text-white/[0.65]">Presse · influence · social</div>
            </div>

            <!-- Selectors -->
            <div class="absolute inset-x-0 bottom-0 z-30 grid grid-cols-3 gap-2 sm:grid-cols-6">
              <button
                v-for="(mode, index) in eventModes"
                :key="mode.title"
                type="button"
                :class="[
                  'rounded-[1.15rem] border p-3 text-left backdrop-blur transition',
                  activeIndex === index
                    ? 'border-brand-orange/50 bg-brand-orange/[0.16]'
                    : 'border-white/10 bg-white/[0.055] hover:bg-white/[0.10]'
                ]"
                @click="setActive(index)"
              >
                <component
                  :is="mode.icon"
                  :size="17"
                  :class="activeIndex === index ? 'text-brand-orange' : 'text-white/[0.42]'"
                />

                <div
                  :class="[
                    'mt-2 text-[10px] font-black uppercase tracking-[0.12em]',
                    activeIndex === index ? 'text-white' : 'text-white/[0.46]'
                  ]"
                >
                  {{ mode.badge }}
                </div>
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- EXPERIENCE JOURNEY -->
    <section class="relative isolate overflow-hidden px-3 py-14 sm:px-4 lg:px-6">
      <div class="absolute inset-0 bg-[linear-gradient(180deg,#06070B,#08111F_54%,#06070B)]"></div>

      <div class="site-container relative z-10">
        <div class="grid gap-8 lg:grid-cols-[0.42fr_1.58fr] lg:items-start">
          <div>
            <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-orange">
              <Clock3 :size="15" />
              Event journey
            </div>

            <h2 class="mt-5 text-4xl font-black leading-[0.95] tracking-[-0.06em] text-white sm:text-5xl">
              L’impact se construit
              <span class="block text-brand-orange">en quatre temps.</span>
            </h2>

            <p class="mt-5 text-sm leading-7 text-white/[0.55]">
              La force d’un événement vient de ce qui se passe avant, pendant et après.
            </p>
          </div>

          <div class="relative overflow-hidden rounded-[2.6rem] border border-white/10 bg-white/[0.055] p-5 backdrop-blur-2xl">
            <div class="event-line absolute left-0 top-1/2 h-1 w-full -translate-y-1/2 bg-gradient-to-r from-brand-orange via-brand-emerald to-brand-blue opacity-60"></div>

            <div class="relative grid gap-4 md:grid-cols-4">
              <div
                v-for="(step, index) in journey"
                :key="step.title"
                class="relative min-h-72 rounded-[2rem] border border-white/10 bg-black/[0.38] p-5"
              >
                <div class="absolute -top-4 left-5 rounded-xl bg-white px-3 py-2 text-[10px] font-black uppercase tracking-[0.16em] text-slate-950">
                  {{ step.time }}
                </div>

                <div class="mt-8 flex h-14 w-14 items-center justify-center rounded-2xl bg-brand-orange text-white">
                  <component :is="step.icon" :size="24" />
                </div>

                <h3 class="mt-16 text-xl font-black tracking-[-0.04em] text-white">
                  {{ step.title }}
                </h3>

                <p class="mt-3 text-sm leading-6 text-white/[0.55]">
                  {{ step.text }}
                </p>

                <div class="absolute bottom-5 right-5 text-5xl font-black tracking-[-0.08em] text-white/[0.08]">
                  0{{ index + 1 }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CONTROL DESK + MEDIA PULSE -->
    <section class="relative isolate overflow-hidden px-3 py-14 pb-20 sm:px-4 lg:px-6 lg:pb-24">
      <div class="site-container relative z-10">
        <div class="grid gap-5 lg:grid-cols-[1fr_0.92fr]">
          <div class="relative overflow-hidden rounded-[2.8rem] border border-white/10 bg-white/[0.06] p-6 backdrop-blur-2xl">
            <div class="absolute -right-24 -top-24 h-80 w-80 rounded-[5rem] bg-brand-orange/[0.16] blur-3xl"></div>

            <div class="relative">
              <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-orange">
                <Radio :size="14" />
                Experience desk
              </div>

              <h2 class="mt-5 max-w-2xl text-4xl font-black leading-[0.95] tracking-[-0.06em] text-white">
                Invités, médias, lieu :
                <span class="block text-brand-orange">tout est orchestré.</span>
              </h2>

              <div class="mt-8 grid gap-3 sm:grid-cols-2">
                <div
                  v-for="item in experienceDesk"
                  :key="item.title"
                  class="min-h-44 rounded-[1.7rem] border border-white/10 bg-black/[0.35] p-5"
                >
                  <component :is="item.icon" :size="25" class="text-brand-orange" />

                  <div class="mt-16 text-xl font-black text-white">
                    {{ item.title }}
                  </div>

                  <div class="mt-1 text-xs font-bold uppercase tracking-[0.12em] text-white/[0.42]">
                    {{ item.label }}
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="relative overflow-hidden rounded-[2.8rem] border border-white/10 bg-white/[0.06] p-6 backdrop-blur-2xl">
            <div class="absolute -bottom-24 -right-20 h-80 w-80 rounded-[4rem] bg-brand-emerald/[0.14] blur-3xl"></div>

            <div class="relative">
              <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald">
                <TrendingUp :size="14" />
                Media pulse
              </div>

              <div class="mt-6 overflow-hidden rounded-[2rem] border border-white/10 bg-black/[0.35] p-5">
                <div class="flex items-center justify-between">
                  <div>
                    <div class="text-[10px] font-black uppercase tracking-[0.18em] text-white/[0.38]">
                      Retombées
                    </div>
                    <div class="mt-2 text-4xl font-black tracking-[-0.08em] text-white">
                      360°
                    </div>
                  </div>

                  <MessageCircle :size="32" class="text-brand-orange" />
                </div>

                <div class="mt-7 space-y-4">
                  <div>
                    <div class="flex justify-between text-xs font-black uppercase tracking-[0.14em] text-white/[0.38]">
                      <span>Presse</span>
                      <span>82%</span>
                    </div>
                    <div class="mt-2 h-2 rounded-[999px] bg-white/[0.08]">
                      <div class="event-meter h-full rounded-[999px] bg-brand-orange"></div>
                    </div>
                  </div>

                  <div>
                    <div class="flex justify-between text-xs font-black uppercase tracking-[0.14em] text-white/[0.38]">
                      <span>Social</span>
                      <span>91%</span>
                    </div>
                    <div class="mt-2 h-2 rounded-[999px] bg-white/[0.08]">
                      <div class="event-meter-alt h-full rounded-[999px] bg-brand-emerald"></div>
                    </div>
                  </div>

                  <div>
                    <div class="flex justify-between text-xs font-black uppercase tracking-[0.14em] text-white/[0.38]">
                      <span>Invités</span>
                      <span>76%</span>
                    </div>
                    <div class="mt-2 h-2 rounded-[999px] bg-white/[0.08]">
                      <div class="event-meter-third h-full rounded-[999px] bg-brand-blue"></div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="mt-4 grid grid-cols-2 gap-3">
                <div class="rounded-[1.4rem] bg-white p-4 text-slate-950">
                  <Megaphone :size="22" class="text-brand-blue" />
                  <div class="mt-10 text-sm font-black">Presse</div>
                </div>

                <div class="rounded-[1.4rem] bg-brand-orange/[0.30] p-4">
                  <Zap :size="22" class="text-white" />
                  <div class="mt-10 text-sm font-black text-white">Buzz</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Deliverables + CTA -->
          <div class="relative overflow-hidden rounded-[2.8rem] border border-white/10 bg-white/[0.065] p-6 backdrop-blur-2xl lg:col-span-2 sm:p-8">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_18%,rgba(249,115,22,0.16),transparent_30%),radial-gradient(circle_at_86%_80%,rgba(16,185,129,0.14),transparent_32%)]"></div>

            <div class="relative grid gap-8 lg:grid-cols-[0.86fr_1.14fr] lg:items-center">
              <div>
                <div class="flex h-16 w-16 items-center justify-center rounded-[1.4rem] bg-brand-orange text-white shadow-orange">
                  <Ticket :size="28" />
                </div>

                <h2 class="mt-6 text-4xl font-black leading-[0.95] tracking-[-0.06em] text-white sm:text-5xl">
                  Votre événement devient
                  <span class="block bg-gradient-to-r from-brand-orange via-white to-brand-emerald bg-clip-text text-transparent">
                    un actif de communication.
                  </span>
                </h2>

                <p class="mt-4 max-w-xl text-sm leading-7 text-white/[0.60]">
                  On prépare le concept, l’expérience, les médias, les contenus et les livrables
                  pour prolonger l’impact après l’événement.
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
                    Planifier mon événement
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
            <div
              v-for="item in proof"
              :key="item.title"
              class="rounded-[1.5rem] border border-white/10 bg-white/[0.055] p-5 backdrop-blur"
            >
              <component :is="item.icon" :size="22" class="text-brand-orange" />
              <div class="mt-3 text-sm font-black text-white">
                {{ item.title }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<style scoped>
@keyframes eventConfetti {
  0%, 100% {
    transform: translate3d(0, 0, 0) rotate(0deg);
    opacity: 0.25;
  }

  50% {
    transform: translate3d(20px, -26px, 0) rotate(22deg);
    opacity: 0.85;
  }
}

@keyframes eventPass {
  0%, 100% {
    transform: translate(-50%, -50%) rotate(-1deg);
  }

  50% {
    transform: translate(-50%, calc(-50% - 12px)) rotate(1deg);
  }
}

@keyframes guestFloat {
  0%, 100% {
    transform: translateY(0) rotate(-8deg);
  }

  50% {
    transform: translateY(-14px) rotate(-4deg);
  }
}

@keyframes guestFloatDelay {
  0%, 100% {
    transform: translateY(0) rotate(7deg);
  }

  50% {
    transform: translateY(14px) rotate(3deg);
  }
}

@keyframes eventLine {
  0% {
    transform: translateX(-30%);
    opacity: 0.35;
  }

  50% {
    transform: translateX(0%);
    opacity: 0.85;
  }

  100% {
    transform: translateX(30%);
    opacity: 0.35;
  }
}

@keyframes eventMeter {
  0% {
    width: 26%;
  }

  50% {
    width: 82%;
  }

  100% {
    width: 58%;
  }
}

@keyframes eventMeterAlt {
  0% {
    width: 30%;
  }

  50% {
    width: 91%;
  }

  100% {
    width: 64%;
  }
}

@keyframes eventMeterThird {
  0% {
    width: 22%;
  }

  50% {
    width: 76%;
  }

  100% {
    width: 52%;
  }
}

.event-confetti {
  animation: eventConfetti 7s ease-in-out infinite;
}

.event-pass {
  animation: eventPass 7s ease-in-out infinite;
}

.guest-float {
  animation: guestFloat 6s ease-in-out infinite;
}

.guest-float-delay {
  animation: guestFloatDelay 6.5s ease-in-out infinite;
}

.event-line {
  animation: eventLine 5s ease-in-out infinite;
}

.event-meter {
  animation: eventMeter 3.4s ease-in-out infinite;
}

.event-meter-alt {
  animation: eventMeterAlt 3.6s ease-in-out infinite;
}

.event-meter-third {
  animation: eventMeterThird 3.8s ease-in-out infinite;
}
</style>