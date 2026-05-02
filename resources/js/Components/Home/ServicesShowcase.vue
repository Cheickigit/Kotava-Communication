<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import {
  ArrowRight,
  ArrowUpRight,
  BadgeCheck,
  CalendarDays,
  ChevronRight,
  Globe2,
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
    icon: Target,
    title: 'Stratégie',
    full: 'Stratégie & Conseil',
    href: '/services/strategie-conseil',
    label: 'Positionnement',
    short: 'Vision, message, trajectoire.',
    badge: 'bg-brand-blue text-white',
    soft: 'bg-brand-blue/15 text-brand-blue',
    glow: 'bg-brand-blue/25',
    visual: 'strategy',
  },
  {
    icon: Palette,
    title: 'Branding',
    full: 'Branding & Design',
    href: '/services/branding-design',
    label: 'Identité visuelle',
    short: 'Logo, charte, univers graphique.',
    badge: 'bg-brand-emerald text-white',
    soft: 'bg-brand-emerald/15 text-brand-emerald',
    glow: 'bg-brand-emerald/25',
    visual: 'branding',
  },
  {
    icon: Globe2,
    title: 'Digital',
    full: 'Digital & Web',
    href: '/services/digital-web',
    label: 'Web & UX/UI',
    short: 'Sites, interfaces, présence digitale.',
    badge: 'bg-brand-orange text-white',
    soft: 'bg-brand-orange/15 text-brand-orange',
    glow: 'bg-brand-orange/25',
    visual: 'digital',
  },
  {
    icon: Video,
    title: 'Audiovisuel',
    full: 'Production Audiovisuelle',
    href: '/services/audiovisuel',
    label: 'Photo · Vidéo',
    short: 'Contenus visuels premium.',
    badge: 'bg-brand-blue text-white',
    soft: 'bg-brand-blue/15 text-brand-blue',
    glow: 'bg-brand-blue/25',
    visual: 'video',
  },
  {
    icon: CalendarDays,
    title: 'Événementiel',
    full: 'Événementiel & RP',
    href: '/services/evenementiel',
    label: 'Activation',
    short: 'Événements, RP, influence.',
    badge: 'bg-brand-orange text-white',
    soft: 'bg-brand-orange/15 text-brand-orange',
    glow: 'bg-brand-orange/25',
    visual: 'event',
  },
  {
    icon: MessageCircle,
    title: 'Social Media',
    full: 'Social Media',
    href: '/services/social-media',
    label: 'Audience',
    short: 'Contenus, campagnes, animation.',
    badge: 'bg-brand-emerald text-white',
    soft: 'bg-brand-emerald/15 text-brand-emerald',
    glow: 'bg-brand-emerald/25',
    visual: 'social',
  },
];

const activeIndex = ref(0);
const isPaused = ref(false);
let timer = null;

const activeService = computed(() => services[activeIndex.value]);

const setActiveService = (index) => {
  activeIndex.value = index;
};

const nextService = () => {
  activeIndex.value = (activeIndex.value + 1) % services.length;
};

const startRotation = () => {
  stopRotation();

  timer = setInterval(() => {
    if (!isPaused.value) {
      nextService();
    }
  }, 3600);
};

const stopRotation = () => {
  if (timer) {
    clearInterval(timer);
    timer = null;
  }
};

onMounted(() => {
  startRotation();
});

onUnmounted(() => {
  stopRotation();
});
</script>

