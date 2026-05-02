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
  PlayCircle,
  Sparkles,
  Target,
  Video,
  Wand2,
  Zap,
} from 'lucide-vue-next';

const services = [
  {
    icon: Target,
    title: 'Stratégie & Conseil',
    href: '/services/strategie-conseil',
    label: 'Positionnement',
    short: 'Clarifier la vision, l’offre, le message et la trajectoire de marque.',
    speech: 'On commence par comprendre votre marché, votre audience et votre avantage. Ensuite, on transforme tout ça en stratégie claire.',
    className: 'service-blue',
  },
  {
    icon: Palette,
    title: 'Branding & Design',
    href: '/services/branding-design',
    label: 'Identité visuelle',
    short: 'Créer une identité forte, cohérente, mémorable et exploitable partout.',
    speech: 'On donne une forme visuelle à votre marque : logo, univers graphique, charte, supports et direction artistique.',
    className: 'service-emerald',
  },
  {
    icon: Globe2,
    title: 'Digital & Web',
    href: '/services/digital-web',
    label: 'Web & UX/UI',
    short: 'Déployer une présence digitale moderne, lisible et crédible.',
    speech: 'On conçoit des expériences web fluides, esthétiques et orientées conversion pour renforcer votre crédibilité.',
    className: 'service-orange',
  },
  {
    icon: Video,
    title: 'Production Audiovisuelle',
    href: '/services/audiovisuel',
    label: 'Photo · Vidéo',
    short: 'Créer des contenus visuels qui captent l’attention et valorisent l’image.',
    speech: 'On produit des contenus premium : photo, vidéo, motion design, formats réseaux sociaux et contenus corporate.',
    className: 'service-mint',
  },
  {
    icon: CalendarDays,
    title: 'Événementiel & RP',
    href: '/services/evenementiel',
    label: 'Activation',
    short: 'Créer des moments de marque visibles, maîtrisés et engageants.',
    speech: 'On transforme vos actions terrain en expériences de marque : événements, relations publiques, influence et activations.',
    className: 'service-sun',
  },
  {
    icon: MessageCircle,
    title: 'Social Media',
    href: '/services/social-media',
    label: 'Audience',
    short: 'Construire une présence sociale régulière, engageante et mesurable.',
    speech: 'On anime votre présence sociale avec une ligne éditoriale claire, des contenus forts et des campagnes ciblées.',
    className: 'service-deep',
  },
];

const activeIndex = ref(0);
const isPaused = ref(false);
let timer = null;

const activeService = computed(() => services[activeIndex.value]);

const progressWidth = computed(() => `${((activeIndex.value + 1) / services.length) * 100}%`);

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
  }, 3400);
};

const stopRotation = () => {
  if (timer) {
    clearInterval(timer);
    timer = null;
  }
};

const pause = () => {
  isPaused.value = true;
};

