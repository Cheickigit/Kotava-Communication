<!-- resources/js/Pages/Services/Branding.vue -->
<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/GuestLayout.vue';
import { ArrowLeft, Palette, Check, Sparkles, Brush, Layers, Type, Grid, Compass, Eye, Zap, ChevronRight, Mail, Phone, Target, Award, TrendingUp, Heart, Users, Clock, Shield } from 'lucide-vue-next';
import { ref, onMounted } from 'vue';

defineOptions({ layout: MainLayout });

const services = ref([
  {
    title: 'Création de Logo',
    description: 'Logo unique et mémorable qui représente l\'essence de votre marque',
    icon: Compass,
    color: 'from-[#22ae84] to-[#1c978a]',
    features: ['Recherche approfondie', 'Esquisses multiples', 'Déclinaisons complètes', 'Guide d\'utilisation'],
    deliverables: ['Logo principal', 'Variantes', 'Format vectoriel', 'Pack d\'icônes']
  },
  {
    title: 'Charte Graphique',
    description: 'Système visuel cohérent pour une identité unifiée sur tous les supports',
    icon: Grid,
    color: 'from-[#1c978a] to-[#178e8b]',
    features: ['Palette de couleurs', 'Typographie harmonieuse', 'Éléments graphiques', 'Guidelines complètes'],
    deliverables: ['Guide d\'identité', 'Système de couleurs', 'Typographie', 'Éléments UI']
  },
  {
    title: 'Design Print',
    description: 'Supports physiques premium qui impressionnent vos clients',
    icon: Type,
    color: 'from-[#178e8b] to-[#0e437d]',
    features: ['Cartes de visite', 'Papeterie corporate', 'Brochures', 'Packaging'],
    deliverables: ['Fichiers print-ready', 'Maquettes 3D', 'Spécifications techniques', 'Impression conseil']
  },
  {
    title: 'Design UI/UX Digital',
    description: 'Interfaces utilisateur intuitives et expériences digitales fluides',
    icon: Eye,
    color: 'from-[#0e437d] to-[#22ae84]',
    features: ['Wireframes', 'Prototypes interactifs', 'Design système', 'Tests utilisateur'],
    deliverables: ['Maquettes Figma', 'Prototypes cliquables', 'Design system', 'Documentation']
  },
  {
    title: 'Identité de Marque',
    description: 'Stratégie de marque complète avec positionnement unique',
    icon: Layers,
    color: 'from-[#22ae84] to-[#1c978a]',
    features: ['Positionnement', 'Tone of voice', 'Archétype de marque', 'Récit narratif'],
    deliverables: ['Brand book', 'Personas', 'Messaging', 'Stratégie contenu']
  },
  {
    title: 'Motion Design Branding',
    description: 'Animations qui donnent vie à votre identité visuelle',
    icon: Zap,
    color: 'from-[#1c978a] to-[#178e8b]',
    features: ['Logo animé', 'Animations UI', 'Vidéos explicatives', 'Stickers animés'],
    deliverables: ['Animations After Effects', 'Lottie files', 'GIFs animés', 'Vidéos courtes']
  }
]);

const deliverables = ref([
  { name: 'Logo Vectoriel', category: 'Format scalable' },
  { name: 'Brand Book', category: 'Guide complet' },
  { name: 'Pack UI/UX', category: 'Design système' },
  { name: 'Animations', category: 'Motion design' },
  { name: 'Templates', category: 'Modèles réutilisables' },
  { name: 'Assets Pack', category: 'Bibliothèque complète' }
]);

