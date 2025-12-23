<script setup>
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/GuestLayout.vue';
import { Target, Palette, Globe, Camera, Calendar, MessageSquare, BarChart, Sparkles, Rocket, Star, Users, Zap, ChevronRight, Mail, Phone, Award, TrendingUp, Heart, Check } from 'lucide-vue-next';
import { ref, onMounted } from 'vue';

defineOptions({ layout: MainLayout });

const stats = ref([
  { value: '50+', label: 'Projets réalisés', icon: 'check' },
  { value: '95%', label: 'Clients satisfaits', icon: 'heart' },
  { value: '15', label: 'Secteurs d\'activité', icon: 'users' },
  { value: '100%', label: 'Projets livrés', icon: 'award' }
]);

const projects = [
  {
    title: 'Campagne de communication intégrée',
    description: 'Stratégie multicanal complète pour une marque nationale',
    category: 'Stratégie & Marketing',
    icon: Target,
    color: 'from-[#0e437d] to-[#22ae84]',
    results: ['+45% notoriété', '+60% engagement', '+30% ventes'],
    client: 'Entreprise nationale',
    duration: '3 mois'
  },
  {
    title: 'Stratégie de Contenu et Médias Sociaux',
    description: 'Transformation digitale d\'une PME traditionnelle',
    category: 'Social Media',
    icon: MessageSquare,
    color: 'from-[#22ae84] to-[#1c978a]',
    results: ['+300% engagement', '10K+ followers', '+25% leads'],
    client: 'PME locale',
    duration: '6 mois'
  },
  {
    title: 'Projet de développement Web',
    description: 'Plateforme e-commerce avec paiements locaux intégrés',
    category: 'Digital & Web',
    icon: Globe,
    color: 'from-[#1c978a] to-[#178e8b]',
    results: ['+40% conversion', '95% satisfaction', '-50% taux de rebond'],
    client: 'Startup e-commerce',
    duration: '4 mois'
  },
  {
    title: 'Rebranding complet',
    description: 'Identité visuelle moderne pour une institution financière',
    category: 'Branding',
    icon: Palette,
    color: 'from-[#178e8b] to-[#0e437d]',
    results: ['Image renouvelée', 'Crédibilité accrue', 'Reconnaissance +70%'],
    client: 'Institution financière',
    duration: '2 mois'
  },
  {
    title: 'Production audiovisuelle corporate',
    description: 'Série vidéo institutionnelle et motion design',
    category: 'Audiovisuel',
    icon: Camera,
    color: 'from-[#0e437d] to-[#22ae84]',
    results: ['1M+ vues', 'Engagement viral', 'Image premium'],
    client: 'Multinationale',
    duration: '5 mois'
  },
  {
    title: 'Événement de lancement produit',
    description: 'Organisation complète et relations presse',
    category: 'Événementiel',
    icon: Calendar,
    color: 'from-[#22ae84] to-[#1c978a]',
    results: ['500+ participants', 'Couverture médiatique', '+80% ventes'],
    client: 'Marque tech',
    duration: '3 mois'
  }
];

const marketTrends = ref([
  { value: '+60%', label: 'Campagnes Publicitaires', desc: 'Demande en forte croissance pour le lancement d\'entreprise', color: 'text-[#22ae84]' },
  { value: '+30%', label: 'Branding', desc: 'Besoin crucial d\'identité forte pour se démarquer', color: 'text-[#0e437d]' },
  { value: '+10%', label: 'Développement Web', desc: 'Demande constante mais plus spécialisée', color: 'text-[#1c978a]' }
]);