const resume = () => {
  isPaused.value = false;
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
    @mouseenter="pause"
    @mouseleave="resume"
  >
    <div class="absolute inset-0 bg-grid-dark opacity-40"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_8%_20%,rgba(16,185,129,0.22),transparent_27%),radial-gradient(circle_at_92%_72%,rgba(249,115,22,0.18),transparent_26%),radial-gradient(circle_at_55%_48%,rgba(30,58,138,0.32),transparent_32%)]"></div>

    <div class="pointer-events-none absolute inset-0 overflow-hidden">
      <img src="/logo.png" alt="" class="service-logo-float left-[5%] top-[12%] h-20 w-auto opacity-[0.05]" />
      <img src="/logo.png" alt="" class="service-logo-float service-logo-float-slow right-[5%] top-[20%] h-24 w-auto opacity-[0.05]" />
      <img src="/logo.png" alt="" class="service-logo-float service-logo-float-reverse bottom-[12%] left-[42%] h-20 w-auto opacity-[0.04]" />
    </div>

    <div class="site-container relative">
      <div class="mb-12 grid gap-6 lg:grid-cols-12 lg:items-end">
        <div class="lg:col-span-7">
          <div class="eyebrow-dark">
            <PlayCircle :size="15" />
            Services en mouvement
          </div>

          <h2 class="mt-5 max-w-4xl text-4xl font-black tracking-tight text-white sm:text-5xl lg:text-6xl">
            Un guide créatif présente nos expertises une par une.
          </h2>
        </div>

        <div class="lg:col-span-5">
          <div class="rounded-2xl border border-white/10 bg-white/[0.06] p-5 backdrop-blur">
            <div class="flex items-center justify-between gap-4">
              <div>
                <div class="text-sm font-black text-white">Mode présentation</div>
                <p class="mt-1 text-sm leading-6 text-white/55">
                  Les services tournent automatiquement. Cliquez sur une carte pour explorer.
                </p>
              </div>

              <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-brand-orange text-white shadow-orange">
                <Sparkles :size="22" />
              </div>
            </div>

            <div class="mt-5 h-2 overflow-hidden rounded-xl bg-white/10">
              <div
                class="h-full rounded-xl bg-gradient-to-r from-brand-blue via-brand-emerald to-brand-orange transition-all duration-500"
                :style="{ width: progressWidth }"
              ></div>
            </div>
          </div>
        </div>
      </div>

      <div class="grid gap-6 xl:grid-cols-[0.92fr_1.08fr] xl:items-stretch">
        <div class="service-presenter">
          <div class="presenter-orbit presenter-orbit-one"></div>
          <div class="presenter-orbit presenter-orbit-two"></div>
          <div class="presenter-orbit presenter-orbit-three"></div>

          <div class="presenter-stage">
            <div class="presenter-avatar-wrap">
              <div class="presenter-aura"></div>

              <div class="presenter-avatar">
                <div class="avatar-ring"></div>

                <div class="avatar-head">
                  <div class="avatar-eye"></div>
                  <div class="avatar-eye"></div>
                  <div class="avatar-mouth"></div>
                </div>

                <div class="avatar-body">
                  <div class="avatar-logo">
                    <img src="/logo_horizontal.png" alt="" class="h-6 w-6 object-contain" />
                  </div>
                  <div class="avatar-light"></div>
                </div>

                <div class="avatar-arm avatar-arm-left"></div>
                <div class="avatar-arm avatar-arm-right"></div>
              </div>
            </div>

            <div class="service-bubble">
              <div class="flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center gap-2 rounded-xl bg-brand-light px-3 py-2 text-xs font-black uppercase tracking-[0.18em] text-brand-blue">
                  <component :is="activeService.icon" :size="14" />
                  {{ activeService.label }}
                </span>

                <span class="inline-flex items-center gap-2 rounded-xl bg-white px-3 py-2 text-xs font-black uppercase tracking-[0.18em] text-brand-emerald ring-1 ring-slate-200">
                  0{{ activeIndex + 1 }}/0{{ services.length }}
                </span>
              </div>

              <Transition
                mode="out-in"
                enter-active-class="transition duration-300 ease-out"
                enter-from-class="opacity-0 translate-y-4"
                enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transition duration-150 ease-in"
                leave-from-class="opacity-100 translate-y-0"
                leave-to-class="opacity-0 -translate-y-3"
              >
                <div :key="activeService.title">
                  <h3 class="mt-5 text-3xl font-black tracking-tight text-brand-ink sm:text-4xl">
                    {{ activeService.title }}
                  </h3>

                  <p class="mt-4 text-base leading-8 text-brand-gray">
                    {{ activeService.speech }}
                  </p>
                </div>
              </Transition>

              <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                <Link :href="activeService.href" class="btn-primary">
                  Découvrir
                  <ArrowRight :size="18" />
                </Link>

                <Link href="/services" class="btn-secondary">
                  Toutes les expertises
                  <ArrowUpRight :size="18" />
                </Link>
              </div>
            </div>
          </div>

          <div class="presenter-bottom">
            <div
              v-for="(service, index) in services"
              :key="service.title"
              class="presenter-dot"
              :class="activeIndex === index ? 'presenter-dot-active' : ''"
              @click="setActiveService(index)"
            ></div>
          </div>
        </div>

        <div class="service-map">
          <button
            v-for="(service, index) in services"
            :key="service.title"
            type="button"
            class="service-card group"
            :class="[service.className, activeIndex === index ? 'service-card-active' : '']"
            @click="setActiveService(index)"
          >
            <div class="service-card-glow"></div>

            <div class="relative">
              <div class="flex items-start justify-between gap-5">
                <div class="service-icon">
                  <component :is="service.icon" :size="24" />
                </div>

                <div class="service-index">
                  0{{ index + 1 }}
                </div>
              </div>

              <div class="mt-8">
                <div class="text-xs font-black uppercase tracking-[0.18em] text-white/42">
                  {{ service.label }}
                </div>

                <h3 class="mt-2 text-2xl font-black text-white">
                  {{ service.title }}
                </h3>

                <p class="mt-4 text-sm leading-7 text-white/60">
                  {{ service.short }}
                </p>
              </div>

              <div class="mt-8 flex items-center justify-between">
                <div class="flex items-center gap-2">
                  <span
                    v-for="dot in 3"
                    :key="dot"
                    class="h-2 w-2 rounded-full"
                    :class="activeIndex === index && dot === 2 ? 'bg-brand-orange' : 'bg-white/18'"
                  ></span>
                </div>

                <ChevronRight
                  :size="20"
                  class="text-white/35 transition group-hover:translate-x-1 group-hover:text-brand-orange"
                />
              </div>
            </div>
          </button>
        </div>
      </div>

      <div class="mt-10 grid gap-4 md:grid-cols-3">
        <div class="service-proof">
          <BadgeCheck :size="22" class="text-brand-emerald" />
          <div>
            <div class="font-black text-white">Approche intégrée</div>
            <div class="mt-1 text-sm text-white/55">Stratégie, image, contenu et diffusion connectés.</div>
          </div>
        </div>

        <div class="service-proof">
          <Wand2 :size="22" class="text-brand-emerald" />
          <div>
            <div class="font-black text-white">Direction créative</div>
            <div class="mt-1 text-sm text-white/55">Une identité visuelle pensée pour durer.</div>
          </div>
        </div>

        <div class="service-proof">
          <Zap :size="22" class="text-brand-emerald" />
          <div>
            <div class="font-black text-white">Déploiement dynamique</div>
            <div class="mt-1 text-sm text-white/55">Des actions cohérentes sur les bons canaux.</div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.service-logo-float {
  position: absolute;
  animation: serviceLogoFloat 18s ease-in-out infinite;
}

