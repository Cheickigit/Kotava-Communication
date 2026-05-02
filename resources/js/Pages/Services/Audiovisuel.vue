<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/GuestLayout.vue';
import {
  Aperture,
  ArrowLeft,
  ArrowRight,
  BadgeCheck,
  Camera,
  Clapperboard,
  Clock3,
  Eye,
  Film,
  Mail,
  Mic,
  Music,
  Package,
  Phone,
  Play,
  Radio,
  Scissors,
  Send,
  Sparkles,
  Video,
  Wand2,
  Zap,
} from 'lucide-vue-next';

defineOptions({ layout: MainLayout });

const contactEmail = 'Contact@kotavacom.com';
const contactPhoneDisplay = '+229 93 37 49 63';
const contactPhoneHref = 'tel:+22993374963';

const activeIndex = ref(0);
let intervalId = null;

const scenes = [
  {
    code: 'SCN-01',
    title: 'Film corporate',
    label: 'Interview · reportage · institutionnel',
    format: '16:9',
    visual: 'film',
    icon: Film,
    accent: 'bg-brand-orange',
    text: 'Une narration claire pour présenter votre entreprise, vos valeurs et vos projets.',
    tags: ['Script', 'Tournage', 'Montage', 'Étalonnage'],
  },
  {
    code: 'SCN-02',
    title: 'Motion design',
    label: 'Animation · habillage · vidéo explicative',
    format: '2D/3D',
    visual: 'motion',
    icon: Wand2,
    accent: 'bg-brand-emerald',
    text: 'Des animations dynamiques pour expliquer, simplifier et rendre vos messages mémorables.',
    tags: ['Storyboard', 'Animation', 'Sound design', 'Export'],
  },
  {
    code: 'SCN-03',
    title: 'Photo professionnelle',
    label: 'Portrait · produit · événement',
    format: 'RAW',
    visual: 'photo',
    icon: Camera,
    accent: 'bg-brand-blue',
    text: 'Des images propres, expressives et adaptées à vos supports de communication.',
    tags: ['Studio', 'Reportage', 'Retouche', 'Pack photo'],
  },
  {
    code: 'SCN-04',
    title: 'Podcast & son',
    label: 'Voix · mixage · identité sonore',
    format: 'WAV',
    visual: 'audio',
    icon: Mic,
    accent: 'bg-brand-orange',
    text: 'Un son net, maîtrisé et professionnel pour vos podcasts, voix-off et contenus audio.',
    tags: ['Voix-off', 'Podcast', 'Mixage', 'Mastering'],
  },
  {
    code: 'SCN-05',
    title: 'Drone & plans aériens',
    label: 'Vues aériennes · plans cinématiques',
    format: '4K',
    visual: 'drone',
    icon: Aperture,
    accent: 'bg-brand-emerald',
    text: 'Des plans larges, spectaculaires et immersifs pour donner de la hauteur à vos productions.',
    tags: ['Aérien', 'Tracking', 'Paysage', 'Promo'],
  },
  {
    code: 'SCN-06',
    title: 'Live streaming',
    label: 'Régie · multicam · diffusion',
    format: 'LIVE',
    visual: 'live',
    icon: Radio,
    accent: 'bg-brand-blue',
    text: 'Des directs propres, fluides et professionnels pour vos événements et webinaires.',
    tags: ['Multicam', 'Régie', 'Replay', 'Webinaire'],
  },
];

const productionSteps = [
  {
    title: 'Pré-prod',
    label: 'Idée, script, découpage',
    icon: Clapperboard,
  },
  {
    title: 'Plateau',
    label: 'Image, lumière, son',
    icon: Video,
  },
  {
    title: 'Montage',
    label: 'Rythme, coupe, étalonnage',
    icon: Scissors,
  },
  {
    title: 'Diffusion',
    label: 'Formats, exports, publication',
    icon: Send,
  },
];

