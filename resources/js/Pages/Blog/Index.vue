<template>
  <GuestLayout>
    <Head title="Blog - KOTAVA Communication" />

    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-br from-[#0e437d] via-[#1c978a] to-[#22ae84] overflow-hidden">
      <div class="absolute inset-0 opacity-20">
        <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
      </div>

      <div class="relative max-w-6xl mx-auto px-6 text-center">
        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
          Notre <span class="bg-gradient-to-r from-[#22ae84] to-[#1c978a] bg-clip-text text-transparent">Blog</span>
        </h1>
        <p class="text-xl text-white/90 max-w-3xl mx-auto">
          Découvrez nos insights, tendances digitales et conseils experts en communication
        </p>
      </div>
    </section>

    <!-- Articles Section -->
    <section class="py-16 bg-white">
      <div class="max-w-6xl mx-auto px-6">
        <div v-if="actualites && actualites.length > 0" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <article
            v-for="article in actualites"
            :key="article.id"
            class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:scale-105 overflow-hidden border border-gray-100"
          >
            <!-- Image de l'article -->
            <div class="h-56 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
              <img
                v-if="article.image"
                :src="article.image"
                :alt="article.title"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
              />
              <div v-else class="w-full h-full flex items-center justify-center">
                <div class="text-center">
                  <div class="w-12 h-12 bg-gradient-to-br from-[#0e437d] to-[#22ae84] rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                  </div>
                  <div class="text-gray-500 text-sm">Image à venir</div>
                </div>
              </div>
            </div>

            <!-- Contenu de l'article -->
            <div class="p-6">
              <div class="flex items-center gap-2 mb-3">
                <span class="text-sm font-semibold text-[#22ae84]">{{ formatDate(article.date_publication) }}</span>
                <span class="text-gray-400">•</span>
                <span class="text-sm text-gray-500">{{ article.category || 'Article' }}</span>
              </div>

              <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#0e437d] transition-colors">
                {{ article.title }}
              </h3>

              <p class="text-gray-600 mb-4 line-clamp-2">
                {{ article.extrait || article.content?.substring(0, 120) + '...' }}
              </p>

              <div class="flex items-center justify-between">
                <Link
                  :href="`/blog/${article.slug || article.id}`"
                  class="inline-flex items-center gap-2 text-[#0e437d] font-semibold hover:gap-3 transition-all"
                >
                  Lire la suite
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                  </svg>
                </Link>

                <span v-if="article.featured" class="px-3 py-1 bg-gradient-to-r from-[#0e437d]/10 to-[#22ae84]/10 text-[#0e437d] text-xs font-semibold rounded-full">
                  En vedette
                </span>
              </div>
            </div>
          </article>
        </div>

        <!-- État vide -->
        <div v-else class="text-center py-16">
          <div class="w-24 h-24 bg-gradient-to-br from-[#0e437d]/10 to-[#22ae84]/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
            <svg class="w-12 h-12 text-[#0e437d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-4">Articles à venir</h3>
          <p class="text-gray-600 max-w-md mx-auto mb-6">
            Notre équipe prépare actuellement des articles passionnants sur la communication digitale.
            Revenez bientôt pour découvrir nos insights !
          </p>
          <div class="inline-flex items-center gap-2 text-[#0e437d] font-semibold">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Prochain article: Janvier 2024
          </div>
        </div>

        <!-- Pagination (si vous en avez) -->
        <div v-if="actualites && actualites.length > 0" class="mt-12 flex justify-center">
          <div class="flex gap-2">
            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
              Précédent
            </button>
            <button class="px-4 py-2 bg-gradient-to-r from-[#0e437d] to-[#22ae84] text-white rounded-lg">
              1
            </button>
            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
              Suivant
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-16 bg-gradient-to-br from-gray-50 to-white">
      <div class="max-w-4xl mx-auto px-6 text-center">
        <h3 class="text-3xl font-bold text-gray-900 mb-4">Restez informé</h3>
        <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
          Inscrivez-vous à notre newsletter pour recevoir nos derniers articles et conseils en communication digitale
        </p>

        <form class="max-w-md mx-auto">
          <div class="flex gap-3">
            <input
              type="email"
              placeholder="Votre email"
              class="flex-1 px-4 py-3 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#22ae84] focus:border-transparent outline-none transition-all"
            />
            <button
              type="submit"
              class="px-6 py-3 bg-gradient-to-r from-[#0e437d] to-[#22ae84] text-white font-semibold rounded-xl hover:shadow-lg transition-all"
            >
              S'inscrire
            </button>
          </div>
        </form>
      </div>
    </section>
  </GuestLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

// Props depuis Laravel controller
defineProps({
  actualites: {
    type: Array,
    default: () => []
  }
});

// Format date
const formatDate = (dateString) => {
  if (!dateString) return 'Date non spécifiée';

  const date = new Date(dateString);
  return date.toLocaleDateString('fr-FR', {
    day: 'numeric',
    month: 'long',
    year: 'numeric'
  });
};
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