.service-logo-float-slow {
  animation-duration: 24s;
}

.service-logo-float-reverse {
  animation-direction: reverse;
}

.service-presenter {
  position: relative;
  min-height: 640px;
  overflow: hidden;
  border-radius: 2.25rem;
  border: 1px solid rgba(255, 255, 255, 0.1);
  background:
    radial-gradient(circle at top left, rgba(16, 185, 129, 0.18), transparent 34%),
    radial-gradient(circle at bottom right, rgba(249, 115, 22, 0.12), transparent 32%),
    rgba(255, 255, 255, 0.055);
  padding: clamp(1rem, 2vw, 2rem);
  backdrop-filter: blur(18px);
  box-shadow: 0 30px 90px rgba(0, 0, 0, 0.22);
}

.presenter-stage {
  position: relative;
  z-index: 5;
  display: grid;
  min-height: 540px;
  grid-template-columns: minmax(180px, 0.72fr) minmax(0, 1.28fr);
  align-items: center;
  gap: clamp(1rem, 2vw, 2rem);
}

.presenter-avatar-wrap {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 360px;
}

.presenter-aura {
  position: absolute;
  height: 220px;
  width: 220px;
  border-radius: 999px;
  background:
    radial-gradient(circle, rgba(16, 185, 129, 0.34), rgba(30, 58, 138, 0.18), transparent 70%);
  filter: blur(12px);
  animation: auraPulse 3.5s ease-in-out infinite;
}

.presenter-avatar {
  position: relative;
  z-index: 2;
  width: 170px;
  height: 240px;
  animation: avatarFloat 5.4s ease-in-out infinite;
}

.avatar-ring {
  position: absolute;
  left: 50%;
  top: 0;
  width: 150px;
  height: 150px;
  transform: translateX(-50%);
  border-radius: 999px;
  border: 1px dashed rgba(16, 185, 129, 0.55);
  animation: spinSlow 12s linear infinite;
}