const gear = [
  { title: 'Caméra', label: '4K / 6K', icon: Video },
  { title: 'Lumière', label: 'studio / terrain', icon: Aperture },
  { title: 'Audio', label: 'voix claire', icon: Mic },
  { title: 'Live', label: 'régie multicam', icon: Radio },
];

const deliverables = [
  { title: 'Film principal', label: 'version longue' },
  { title: 'Shorts / Reels', label: 'réseaux sociaux' },
  { title: 'Photos', label: 'pack image' },
  { title: 'Audio', label: 'voix / podcast' },
  { title: 'Miniatures', label: 'visuels vidéo' },
  { title: 'Exports', label: 'formats livrés' },
];

const floatingDots = [
  'left-[8%] top-[22%]',
  'left-[17%] bottom-[24%]',
  'left-[42%] top-[15%]',
  'right-[12%] top-[25%]',
  'right-[8%] bottom-[28%]',
  'left-[60%] bottom-[14%]',
];

const activeScene = computed(() => scenes[activeIndex.value] || scenes[0]);

const setActive = (index) => {
  activeIndex.value = index;
};

onMounted(() => {
  intervalId = window.setInterval(() => {
    activeIndex.value = (activeIndex.value + 1) % scenes.length;
  }, 3000);
});

onUnmounted(() => {
  if (intervalId) {
    window.clearInterval(intervalId);
  }
});
</script>

