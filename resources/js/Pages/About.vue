<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/GuestLayout.vue';
import {
  ArrowRight,
  Award,
  BadgeCheck,
  CheckCircle2,
  Compass,
  Fingerprint,
  Globe2,
  Heart,
  Layers3,
  Lightbulb,
  Mail,
  MapPin,
  Megaphone,
  Palette,
  Phone,
  Radio,
  Rocket,
  ShieldCheck,
  Sparkles,
  Target,
  TrendingUp,
  UsersRound,
  Zap,
} from 'lucide-vue-next';

defineOptions({ layout: MainLayout });

const contactEmail = 'Contact@kotavacom.com';
const contactPhoneDisplay = '+229 93 37 49 63';
const contactPhoneHref = 'tel:+22993374963';
const location = 'Cotonou, Bénin';

const identityStats = [
  { value: '6', label: 'expertises intégrées', icon: Award },
  { value: '360°', label: 'vision de marque', icon: Globe2 },
  { value: '100%', label: 'engagement projet', icon: Heart },
  { value: 'A+', label: 'exigence créative', icon: BadgeCheck },
];

const dnaPoints = [
  {
    title: 'Direction',
    text: 'Clarifier la vision, le positionnement et les objectifs avant toute création.',
    icon: Compass,
  },
  {
    title: 'Identité',
    text: 'Construire des univers visuels cohérents, reconnaissables et professionnels.',
    icon: Palette,
  },
  {
    title: 'Expérience',
    text: 'Créer des supports, contenus, interfaces et événements pensés pour l’audience.',
    icon: Sparkles,
  },
  {
    title: 'Impact',
    text: 'Déployer des actions visibles, utiles et capables de produire un résultat concret.',
    icon: TrendingUp,
  },
];

const trajectory = [
  {
    number: '01',
    title: 'Comprendre',
    label: 'Contexte, audience, objectifs',
    text: 'Nous commençons par comprendre votre marque, votre marché, votre cible et vos priorités.',
    icon: Lightbulb,
  },
  {
    number: '02',
    title: 'Orienter',
    label: 'Stratégie, angle, message',
    text: 'Nous définissons une direction claire pour éviter les actions dispersées et incohérentes.',
    icon: Target,
  },
  {
    number: '03',
    title: 'Créer',
    label: 'Design, contenu, digital',
    text: 'Nous produisons des supports modernes, propres et adaptés à vos canaux de communication.',
    icon: Layers3,
  },
  {
    number: '04',
    title: 'Amplifier',
    label: 'Diffusion, média, social, suivi',
    text: 'Nous donnons de la portée à vos messages et analysons les résultats pour améliorer.',
    icon: Rocket,
  },
];

const expertiseMap = [
  { title: 'Stratégie', icon: Compass },
  { title: 'Branding', icon: Palette },
  { title: 'Digital', icon: Globe2 },
  { title: 'Audiovisuel', icon: Radio },
  { title: 'Événementiel', icon: Megaphone },
  { title: 'Social Media', icon: UsersRound },
];

const values = [
  {
    title: 'Clarté',
    text: 'Un message fort doit être compris rapidement.',
    icon: Target,
  },
  {
    title: 'Cohérence',
    text: 'Tous les supports doivent parler le même langage.',
    icon: Layers3,
  },
  {
    title: 'Fiabilité',
    text: 'Chaque projet doit avancer avec méthode et précision.',
    icon: ShieldCheck,
  },
  {
    title: 'Créativité utile',
    text: 'Le design doit être beau, mais surtout servir un objectif.',
    icon: Zap,
  },
];

const reasons = [
  {
    title: 'Une vision complète',
    text: 'Nous relions stratégie, identité, contenu, digital et diffusion dans une seule logique.',
    icon: BadgeCheck,
  },
  {
    title: 'Une équipe complémentaire',
    text: 'Les profils créatifs, techniques et stratégiques travaillent ensemble.',
    icon: UsersRound,
  },
  {
    title: 'Une exécution moderne',
    text: 'Chaque livrable est pensé pour les usages actuels : web, social, print, média et événementiel.',
    icon: Rocket,
  },
  {
    title: 'Une proximité client',
    text: 'Nous avançons avec des échanges clairs, un suivi régulier et une vraie implication.',
    icon: Heart,
  },
];