const benefits = ref([
  { title: 'Design Unique', description: 'Créations originales sur-mesure', icon: Brush },
  { title: 'Cohérence Visuelle', description: 'Identité unifiée sur tous les supports', icon: Grid },
  { title: 'Livrables Complets', description: 'Tous les formats et versions inclus', icon: Layers },
  { title: 'Support Continu', description: 'Accompagnement après livraison', icon: Shield }
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
  <Head title="Branding & Design - KOTAVA Communication" />

  <!-- Hero Section avec animation -->
  <section class="relative bg-gradient-to-br from-[#22ae84] via-[#1c978a] to-[#178e8b] py-24 overflow-hidden min-h-[80vh] flex items-center">
    <!-- Animation background -->
    <div class="absolute inset-0 overflow-hidden">
      <!-- Effets design créatifs -->
      <div class="absolute top-10 left-10 w-48 h-48 bg-[#FFD166] rounded-full opacity-20 animate-pulse animation-delay-1000"></div>
      <div class="absolute bottom-20 right-20 w-64 h-64 bg-[#EF476F] rounded-full opacity-15 animate-pulse animation-delay-1500"></div>
      <div class="absolute top-1/3 right-1/4 w-32 h-32 bg-[#06D6A0] rounded-full opacity-20 animate-pulse"></div>

      <!-- Effet design pattern -->
      <div class="absolute inset-0 opacity-5"
           style="background-image: radial-gradient(circle at 20% 80%, rgba(255,255,255,0.3) 1px, transparent 1px),
                  radial-gradient(circle at 80% 20%, rgba(255,255,255,0.2) 1px, transparent 1px);
                  background-size: 50px 50px, 70px 70px;"></div>

      <!-- Particules créatives -->
      <div v-for="i in 15" :key="i"
           class="absolute w-2 h-2 bg-white rounded-full opacity-30 animate-float"
           :style="{
             left: `${Math.random() * 100}%`,
             top: `${Math.random() * 100}%`,
             animationDelay: `${Math.random() * 4}s`,
             animationDuration: `${8 + Math.random() * 15}s`
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
        <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-[#22ae84] to-[#1c978a] flex items-center justify-center shadow-2xl group-hover:scale-110 transition-transform duration-500">
          <Palette :size="36" class="text-white" />
        </div>
        <div class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white/20 backdrop-blur-lg text-white text-sm font-medium animate-bounce-subtle">
          <Sparkles :size="16" />
          <span>Identité visuelle sur-mesure</span>
        </div>
      </div>

      <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 animate-slide-up">
        Branding & <span class="text-[#FFD166] relative">
          Design
          <span class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-[#FFD166] to-transparent animate-underline"></span>
        </span>
      </h1>

      <p class="text-xl md:text-2xl text-white/90 max-w-3xl leading-relaxed mb-10 animate-slide-up animation-delay-200">
        Créez une identité visuelle <span class="text-[#FFD166] font-semibold">forte et mémorable</span>
        qui marque les esprits, fidélise vos clients et différencie votre marque.
      </p>

      <!-- CTA Hero -->
      <div class="flex flex-col sm:flex-row gap-4 animate-slide-up animation-delay-400">
        <a href="/contact"
           class="group relative px-8 py-4 bg-gradient-to-r from-[#FFD166] to-[#FFB347] text-gray-900 rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105 animate-pulse-subtle max-w-xs">
          <span class="relative z-10 flex items-center gap-2">
            Créer mon identité visuelle <ChevronRight :size="20" class="group-hover:translate-x-1 transition-transform" />
          </span>
          <div class="absolute inset-0 bg-gradient-to-r from-[#FFD166] to-[#FFB347] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </a>

        <a href="tel:+33612345678"
           class="group px-6 py-4 bg-white/10 backdrop-blur-lg text-white rounded-xl font-semibold text-lg border-2 border-white/20 hover:bg-white/20 hover:border-white/40 transition-all duration-300 max-w-xs">
          <span class="flex items-center gap-2">
            <Phone :size="20" /> Demander un audit branding
          </span>
        </a>
      </div>
    </div>
  </section>

  <!-- Statistiques -->
  <section class="py-16 bg-gradient-to-r from-white via-gray-50 to-white stats-section animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
        <div v-for="(stat, index) in [
          { value: '100%', label: 'Design sur-mesure', icon: Brush },
          { value: '3x', label: 'Reconnaissance augmentée', icon: Eye },
          { value: '24/7', label: 'Support créatif', icon: Shield },
          { value: 'A+', label: 'Qualité garantie', icon: Award }
        ]" :key="index"
        class="text-center p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
          <div class="text-4xl font-bold text-[#22ae84] mb-2">{{ stat.value }}</div>
          <div class="text-gray-600 font-medium">{{ stat.label }}</div>
          <div class="w-12 h-1 bg-gradient-to-r from-[#22ae84] to-[#1c978a] mx-auto mt-3"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Nos services branding -->
  <section class="py-20 bg-white animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Nos Services de Branding</h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">Une approche complète pour construire une marque forte</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div v-for="(service, index) in services" :key="service.title"
             class="group bg-white rounded-3xl p-8 border border-gray-100 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
          <!-- Icon animé -->
          <div :class="['w-16 h-16 mb-6 rounded-2xl bg-gradient-to-br flex items-center justify-center group-hover:scale-110 transition-transform duration-300', service.color]">
            <component :is="service.icon" :size="28" class="text-white" />
          </div>

          <!-- Titre et description -->
          <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-[#22ae84] transition-colors duration-300">
            {{ service.title }}
          </h3>
          <p class="text-gray-600 mb-6 leading-relaxed">{{ service.description }}</p>

          <!-- Features -->
          <div class="space-y-3 mb-6">
            <div v-for="feature in service.features" :key="feature"
                 class="flex items-center gap-3 group-hover:translate-x-2 transition-transform duration-300">
              <div class="w-2 h-2 bg-gradient-to-r from-[#22ae84] to-[#1c978a] rounded-full flex-shrink-0"></div>
              <span class="text-gray-700 font-medium text-sm">{{ feature }}</span>
            </div>
          </div>

          <!-- Livrables -->
          <div class="p-4 bg-gradient-to-r from-gray-50 to-white rounded-xl border border-gray-100 mb-6">
            <div class="text-sm text-gray-500 mb-2">Livrables inclus :</div>
            <div class="flex flex-wrap gap-2">
              <span v-for="item in service.deliverables" :key="item"
                    class="inline-block px-3 py-1 bg-white text-gray-700 text-xs rounded-full border border-gray-200">
                {{ item }}
              </span>
            </div>
          </div>

          <!-- Lien vers plus d'info -->
          <div class="mt-6 pt-6 border-t border-gray-100">
            <div class="flex items-center text-sm text-[#22ae84] font-medium group-hover:text-[#1c978a] transition-colors cursor-pointer">
              <span>Voir des exemples</span>
              <ChevronRight :size="16" class="ml-1 group-hover:translate-x-1 transition-transform" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Livrables inclus -->
  <section class="py-20 bg-gradient-to-br from-gray-50 via-white to-gray-50 animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Livrables Complets</h2>
        <p class="text-gray-600 text-lg">Tous les fichiers et formats nécessaires pour votre marque</p>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
        <div v-for="item in deliverables" :key="item.name"
             class="group bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
          <div class="text-lg font-bold text-gray-900 mb-2 group-hover:text-[#22ae84] transition-colors">
            {{ item.name }}
          </div>
          <div class="text-sm text-gray-500">{{ item.category }}</div>
          <div class="w-8 h-1 bg-gradient-to-r from-[#22ae84] to-[#1c978a] mx-auto mt-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>
      </div>

      <!-- Note sur les formats -->
      <div class="mt-12 bg-gradient-to-r from-[#22ae84]/5 to-[#1c978a]/5 rounded-2xl p-6 border border-[#22ae84]/10">
        <div class="flex items-start gap-4">
          <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#22ae84] to-[#1c978a] flex items-center justify-center flex-shrink-0">
            <Layers :size="24" class="text-white" />
          </div>
          <div>
            <h4 class="text-lg font-semibold text-gray-900 mb-2">Formats standards et professionnels</h4>
            <p class="text-gray-600">
              Nous fournissons tous les formats nécessaires : vectoriels (AI, EPS, SVG), pixels (PNG, JPG),
              fichiers d'impression (PDF print-ready) et fichiers digitaux optimisés. Tous nos livrables
              sont organisés dans une structure claire et professionnelle.
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
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Pourquoi choisir notre branding ?</h2>
        <p class="text-gray-600 text-lg">L'investissement qui transforme votre image de marque</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div v-for="(benefit, index) in benefits" :key="benefit.title"
             class="group text-center p-6 bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
          <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-[#22ae84]/10 to-[#1c978a]/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
            <component :is="benefit.icon" :size="28" class="text-[#22ae84]" />
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">{{ benefit.title }}</h3>
          <p class="text-gray-600">{{ benefit.description }}</p>
          <div class="w-12 h-1 bg-gradient-to-r from-[#22ae84] to-[#1c978a] mx-auto mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Processus créatif -->
  <section class="py-20 bg-gradient-to-br from-[#22ae84]/5 to-[#1c978a]/5 animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Notre Processus Créatif</h2>
        <p class="text-gray-600 text-lg">Une méthodologie éprouvée pour des résultats exceptionnels</p>
      </div>

      <div class="grid md:grid-cols-4 gap-8">
        <div v-for="(step, index) in [
          { title: 'Découverte', desc: 'Audit, brief créatif, recherche' },
          { title: 'Conception', desc: 'Esquisses, exploration, concepts' },
          { title: 'Développement', desc: 'Affinage, feedback, itérations' },
          { title: 'Livraison', desc: 'Finalisation, formats, formation' }
        ]" :key="index"
        class="relative">
          <div class="text-center p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
            <div class="text-4xl font-bold text-[#22ae84]/20 mb-4">0{{ index + 1 }}</div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ step.title }}</h3>
            <p class="text-gray-600">{{ step.desc }}</p>
          </div>
          <div v-if="index < 3" class="hidden md:block absolute top-1/2 right-0 w-8 h-1 bg-gradient-to-r from-[#22ae84] to-[#1c978a] transform translate-x-full"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Portfolio branding (placeholder) -->
  <section class="py-20 bg-white animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Notre Portfolio Branding</h2>
        <p class="text-gray-600 text-lg">Découvrez des identités visuelles qui ont transformé des marques</p>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div v-for="i in 4" :key="i"
             class="group relative aspect-square bg-gradient-to-br from-[#22ae84]/20 to-[#1c978a]/20 rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-300">
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-16 h-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
              <Palette :size="24" class="text-white" />
            </div>
          </div>
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          <div class="absolute bottom-0 left-0 right-0 p-4 text-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
            <p class="text-sm font-semibold">Projet branding {{ i }}</p>
          </div>
        </div>
      </div>

      <div class="text-center mt-8">
        <a href="/portfolio"
           class="group inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#22ae84] to-[#1c978a] text-white font-semibold rounded-xl hover:shadow-xl transition-all duration-300 hover:scale-105">
          <span>Voir notre portfolio complet</span>
          <ChevronRight :size="18" class="group-hover:translate-x-1 transition-transform" />
        </a>
      </div>
    </div>
  </section>

  <!-- CTA Final -->
  <section class="py-20 bg-gradient-to-br from-[#22ae84] via-[#1c978a] to-[#178e8b] text-white animate-on-scroll">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <Sparkles :size="48" class="mx-auto mb-6 text-[#FFD166] animate-pulse" />

      <h2 class="text-4xl md:text-5xl font-bold mb-6">
        Prêt à <span class="text-[#FFD166]">transformer</span> votre image ?
      </h2>

      <p class="text-xl opacity-90 mb-10 max-w-2xl mx-auto">
        Discutons de votre projet branding et créons ensemble une identité visuelle qui vous ressemble.
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <a href="/contact"
           class="group relative px-8 py-4 bg-white text-[#22ae84] rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105">
          <span class="relative z-10 flex items-center gap-3">
            <Mail :size="20" /> Obtenir un devis personnalisé
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
