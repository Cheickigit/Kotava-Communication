<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/GuestLayout.vue';
import { Target, Palette, Globe, Video, Calendar, MessageSquare, ArrowRight, Check, Sparkles, Rocket, Star, Users, Zap, ChevronRight, Mail, Phone, Award, TrendingUp, Heart, BarChart, Shield, Clock } from 'lucide-vue-next';
import { ref, onMounted } from 'vue';

defineOptions({ layout: MainLayout });

const services = [
  {
    id: 'strategie',
    icon: Target,
    title: 'Stratégie & Conseil',
    description: 'Audit de marque complet, stratégie marketing digitale et positionnement de marque optimal pour dominer votre marché.',
    color: 'from-[#0e437d] to-[#22ae84]',
    route: 'services.strategie',
    features: [
      'Audit de marque complet',
      'Stratégie marketing digitale',
      'Positionnement de marque',
      'Analyse concurrentielle',
      'Plan d\'action sur mesure'
    ],
    stats: ['+40% ROI moyen', 'Analyse 360°', 'Suivi mensuel']
  },
  {
    id: 'branding',
    icon: Palette,
    title: 'Branding & Design',
    description: 'Création d\'identité visuelle complète, logo premium et charte graphique qui marquent les esprits.',
    color: 'from-[#22ae84] to-[#1c978a]',
    route: 'services.branding',
    features: [
      'Création de logo unique',
      'Charte graphique complète',
      'Identité visuelle cohérente',
      'Design print et digital',
      'Brand guidelines'
    ],
    stats: ['Logo unique', 'Charte complète', 'Support multi-format']
  },
  {
    id: 'digital',
    icon: Globe,
    title: 'Digital & Web',
    description: 'Sites web vitrine et e-commerce sur mesure, avec UX/UI design optimisé pour convertir vos visiteurs.',
    color: 'from-[#1c978a] to-[#178e8b]',
    route: 'services.digital',
    features: [
      'Sites web sur mesure',
      'E-commerce performant',
      'UX/UI Design premium',
      'Applications web',
      'SEO et performance'
    ],
    stats: ['+40% conversion', '99.9% uptime', 'Mobile-first']
  },
  {
    id: 'audiovisuel',
    icon: Video,
    title: 'Production Audiovisuel',
    description: 'Tournage vidéo professionnel, photographie corporate et motion design qui captent l\'attention.',
    color: 'from-[#178e8b] to-[#0e437d]',
    route: 'services.audiovisuel',
    features: [
      'Vidéos corporate',
      'Photographie professionnelle',
      'Motion design & animation',
      'Montage vidéo avancé',
      'Drone et production 4K'
    ],
    stats: ['Production 4K', 'Équipement pro', 'Montage créatif']
  },
  {
    id: 'evenementiel',
    icon: Calendar,
    title: 'Événementiel & RP',
    description: 'Organisation d\'événements mémorables et stratégie d\'influence pour maximiser votre visibilité.',
    color: 'from-[#22ae84] to-[#1c978a]',
    route: 'services.evenementiel',
    features: [
      'Organisation d\'événements',
      'Relations publiques',
      'Stratégie d\'influence',
      'Gestion de crise',
      'Relations presse'
    ],
    stats: ['Événements clés', 'Médias couverts', 'Ambassadeurs']
  },
  {
    id: 'social',
    icon: MessageSquare,
    title: 'Social Media & Contenu',
    description: 'Gestion complète de vos réseaux sociaux et création de campagnes publicitaires ciblées qui génèrent de l\'engagement.',
    color: 'from-[#0e437d] to-[#22ae84]',
    route: 'services.social',
    features: [
      'Gestion des réseaux sociaux',
      'Création de contenu viral',
      'Campagnes publicitaires',
      'Community management',
      'Stratégie d\'influence'
    ],
    stats: ['+300% engagement', 'Contenu viral', 'Communauté active']
  }
];

