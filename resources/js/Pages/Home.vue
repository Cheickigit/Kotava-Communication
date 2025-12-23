<script setup>
import { ref, onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {
  ArrowRight,
  Sparkles,
  Target,
  TrendingUp,
  Users,
  Palette,
  Globe,
  Video,
  Calendar,
  MessageSquare,
  ChevronRight,
  Star,
  Award,
  Heart,
  Zap,
  Check,
  Phone,
  Mail,
  Rocket,
  BookOpen,
  Camera,
  TrendingUp as TrendingUpIcon
} from 'lucide-vue-next';

defineProps({
  realisations: Array,
  actualites: Array,
  stats: Object,
});

const services = [
  {
    icon: Target,
    title: 'Stratégie & Conseil',
    description: 'Audit de marque, stratégie marketing digitale et positionnement de marque',
    color: 'from-[#0e437d] to-[#22ae84]',
    link: '/services/strategie-conseil'
  },
  {
    icon: Palette,
    title: 'Branding & Design',
    description: 'Identité visuelle complète, logo et charte graphique premium',
    color: 'from-[#22ae84] to-[#1c978a]',
    link: '/services/branding'
  },
  {
    icon: Globe,
    title: 'Digital & Web',
    description: 'Sites web vitrine et e-commerce, UX/UI design optimisé',
    color: 'from-[#1c978a] to-[#178e8b]',
    link: '/services/digital-web'
  },
  {
    icon: Video,
    title: 'Production Audiovisuel',
    description: 'Tournage vidéo, photographie et motion design professionnel',
    color: 'from-[#178e8b] to-[#0e437d]',
    link: '/services/audiovisuel'
  },
  {
    icon: Calendar,
    title: 'Événementiel & RP',
    description: 'Organisation d\'événements et stratégie d\'influence',
    color: 'from-[#22ae84] to-[#1c978a]',
    link: '/services/evenementiel'
  },
  {
    icon: MessageSquare,
    title: 'Social Media & Contenu',
    description: 'Gestion réseaux sociaux et campagnes publicitaires ciblées',
    color: 'from-[#0e437d] to-[#22ae84]',
    link: '/services/social-media'
  }
];

const stats = ref([
  { value: '50+', label: 'Projets réussis', icon: Check },
  { value: '98%', label: 'Clients satisfaits', icon: Heart },
  { value: '30%', label: 'Croissance annuelle', icon: TrendingUpIcon },
  { value: '24/7', label: 'Support disponible', icon: Zap }
]);

const testimonials = [
  {
    name: 'Marie Kouassi',
    role: 'CEO, TechStart Africa',
    content: 'KOTAVA a transformé notre présence digitale. Leur approche stratégique et leur créativité ont dépassé nos attentes.',
    rating: 5
  },
  {
    name: 'Jean-Pierre Dossa',
    role: 'Directeur Marketing, BeniPlus',
    content: 'Une équipe professionnelle qui comprend les enjeux du marché africain. Résultats impressionnants en 3 mois.',
    rating: 5
  },
  {
    name: 'Fatoumata Diallo',
    role: 'Fondatrice, AfroMode',
    content: 'Leur expertise en branding nous a permis de nous démarquer. Un partenaire de confiance pour notre croissance.',
    rating: 5
  }
];

const currentTestimonial = ref(0);

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

  // Auto-rotate testimonials
  setInterval(() => {
    currentTestimonial.value = (currentTestimonial.value + 1) % testimonials.length;
  }, 5000);

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
</script>

<template>
  <GuestLayout>
    <Head title="Accueil - KOTAVA Communication" />

    <!-- Hero Section avec animations -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-[#0e437d] via-[#1a6ca3] to-[#22ae84] hero-section animate-on-scroll">
      <!-- Animation background -->
      <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-20 left-10 w-64 h-64 bg-[#FFD166] rounded-full opacity-20 animate-pulse animation-delay-1000"></div>
        <div class="absolute bottom-20 right-10 w-80 h-80 bg-[#EF476F] rounded-full opacity-15 animate-pulse animation-delay-2000"></div>
        <div class="absolute top-1/2 left-1/4 w-48 h-48 bg-[#06D6A0] rounded-full opacity-20 animate-pulse"></div>

        <!-- Effet shimmer -->
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent animate-shimmer"></div>
      </div>

      <!-- Glass Card Hero -->
      <div class="relative z-10 max-w-7xl mx-auto px-6 py-20 text-center">
        <div class="backdrop-blur-lg bg-white/10 rounded-3xl p-12 shadow-2xl border border-white/20">
          <!-- Badge animé -->
          <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-6 py-3 rounded-full text-white mb-8 text-sm font-medium animate-bounce-subtle">
            <Sparkles :size="16" />
            <span class="font-semibold">Agence de Communication Premium</span>
          </div>

          <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 animate-slide-up">
            Transformez Votre
            <span class="block text-[#FFD166] relative">
              Présence Digitale
              <span class="absolute -bottom-2 left-0 right-0 mx-auto w-64 h-1 bg-gradient-to-r from-[#FFD166] to-transparent animate-underline"></span>
            </span>
          </h1>

          <p class="text-xl md:text-2xl text-white/90 mb-10 max-w-3xl mx-auto leading-relaxed animate-slide-up animation-delay-200">
            Redéfinir la communication comme une <span class="text-[#FFD166] font-semibold">expérience sensorielle et émotionnelle</span>,
            où chaque interaction devient une connexion authentique.
          </p>

          <!-- CTA Hero -->
          <div class="flex flex-col sm:flex-row gap-4 justify-center animate-slide-up animation-delay-400">
            <Link href="/contact"
                  class="group relative px-8 py-4 bg-gradient-to-r from-[#FFD166] to-[#FFB347] text-gray-900 rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105 animate-pulse-subtle">
              <span class="relative z-10 flex items-center gap-2">
                Démarrer un Projet
                <ArrowRight :size="20" class="group-hover:translate-x-1 transition-transform" />
              </span>
              <div class="absolute inset-0 bg-gradient-to-r from-[#FFD166] to-[#FFB347] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </Link>
            <Link href="/portfolio"
                  class="group px-8 py-4 bg-white/10 backdrop-blur-lg border-2 border-white/20 text-white rounded-xl font-semibold text-lg hover:bg-white/20 hover:border-white/40 transition-all duration-300">
              <span class="flex items-center gap-2">
                Voir nos Réalisations
              </span>
            </Link>
          </div>
        </div>

        <!-- Stats Cards avec animations -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-16 stats-section">
          <div class="backdrop-blur-md bg-white/10 rounded-2xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300 hover:-translate-y-2 group">
            <div class="text-4xl font-bold text-white mb-2 stat-value">50+</div>
            <div class="text-white/80 text-sm">Projets réussis</div>
            <div class="w-8 h-1 bg-gradient-to-r from-[#FFD166] to-transparent mx-auto mt-3 opacity-0 group-hover:opacity-100 transition-opacity"></div>
          </div>
          <div class="backdrop-blur-md bg-white/10 rounded-2xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300 hover:-translate-y-2 group">
            <div class="text-4xl font-bold text-white mb-2 stat-value">98%</div>
            <div class="text-white/80 text-sm">Clients satisfaits</div>
            <div class="w-8 h-1 bg-gradient-to-r from-[#FFD166] to-transparent mx-auto mt-3 opacity-0 group-hover:opacity-100 transition-opacity"></div>
          </div>
          <div class="backdrop-blur-md bg-white/10 rounded-2xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300 hover:-translate-y-2 group">
            <div class="text-4xl font-bold text-white mb-2 stat-value">30%</div>
            <div class="text-white/80 text-sm">Croissance annuelle</div>
            <div class="w-8 h-1 bg-gradient-to-r from-[#FFD166] to-transparent mx-auto mt-3 opacity-0 group-hover:opacity-100 transition-opacity"></div>
          </div>
          <div class="backdrop-blur-md bg-white/10 rounded-2xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300 hover:-translate-y-2 group">
            <div class="text-4xl font-bold text-white mb-2 stat-value">24/7</div>
            <div class="text-white/80 text-sm">Support disponible</div>
            <div class="w-8 h-1 bg-gradient-to-r from-[#FFD166] to-transparent mx-auto mt-3 opacity-0 group-hover:opacity-100 transition-opacity"></div>
          </div>
        </div>
      </div>

      <!-- Scroll Indicator -->
      <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
        <div class="w-8 h-12 rounded-full border-2 border-white/50 flex items-start justify-center p-2">
          <div class="w-1 h-3 bg-white rounded-full"></div>
        </div>
      </div>
    </section>

    <!-- Services Section -->
    <section class="py-24 bg-white animate-on-scroll">
      <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
          <div class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#0e437d]/10 text-[#0e437d] mb-4 text-sm font-semibold animate-fade-in">
            <Rocket :size="16" />
            <span>Nos domaines d'expertise</span>
          </div>
          <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 animate-fade-in animation-delay-200">
            Nos Services <span class="text-[#22ae84]">Premium</span>
          </h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto animate-fade-in animation-delay-400">
            Une gamme complète de solutions pour propulser votre marque vers l'excellence digitale
          </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div
            v-for="(service, index) in services"
            :key="index"
            class="group relative bg-gradient-to-br from-gray-50 to-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 border border-gray-100"
          >
            <div class="absolute inset-0 bg-gradient-to-br opacity-0 group-hover:opacity-10 rounded-2xl transition-opacity duration-500" :class="service.color"></div>

            <div class="relative z-10">
              <div class="w-16 h-16 bg-gradient-to-br rounded-xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300" :class="service.color">
                <component :is="service.icon" :size="32" class="text-white" />
              </div>

              <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-[#0e437d] transition-colors">{{ service.title }}</h3>
              <p class="text-gray-600 mb-4">{{ service.description }}</p>

              <Link :href="service.link" class="inline-flex items-center gap-2 text-[#0e437d] font-semibold hover:gap-3 transition-all group/link">
                En savoir plus
                <ChevronRight :size="20" class="group-hover/link:translate-x-1 transition-transform" />
              </Link>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Portfolio Featured -->
    <section class="py-24 bg-gradient-to-br from-gray-50 to-white animate-on-scroll">
      <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
          <div class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#22ae84]/10 text-[#22ae84] mb-4 text-sm font-semibold animate-fade-in">
            <Sparkles :size="16" />
            <span>Nos succès</span>
          </div>
          <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 animate-fade-in animation-delay-200">
            Nos <span class="text-[#22ae84]">Réalisations</span>
          </h2>
          <p class="text-xl text-gray-600 max-w-2xl mx-auto animate-fade-in animation-delay-400">Des projets qui font la différence</p>
        </div>

        <div v-if="realisations && realisations.length > 0" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
          <div
            v-for="realisation in realisations.slice(0, 6)"
            :key="realisation.id"
            class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2"
          >
            <img
              v-if="realisation.image"
              :src="realisation.image"
              :alt="realisation.titre"
              class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-700"
            />
            <div v-else class="w-full h-80 bg-gradient-to-br from-[#0e437d] to-[#22ae84] flex items-center justify-center">
              <Camera :size="64" class="text-white/50" />
            </div>

            <div class="absolute inset-0 bg-gradient-to-t from-[#0e437d]/90 via-[#0e437d]/50 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-6">
              <h3 class="text-2xl font-bold text-white mb-2">{{ realisation.titre }}</h3>
              <p class="text-white/90 mb-4">{{ realisation.description }}</p>
              <Link :href="`/portfolio/${realisation.slug}`" class="inline-flex items-center gap-2 text-white font-semibold group/link">
                Voir le projet
                <ArrowRight :size="20" class="group-hover/link:translate-x-1 transition-transform" />
              </Link>
            </div>
          </div>
        </div>

        <div v-else class="text-center py-12">
          <div class="w-24 h-24 bg-gradient-to-br from-[#0e437d]/10 to-[#22ae84]/10 rounded-2xl flex items-center justify-center mx-auto mb-6 animate-pulse-subtle">
            <Camera :size="48" class="text-[#0e437d]" />
          </div>
          <p class="text-gray-500 text-lg animate-fade-in">Nos projets arrivent bientôt...</p>
        </div>

        <div class="text-center animate-fade-in animation-delay-600">
          <Link href="/portfolio" class="group relative px-8 py-4 bg-gradient-to-r from-[#0e437d] to-[#22ae84] text-white rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105 inline-flex items-center gap-2">
            <span class="relative z-10">
              Voir tout le Portfolio
            </span>
            <ChevronRight :size="20" class="group-hover:translate-x-1 transition-transform" />
          </Link>
        </div>
      </div>
    </section>

    <!-- Pourquoi Nous Choisir -->
    <section class="py-24 bg-white animate-on-scroll">
      <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
          <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
            Pourquoi <span class="text-[#22ae84]">KOTAVA</span> ?
          </h2>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
          <div class="group text-center">
            <div class="relative mb-6">
              <div class="absolute inset-0 bg-gradient-to-br from-[#0e437d]/10 to-[#22ae84]/10 rounded-full blur-lg group-hover:blur-xl transition-all duration-500"></div>
              <div class="relative w-20 h-20 bg-gradient-to-br from-[#0e437d] to-[#22ae84] rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl group-hover:scale-110 transition-transform duration-500">
                <Sparkles :size="36" class="text-white" />
              </div>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#0e437d] transition-colors">Créativité & Authenticité</h3>
            <p class="text-gray-600">Design percutant qui reste gravé dans l'esprit des clients</p>
          </div>

          <div class="group text-center">
            <div class="relative mb-6">
              <div class="absolute inset-0 bg-gradient-to-br from-[#22ae84]/10 to-[#1c978a]/10 rounded-full blur-lg group-hover:blur-xl transition-all duration-500"></div>
              <div class="relative w-20 h-20 bg-gradient-to-br from-[#22ae84] to-[#1c978a] rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl group-hover:scale-110 transition-transform duration-500">
                <Users :size="36" class="text-white" />
              </div>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#0e437d] transition-colors">Connexion & Confiance</h3>
            <p class="text-gray-600">Stratégies qui rapprochent les marques de leur audience</p>
          </div>

          <div class="group text-center">
            <div class="relative mb-6">
              <div class="absolute inset-0 bg-gradient-to-br from-[#1c978a]/10 to-[#178e8b]/10 rounded-full blur-lg group-hover:blur-xl transition-all duration-500"></div>
              <div class="relative w-20 h-20 bg-gradient-to-br from-[#1c978a] to-[#178e8b] rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl group-hover:scale-110 transition-transform duration-500">
                <TrendingUp :size="36" class="text-white" />
              </div>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#0e437d] transition-colors">Innovation & Excellence</h3>
            <p class="text-gray-600">Technologies digitales pour un avantage compétitif</p>
          </div>

          <div class="group text-center">
            <div class="relative mb-6">
              <div class="absolute inset-0 bg-gradient-to-br from-[#178e8b]/10 to-[#0e437d]/10 rounded-full blur-lg group-hover:blur-xl transition-all duration-500"></div>
              <div class="relative w-20 h-20 bg-gradient-to-br from-[#178e8b] to-[#0e437d] rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl group-hover:scale-110 transition-transform duration-500">
                <Award :size="36" class="text-white" />
              </div>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#0e437d] transition-colors">Performance & Impact</h3>
            <p class="text-gray-600">Solutions qui génèrent un impact mesurable</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Témoignages -->
    <section class="py-24 bg-gradient-to-br from-[#0e437d] to-[#22ae84] relative overflow-hidden animate-on-scroll">
      <div class="absolute inset-0 opacity-20">
        <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl animate-pulse animation-delay-1000"></div>
      </div>

      <div class="max-w-4xl mx-auto px-6 relative z-10">
        <div class="text-center mb-16">
          <div class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white/20 backdrop-blur-lg text-white mb-6 text-sm font-medium animate-bounce-subtle">
            <Star :size="16" fill="currentColor" />
            <span>Témoignages clients</span>
          </div>
          <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">
            Ils Nous Font Confiance
          </h2>
        </div>

        <div class="backdrop-blur-lg bg-white/10 rounded-3xl p-12 border border-white/20 shadow-2xl">
          <div class="flex justify-center mb-6">
            <div class="flex gap-1">
              <Star v-for="i in 5" :key="i" :size="24" class="text-[#FFD166] fill-[#FFD166] group-hover:scale-110 transition-transform" />
            </div>
          </div>

          <p class="text-2xl text-white text-center mb-8 leading-relaxed animate-fade-in">
            "{{ testimonials[currentTestimonial].content }}"
          </p>

          <div class="text-center animate-fade-in animation-delay-200">
            <div class="font-bold text-xl text-white mb-1">
              {{ testimonials[currentTestimonial].name }}
            </div>
            <div class="text-white/80">
              {{ testimonials[currentTestimonial].role }}
            </div>
          </div>

          <div class="flex justify-center gap-2 mt-8">
            <button
              v-for="(_, index) in testimonials"
              :key="index"
              @click="currentTestimonial = index"
              class="w-3 h-3 rounded-full transition-all duration-300 hover:scale-125"
              :class="currentTestimonial === index ? 'bg-white w-8' : 'bg-white/50'"
            ></button>
          </div>
        </div>
      </div>
    </section>

    <!-- Blog/Actualités -->
    <section v-if="actualites && actualites.length > 0" class="py-24 bg-gray-50 animate-on-scroll">
      <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
          <div class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#0e437d]/10 text-[#0e437d] mb-4 text-sm font-semibold animate-fade-in">
            <BookOpen :size="16" />
            <span>Nos derniers articles</span>
          </div>
          <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 animate-fade-in animation-delay-200">
            Dernières <span class="text-[#22ae84]">Actualités</span>
          </h2>
        </div>

        <div class="grid md:grid-cols-3 gap-8 mb-12">
          <article
            v-for="article in actualites.slice(0, 3)"
            :key="article.id"
            class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-3"
          >
            <div class="h-56 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
              <img
                v-if="article.image"
                :src="article.image"
                :alt="article.titre"
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

            <div class="p-6">
              <div class="text-sm text-[#22ae84] font-semibold mb-2">{{ article.date }}</div>
              <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#0e437d] transition-colors">{{ article.titre }}</h3>
              <p class="text-gray-600 mb-4 line-clamp-2">{{ article.extrait }}</p>
              <Link :href="`/blog/${article.slug}`" class="inline-flex items-center gap-2 text-[#0e437d] font-semibold hover:gap-3 transition-all group/link">
                Lire la suite
                <ArrowRight :size="18" class="group-hover/link:translate-x-1 transition-transform" />
              </Link>
            </div>
          </article>
        </div>

        <div class="text-center animate-fade-in">
          <Link href="/blog" class="group relative px-8 py-4 bg-gradient-to-r from-[#0e437d] to-[#22ae84] text-white rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105 inline-flex items-center gap-2">
            <span class="relative z-10">
              Toutes les actualités
            </span>
            <ChevronRight :size="20" class="group-hover:translate-x-1 transition-transform" />
          </Link>
        </div>
      </div>
    </section>

    <!-- CTA Final -->
    <section class="py-24 bg-gradient-to-br from-[#0e437d] via-[#1a6ca3] to-[#22ae84] relative overflow-hidden animate-on-scroll">
      <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-20 -left-20 w-64 h-64 bg-white rounded-full opacity-10 blur-3xl animate-pulse animation-delay-1000"></div>
        <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-white rounded-full opacity-10 blur-3xl animate-pulse"></div>
      </div>

      <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
        <Sparkles :size="48" class="mx-auto mb-6 text-[#FFD166] animate-pulse" />

        <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
          Prêt à <span class="text-[#FFD166]">Transformer</span> Votre Marque ?
        </h2>

        <p class="text-xl text-white/90 mb-10 max-w-2xl mx-auto">
          Contactez-nous dès aujourd'hui et découvrez comment nous pouvons propulser votre entreprise vers le succès
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
          <Link href="/contact"
                class="group relative px-8 py-4 bg-white text-[#0e437d] rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105">
            <span class="relative z-10 flex items-center gap-3">
              Démarrer Maintenant
              <ArrowRight :size="20" class="group-hover:translate-x-1 transition-transform" />
            </span>
            <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </Link>
          <a href="tel:+33708999900"
             class="group px-6 py-4 bg-white/10 backdrop-blur-lg border-2 border-white/20 text-white rounded-xl font-semibold text-lg hover:bg-white/20 hover:border-white/40 transition-all duration-300">
            <span class="flex items-center gap-2">
              <Phone :size="20" /> +33 70 89 99 00
            </span>
          </a>
        </div>

        <div class="mt-12 pt-8 border-t border-white/20">
          <p class="text-white/80 mb-4">Ou contactez-nous par email :</p>
          <a href="mailto:contact@kotava.com" class="text-white/90 hover:text-white transition-colors inline-flex items-center gap-2">
            <Mail :size="18" /> contact@kotava.com
          </a>
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

@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.7; }
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

.animate-pulse {
  animation: pulse 2s ease-in-out infinite;
}

.animation-delay-200 {
  animation-delay: 200ms;
}

.animation-delay-400 {
  animation-delay: 400ms;
}

.animation-delay-600 {
  animation-delay: 600ms;
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
