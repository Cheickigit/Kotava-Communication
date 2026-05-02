<script setup>
import { Link } from '@inertiajs/vue3';
import { ArrowRight, BookOpen } from 'lucide-vue-next';

defineProps({
  actualites: {
    type: Array,
    default: () => [],
  },
});
</script>

<template>
  <section class="relative overflow-hidden bg-slate-50 py-20">
    <div class="site-container">
      <div class="mb-10 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
        <div>
          <div class="eyebrow">
            <BookOpen :size="15" />
            Actualités
          </div>

          <h2 class="section-title mt-5 max-w-3xl">
            Publications dynamiques de KOTAVA Communication.
          </h2>
        </div>

        <Link href="/blog" class="btn-secondary">
          Voir le blog
          <ArrowRight :size="18" />
        </Link>
      </div>

      <div v-if="actualites.length" class="grid gap-5 lg:grid-cols-3">
        <Link
          v-for="article in actualites.slice(0, 3)"
          :key="article.id"
          :href="`/blog/${article.slug}`"
          class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-soft"
        >
          <div class="relative h-56 overflow-hidden bg-brand-light">
            <img
              v-if="article.image"
              :src="article.image"
              :alt="article.titre"
              class="h-full w-full object-cover"
            />
            <div v-else class="flex h-full items-center justify-center">
              <BookOpen :size="42" class="text-brand-blue/35" />
            </div>
          </div>

          <div class="p-6">
            <h3 class="text-xl font-black text-brand-ink">{{ article.titre }}</h3>
            <p class="mt-3 line-clamp-2 text-sm leading-7 text-brand-gray">{{ article.extrait }}</p>
          </div>
        </Link>
      </div>
    </div>
  </section>
</template>
