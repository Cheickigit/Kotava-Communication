<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/GuestLayout.vue';
import {
  ArrowLeft,
  ArrowRight,
  BadgeCheck,
  Brush,
  CheckCircle2,
  Eye,
  FileText,
  Image as ImageIcon,
  Layers3,
  Mail,
  Package,
  Palette,
  PenTool,
  Phone,
  Sparkles,
  Type,
  Wand2,
  Zap,
} from 'lucide-vue-next';

defineOptions({ layout: MainLayout });

const contactEmail = 'Contact@kotavacom.com';
const contactPhoneDisplay = '+229 93 37 49 63';
const contactPhoneHref = 'tel:+22993374963';

const activeIndex = ref(0);
let intervalId = null;

const signatures = [
  {
    number: '01',
    title: 'Signe',
    label: 'Logo, symbole, variantes',
    display: 'K',
    caption: 'Une marque doit être identifiable même sans explication.',
    icon: PenTool,
    accent: 'text-brand-orange',
    bg: 'bg-brand-orange',
    glow: 'bg-brand-orange/25',
    items: ['Logo principal', 'Monogramme', 'Déclinaisons', 'Zone de protection'],
  },
  {
    number: '02',
    title: 'Couleur',
    label: 'Palette, contraste, émotion',
    display: 'RGB',
    caption: 'La couleur donne une mémoire visuelle à votre marque.',
    icon: Palette,
    accent: 'text-brand-emerald',
    bg: 'bg-brand-emerald',
    glow: 'bg-brand-emerald/25',
    items: ['Palette primaire', 'Secondaires', 'Contrastes', 'Codes couleur'],
  },
  {
    number: '03',
    title: 'Typographie',
    label: 'Hiérarchie, rythme, personnalité',
    display: 'Aa',
    caption: 'La typographie rend votre message reconnaissable.',
    icon: Type,
    accent: 'text-white',
    bg: 'bg-brand-blue',
    glow: 'bg-brand-blue/25',
    items: ['Titres', 'Textes', 'Accents', 'Règles d’usage'],
  },
  {
    number: '04',
    title: 'Univers',
    label: 'Supports, formes, assets',
    display: 'KIT',
    caption: 'Une identité forte doit rester cohérente sur tous les supports.',
    icon: Layers3,
    accent: 'text-brand-orange',
    bg: 'bg-white',
    glow: 'bg-white/20',
    items: ['Templates', 'Social media', 'Print', 'Assets visuels'],
  },
  {
    number: '05',
    title: 'Mouvement',
    label: 'Animation, transition, présence',
    display: '↗',
    caption: 'Le mouvement rend l’identité plus vivante et mémorable.',
    icon: Zap,
    accent: 'text-brand-emerald',
    bg: 'bg-brand-emerald',
    glow: 'bg-brand-emerald/25',
    items: ['Logo animé', 'Transitions', 'Lottie', 'Formats courts'],
  },
];

const atelier = [
  {
    title: 'Logo signature',
    note: 'Créer le signe qui porte la marque.',
    icon: PenTool,
    index: '01',
    tags: ['Symbole', 'Versions', 'Icône', 'Vectoriel'],
  },
  {
    title: 'Système graphique',
    note: 'Construire les couleurs, formes et règles.',
    icon: Palette,
    index: '02',
    tags: ['Palette', 'Formes', 'Grille', 'Contrastes'],
  },
  {
    title: 'Expression visuelle',
    note: 'Déployer l’identité sur les supports utiles.',
    icon: ImageIcon,
    index: '03',
    tags: ['Print', 'Social', 'Digital', 'Templates'],
  },
  {
    title: 'Brand book',
    note: 'Documenter l’identité pour garder la cohérence.',
    icon: FileText,
    index: '04',
    tags: ['Règles', 'Usages', 'Interdits', 'Formats'],
  },
];

const assets = [
  { title: 'SVG', label: 'vectoriel' },
  { title: 'PNG', label: 'digital' },
  { title: 'PDF', label: 'print' },
  { title: 'Brand book', label: 'guide' },
  { title: 'Templates', label: 'supports' },
  { title: 'Motion', label: 'animation' },
];

const process = [
  {
    title: 'Observer',
    text: 'Comprendre l’univers, les références et la perception actuelle.',
    icon: Eye,
  },
  {
    title: 'Signer',
    text: 'Créer une direction visuelle forte et immédiatement reconnaissable.',
    icon: Brush,
  },
  {
    title: 'Systématiser',
    text: 'Transformer le design en règles, formats et supports réutilisables.',
    icon: Wand2,
  },
  {
    title: 'Livrer',
    text: 'Préparer les fichiers finaux, propres, organisés et prêts à l’usage.',
    icon: Package,
  },
];