<template>
  <Head title="Production Audiovisuelle — KOTAVA Communication">
    <meta
      name="description"
      content="KOTAVA Communication réalise des films corporate, vidéos social media, motion design, photographie professionnelle, podcast, drone, live streaming et productions audiovisuelles."
    />
  </Head>

  <main class="relative overflow-hidden bg-[#05070B] text-white">
    <!-- CINEMA POSTER HERO -->
    <section class="relative isolate min-h-screen overflow-hidden px-3 pb-8 pt-28 sm:px-4 lg:px-6 lg:pt-32">
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(249,115,22,0.18),transparent_28%),radial-gradient(circle_at_84%_76%,rgba(16,185,129,0.13),transparent_30%),linear-gradient(180deg,#05070B_0%,#08111F_48%,#05070B_100%)]"></div>

      <div class="film-noise absolute inset-0 opacity-[0.08]"></div>
      <div class="projector-beam absolute left-1/2 top-0 h-[78%] w-[62%] -translate-x-1/2 bg-gradient-to-b from-white/[0.10] via-white/[0.025] to-transparent blur-2xl"></div>

      <div
        v-for="dot in floatingDots"
        :key="dot"
        :class="['cinema-particle absolute h-1.5 w-1.5 rounded-[999px] bg-white/[0.30]', dot]"
      ></div>

      <div class="site-container relative z-10">
        <Link
          href="/services"
          class="mb-6 inline-flex items-center gap-2 text-sm font-black text-white/[0.62] transition hover:-translate-x-1 hover:text-brand-orange"
        >
          <ArrowLeft :size="18" />
          Retour aux services
        </Link>

        <div class="grid gap-5 lg:grid-cols-[0.16fr_1.44fr_0.40fr] lg:items-stretch">
          <!-- Vertical title -->
          <aside class="hidden min-h-[720px] rounded-[2.2rem] border border-white/10 bg-white/[0.045] p-5 backdrop-blur-xl lg:flex lg:flex-col lg:justify-between">
            <div class="text-[10px] font-black uppercase tracking-[0.28em] text-brand-orange">
              Kotava Studio
            </div>

            <div class="-rotate-180 [writing-mode:vertical-rl]">
              <div class="text-7xl font-black uppercase leading-none tracking-[-0.08em] text-white/[0.12]">
                audiovisuel
              </div>
            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-orange text-white">
              <Clapperboard :size="22" />
            </div>
          </aside>

          <!-- Main cinema frame -->
          <section class="relative overflow-hidden rounded-[3rem] border border-white/10 bg-white/[0.055] p-4 shadow-[0_45px_150px_rgba(0,0,0,0.45)] backdrop-blur-2xl sm:p-5">
            <div class="absolute inset-0 bg-[linear-gradient(110deg,rgba(255,255,255,0.08)_0,transparent_24%,rgba(249,115,22,0.12)_50%,transparent_76%)]"></div>

            <div class="relative overflow-hidden rounded-[2.45rem] border border-white/10 bg-black">
              <!-- top cinema bar -->
              <div class="relative z-30 flex flex-wrap items-center justify-between gap-3 border-b border-white/10 bg-black/80 px-5 py-4 backdrop-blur">
                <div class="flex items-center gap-3">
                  <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-brand-orange text-white">
                    <Play :size="22" fill="currentColor" />
                  </div>

                  <div>
                    <div class="text-[10px] font-black uppercase tracking-[0.22em] text-white/[0.36]">
                      Now screening
                    </div>

                    <div class="text-lg font-black tracking-[-0.04em] text-white sm:text-xl">
                      {{ activeScene.title }}
                    </div>
                  </div>
                </div>

                <div class="flex items-center gap-2 rounded-xl border border-brand-orange/30 bg-brand-orange/10 px-3 py-2 text-[10px] font-black uppercase tracking-[0.16em] text-brand-orange">
                  <span class="rec-dot h-2 w-2 rounded-[999px] bg-brand-orange"></span>
                  REC {{ activeScene.format }}
                </div>
              </div>

              <!-- video canvas -->
              <div class="relative min-h-[520px] overflow-hidden lg:min-h-[610px]">
                <div class="scanline absolute inset-x-0 top-0 z-30 h-24 bg-gradient-to-b from-white/[0.16] to-transparent"></div>

                <!-- FILM CORPORATE -->
                <div
                  v-if="activeScene.visual === 'film'"
                  class="absolute inset-0 overflow-hidden bg-[radial-gradient(circle_at_70%_30%,rgba(249,115,22,0.20),transparent_28%),linear-gradient(135deg,rgba(30,58,138,0.52),#05070B_55%,rgba(16,185,129,0.18))]"
                >
                  <div class="absolute inset-x-0 top-0 h-16 bg-black/60"></div>
                  <div class="absolute inset-x-0 bottom-0 h-16 bg-black/60"></div>

                  <div class="absolute left-[10%] top-[22%] h-64 w-44 rounded-[2.6rem] border border-white/10 bg-white/[0.10]"></div>
                  <div class="absolute right-[12%] top-[30%] h-44 w-72 rounded-[2.6rem] border border-brand-orange/20 bg-brand-orange/35"></div>

                  <div class="absolute bottom-24 left-8 rounded-[1.5rem] bg-white p-5 text-slate-950 shadow-2xl">
                    <div class="text-[10px] font-black uppercase tracking-[0.18em] text-slate-400">
                      Interview setup
                    </div>
                    <div class="mt-2 text-2xl font-black tracking-[-0.06em]">
                      Brand story
                    </div>
                  </div>
                </div>

                <!-- MOTION -->
                <div
                  v-else-if="activeScene.visual === 'motion'"
                  class="absolute inset-0 flex items-center justify-center overflow-hidden bg-[radial-gradient(circle_at_50%_50%,rgba(249,115,22,0.24),transparent_32%),linear-gradient(135deg,#05070B,rgba(16,185,129,0.20))]"
                >
                  <div class="motion-orbit absolute h-96 w-96 rounded-[5rem] border border-dashed border-brand-orange/35"></div>
                  <div class="motion-orbit-reverse absolute h-64 w-64 rounded-full border border-brand-emerald/25"></div>
                  <div class="absolute h-36 w-36 rounded-[2.4rem] bg-brand-orange/45 blur-sm"></div>
                  <Wand2 :size="72" class="relative z-10 text-white" />
                </div>

                <!-- PHOTO -->
                <div
                  v-else-if="activeScene.visual === 'photo'"
                  class="absolute inset-0 overflow-hidden bg-[linear-gradient(135deg,#05070B,rgba(30,58,138,0.48),rgba(249,115,22,0.18))]"
                >
                  <div class="absolute left-8 top-8 h-20 w-20 border-l-2 border-t-2 border-white/45"></div>
                  <div class="absolute right-8 top-8 h-20 w-20 border-r-2 border-t-2 border-white/45"></div>
                  <div class="absolute bottom-8 left-8 h-20 w-20 border-b-2 border-l-2 border-white/45"></div>
                  <div class="absolute bottom-8 right-8 h-20 w-20 border-b-2 border-r-2 border-white/45"></div>

                  <div class="absolute inset-0 grid grid-cols-3 gap-5 p-14">
                    <div class="rounded-[2.5rem] bg-white/[0.10]"></div>
                    <div class="rounded-[2.5rem] bg-brand-orange/35"></div>
                    <div class="rounded-[2.5rem] bg-brand-emerald/30"></div>
                  </div>

                  <Camera :size="60" class="absolute left-1/2 top-1/2 z-10 -translate-x-1/2 -translate-y-1/2 text-white" />
                </div>

                <!-- AUDIO -->
                <div
                  v-else-if="activeScene.visual === 'audio'"
                  class="absolute inset-0 flex items-center justify-center overflow-hidden bg-[radial-gradient(circle_at_50%_50%,rgba(16,185,129,0.18),transparent_34%),linear-gradient(135deg,rgba(30,58,138,0.50),#05070B)]"
                >
                  <div class="flex h-72 items-center gap-3">
                    <span
                      v-for="i in 32"
                      :key="i"
                      class="wave-bar w-2 rounded-[999px] bg-brand-emerald"
                      :style="{ animationDelay: `${i * 42}ms` }"
                    ></span>
                  </div>

                  <div class="absolute bottom-10 left-10 rounded-[1.5rem] border border-white/10 bg-white/[0.08] px-5 py-4 backdrop-blur">
                    <Music :size="24" class="text-brand-orange" />
                    <div class="mt-2 text-sm font-black text-white">Sound design</div>
                  </div>
                </div>

                <!-- DRONE -->
                <div
                  v-else-if="activeScene.visual === 'drone'"
                  class="absolute inset-0 overflow-hidden bg-[radial-gradient(circle_at_50%_44%,rgba(16,185,129,0.20),transparent_28%),linear-gradient(135deg,#05070B,rgba(30,58,138,0.50))]"
                >
                  <div class="absolute left-1/2 top-1/2 h-80 w-80 -translate-x-1/2 -translate-y-1/2 rounded-full border border-white/10"></div>
                  <div class="absolute left-1/2 top-1/2 h-52 w-52 -translate-x-1/2 -translate-y-1/2 rounded-full border border-brand-emerald/30"></div>
                  <div class="drone-route absolute left-[18%] top-[30%] h-48 w-[64%] rounded-full border border-dashed border-brand-orange/45"></div>

                  <div class="absolute left-[46%] top-[38%] flex h-24 w-24 items-center justify-center rounded-[1.8rem] bg-white text-brand-blue shadow-2xl">
                    <Aperture :size="42" />
                  </div>

                  <div class="absolute right-10 bottom-10 rounded-[1.5rem] border border-white/10 bg-white/[0.08] px-5 py-4 backdrop-blur">
                    <div class="text-[10px] font-black uppercase tracking-[0.18em] text-white/[0.40]">
                      Aerial shot
                    </div>
                    <div class="mt-1 text-2xl font-black text-white">4K</div>
                  </div>
                </div>

                <!-- LIVE -->
                <div v-else class="absolute inset-0 overflow-hidden bg-black p-6">
                  <div class="grid h-full grid-cols-2 gap-5">
                    <div class="rounded-[2rem] bg-brand-blue/42 p-5">
                      <Video :size="32" class="text-white" />
                      <div class="mt-32 text-xl font-black text-white">CAM 01</div>
                    </div>

                    <div class="rounded-[2rem] bg-brand-emerald/35 p-5">
                      <Radio :size="32" class="text-white" />
                      <div class="mt-32 text-xl font-black text-white">LIVE</div>
                    </div>

                    <div class="rounded-[2rem] bg-brand-orange/35 p-5">
                      <Camera :size="32" class="text-white" />
                      <div class="mt-32 text-xl font-black text-white">CAM 02</div>
                    </div>

                    <div class="rounded-[2rem] bg-white/[0.10] p-5">
                      <Mic :size="32" class="text-white" />
                      <div class="mt-32 text-xl font-black text-white">AUDIO</div>
                    </div>
                  </div>

                  <div class="absolute right-10 top-10 rounded-xl bg-red-500 px-4 py-2 text-[10px] font-black uppercase tracking-[0.18em] text-white">
                    LIVE
                  </div>
                </div>

                <!-- bottom text -->
                <div class="absolute inset-x-5 bottom-5 z-40 rounded-[1.6rem] border border-white/10 bg-black/70 p-5 backdrop-blur">
                  <div class="grid gap-4 lg:grid-cols-[0.35fr_0.65fr] lg:items-end">
                    <div>
                      <div class="text-[10px] font-black uppercase tracking-[0.2em] text-brand-orange">
                        {{ activeScene.code }}
                      </div>

                      <h1 class="mt-2 text-3xl font-black tracking-[-0.06em] text-white sm:text-4xl">
                        {{ activeScene.title }}
                      </h1>

                      <p class="mt-1 text-sm font-semibold text-white/[0.48]">
                        {{ activeScene.label }}
                      </p>
                    </div>

                    <div>
                      <p class="max-w-xl text-sm leading-6 text-white/[0.58]">
                        {{ activeScene.text }}
                      </p>

                      <div class="mt-3 flex flex-wrap gap-2">
                        <span
                          v-for="tag in activeScene.tags"
                          :key="tag"
                          class="rounded-xl border border-white/10 bg-white/[0.07] px-3 py-2 text-[10px] font-black uppercase tracking-[0.12em] text-white/[0.55]"
                        >
                          {{ tag }}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <!-- Director slate -->
          <aside class="rounded-[2.2rem] border border-white/10 bg-white/[0.045] p-5 backdrop-blur-xl">
            <div class="flex items-center justify-between gap-3">
              <div>
                <div class="text-[10px] font-black uppercase tracking-[0.22em] text-white/[0.36]">
                  Director slate
                </div>

                <div class="mt-2 text-2xl font-black tracking-[-0.06em] text-white">
                  KOTAVA
                </div>
              </div>

              <Clapperboard :size="28" class="text-brand-orange" />
            </div>

            <div class="mt-6 space-y-2">
              <button
                v-for="(scene, index) in scenes"
                :key="scene.title"
                type="button"
                :class="[
                  'w-full rounded-[1.2rem] border p-3 text-left transition',
                  activeIndex === index
                    ? 'border-brand-orange/50 bg-brand-orange/15'
                    : 'border-white/10 bg-white/[0.045] hover:bg-white/[0.09]'
                ]"
                @click="setActive(index)"
              >
                <div class="flex items-center justify-between gap-3">
                  <component
                    :is="scene.icon"
                    :size="18"
                    :class="activeIndex === index ? 'text-brand-orange' : 'text-white/[0.40]'"
                  />

                  <span class="text-[10px] font-black uppercase tracking-[0.14em] text-white/[0.36]">
                    {{ scene.code }}
                  </span>
                </div>

                <div
                  :class="[
                    'mt-3 text-sm font-black',
                    activeIndex === index ? 'text-white' : 'text-white/[0.56]'
                  ]"
                >
                  {{ scene.title }}
                </div>
              </button>
            </div>

            <div class="mt-5 rounded-[1.5rem] border border-white/10 bg-black/35 p-4">
              <div class="text-[10px] font-black uppercase tracking-[0.18em] text-white/[0.36]">
                Production value
              </div>

              <div class="mt-3 text-4xl font-black tracking-[-0.08em] text-white">
                4K
              </div>

              <div class="mt-3 h-2 rounded-[999px] bg-white/[0.08]">
                <div class="quality-meter h-full rounded-[999px] bg-brand-orange"></div>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </section>

    <!-- PRODUCTION TABLE / NOT CLASSIC CARDS -->
    <section class="relative isolate overflow-hidden px-3 py-12 sm:px-4 sm:py-14 lg:px-6 lg:py-16">
      <div class="absolute inset-0 bg-[linear-gradient(180deg,#05070B,#08111F_55%,#05070B)]"></div>

      <div class="site-container relative z-10">
        <div class="mb-8 grid gap-5 lg:grid-cols-[0.7fr_1.3fr] lg:items-end">
          <div>
            <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-orange">
              <Film :size="15" />
              Production line-up
            </div>

            <h2 class="mt-4 text-4xl font-black leading-[0.95] tracking-[-0.06em] text-white sm:text-5xl">
              Une production,
              <span class="block text-brand-orange">plusieurs formats.</span>
            </h2>
          </div>

          <p class="max-w-xl text-sm leading-7 text-white/[0.55]">
            On ne produit pas seulement une vidéo. On prépare les bons formats pour les bons canaux.
          </p>
        </div>

        <div class="overflow-hidden rounded-[2.4rem] border border-white/10 bg-white/[0.055] backdrop-blur-2xl">
          <div
            v-for="(scene, index) in scenes"
            :key="scene.title"
            class="group grid gap-4 border-b border-white/10 p-5 transition last:border-b-0 hover:bg-white/[0.055] lg:grid-cols-[0.15fr_0.35fr_0.25fr_0.25fr] lg:items-center"
            @mouseenter="setActive(index)"
          >
            <div class="text-5xl font-black tracking-[-0.1em] text-white/[0.12]">
              {{ scene.code.replace('SCN-', '') }}
            </div>

            <div class="flex items-center gap-4">
              <div :class="['flex h-14 w-14 items-center justify-center rounded-2xl text-white', scene.accent]">
                <component :is="scene.icon" :size="24" />
              </div>

              <div>
                <h3 class="text-xl font-black tracking-[-0.04em] text-white">
                  {{ scene.title }}
                </h3>

                <p class="mt-1 text-sm font-bold text-white/[0.45]">
                  {{ scene.label }}
                </p>
              </div>
            </div>

            <div class="rounded-xl border border-white/10 bg-black/30 px-4 py-3 text-sm font-black text-brand-orange">
              {{ scene.format }}
            </div>

            <div class="flex flex-wrap gap-2">
              <span
                v-for="tag in scene.tags.slice(0, 2)"
                :key="tag"
                class="rounded-xl border border-white/10 bg-white/[0.06] px-3 py-2 text-[10px] font-black uppercase tracking-[0.12em] text-white/[0.50]"
              >
                {{ tag }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- STUDIO FLOOR -->
    <section class="relative isolate overflow-hidden px-3 py-12 pb-20 sm:px-4 sm:py-14 lg:px-6 lg:pb-24">
      <div class="site-container relative z-10">
        <div class="grid gap-5 lg:grid-cols-[1.1fr_0.9fr]">
          <!-- workflow as vertical film roll -->
          <div class="relative overflow-hidden rounded-[2.8rem] border border-white/10 bg-white/[0.06] p-6 backdrop-blur-2xl">
            <div class="absolute -right-24 -top-24 h-80 w-80 rounded-[5rem] bg-brand-orange/15 blur-3xl"></div>

            <div class="relative">
              <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-orange">
                <Scissors :size="14" />
                Studio floor
              </div>

              <h2 class="mt-5 max-w-2xl text-4xl font-black leading-[0.95] tracking-[-0.06em] text-white">
                Du script à l’export,
                <span class="block text-brand-orange">tout suit un rythme.</span>
              </h2>

              <div class="mt-8 grid gap-3 sm:grid-cols-4">
                <div
                  v-for="(step, index) in productionSteps"
                  :key="step.title"
                  class="relative min-h-56 overflow-hidden rounded-[1.8rem] border border-white/10 bg-black/35 p-4"
                >
                  <div class="absolute inset-x-0 top-0 h-8 bg-[repeating-linear-gradient(90deg,rgba(255,255,255,0.16)_0_10px,transparent_10px_20px)]"></div>

                  <div class="mt-8 flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-brand-blue">
                    <component :is="step.icon" :size="21" />
                  </div>

                  <div class="mt-8 text-[10px] font-black uppercase tracking-[0.18em] text-white/[0.32]">
                    0{{ index + 1 }}
                  </div>

                  <h3 class="mt-1 text-lg font-black text-white">
                    {{ step.title }}
                  </h3>

                  <p class="mt-2 text-xs leading-5 text-white/[0.50]">
                    {{ step.label }}
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- gear console -->
          <div class="relative overflow-hidden rounded-[2.8rem] border border-white/10 bg-white/[0.06] p-6 backdrop-blur-2xl">
            <div class="absolute -bottom-24 -right-20 h-80 w-80 rounded-[4rem] bg-brand-emerald/15 blur-3xl"></div>

            <div class="relative">
              <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald">
                <Aperture :size="14" />
                Régie
              </div>

              <div class="mt-6 grid grid-cols-2 gap-3">
                <div
                  v-for="item in gear"
                  :key="item.title"
                  class="min-h-40 rounded-[1.6rem] border border-white/10 bg-black/35 p-4"
                >
                  <component :is="item.icon" :size="24" class="text-brand-orange" />

                  <div class="mt-14 text-lg font-black text-white">
                    {{ item.title }}
                  </div>

                  <div class="mt-1 text-xs font-bold uppercase tracking-[0.12em] text-white/[0.42]">
                    {{ item.label }}
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- outputs + CTA -->
          <div class="relative overflow-hidden rounded-[2.8rem] border border-white/10 bg-white/[0.065] p-6 backdrop-blur-2xl lg:col-span-2 sm:p-8">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_18%,rgba(249,115,22,0.16),transparent_30%),radial-gradient(circle_at_86%_80%,rgba(16,185,129,0.14),transparent_32%)]"></div>

            <div class="relative grid gap-8 lg:grid-cols-[0.86fr_1.14fr] lg:items-center">
              <div>
                <div class="flex h-16 w-16 items-center justify-center rounded-[1.4rem] bg-brand-orange text-white shadow-orange">
                  <Package :size="28" />
                </div>

                <h2 class="mt-6 text-4xl font-black leading-[0.95] tracking-[-0.06em] text-white sm:text-5xl">
                  Des livrables prêts
                  <span class="block bg-gradient-to-r from-brand-orange via-white to-brand-emerald bg-clip-text text-transparent">
                    pour chaque canal.
                  </span>
                </h2>

                <p class="mt-4 max-w-xl text-sm leading-7 text-white/[0.60]">
                  Vidéo longue, formats courts, photos, audio, miniatures et exports optimisés pour vos supports.
                </p>
              </div>

              <div>
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
                  <div
                    v-for="item in deliverables"
                    :key="item.title"
                    class="rounded-[1.5rem] border border-white/10 bg-black/35 p-4"
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
                    Demander un devis vidéo
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
              <Eye :size="22" class="text-brand-orange" />
              <div class="mt-3 text-sm font-black text-white">Rendu premium</div>
            </div>

            <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.055] p-5 backdrop-blur">
              <Clock3 :size="22" class="text-brand-emerald" />
              <div class="mt-3 text-sm font-black text-white">Délais cadrés</div>
            </div>

            <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.055] p-5 backdrop-blur">
              <Sparkles :size="22" class="text-brand-orange" />
              <div class="mt-3 text-sm font-black text-white">Direction créative</div>
            </div>

            <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.055] p-5 backdrop-blur">
              <Zap :size="22" class="text-brand-emerald" />
              <div class="mt-3 text-sm font-black text-white">Formats rapides</div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<style scoped>