<template>
  <section
    class="relative overflow-hidden bg-brand-dark py-20 text-white sm:py-24 lg:py-28"
    @mouseenter="isPaused = true"
    @mouseleave="isPaused = false"
  >
    <!-- Background du départ -->
    <div class="absolute inset-0 bg-grid-dark opacity-35"></div>

    <div class="absolute inset-0 bg-[radial-gradient(circle_at_8%_18%,rgba(16,185,129,0.18),transparent_28%),radial-gradient(circle_at_92%_72%,rgba(249,115,22,0.15),transparent_28%),radial-gradient(circle_at_50%_50%,rgba(30,58,138,0.35),transparent_34%)]"></div>

    <div class="absolute inset-x-0 top-0 h-40 bg-gradient-to-b from-brand-dark to-transparent"></div>
    <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-brand-dark to-transparent"></div>

    <div class="pointer-events-none absolute inset-0 overflow-hidden">
      <img
        src="/logo.png"
        alt=""
        class="absolute left-[5%] top-[14%] hidden h-24 w-auto opacity-[0.04] lg:block"
      />

      <img
        src="/logo.png"
        alt=""
        class="absolute right-[5%] bottom-[14%] hidden h-28 w-auto opacity-[0.035] lg:block"
      />

      <div class="absolute inset-x-0 top-[18%] hidden text-center text-[13vw] font-black uppercase leading-none tracking-[-0.09em] text-white/[0.025] lg:block">
        SERVICES
      </div>
    </div>

    <div class="site-container relative z-10">
      <!-- Header court -->
      <div class="mx-auto mb-12 max-w-3xl text-center">
        <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald backdrop-blur">
          <Sparkles :size="14" />
          Nos expertises
        </div>

        <h2 class="mt-5 text-4xl font-black leading-[0.94] tracking-[-0.055em] sm:text-5xl lg:text-6xl">
          Un studio.
          <span class="block bg-gradient-to-r from-brand-emerald via-white to-brand-orange bg-clip-text text-transparent">
            Six expertises.
          </span>
        </h2>
      </div>

      <!-- Section principale -->
      <div class="grid gap-6 xl:grid-cols-[0.95fr_1.05fr] xl:items-center">
        <!-- Services list compacte -->
        <div class="grid gap-3 sm:grid-cols-2">
          <button
            v-for="(service, index) in services"
            :key="service.title"
            type="button"
            :class="[
              'group relative overflow-hidden rounded-[1.7rem] border p-4 text-left backdrop-blur-xl transition duration-300 hover:-translate-y-1',
              activeIndex === index
                ? 'border-brand-orange/45 bg-white/[0.12] shadow-[0_24px_70px_rgba(0,0,0,0.22)]'
                : 'border-white/10 bg-white/[0.06] hover:border-white/20 hover:bg-white/[0.09]'
            ]"
            @click="setActiveService(index)"
          >
            <div :class="['absolute -right-10 -top-10 h-36 w-36 rounded-[2.5rem] blur-3xl', service.glow]"></div>

            <div class="relative">
              <div class="flex items-center justify-between gap-4">
                <div :class="['flex h-12 w-12 items-center justify-center rounded-2xl shadow-lg', service.badge]">
                  <component :is="service.icon" :size="21" />
                </div>

                <span class="text-[10px] font-black uppercase tracking-[0.18em] text-white/35">
                  0{{ index + 1 }}
                </span>
              </div>

              <h3 class="mt-5 text-xl font-black text-white">
                {{ service.full }}
              </h3>

              <p class="mt-2 text-sm leading-6 text-white/55">
                {{ service.short }}
              </p>

              <div class="mt-5 flex items-center justify-between">
                <span
                  :class="[
                    'inline-flex rounded-xl px-3 py-1.5 text-[10px] font-black uppercase tracking-[0.16em]',
                    service.soft
                  ]"
                >
                  {{ service.label }}
                </span>

                <ChevronRight
                  :size="19"
                  class="text-white/35 transition group-hover:translate-x-1 group-hover:text-brand-orange"
                />
              </div>
            </div>
          </button>
        </div>

        <!-- Visuel 3D premium -->
        <div class="relative min-h-[620px] overflow-hidden rounded-[2.4rem] border border-white/10 bg-white/[0.055] p-5 shadow-[0_35px_100px_rgba(0,0,0,0.25)] backdrop-blur-2xl">
          <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_18%,rgba(16,185,129,0.14),transparent_30%),radial-gradient(circle_at_84%_80%,rgba(249,115,22,0.12),transparent_32%)]"></div>

          <div class="absolute left-1/2 top-1/2 h-[520px] w-[520px] -translate-x-1/2 -translate-y-1/2 rounded-[4rem] border border-white/10 [transform:translate(-50%,-50%)_rotate(12deg)]"></div>

          <div class="absolute left-1/2 top-1/2 h-[390px] w-[390px] -translate-x-1/2 -translate-y-1/2 rounded-[3rem] border border-brand-emerald/15 [transform:translate(-50%,-50%)_rotate(-10deg)]"></div>

          <Transition
            mode="out-in"
            enter-active-class="transition duration-300 ease-out"
            enter-from-class="opacity-0 translate-y-5 scale-[0.98]"
            enter-to-class="opacity-100 translate-y-0 scale-100"
            leave-active-class="transition duration-150 ease-in"
            leave-from-class="opacity-100 translate-y-0 scale-100"
            leave-to-class="opacity-0 -translate-y-4 scale-[0.98]"
          >
            <div :key="activeService.title" class="relative z-10 flex min-h-[570px] items-center justify-center">
              <!-- Main 3D board -->
              <div class="relative w-full max-w-[520px] [perspective:1200px]">
                <div class="relative rounded-[2rem] border border-white/10 bg-slate-950/82 p-5 shadow-[0_30px_90px_rgba(0,0,0,0.32)] [transform:rotateX(8deg)_rotateY(-10deg)]">
                  <!-- Top bar -->
                  <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                      <span class="h-2.5 w-2.5 rounded-md bg-brand-emerald"></span>
                      <span class="h-2.5 w-2.5 rounded-md bg-brand-orange"></span>
                      <span class="h-2.5 w-2.5 rounded-md bg-white/30"></span>
                    </div>

                    <div class="flex items-center gap-2 rounded-xl bg-white/10 px-3 py-2 text-[10px] font-black uppercase tracking-[0.16em] text-white/50">
                      <img src="/logo_horizontal.png" alt="" class="h-4 w-4 object-contain" />
                      Studio live
                    </div>
                  </div>

                  <!-- Visual -->
                  <div class="mt-5 overflow-hidden rounded-[1.6rem] border border-white/10 bg-white/[0.05] p-4">
                    <!-- Strategy -->
                    <div v-if="activeService.visual === 'strategy'" class="min-h-[260px]">
                      <div class="grid gap-4 sm:grid-cols-[0.8fr_1.2fr]">
                        <div class="rounded-[1.4rem] bg-brand-blue p-5 text-white">
                          <Target :size="30" />
                          <div class="mt-12 text-[10px] font-black uppercase tracking-[0.18em] text-white/60">
                            Roadmap
                          </div>
                          <div class="mt-1 text-2xl font-black">
                            Vision
                          </div>
                        </div>

                        <div class="space-y-3">
                          <div class="rounded-[1.2rem] bg-white/10 p-4">
                            <div class="h-3 w-4/5 rounded-full bg-brand-emerald"></div>
                          </div>

                          <div class="rounded-[1.2rem] bg-white/10 p-4">
                            <div class="h-3 w-2/3 rounded-full bg-brand-orange"></div>
                          </div>

                          <div class="rounded-[1.2rem] bg-white/10 p-4">
                            <div class="flex items-center justify-between">
                              <span class="text-sm font-black text-white">Positionnement</span>
                              <BadgeCheck :size="20" class="text-brand-emerald" />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Branding -->
                    <div v-else-if="activeService.visual === 'branding'" class="min-h-[260px]">
                      <div class="grid grid-cols-3 gap-3">
                        <div class="h-28 rounded-[1.4rem] bg-brand-blue"></div>
                        <div class="h-28 rounded-[1.4rem] bg-brand-emerald"></div>
                        <div class="h-28 rounded-[1.4rem] bg-brand-orange"></div>
                      </div>

                      <div class="mt-4 rounded-[1.5rem] bg-white/10 p-5">
                        <div class="flex items-center gap-4">
                          <img src="/logo_horizontal.png" alt="" class="h-14 w-14 rounded-2xl bg-white object-contain p-2" />

                          <div>
                            <div class="text-[10px] font-black uppercase tracking-[0.18em] text-brand-emerald">
                              Identity
                            </div>

                            <div class="mt-1 text-3xl font-black text-white">
                              KOTAVA
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Digital -->
                    <div v-else-if="activeService.visual === 'digital'" class="min-h-[260px]">
                      <div class="overflow-hidden rounded-[1.5rem] border border-white/10 bg-white/10">
                        <div class="flex items-center justify-between border-b border-white/10 px-4 py-3">
                          <div class="flex items-center gap-1.5">
                            <span class="h-2.5 w-2.5 rounded-md bg-brand-orange"></span>
                            <span class="h-2.5 w-2.5 rounded-md bg-brand-emerald"></span>
                            <span class="h-2.5 w-2.5 rounded-md bg-white/30"></span>
                          </div>

                          <Globe2 :size="18" class="text-brand-orange" />
                        </div>

                        <div class="p-4">
                          <div class="h-32 rounded-[1.3rem] bg-gradient-to-br from-brand-orange/80 to-brand-blue/60"></div>

                          <div class="mt-3 grid grid-cols-3 gap-2">
                            <span class="h-14 rounded-xl bg-white/10"></span>
                            <span class="h-14 rounded-xl bg-white/10"></span>
                            <span class="h-14 rounded-xl bg-white/10"></span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Video -->
                    <div v-else-if="activeService.visual === 'video'" class="min-h-[260px]">
                      <div class="relative h-52 overflow-hidden rounded-[1.5rem] bg-gradient-to-br from-brand-blue/85 via-brand-emerald/60 to-brand-orange/65">
                        <div class="absolute left-1/2 top-1/2 flex h-20 w-20 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-[1.6rem] bg-white text-brand-blue shadow-xl">
                          <Video :size="34" />
                        </div>
                      </div>

                      <div class="mt-4 grid grid-cols-5 gap-2">
                        <span class="h-10 rounded-xl bg-brand-blue"></span>
                        <span class="h-10 rounded-xl bg-white/15"></span>
                        <span class="h-10 rounded-xl bg-brand-orange"></span>
                        <span class="h-10 rounded-xl bg-white/15"></span>
                        <span class="h-10 rounded-xl bg-brand-emerald"></span>
                      </div>
                    </div>

                    <!-- Event -->
                    <div v-else-if="activeService.visual === 'event'" class="min-h-[260px]">
                      <div class="grid grid-cols-7 gap-2">
                        <span
                          v-for="day in 28"
                          :key="day"
                          :class="[
                            'h-8 rounded-lg',
                            day === 6 || day === 13 || day === 22
                              ? 'bg-brand-orange'
                              : day === 17
                                ? 'bg-brand-emerald'
                                : 'bg-white/10'
                          ]"
                        ></span>
                      </div>

                      <div class="mt-4 rounded-[1.4rem] bg-white/10 p-4">
                        <div class="flex items-center justify-between">
                          <CalendarDays :size="26" class="text-brand-orange" />

                          <div class="text-right">
                            <div class="text-[10px] font-black uppercase tracking-[0.18em] text-white/45">
                              Activation
                            </div>
                            <div class="text-2xl font-black text-white">
                              Live
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Social -->
                    <div v-else class="min-h-[260px]">
                      <div class="grid grid-cols-[0.85fr_1.15fr] gap-3">
                        <div class="rounded-[1.5rem] bg-white/10 p-3">
                          <div class="h-28 rounded-[1.2rem] bg-brand-emerald"></div>

                          <div class="mt-3 space-y-2">
                            <div class="h-3 rounded-full bg-white/20"></div>
                            <div class="h-3 w-2/3 rounded-full bg-white/10"></div>
                          </div>
                        </div>

                        <div class="space-y-3">
                          <div class="rounded-[1.2rem] bg-white/10 p-3">
                            <div class="flex items-center gap-2">
                              <MessageCircle :size="18" class="text-brand-emerald" />
                              <div class="h-2 flex-1 rounded-full bg-white/20"></div>
                            </div>
                          </div>

                          <div class="rounded-[1.2rem] bg-white/10 p-3">
                            <div class="grid grid-cols-3 gap-2">
                              <span class="h-12 rounded-xl bg-brand-blue/70"></span>
                              <span class="h-12 rounded-xl bg-brand-emerald"></span>
                              <span class="h-12 rounded-xl bg-brand-orange/80"></span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Bottom text minimal -->
                  <div class="mt-5 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                      <div :class="['inline-flex rounded-xl px-3 py-2 text-[10px] font-black uppercase tracking-[0.16em]', activeService.soft]">
                        {{ activeService.label }}
                      </div>

                      <h3 class="mt-3 text-3xl font-black text-white">
                        {{ activeService.full }}
                      </h3>
                    </div>

                    <Link
                      :href="activeService.href"
                      class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] bg-white px-5 py-3 text-sm font-black text-brand-blue transition hover:-translate-y-0.5"
                    >
                      Découvrir
                      <ArrowRight :size="17" />
                    </Link>
                  </div>
                </div>

                <!-- Floating 3D cards -->
                <div class="absolute -left-5 top-20 hidden rounded-[1.4rem] border border-white/10 bg-white/90 p-4 text-brand-ink shadow-xl lg:block [transform:rotate(-8deg)]">
                  <Wand2 :size="22" class="text-brand-emerald" />
                  <div class="mt-3 text-sm font-black">Création</div>
                </div>

                <div class="absolute -right-5 bottom-24 hidden rounded-[1.4rem] border border-white/10 bg-white/90 p-4 text-brand-ink shadow-xl lg:block [transform:rotate(8deg)]">
                  <Zap :size="22" class="text-brand-orange" />
                  <div class="mt-3 text-sm font-black">Impact</div>
                </div>
              </div>
            </div>
          </Transition>
        </div>
      </div>

      <!-- Proof line courte -->
      <div class="mt-10 grid gap-4 md:grid-cols-3">
        <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.06] p-5 backdrop-blur-xl">
          <BadgeCheck :size="22" class="text-brand-emerald" />
          <div class="mt-3 font-black text-white">Approche intégrée</div>
        </div>

        <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.06] p-5 backdrop-blur-xl">
          <Wand2 :size="22" class="text-brand-orange" />
          <div class="mt-3 font-black text-white">Design personnalisé</div>
        </div>

        <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.06] p-5 backdrop-blur-xl">
          <Zap :size="22" class="text-brand-blue" />
          <div class="mt-3 font-black text-white">Déploiement rapide</div>
        </div>
      </div>
    </div>
  </section>
</template>
