<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {
  Sparkles,
  ChevronRight,
  Phone,
  Mail,
  Calendar,
  BookOpen,
  Users,
  Target,
  Award,
  TrendingUp,
  Heart,
  Zap,
  Globe,
  Check,
  Star,
  MessageCircle,
  ArrowLeft
} from 'lucide-vue-next';
import { ref, onMounted } from 'vue';

defineOptions({ layout: GuestLayout });

const stats = ref([
  { value: '50+', label: 'Articles publiés', icon: BookOpen },
  { value: '98%', label: 'Lecteurs satisfaits', icon: Heart },
  { value: '10K+', label: 'Lecteurs mensuels', icon: Users },
  { value: '24/7', label: 'Contenu frais', icon: Zap }
]);

const categories = ref([
  { name: 'Marketing Digital', count: 15, color: 'from-[#0e437d] to-[#22ae84]' },
  { name: 'Design Graphique', count: 12, color: 'from-[#22ae84] to-[#1c978a]' },
  { name: 'Stratégie Web', count: 18, color: 'from-[#1c978a] to-[#178e8b]' },
  { name: 'Réseaux Sociaux', count: 22, color: 'from-[#178e8b] to-[#0e437d]' }
]);

onMounted(() => {
  // Animation des statistiques
  const animateStats = () => {
    const statElements = document.querySelectorAll('.stat-value');
    statElements.forEach((el, index) => {
      const stat = stats.value[index];
      if (stat.value === '24/7') {
        el.textContent = '24/7';
        return;
      }

      const numericValue = parseInt(stat.value);
      if (!isNaN(numericValue)) {
        let current = 0;
        const target = numericValue;
        const increment = target / 30;
        const timer = setInterval(() => {
          current += increment;
          if (current >= target) {
            current = target;
            clearInterval(timer);
          }
          el.textContent = Math.floor(current) + (stat.value.includes('K+') ? 'K+' : '+');
        }, 50);
      }
    });
  };

  // Animation au scroll
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate-in');
        if (entry.target.classList.contains('stats-section')) {
          setTimeout(animateStats, 500);
        }
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));

  // Créer des particules
  createParticles();
});

const createParticles = () => {
  const heroSection = document.querySelector('.hero-section');
  if (!heroSection) return;

  for (let i = 0; i < 15; i++) {
    const particle = document.createElement('div');
    particle.className = 'particle';
    particle.style.left = `${Math.random() * 100}%`;
    particle.style.top = `${Math.random() * 100}%`;
    particle.style.animationDelay = `${Math.random() * 5}s`;
    particle.style.animationDuration = `${10 + Math.random() * 20}s`;
    heroSection.appendChild(particle);
  }
};

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

