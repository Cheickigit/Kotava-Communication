<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/GuestLayout.vue';
import {
  Sparkles,
  ChevronRight,
  Phone,
  Mail,
  Globe,
  MapPin,
  MessageSquare,
  Send,
  Users,
  Target,
  Award,
  Heart,
  Zap,
  Calendar,
  BookOpen
} from 'lucide-vue-next';
import { ref, onMounted } from 'vue';

const form = useForm({
  name: '',
  email: '',
  phone: '',
  subject: '',
  message: ''
});

const contactInfo = [
  {
    icon: Mail,
    title: 'Email',
    content: 'direction@kotavacommunication.com',
    link: 'mailto:direction@kotavacommunication.com',
    color: 'from-[#0e437d] to-[#22ae84]',
    description: 'Réponse sous 24h'
  },
  {
    icon: Phone,
    title: 'Téléphone',
    content: '+33 70 89 99 00',
    link: 'tel:+33708999900',
    color: 'from-[#22ae84] to-[#1c978a]',
    description: 'Du lundi au vendredi, 9h-18h'
  },
  {
    icon: Globe,
    title: 'Site web',
    content: 'www.kotavacommunication.com',
    link: 'https://www.kotavacommunication.com',
    target: '_blank',
    color: 'from-[#1c978a] to-[#178e8b]',
    description: 'Découvrez nos services'
  },
  {
    icon: MapPin,
    title: 'Localisation',
    content: 'Porto-Novo, Bénin',
    link: null,
    color: 'from-[#178e8b] to-[#0e437d]',
    description: 'Service mondial disponible'
  }
];

const socialMedia = [
  {
    name: 'Facebook',
    icon: 'FB',
    link: '#',
    color: 'hover:bg-[#1877F2] hover:text-white'
  },
  {
    name: 'Twitter',
    icon: 'TW',
    link: '#',
    color: 'hover:bg-[#1DA1F2] hover:text-white'
  },
  {
    name: 'LinkedIn',
    icon: 'IN',
    link: '#',
    color: 'hover:bg-[#0A66C2] hover:text-white'
  },
  {
    name: 'Instagram',
    icon: 'IG',
    link: '#',
    color: 'hover:bg-gradient-to-br hover:from-[#833AB4] hover:via-[#FD1D1D] hover:to-[#FCAF45] hover:text-white'
  }
];

const subjects = [
  { value: '', label: 'Choisir un sujet' },
  { value: 'strategy', label: 'Stratégie & Conseil' },
  { value: 'branding', label: 'Branding & Design' },
  { value: 'web', label: 'Développement Web' },
  { value: 'marketing', label: 'Marketing Digital' },
  { value: 'video', label: 'Production Audiovisuel' },
  { value: 'event', label: 'Événementiel & RP' },
  { value: 'other', label: 'Autre' }
];