.avatar-head {
  position: absolute;
  left: 50%;
  top: 38px;
  z-index: 4;
  display: flex;
  width: 78px;
  height: 78px;
  transform: translateX(-50%);
  align-items: center;
  justify-content: center;
  gap: 0.65rem;
  border-radius: 999px;
  background: linear-gradient(180deg, #ffffff, #dbeafe);
  box-shadow: 0 18px 45px rgba(15, 23, 42, 0.24);
}

.avatar-eye {
  width: 7px;
  height: 7px;
  margin-top: -8px;
  border-radius: 999px;
  background: #1E3A8A;
}

.avatar-mouth {
  position: absolute;
  bottom: 20px;
  width: 24px;
  height: 10px;
  border-bottom: 3px solid #10B981;
  border-radius: 0 0 999px 999px;
}

.avatar-body {
  position: absolute;
  left: 50%;
  top: 122px;
  z-index: 3;
  width: 118px;
  height: 94px;
  transform: translateX(-50%);
  border-radius: 2rem;
  background:
    radial-gradient(circle at top left, rgba(255,255,255,0.22), transparent 36%),
    linear-gradient(135deg, #1E3A8A, #10B981);
  box-shadow: 0 25px 65px rgba(15, 23, 42, 0.32);
}

.avatar-logo {
  position: absolute;
  right: -8px;
  top: -10px;
  display: flex;
  height: 38px;
  width: 38px;
  align-items: center;
  justify-content: center;
  border-radius: 999px;
  background: #ffffff;
  box-shadow: 0 12px 30px rgba(15, 23, 42, 0.18);
}

.avatar-light {
  position: absolute;
  left: 22px;
  top: 28px;
  width: 72px;
  height: 10px;
  border-radius: 999px;
  background: rgba(255,255,255,0.18);
}

.avatar-arm {
  position: absolute;
  top: 130px;
  z-index: 2;
  width: 20px;
  height: 78px;
  border-radius: 999px;
  background: linear-gradient(180deg, #10B981, #1E3A8A);
  box-shadow: 0 15px 35px rgba(15, 23, 42, 0.18);
}

.avatar-arm-left {
  left: 16px;
  transform-origin: top;
  transform: rotate(28deg);
  animation: armLeft 3.2s ease-in-out infinite;
}

.avatar-arm-right {
  right: 16px;
  transform-origin: top;
  transform: rotate(-28deg);
  animation: armRight 3.2s ease-in-out infinite;
}

.service-bubble {
  position: relative;
  border-radius: 2rem;
  background: linear-gradient(180deg, #ffffff, #f8fafc);
  padding: clamp(1.25rem, 2vw, 2rem);
  color: #111827;
  box-shadow: 0 24px 70px rgba(15, 23, 42, 0.18);
}

.service-bubble::before {
  content: '';
  position: absolute;
  left: -10px;
  top: 76px;
  width: 22px;
  height: 22px;
  transform: rotate(45deg);
  background: #ffffff;
}

.presenter-orbit {
  position: absolute;
  border-radius: 999px;
  border: 1px solid rgba(255,255,255,0.08);
  pointer-events: none;
}

.presenter-orbit-one {
  left: 4%;
  top: 8%;
  width: 320px;
  height: 320px;
  animation: orbitRotate 24s linear infinite;
}

.presenter-orbit-two {
  right: -10%;
  top: 8%;
  width: 420px;
  height: 420px;
  animation: orbitRotate 32s linear infinite reverse;
}

.presenter-orbit-three {
  left: 18%;
  bottom: -18%;
  width: 520px;
  height: 520px;
  animation: orbitRotate 38s linear infinite;
}

.presenter-bottom {
  position: relative;
  z-index: 8;
  display: flex;
  justify-content: center;
  gap: 0.6rem;
}

.presenter-dot {
  width: 10px;
  height: 10px;
  cursor: pointer;
  border-radius: 999px;
  background: rgba(255,255,255,0.22);
  transition: 0.25s ease;
}

.presenter-dot-active {
  width: 34px;
  background: #F97316;
}

.service-map {
  display: grid;
  gap: 1rem;
  grid-template-columns: repeat(2, minmax(0, 1fr));
}

.service-card {
  position: relative;
  min-height: 290px;
  overflow: hidden;
  border-radius: 2rem;
  border: 1px solid rgba(255,255,255,0.1);
  background: rgba(255,255,255,0.055);
  padding: clamp(1.15rem, 1.6vw, 1.5rem);
  text-align: left;
  backdrop-filter: blur(18px);
  transition: transform 0.3s ease, border-color 0.3s ease, background 0.3s ease, box-shadow 0.3s ease;
}

.service-card:hover,
.service-card-active {
  transform: translateY(-8px);
  border-color: rgba(16,185,129,0.42);
  background: rgba(255,255,255,0.09);
  box-shadow: 0 28px 80px rgba(0,0,0,0.2);
}

.service-card-glow {
  position: absolute;
  right: -35px;
  top: -35px;
  width: 160px;
  height: 160px;
  border-radius: 2rem;
  filter: blur(28px);
  opacity: 0.75;
}

.service-blue .service-card-glow {
  background: rgba(30, 58, 138, 0.28);
}

.service-emerald .service-card-glow {
  background: rgba(16, 185, 129, 0.24);
}

.service-orange .service-card-glow {
  background: rgba(249, 115, 22, 0.22);
}

.service-mint .service-card-glow {
  background: rgba(16, 185, 129, 0.2);
}

.service-sun .service-card-glow {
  background: rgba(249, 115, 22, 0.22);
}

.service-deep .service-card-glow {
  background: rgba(30, 58, 138, 0.24);
}

.service-icon {
  display: flex;
  height: 56px;
  width: 56px;
  align-items: center;
  justify-content: center;
  border-radius: 1.25rem;
  color: white;
  box-shadow: 0 18px 45px rgba(15, 23, 42, 0.22);
}

.service-blue .service-icon {
  background: linear-gradient(135deg, #1E3A8A, #10B981);
}

.service-emerald .service-icon {
  background: linear-gradient(135deg, #10B981, #F97316);
}

.service-orange .service-icon {
  background: linear-gradient(135deg, #1E3A8A, #F97316);
}

.service-mint .service-icon {
  background: linear-gradient(135deg, #10B981, #1E3A8A);
}

.service-sun .service-icon {
  background: linear-gradient(135deg, #F97316, #10B981);
}

.service-deep .service-icon {
  background: linear-gradient(135deg, #1E3A8A, #10B981);
}

.service-index {
  font-size: 0.8rem;
  font-weight: 900;
  letter-spacing: 0.18em;
  color: rgba(255,255,255,0.3);
}

.service-proof {
  display: flex;
  gap: 1rem;
  align-items: flex-start;
  border-radius: 1.5rem;
  border: 1px solid rgba(255,255,255,0.1);
  background: rgba(255,255,255,0.06);
  padding: 1.25rem;
  backdrop-filter: blur(14px);
}

@keyframes serviceLogoFloat {
  0%, 100% {
    transform: translate3d(0, 0, 0) rotate(0deg);
  }

  50% {
    transform: translate3d(18px, -20px, 0) rotate(4deg);
  }
}

@keyframes auraPulse {
  0%, 100% {
    transform: scale(1);
    opacity: 0.8;
  }

  50% {
    transform: scale(1.08);
    opacity: 1;
  }
}

@keyframes avatarFloat {
  0%, 100% {
    transform: translateY(0);
  }

  50% {
    transform: translateY(-14px);
  }
}

@keyframes spinSlow {
  to {
    transform: translateX(-50%) rotate(360deg);
  }
}

@keyframes armLeft {
  0%, 100% {
    transform: rotate(28deg);
  }

  50% {
    transform: rotate(10deg);
  }
}

@keyframes armRight {
  0%, 100% {
    transform: rotate(-28deg);
  }

  50% {
    transform: rotate(-8deg);
  }
}

@keyframes orbitRotate {
  to {
    transform: rotate(360deg);
  }
}

@media (max-width: 1280px) {
  .service-map {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }

  .service-card {
    min-height: 270px;
  }

  .presenter-stage {
    grid-template-columns: 1fr;
  }

  .service-bubble::before {
    display: none;
  }
}

@media (max-width: 1024px) {
  .service-presenter {
    min-height: auto;
  }

  .presenter-stage {
    min-height: auto;
  }

  .service-map {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }
}

@media (max-width: 720px) {
  .service-map {
    grid-template-columns: 1fr;
  }

  .service-card {
    min-height: auto;
  }

  .presenter-avatar {
    transform: scale(0.9);
  }

  .service-presenter {
    border-radius: 1.5rem;
  }

  .service-bubble {
    border-radius: 1.5rem;
  }
}

@media (prefers-reduced-motion: reduce) {
  .service-logo-float,
  .presenter-aura,
  .presenter-avatar,
  .avatar-ring,
  .avatar-arm,
  .presenter-orbit {
    animation: none !important;
  }
}
</style>
