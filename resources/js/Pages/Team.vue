<script setup>
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/GuestLayout.vue';
import {
  Users,
  Target,
  Palette,
  Code,
  Camera,
  Calendar,
  MessageSquare,
  User,
  Sparkles,
  ChevronRight,
  Phone,
  Mail,
  Award,
  Heart,
  Zap,
  TrendingUp,
  Globe,
  Check,
  Star
} from 'lucide-vue-next';
import { ref, onMounted } from 'vue';

const teamMembers = [
  {
    name: 'SMILE TCHICAYA',
    role: 'CEO, Directeur Stratégique & Graphiste, Community Manager',
    color: 'from-[#0e437d] to-[#22ae84]',
    expertise: ['Stratégie', 'Design', 'Management'],
    photo: '/Smiley.png',
    fallbackIcon: Target,
    description: 'Expert en stratégie digitale avec 10+ ans d\'expérience dans le design et la communication'
  },
  {
    name: 'MODESTE METO',
    role: 'DG, Directeur Marketing & Communication',
    color: 'from-[#22ae84] to-[#1c978a]',
    expertise: ['Marketing', 'Communication', 'Direction'],
    photo: '/Modeste.png',
    fallbackIcon: Target,
    description: 'Spécialiste en marketing digital et communication d\'entreprise'
  },
  {
    name: 'AARON LOEB',
    role: 'Développeur Web & Data Analyste',
    color: 'from-[#1c978a] to-[#178e8b]',
    expertise: ['Développement Web', 'Data Analysis', 'Technologie'],
    photo: '/aaron-loeb.jpg',
    fallbackIcon: Code,
    description: 'Développeur full-stack passionné par l\'innovation technologique'
  },
  {
    name: 'CLAUDIA ALVES',
    role: 'Responsable Communication',
    color: 'from-[#178e8b] to-[#0e437d]',
    expertise: ['Communication', 'Relations Publiques', 'Événementiel'],
    photo: '/claudia-alves.jpg',
    fallbackIcon: MessageSquare,
    description: 'Experte en communication corporate et gestion de la réputation'
  }
];

const stats = ref([
  { value: '6', label: 'Pôles d\'expertise', icon: Award, description: 'Services complets' },
  { value: '10+', label: 'Années d\'expérience', icon: Calendar, description: 'Expertise cumulée' },
  { value: '100%', label: 'Engagement', icon: Heart, description: 'Dévouement client' },
  { value: '360°', label: 'Vision', icon: Globe, description: 'Approche complète' }
]);

const imageErrors = ref({});

const handleImageError = (memberName) => {
  imageErrors.value[memberName] = true;
};