const activeSignature = computed(() => signatures[activeIndex.value] || signatures[0]);

const setActive = (index) => {
  activeIndex.value = index;
};

onMounted(() => {
  intervalId = window.setInterval(() => {
    activeIndex.value = (activeIndex.value + 1) % signatures.length;
  }, 2600);
});

onUnmounted(() => {
  if (intervalId) {
    window.clearInterval(intervalId);
  }
});
</script>

<template>
  <Head title="Branding & Design — KOTAVA Communication">
    <meta
      name="description"
      content="KOTAVA Communication crée des identités visuelles premium : logo, charte graphique, brand book, supports print, templates digitaux, assets visuels et motion branding."
    />
  </Head>

  <main class="relative overflow-hidden bg-brand-dark text-white">
    <!-- HERO SIGNATURE -->
    <section class="relative isolate overflow-hidden pb-12 pt-32 sm:pb-16 lg:pt-36">
      <div class="absolute inset-0 bg-grid-dark opacity-20"></div>

      <div class="absolute inset-0 bg-[radial-gradient(circle_at_12%_20%,rgba(249,115,22,0.22),transparent_27%),radial-gradient(circle_at_88%_74%,rgba(16,185,129,0.16),transparent_30%),radial-gradient(circle_at_50%_42%,rgba(30,58,138,0.36),transparent_34%)]"></div>

      <div class="absolute inset-x-0 top-0 h-52 bg-gradient-to-b from-brand-dark via-brand-dark/90 to-transparent"></div>

      <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute left-1/2 top-[12%] hidden -translate-x-1/2 select-none text-[10vw] font-black uppercase leading-none tracking-[-0.12em] text-white/[0.025] lg:block">
          SIGNATURE
        </div>

        <div class="brand-line absolute left-[7%] top-[28%] h-36 w-5 rotate-[22deg] rounded-full bg-brand-orange/35 blur-[1px]"></div>
        <div class="brand-line animation-delay-700 absolute right-[10%] top-[22%] h-44 w-5 -rotate-[18deg] rounded-full bg-brand-emerald/30 blur-[1px]"></div>
        <div class="brand-line animation-delay-1200 absolute bottom-[18%] left-[20%] h-32 w-5 rotate-[48deg] rounded-full bg-brand-blue/35 blur-[1px]"></div>

        <div class="absolute -left-32 top-52 h-80 w-80 rounded-[5rem] border border-white/[0.05] brand-frame"></div>
        <div class="absolute -right-28 bottom-24 h-96 w-96 rounded-full border border-brand-orange/10 brand-frame-reverse"></div>
      </div>

      <div class="site-container relative z-10">
        <Link
          href="/services"
          class="mb-7 inline-flex items-center gap-2 text-sm font-black text-white/[0.62] transition hover:-translate-x-1 hover:text-brand-orange"
        >
          <ArrowLeft :size="18" />
          Retour aux services
        </Link>

        <div class="grid gap-10 lg:grid-cols-[0.76fr_1.24fr] lg:items-center">
          <div>
            <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-orange backdrop-blur">
              <Palette :size="14" />
              Brand Signature Design
            </div>

            <h1 class="mt-6 max-w-4xl text-5xl font-black leading-[0.9] tracking-[-0.07em] text-white sm:text-6xl lg:text-7xl">
              Une marque doit avoir
              <span class="block bg-gradient-to-r from-brand-orange via-white to-brand-emerald bg-clip-text text-transparent">
                une signature impossible à confondre.
              </span>
            </h1>

            <p class="mt-6 max-w-xl text-base leading-8 text-white/[0.64]">
              Nous construisons des identités visuelles distinctives : logo, système graphique,
              typographie, couleurs, supports et fichiers prêts à l’usage.
            </p>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
              <Link
                href="/contact"
                class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] bg-brand-orange px-6 py-4 text-sm font-black text-white shadow-orange transition hover:-translate-y-0.5 hover:bg-brand-orange/90"
              >
                Créer mon identité
                <ArrowRight :size="18" />
              </Link>

              <a
                :href="contactPhoneHref"
                class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] border border-white/10 bg-white/[0.08] px-6 py-4 text-sm font-black text-white transition hover:-translate-y-0.5 hover:bg-white/[0.12]"
              >
                <Phone :size="18" />
                Audit branding
              </a>
            </div>
          </div>

          <!-- Signature composition -->
          <div class="relative">
            <div
              :class="[
                'absolute left-1/2 top-1/2 h-[110%] w-[80%] -translate-x-1/2 -translate-y-1/2 rounded-[6rem] blur-3xl transition duration-700',
                activeSignature.glow
              ]"
            ></div>

            <div class="brand-signature relative overflow-hidden rounded-[3.2rem] border border-white/10 bg-white/[0.055] p-4 shadow-[0_40px_130px_rgba(0,0,0,0.36)] backdrop-blur-2xl sm:p-5">
              <div class="relative min-h-[610px] overflow-hidden rounded-[2.6rem] border border-white/10 bg-slate-950/72 p-6">
                <div class="absolute inset-0 bg-[linear-gradient(115deg,rgba(255,255,255,0.06)_0,transparent_24%,rgba(249,115,22,0.13)_48%,transparent_76%)]"></div>

                <!-- Central sculpture -->
                <div class="absolute left-1/2 top-1/2 z-10 flex h-80 w-80 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-[4.6rem] border border-white/10 bg-brand-dark shadow-2xl">
                  <div class="brand-rotate absolute h-64 w-64 rounded-[4rem] border border-dashed border-brand-orange/30"></div>
                  <div class="absolute h-44 w-44 rounded-full border border-brand-emerald/25"></div>
                  <div class="absolute h-28 w-28 rounded-[2rem] border border-white/10"></div>

                  <div class="relative text-center">
                    <div
                      :class="[
                        'text-8xl font-black leading-none tracking-[-0.12em]',
                        activeSignature.accent
                      ]"
                    >
                      {{ activeSignature.display }}
                    </div>

                    <div class="mt-3 text-[10px] font-black uppercase tracking-[0.24em] text-white/[0.35]">
                      Brand mark
                    </div>
                  </div>
                </div>

                <!-- Floating signature panels -->
                <button
                  v-for="(item, index) in signatures"
                  :key="item.title"
                  type="button"
                  :class="[
                    'absolute z-20 w-48 rounded-[1.6rem] border p-4 text-left shadow-2xl transition duration-300',
                    index === 0 ? 'left-5 top-6' : '',
                    index === 1 ? 'right-5 top-24' : '',
                    index === 2 ? 'left-7 bottom-24' : '',
                    index === 3 ? 'right-8 bottom-8' : '',
                    index === 4 ? 'left-1/2 top-8 -translate-x-1/2' : '',
                    activeIndex === index
                      ? 'border-brand-orange/50 bg-white text-slate-950'
                      : 'border-white/10 bg-white/[0.075] text-white backdrop-blur hover:bg-white/[0.14]'
                  ]"
                  @click="setActive(index)"
                >
                  <div class="flex items-center justify-between gap-3">
                    <div
                      :class="[
                        'flex h-11 w-11 items-center justify-center rounded-2xl',
                        item.bg,
                        item.bg === 'bg-white' ? 'text-brand-blue' : 'text-white'
                      ]"
                    >
                      <component :is="item.icon" :size="21" />
                    </div>

                    <span
                      :class="[
                        'text-xs font-black',
                        activeIndex === index ? 'text-slate-400' : 'text-white/[0.40]'
                      ]"
                    >
                      {{ item.number }}
                    </span>
                  </div>

                  <div class="mt-4 text-lg font-black tracking-[-0.04em]">
                    {{ item.title }}
                  </div>

                  <div
                    :class="[
                      'mt-1 text-xs font-bold',
                      activeIndex === index ? 'text-slate-500' : 'text-white/[0.48]'
                    ]"
                  >
                    {{ item.label }}
                  </div>
                </button>

                <!-- Bottom caption -->
                <div class="absolute inset-x-5 bottom-5 z-30 rounded-[1.6rem] border border-white/10 bg-brand-dark/82 p-5 backdrop-blur">
                  <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                      <div class="text-[10px] font-black uppercase tracking-[0.2em] text-brand-orange">
                        Signature active
                      </div>

                      <h3 class="mt-2 text-3xl font-black tracking-[-0.055em] text-white">
                        {{ activeSignature.title }}
                      </h3>

                      <p class="mt-1 max-w-lg text-sm leading-6 text-white/[0.56]">
                        {{ activeSignature.caption }}
                      </p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                      <span
                        v-for="item in activeSignature.items"
                        :key="item"
                        class="rounded-xl border border-white/10 bg-white/[0.07] px-3 py-2 text-[10px] font-black uppercase tracking-[0.12em] text-white/[0.55]"
                      >
                        {{ item }}
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="absolute -left-5 top-12 hidden rotate-[-7deg] rounded-[1.3rem] bg-white px-5 py-4 text-slate-950 shadow-2xl lg:block">
              <Sparkles :size="19" class="text-brand-orange" />
              <div class="mt-2 text-sm font-black">Design original</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- EDITORIAL STRIPS -->
    <section class="relative isolate overflow-hidden py-12 sm:py-14 lg:py-16">
      <div class="absolute inset-0 bg-grid-dark opacity-15"></div>

      <div class="site-container relative z-10">
        <div class="mb-9 max-w-4xl">
          <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-orange">
            <Brush :size="15" />
            Design layers
          </div>

          <h2 class="mt-4 text-4xl font-black leading-[0.95] tracking-[-0.06em] sm:text-5xl">
            Une identité premium se construit
            <span class="block text-brand-orange">par couches visuelles.</span>
          </h2>
        </div>

        <div class="space-y-4">
          <div
            v-for="item in atelier"
            :key="item.title"
            class="group relative overflow-hidden rounded-[2.2rem] border border-white/10 bg-white/[0.055] p-4 backdrop-blur-xl transition duration-300 hover:bg-white/[0.09]"
          >
            <div class="absolute inset-y-0 left-0 w-1 bg-brand-orange opacity-0 transition group-hover:opacity-100"></div>

            <div class="grid gap-5 lg:grid-cols-[0.16fr_0.34fr_0.5fr] lg:items-center">
              <div class="flex items-center gap-4">
                <div class="text-6xl font-black tracking-[-0.1em] text-white/[0.12]">
                  {{ item.index }}
                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-brand-blue">
                  <component :is="item.icon" :size="24" />
                </div>
              </div>

              <div>
                <h3 class="text-2xl font-black tracking-[-0.045em] text-white">
                  {{ item.title }}
                </h3>

                <p class="mt-1 text-sm font-bold text-brand-orange">
                  {{ item.note }}
                </p>
              </div>

              <div class="flex flex-wrap gap-2">
                <span
                  v-for="tag in item.tags"
                  :key="tag"
                  class="inline-flex items-center gap-1.5 rounded-xl border border-white/10 bg-white/[0.07] px-3 py-2 text-[10px] font-black uppercase tracking-[0.12em] text-white/[0.55]"
                >
                  <CheckCircle2 :size="13" class="text-brand-emerald" />
                  {{ tag }}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- VISUAL SYSTEM -->
    <section class="relative isolate overflow-hidden py-12 sm:py-14 lg:py-16">
      <div class="site-container relative z-10">
        <div class="grid gap-5 lg:grid-cols-[1.15fr_0.85fr]">
          <div class="relative overflow-hidden rounded-[2.8rem] border border-white/10 bg-white/[0.06] p-6 backdrop-blur-2xl">
            <div class="absolute -right-24 -top-24 h-80 w-80 rounded-[5rem] bg-brand-orange/15 blur-3xl"></div>

            <div class="relative">
              <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                <div>
                  <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald">
                    <Wand2 :size="14" />
                    Visual language
                  </div>

                  <h2 class="mt-5 max-w-2xl text-4xl font-black leading-[0.95] tracking-[-0.06em] text-white">
                    Le style doit être
                    <span class="block text-brand-orange">visible sans lire le logo.</span>
                  </h2>
                </div>

                <div class="rounded-[1.5rem] bg-white px-5 py-4 text-slate-950">
                  <div class="text-xs font-black uppercase tracking-[0.14em] text-slate-400">
                    Cohérence
                  </div>
                  <div class="mt-1 text-4xl font-black tracking-[-0.07em]">A+</div>
                </div>
              </div>

              <div class="mt-8 grid gap-4 sm:grid-cols-3">
                <div class="group min-h-72 overflow-hidden rounded-[2.2rem] bg-brand-blue p-5">
                  <div class="text-sm font-black text-white">Confiance</div>
                  <div class="mt-36 text-6xl font-black tracking-[-0.1em] text-white/20">01</div>
                </div>

                <div class="group min-h-72 overflow-hidden rounded-[2.2rem] bg-brand-emerald p-5">
                  <div class="text-sm font-black text-white">Élan</div>
                  <div class="mt-36 text-6xl font-black tracking-[-0.1em] text-white/20">02</div>
                </div>

                <div class="group min-h-72 overflow-hidden rounded-[2.2rem] bg-brand-orange p-5">
                  <div class="text-sm font-black text-white">Impact</div>
                  <div class="mt-36 text-6xl font-black tracking-[-0.1em] text-white/25">03</div>
                </div>
              </div>
            </div>
          </div>

          <div class="relative overflow-hidden rounded-[2.8rem] border border-white/10 bg-white/[0.06] p-6 backdrop-blur-2xl">
            <div class="absolute -bottom-24 -right-20 h-80 w-80 rounded-[4rem] bg-brand-emerald/15 blur-3xl"></div>

            <div class="relative">
              <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald">
                <Layers3 :size="14" />
                Méthode studio
              </div>

              <div class="mt-6 space-y-3">
                <div
                  v-for="(step, index) in process"
                  :key="step.title"
                  class="rounded-[1.6rem] border border-white/10 bg-slate-950/40 p-4"
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

          <!-- Assets + CTA -->
          <div class="relative overflow-hidden rounded-[2.8rem] border border-white/10 bg-white/[0.065] p-6 backdrop-blur-2xl lg:col-span-2 sm:p-8">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_18%,rgba(249,115,22,0.16),transparent_30%),radial-gradient(circle_at_86%_80%,rgba(16,185,129,0.14),transparent_32%)]"></div>

            <div class="relative grid gap-7 lg:grid-cols-[0.9fr_1.1fr] lg:items-center">
              <div>
                <div class="flex h-16 w-16 items-center justify-center rounded-[1.4rem] bg-brand-orange text-white shadow-orange">
                  <Package :size="28" />
                </div>

                <h2 class="mt-6 text-4xl font-black leading-[0.95] tracking-[-0.06em] text-white sm:text-5xl">
                  Un brand kit propre,
                  <span class="block bg-gradient-to-r from-brand-orange via-white to-brand-emerald bg-clip-text text-transparent">
                    complet et prêt à utiliser.
                  </span>
                </h2>

                <p class="mt-4 max-w-xl text-sm leading-7 text-white/[0.60]">
                  Fichiers, règles, formats, supports et éléments visuels livrés de manière claire.
                </p>
              </div>

              <div>
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
                  <div
                    v-for="asset in assets"
                    :key="asset.title"
                    class="rounded-[1.5rem] border border-white/10 bg-slate-950/45 p-4"
                  >
                    <BadgeCheck :size="19" class="text-brand-emerald" />

                    <div class="mt-5 text-lg font-black text-white">
                      {{ asset.title }}
                    </div>

                    <div class="mt-1 text-xs font-bold uppercase tracking-[0.12em] text-white/[0.40]">
                      {{ asset.label }}
                    </div>
                  </div>
                </div>

                <div class="mt-5 grid gap-3 sm:grid-cols-3">
                  <Link
                    href="/contact"
                    class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] bg-brand-orange px-5 py-4 text-sm font-black text-white shadow-orange transition hover:-translate-y-0.5 hover:bg-brand-orange/90 sm:col-span-3"
                  >
                    Demander un devis branding
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
        </div>
      </div>
    </section>
  </main>