onMounted(() => {
  // Animation des statistiques
  const animateStats = () => {
    const statElements = document.querySelectorAll('.stat-value');
    statElements.forEach((el, index) => {
      const stat = stats.value[index];
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
  <Head title="Portfolio - KOTAVA Communication" />

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
        <span>Nos réalisations exceptionnelles</span>
      </div>

      <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 animate-slide-up">
        Notre <span class="text-[#FFD166] relative">
          Portfolio
          <span class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-[#FFD166] to-transparent animate-underline"></span>
        </span>
      </h1>

      <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto leading-relaxed mb-10 animate-slide-up animation-delay-200">
        Découvrez comment nous transformons les idées en <span class="text-[#FFD166] font-semibold">succès digitaux tangibles</span>
        pour nos clients.
      </p>

      <!-- CTA Hero -->
      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-slide-up animation-delay-400">
        <a href="/contact"
           class="group relative px-8 py-4 bg-gradient-to-r from-[#FFD166] to-[#FFB347] text-gray-900 rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105 animate-pulse-subtle">
          <span class="relative z-10 flex items-center gap-2">
            Voir votre projet ici <ChevronRight :size="20" class="group-hover:translate-x-1 transition-transform" />
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

  <!-- Projets avec animations -->
  <section class="py-20 bg-gray-50 animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Nos Projets Phares</h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">Des solutions sur-mesure qui ont transformé nos clients</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div v-for="(project, index) in projects" :key="project.title"
             class="group bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-on-scroll"
             :style="{ animationDelay: `${index * 100}ms` }">

          <!-- Badge catégorie -->
          <div class="flex items-center justify-between mb-6">
            <div :class="['w-14 h-14 rounded-2xl bg-gradient-to-br flex items-center justify-center group-hover:scale-110 transition-transform duration-300', project.color]">
              <component :is="project.icon" :size="28" class="text-white" />
            </div>
            <div class="inline-block px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-medium">
              {{ project.category }}
            </div>
          </div>

          <!-- Titre et description -->
          <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-[#0e437d] transition-colors duration-300">
            {{ project.title }}
          </h3>
          <p class="text-gray-600 mb-6 leading-relaxed">{{ project.description }}</p>

          <!-- Informations client -->
          <div class="mb-6 p-4 bg-gradient-to-r from-gray-50 to-white rounded-xl border border-gray-100">
            <div class="flex items-center justify-between text-sm">
              <div class="flex items-center gap-2">
                <Users :size="16" class="text-gray-400" />
                <span class="font-medium">{{ project.client }}</span>
              </div>
              <div class="flex items-center gap-2">
                <Calendar :size="16" class="text-gray-400" />
                <span>{{ project.duration }}</span>
              </div>
            </div>
          </div>

          <!-- Résultats -->
          <div class="space-y-3">
            <div v-for="result in project.results" :key="result"
                 class="flex items-center gap-3 group-hover:translate-x-2 transition-transform duration-300">
              <div class="w-2 h-2 bg-gradient-to-r from-green-500 to-emerald-400 rounded-full flex-shrink-0"></div>
              <span class="text-gray-700 font-medium">{{ result }}</span>
            </div>
          </div>

          <!-- Bouton Voir plus -->
          <div class="mt-8 pt-6 border-t border-gray-100">
            <div class="flex items-center text-sm text-[#0e437d] font-medium group-hover:text-[#22ae84] transition-colors cursor-pointer">
              <span>Voir l'étude de cas</span>
              <ChevronRight :size="16" class="ml-1 group-hover:translate-x-1 transition-transform" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Tendance marché avec animations -->
  <section class="py-20 bg-white animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Tendances du Marché 2024</h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">Les secteurs qui connaissent la plus forte croissance</p>
      </div>

      <div class="bg-gradient-to-br from-gray-50 to-white rounded-3xl p-8 shadow-xl">
        <div class="grid md:grid-cols-3 gap-8 mb-8">
          <div v-for="(trend, index) in marketTrends" :key="trend.label"
               class="group text-center p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
            <div :class="['text-5xl font-bold mb-4', trend.color]">{{ trend.value }}</div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ trend.label }}</h3>
            <p class="text-gray-600">{{ trend.desc }}</p>
            <div class="w-12 h-1 bg-gradient-to-r from-[#0e437d] to-[#22ae84] mx-auto mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </div>
        </div>

        <!-- Analyse stratégique -->
        <div class="bg-gradient-to-r from-[#0e437d]/5 to-[#22ae84]/5 rounded-2xl p-6 border border-[#0e437d]/10">
          <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#0e437d] to-[#22ae84] flex items-center justify-center flex-shrink-0">
              <BarChart :size="24" class="text-white" />
            </div>
            <div>
              <h4 class="text-lg font-semibold text-gray-900 mb-3">Analyse stratégique :</h4>
              <p class="text-gray-600 leading-relaxed">
                Forte demande en <span class="font-semibold text-[#22ae84]">lancement d'entreprise et croissance</span> (campagnes publicitaires),
                besoin crucial <span class="font-semibold text-[#0e437d]">d'identité forte</span> (branding) pour se démarquer dans un marché saturé,
                développement web constant mais avec une demande plus <span class="font-semibold text-[#1c978a]">spécialisée et qualitative</span>.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Section témoignages -->
  <section class="py-20 bg-gradient-to-br from-gray-50 via-white to-gray-50 animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Ce que disent nos clients</h2>
        <p class="text-gray-600 text-lg">La confiance que nous avons construite ensemble</p>
      </div>

      <div class="grid md:grid-cols-3 gap-8">
        <div v-for="(testimonial, index) in [
          { name: 'Sarah Martin', company: 'Directrice Marketing', text: 'KOTAVA a transformé notre présence digitale. Les résultats ont dépassé nos attentes.' },
          { name: 'Thomas Dubois', company: 'CEO Startup', text: 'Professionalisme et créativité au rendez-vous. Un partenaire de confiance pour notre croissance.' },
          { name: 'Marie Laurent', company: 'Responsable Communication', text: 'Une équipe réactive et innovante qui comprend parfaitement nos besoins.' }
        ]" :key="index"
        class="group bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
          <div class="flex items-center gap-3 mb-6">
            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#0e437d] to-[#22ae84] flex items-center justify-center">
              <span class="text-white font-bold">{{ testimonial.name.charAt(0) }}</span>
            </div>
            <div>
              <h4 class="font-bold text-gray-900">{{ testimonial.name }}</h4>
              <p class="text-gray-600 text-sm">{{ testimonial.company }}</p>
            </div>
          </div>
          <p class="text-gray-600 italic mb-6">"{{ testimonial.text }}"</p>
          <div class="flex text-[#FFD166]">
            <Star :size="20" class="fill-current" />
            <Star :size="20" class="fill-current" />
            <Star :size="20" class="fill-current" />
            <Star :size="20" class="fill-current" />
            <Star :size="20" class="fill-current" />
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Final -->
  <section class="py-20 bg-gradient-to-br from-[#0e437d] via-[#1a6ca3] to-[#22ae84] text-white animate-on-scroll">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <Sparkles :size="48" class="mx-auto mb-6 text-[#FFD166] animate-pulse" />

      <h2 class="text-4xl md:text-5xl font-bold mb-6">
        Prêt à écrire <span class="text-[#FFD166]">votre succès</span> ?
      </h2>

      <p class="text-xl opacity-90 mb-10 max-w-2xl mx-auto">
        Votre prochain projet pourrait figurer dans notre portfolio. Discutons de votre vision.
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <a href="/contact"
           class="group relative px-8 py-4 bg-white text-[#0e437d] rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105">
          <span class="relative z-10 flex items-center gap-3">
            <Mail :size="20" /> Démarrez votre projet
          </span>
          <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </a>

        <a href="#projets"
           class="group px-6 py-4 bg-transparent border-2 border-white text-white rounded-xl font-semibold text-lg hover:bg-white/10 transition-all duration-300">
          <span class="flex items-center gap-2">
            <Phone :size="20" /> +33 6 12 34 56 78
          </span>
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