onMounted(() => {
  // Animation des statistiques
  const animateStats = () => {
    const statElements = document.querySelectorAll('.stat-value');
    statElements.forEach((el, index) => {
      const stat = stats.value[index];
      if (stat.value === '360°' || stat.value === '100%') {
        el.textContent = stat.value;
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
          el.textContent = Math.floor(current) + (stat.value.includes('+') ? '+' : '');
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

defineOptions({ layout: MainLayout });
</script>

<template>
  <Head title="Notre Équipe - KOTAVA Communication" />

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
        <span>Notre force collective</span>
      </div>

      <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 animate-slide-up">
        Rencontrez notre <span class="text-[#FFD166] relative">
          équipe
          <span class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-[#FFD166] to-transparent animate-underline"></span>
        </span>
      </h1>

      <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto leading-relaxed mb-10 animate-slide-up animation-delay-200">
        Une équipe <span class="text-[#FFD166] font-semibold">passionnée et pluridisciplinaire</span> dédiée à l'excellence et à l'innovation.
      </p>

      <!-- CTA Hero -->
      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-slide-up animation-delay-400">
        <a href="#team-section"
           class="group relative px-8 py-4 bg-gradient-to-r from-[#FFD166] to-[#FFB347] text-gray-900 rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105 animate-pulse-subtle">
          <span class="relative z-10 flex items-center gap-2">
            Découvrir l'équipe <ChevronRight :size="20" class="group-hover:translate-x-1 transition-transform" />
          </span>
          <div class="absolute inset-0 bg-gradient-to-r from-[#FFD166] to-[#FFB347] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </a>

        <a href="#contact-section"
           class="group px-6 py-4 bg-white/10 backdrop-blur-lg text-white rounded-xl font-semibold text-lg border-2 border-white/20 hover:bg-white/20 hover:border-white/40 transition-all duration-300">
          <span class="flex items-center gap-2">
            <Users :size="20" /> Nous contacter
          </span>
        </a>
      </div>
    </div>
  </section>

  <!-- Statistiques animées -->
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
          <div class="text-sm text-gray-500 mt-1">{{ stat.description }}</div>
          <div class="w-12 h-1 bg-gradient-to-r from-[#0e437d] to-[#22ae84] mx-auto mt-3 opacity-0 group-hover:opacity-100 transition-opacity"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Notre Équipe Principale -->
  <section id="team-section" class="py-20 bg-white animate-on-scroll">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-12">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#0e437d]/10 text-[#0e437d] mb-4 text-sm font-semibold">
          <Users :size="14" />
          Notre équipe de direction
        </div>
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Les leaders derrière KOTAVA</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">Une équipe d'experts dédiée à votre succès</p>
      </div>

      <div class="grid md:grid-cols-2 gap-8">
        <div v-for="member in teamMembers.slice(0, 2)" :key="member.name"
             class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100">
          <div class="flex items-start gap-6">
            <!-- Photo avec animation -->
            <div class="relative">
              <div v-if="!imageErrors[member.name]"
                   class="w-20 h-20 rounded-2xl overflow-hidden flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow">
                <img
                  :src="member.photo"
                  :alt="member.name"
                  class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                  @error="handleImageError(member.name)"
                />
              </div>
              <div v-else
                   :class="['w-20 h-20 rounded-2xl bg-gradient-to-br flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300', member.color]">
                <component :is="member.fallbackIcon" :size="32" class="text-white" />
              </div>
            </div>

            <div class="flex-1">
              <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-[#0e437d] transition-colors">{{ member.name }}</h3>
              <p class="text-gray-600 mb-4">{{ member.role }}</p>
              <p class="text-gray-500 text-sm mb-4">{{ member.description }}</p>

              <div class="flex flex-wrap gap-2">
                <span v-for="skill in member.expertise" :key="skill"
                      class="px-3 py-1 bg-gradient-to-br from-gray-50 to-white text-gray-700 rounded-full text-sm shadow-sm hover:shadow-md transition-shadow group-hover/skill:translate-y-[-2px]">
                  {{ skill }}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Toute l'équipe en grille -->
  <section class="py-20 bg-gray-50 animate-on-scroll">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-12">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#22ae84]/10 text-[#22ae84] mb-4 text-sm font-semibold">
          <Users :size="14" />
          Toute notre équipe
        </div>
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Découvrez notre équipe complète</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">Des talents variés, une seule vision : votre succès</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div v-for="member in teamMembers" :key="'card-' + member.name"
             class="group bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 text-center">
          <div class="relative mb-6">
            <!-- Photo ronde avec animation -->
            <div class="w-32 h-32 mx-auto rounded-full overflow-hidden shadow-lg border-4 border-white group-hover:border-[#22ae84]/30 transition-colors duration-300">
              <div v-if="!imageErrors[member.name + '-card']" class="w-full h-full">
                <img
                  :src="member.photo"
                  :alt="member.name"
                  class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                  @error="() => handleImageError(member.name + '-card')"
                />
              </div>
              <div v-else
                   :class="['w-full h-full bg-gradient-to-br flex items-center justify-center group-hover:scale-110 transition-transform duration-300', member.color]">
                <component :is="member.fallbackIcon" :size="48" class="text-white" />
              </div>
            </div>

            <!-- Badge de rôle -->
            <div :class="['absolute -bottom-2 left-1/2 transform -translate-x-1/2 px-4 py-1 rounded-full text-white text-sm font-medium shadow-lg', member.color.replace('from-', 'bg-gradient-to-br from-')]">
              Expert
            </div>
          </div>

          <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#0e437d] transition-colors">{{ member.name }}</h3>
          <p class="text-gray-600 mb-4 text-sm">{{ member.role }}</p>

          <div class="flex justify-center flex-wrap gap-2 mb-4">
            <span v-for="skill in member.expertise" :key="skill"
                  class="px-2 py-1 bg-gray-50 text-gray-700 rounded-full text-xs hover:bg-gray-100 transition-colors">
              {{ skill }}
            </span>
          </div>

          <div class="mt-6 pt-4 border-t border-gray-100">
            <a href="#" class="text-sm text-[#0e437d] font-medium hover:text-[#22ae84] transition-colors inline-flex items-center gap-1 group/link">
              Voir le profil <ChevronRight :size="12" class="group-hover/link:translate-x-1 transition-transform" />
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Nos valeurs d'équipe -->
  <section class="py-20 bg-white animate-on-scroll">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Nos valeurs d'équipe</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">Ce qui nous unit et nous motive chaque jour</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div v-for="(value, index) in [
          { icon: Heart, title: 'Collaboration', desc: 'Nous travaillons ensemble pour des résultats exceptionnels', colorClass: 'from-[#0e437d] to-[#22ae84]' },
          { icon: Zap, title: 'Innovation', desc: 'Toujours à la recherche de nouvelles solutions créatives', colorClass: 'from-[#22ae84] to-[#1c978a]' },
          { icon: Target, title: 'Excellence', desc: 'Nous visons la perfection dans chaque projet', colorClass: 'from-[#1c978a] to-[#178e8b]' },
          { icon: Users, title: 'Transparence', desc: 'Une communication claire et honnête avec nos clients', colorClass: 'from-[#178e8b] to-[#0e437d]' }
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
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Section Contact Équipe -->
  <section id="contact-section" class="py-20 bg-gradient-to-br from-gray-50 via-white to-gray-50 animate-on-scroll">
    <div class="max-w-4xl mx-auto px-6 text-center">
      <div class="bg-gradient-to-r from-[#0e437d] to-[#22ae84] rounded-2xl p-8 text-white shadow-xl">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 backdrop-blur-sm text-white mb-6 text-sm font-medium">
          <Sparkles :size="14" /> Travaillons ensemble
        </div>

        <h3 class="text-2xl font-bold mb-4">Prêt à collaborer avec notre équipe ?</h3>
        <p class="text-white/90 mb-6">Notre équipe est à votre disposition pour discuter de votre projet</p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a href="tel:+33612345678"
             class="px-6 py-3 bg-white text-[#0e437d] rounded-lg font-semibold hover:bg-gray-100 transition-all duration-300 hover:scale-105">
            <span class="flex items-center gap-2">
              <Phone :size="18" /> Nous appeler
            </span>
          </a>
          <a href="mailto:contact@kotava.com"
             class="px-6 py-3 bg-transparent border-2 border-white text-white rounded-lg font-semibold hover:bg-white/10 transition-all duration-300 hover:scale-105">
            <span class="flex items-center gap-2">
              <Mail :size="18" /> Nous écrire
            </span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Final -->
  <section class="py-20 bg-gradient-to-br from-[#0e437d] via-[#1a6ca3] to-[#22ae84] text-white animate-on-scroll">
    <div class="absolute inset-0 overflow-hidden">
      <div class="absolute -top-20 -left-20 w-64 h-64 bg-white rounded-full opacity-10 blur-3xl"></div>
      <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-white rounded-full opacity-10 blur-3xl"></div>
    </div>

    <div class="relative max-w-4xl mx-auto px-6 text-center">
      <Sparkles :size="48" class="mx-auto mb-6 text-[#FFD166] animate-pulse" />

      <h2 class="text-4xl md:text-5xl font-bold mb-6">
        Une équipe, <span class="text-[#FFD166]">une vision</span>
      </h2>

      <p class="text-xl opacity-90 mb-10 max-w-2xl mx-auto">
        Chaque membre de notre équipe apporte son expertise unique pour créer des solutions exceptionnelles.
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <a href="/contact"
           class="group relative px-8 py-4 bg-white text-[#0e437d] rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105">
          <span class="relative z-10 flex items-center gap-3">
            <Users :size="20" /> Rencontrer l'équipe
          </span>
          <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </a>
      </div>

      <div class="mt-12 pt-8 border-t border-white/20">
        <p class="text-white/80 mb-4">Suivez-nous sur les réseaux :</p>
        <div class="flex justify-center gap-6">
          <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors">
            <span class="text-white">FB</span>
          </a>
          <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors">
            <span class="text-white">IG</span>
          </a>
          <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors">
            <span class="text-white">IN</span>
          </a>
          <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors">
            <span class="text-white">TW</span>
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

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
