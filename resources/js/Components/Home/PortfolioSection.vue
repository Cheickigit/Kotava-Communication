<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import {
  ArrowRight,
  ArrowUpRight,
  BadgeCheck,
  Camera,
  Layers3,
  Play,
  Sparkles,
} from 'lucide-vue-next';

const props = defineProps({
  realisations: {
    type: Array,
    default: () => [],
  },
});

const projects = computed(() => props.realisations.slice(0, 6));
const featuredProject = computed(() => projects.value[0] || null);
const secondaryProjects = computed(() => projects.value.slice(1, 6));

const projectHref = (project) => {
  if (!project?.slug) {
    return '/portfolio';
  }

  return `/portfolio/${project.slug}`;
};
</script>

<template>
  <section class="relative isolate overflow-hidden bg-brand-dark py-20 text-white sm:py-24 lg:py-28">
    <!-- Background cohérent avec le site -->
    <div class="absolute inset-0 bg-grid-dark opacity-35"></div>

    <div class="absolute inset-0 bg-[radial-gradient(circle_at_8%_20%,rgba(16,185,129,0.17),transparent_28%),radial-gradient(circle_at_92%_72%,rgba(249,115,22,0.14),transparent_28%),radial-gradient(circle_at_50%_45%,rgba(30,58,138,0.34),transparent_34%)]"></div>

    <div class="absolute inset-x-0 top-0 h-40 bg-gradient-to-b from-brand-dark via-brand-dark/90 to-transparent"></div>
    <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-brand-dark via-brand-dark/90 to-transparent"></div>

    <div class="pointer-events-none absolute inset-0 overflow-hidden">
      <div class="absolute inset-x-0 top-[11%] hidden select-none text-center text-[12vw] font-black uppercase leading-none tracking-[-0.09em] text-white/[0.025] lg:block">
        WORKS
      </div>

      <img
        src="/logo.png"
        alt=""
        class="absolute left-[5%] top-[18%] hidden h-24 w-auto opacity-[0.04] lg:block"
      />

      <img
        src="/logo.png"
        alt=""
        class="absolute right-[5%] bottom-[16%] hidden h-28 w-auto opacity-[0.035] lg:block"
      />
    </div>

    <div class="site-container relative z-10">
      <!-- Header -->
      <div class="mb-12 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
        <div class="max-w-3xl">
          <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald backdrop-blur">
            <Camera :size="15" />
            Réalisations
          </div>

          <h2 class="mt-5 text-4xl font-black leading-[0.94] tracking-[-0.055em] sm:text-5xl lg:text-6xl">
            Nos projets
            <span class="block bg-gradient-to-r from-brand-emerald via-white to-brand-orange bg-clip-text text-transparent">
              en images.
            </span>
          </h2>
        </div>

        <Link href="/portfolio" class="btn-light">
          Voir le portfolio
          <ArrowRight :size="18" />
        </Link>
      </div>

      <!-- Portfolio dynamique -->
      <div v-if="projects.length" class="grid gap-5 xl:grid-cols-[1.15fr_0.85fr] xl:items-stretch">
        <!-- Projet principal -->
        <Link
          v-if="featuredProject"
          :href="projectHref(featuredProject)"
          class="group relative min-h-[560px] overflow-hidden rounded-[2.4rem] border border-white/10 bg-white/[0.06] shadow-[0_35px_110px_rgba(0,0,0,0.28)] backdrop-blur-2xl"
        >
          <div class="absolute inset-0">
            <img
              v-if="featuredProject.image"
              :src="featuredProject.image"
              :alt="featuredProject.titre"
              class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
            />

            <div
              v-else
              class="flex h-full w-full items-center justify-center bg-[radial-gradient(circle_at_50%_45%,rgba(16,185,129,0.20),rgba(30,58,138,0.50),rgba(15,23,42,1))]"
            >
              <Camera :size="76" class="text-white/30" />
            </div>
          </div>

          <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/35 to-transparent"></div>
          <div class="absolute inset-0 bg-gradient-to-r from-slate-950/65 via-transparent to-transparent"></div>

          <!-- Floating labels -->
          <div class="absolute left-6 top-6 flex flex-wrap gap-3">
            <span class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/15 px-4 py-2 text-[11px] font-black uppercase tracking-[0.18em] text-white backdrop-blur-xl">
              <Sparkles :size="14" class="text-brand-emerald" />
              Projet sélectionné
            </span>

            <span class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-slate-950/35 px-4 py-2 text-[11px] font-black uppercase tracking-[0.18em] text-white/70 backdrop-blur-xl">
              01
            </span>
          </div>

          <!-- Play / preview -->
          <div class="absolute right-6 top-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-brand-blue shadow-xl transition group-hover:scale-105">
            <Play :size="24" fill="currentColor" />
          </div>

          <!-- Content -->
          <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-8">
            <div class="max-w-2xl">
              <div class="inline-flex items-center gap-2 rounded-xl bg-brand-emerald px-3 py-2 text-[10px] font-black uppercase tracking-[0.18em] text-white">
                <BadgeCheck :size="14" />
                Réalisation KOTAVA
              </div>

              <h3 class="mt-4 text-3xl font-black leading-tight tracking-[-0.04em] text-white sm:text-4xl lg:text-5xl">
                {{ featuredProject.titre }}
              </h3>

              <p
                v-if="featuredProject.description"
                class="mt-4 max-w-xl line-clamp-2 text-sm leading-7 text-white/65 sm:text-base"
              >
                {{ featuredProject.description }}
              </p>

              <div class="mt-6 inline-flex items-center gap-2 text-sm font-black text-brand-orange">
                Voir le projet
                <ArrowUpRight :size="18" class="transition group-hover:translate-x-1 group-hover:-translate-y-1" />
              </div>
            </div>
          </div>
        </Link>

        <!-- Galerie secondaire -->
        <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-1">
          <Link
            v-for="(project, index) in secondaryProjects"
            :key="project.id"
            :href="projectHref(project)"
            class="group relative min-h-[170px] overflow-hidden rounded-[1.8rem] border border-white/10 bg-white/[0.06] p-3 backdrop-blur-xl transition duration-300 hover:-translate-y-1 hover:bg-white/[0.09]"
          >
            <div class="grid h-full gap-4 sm:grid-cols-[0.95fr_1.05fr] xl:grid-cols-[0.82fr_1.18fr]">
              <div class="relative min-h-[150px] overflow-hidden rounded-[1.35rem] bg-slate-950">
                <img
                  v-if="project.image"
                  :src="project.image"
                  :alt="project.titre"
                  class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                />

                <div
                  v-else
                  class="flex h-full w-full items-center justify-center bg-[radial-gradient(circle_at_50%_45%,rgba(16,185,129,0.18),rgba(30,58,138,0.42),rgba(15,23,42,1))]"
                >
                  <Camera :size="34" class="text-white/35" />
                </div>

                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/55 to-transparent"></div>
              </div>

              <div class="flex min-w-0 flex-col justify-between p-1">
                <div>
                  <div class="flex items-center justify-between gap-3">
                    <span class="rounded-xl bg-white/10 px-3 py-1.5 text-[10px] font-black uppercase tracking-[0.16em] text-white/45">
                      0{{ index + 2 }}
                    </span>

                    <ArrowUpRight
                      :size="18"
                      class="text-white/35 transition group-hover:translate-x-1 group-hover:-translate-y-1 group-hover:text-brand-orange"
                    />
                  </div>

                  <h3 class="mt-4 line-clamp-2 text-xl font-black leading-tight text-white">
                    {{ project.titre }}
                  </h3>

                  <p
                    v-if="project.description"
                    class="mt-2 line-clamp-2 text-sm leading-6 text-white/55"
                  >
                    {{ project.description }}
                  </p>
                </div>

                <div class="mt-4 flex items-center gap-2 text-[11px] font-black uppercase tracking-[0.16em] text-brand-emerald">
                  <Layers3 :size="14" />
                  Projet publié
                </div>
              </div>
            </div>
          </Link>
        </div>
      </div>

      <!-- État vide propre -->
      <div
        v-else
        class="relative overflow-hidden rounded-[2.4rem] border border-white/10 bg-white/[0.06] p-8 text-center shadow-[0_35px_110px_rgba(0,0,0,0.25)] backdrop-blur-2xl"
      >
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_20%,rgba(16,185,129,0.14),transparent_34%),radial-gradient(circle_at_80%_80%,rgba(249,115,22,0.12),transparent_32%)]"></div>

        <div class="relative mx-auto max-w-2xl">
          <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-[1.7rem] bg-white/10 text-brand-emerald">
            <Camera :size="36" />
          </div>

          <h3 class="mt-6 text-3xl font-black text-white">
            Les réalisations arrivent bientôt.
          </h3>

          <p class="mt-3 text-sm leading-7 text-white/60">
            Les projets publiés depuis l’administration apparaîtront automatiquement ici.
          </p>

          <Link href="/portfolio" class="btn-light mt-7">
            Voir le portfolio
            <ArrowRight :size="18" />
          </Link>
        </div>
      </div>
    </div>
  </section>
</template>
