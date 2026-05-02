<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import {
  ArrowDown,
  ArrowRight,
  ArrowUpRight,
  BarChart3,
  CalendarDays,
  CheckCircle2,
  Globe2,
  Layers3,
  MessageCircle,
  Palette,
  Sparkles,
  Target,
  Video,
  Wand2,
  Zap,
} from 'lucide-vue-next';

const services = [
  {
    title: 'Stratégie',
    full: 'Stratégie & Conseil',
    desc: 'Positionnement, message, vision.',
    icon: Target,
    href: '/services/strategie-conseil',
    visual: 'strategy',
    iconWrap: 'bg-brand-blue/15 text-brand-blue',
    pill: 'bg-brand-blue text-white',
    glow: 'bg-brand-blue/20',
    accent: 'bg-brand-blue',
    gradient: 'from-brand-blue/35 via-white/10 to-brand-emerald/20',
    position: 'left-[2%] top-[7%]',
  },
  {
    title: 'Branding',
    full: 'Branding & Design',
    desc: 'Identité visuelle mémorable.',
    icon: Palette,
    href: '/services/branding-design',
    visual: 'branding',
    iconWrap: 'bg-brand-emerald/15 text-brand-emerald',
    pill: 'bg-brand-emerald text-white',
    glow: 'bg-brand-emerald/20',
    accent: 'bg-brand-emerald',
    gradient: 'from-brand-emerald/35 via-white/10 to-brand-orange/20',
    position: 'right-[2%] top-[7%]',
  },
  {
    title: 'Digital',
    full: 'Digital & Web',
    desc: 'Web, UX/UI, présence digitale.',
    icon: Globe2,
    href: '/services/digital-web',
    visual: 'digital',
    iconWrap: 'bg-brand-orange/15 text-brand-orange',
    pill: 'bg-brand-orange text-white',
    glow: 'bg-brand-orange/20',
    accent: 'bg-brand-orange',
    gradient: 'from-brand-orange/35 via-white/10 to-brand-blue/25',
    position: 'right-[0%] top-[42%]',
  },
  {
    title: 'Audiovisuel',
    full: 'Production Audiovisuelle',
    desc: 'Photo, vidéo, contenus premium.',
    icon: Video,
    href: '/services/audiovisuel',
    visual: 'video',
    iconWrap: 'bg-brand-blue/15 text-brand-blue',
    pill: 'bg-brand-blue text-white',
    glow: 'bg-brand-blue/20',
    accent: 'bg-brand-blue',
    gradient: 'from-brand-blue/35 via-white/10 to-brand-orange/25',
    position: 'left-[0%] top-[42%]',
  },
  {
    title: 'Social',
    full: 'Social Media',
    desc: 'Contenus, campagnes, audience.',
    icon: MessageCircle,
    href: '/services/social-media',
    visual: 'social',
    iconWrap: 'bg-brand-emerald/15 text-brand-emerald',
    pill: 'bg-brand-emerald text-white',
    glow: 'bg-brand-emerald/20',
    accent: 'bg-brand-emerald',
    gradient: 'from-brand-emerald/35 via-white/10 to-brand-blue/20',
    position: 'right-[20%] bottom-[3%]',
  },
  {
    title: 'Event',
    full: 'Événementiel & RP',
    desc: 'Activation, influence, visibilité.',
    icon: CalendarDays,
    href: '/services/evenementiel',
    visual: 'event',
    iconWrap: 'bg-brand-orange/15 text-brand-orange',
    pill: 'bg-brand-orange text-white',
    glow: 'bg-brand-orange/20',
    accent: 'bg-brand-orange',
    gradient: 'from-brand-orange/35 via-white/10 to-brand-emerald/20',
    position: 'left-[20%] bottom-[3%]',
  },
];

const activeIndex = ref(0);
let interval = null;

const activeService = computed(() => services[activeIndex.value]);
const progressWidth = computed(() => `${((activeIndex.value + 1) / services.length) * 100}%`);