const stats = ref([
  { value: '24h', label: 'Délai de réponse', icon: Calendar },
  { value: '100%', label: 'Projets personnalisés', icon: Target },
  { value: '95%', label: 'Clients satisfaits', icon: Heart },
  { value: '7j', label: 'Proposition sous', icon: Zap }
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

const submit = () => {
  // Simulation d'envoi avec animation
  const submitBtn = document.querySelector('#submit-btn');
  const originalText = submitBtn.innerHTML;

  // Animation de soumission
  submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Envoi en cours...';
  submitBtn.disabled = true;

  // Simulation d'envoi
  setTimeout(() => {
    submitBtn.innerHTML = '<i class="fas fa-check mr-2"></i> Message envoyé !';
    submitBtn.classList.remove('from-[#FFD166]', 'to-[#FFB347]');
    submitBtn.classList.add('bg-green-500', 'text-white');

    // Réinitialiser après 3 secondes
    setTimeout(() => {
      submitBtn.innerHTML = originalText;
      submitBtn.disabled = false;
      submitBtn.classList.remove('bg-green-500', 'text-white');
      submitBtn.classList.add('from-[#FFD166]', 'to-[#FFB347]');
      form.reset();
    }, 3000);
  }, 1500);
};
</script>

<template>
  <Head title="Contact - KOTAVA Communication" />

  <MainLayout>
    <!-- Hero Section avec animations -->
    <section class="relative py-20 bg-gradient-to-br from-[#0e437d] via-[#1a6ca3] to-[#22ae84] overflow-hidden min-h-[60vh] flex items-center hero-section animate-on-scroll">
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
          <MessageSquare :size="16" />
          <span>Parlez-nous de votre projet</span>
        </div>

        <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 animate-slide-up">
          Contactez <span class="text-[#FFD166] relative">
            KOTAVA
            <span class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-[#FFD166] to-transparent animate-underline"></span>
          </span>
        </h1>

        <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto leading-relaxed mb-10 animate-slide-up animation-delay-200">
          Discutons de votre projet et créons ensemble quelque chose d'<span class="text-[#FFD166] font-semibold">extraordinaire</span>
        </p>
      </div>
    </section>

    <!-- Statistiques de contact -->
    <section class="py-16 bg-gradient-to-r from-white via-gray-50 to-white animate-on-scroll">
      <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
          <div v-for="(stat, index) in stats" :key="index"
               class="text-center p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 group">
            <div class="flex justify-center mb-4">
              <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#0e437d]/10 to-[#22ae84]/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <component :is="stat.icon" :size="24" class="text-[#0e437d]" />
              </div>
            </div>
            <div class="text-4xl font-bold text-[#0e437d] mb-2">{{ stat.value }}</div>
            <div class="text-gray-600 font-medium">{{ stat.label }}</div>
            <div class="w-12 h-1 bg-gradient-to-r from-[#0e437d] to-[#22ae84] mx-auto mt-3 opacity-0 group-hover:opacity-100 transition-opacity"></div>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section class="py-20 bg-white animate-on-scroll">
      <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-3 gap-8">
          <!-- Contact Info -->
          <div class="lg:col-span-1 space-y-6">
            <div
              v-for="info in contactInfo"
              :key="info.title"
              class="group bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-gray-100"
            >
              <div :class="['w-12 h-12 rounded-xl bg-gradient-to-br flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300', info.color]">
                <component :is="info.icon" :size="24" class="text-white" />
              </div>

              <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-[#0e437d] transition-colors">
                {{ info.title }}
              </h3>

              <a
                v-if="info.link"
                :href="info.link"
                :target="info.target || '_self'"
                class="text-[#0e437d] hover:text-[#22ae84] transition-colors font-medium block mb-1"
              >
                {{ info.content }}
              </a>
              <p v-else class="text-gray-900 font-medium mb-1">{{ info.content }}</p>

              <p class="text-gray-500 text-sm">{{ info.description }}</p>
            </div>

            <!-- Social Media -->
            <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-100">
              <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                <Users :size="18" />
                Suivez-nous
              </h3>
              <div class="flex gap-3">
                <a
                  v-for="social in socialMedia"
                  :key="social.name"
                  :href="social.link"
                  target="_blank"
                  :class="['w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center transition-all duration-300 hover:-translate-y-1', social.color]"
                >
                  <span class="font-semibold">{{ social.icon }}</span>
                </a>
              </div>
            </div>

            <!-- Info supplémentaire -->
            <div class="bg-gradient-to-br from-[#0e437d] to-[#22ae84] rounded-2xl p-6 text-white">
              <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                <Award :size="18" />
                Notre engagement
              </h3>
              <ul class="space-y-2">
                <li class="flex items-center gap-2 text-sm">
                  <div class="w-1.5 h-1.5 bg-[#FFD166] rounded-full"></div>
                  Analyse gratuite de votre projet
                </li>
                <li class="flex items-center gap-2 text-sm">
                  <div class="w-1.5 h-1.5 bg-[#FFD166] rounded-full"></div>
                  Devis personnalisé sous 48h
                </li>
                <li class="flex items-center gap-2 text-sm">
                  <div class="w-1.5 h-1.5 bg-[#FFD166] rounded-full"></div>
                  Suivi régulier et transparent
                </li>
              </ul>
            </div>
          </div>

          <!-- Contact Form -->
          <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
              <div class="mb-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#0e437d]/10 text-[#0e437d] mb-4 text-sm font-semibold">
                  <Send :size="14" />
                  Envoyez-nous un message
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-3">
                  Parlez-nous de votre <span class="text-[#0e437d]">projet</span>
                </h2>
                <p class="text-gray-600">
                  Remplissez le formulaire ci-dessous et notre équipe vous recontactera dans les plus brefs délais
                </p>
              </div>

              <form @submit.prevent="submit" class="space-y-6">
                <div class="grid md:grid-cols-2 gap-6">
                  <div class="group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                    <input
                      v-model="form.name"
                      type="text"
                      required
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#22ae84] focus:border-transparent transition-all duration-300 group-hover:border-[#22ae84]/50"
                      placeholder="Jean Dupont"
                    />
                  </div>

                  <div class="group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input
                      v-model="form.email"
                      type="email"
                      required
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#22ae84] focus:border-transparent transition-all duration-300 group-hover:border-[#22ae84]/50"
                      placeholder="jean@example.com"
                    />
                  </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                  <div class="group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                    <input
                      v-model="form.phone"
                      type="tel"
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#22ae84] focus:border-transparent transition-all duration-300 group-hover:border-[#22ae84]/50"
                      placeholder="+33 70 89 99 00"
                    />
                  </div>

                  <div class="group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sujet</label>
                    <select
                      v-model="form.subject"
                      required
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#22ae84] focus:border-transparent transition-all duration-300 group-hover:border-[#22ae84]/50"
                    >
                      <option v-for="subject in subjects" :key="subject.value" :value="subject.value">
                        {{ subject.label }}
                      </option>
                    </select>
                  </div>
                </div>

                <div class="group">
                  <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                  <textarea
                    v-model="form.message"
                    rows="6"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#22ae84] focus:border-transparent resize-none transition-all duration-300 group-hover:border-[#22ae84]/50"
                    placeholder="Parlez-nous de votre projet, vos objectifs, vos attentes..."
                  ></textarea>
                </div>

                <button
                  id="submit-btn"
                  type="submit"
                  class="group w-full px-8 py-4 bg-gradient-to-r from-[#FFD166] to-[#FFB347] text-gray-900 font-bold rounded-lg hover:shadow-2xl transition-all duration-300 hover:scale-105 flex items-center justify-center"
                >
                  <span class="flex items-center gap-2">
                    Envoyer le message
                    <Send :size="20" class="group-hover:translate-x-1 transition-transform" />
                  </span>
                </button>
              </form>
            </div>

            <!-- Additional Info -->
            <div class="mt-8 p-6 bg-gradient-to-br from-gray-50 to-white rounded-2xl border border-gray-100">
              <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                <BookOpen :size="18" />
                Comment se déroule notre collaboration ?
              </h3>
              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="text-center p-4">
                  <div class="w-10 h-10 rounded-full bg-[#0e437d]/10 flex items-center justify-center mx-auto mb-3">
                    <span class="text-[#0e437d] font-bold">1</span>
                  </div>
                  <p class="text-sm text-gray-600">Analyse de votre besoin</p>
                </div>
                <div class="text-center p-4">
                  <div class="w-10 h-10 rounded-full bg-[#0e437d]/10 flex items-center justify-center mx-auto mb-3">
                    <span class="text-[#0e437d] font-bold">2</span>
                  </div>
                  <p class="text-sm text-gray-600">Proposition personnalisée</p>
                </div>
                <div class="text-center p-4">
                  <div class="w-10 h-10 rounded-full bg-[#0e437d]/10 flex items-center justify-center mx-auto mb-3">
                    <span class="text-[#0e437d] font-bold">3</span>
                  </div>
                  <p class="text-sm text-gray-600">Démarrage du projet</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Final -->
    <section class="py-20 bg-gradient-to-br from-gray-50 via-white to-gray-50 animate-on-scroll">
      <div class="max-w-4xl mx-auto px-6 text-center">
        <div class="bg-gradient-to-r from-[#0e437d] to-[#22ae84] rounded-2xl p-8 text-white shadow-xl">
          <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 backdrop-blur-sm text-white mb-6 text-sm font-medium">
            <Sparkles :size="14" />
            Besoin d'une réponse rapide ?
          </div>

          <h3 class="text-2xl font-bold mb-4">Contactez-nous directement</h3>
          <p class="text-white/90 mb-6">Notre équipe est disponible pour répondre à toutes vos questions</p>

          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="tel:+33708999900"
               class="px-6 py-3 bg-white text-[#0e437d] rounded-lg font-semibold hover:bg-gray-100 transition-all duration-300 hover:scale-105 group">
              <span class="flex items-center gap-2">
                <Phone :size="18" class="group-hover:scale-110 transition-transform" />
                Appeler maintenant
              </span>
            </a>
            <a href="mailto:direction@kotavacommunication.com"
               class="px-6 py-3 bg-transparent border-2 border-white text-white rounded-lg font-semibold hover:bg-white/10 transition-all duration-300 hover:scale-105 group">
              <span class="flex items-center gap-2">
                <Mail :size="18" class="group-hover:scale-110 transition-transform" />
                Envoyer un email
              </span>
            </a>
          </div>
        </div>
      </div>
    </section>
  </MainLayout>
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