const floatingMarks = [
  'left-[8%] top-[20%] bg-brand-orange',
  'left-[18%] bottom-[22%] bg-brand-emerald',
  'left-[38%] top-[12%] bg-white',
  'right-[12%] top-[22%] bg-brand-orange',
  'right-[18%] bottom-[24%] bg-brand-emerald',
  'left-[58%] bottom-[14%] bg-brand-blue',
  'left-[74%] top-[44%] bg-white',
  'left-[46%] bottom-[36%] bg-brand-orange',
];
</script>

<template>
  <Head title="À propos — KOTAVA Communication">
    <meta
      name="description"
      content="KOTAVA Communication est une agence créative basée à Cotonou, spécialisée en stratégie, branding, digital, audiovisuel, événementiel, relations publiques et social media."
    />
  </Head>

  <main class="relative overflow-hidden bg-brand-dark text-white">
    <!-- HERO ADN -->
    <section class="relative isolate overflow-hidden px-3 pb-14 pt-32 sm:px-4 lg:px-6 lg:pt-36">
      <div class="absolute inset-0 bg-grid-dark opacity-25"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_15%_18%,rgba(249,115,22,0.18),transparent_28%),radial-gradient(circle_at_86%_76%,rgba(16,185,129,0.15),transparent_30%),radial-gradient(circle_at_50%_44%,rgba(30,58,138,0.36),transparent_36%)]"></div>
      <div class="absolute inset-x-0 top-0 h-52 bg-gradient-to-b from-brand-dark via-brand-dark/[0.92] to-transparent"></div>

      <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute left-1/2 top-[10%] hidden -translate-x-1/2 select-none text-[10vw] font-black uppercase leading-none tracking-[-0.12em] text-white/[0.025] lg:block">
          KOTAVA DNA
        </div>

        <div
          v-for="(mark, index) in floatingMarks"
          :key="mark"
          :class="['about-mark absolute h-3 w-2 rounded-[0.35rem]', mark]"
          :style="{ animationDelay: `${index * 170}ms` }"
        ></div>
      </div>

      <div class="site-container relative z-10">
        <div class="grid gap-10 lg:grid-cols-[0.82fr_1.18fr] lg:items-center">
          <div>
            <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-orange backdrop-blur">
              <Fingerprint :size="14" />
              ADN de l’agence
            </div>

            <h1 class="mt-6 max-w-4xl text-5xl font-black leading-[0.88] tracking-[-0.075em] text-white sm:text-6xl lg:text-7xl">
              KOTAVA construit des marques
              <span class="block bg-gradient-to-r from-brand-orange via-white to-brand-emerald bg-clip-text text-transparent">
                claires, visibles et mémorables.
              </span>
            </h1>

            <p class="mt-6 max-w-xl text-base leading-8 text-white/[0.64]">
              Nous sommes une agence de communication basée à Cotonou. Notre rôle est de transformer
              vos idées en identité, contenu, expérience et présence digitale cohérente.
            </p>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
              <Link
                href="/contact"
                class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] bg-brand-orange px-6 py-4 text-sm font-black text-white shadow-orange transition hover:-translate-y-0.5 hover:bg-brand-orange/90"
              >
                Parler de mon projet
                <ArrowRight :size="18" />
              </Link>

              <a
                :href="contactPhoneHref"
                class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] border border-white/10 bg-white/[0.08] px-6 py-4 text-sm font-black text-white transition hover:-translate-y-0.5 hover:bg-white/[0.12]"
              >
                <Phone :size="18" />
                {{ contactPhoneDisplay }}
              </a>
            </div>

            <div class="mt-8 grid grid-cols-2 gap-3 sm:grid-cols-4">
              <div
                v-for="stat in identityStats"
                :key="stat.label"
                class="rounded-[1.35rem] border border-white/10 bg-white/[0.055] p-4 backdrop-blur"
              >
                <component :is="stat.icon" :size="19" class="text-brand-emerald" />

                <div class="mt-3 text-2xl font-black tracking-[-0.055em] text-white">
                  {{ stat.value }}
                </div>

                <div class="text-[11px] font-bold uppercase tracking-[0.12em] text-white/[0.42]">
                  {{ stat.label }}
                </div>
              </div>
            </div>
          </div>

          <!-- Identity map -->
          <div class="relative min-h-[700px]">
            <div class="absolute left-1/2 top-1/2 h-[86%] w-[74%] -translate-x-1/2 -translate-y-1/2 rounded-[6rem] bg-brand-blue/[0.30] blur-3xl"></div>

            <div class="identity-map absolute left-1/2 top-1/2 z-20 w-full max-w-[720px] -translate-x-1/2 -translate-y-1/2 overflow-hidden rounded-[3rem] border border-white/10 bg-white/[0.065] p-5 shadow-[0_45px_150px_rgba(0,0,0,0.42)] backdrop-blur-2xl">
              <div class="relative min-h-[620px] overflow-hidden rounded-[2.4rem] border border-white/10 bg-[#080D15] p-6">
                <div class="absolute inset-0 bg-[linear-gradient(115deg,rgba(255,255,255,0.07)_0,transparent_24%,rgba(249,115,22,0.12)_52%,transparent_78%)]"></div>

                <div class="relative z-10 flex items-start justify-between gap-5 border-b border-white/10 pb-6">
                  <div>
                    <div class="text-[10px] font-black uppercase tracking-[0.22em] text-brand-orange">
                      Carte d’identité
                    </div>

                    <h2 class="mt-3 max-w-lg text-4xl font-black leading-[0.92] tracking-[-0.065em] text-white sm:text-5xl">
                      Une agence pensée comme un système de marque.
                    </h2>
                  </div>

                  <div class="rounded-[1.4rem] bg-white px-5 py-4 text-slate-950">
                    <div class="text-[10px] font-black uppercase tracking-[0.16em] text-slate-400">
                      Vision
                    </div>
                    <div class="mt-1 text-4xl font-black tracking-[-0.08em]">360°</div>
                  </div>
                </div>

                <!-- Compass visual -->
                <div class="relative z-10 mt-8 min-h-[360px]">
                  <div class="absolute left-1/2 top-1/2 h-80 w-80 -translate-x-1/2 -translate-y-1/2 rounded-[3rem] border border-white/10"></div>
                  <div class="absolute left-1/2 top-1/2 h-60 w-60 -translate-x-1/2 -translate-y-1/2 rounded-full border border-dashed border-brand-orange/[0.35]"></div>
                  <div class="dna-orbit absolute left-1/2 top-1/2 h-44 w-44 -translate-x-1/2 -translate-y-1/2 rounded-full border border-brand-emerald/[0.40]"></div>

                  <div class="absolute left-1/2 top-1/2 flex h-32 w-32 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-[2rem] bg-white text-brand-blue shadow-2xl">
                    <Fingerprint :size="52" />
                  </div>

                  <div
                    v-for="(point, index) in dnaPoints"
                    :key="point.title"
                    :class="[
                      'absolute rounded-[1.5rem] border border-white/10 bg-black/[0.50] p-4 backdrop-blur',
                      index === 0 ? 'left-0 top-8' : '',
                      index === 1 ? 'right-0 top-16' : '',
                      index === 2 ? 'bottom-8 left-4' : '',
                      index === 3 ? 'bottom-4 right-4' : ''
                    ]"
                  >
                    <component :is="point.icon" :size="22" class="text-brand-orange" />

                    <div class="mt-4 text-lg font-black tracking-[-0.04em] text-white">
                      {{ point.title }}
                    </div>

                    <p class="mt-2 max-w-[220px] text-xs leading-5 text-white/[0.52]">
                      {{ point.text }}
                    </p>
                  </div>
                </div>

                <div class="relative z-10 mt-6 grid grid-cols-3 gap-3">
                  <div class="rounded-[1.4rem] bg-brand-blue p-4">
                    <div class="text-sm font-black">Stratégie</div>
                  </div>
                  <div class="rounded-[1.4rem] bg-brand-orange p-4">
                    <div class="text-sm font-black">Création</div>
                  </div>
                  <div class="rounded-[1.4rem] bg-brand-emerald p-4">
                    <div class="text-sm font-black">Impact</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="about-note absolute left-0 top-16 hidden rotate-[-7deg] rounded-[1.5rem] bg-white p-5 text-slate-950 shadow-2xl lg:block">
              <MapPin :size="22" class="text-brand-orange" />
              <div class="mt-4 text-xl font-black tracking-[-0.05em]">{{ location }}</div>
              <div class="mt-1 text-xs font-bold uppercase tracking-[0.14em] text-slate-400">Agence créative</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- TRAJECTOIRE -->
    <section class="relative isolate overflow-hidden px-3 py-14 sm:px-4 lg:px-6">
      <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(8,17,31,0.1),rgba(8,17,31,0.78),rgba(8,17,31,0.1))]"></div>

      <div class="site-container relative z-10">
        <div class="mb-8 grid gap-6 lg:grid-cols-[0.48fr_1.52fr] lg:items-end">
          <div>
            <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-orange">
              <Rocket :size="15" />
              Notre méthode
            </div>

            <h2 class="mt-5 text-4xl font-black leading-[0.95] tracking-[-0.06em] text-white sm:text-5xl">
              De l’idée
              <span class="block text-brand-orange">à la présence forte.</span>
            </h2>
          </div>

          <p class="max-w-2xl text-sm leading-7 text-white/[0.55]">
            Une marque ne devient pas visible par hasard. Elle se construit avec une direction,
            une identité, des supports et une diffusion cohérente.
          </p>
        </div>

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
          <div
            v-for="step in trajectory"
            :key="step.title"
            class="group relative min-h-80 overflow-hidden rounded-[2.2rem] border border-white/10 bg-white/[0.055] p-5 backdrop-blur-xl transition hover:-translate-y-1 hover:bg-white/[0.09]"
          >
            <div class="absolute -right-16 -top-16 h-48 w-48 rounded-[3rem] bg-brand-orange/[0.14] blur-3xl transition group-hover:scale-125"></div>

            <div class="relative">
              <div class="flex items-start justify-between gap-5">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-brand-blue">
                  <component :is="step.icon" :size="24" />
                </div>

                <div class="text-6xl font-black tracking-[-0.1em] text-white/[0.10]">
                  {{ step.number }}
                </div>
              </div>

              <div class="mt-16 text-[10px] font-black uppercase tracking-[0.18em] text-brand-orange">
                {{ step.label }}
              </div>

              <h3 class="mt-3 text-2xl font-black tracking-[-0.05em] text-white">
                {{ step.title }}
              </h3>

              <p class="mt-3 text-sm leading-7 text-white/[0.55]">
                {{ step.text }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- EXPERTISE MAP -->
    <section class="relative isolate overflow-hidden px-3 py-14 sm:px-4 lg:px-6">
      <div class="site-container relative z-10">
        <div class="relative overflow-hidden rounded-[2.8rem] border border-white/10 bg-white/[0.065] p-6 backdrop-blur-2xl sm:p-8">
          <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_18%,rgba(249,115,22,0.16),transparent_30%),radial-gradient(circle_at_86%_80%,rgba(16,185,129,0.14),transparent_32%)]"></div>

          <div class="relative grid gap-8 lg:grid-cols-[0.78fr_1.22fr] lg:items-center">
            <div>
              <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-orange">
                <Layers3 :size="14" />
                Pôles intégrés
              </div>

              <h2 class="mt-5 text-4xl font-black leading-[0.95] tracking-[-0.06em] text-white sm:text-5xl">
                Six expertises.
                <span class="block bg-gradient-to-r from-brand-orange via-white to-brand-emerald bg-clip-text text-transparent">
                  Une seule direction.
                </span>
              </h2>

              <p class="mt-5 max-w-xl text-sm leading-7 text-white/[0.60]">
                KOTAVA agit comme un atelier complet : stratégie, identité, digital, contenu,
                événementiel et social media avancent ensemble.
              </p>
            </div>

            <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
              <div
                v-for="(item, index) in expertiseMap"
                :key="item.title"
                class="rounded-[1.7rem] border border-white/10 bg-black/[0.35] p-5"
              >
                <div
                  :class="[
                    'flex h-12 w-12 items-center justify-center rounded-2xl text-white',
                    index % 3 === 0 ? 'bg-brand-blue' : index % 3 === 1 ? 'bg-brand-orange' : 'bg-brand-emerald'
                  ]"
                >
                  <component :is="item.icon" :size="22" />
                </div>

                <div class="mt-14 text-xl font-black tracking-[-0.045em] text-white">
                  {{ item.title }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- VALEURS + RAISONS -->
    <section class="relative isolate overflow-hidden px-3 py-14 sm:px-4 lg:px-6">
      <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(8,17,31,0.1),rgba(8,17,31,0.78),rgba(8,17,31,0.1))]"></div>

      <div class="site-container relative z-10">
        <div class="grid gap-5 lg:grid-cols-[0.95fr_1.05fr]">
          <div class="relative overflow-hidden rounded-[2.8rem] border border-white/10 bg-white/[0.06] p-6 backdrop-blur-2xl">
            <div class="absolute -right-24 -top-24 h-80 w-80 rounded-[5rem] bg-brand-orange/[0.16] blur-3xl"></div>

            <div class="relative">
              <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-orange">
                <Heart :size="14" />
                Valeurs
              </div>

              <h2 class="mt-5 text-4xl font-black leading-[0.95] tracking-[-0.06em] text-white">
                Ce qui guide
                <span class="block text-brand-orange">notre exigence.</span>
              </h2>

              <div class="mt-8 grid gap-3 sm:grid-cols-2">
                <div
                  v-for="value in values"
                  :key="value.title"
                  class="rounded-[1.6rem] border border-white/10 bg-black/[0.35] p-4"
                >
                  <component :is="value.icon" :size="23" class="text-brand-orange" />

                  <h3 class="mt-10 text-xl font-black text-white">
                    {{ value.title }}
                  </h3>

                  <p class="mt-2 text-sm leading-6 text-white/[0.52]">
                    {{ value.text }}
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="relative overflow-hidden rounded-[2.8rem] border border-white/10 bg-white/[0.06] p-6 backdrop-blur-2xl">
            <div class="absolute -bottom-24 -right-20 h-80 w-80 rounded-[4rem] bg-brand-emerald/[0.14] blur-3xl"></div>

            <div class="relative">
              <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald">
                <CheckCircle2 :size="14" />
                Pourquoi KOTAVA
              </div>

              <div class="mt-6 space-y-3">
                <div
                  v-for="reason in reasons"
                  :key="reason.title"
                  class="rounded-[1.6rem] border border-white/10 bg-black/[0.35] p-4"
                >
                  <div class="flex items-start gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white text-brand-blue">
                      <component :is="reason.icon" :size="21" />
                    </div>

                    <div>
                      <h3 class="text-base font-black text-white">
                        {{ reason.title }}
                      </h3>

                      <p class="mt-1 text-sm leading-6 text-white/[0.52]">
                        {{ reason.text }}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- CTA -->
          <div class="relative overflow-hidden rounded-[2.8rem] border border-white/10 bg-white/[0.065] p-6 backdrop-blur-2xl lg:col-span-2 sm:p-8">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_18%,rgba(249,115,22,0.16),transparent_30%),radial-gradient(circle_at_86%_80%,rgba(16,185,129,0.14),transparent_32%)]"></div>

            <div class="relative grid gap-8 lg:grid-cols-[0.88fr_1.12fr] lg:items-center">
              <div>
                <div class="flex h-16 w-16 items-center justify-center rounded-[1.4rem] bg-brand-orange text-white shadow-orange">
                  <Sparkles :size="28" />
                </div>

                <h2 class="mt-6 text-4xl font-black leading-[0.95] tracking-[-0.06em] text-white sm:text-5xl">
                  Transformons vos idées
                  <span class="block bg-gradient-to-r from-brand-orange via-white to-brand-emerald bg-clip-text text-transparent">
                    en présence forte.
                  </span>
                </h2>

                <p class="mt-4 max-w-xl text-sm leading-7 text-white/[0.60]">
                  Discutons de votre marque, de votre projet ou de votre campagne.
                  Notre équipe vous aide à construire une communication plus claire, plus visible et plus impactante.
                </p>
              </div>

              <div class="grid gap-3">
                <Link
                  href="/contact"
                  class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] bg-brand-orange px-6 py-4 text-sm font-black text-white shadow-orange transition hover:-translate-y-0.5 hover:bg-brand-orange/90"
                >
                  Obtenir une proposition
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

                <div class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] border border-white/10 bg-white/[0.05] px-6 py-4 text-sm font-black text-white/[0.65]">
                  <MapPin :size="18" />
                  {{ location }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<style scoped>
@keyframes aboutMark {
  0%, 100% {
    transform: translate3d(0, 0, 0) rotate(0deg);
    opacity: 0.28;
  }

  50% {
    transform: translate3d(18px, -24px, 0) rotate(18deg);
    opacity: 0.85;
  }
}

@keyframes identityMap {
  0%, 100% {
    transform: translate(-50%, -50%) rotate(-0.7deg);
  }

  50% {
    transform: translate(-50%, calc(-50% - 10px)) rotate(0.7deg);
  }
}

@keyframes dnaOrbit {
  0% {
    transform: translate(-50%, -50%) rotate(0deg) scale(1);
  }

  50% {
    transform: translate(-50%, -50%) rotate(180deg) scale(1.08);
  }

  100% {
    transform: translate(-50%, -50%) rotate(360deg) scale(1);
  }
}

@keyframes aboutNote {
  0%, 100% {
    transform: translateY(0) rotate(-7deg);
  }

  50% {
    transform: translateY(-14px) rotate(-3deg);
  }
}

.about-mark {
  animation: aboutMark 7s ease-in-out infinite;
}

.identity-map {
  animation: identityMap 7s ease-in-out infinite;
}

.dna-orbit {
  animation: dnaOrbit 18s linear infinite;
}

.about-note {
  animation: aboutNote 6s ease-in-out infinite;
}
</style>