</template>

<style scoped>
@keyframes brandSignature {
  0%, 100% {
    transform: translateY(0) rotate(0deg);
  }

  50% {
    transform: translateY(-10px) rotate(0.16deg);
  }
}

@keyframes brandRotate {
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

@keyframes brandLine {
  0%, 100% {
    transform: translateY(0) rotate(var(--tw-rotate));
    opacity: 0.25;
  }

  50% {
    transform: translateY(-18px) rotate(var(--tw-rotate));
    opacity: 0.75;
  }
}

@keyframes brandFrame {
  0%, 100% {
    transform: rotate(0deg) translateY(0);
  }

  50% {
    transform: rotate(7deg) translateY(-12px);
  }
}

@keyframes brandFrameReverse {
  0%, 100% {
    transform: rotate(0deg) translateY(0);
  }

  50% {
    transform: rotate(-7deg) translateY(12px);
  }
}

.brand-signature {
  animation: brandSignature 7s ease-in-out infinite;
}

.brand-rotate {
  animation: brandRotate 18s linear infinite;
}

.brand-line {
  animation: brandLine 7s ease-in-out infinite;
}

.brand-frame {
  animation: brandFrame 9s ease-in-out infinite;
}

.brand-frame-reverse {
  animation: brandFrameReverse 10s ease-in-out infinite;
}

.animation-delay-700 {
  animation-delay: 700ms;
}

.animation-delay-1200 {
  animation-delay: 1200ms;
}
</style>