const packs = ref([
  {
    title: 'Pack Branding',
    subtitle: 'L\'identité qui marque',
    color: 'from-[#0e437d] to-[#22ae84]',
    price: 'À partir de 2 500€',
    features: ['Logo professionnel + déclinaisons', 'Charte graphique complète', 'Supports de base (cartes, papeterie)', 'Guide d\'utilisation'],
    icon: Palette
  },
  {
    title: 'Pack Digital',
    subtitle: 'Une présence qui convertit',
    color: 'from-[#22ae84] to-[#1c978a]',
    price: 'À partir de 3 500€',
    features: ['Site vitrine/e-commerce responsive', 'Référencement SEO de base', 'Optimisation Google Business', 'Kit visuel réseaux sociaux'],
    icon: Globe
  },
  {
    title: 'Pack Social Media',
    subtitle: 'La visibilité qui engage',
    color: 'from-[#1c978a] to-[#178e8b]',
    price: 'À partir de 1 800€/mois',
    features: ['Gestion 2-3 réseaux sociaux', 'Création de contenu premium', 'Planning éditorial mensuel', 'Campagnes sponsorisées + reporting'],
    icon: MessageSquare
  },
  {
    title: 'Pack 360° Premium',
    subtitle: 'Solution clé en main',
    color: 'from-[#178e8b] to-[#0e437d]',
    price: 'Sur devis personnalisé',
    features: ['Branding complet + site web', 'SEO/SEA + réseaux sociaux premium', 'Production audiovisuelle', 'Conseil stratégique continu'],
    icon: Star
  }
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
  <Head title="Nos Services - KOTAVA Communication" />

  <!-- Hero Section avec animation -->
  <section class="relative bg-gradient-to-br from-[#0e437d] via-[#22ae84] to-[#1c978a] py-24 overflow-hidden min-h-[90vh] flex items-center">
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
        <span>Solutions premium sur-mesure</span>
      </div>

      <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 animate-slide-up">
        Nos Services <span class="text-[#FFD166] relative">
          Excellence
          <span class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-[#FFD166] to-transparent animate-underline"></span>
        </span>
      </h1>

      <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto leading-relaxed mb-10 animate-slide-up animation-delay-200">
        Une gamme complète de solutions <span class="text-[#FFD166] font-semibold">innovantes et performantes</span>
        pour propulser votre marque vers l'excellence digitale.
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
            <Phone :size="20" /> Consultation gratuite
          </span>
        </a>
      </div>
    </div>
  </section>

  <!-- Statistiques animées -->
  <section class="py-16 bg-gradient-to-r from-white via-gray-50 to-white stats-section animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
        <div v-for="(stat, index) in [
          { value: '6', label: 'Pôles d\'expertise', icon: Target },
          { value: '95%', label: 'Clients satisfaits', icon: Heart },
          { value: '50+', label: 'Projets réussis', icon: Award },
          { value: '24/7', label: 'Support disponible', icon: Shield }
        ]" :key="index"
        class="text-center p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
          <div class="text-4xl font-bold text-[#0e437d] mb-2">{{ stat.value }}</div>
          <div class="text-gray-600 font-medium">{{ stat.label }}</div>
          <div class="w-12 h-1 bg-gradient-to-r from-[#0e437d] to-[#22ae84] mx-auto mt-3"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Services Grid avec animations -->
  <section class="py-20 bg-gray-50 animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Nos Domaines d'Expertise</h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">Des solutions complètes pour chaque aspect de votre communication</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div
          v-for="(service, index) in services"
          :key="service.id"
          class="group bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100 animate-on-scroll"
          :style="{ animationDelay: `${index * 100}ms` }"
        >
          <!-- Icon avec animation -->
          <div class="relative mb-6">
            <div :class="['absolute inset-0 bg-gradient-to-br', service.color, 'rounded-2xl blur-xl opacity-40 group-hover:opacity-60 transition-opacity duration-500']"></div>
            <div :class="['relative w-16 h-16 rounded-2xl bg-gradient-to-br flex items-center justify-center shadow-2xl group-hover:scale-110 group-hover:rotate-12 transition-all duration-500', service.color]">
              <component :is="service.icon" :size="32" class="text-white" />
            </div>
          </div>

          <!-- Content -->
          <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-[#0e437d] transition-colors duration-300">
            {{ service.title }}
          </h3>

          <p class="text-gray-600 mb-6 leading-relaxed">
            {{ service.description }}
          </p>

          <!-- Stats rapides -->
          <div class="flex flex-wrap gap-2 mb-6">
            <span v-for="stat in service.stats" :key="stat"
                  class="inline-block px-3 py-1 bg-gradient-to-r from-gray-50 to-white text-gray-700 text-sm rounded-full border border-gray-200">
              {{ stat }}
            </span>
          </div>

          <!-- Features List -->
          <ul class="space-y-2 mb-6">
            <li
              v-for="(feature, fIndex) in service.features.slice(0, 3)"
              :key="fIndex"
              class="flex items-center gap-3 group-hover:translate-x-2 transition-transform duration-300"
            >
              <div class="w-2 h-2 bg-gradient-to-r from-green-500 to-emerald-400 rounded-full flex-shrink-0"></div>
              <span class="text-gray-700 text-sm">{{ feature }}</span>
            </li>
          </ul>

          <!-- CTA Button -->
          <Link
            :href="route(service.route)"
            :class="['group/btn inline-flex items-center gap-2 px-6 py-3 rounded-xl font-semibold text-white bg-gradient-to-r hover:shadow-xl transition-all duration-300 hover:scale-105', service.color]"
          >
            Découvrir ce service
            <ArrowRight :size="18" class="group-hover/btn:translate-x-1 transition-transform" />
          </Link>
        </div>
      </div>
    </div>
  </section>

  <!-- Nos Packs Standards avec animations -->
  <section class="py-20 bg-white animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Nos Packs Standards</h2>
        <p class="text-gray-600 text-lg max-w-3xl mx-auto">
          Des solutions <span class="font-semibold text-[#0e437d]">clés en main</span> adaptées à tous les besoins et budgets
        </p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div v-for="(pack, index) in packs" :key="pack.title"
             class="group bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100">
          <!-- Badge avec animation -->
          <div class="inline-flex items-center gap-2 mb-6">
            <div :class="['w-12 h-12 rounded-xl bg-gradient-to-br flex items-center justify-center group-hover:scale-110 transition-transform duration-300', pack.color]">
              <component :is="pack.icon" :size="24" class="text-white" />
            </div>
            <div :class="['px-4 py-2 bg-gradient-to-r text-white text-sm font-semibold rounded-lg', pack.color]">
              {{ pack.title }}
            </div>
          </div>

          <!-- Titre et prix -->
          <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#0e437d] transition-colors duration-300">
            {{ pack.subtitle }}
          </h3>
          <div class="text-2xl font-bold text-[#0e437d] mb-6">{{ pack.price }}</div>

          <!-- Features -->
          <ul class="space-y-3 mb-8">
            <li v-for="feature in pack.features" :key="feature"
                class="flex items-start gap-3 group-hover:translate-x-2 transition-transform duration-300">
              <Check :size="18" class="text-[#22ae84] mt-1 flex-shrink-0" />
              <span class="text-gray-600 text-sm">{{ feature }}</span>
            </li>
          </ul>

          <!-- CTA -->
          <a href="/contact"
             class="group/btn block w-full text-center px-6 py-3 bg-gradient-to-r from-gray-50 to-white text-gray-800 font-semibold rounded-xl border-2 border-gray-200 hover:border-transparent hover:shadow-xl transition-all duration-300 hover:scale-105">
            <span class="flex items-center justify-center gap-2">
              Choisir ce pack
              <ChevronRight :size="16" class="group-hover/btn:translate-x-1 transition-transform" />
            </span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Cible marché avec animations -->
  <section class="py-20 bg-gradient-to-br from-gray-50 via-white to-gray-50 animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Notre Public Cible</h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">Nous accompagnons les entreprises à chaque étape de leur croissance</p>
      </div>

      <div class="grid lg:grid-cols-2 gap-12 mb-12">
        <div class="group bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
          <div class="flex items-center gap-6 mb-6">
            <div class="text-6xl font-bold text-[#0e437d] group-hover:scale-110 transition-transform duration-300">70%</div>
            <div>
              <h3 class="text-xl font-semibold text-gray-900">Marché Africain</h3>
              <p class="text-gray-600">Notre cible prioritaire</p>
            </div>
          </div>
          <p class="text-gray-600 mb-4 leading-relaxed">
            Nous apportons un appui considérable dans la <span class="font-semibold text-[#0e437d]">digitalisation des entreprises africaines</span>,
            avec une compréhension approfondie des marchés locaux et des besoins spécifiques.
          </p>
          <div class="flex items-center text-sm text-[#0e437d] font-medium mt-4">
            <span>En savoir plus sur notre expertise</span>
            <ChevronRight :size="16" class="ml-1 group-hover:translate-x-1 transition-transform" />
          </div>
        </div>

        <div class="group bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
          <div class="flex items-center gap-6 mb-6">
            <div class="text-6xl font-bold text-[#22ae84] group-hover:scale-110 transition-transform duration-300">30%</div>
            <div>
              <h3 class="text-xl font-semibold text-gray-900">International</h3>
              <p class="text-gray-600">Expansion progressive</p>
            </div>
          </div>
          <p class="text-gray-600 leading-relaxed">
            Nous accompagnons également les <span class="font-semibold text-[#22ae84]">entreprises internationales</span> souhaitant développer
            leur présence en Afrique ou bénéficier de notre expertise unique en digitalisation.
          </p>
          <div class="flex items-center text-sm text-[#22ae84] font-medium mt-4">
            <span>Découvrir nos références</span>
            <ChevronRight :size="16" class="ml-1 group-hover:translate-x-1 transition-transform" />
          </div>
        </div>
      </div>

      <!-- Segmentation client -->
      <div class="bg-gradient-to-br from-[#0e437d]/5 to-[#22ae84]/5 rounded-3xl p-8 border border-[#0e437d]/10">
        <div class="flex items-start gap-6 mb-6">
          <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#0e437d] to-[#22ae84] flex items-center justify-center flex-shrink-0">
            <Users :size="28" class="text-white" />
          </div>
          <div>
            <h4 class="text-2xl font-bold text-gray-900 mb-3">Segmentation client :</h4>
            <p class="text-gray-600">Nous adaptons nos solutions à chaque type de client</p>
          </div>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
          <div class="group">
            <h5 class="text-lg font-semibold text-gray-900 mb-3 flex items-center gap-2">
              <Target :size="20" class="text-[#0e437d]" /> PME et Institutions
            </h5>
            <p class="text-gray-600">
              Accompagnement stratégique complet pour entreprises établies avec des besoins de croissance et d'optimisation.
            </p>
            <div class="w-12 h-1 bg-gradient-to-r from-[#0e437d] to-[#22ae84] mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </div>

          <div class="group">
            <h5 class="text-lg font-semibold text-gray-900 mb-3 flex items-center gap-2">
              <Rocket :size="20" class="text-[#22ae84]" /> Start-ups et Particuliers
            </h5>
            <p class="text-gray-600">
              Solutions adaptées aux besoins spécifiques et budgets, idéales pour les projets en lancement ou développement.
            </p>
            <div class="w-12 h-1 bg-gradient-to-r from-[#22ae84] to-[#1c978a] mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section finale -->
  <section class="py-20 bg-gradient-to-br from-[#0e437d] via-[#1a6ca3] to-[#22ae84] text-white animate-on-scroll">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <Sparkles :size="48" class="mx-auto mb-6 text-[#FFD166] animate-pulse" />

      <h2 class="text-4xl md:text-5xl font-bold mb-6">
        Besoin d'un Service <span class="text-[#FFD166]">Personnalisé</span> ?
      </h2>

      <p class="text-xl opacity-90 mb-10 max-w-2xl mx-auto">
        Discutons de votre projet et créons ensemble la solution parfaite pour vos objectifs.
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <a href="/contact"
           class="group relative px-8 py-4 bg-white text-[#0e437d] rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105">
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
