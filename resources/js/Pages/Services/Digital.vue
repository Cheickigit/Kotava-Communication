<!-- resources/js/Pages/Services/Digital.vue -->
<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/GuestLayout.vue';
import { ArrowLeft, Globe, Check, Sparkles, Rocket, Zap, Code, Smartphone, BarChart, Shield, Clock, Users, ChevronRight, Mail, Phone, Target, Award, TrendingUp, Heart } from 'lucide-vue-next';
import { ref, onMounted } from 'vue';

defineOptions({ layout: MainLayout });

const services = ref([
  {
    title: 'Développement Web sur Mesure',
    description: 'Sites vitrines, e-commerce, applications web avec technologies modernes',
    icon: Code,
    color: 'from-[#1c978a] to-[#178e8b]',
    features: ['React/Vue.js', 'Responsive design', 'Performance optimisée', 'SEO intégré']
  },
  {
    title: 'Applications Mobile',
    description: 'Applications iOS et Android natives ou cross-platform',
    icon: Smartphone,
    color: 'from-[#178e8b] to-[#0e437d]',
    features: ['UI/UX optimisée', 'Notifications push', 'Backend API', 'Store déploiement']
  },
  {
    title: 'E-commerce & Marketplaces',
    description: 'Solutions de vente en ligne scalables et sécurisées',
    icon: TrendingUp,
    color: 'from-[#0e437d] to-[#22ae84]',
    features: ['Paiements sécurisés', 'Gestion stocks', 'Analytics avancés', 'Mobile-first']
  },
  {
    title: 'Optimisation Performance',
    description: 'Audit et amélioration des performances techniques',
    icon: Zap,
    color: 'from-[#22ae84] to-[#1c978a]',
    features: ['Audit SEO', 'Vitesse chargement', 'Sécurité renforcée', 'Scalabilité']
  },
  {
    title: 'Maintenance & Support',
    description: 'Support technique continu et mises à jour régulières',
    icon: Shield,
    color: 'from-[#1c978a] to-[#178e8b]',
    features: ['Support 24/7', 'Backups automatiques', 'Mises à jour', 'Monitoring']
  },
  {
    title: 'Formation & Accompagnement',
    description: 'Formation de vos équipes aux outils digitaux',
    icon: Users,
    color: 'from-[#178e8b] to-[#0e437d]',
    features: ['Formation CMS', 'Support technique', 'Best practices', 'Documentation']
  }
]);

const benefits = ref([
  { title: 'Délais respectés', description: 'Livraison dans les temps impartis', icon: Clock },
  { title: 'Support 24/7', description: 'Assistance technique continue', icon: Shield },
  { title: 'Sécurité maximale', description: 'Protection des données et transactions', icon: Shield },
  { title: 'Performance garantie', description: 'Sites rapides et optimisés', icon: Zap }
]);

