<script setup>
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/GuestLayout.vue';
import { Users, Target, Award, TrendingUp, Heart, Zap, Check, Globe, Sparkles, Rocket, Star, MessageCircle, Mail, Phone, ChevronRight } from 'lucide-vue-next';
import { ref, onMounted } from 'vue';

defineOptions({ layout: MainLayout });

const stats = ref([
  { value: '50+', label: 'Projets réussis', icon: 'check' },
  { value: '98%', label: 'Clients satisfaits', icon: 'heart' },
  { value: '24/7', label: 'Support disponible', icon: 'zap' },
  { value: '3x', label: 'ROI moyen', icon: 'trending-up' }
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
          el.textContent = Math.floor(current) + (stat.value.includes('%') ? '%' : '+');
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
});
</script>

<template>
  <Head title="À propos - KOTAVA Communication" />

  <!-- Hero Section avec animation -->
  <section class="relative bg-gradient-to-br from-[#0e437d] via-[#1a6ca3] to-[#22ae84] py-24 overflow-hidden min-h-[90vh] flex items-center">
    <!-- Animation background -->
    <div class="absolute inset-0 overflow-hidden">
      <div class="absolute top-20 left-10 w-64 h-64 bg-[#FFD166] rounded-full opacity-20 animate-pulse animation-delay-1000"></div>
      <div class="absolute bottom-20 right-10 w-80 h-80 bg-[#EF476F] rounded-full opacity-15 animate-pulse animation-delay-2000"></div>
      <div class="absolute top-1/2 left-1/4 w-48 h-48 bg-[#06D6A0] rounded-full opacity-20 animate-pulse"></div>

      <!-- Effet shimmer -->
      <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent animate-shimmer"></div>

      <!-- Particules flottantes -->
      <div v-for="i in 20" :key="i"
           class="absolute w-2 h-2 bg-white rounded-full opacity-30 animate-float"
           :style="{
             left: `${Math.random() * 100}%`,
             top: `${Math.random() * 100}%`,
             animationDelay: `${Math.random() * 5}s`,
             animationDuration: `${10 + Math.random() * 20}s`
           }"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center animate-on-scroll">
      <!-- Badge animé -->
      <div class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white/20 backdrop-blur-lg text-white mb-8 text-sm font-medium animate-bounce-subtle">
        <Sparkles :size="16" />
        <span>Votre succès commence ici</span>
      </div>

      <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 animate-slide-up">
        Qui sommes-<span class="text-[#FFD166] relative">
          nous ?
          <span class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-[#FFD166] to-transparent animate-underline"></span>
        </span>
      </h1>

      <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto leading-relaxed mb-10 animate-slide-up animation-delay-200">
        Nous transformons vos idées en <span class="text-[#FFD166] font-semibold">expériences digitales mémorables</span>
        qui captivent et convertissent.
      </p>

      <!-- CTA Hero -->
      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-slide-up animation-delay-400">
        <a href="/contact"
           class="group relative px-8 py-4 bg-gradient-to-r from-[#FFD166] to-[#FFB347] text-gray-900 rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105 animate-pulse-subtle">
          <span class="relative z-10 flex items-center gap-2">
            Démarrer mon projet <ChevronRight :size="20" class="group-hover:translate-x-1 transition-transform" />
          </span>
          <div class="absolute inset-0 bg-gradient-to-r from-[#FFD166] to-[#FFB347] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </a>

        <a href="tel:+33612345678"
           class="group px-6 py-4 bg-white/10 backdrop-blur-lg text-white rounded-xl font-semibold text-lg border-2 border-white/20 hover:bg-white/20 hover:border-white/40 transition-all duration-300">
          <span class="flex items-center gap-2">
            <Phone :size="20" /> +33 6 12 34 56 78
          </span>
        </a>
      </div>
    </div>
  </section>

  <!-- Statistiques animées -->
  <section class="py-16 bg-gradient-to-r from-white via-gray-50 to-white stats-section animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
        <div v-for="(stat, index) in stats" :key="index"
             class="text-center p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
          <div class="text-4xl font-bold text-[#0e437d] mb-2 stat-value">{{ stat.value }}</div>
          <div class="text-gray-600 font-medium">{{ stat.label }}</div>
          <div class="w-12 h-1 bg-gradient-to-r from-[#0e437d] to-[#22ae84] mx-auto mt-3"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Notre Histoire avec timeline animée -->
  <section class="py-20 bg-white relative overflow-hidden animate-on-scroll">
    <div class="absolute top-0 left-0 w-32 h-32 bg-[#06D6A0]/10 rounded-full -translate-x-16 -translate-y-16"></div>
    <div class="absolute bottom-0 right-0 w-48 h-48 bg-[#0e437d]/10 rounded-full translate-x-24 translate-y-24"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-bold text-gray-900 mb-12 text-center">
        <span class="relative">
          Notre Voyage
          <Sparkles class="absolute -top-6 -right-6 text-[#FFD166]" :size="24" />
        </span>
      </h2>

      <div class="relative">
        <!-- Ligne de timeline -->
        <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-gradient-to-b from-[#0e437d] via-[#22ae84] to-[#FFD166] hidden md:block"></div>

        <div class="space-y-12">
          <!-- Étape 1 -->
          <div class="relative md:flex items-center gap-8">
            <div class="md:w-1/2 md:text-right md:pr-12 mb-4 md:mb-0">
              <div class="inline-block px-4 py-2 rounded-full bg-[#0e437d]/10 text-[#0e437d] mb-3 text-sm font-semibold">2019-2021</div>
              <h3 class="text-2xl font-bold text-gray-900 mb-3">Les Fondations</h3>
              <p class="text-gray-600">Création avec une vision : démocratiser le design de qualité pour les petites entreprises</p>
            </div>
            <div class="hidden md:block w-8 h-8 rounded-full bg-gradient-to-r from-[#0e437d] to-[#22ae84] border-4 border-white shadow-lg"></div>
            <div class="md:w-1/2 md:pl-12">
              <div class="bg-gradient-to-br from-gray-50 to-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <ul class="space-y-2">
                  <li class="flex items-center gap-2"><Check :size="16" class="text-[#22ae84]" /> Design graphique & identité visuelle</li>
                  <li class="flex items-center gap-2"><Check :size="16" class="text-[#22ae84]" /> Équipe passionnée de 3 experts</li>
                  <li class="flex items-center gap-2"><Check :size="16" class="text-[#22ae84]" /> Premiers clients fidélisés</li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Étape 2 -->
          <div class="relative md:flex items-center gap-8">
            <div class="md:w-1/2 md:pr-12 order-2">
              <div class="bg-gradient-to-br from-gray-50 to-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <ul class="space-y-2">
                  <li class="flex items-center gap-2"><Check :size="16" class="text-[#22ae84]" /> Stratégie réseaux sociaux</li>
                  <li class="flex items-center gap-2"><Check :size="16" class="text-[#22ae84]" /> Développement web sur mesure</li>
                  <li class="flex items-center gap-2"><Check :size="16" class="text-[#22ae84]" /> Marketing digital intégré</li>
                </ul>
              </div>
            </div>
            <div class="hidden md:block w-8 h-8 rounded-full bg-gradient-to-r from-[#0e437d] to-[#22ae84] border-4 border-white shadow-lg order-1"></div>
            <div class="md:w-1/2 md:text-left md:pl-12 mb-4 md:mb-0 order-3">
              <div class="inline-block px-4 py-2 rounded-full bg-[#22ae84]/10 text-[#22ae84] mb-3 text-sm font-semibold">2021-2023</div>
              <h3 class="text-2xl font-bold text-gray-900 mb-3">Expansion Digitale</h3>
              <p class="text-gray-600">Diversification vers le digital et création de stratégies omnicanales</p>
            </div>
          </div>

          <!-- Étape 3 -->
          <div class="relative md:flex items-center gap-8">
            <div class="md:w-1/2 md:text-right md:pr-12 mb-4 md:mb-0">
              <div class="inline-block px-4 py-2 rounded-full bg-[#FFD166]/10 text-[#B78300] mb-3 text-sm font-semibold">2023-2025</div>
              <h3 class="text-2xl font-bold text-gray-900 mb-3">Innovation & IA</h3>
              <p class="text-gray-600">Intégration d'intelligence artificielle et solutions automatisées avancées</p>
            </div>
            <div class="hidden md:block w-8 h-8 rounded-full bg-gradient-to-r from-[#FFD166] to-[#FFB347] border-4 border-white shadow-lg"></div>
            <div class="md:w-1/2 md:pl-12">
              <div class="bg-gradient-to-br from-gray-50 to-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <ul class="space-y-2">
                  <li class="flex items-center gap-2"><Check :size="16" class="text-[#22ae84]" /> 6 pôles d'expertise</li>
                  <li class="flex items-center gap-2"><Check :size="16" class="text-[#22ae84]" /> Solutions IA intégrées</li>
                  <li class="flex items-center gap-2"><Check :size="16" class="text-[#22ae84]" /> Partenariats internationaux</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Vision & Mission avec hover effects -->
  <section class="py-20 bg-gradient-to-b from-gray-50 to-white animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid lg:grid-cols-2 gap-12">
        <!-- Vision -->
        <div class="group relative bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
          <div class="absolute -top-4 -right-4 w-20 h-20 bg-gradient-to-br from-[#0e437d] to-[#22ae84] rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
            <Target :size="32" class="text-white" />
          </div>
          <h3 class="text-2xl font-bold text-gray-900 mb-4">Notre Vision</h3>
          <p class="text-gray-600 leading-relaxed mb-4">
            Redéfinir la communication comme une <span class="text-[#0e437d] font-semibold">expérience sensorielle</span> où chaque interaction crée une connexion authentique entre les marques et leur audience.
          </p>
          <div class="space-y-3 mt-6">
            <div class="flex items-center gap-3">
              <div class="w-8 h-8 rounded-lg bg-[#0e437d]/10 flex items-center justify-center">
                <Rocket :size="16" class="text-[#0e437d]" />
              </div>
              <span class="text-gray-700">Avant-gardiste digital</span>
            </div>
            <div class="flex items-center gap-3">
              <div class="w-8 h-8 rounded-lg bg-[#0e437d]/10 flex items-center justify-center">
                <Sparkles :size="16" class="text-[#0e437d]" />
              </div>
              <span class="text-gray-700">Expériences mémorables</span>
            </div>
          </div>
        </div>

        <!-- Mission -->
        <div class="group relative bg-gradient-to-br from-[#0e437d] to-[#22ae84] rounded-3xl p-8 text-white shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
          <div class="absolute -top-4 -right-4 w-20 h-20 bg-white rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
            <Award :size="32" class="text-[#0e437d]" />
          </div>
          <h3 class="text-2xl font-bold mb-4">Notre Mission</h3>
          <p class="text-white/90 leading-relaxed mb-4">
            Mettre la technologie au service de la créativité pour développer des solutions <span class="font-semibold">intelligentes et impactantes</span> qui transforment votre vision en réalité digitale.
          </p>
          <div class="space-y-3 mt-6">
            <div class="flex items-center gap-3">
              <div class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center">
                <Zap :size="16" class="text-white" />
              </div>
              <span>Solutions évolutives</span>
            </div>
            <div class="flex items-center gap-3">
              <div class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center">
                <Check :size="16" class="text-white" />
              </div>
              <span>Accessible à tous les budgets</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Nos Valeurs avec animation au hover -->
  <section class="py-20 bg-white animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Nos Valeurs Fondamentales</h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">Les piliers sur lesquels nous construisons chaque succès</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div v-for="(value, index) in [
          { icon: Heart, title: 'Connexion & Confiance', desc: 'Relations authentiques et durables', colorClass: 'from-[#0e437d] to-[#22ae84]' },
          { icon: TrendingUp, title: 'Performance & Impact', desc: 'Résultats mesurables et croissance', colorClass: 'from-[#22ae84] to-[#1c978a]' },
          { icon: Zap, title: 'Créativité & Authenticité', desc: 'Design percutant et cohérent', colorClass: 'from-[#1c978a] to-[#178e8b]' },
          { icon: Globe, title: 'Innovation & Excellence', desc: 'Avantage technologique constant', colorClass: 'from-[#178e8b] to-[#0e437d]' }
        ]" :key="index"
        class="group">
          <div class="relative h-full bg-white rounded-2xl p-8 border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3">
            <div class="text-5xl font-bold text-gray-900/10 mb-4 absolute top-4 right-4">0{{ index + 1 }}</div>

            <div class="w-16 h-16 mb-6 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300"
                 :class="`bg-gradient-to-br ${value.colorClass}`">
              <component :is="value.icon" :size="28" class="text-white" />
            </div>

            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ value.title }}</h3>
            <p class="text-gray-600">{{ value.desc }}</p>

            <div class="mt-6 pt-4 border-t border-gray-100">
              <div class="flex items-center text-sm text-gray-500 group-hover:text-[#0e437d] transition-colors">
                <span>En savoir plus</span>
                <ChevronRight :size="16" class="ml-1 group-hover:translate-x-1 transition-transform" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

 <!-- Pourquoi nous choisir - Section persuasive -->
