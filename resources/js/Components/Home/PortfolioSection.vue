<script setup>
import { Link } from '@inertiajs/vue3';
import { ArrowRight, Camera } from 'lucide-vue-next';

defineProps({
  realisations: {
    type: Array,
    default: () => [],
  },
});
</script>

<template>
  <section class="relative overflow-hidden bg-white py-20">
    <div class="site-container">
      <div class="mb-10 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
        <div>
          <div class="eyebrow">
            <Camera :size="15" />
            Réalisations
          </div>

          <h2 class="section-title mt-5 max-w-3xl">
            Projets dynamiques publiés depuis l’administration.
          </h2>
        </div>

        <Link href="/portfolio" class="btn-dark">
          Voir le portfolio
          <ArrowRight :size="18" />
        </Link>
      </div>

      <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
        <Link
          v-for="project in realisations.slice(0, 6)"
          :key="project.id"
          :href="`/portfolio/${project.slug}`"
          class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-soft"
        >
          <div class="relative h-72 overflow-hidden bg-brand-dark">
            <img
              v-if="project.image"
              :src="project.image"
              :alt="project.titre"
              class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
            />
            <div v-else class="flex h-full items-center justify-center bg-brand-radial-dark">
              <Camera :size="48" class="text-white/40" />
            </div>
          </div>

          <div class="p-6">
            <h3 class="text-xl font-black text-brand-ink">{{ project.titre }}</h3>
            <p class="mt-3 line-clamp-2 text-sm leading-7 text-brand-gray">{{ project.description }}</p>
          </div>
        </Link>
      </div>
    </div>
  </section>
</template>