const technologies = ref([
  { name: 'Vue.js / React', category: 'Frontend' },
  { name: 'Laravel / Node.js', category: 'Backend' },
  { name: 'Tailwind CSS', category: 'UI Framework' },
  { name: 'MySQL / MongoDB', category: 'Database' },
  { name: 'AWS / Vercel', category: 'Hosting' },
  { name: 'Git / Docker', category: 'DevOps' }
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
  <Head title="Digital & Web - KOTAVA Communication" />

  <!-- Hero Section avec animation -->
  <section class="relative bg-gradient-to-br from-[#1c978a] via-[#22ae84] to-[#0e437d] py-24 overflow-hidden min-h-[80vh] flex items-center">
    <!-- Animation background -->
    <div class="absolute inset-0 overflow-hidden">
      <div class="absolute top-20 left-10 w-64 h-64 bg-[#FFD166] rounded-full opacity-20 animate-pulse animation-delay-1000"></div>
      <div class="absolute bottom-20 right-10 w-80 h-80 bg-[#EF476F] rounded-full opacity-15 animate-pulse animation-delay-2000"></div>
      <div class="absolute top-1/2 left-1/4 w-48 h-48 bg-[#06D6A0] rounded-full opacity-20 animate-pulse"></div>

      <!-- Effet code digital -->
      <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent animate-shimmer"></div>

      <!-- Particules flottantes -->
      <div v-for="i in 15" :key="i"
           class="absolute w-2 h-2 bg-white rounded-full opacity-30 animate-float"
           :style="{
             left: `${Math.random() * 100}%`,
             top: `${Math.random() * 100}%`,
             animationDelay: `${Math.random() * 5}s`,
             animationDuration: `${10 + Math.random() * 20}s`
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
        <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-[#1c978a] to-[#178e8b] flex items-center justify-center shadow-2xl group-hover:scale-110 transition-transform duration-500">
          <Globe :size="36" class="text-white" />
        </div>
        <div class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white/20 backdrop-blur-lg text-white text-sm font-medium animate-bounce-subtle">
          <Sparkles :size="16" />
          <span>Solutions digitales avancées</span>
        </div>
      </div>

      <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 animate-slide-up">
        Digital & <span class="text-[#FFD166] relative">
          Web
          <span class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-[#FFD166] to-transparent animate-underline"></span>
        </span>
      </h1>

      <p class="text-xl md:text-2xl text-white/90 max-w-3xl leading-relaxed mb-10 animate-slide-up animation-delay-200">
        Développez votre présence digitale avec des solutions web <span class="text-[#FFD166] font-semibold">innovantes, performantes et scalables</span>
        pour transformer vos idées en réalité digitale.
      </p>

      <!-- CTA Hero -->
      <div class="flex flex-col sm:flex-row gap-4 animate-slide-up animation-delay-400">
        <a href="/contact"
           class="group relative px-8 py-4 bg-gradient-to-r from-[#FFD166] to-[#FFB347] text-gray-900 rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105 animate-pulse-subtle max-w-xs">
          <span class="relative z-10 flex items-center gap-2">
            Démarrer mon projet web <ChevronRight :size="20" class="group-hover:translate-x-1 transition-transform" />
          </span>
          <div class="absolute inset-0 bg-gradient-to-r from-[#FFD166] to-[#FFB347] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </a>

        <a href="tel:+33612345678"
           class="group px-6 py-4 bg-white/10 backdrop-blur-lg text-white rounded-xl font-semibold text-lg border-2 border-white/20 hover:bg-white/20 hover:border-white/40 transition-all duration-300 max-w-xs">
          <span class="flex items-center gap-2">
            <Phone :size="20" /> Consultation gratuite
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
          { value: '99.9%', label: 'Uptime garantie', icon: Shield },
          { value: '<2s', label: 'Temps de chargement', icon: Zap },
          { value: '100%', label: 'Mobile responsive', icon: Smartphone },
          { value: 'A+', label: 'Sécurité SSL', icon: Shield }
        ]" :key="index"
        class="text-center p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
          <div class="text-4xl font-bold text-[#1c978a] mb-2">{{ stat.value }}</div>
          <div class="text-gray-600 font-medium">{{ stat.label }}</div>
          <div class="w-12 h-1 bg-gradient-to-r from-[#1c978a] to-[#178e8b] mx-auto mt-3"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Nos services -->
  <section class="py-20 bg-white animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Nos Solutions Digitales</h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">Des technologies de pointe pour des résultats exceptionnels</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div v-for="(service, index) in services" :key="service.title"
             class="group bg-white rounded-3xl p-8 border border-gray-100 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
          <!-- Icon animé -->
          <div :class="['w-16 h-16 mb-6 rounded-2xl bg-gradient-to-br flex items-center justify-center group-hover:scale-110 transition-transform duration-300', service.color]">
            <component :is="service.icon" :size="28" class="text-white" />
          </div>

          <!-- Titre et description -->
          <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-[#1c978a] transition-colors duration-300">
            {{ service.title }}
          </h3>
          <p class="text-gray-600 mb-6 leading-relaxed">{{ service.description }}</p>

          <!-- Features -->
          <div class="space-y-3">
            <div v-for="feature in service.features" :key="feature"
                 class="flex items-center gap-3 group-hover:translate-x-2 transition-transform duration-300">
              <div class="w-2 h-2 bg-gradient-to-r from-green-500 to-emerald-400 rounded-full flex-shrink-0"></div>
              <span class="text-gray-700 font-medium">{{ feature }}</span>
            </div>
          </div>

          <!-- Lien vers plus d'info -->
          <div class="mt-8 pt-6 border-t border-gray-100">
            <div class="flex items-center text-sm text-[#1c978a] font-medium group-hover:text-[#22ae84] transition-colors cursor-pointer">
              <span>En savoir plus</span>
              <ChevronRight :size="16" class="ml-1 group-hover:translate-x-1 transition-transform" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Technologies Stack -->
  <section class="py-20 bg-gradient-to-br from-gray-50 via-white to-gray-50 animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Notre Stack Technologique</h2>
        <p class="text-gray-600 text-lg">Les technologies modernes que nous maîtrisons</p>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
        <div v-for="tech in technologies" :key="tech.name"
             class="group bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
          <div class="text-lg font-bold text-gray-900 mb-2 group-hover:text-[#1c978a] transition-colors">
            {{ tech.name }}
          </div>
          <div class="text-sm text-gray-500">{{ tech.category }}</div>
          <div class="w-8 h-1 bg-gradient-to-r from-[#1c978a] to-[#178e8b] mx-auto mt-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Avantages -->
  <section class="py-20 bg-white animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Pourquoi choisir nos services digitaux ?</h2>
        <p class="text-gray-600 text-lg">La garantie d'un projet réussi</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div v-for="(benefit, index) in benefits" :key="benefit.title"
             class="group text-center p-6 bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
          <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-[#1c978a]/10 to-[#178e8b]/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
            <component :is="benefit.icon" :size="28" class="text-[#1c978a]" />
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">{{ benefit.title }}</h3>
          <p class="text-gray-600">{{ benefit.description }}</p>
          <div class="w-12 h-1 bg-gradient-to-r from-[#1c978a] to-[#178e8b] mx-auto mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Processus de travail -->
  <section class="py-20 bg-gradient-to-br from-[#1c978a]/5 to-[#178e8b]/5 animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Notre Processus de Développement</h2>
        <p class="text-gray-600 text-lg">Une méthodologie éprouvée pour garantir votre succès</p>
      </div>

      <div class="grid md:grid-cols-4 gap-8">
        <div v-for="(step, index) in [
          { title: 'Analyse & Conception', desc: 'Étude des besoins et architecture technique' },
          { title: 'Design & UX', desc: 'Interface utilisateur intuitive et moderne' },
          { title: 'Développement', desc: 'Code qualité avec tests et intégration' },
          { title: 'Livraison & Support', desc: 'Déploiement et maintenance continue' }
        ]" :key="index"
        class="relative">
          <div class="text-center p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
            <div class="text-4xl font-bold text-[#1c978a]/20 mb-4">0{{ index + 1 }}</div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ step.title }}</h3>
            <p class="text-gray-600">{{ step.desc }}</p>
          </div>
          <div v-if="index < 3" class="hidden md:block absolute top-1/2 right-0 w-8 h-1 bg-gradient-to-r from-[#1c978a] to-[#178e8b] transform translate-x-full"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Final -->
  <section class="py-20 bg-gradient-to-br from-[#1c978a] via-[#22ae84] to-[#0e437d] text-white animate-on-scroll">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <Sparkles :size="48" class="mx-auto mb-6 text-[#FFD166] animate-pulse" />

      <h2 class="text-4xl md:text-5xl font-bold mb-6">
        Prêt à <span class="text-[#FFD166]">digitaliser</span> votre entreprise ?
      </h2>

      <p class="text-xl opacity-90 mb-10 max-w-2xl mx-auto">
        Discutons de votre projet web et créons ensemble une solution sur-mesure.
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <a href="/contact"
           class="group relative px-8 py-4 bg-white text-[#1c978a] rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105">
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
