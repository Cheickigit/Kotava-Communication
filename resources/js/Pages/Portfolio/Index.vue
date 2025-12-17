<template>
  <GuestLayout>
    <Head title="Portfolio - KOTAVA Communication" />

    <!-- Hero Section Portfolio -->
    <section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden bg-gradient-to-br from-[#0e437d] via-[#1c978a] to-[#22ae84]">
      <!-- Animated Background -->
      <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-1/2 -left-1/2 w-full h-full bg-gradient-to-br from-[#22ae84]/30 to-transparent rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-1/2 -right-1/2 w-full h-full bg-gradient-to-tl from-[#0e437d]/30 to-transparent rounded-full blur-3xl animate-pulse delay-1000"></div>
      </div>

      <!-- Glass Card Hero -->
      <div class="relative z-10 max-w-6xl mx-auto px-6 py-20 text-center">
        <div class="backdrop-blur-lg bg-white/10 rounded-3xl p-12 shadow-2xl border border-white/20">
          <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-6 py-2 rounded-full text-white mb-8">
            <Sparkles :size="20" class="text-[#22ae84]" />
            <span class="text-sm font-semibold">Notre Galerie d'Excellence</span>
          </div>

          <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 leading-tight">
            Portfolio
            <span class="block bg-gradient-to-r from-[#22ae84] to-[#1c978a] bg-clip-text text-transparent">
              KOTAVA
            </span>
          </h1>

          <p class="text-xl md:text-2xl text-white/90 mb-10 max-w-3xl mx-auto leading-relaxed">
            Découvrez nos réalisations qui transforment les idées en expériences digitales mémorables.
            Chaque projet raconte une histoire d'innovation et de succès.
          </p>

          <!-- Filter Tabs -->
          <div class="flex flex-wrap gap-3 justify-center mb-8">
            <button
              v-for="filter in filters"
              :key="filter.id"
              @click="activeFilter = filter.id"
              :class="[
                'px-6 py-3 rounded-xl font-medium transition-all duration-300',
                activeFilter === filter.id
                  ? 'bg-white text-[#0e437d] shadow-lg'
                  : 'bg-white/10 text-white hover:bg-white/20 backdrop-blur-sm'
              ]"
            >
              {{ filter.label }}
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Portfolio Grid Section -->
    <section class="py-24 bg-white">
      <div class="max-w-7xl mx-auto px-6">
        <!-- Portfolio Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-16">
          <div class="glass-card p-6 rounded-2xl text-center">
            <div class="text-4xl font-bold text-[#0e437d] mb-2">{{ stats.totalProjects || 0 }}</div>
            <div class="text-gray-600 text-sm">Projets Réalisés</div>
          </div>
          <div class="glass-card p-6 rounded-2xl text-center">
            <div class="text-4xl font-bold text-[#22ae84] mb-2">{{ stats.totalClients || 0 }}</div>
            <div class="text-gray-600 text-sm">Clients Satisfaits</div>
          </div>
          <div class="glass-card p-6 rounded-2xl text-center">
            <div class="text-4xl font-bold text-[#1c978a] mb-2">{{ stats.ongoingProjects || 0 }}</div>
            <div class="text-gray-600 text-sm">Projets en Cours</div>
          </div>
          <div class="glass-card p-6 rounded-2xl text-center">
            <div class="text-4xl font-bold text-[#178e8b] mb-2">{{ stats.successRate || 100 }}%</div>
            <div class="text-gray-600 text-sm">Taux de Réussite</div>
          </div>
        </div>

        <!-- Portfolio Grid -->
        <div v-if="realisations && realisations.length > 0" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div
            v-for="realisation in filteredRealisations"
            :key="realisation.id"
            class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:scale-105"
          >
            <!-- Project Image/Placeholder -->
            <div class="relative h-80 overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
              <img
                v-if="realisation.image"
                :src="realisation.image"
                :alt="realisation.titre"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
              />
              <div v-else class="w-full h-full flex items-center justify-center">
                <div class="text-center p-6">
                  <div class="w-16 h-16 bg-gradient-to-br from-[#0e437d] to-[#22ae84] rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <Palette :size="32" class="text-white" />
                  </div>
                  <div class="text-lg font-semibold text-gray-700">{{ realisation.titre }}</div>
                </div>
              </div>

              <!-- Project Type Badge -->
              <div class="absolute top-4 left-4">
                <span class="px-3 py-1.5 rounded-full text-xs font-semibold backdrop-blur-sm bg-white/90 text-[#0e437d] shadow">
                  {{ realisation.type || 'Branding' }}
                </span>
              </div>
            </div>

            <!-- Project Info Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-[#0e437d]/95 via-[#0e437d]/70 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-8">
              <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                <h3 class="text-2xl font-bold text-white mb-2">{{ realisation.titre }}</h3>
                <p class="text-white/90 mb-4 text-sm line-clamp-2">{{ realisation.description }}</p>
                <div class="flex items-center justify-between">
                  <div class="text-white/80 text-sm">
                    <span class="font-semibold">{{ realisation.client }}</span>
                  </div>
                  <Link
                    :href="`/portfolio/${realisation.slug || realisation.id}`"
                    class="inline-flex items-center gap-2 bg-white text-[#0e437d] px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition-all"
                  >
                    Voir détail
                    <ArrowRight :size="16" />
                  </Link>
                </div>
              </div>
            </div>

            <!-- Project Info (visible on non-hover) -->
            <div class="p-6 bg-white">
              <h3 class="text-xl font-bold text-gray-900 mb-2">{{ realisation.titre }}</h3>
              <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ realisation.description }}</p>
              <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-[#22ae84]">{{ realisation.client }}</span>
                <span class="text-xs px-3 py-1 rounded-full"
                      :class="getStatusClass(realisation.status)">
                  {{ realisation.status || 'Terminé' }}
                </span>
              </div>
            </div>
          </div>
        </div>

        <!-- Empty State -->
        <div v-else class="text-center py-20">
          <div class="w-32 h-32 bg-gradient-to-br from-[#0e437d]/10 to-[#22ae84]/10 rounded-3xl flex items-center justify-center mx-auto mb-8">
            <Sparkles :size="64" class="text-[#0e437d]" />
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-4">Notre portfolio se prépare</h3>
          <p class="text-gray-600 max-w-md mx-auto mb-8">
            Nous travaillons sur des projets innovants qui seront bientôt dévoilés.
            Revenez prochainement pour découvrir nos réalisations.
          </p>
          <div class="inline-flex items-center gap-2 text-[#0e437d] font-semibold">
            <Clock :size="20" />
            Prochain dévoilement: Janvier 2024
          </div>
        </div>

        <!-- Pagination/CTA -->
        <div class="mt-16 text-center">
          <div class="mb-8">
            <p class="text-gray-600 mb-6">Intéressé par nos services ?</p>
            <Link href="/contact" class="inline-flex items-center gap-2 bg-gradient-to-r from-[#0e437d] to-[#22ae84] text-white px-8 py-4 rounded-xl font-semibold text-lg hover:shadow-xl hover:scale-105 transition-all duration-300 shadow-lg">
              <Mail :size="20" />
              Demander un devis personnalisé
            </Link>
          </div>
        </div>
      </div>
    </section>

    <!-- Services Mention -->
    <section class="py-16 bg-gradient-to-br from-gray-50 to-white">
      <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
            Nos <span class="text-[#22ae84]">Expertises</span> en Détail
          </h2>
          <p class="text-gray-600 max-w-2xl mx-auto">
            Chaque projet bénéficie de notre approche multidisciplinaire
          </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
          <div class="text-center p-6">
            <div class="w-16 h-16 bg-gradient-to-br from-[#0e437d] to-[#22ae84] rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
              <Target :size="32" class="text-white" />
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Stratégie & Audit</h3>
            <p class="text-gray-600">Analyse approfondie avant chaque projet</p>
          </div>

          <div class="text-center p-6">
            <div class="w-16 h-16 bg-gradient-to-br from-[#22ae84] to-[#1c978a] rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
              <Palette :size="32" class="text-white" />
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Design & Création</h3>
            <p class="text-gray-600">Identités visuelles uniques et impactantes</p>
          </div>

          <div class="text-center p-6">
            <div class="w-16 h-16 bg-gradient-to-br from-[#1c978a] to-[#178e8b] rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
              <Globe :size="32" class="text-white" />
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Développement & Déploiement</h3>
            <p class="text-gray-600">Solutions techniques robustes et modernes</p>
          </div>
        </div>
      </div>
    </section>
  </GuestLayout>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {
  Sparkles,
  ArrowRight,
  Mail,
  Palette,
  Target,
  Globe,
  Clock,
  Image,
  Users,
  TrendingUp
} from 'lucide-vue-next';

// Props from Laravel controller
const props = defineProps({
  realisations: {
    type: Array,
    default: () => []
  },
  stats: {
    type: Object,
    default: () => ({
      totalProjects: 0,
      totalClients: 0,
      ongoingProjects: 0,
      successRate: 100
    })
  }
});

// State
const activeFilter = ref('all');

// Filters for portfolio
const filters = ref([
  { id: 'all', label: 'Tous les projets' },
  { id: 'branding', label: 'Branding' },
  { id: 'web', label: 'Web & Digital' },
  { id: 'social', label: 'Social Media' },
  { id: 'video', label: 'Production Vidéo' }
]);

// Filter realisations based on active filter
const filteredRealisations = computed(() => {
  if (!props.realisations) return [];

  if (activeFilter.value === 'all') {
    return props.realisations;
  }

  // Filter by category/type (you'll need to add a 'category' or 'type' field to your Realisation model)
  return props.realisations.filter(real =>
    real.category?.toLowerCase() === activeFilter.value ||
    real.type?.toLowerCase() === activeFilter.value
  );
});

// Get status badge class
const getStatusClass = (status) => {
  const statusMap = {
    'termine': 'bg-green-100 text-green-800',
    'en_cours': 'bg-blue-100 text-blue-800',
    'en_attente': 'bg-yellow-100 text-yellow-800',
    'planifie': 'bg-purple-100 text-purple-800',
    'default': 'bg-gray-100 text-gray-800'
  };

  return statusMap[status] || statusMap.default;
};

// Animation on scroll
onMounted(() => {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate-fadeIn');
      }
    });
  }, { threshold: 0.1 });

  // Observe portfolio items
  document.querySelectorAll('.portfolio-item').forEach(item => {
    observer.observe(item);
  });
});
</script>

<style scoped>
.glass-card {
  background: rgba(255, 255, 255, 0.7);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fadeIn {
  animation: fadeIn 0.6s ease-out forwards;
}

.delay-1000 {
  animation-delay: 1s;
}

/* Custom scrollbar for portfolio items */
.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}

.scrollbar-hide::-webkit-scrollbar {
  display: none;
}
</style>