const setActive = (index) => {
  activeIndex.value = index;
};

onMounted(() => {
  interval = setInterval(() => {
    activeIndex.value = (activeIndex.value + 1) % services.length;
  }, 2600);
});

onUnmounted(() => {
  if (interval) {
    clearInterval(interval);
  }
});
</script>

<template>
  <section class="relative isolate overflow-hidden bg-brand-dark text-white">
    <!-- Background global -->
    <div class="absolute inset-0 bg-grid-dark opacity-30"></div>

    <div class="absolute inset-0 bg-[radial-gradient(circle_at_12%_18%,rgba(16,185,129,0.16),transparent_28%),radial-gradient(circle_at_88%_18%,rgba(249,115,22,0.13),transparent_26%),radial-gradient(circle_at_50%_72%,rgba(30,58,138,0.36),transparent_34%)]"></div>

    <div class="absolute inset-x-0 top-0 h-40 bg-gradient-to-b from-brand-dark via-brand-dark/90 to-transparent"></div>
    <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-brand-dark via-brand-dark/90 to-transparent"></div>

    <!-- Watermark -->
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
      <div class="absolute inset-x-0 top-[15%] hidden select-none text-center text-[15vw] font-black uppercase leading-none tracking-[-0.09em] text-white/[0.028] lg:block">
        KOTAVA
      </div>

      <img
        src="/logo.png"
        alt=""
        class="absolute left-[4%] top-[28%] hidden h-24 w-auto opacity-[0.04] motion-safe:animate-pulse lg:block"
      />

      <img
        src="/logo.png"
        alt=""
        class="absolute right-[5%] top-[30%] hidden h-28 w-auto opacity-[0.035] motion-safe:animate-pulse [animation-delay:700ms] lg:block"
      />
    </div>

    <!-- INTRO -->
    <div class="site-container relative z-10">
      <div class="flex min-h-[calc(100svh-2rem)] flex-col items-center justify-center pt-[clamp(7rem,9vw,9rem)] text-center">
        <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald backdrop-blur">
          <Sparkles :size="14" />
          Studio créatif nouvelle génération
        </div>

        <h1 class="mx-auto mt-7 max-w-6xl text-[clamp(4rem,10vw,9rem)] font-black leading-[0.84] tracking-[-0.08em]">
          Faites rayonner
          <span class="block bg-gradient-to-r from-brand-emerald via-white to-brand-orange bg-clip-text text-transparent">
            votre marque.
          </span>
        </h1>

        <p class="mx-auto mt-7 max-w-3xl text-lg leading-9 text-white/68 sm:text-xl">
          Stratégie, image, contenu et digital dans une expérience visuelle immersive pensée pour capter, convaincre et marquer.
        </p>

        <div class="mt-9 flex flex-col justify-center gap-3 sm:flex-row">
          <Link href="/contact" class="btn-primary">
            Lancer un projet
            <ArrowRight :size="18" />
          </Link>

          <Link href="/portfolio" class="btn-light">
            Voir le portfolio
            <ArrowUpRight :size="18" />
          </Link>
        </div>

        <div class="mt-10 grid w-full max-w-2xl gap-3 sm:grid-cols-2">
          <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.055] p-4 text-left backdrop-blur-xl">
            <div class="flex items-center justify-between gap-4">
              <div>
                <div class="text-4xl font-black text-white">+100</div>
                <div class="mt-1 text-xs font-black uppercase tracking-[0.16em] text-white/45">
                  Projets réalisés
                </div>
              </div>

              <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-blue/15 text-brand-blue">
                <Layers3 :size="22" />
              </div>
            </div>
          </div>

          <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.055] p-4 text-left backdrop-blur-xl">
            <div class="flex items-center justify-between gap-4">
              <div>
                <div class="text-4xl font-black text-white">+1000</div>
                <div class="mt-1 text-xs font-black uppercase tracking-[0.16em] text-white/45">
                  Contenus produits
                </div>
              </div>

              <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-emerald/15 text-brand-emerald">
                <CheckCircle2 :size="22" />
              </div>
            </div>
          </div>
        </div>

        <a
          href="#kotava-visual-lab"
          class="mt-12 inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.055] px-4 py-3 text-xs font-black uppercase tracking-[0.18em] text-white/55 backdrop-blur transition hover:-translate-y-0.5 hover:bg-white/[0.09] hover:text-white"
        >
          Découvrir le studio
          <ArrowDown :size="16" />
        </a>
      </div>
    </div>

    <!-- VISUAL LAB -->
    <div id="kotava-visual-lab" class="relative z-10 border-t border-white/10">
      <div class="site-container">
        <div class="flex min-h-[100svh] flex-col justify-center py-14 sm:py-16 lg:py-20">
          <div class="mx-auto max-w-4xl text-center">
            <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-orange backdrop-blur">
              <Zap :size="14" />
              Studio en mouvement
            </div>

            <h2 class="mx-auto mt-5 max-w-3xl text-[clamp(2.5rem,5vw,5rem)] font-black leading-[0.9] tracking-[-0.06em]">
              Une mécanique créative
              <span class="block text-white/45">
                pensée pour l’impact.
              </span>
            </h2>
          </div>

          <div class="relative mx-auto mt-10 flex h-[clamp(620px,74svh,760px)] w-full max-w-[1180px] items-center justify-center">
            <!-- Orbit system -->
            <div class="pointer-events-none absolute h-[min(86vw,760px)] w-[min(86vw,760px)] rotate-6 rounded-[3rem] border border-white/10 motion-safe:animate-spin [animation-duration:40s]"></div>

            <div class="pointer-events-none absolute h-[min(72vw,620px)] w-[min(72vw,620px)] -rotate-6 rounded-[3rem] border border-brand-emerald/15 motion-safe:animate-spin [animation-direction:reverse] [animation-duration:28s]"></div>

            <div class="pointer-events-none absolute h-[min(58vw,500px)] w-[min(58vw,500px)] rotate-12 rounded-[2.5rem] border border-brand-orange/15 motion-safe:animate-spin [animation-duration:22s]"></div>

            <!-- Light beams -->
            <div class="pointer-events-none absolute left-1/2 top-1/2 h-[72%] w-px -translate-x-1/2 -translate-y-1/2 bg-gradient-to-b from-transparent via-white/20 to-transparent"></div>

            <div class="pointer-events-none absolute left-1/2 top-1/2 h-px w-[76%] -translate-x-1/2 -translate-y-1/2 bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>

            <!-- Signal dots -->
            <div class="absolute left-[16%] top-[28%] h-3 w-3 rounded-md bg-brand-emerald shadow-[0_0_28px_rgba(16,185,129,0.85)] motion-safe:animate-ping"></div>

            <div class="absolute right-[17%] top-[35%] h-3 w-3 rounded-md bg-brand-orange shadow-[0_0_28px_rgba(249,115,22,0.85)] motion-safe:animate-ping [animation-delay:700ms]"></div>

            <div class="absolute bottom-[23%] left-[34%] h-3 w-3 rounded-md bg-brand-blue shadow-[0_0_28px_rgba(30,58,138,0.85)] motion-safe:animate-ping [animation-delay:1100ms]"></div>

            <!-- Main core -->
            <div class="relative z-20 w-full max-w-[590px]">
              <!-- Brand chip -->
              <div class="absolute left-1/2 top-0 z-30 -translate-x-1/2 -translate-y-1/2">
                <div class="inline-flex items-center gap-3 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-3 shadow-[0_18px_40px_rgba(0,0,0,0.25)] backdrop-blur-xl">
                  <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white">
                    <img src="/logo_horizontal.png" alt="KOTAVA Communication" class="h-7 w-7 object-contain" />
                  </div>

                  <div class="text-left">
                    <div class="text-[10px] font-black uppercase tracking-[0.18em] text-brand-emerald">
                      KOTAVA Signal
                    </div>
                    <div class="text-sm font-black text-white">
                      Creative brand system
                    </div>
                  </div>
                </div>
              </div>

              <div class="overflow-hidden rounded-[2.2rem] border border-white/10 bg-white/[0.06] p-4 shadow-[0_40px_120px_rgba(0,0,0,0.35)] backdrop-blur-2xl sm:p-5">
                <div class="rounded-[1.9rem] border border-white/10 bg-slate-950/95 p-4 sm:p-5">
                  <!-- Header -->
                  <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-2">
                      <span class="h-2.5 w-2.5 rounded-md bg-brand-emerald"></span>
                      <span class="h-2.5 w-2.5 rounded-md bg-brand-orange"></span>
                      <span class="h-2.5 w-2.5 rounded-md bg-white/30"></span>
                    </div>

                    <div class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/[0.06] px-3 py-1.5 text-[10px] font-black uppercase tracking-[0.18em] text-white/55">
                      <Zap :size="13" class="text-brand-emerald" />
                      Live studio
                    </div>
                  </div>

                  <!-- Visual metrics -->
                  <div class="mt-5 grid grid-cols-2 gap-3 sm:grid-cols-4">
                    <div class="rounded-2xl border border-white/10 bg-white/[0.05] p-3">
                      <div class="flex h-8 items-end gap-1.5">
                        <span class="w-full rounded-t-lg bg-brand-blue/70" style="height: 45%"></span>
                        <span class="w-full rounded-t-lg bg-brand-blue" style="height: 78%"></span>
                        <span class="w-full rounded-t-lg bg-brand-blue/45" style="height: 58%"></span>
                      </div>
                      <div class="mt-2 text-xl font-black text-white">+100</div>
                      <div class="text-[10px] font-semibold text-white/45">Projets</div>
                    </div>

                    <div class="rounded-2xl border border-white/10 bg-white/[0.05] p-3">
                      <div class="grid h-8 grid-cols-3 gap-1.5">
                        <span class="rounded-lg bg-brand-emerald/80"></span>
                        <span class="rounded-lg bg-brand-emerald/45"></span>
                        <span class="rounded-lg bg-brand-emerald"></span>
                      </div>
                      <div class="mt-2 text-xl font-black text-white">+1000</div>
                      <div class="text-[10px] font-semibold text-white/45">Contenus</div>
                    </div>

                    <div class="rounded-2xl border border-white/10 bg-white/[0.05] p-3">
                      <div class="relative h-8 rounded-xl bg-white/[0.06]">
                        <div class="absolute left-2 top-2 h-3 w-3 rounded-md bg-brand-orange"></div>
                        <div class="absolute bottom-2 right-2 h-3 w-8 rounded-md bg-brand-orange/55"></div>
                      </div>
                      <div class="mt-2 text-xl font-black text-white">360°</div>
                      <div class="text-[10px] font-semibold text-white/45">Vision</div>
                    </div>

                    <div class="rounded-2xl border border-white/10 bg-white/[0.05] p-3">
                      <div class="flex h-8 items-center justify-center">
                        <div class="grid grid-cols-3 gap-1.5">
                          <span class="h-2.5 w-2.5 rounded-md bg-brand-blue"></span>
                          <span class="h-2.5 w-2.5 rounded-md bg-brand-emerald"></span>
                          <span class="h-2.5 w-2.5 rounded-md bg-brand-orange"></span>
                          <span class="h-2.5 w-2.5 rounded-md bg-white/30"></span>
                          <span class="h-2.5 w-2.5 rounded-md bg-brand-emerald/60"></span>
                          <span class="h-2.5 w-2.5 rounded-md bg-brand-blue/60"></span>
                        </div>
                      </div>
                      <div class="mt-2 text-xl font-black text-white">6</div>
                      <div class="text-[10px] font-semibold text-white/45">Pôles</div>
                    </div>
                  </div>

                  <!-- Active personalized illustration -->
                  <div class="mt-5 grid gap-4 lg:grid-cols-[1.1fr_0.9fr] lg:items-stretch">
                    <div class="relative min-h-[260px] overflow-hidden rounded-[1.7rem] border border-white/10 bg-white/[0.045] p-4">
                      <div :class="['absolute -right-16 -top-16 h-48 w-48 rounded-[3rem] blur-3xl', activeService.glow]"></div>
                      <div :class="['absolute inset-0 bg-gradient-to-br opacity-80', activeService.gradient]"></div>

                      <!-- Strategy visual -->
                      <div v-if="activeService.visual === 'strategy'" class="relative z-10 h-full min-h-[230px]">
                        <div class="absolute left-5 top-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-brand-blue text-white shadow-lg">
                          <Target :size="24" />
                        </div>

                        <div class="absolute left-[5.5rem] top-12 h-px w-24 bg-white/30"></div>
                        <div class="absolute right-8 top-8 rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3">
                          <div class="text-[10px] font-black uppercase tracking-[0.18em] text-white/45">Audit</div>
                          <div class="mt-1 text-lg font-black text-white">Marché</div>
                        </div>

                        <div class="absolute left-8 bottom-8 rounded-2xl border border-white/10 bg-slate-950/60 px-4 py-3">
                          <div class="text-[10px] font-black uppercase tracking-[0.18em] text-white/45">Message</div>
                          <div class="mt-1 text-lg font-black text-white">Clair</div>
                        </div>

                        <div class="absolute bottom-14 left-[9rem] h-px w-24 bg-white/30"></div>
                        <div class="absolute bottom-8 right-8 flex h-16 w-16 items-center justify-center rounded-2xl bg-white text-brand-blue">
                          <CheckCircle2 :size="28" />
                        </div>
                      </div>

                      <!-- Branding visual -->
                      <div v-else-if="activeService.visual === 'branding'" class="relative z-10 flex h-full min-h-[230px] items-center justify-center">
                        <div class="grid w-full max-w-[270px] grid-cols-3 gap-3">
                          <div class="h-24 rounded-[1.4rem] bg-brand-blue/80"></div>
                          <div class="h-24 rounded-[1.4rem] bg-brand-emerald"></div>
                          <div class="h-24 rounded-[1.4rem] bg-brand-orange/90"></div>

                          <div class="col-span-2 rounded-[1.4rem] border border-white/10 bg-slate-950/60 p-4">
                            <div class="flex items-center gap-3">
                              <img src="/logo_horizontal.png" alt="" class="h-10 w-10 rounded-xl bg-white object-contain p-1" />
                              <div>
                                <div class="text-[10px] font-black uppercase tracking-[0.18em] text-brand-emerald">Identité</div>
                                <div class="text-lg font-black text-white">KOTAVA</div>
                              </div>
                            </div>
                          </div>

                          <div class="rounded-[1.4rem] border border-white/10 bg-white/10 p-4">
                            <Palette :size="28" class="text-white" />
                          </div>
                        </div>
                      </div>

                      <!-- Digital visual -->
                      <div v-else-if="activeService.visual === 'digital'" class="relative z-10 flex h-full min-h-[230px] items-center justify-center">
                        <div class="w-full max-w-[300px] overflow-hidden rounded-[1.6rem] border border-white/10 bg-slate-950/75 shadow-2xl">
                          <div class="flex items-center justify-between border-b border-white/10 px-4 py-3">
                            <div class="flex items-center gap-1.5">
                              <span class="h-2.5 w-2.5 rounded-md bg-brand-orange"></span>
                              <span class="h-2.5 w-2.5 rounded-md bg-brand-emerald"></span>
                              <span class="h-2.5 w-2.5 rounded-md bg-white/30"></span>
                            </div>
                            <Globe2 :size="18" class="text-brand-orange" />
                          </div>

                          <div class="p-4">
                            <div class="h-20 rounded-[1.2rem] bg-gradient-to-br from-brand-orange/70 to-brand-blue/50"></div>
                            <div class="mt-3 grid grid-cols-3 gap-2">
                              <span class="h-10 rounded-xl bg-white/10"></span>
                              <span class="h-10 rounded-xl bg-white/10"></span>
                              <span class="h-10 rounded-xl bg-white/10"></span>
                            </div>
                            <div class="mt-3 h-3 rounded-full bg-white/10">
                              <div class="h-full w-2/3 rounded-full bg-brand-orange"></div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Video visual -->
                      <div v-else-if="activeService.visual === 'video'" class="relative z-10 flex h-full min-h-[230px] items-center justify-center">
                        <div class="w-full max-w-[300px] rounded-[1.7rem] border border-white/10 bg-slate-950/70 p-4">
                          <div class="relative h-36 overflow-hidden rounded-[1.3rem] bg-gradient-to-br from-brand-blue/70 to-brand-orange/40">
                            <div class="absolute inset-0 bg-[linear-gradient(135deg,rgba(255,255,255,0.15)_0%,transparent_45%)]"></div>
                            <div class="absolute left-1/2 top-1/2 flex h-16 w-16 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-2xl bg-white text-brand-blue">
                              <Video :size="28" />
                            </div>
                          </div>

                          <div class="mt-4 grid grid-cols-5 gap-2">
                            <span class="h-8 rounded-lg bg-brand-blue"></span>
                            <span class="h-8 rounded-lg bg-white/15"></span>
                            <span class="h-8 rounded-lg bg-brand-orange"></span>
                            <span class="h-8 rounded-lg bg-white/15"></span>
                            <span class="h-8 rounded-lg bg-brand-emerald"></span>
                          </div>
                        </div>
                      </div>

                      <!-- Social visual -->
                      <div v-else-if="activeService.visual === 'social'" class="relative z-10 flex h-full min-h-[230px] items-center justify-center">
                        <div class="grid w-full max-w-[310px] grid-cols-[0.85fr_1.15fr] gap-3">
                          <div class="rounded-[1.6rem] border border-white/10 bg-slate-950/70 p-3">
                            <div class="h-16 rounded-[1.1rem] bg-brand-emerald/70"></div>
                            <div class="mt-3 space-y-2">
                              <div class="h-3 rounded-full bg-white/20"></div>
                              <div class="h-3 w-2/3 rounded-full bg-white/10"></div>
                            </div>
                          </div>

                          <div class="space-y-3">
                            <div class="rounded-[1.2rem] border border-white/10 bg-white/10 p-3">
                              <div class="flex items-center gap-2">
                                <MessageCircle :size="18" class="text-brand-emerald" />
                                <div class="h-2 flex-1 rounded-full bg-white/20"></div>
                              </div>
                            </div>

                            <div class="rounded-[1.2rem] border border-white/10 bg-slate-950/70 p-3">
                              <div class="grid grid-cols-3 gap-2">
                                <span class="h-10 rounded-lg bg-brand-blue/70"></span>
                                <span class="h-10 rounded-lg bg-brand-emerald"></span>
                                <span class="h-10 rounded-lg bg-brand-orange/80"></span>
                              </div>
                            </div>

                            <div class="rounded-[1.2rem] border border-white/10 bg-white/10 p-3">
                              <div class="h-2 rounded-full bg-brand-emerald"></div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Event visual -->
                      <div v-else class="relative z-10 flex h-full min-h-[230px] items-center justify-center">
                        <div class="w-full max-w-[310px] rounded-[1.7rem] border border-white/10 bg-slate-950/70 p-4">
                          <div class="grid grid-cols-7 gap-1.5">
                            <span
                              v-for="day in 21"
                              :key="day"
                              :class="[
                                'h-7 rounded-lg',
                                day === 6 || day === 13 || day === 18
                                  ? 'bg-brand-orange'
                                  : day === 10
                                    ? 'bg-brand-emerald'
                                    : 'bg-white/10'
                              ]"
                            ></span>
                          </div>

                          <div class="mt-4 rounded-[1.3rem] border border-white/10 bg-white/10 p-3">
                            <div class="flex items-center justify-between">
                              <CalendarDays :size="22" class="text-brand-orange" />
                              <div class="text-right">
                                <div class="text-[10px] font-black uppercase tracking-[0.18em] text-white/45">
                                  Activation
                                </div>
                                <div class="text-lg font-black text-white">
                                  Live
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Active text -->
                    <div class="rounded-[1.7rem] border border-white/10 bg-white/[0.05] p-4">
                      <div :class="['flex h-12 w-12 items-center justify-center rounded-2xl shadow-lg', activeService.pill]">
                        <component :is="activeService.icon" :size="22" />
                      </div>

                      <div class="mt-5 text-[10px] font-black uppercase tracking-[0.2em] text-brand-emerald">
                        En focus
                      </div>

                      <div class="mt-2 text-2xl font-black leading-tight text-white">
                        {{ activeService.full }}
                      </div>

                      <p class="mt-3 text-sm leading-7 text-white/55">
                        {{ activeService.desc }}
                      </p>

                      <div class="mt-5 h-2 overflow-hidden rounded-xl bg-white/10">
                        <div
                          class="h-full rounded-xl bg-gradient-to-r from-brand-blue via-brand-emerald to-brand-orange transition-all duration-500"
                          :style="{ width: progressWidth }"
                        ></div>
                      </div>

                      <Link
                        :href="activeService.href"
                        class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-white px-4 py-3 text-sm font-black text-brand-blue transition hover:-translate-y-0.5"
                      >
                        Explorer
                        <ArrowRight :size="16" />
                      </Link>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Service cards desktop -->
            <button
              v-for="(service, index) in services"
              :key="service.title"
              type="button"
              :class="[
                'absolute z-30 hidden w-[184px] rounded-[1.35rem] border p-3 text-left shadow-[0_22px_60px_rgba(0,0,0,0.22)] backdrop-blur-xl transition duration-300 hover:-translate-y-1 xl:block',
                service.position,
                activeIndex === index
                  ? 'scale-105 border-white/20 bg-white/[0.14]'
                  : 'scale-100 border-white/10 bg-white/[0.075] hover:bg-white/[0.11]'
              ]"
              @click="setActive(index)"
            >
              <div :class="['absolute -right-8 -top-8 h-24 w-24 rounded-3xl blur-2xl', service.glow]"></div>

              <div class="relative">
                <div :class="['relative h-24 overflow-hidden rounded-[1.05rem] bg-gradient-to-br p-2', service.gradient]">
                  <div class="absolute right-2 top-2 flex h-7 w-7 items-center justify-center rounded-xl bg-slate-950/70">
                    <component :is="service.icon" :size="14" class="text-white" />
                  </div>

                  <div v-if="service.visual === 'strategy'" class="relative h-full rounded-xl border border-white/10 bg-slate-950/55 p-2">
                    <div class="absolute left-3 top-3 h-5 w-5 rounded-lg bg-brand-blue"></div>
                    <div class="absolute left-10 top-5 h-px w-12 bg-white/30"></div>
                    <div class="absolute right-4 top-4 h-7 w-7 rounded-xl bg-white/15"></div>
                    <div class="absolute bottom-4 left-4 h-7 w-14 rounded-xl bg-brand-emerald/80"></div>
                  </div>

                  <div v-else-if="service.visual === 'branding'" class="grid h-full grid-cols-3 gap-2 rounded-xl border border-white/10 bg-slate-950/55 p-2">
                    <span class="rounded-lg bg-brand-blue"></span>
                    <span class="rounded-lg bg-brand-emerald"></span>
                    <span class="rounded-lg bg-brand-orange"></span>
                  </div>

                  <div v-else-if="service.visual === 'digital'" class="h-full rounded-xl border border-white/10 bg-slate-950/55 p-2">
                    <div class="mb-2 flex gap-1">
                      <span class="h-1.5 w-1.5 rounded-md bg-brand-orange"></span>
                      <span class="h-1.5 w-1.5 rounded-md bg-brand-emerald"></span>
                    </div>
                    <div class="h-9 rounded-lg bg-brand-orange/70"></div>
                    <div class="mt-2 grid grid-cols-3 gap-1.5">
                      <span class="h-4 rounded-md bg-white/15"></span>
                      <span class="h-4 rounded-md bg-white/15"></span>
                      <span class="h-4 rounded-md bg-white/15"></span>
                    </div>
                  </div>

                  <div v-else-if="service.visual === 'video'" class="h-full rounded-xl border border-white/10 bg-slate-950/55 p-2">
                    <div class="flex h-12 items-center justify-center rounded-lg bg-brand-blue/70">
                      <Video :size="22" class="text-white" />
                    </div>
                    <div class="mt-2 grid grid-cols-4 gap-1.5">
                      <span class="h-4 rounded-md bg-brand-blue"></span>
                      <span class="h-4 rounded-md bg-white/20"></span>
                      <span class="h-4 rounded-md bg-brand-orange"></span>
                      <span class="h-4 rounded-md bg-white/20"></span>
                    </div>
                  </div>

                  <div v-else-if="service.visual === 'social'" class="grid h-full grid-cols-[0.8fr_1.2fr] gap-2 rounded-xl border border-white/10 bg-slate-950/55 p-2">
                    <span class="rounded-lg bg-brand-emerald/80"></span>
                    <div class="space-y-1.5">
                      <span class="block h-5 rounded-md bg-white/15"></span>
                      <span class="block h-5 rounded-md bg-brand-emerald"></span>
                      <span class="block h-5 rounded-md bg-white/15"></span>
                    </div>
                  </div>

                  <div v-else class="grid h-full grid-cols-5 gap-1.5 rounded-xl border border-white/10 bg-slate-950/55 p-2">
                    <span
                      v-for="day in 15"
                      :key="day"
                      :class="[
                        'rounded-md',
                        day === 4 || day === 9 || day === 14 ? 'bg-brand-orange' : 'bg-white/15'
                      ]"
                    ></span>
                  </div>
                </div>

                <div class="mt-3 flex items-center justify-between gap-3">
                  <h3 class="text-base font-black text-white">
                    {{ service.title }}
                  </h3>

                  <span class="text-[10px] font-black uppercase tracking-[0.18em] text-white/35">
                    0{{ index + 1 }}
                  </span>
                </div>
              </div>
            </button>
          </div>

          <!-- Mobile selector -->
          <div class="mx-auto mt-8 grid max-w-[680px] grid-cols-2 gap-2 sm:grid-cols-3 xl:hidden">
            <button
              v-for="(service, index) in services"
              :key="service.title"
              type="button"
              :class="[
                'rounded-2xl border p-3 text-left transition',
                activeIndex === index
                  ? 'border-brand-orange/50 bg-brand-orange text-white'
                  : 'border-white/10 bg-white/10 text-white/70'
              ]"
              @click="setActive(index)"
            >
              <div class="flex items-center gap-2">
                <div
                  :class="[
                    'flex h-8 w-8 items-center justify-center rounded-xl',
                    activeIndex === index ? 'bg-white/18 text-white' : service.iconWrap
                  ]"
                >
                  <component :is="service.icon" :size="16" />
                </div>

                <div class="text-xs font-black">
                  {{ service.title }}
                </div>
              </div>

              <div :class="['mt-3 h-10 overflow-hidden rounded-xl bg-gradient-to-br p-1.5', service.gradient]">
                <div class="h-full rounded-lg border border-white/10 bg-slate-950/45"></div>
              </div>
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