<section class="py-20 bg-gradient-to-br from-gray-50 via-white to-gray-50 animate-on-scroll">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <h2 class="text-3xl font-bold text-gray-900 mb-4">Pourquoi nous choisir ?</h2>
      <p class="text-gray-600 text-lg">La différence qui fait de nous votre meilleur partenaire digital</p>
    </div>

    <div class="grid lg:grid-cols-2 gap-12">
      <div class="space-y-8">
        <div v-for="(point, index) in [
          { icon: Users, title: 'Équipe créative pluridisciplinaire', desc: 'Graphistes, développeurs, stratèges pour une vision 360°' },
          { icon: Zap, title: 'Technologies de pointe', desc: 'IA créative, automatisation, data analysis et outils premium' },
          { icon: MessageCircle, title: 'Communication transparente', desc: 'Suivi régulier, reporting détaillé, ajustements rapides' }
        ]" :key="index"
        class="group flex items-start gap-6 p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
          <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-[#0e437d]/10 to-[#22ae84]/10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
            <component :is="point.icon" :size="24" class="text-[#0e437d]" />
          </div>
          <div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ point.title }}</h3>
            <p class="text-gray-600">{{ point.desc }}</p>
          </div>
        </div>
      </div>

      <div class="space-y-8">
        <div v-for="(point, index) in [
          { icon: Globe, title: 'Réseau stratégique étendu', desc: 'Partenaires, influenceurs, experts SEO/SEA, médias spécialisés' },
          { icon: Check, title: 'Méthodologie éprouvée', desc: 'Diagnostic > Stratégie > Création > Diffusion > Optimisation' },
          { icon: Star, title: 'Garantie satisfaction', desc: 'Révisions illimitées jusqu à satisfaction totale' }
        ]" :key="index"
        class="group flex items-start gap-6 p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
          <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-[#0e437d]/10 to-[#22ae84]/10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
            <component :is="point.icon" :size="24" class="text-[#0e437d]" />
          </div>
          <div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ point.title }}</h3>
            <p class="text-gray-600">{{ point.desc }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- CTA Section HORS de la grille - centrée sur toute la largeur -->
    <div class="mt-12 lg:col-span-2"> <!-- lg:col-span-2 pour qu'elle prenne 2 colonnes sur desktop -->
      <div class="bg-gradient-to-r from-[#0e437d] to-[#22ae84] rounded-2xl p-8 text-white text-center shadow-xl max-w-4xl mx-auto">
        <h3 class="text-2xl font-bold mb-4">Prêt à booster votre présence digitale ?</h3>
        <p class="text-white/90 mb-6">Réservez votre audit gratuit dès maintenant</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a href="tel:+33612345678"
             class="px-6 py-3 bg-white text-[#0e437d] rounded-lg font-semibold hover:bg-gray-100 transition-all duration-300">
            Appelez-nous
          </a>
          <a href="/contact"
             class="px-6 py-3 bg-transparent border-2 border-white text-white rounded-lg font-semibold hover:bg-white/10 transition-all duration-300">
            Demander un devis
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- Section Contact CTA finale -->
  <section class="py-20 bg-gradient-to-br from-[#0e437d] via-[#1a6ca3] to-[#22ae84] text-white animate-on-scroll">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <Sparkles :size="48" class="mx-auto mb-6 text-[#FFD166] animate-pulse" />

      <h2 class="text-4xl md:text-5xl font-bold mb-6">
        Transformons ensemble vos <span class="text-[#FFD166]">idées en succès</span>
      </h2>

      <p class="text-xl opacity-90 mb-10 max-w-2xl mx-auto">
        Notre équipe est prête à créer une stratégie sur-mesure pour propulser votre entreprise.
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <a href="/contact"
           class="group relative px-8 py-4 bg-white text-[#0e437d] rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105">
          <span class="relative z-10 flex items-center gap-3">
            <Mail :size="20" /> Obtenir une proposition personnalisée
          </span>
          <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </a>
      </div>

      <div class="mt-12 pt-8 border-t border-white/20">
        <p class="text-white/80 mb-4">Ou contactez-nous directement :</p>
        <div class="flex flex-wrap justify-center gap-6">
          <a href="mailto:contact@kotava.com" class="flex items-center gap-2 hover:text-[#FFD166] transition-colors">
            <Mail :size="18" /> contact@kotava.com
          </a>
          <a href="tel:+33612345678" class="flex items-center gap-2 hover:text-[#FFD166] transition-colors">
            <Phone :size="18" /> +33 6 12 34 56 78
          </a>
        </div>
      </div>
    </div>
  </section>
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

@keyframes underline {
  from { width: 0; opacity: 0; }
  to { width: 100%; opacity: 1; }
}

@keyframes pulse-subtle {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.02); }
}

@keyframes bounce-subtle {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-5px); }
}

@keyframes shimmer {
  0% { transform: translateX(-100%); }
  100% { transform: translateX(100%); }
}

.animate-float {
  animation: float linear infinite;
}

.animate-slide-up {
  animation: slideUp 0.8s ease-out forwards;
}

.animate-underline {
  animation: underline 1s ease-out forwards;
}

.animate-pulse-subtle {
  animation: pulse-subtle 2s ease-in-out infinite;
}

.animate-bounce-subtle {
  animation: bounce-subtle 2s ease-in-out infinite;
}

.animate-shimmer {
  animation: shimmer 3s infinite;
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