<template>
  <GuestLayout>
    <Head title="Blog - KOTAVA Communication" />

    <!-- Hero Section avec animations -->
    <section class="relative py-20 bg-gradient-to-br from-[#0e437d] via-[#1a6ca3] to-[#22ae84] overflow-hidden min-h-[80vh] flex items-center hero-section animate-on-scroll">
      <!-- Animation background -->
      <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-20 left-10 w-64 h-64 bg-[#FFD166] rounded-full opacity-20 animate-pulse animation-delay-1000"></div>
        <div class="absolute bottom-20 right-10 w-80 h-80 bg-[#EF476F] rounded-full opacity-15 animate-pulse animation-delay-2000"></div>
        <div class="absolute top-1/2 left-1/4 w-48 h-48 bg-[#06D6A0] rounded-full opacity-20 animate-pulse"></div>

        <!-- Effet shimmer -->
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent animate-shimmer"></div>
      </div>

      <div class="relative max-w-7xl mx-auto px-6 text-center">
        <!-- Badge animé -->
        <div class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white/20 backdrop-blur-lg text-white mb-8 text-sm font-medium animate-bounce-subtle">
          <Sparkles :size="16" />
          <span>Découvrez nos insights</span>
        </div>

        <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 animate-slide-up">
          Notre <span class="text-[#FFD166] relative">
            Blog
            <span class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-[#FFD166] to-transparent animate-underline"></span>
          </span>
        </h1>

        <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto leading-relaxed mb-10 animate-slide-up animation-delay-200">
          Découvrez nos <span class="text-[#FFD166] font-semibold">insights, tendances digitales</span> et conseils experts en communication.
        </p>

        <!-- CTA Hero -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-slide-up animation-delay-400">
          <a href="#newsletter"
             class="group relative px-8 py-4 bg-gradient-to-r from-[#FFD166] to-[#FFB347] text-gray-900 rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105 animate-pulse-subtle">
            <span class="relative z-10 flex items-center gap-2">
              S'abonner à la newsletter <ChevronRight :size="20" class="group-hover:translate-x-1 transition-transform" />
            </span>
            <div class="absolute inset-0 bg-gradient-to-r from-[#FFD166] to-[#FFB347] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </a>

          <a href="#articles"
             class="group px-6 py-4 bg-white/10 backdrop-blur-lg text-white rounded-xl font-semibold text-lg border-2 border-white/20 hover:bg-white/20 hover:border-white/40 transition-all duration-300">
            <span class="flex items-center gap-2">
              <BookOpen :size="20" /> Voir les articles
            </span>
          </a>
        </div>
      </div>
    </section>

    <!-- Statistiques du blog -->
    <section class="py-16 bg-gradient-to-r from-white via-gray-50 to-white stats-section animate-on-scroll">
      <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
          <div v-for="(stat, index) in stats" :key="index"
               class="text-center p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 group">
            <div class="flex justify-center mb-4">
              <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#0e437d]/10 to-[#22ae84]/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <component :is="stat.icon" :size="24" class="text-[#0e437d]" />
              </div>
            </div>
            <div class="text-4xl font-bold text-[#0e437d] mb-2 stat-value">{{ stat.value }}</div>
            <div class="text-gray-600 font-medium">{{ stat.label }}</div>
            <div class="w-12 h-1 bg-gradient-to-r from-[#0e437d] to-[#22ae84] mx-auto mt-3"></div>
          </div>
        </div>
      </div>
    </section>

    <!-- Catégories -->
    <section class="py-16 bg-white animate-on-scroll">
      <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
          <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#0e437d]/10 text-[#0e437d] mb-4 text-sm font-semibold">
            <BookOpen :size="14" />
            Parcourir par catégorie
          </div>
          <h2 class="text-3xl font-bold text-gray-900 mb-4">Explorez nos thèmes</h2>
          <p class="text-gray-600 max-w-2xl mx-auto">Découvrez nos articles organisés par catégories pour trouver exactement ce qui vous intéresse</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
          <div v-for="(category, index) in categories" :key="index"
               class="group bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-gray-100">
            <div class="w-16 h-16 mb-6 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300"
                 :class="`bg-gradient-to-br ${category.color}`">
              <div class="text-white text-2xl font-bold">{{ category.count }}</div>
            </div>

            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ category.name }}</h3>
            <p class="text-gray-600 mb-4">{{ category.count }} articles publiés</p>

            <div class="mt-6 pt-4 border-t border-gray-100">
              <Link :href="`/blog/categorie/${category.name.toLowerCase().replace(' ', '-')}`"
                    class="text-sm text-[#0e437d] font-medium hover:text-[#22ae84] transition-colors inline-flex items-center gap-1 group/link">
                Voir les articles <ChevronRight :size="14" class="group-hover/link:translate-x-1 transition-transform" />
              </Link>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Articles Section -->
    <section id="articles" class="py-20 bg-gray-50 animate-on-scroll">
      <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
          <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#22ae84]/10 text-[#22ae84] mb-4 text-sm font-semibold">
            <Sparkles :size="14" />
            Derniers articles
          </div>
          <h2 class="text-3xl font-bold text-gray-900 mb-4">Nos dernières publications</h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Restez à jour avec les dernières tendances et conseils en communication digitale
          </p>
        </div>

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
                    <BookOpen :size="24" class="text-white" />
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
                  class="inline-flex items-center gap-2 text-[#0e437d] font-semibold hover:gap-3 transition-all group/link"
                >
                  Lire la suite
                  <ChevronRight :size="16" class="group-hover/link:translate-x-1 transition-transform" />
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
          <div class="w-24 h-24 bg-gradient-to-br from-[#0e437d]/10 to-[#22ae84]/10 rounded-2xl flex items-center justify-center mx-auto mb-6 animate-pulse-subtle">
            <BookOpen :size="48" class="text-[#0e437d]" />
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-4 animate-fade-in">Articles à venir</h3>
          <p class="text-gray-600 max-w-md mx-auto mb-6 animate-fade-in animation-delay-200">
            Notre équipe prépare actuellement des articles passionnants sur la communication digitale.
            Revenez bientôt pour découvrir nos insights !
          </p>
          <div class="inline-flex items-center gap-2 text-[#0e437d] font-semibold animate-fade-in animation-delay-400">
            <Calendar :size="20" />
            Prochain article: Janvier 2024
          </div>
        </div>

        <!-- Pagination -->
        <div v-if="actualites && actualites.length > 0" class="mt-12 flex justify-center">
          <div class="flex gap-2">
            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors hover:-translate-y-1">
              Précédent
            </button>
            <button class="px-4 py-2 bg-gradient-to-r from-[#0e437d] to-[#22ae84] text-white rounded-lg hover:shadow-lg transition-all hover:-translate-y-1">
              1
            </button>
            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors hover:-translate-y-1">
              Suivant
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Newsletter Section améliorée -->
    <section id="newsletter" class="py-20 bg-gradient-to-br from-[#0e437d] to-[#22ae84] text-white animate-on-scroll">
      <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-20 -left-20 w-64 h-64 bg-white rounded-full opacity-10 blur-3xl"></div>
        <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-white rounded-full opacity-10 blur-3xl"></div>
      </div>

      <div class="relative max-w-4xl mx-auto px-6 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 backdrop-blur-sm text-white mb-6 text-sm font-medium animate-bounce-subtle">
          <Sparkles :size="14" /> Offre exclusive
        </div>

        <h2 class="text-4xl md:text-5xl font-bold mb-6">
          Restez <span class="text-[#FFD166]">informé</span>
        </h2>

        <p class="text-xl opacity-90 mb-8 max-w-2xl mx-auto">
          Inscrivez-vous à notre newsletter pour recevoir nos derniers articles et conseils en communication digitale
        </p>

        <form class="max-w-md mx-auto space-y-4">
          <div class="flex gap-3">
            <input
              type="email"
              placeholder="Votre email"
              class="flex-1 px-4 py-3 bg-white/10 backdrop-blur-lg text-white placeholder-white/60 rounded-xl border border-white/20 focus:ring-2 focus:ring-[#FFD166] focus:border-transparent outline-none transition-all"
            />
            <button
              type="submit"
              class="px-6 py-3 bg-gradient-to-r from-[#FFD166] to-[#FFB347] text-gray-900 font-semibold rounded-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 group"
            >
              <span class="flex items-center gap-2">
                S'inscrire <ChevronRight :size="18" class="group-hover:translate-x-1 transition-transform" />
              </span>
            </button>
          </div>
          <p class="text-white/60 text-sm">
            En vous inscrivant, vous acceptez de recevoir nos emails. Désabonnez-vous à tout moment.
          </p>
        </form>
      </div>
    </section>

    <!-- Section Pourquoi lire notre blog -->
    <section class="py-20 bg-white animate-on-scroll">
      <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-900 mb-4">Pourquoi lire notre blog ?</h2>
          <p class="text-gray-600 max-w-2xl mx-auto">La valeur que nous apportons à nos lecteurs</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
          <div class="group flex items-start gap-6 p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-[#0e437d]/10 to-[#22ae84]/10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
              <Target :size="24" class="text-[#0e437d]" />
            </div>
            <div>
              <h3 class="text-xl font-semibold text-gray-900 mb-2">Contenu expert</h3>
              <p class="text-gray-600">Des articles rédigés par des professionnels du secteur avec des années d'expérience</p>
            </div>
          </div>

          <div class="group flex items-start gap-6 p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-[#0e437d]/10 to-[#22ae84]/10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
              <TrendingUp :size="24" class="text-[#0e437d]" />
            </div>
            <div>
              <h3 class="text-xl font-semibold text-gray-900 mb-2">Tendances actuelles</h3>
              <p class="text-gray-600">Restez à jour avec les dernières évolutions du digital et de la communication</p>
            </div>
          </div>

          <div class="group flex items-start gap-6 p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-[#0e437d]/10 to-[#22ae84]/10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
              <Check :size="24" class="text-[#0e437d]" />
            </div>
            <div>
              <h3 class="text-xl font-semibold text-gray-900 mb-2">Conseils pratiques</h3>
              <p class="text-gray-600">Des astuces et méthodes que vous pouvez appliquer immédiatement dans vos projets</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Final -->
    <section class="py-20 bg-gradient-to-br from-gray-50 via-white to-gray-50 animate-on-scroll">
      <div class="max-w-4xl mx-auto px-6 text-center">
        <div class="bg-gradient-to-r from-[#0e437d] to-[#22ae84] rounded-2xl p-8 text-white shadow-xl">
          <h3 class="text-2xl font-bold mb-4">Vous avez un sujet à proposer ?</h3>
          <p class="text-white/90 mb-6">Partagez-nous vos idées d'articles ou posez-nous vos questions</p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <Link :href="route('contact')"
                  class="px-6 py-3 bg-white text-[#0e437d] rounded-lg font-semibold hover:bg-gray-100 transition-all duration-300 hover:scale-105">
              Nous contacter
            </Link>
            <a href="mailto:blog@kotava.com"
               class="px-6 py-3 bg-transparent border-2 border-white text-white rounded-lg font-semibold hover:bg-white/10 transition-all duration-300 hover:scale-105">
              blog@kotava.com
            </a>
          </div>
        </div>
      </div>
    </section>
  </GuestLayout>
