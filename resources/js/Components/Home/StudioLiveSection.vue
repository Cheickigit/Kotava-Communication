<script setup>
import { computed, ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import {
  ArrowRight,
  BadgeCheck,
  BrainCircuit,
  Camera,
  Clapperboard,
  Code2,
  Layers3,
  Lightbulb,
  Megaphone,
  Palette,
  PenTool,
  Play,
  Radio,
  Sparkles,
  Target,
  Video,
  Wand2,
  Zap,
} from 'lucide-vue-next';

const activeModule = ref(0);

const modules = [
  {
    icon: BrainCircuit,
    title: 'Brief',
    label: 'Analyse',
    text: 'Comprendre le contexte.',
    color: 'bg-brand-blue',
    soft: 'bg-brand-blue/15 text-brand-blue',
    glow: 'bg-brand-blue/25',
    position: 'left-[4%] top-[18%]',
  },
  {
    icon: Lightbulb,
    title: 'Concept',
    label: 'Idée',
    text: 'Trouver l’angle créatif.',
    color: 'bg-brand-emerald',
    soft: 'bg-brand-emerald/15 text-brand-emerald',
    glow: 'bg-brand-emerald/25',
    position: 'right-[5%] top-[16%]',
  },
  {
    icon: Palette,
    title: 'Design',
    label: 'Identité',
    text: 'Créer l’univers visuel.',
    color: 'bg-brand-orange',
    soft: 'bg-brand-orange/15 text-brand-orange',
    glow: 'bg-brand-orange/25',
    position: 'left-[7%] bottom-[18%]',
  },
  {
    icon: Clapperboard,
    title: 'Production',
    label: 'Contenu',
    text: 'Produire les supports.',
    color: 'bg-brand-blue',
    soft: 'bg-brand-blue/15 text-brand-blue',
    glow: 'bg-brand-blue/25',
    position: 'right-[7%] bottom-[17%]',
  },
  {
    icon: Megaphone,
    title: 'Diffusion',
    label: 'Activation',
    text: 'Déployer avec impact.',
    color: 'bg-brand-emerald',
    soft: 'bg-brand-emerald/15 text-brand-emerald',
    glow: 'bg-brand-emerald/25',
    position: 'left-1/2 top-[3%] -translate-x-1/2',
  },
];

const tools = [
  { icon: Target, label: 'Stratégie', color: 'text-brand-blue' },
  { icon: PenTool, label: 'Design', color: 'text-brand-emerald' },
  { icon: Camera, label: 'Photo', color: 'text-brand-orange' },
  { icon: Video, label: 'Vidéo', color: 'text-brand-blue' },
  { icon: Code2, label: 'Web', color: 'text-brand-emerald' },
  { icon: Radio, label: 'Campagne', color: 'text-brand-orange' },
];

const active = computed(() => modules[activeModule.value]);

const setActive = (index) => {
  activeModule.value = index;
};
</script>

<template>
  <section class="relative isolate overflow-hidden bg-brand-dark py-20 text-white sm:py-24 lg:py-28">
    <!-- Fond cohérent -->
    <div class="absolute inset-0 bg-grid-dark opacity-35"></div>

    <div class="absolute inset-0 bg-[radial-gradient(circle_at_10%_18%,rgba(16,185,129,0.18),transparent_28%),radial-gradient(circle_at_90%_76%,rgba(249,115,22,0.14),transparent_27%),radial-gradient(circle_at_50%_50%,rgba(30,58,138,0.36),transparent_35%)]"></div>

    <div class="absolute inset-x-0 top-0 h-40 bg-gradient-to-b from-brand-dark via-brand-dark/90 to-transparent"></div>
    <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-brand-dark via-brand-dark/90 to-transparent"></div>

    <div class="pointer-events-none absolute inset-0 overflow-hidden">
      <div class="absolute inset-x-0 top-[12%] hidden select-none text-center text-[12vw] font-black uppercase leading-none tracking-[-0.09em] text-white/[0.025] lg:block">
        LAB
      </div>

      <img
        src="/logo.png"
        alt=""
        class="absolute left-[5%] top-[18%] hidden h-24 w-auto opacity-[0.04] lg:block"
      />

      <img
        src="/logo.png"
        alt=""
        class="absolute right-[5%] bottom-[15%] hidden h-28 w-auto opacity-[0.035] lg:block"
      />
    </div>

    <div class="site-container relative z-10">
      <!-- Header -->
      <div class="mx-auto mb-12 max-w-3xl text-center">
        <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald backdrop-blur">
          <Sparkles :size="14" />
          Studio vivant
        </div>

        <h2 class="mt-5 text-4xl font-black leading-[0.94] tracking-[-0.055em] sm:text-5xl lg:text-6xl">
          La salle de contrôle
          <span class="block bg-gradient-to-r from-brand-emerald via-white to-brand-orange bg-clip-text text-transparent">
            créative.
          </span>
        </h2>
      </div>

      <!-- Main -->
      <div class="grid gap-6 xl:grid-cols-[1.15fr_0.85fr] xl:items-stretch">
        <!-- Creative control room -->
        <div class="relative min-h-[680px] overflow-hidden rounded-[2.5rem] border border-white/10 bg-white/[0.055] p-5 shadow-[0_35px_110px_rgba(0,0,0,0.28)] backdrop-blur-2xl">
          <div class="absolute inset-0 bg-[radial-gradient(circle_at_22%_16%,rgba(16,185,129,0.13),transparent_30%),radial-gradient(circle_at_82%_80%,rgba(249,115,22,0.12),transparent_34%)]"></div>

          <div :class="['absolute -right-24 -top-24 h-80 w-80 rounded-[5rem] blur-3xl transition-all duration-500', active.glow]"></div>
          <div class="absolute -bottom-28 -left-24 h-96 w-96 rounded-[5rem] bg-brand-blue/15 blur-3xl"></div>

          <!-- Holographic rings -->
          <div class="pointer-events-none absolute left-1/2 top-1/2 h-[560px] w-[560px] -translate-x-1/2 -translate-y-1/2 rounded-[4rem] border border-white/10 motion-safe:animate-spin [animation-duration:38s]"></div>
          <div class="pointer-events-none absolute left-1/2 top-1/2 h-[420px] w-[420px] -translate-x-1/2 -translate-y-1/2 rounded-[3rem] border border-brand-emerald/15 motion-safe:animate-spin [animation-direction:reverse] [animation-duration:28s]"></div>
          <div class="pointer-events-none absolute left-1/2 top-1/2 h-[290px] w-[290px] -translate-x-1/2 -translate-y-1/2 rounded-[2.4rem] border border-brand-orange/15 motion-safe:animate-spin [animation-duration:22s]"></div>

          <!-- Floating modules -->
          <button
            v-for="(module, index) in modules"
            :key="module.title"
            type="button"
            :class="[
              'absolute z-30 hidden w-[150px] rounded-[1.35rem] border p-3 text-left backdrop-blur-xl transition duration-300 hover:-translate-y-1 lg:block',
              module.position,
              activeModule === index
                ? 'border-white/25 bg-white/[0.14] shadow-[0_22px_60px_rgba(0,0,0,0.26)]'
                : 'border-white/10 bg-white/[0.075] hover:bg-white/[0.11]'
            ]"
            @mouseenter="setActive(index)"
            @click="setActive(index)"
          >
            <div :class="['absolute -right-8 -top-8 h-24 w-24 rounded-3xl blur-2xl', module.glow]"></div>

            <div class="relative">
              <div :class="['flex h-10 w-10 items-center justify-center rounded-2xl text-white', module.color]">
                <component :is="module.icon" :size="18" />
              </div>

              <div class="mt-3 text-[10px] font-black uppercase tracking-[0.16em] text-white/38">
                {{ module.label }}
              </div>

              <div class="mt-1 text-base font-black text-white">
                {{ module.title }}
              </div>
            </div>
          </button>

          <!-- Core 3D interface -->
          <div class="relative z-20 flex min-h-[640px] items-center justify-center">
            <div class="relative w-full max-w-[600px] [perspective:1300px]">
              <div class="relative rounded-[2.35rem] border border-white/10 bg-slate-950/90 p-5 shadow-[0_40px_120px_rgba(0,0,0,0.38)] [transform:rotateX(8deg)_rotateY(-9deg)]">
                <!-- Top bar -->
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-2">
                    <span class="h-2.5 w-2.5 rounded-md bg-brand-emerald"></span>
                    <span class="h-2.5 w-2.5 rounded-md bg-brand-orange"></span>
                    <span class="h-2.5 w-2.5 rounded-md bg-white/30"></span>
                  </div>

                  <div class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-3 py-2 text-[10px] font-black uppercase tracking-[0.18em] text-white/50">
                    <img src="/logo_horizontal.png" alt="" class="h-4 w-4 object-contain" />
                    Control Room
                  </div>
                </div>

                <!-- Active dashboard -->
                <div class="mt-5 grid gap-4 lg:grid-cols-[0.82fr_1.18fr]">
                  <div class="rounded-[1.7rem] border border-white/10 bg-white/[0.06] p-4">
                    <Transition
                      mode="out-in"
                      enter-active-class="transition duration-300 ease-out"
                      enter-from-class="opacity-0 translate-y-4"
                      enter-to-class="opacity-100 translate-y-0"
                      leave-active-class="transition duration-150 ease-in"
                      leave-from-class="opacity-100 translate-y-0"
                      leave-to-class="opacity-0 -translate-y-3"
                    >
                      <div :key="active.title">
                        <div :class="['flex h-14 w-14 items-center justify-center rounded-2xl text-white shadow-lg', active.color]">
                          <component :is="active.icon" :size="24" />
                        </div>

                        <div class="mt-8 text-[10px] font-black uppercase tracking-[0.2em] text-brand-emerald">
                          Module actif
                        </div>

                        <h3 class="mt-2 text-3xl font-black text-white">
                          {{ active.title }}
                        </h3>

                        <p class="mt-3 text-sm leading-7 text-white/55">
                          {{ active.text }}
                        </p>
                      </div>
                    </Transition>
                  </div>

                  <div class="rounded-[1.7rem] border border-white/10 bg-white/[0.06] p-4">
                    <div class="relative min-h-[270px] overflow-hidden rounded-[1.4rem] bg-gradient-to-br from-brand-blue/80 via-brand-emerald/55 to-brand-orange/70">
                      <div class="absolute inset-0 bg-[linear-gradient(135deg,rgba(255,255,255,0.20),transparent_45%)]"></div>

                      <div class="absolute left-1/2 top-1/2 flex h-24 w-24 -translate-x-1/2 -translate-y-1/2 items-center justify-center rounded-[1.8rem] bg-white text-brand-blue shadow-xl motion-safe:animate-pulse">
                        <Play :size="38" fill="currentColor" />
                      </div>

                      <div class="absolute left-5 top-5 rounded-2xl bg-slate-950/45 px-4 py-3 backdrop-blur">
                        <div class="text-[10px] font-black uppercase tracking-[0.18em] text-white/45">
                          Signal
                        </div>
                        <div class="mt-1 text-xl font-black text-white">
                          Live
                        </div>
                      </div>

                      <div class="absolute bottom-5 left-5 right-5 grid grid-cols-5 gap-2">
                        <span class="h-9 rounded-xl bg-white/80"></span>
                        <span class="h-9 rounded-xl bg-white/30"></span>
                        <span class="h-9 rounded-xl bg-white/60"></span>
                        <span class="h-9 rounded-xl bg-white/30"></span>
                        <span class="h-9 rounded-xl bg-white/80"></span>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Production tools -->
                <div class="mt-4 grid grid-cols-3 gap-3 sm:grid-cols-6">
                  <div
                    v-for="tool in tools"
                    :key="tool.label"
                    class="rounded-2xl border border-white/10 bg-white/[0.06] p-3 text-center"
                  >
                    <component :is="tool.icon" :size="18" :class="['mx-auto', tool.color]" />

                    <div class="mt-2 text-[10px] font-black uppercase tracking-[0.14em] text-white/42">
                      {{ tool.label }}
                    </div>
                  </div>
                </div>

                <!-- Progress signal -->
                <div class="mt-4 grid grid-cols-5 gap-2">
                  <button
                    v-for="(_, index) in modules"
                    :key="index"
                    type="button"
                    :class="[
                      'h-2 rounded-full transition-all duration-300',
                      activeModule === index
                        ? 'bg-brand-orange'
                        : 'bg-white/12 hover:bg-white/25'
                    ]"
                    @click="setActive(index)"
                  ></button>
                </div>
              </div>

              <div class="mx-auto mt-[-1.5rem] h-14 w-[84%] rounded-[50%] bg-slate-950/35 blur-2xl"></div>
            </div>
          </div>
        </div>

        <!-- Side command panel -->
        <div class="grid content-center gap-4">
          <button
            v-for="(module, index) in modules"
            :key="module.title"
            type="button"
            :class="[
              'group relative overflow-hidden rounded-[1.8rem] border p-5 text-left backdrop-blur-xl transition duration-300 hover:-translate-y-1',
              activeModule === index
                ? 'border-brand-orange/45 bg-white/[0.12] shadow-[0_24px_70px_rgba(0,0,0,0.22)]'
                : 'border-white/10 bg-white/[0.06] hover:border-white/20 hover:bg-white/[0.09]'
            ]"
            @mouseenter="setActive(index)"
            @click="setActive(index)"
          >
            <div :class="['absolute -right-10 -top-10 h-32 w-32 rounded-[2.5rem] blur-3xl', module.glow]"></div>

            <div class="relative flex items-center gap-4">
              <div :class="['flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl text-white shadow-lg', module.color]">
                <component :is="module.icon" :size="22" />
              </div>

              <div class="min-w-0 flex-1">
                <div class="flex items-center justify-between gap-4">
                  <div class="text-[11px] font-black uppercase tracking-[0.18em] text-white/45">
                    {{ module.label }}
                  </div>

                  <div class="text-[10px] font-black uppercase tracking-[0.18em] text-white/35">
                    0{{ index + 1 }}
                  </div>
                </div>

                <h3 class="mt-2 text-2xl font-black text-white">
                  {{ module.title }}
                </h3>

                <p class="mt-1 text-sm leading-6 text-white/55">
                  {{ module.text }}
                </p>
              </div>
            </div>
          </button>

          <!-- CTA -->
          <div class="rounded-[1.9rem] border border-white/10 bg-white/[0.06] p-5 backdrop-blur-xl">
            <div class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-3 py-2 text-[11px] font-black uppercase tracking-[0.16em] text-brand-emerald">
              <Wand2 :size="14" />
              Méthode KOTAVA
            </div>

            <p class="mt-4 text-sm leading-7 text-white/60">
              Un process créatif lisible : comprendre, concevoir, produire, activer.
            </p>

            <Link
              href="/contact"
              class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-[1.15rem] bg-white px-5 py-3 text-sm font-black text-brand-blue transition hover:-translate-y-0.5"
            >
              Créer avec nous
              <ArrowRight :size="18" />
            </Link>
          </div>
        </div>
      </div>

      <!-- Bottom proof -->
      <div class="mt-10 grid gap-4 md:grid-cols-3">
        <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.06] p-5 backdrop-blur-xl">
          <BadgeCheck :size="22" class="text-brand-emerald" />
          <div class="mt-3 font-black text-white">Process maîtrisé</div>
        </div>

        <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.06] p-5 backdrop-blur-xl">
          <Layers3 :size="22" class="text-brand-blue" />
          <div class="mt-3 font-black text-white">Studio 360°</div>
        </div>

        <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.06] p-5 backdrop-blur-xl">
          <Zap :size="22" class="text-brand-orange" />
          <div class="mt-3 font-black text-white">Activation rapide</div>
        </div>
      </div>
    </div>
  </section>
</template>
