<!-- resources/js/Pages/Services/Social.vue -->
<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/GuestLayout.vue';
import { ArrowLeft, MessageSquare, Check, Sparkles, TrendingUp, Users, Zap, BarChart, Video, Image, Hashtag, ChevronRight, Mail, Phone, Target, Award, Heart, Shield, Clock, Globe } from 'lucide-vue-next';
import { ref, onMounted } from 'vue';

defineOptions({ layout: MainLayout });

const services = ref([
  {
    title: 'Stratégie Social Media',
    description: 'Planification complète et analyse concurrentielle pour maximiser votre présence digitale',
    icon: TrendingUp,
    color: 'from-[#0e437d] to-[#22ae84]',
    features: ['Audit des réseaux', 'Analyse concurrentielle', 'Planning éditorial', 'Objectifs KPIs'],
    platforms: ['Instagram', 'LinkedIn', 'Facebook', 'TikTok', 'Twitter']
  },
  {
    title: 'Création de Contenu',
    description: 'Contenu visuel et textuel engageant adapté à chaque plateforme sociale',
    icon: Image,
    color: 'from-[#22ae84] to-[#1c978a]',
    features: ['Design graphique', 'Copywriting percutant', 'Photographie', 'Vidéos courtes'],
    formats: ['Posts carousel', 'Stories/Reels', 'Infographies', 'Vidéos 60s']
  },
  {
    title: 'Community Management',
    description: 'Gestion proactive de votre communauté et animation quotidienne de vos réseaux',
    icon: Users,
    color: 'from-[#1c978a] to-[#178e8b]',
    features: ['Modération des commentaires', 'Réponses aux messages', 'Engagement proactif', 'Gestion de crise'],
    engagement: ['Taux d\'engagement +300%', 'Croissance organique', 'Fidélisation communauté', 'Ambassadeurs marque']
  },
  {
    title: 'Campagnes Publicitaires',
    description: 'Stratégies publicitaires ciblées et optimisées pour maximiser votre ROI',
    icon: BarChart,
    color: 'from-[#178e8b] to-[#0e437d]',
    features: ['Ciblage avancé', 'A/B testing', 'Optimisation en temps réel', 'Reporting détaillé'],
    objectives: ['Notoriété', 'Traffic', 'Leads', 'Ventes', 'Engagement']
  },
  {
    title: 'Influence Marketing',
    description: 'Partenariats stratégiques avec influenceurs pour amplifier votre portée',
    icon: Zap,
    color: 'from-[#0e437d] to-[#22ae84]',
    features: ['Identification influenceurs', 'Négociation partenariats', 'Création de briefs', 'Suivi performances'],
    collaborations: ['Micro-influenceurs', 'Macro-influenceurs', 'Ambassadeurs', 'Partnerships long terme']
  },
  {
    title: 'Analyse & Reporting',
    description: 'Suivi approfondi des performances et recommandations d\'optimisation',
    icon: Shield,
    color: 'from-[#22ae84] to-[#1c978a]',
    features: ['Tableaux de bord temps réel', 'Analyses approfondies', 'Recommandations stratégiques', 'Prévisions'],
    metrics: ['ROI mesuré', 'Engagement analyse', 'Growth tracking', 'Benchmarking']
  }
]);

const platforms = ref([
  { name: 'Instagram', category: 'Visuel & Engagement' },
  { name: 'LinkedIn', category: 'Professionnel & B2B' },
  { name: 'Facebook', category: 'Communauté & Publicité' },
  { name: 'TikTok', category: 'Vidéo & Viralité' },
  { name: 'Twitter/X', category: 'Actualité & Conversation' },
  { name: 'YouTube', category: 'Vidéo & Éducation' }
]);

const benefits = ref([
  { title: 'Contenu Viral', description: 'Création de contenu à fort potentiel de partage', icon: TrendingUp },
  { title: 'Engagement Boosté', description: 'Stratégies pour augmenter l\'interaction', icon: Heart },
  { title: 'ROI Maximisé', description: 'Optimisation des campagnes pour meilleur retour', icon: BarChart },
  { title: 'Croissance Organique', description: 'Développement durable de votre audience', icon: Users }
]);

onMounted(() => {
  // Animation au scroll
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate-in');
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
});
</script>