</template>

<style scoped>
@keyframes float {
  0%, 100% { transform: translateY(0) rotate(0deg); }
  50% { transform: translateY(-20px) rotate(180deg); }
}

@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes pulse-subtle {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.02); }
}

@keyframes bounce-subtle {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-5px); }
}

@keyframes underline {
  from { width: 0; opacity: 0; }
  to { width: 100%; opacity: 1; }
}

@keyframes shimmer {
  0% { transform: translateX(-100%); }
  100% { transform: translateX(100%); }
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

.particle {
  position: absolute;
  width: 2px;
  height: 2px;
  background-color: white;
  border-radius: 50%;
  opacity: 0.3;
  animation: float linear infinite;
}

.animate-float {
  animation: float linear infinite;
}

.animate-slide-up {
  animation: slideUp 0.8s ease-out forwards;
  opacity: 0;
}

.animate-pulse-subtle {
  animation: pulse-subtle 2s ease-in-out infinite;
}

.animate-bounce-subtle {
  animation: bounce-subtle 2s ease-in-out infinite;
}

.animate-underline {
  animation: underline 1s ease-out forwards;
}

.animate-shimmer {
  animation: shimmer 3s infinite;
}

.animate-fade-in {
  animation: fadeIn 0.8s ease-out forwards;
  opacity: 0;
}

.animation-delay-200 {
  animation-delay: 200ms;
}

.animation-delay-400 {
  animation-delay: 400ms;
}

.animation-delay-1000 {
  animation-delay: 1000ms;
}

.animation-delay-2000 {
  animation-delay: 2000ms;
}

.animate-on-scroll {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

.animate-on-scroll.animate-in {
  opacity: 1;
  transform: translateY(0);
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .text-5xl {
    font-size: 3rem;
  }
  .text-7xl {
    font-size: 4rem;
  }
}
</style>