@keyframes filmNoise {
  0%, 100% {
    background-position: 0 0;
  }

  50% {
    background-position: 80px 120px;
  }
}

@keyframes projectorBeam {
  0%, 100% {
    opacity: 0.5;
    transform: translateX(-50%) scaleX(1);
  }

  50% {
    opacity: 0.85;
    transform: translateX(-50%) scaleX(1.08);
  }
}

@keyframes cinemaParticle {
  0%, 100% {
    transform: translate3d(0, 0, 0);
    opacity: 0.18;
  }

  50% {
    transform: translate3d(20px, -24px, 0);
    opacity: 0.75;
  }
}

@keyframes filmStrip {
  0% {
    transform: translateX(0) rotate(-3deg);
  }

  100% {
    transform: translateX(-140px) rotate(-3deg);
  }
}

@keyframes recDot {
  0%, 100% {
    opacity: 0.35;
  }

  50% {
    opacity: 1;
  }
}

@keyframes scanline {
  0% {
    transform: translateY(-100%);
    opacity: 0;
  }

  35% {
    opacity: 0.45;
  }

  100% {
    transform: translateY(560%);
    opacity: 0;
  }
}

@keyframes motionOrbit {
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

@keyframes motionOrbitReverse {
  0% {
    transform: rotate(360deg) scale(1);
  }

  50% {
    transform: rotate(180deg) scale(1.08);
  }

  100% {
    transform: rotate(0deg) scale(1);
  }
}

@keyframes wave {
  0%, 100% {
    height: 24px;
    opacity: 0.35;
  }

  50% {
    height: 210px;
    opacity: 1;
  }
}

@keyframes droneRoute {
  0%, 100% {
    transform: rotate(0deg) scale(0.94);
    opacity: 0.35;
  }

  50% {
    transform: rotate(8deg) scale(1.04);
    opacity: 0.8;
  }
}

@keyframes qualityMeter {
  0% {
    width: 32%;
  }

  50% {
    width: 94%;
  }

  100% {
    width: 68%;
  }
}

.film-noise {
  background-image:
    radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.35) 0 1px, transparent 1px),
    radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.18) 0 1px, transparent 1px);
  background-size: 120px 120px, 180px 180px;
  animation: filmNoise 1.4s steps(2) infinite;
}

.projector-beam {
  animation: projectorBeam 5s ease-in-out infinite;
}

.cinema-particle {
  animation: cinemaParticle 7s ease-in-out infinite;
}

.film-strip {
  animation: filmStrip 18s linear infinite;
}

.rec-dot {
  animation: recDot 1.2s ease-in-out infinite;
}

.scanline {
  animation: scanline 4.2s ease-in-out infinite;
}

.motion-orbit {
  animation: motionOrbit 14s linear infinite;
}

.motion-orbit-reverse {
  animation: motionOrbitReverse 18s linear infinite;
}

.wave-bar {
  animation: wave 1.6s ease-in-out infinite;
}

.drone-route {
  animation: droneRoute 4s ease-in-out infinite;
}

.quality-meter {
  animation: qualityMeter 3.4s ease-in-out infinite;
}
</style>