<template>
  <Head title="Social Media & Contenu - KOTAVA Communication" />

  <!-- Hero Section avec animation -->
  <section class="relative bg-gradient-to-br from-[#0e437d] via-[#22ae84] to-[#1c978a] py-24 overflow-hidden min-h-[80vh] flex items-center">
    <!-- Animation background social media -->
    <div class="absolute inset-0 overflow-hidden">
      <!-- Effet réseaux sociaux (notification bubbles) -->
      <div v-for="i in 8" :key="i"
           class="absolute w-8 h-8 rounded-full bg-white/10 animate-pulse"
           :style="{
             left: `${10 + Math.random() * 80}%`,
             top: `${10 + Math.random() * 80}%`,
             animationDelay: `${Math.random() * 3}s`,
             animationDuration: `${2 + Math.random() * 3}s`
           }"></div>

      <!-- Effet likes/hearts animés -->
      <div v-for="i in 6" :key="'heart' + i"
           class="absolute text-white/20 animate-float"
           :style="{
             left: `${Math.random() * 100}%`,
             top: `${Math.random() * 100}%`,
             fontSize: `${20 + Math.random() * 20}px`,
             animationDelay: `${Math.random() * 2}s`,
             animationDuration: `${4 + Math.random() * 6}s`
           }">❤️</div>

      <!-- Effet flux social (lignes verticales) -->
      <div class="absolute inset-0 opacity-5"
           style="background-image: repeating-linear-gradient(90deg, transparent, transparent 20px, rgba(255,255,255,0.1) 20px, rgba(255,255,255,0.1) 40px);">
      </div>

      <!-- Particules sociales -->
      <div v-for="i in 15" :key="'particle' + i"
           class="absolute w-1 h-1 bg-white rounded-full opacity-30 animate-float"
           :style="{
             left: `${Math.random() * 100}%`,
             top: `${Math.random() * 100}%`,
             animationDelay: `${Math.random() * 4}s`,
             animationDuration: `${5 + Math.random() * 10}s`
           }"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 animate-on-scroll">
      <!-- Bouton retour -->
      <Link :href="route('services')"
            class="group inline-flex items-center gap-2 text-white hover:text-white/80 mb-8 transition-all duration-300 hover:-translate-x-1">
        <ArrowLeft :size="20" class="group-hover:-translate-x-1 transition-transform" />
        <span>Retour aux services</span>
      </Link>

      <!-- Header avec badge animé -->
      <div class="flex flex-col sm:flex-row sm:items-center gap-6 mb-8">
        <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-[#0e437d] to-[#22ae84] flex items-center justify-center shadow-2xl group-hover:scale-110 transition-transform duration-500">
          <MessageSquare :size="36" class="text-white" />
        </div>
        <div class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white/20 backdrop-blur-lg text-white text-sm font-medium animate-bounce-subtle">
          <Sparkles :size="16" />
          <span>Social Media & Contenu viral</span>
        </div>
      </div>

      <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 animate-slide-up">
        Social Media & <span class="text-[#FFD166] relative">
          Contenu
          <span class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-[#FFD166] to-transparent animate-underline"></span>
        </span>
      </h1>

      <p class="text-xl md:text-2xl text-white/90 max-w-3xl leading-relaxed mb-10 animate-slide-up animation-delay-200">
        Engagez votre communauté avec une stratégie de contenu <span class="text-[#FFD166] font-semibold">puissante, créative et data-driven</span>
        qui convertit vos followers en clients fidèles.
      </p>

      <!-- CTA Hero -->
      <div class="flex flex-col sm:flex-row gap-4 animate-slide-up animation-delay-400">
        <a href="/contact"
           class="group relative px-8 py-4 bg-gradient-to-r from-[#FFD166] to-[#FFB347] text-gray-900 rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105 animate-pulse-subtle max-w-xs">
          <span class="relative z-10 flex items-center gap-2">
            Booster mes réseaux sociaux <ChevronRight :size="20" class="group-hover:translate-x-1 transition-transform" />
          </span>
          <div class="absolute inset-0 bg-gradient-to-r from-[#FFD166] to-[#FFB347] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </a>

        <a href="tel:+33612345678"
           class="group px-6 py-4 bg-white/10 backdrop-blur-lg text-white rounded-xl font-semibold text-lg border-2 border-white/20 hover:bg-white/20 hover:border-white/40 transition-all duration-300 max-w-xs">
          <span class="flex items-center gap-2">
            <Phone :size="20" /> Audit social média gratuit
          </span>
        </a>
      </div>
    </div>
  </section>

  <!-- Statistiques sociales -->
  <section class="py-16 bg-gradient-to-r from-white via-gray-50 to-white stats-section animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
        <div v-for="(stat, index) in [
          { value: '+300%', label: 'Engagement moyen', icon: Heart },
          { value: '24/7', label: 'Community Management', icon: Clock },
          { value: '3x', label: 'ROI publicitaire', icon: TrendingUp },
          { value: 'A+', label: 'Qualité contenu', icon: Award }
        ]" :key="index"
        class="text-center p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
          <div class="text-4xl font-bold text-[#0e437d] mb-2">{{ stat.value }}</div>
          <div class="text-gray-600 font-medium">{{ stat.label }}</div>
          <div class="w-12 h-1 bg-gradient-to-r from-[#0e437d] to-[#22ae84] mx-auto mt-3"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Nos services sociaux -->
  <section class="py-20 bg-white animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Nos Services Social Media</h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">Une approche complète pour dominer les réseaux sociaux</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div v-for="(service, index) in services" :key="service.title"
             class="group bg-white rounded-3xl p-8 border border-gray-100 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
          <!-- Icon animé -->
          <div :class="['w-16 h-16 mb-6 rounded-2xl bg-gradient-to-br flex items-center justify-center group-hover:scale-110 transition-transform duration-300', service.color]">
            <component :is="service.icon" :size="28" class="text-white" />
          </div>

          <!-- Titre et description -->
          <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-[#0e437d] transition-colors duration-300">
            {{ service.title }}
          </h3>
          <p class="text-gray-600 mb-6 leading-relaxed">{{ service.description }}</p>

          <!-- Features -->
          <div class="space-y-3 mb-6">
            <div v-for="feature in service.features" :key="feature"
                 class="flex items-center gap-3 group-hover:translate-x-2 transition-transform duration-300">
              <div class="w-2 h-2 bg-gradient-to-r from-[#0e437d] to-[#22ae84] rounded-full flex-shrink-0"></div>
              <span class="text-gray-700 font-medium text-sm">{{ feature }}</span>
            </div>
          </div>

          <!-- Plateformes/Objectifs -->
          <div class="p-4 bg-gradient-to-r from-gray-50 to-white rounded-xl border border-gray-100 mb-6">
            <div class="text-sm text-gray-500 mb-2">
              <span v-if="service.platforms">Plateformes :</span>
              <span v-if="service.formats">Formats :</span>
              <span v-if="service.engagement">Engagement :</span>
              <span v-if="service.objectives">Objectifs :</span>
              <span v-if="service.collaborations">Collaborations :</span>
              <span v-if="service.metrics">Métriques :</span>
            </div>
            <div class="flex flex-wrap gap-2">
              <span v-for="item in (service.platforms || service.formats || service.engagement || service.objectives || service.collaborations || service.metrics)" :key="item"
                    class="inline-block px-3 py-1 bg-white text-gray-700 text-xs rounded-full border border-gray-200">
                {{ item }}
              </span>
            </div>
          </div>

          <!-- Lien vers plus d'info -->
          <div class="mt-6 pt-6 border-t border-gray-100">
            <div class="flex items-center text-sm text-[#0e437d] font-medium group-hover:text-[#22ae84] transition-colors cursor-pointer">
              <span>Voir des études de cas</span>
              <ChevronRight :size="16" class="ml-1 group-hover:translate-x-1 transition-transform" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Plateformes gérées -->
  <section class="py-20 bg-gradient-to-br from-gray-50 via-white to-gray-50 animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Plateformes Sociales Maîtrisées</h2>
        <p class="text-gray-600 text-lg">Expertise sur toutes les principales plateformes sociales</p>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
        <div v-for="platform in platforms" :key="platform.name"
             class="group bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
          <div class="text-lg font-bold text-gray-900 mb-2 group-hover:text-[#0e437d] transition-colors">
            {{ platform.name }}
          </div>
          <div class="text-sm text-gray-500">{{ platform.category }}</div>
          <div class="w-8 h-1 bg-gradient-to-r from-[#0e437d] to-[#22ae84] mx-auto mt-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>
      </div>

      <!-- Note sur l'approche multi-plateformes -->
      <div class="mt-12 bg-gradient-to-r from-[#0e437d]/5 to-[#22ae84]/5 rounded-2xl p-6 border border-[#0e437d]/10">
        <div class="flex items-start gap-4">
          <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#0e437d] to-[#22ae84] flex items-center justify-center flex-shrink-0">
            <Globe :size="24" class="text-white" />
          </div>
          <div>
            <h4 class="text-lg font-semibold text-gray-900 mb-2">Approche cross-platform intelligente</h4>
            <p class="text-gray-600">
              Nous adaptons notre stratégie à chaque plateforme : contenu visuel sur Instagram,
              professionnel sur LinkedIn, conversationnel sur Twitter/X, et viral sur TikTok.
              Chaque réseau social a ses codes que nous maîtrisons parfaitement pour maximiser
              votre impact.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Avantages -->
  <section class="py-20 bg-white animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Pourquoi notre approche sociale ?</h2>
        <p class="text-gray-600 text-lg">La stratégie qui transforme vos followers en ambassadeurs</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div v-for="(benefit, index) in benefits" :key="benefit.title"
             class="group text-center p-6 bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
          <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-[#0e437d]/10 to-[#22ae84]/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
            <component :is="benefit.icon" :size="28" class="text-[#0e437d]" />
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">{{ benefit.title }}</h3>
          <p class="text-gray-600">{{ benefit.description }}</p>
          <div class="w-12 h-1 bg-gradient-to-r from-[#0e437d] to-[#22ae84] mx-auto mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Processus social media -->
  <section class="py-20 bg-gradient-to-br from-[#0e437d]/5 to-[#22ae84]/5 animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Notre Processus Social Media</h2>
        <p class="text-gray-600 text-lg">Une méthodologie structurée pour des résultats mesurables</p>
      </div>

      <div class="grid md:grid-cols-4 gap-8">
        <div v-for="(step, index) in [
          { title: 'Audit & Analyse', desc: 'Analyse complète de votre présence actuelle' },
          { title: 'Stratégie & Planning', desc: 'Définition des objectifs et planification' },
          { title: 'Création & Publication', desc: 'Production et diffusion du contenu' },
          { title: 'Analyse & Optimisation', desc: 'Mesure des résultats et ajustements' }
        ]" :key="index"
        class="relative">
          <div class="text-center p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
            <div class="text-4xl font-bold text-[#0e437d]/20 mb-4">0{{ index + 1 }}</div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ step.title }}</h3>
            <p class="text-gray-600">{{ step.desc }}</p>
          </div>
          <div v-if="index < 3" class="hidden md:block absolute top-1/2 right-0 w-8 h-1 bg-gradient-to-r from-[#0e437d] to-[#22ae84] transform translate-x-full"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Galerie de contenu (placeholder) -->
  <section class="py-20 bg-white animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Notre Contenu à Impact</h2>
        <p class="text-gray-600 text-lg">Exemples de contenu créatif qui engage et convertit</p>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div v-for="i in 4" :key="i"
             class="group relative aspect-square bg-gradient-to-br from-[#0e437d]/20 to-[#22ae84]/20 rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-300">
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-16 h-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
              <Hashtag :size="24" class="text-white" />
            </div>
          </div>
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          <div class="absolute bottom-0 left-0 right-0 p-4 text-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
            <p class="text-sm font-semibold">Campagne {{ i }}</p>
          </div>
        </div>
      </div>

      <div class="text-center mt-8">
        <a href="/portfolio"
           class="group inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#0e437d] to-[#22ae84] text-white font-semibold rounded-xl hover:shadow-xl transition-all duration-300 hover:scale-105">
          <span>Voir notre portfolio social media</span>
          <ChevronRight :size="18" class="group-hover:translate-x-1 transition-transform" />
        </a>
      </div>
    </div>
  </section>

  <!-- CTA Final -->
  <section class="py-20 bg-gradient-to-br from-[#0e437d] via-[#22ae84] to-[#1c978a] text-white animate-on-scroll">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <Sparkles :size="48" class="mx-auto mb-6 text-[#FFD166] animate-pulse" />

      <h2 class="text-4xl md:text-5xl font-bold mb-6">
        Prêt à <span class="text-[#FFD166]">exploser</span> sur les réseaux ?
      </h2>

      <p class="text-xl opacity-90 mb-10 max-w-2xl mx-auto">
        Discutons de votre stratégie sociale et créons ensemble une présence digitale qui domine.
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <a href="/contact"
           class="group relative px-8 py-4 bg-white text-[#0e437d] rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105">
          <span class="relative z-10 flex items-center gap-3">
            <Mail :size="20" /> Obtenir une stratégie personnalisée
          </span>
          <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </a>

        <a href="tel:+33612345678"
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

.animation-delay-500 {
  animation-delay: 500ms;
}

.animation-delay-1000 {
  animation-delay: 1000ms;
}

.animation-delay-1500 {
  animation-delay: 1500ms;
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
