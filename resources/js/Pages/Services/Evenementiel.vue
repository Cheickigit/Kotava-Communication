<!-- resources/js/Pages/Services/Evenementiel.vue -->
<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/GuestLayout.vue';
import { ArrowLeft, Calendar, Check, Sparkles, Users, Mic, Megaphone, TrendingUp, Star, Globe, MessageSquare, Zap, ChevronRight, Mail, Phone, Target, Award, Heart, Shield, Clock } from 'lucide-vue-next';
import { ref, onMounted } from 'vue';

defineOptions({ layout: MainLayout });

const services = ref([
  {
    title: 'Organisation d\'Événements',
    description: 'Gestion complète d\'événements corporate, lancements produits et soirées institutionnelles',
    icon: Users,
    color: 'from-[#22ae84] to-[#1c978a]',
    features: ['Planification stratégique', 'Logistique complète', 'Animation et modération', 'Gestion des invités'],
    scale: ['Événements 50-1000 personnes', 'Lieux prestigieux', 'Catering premium', 'Équipe dédiée']
  },
  {
    title: 'Relations Presse & Médias',
    description: 'Stratégie de communication média, relations avec journalistes et couverture presse',
    icon: Megaphone,
    color: 'from-[#1c978a] to-[#178e8b]',
    features: ['Dossiers de presse', 'Communiqués média', 'Interviews médiatiques', 'Reportages TV'],
    contacts: ['Journalistes nationaux', 'Médias spécialisés', 'Influenceurs sectoriels', 'Blogueurs clés']
  },
  {
    title: 'Stratégie d\'Influence',
    description: 'Campagnes d\'influence avec ambassadeurs de marque et partenariats stratégiques',
    icon: TrendingUp,
    color: 'from-[#178e8b] to-[#0e437d]',
    features: ['Identification d\'ambassadeurs', 'Campagnes d\'influence', 'Partenariats stratégiques', 'Suivi ROI'],
    platforms: ['Réseaux sociaux', 'Blogs influence', 'Podcasts', 'Événements sectoriels']
  },
  {
    title: 'Événements Digitaux & Hybrides',
    description: 'Webinaires, conférences virtuelles et événements hybrides à portée internationale',
    icon: Globe,
    color: 'from-[#0e437d] to-[#22ae84]',
    features: ['Plateformes streaming', 'Animation interactive', 'Networking virtuel', 'Analytics avancés'],
    technologies: ['Zoom/Teams pro', 'Plateformes dédiées', 'Outils interactifs', 'Studio virtuel']
  },
  {
    title: 'Gestion de Crise & RP',
    description: 'Stratégie de communication de crise et gestion de l\'image en situations sensibles',
    icon: Shield,
    color: 'from-[#22ae84] to-[#1c978a]',
    features: ['Veille média 24/7', 'Stratégie de crise', 'Communication réactive', 'Rétablissement image'],
    expertise: ['Crisis management', 'Formation porte-parole', 'Monitoring', 'Rapports d\'impact']
  },
  {
    title: 'Production de Contenu Événementiel',
    description: 'Couverture média, live reporting et contenu exclusif pour vos événements',
    icon: Star,
    color: 'from-[#1c978a] to-[#178e8b]',
    features: ['Photographie événementielle', 'Vidéos highlights', 'Live social media', 'Interviews exclusives'],
    deliverables: ['Album photo premium', 'Vidéo aftermovie', 'Contenu réseaux sociaux', 'Reportage média']
  }
]);

const eventTypes = ref([
  { name: 'Lancements Produits', category: 'Événements corporate' },
  { name: 'Conférences & Séminaires', category: 'Événements professionnels' },
  { name: 'Soirées Institutionnelles', category: 'Événements réseautage' },
  { name: 'Inaugurations', category: 'Événements officiels' },
  { name: 'Webinaires', category: 'Événements digitaux' },
  { name: 'Team Buildings', category: 'Événements internes' }
]);

const benefits = ref([
  { title: 'Logistique Complète', description: 'Gestion de A à Z de votre événement', icon: Calendar },
  { title: 'Réseau Média Étendu', description: 'Contacts presse et influenceurs clés', icon: Megaphone },
  { title: 'Suivi Personnalisé', description: 'Accompagnement avant/pendant/après', icon: Users },
  { title: 'Impact Garanti', description: 'Mesure précise des résultats et ROI', icon: TrendingUp }
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
  <Head title="Événementiel & RP - KOTAVA Communication" />

  <!-- Hero Section avec animation -->
  <section class="relative bg-gradient-to-br from-[#22ae84] via-[#1c978a] to-[#178e8b] py-24 overflow-hidden min-h-[80vh] flex items-center">
    <!-- Animation background événementiel -->
    <div class="absolute inset-0 overflow-hidden">
      <!-- Effets lumineux événementiels -->
      <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-white/30 to-transparent animate-shimmer"></div>
      <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-white/20 to-transparent animate-shimmer animation-delay-1000"></div>

      <!-- Projecteurs événementiels -->
      <div class="absolute top-10 left-1/4 w-32 h-64 bg-gradient-to-b from-white/10 to-transparent opacity-20 animate-pulse"></div>
      <div class="absolute top-10 right-1/4 w-32 h-64 bg-gradient-to-b from-white/10 to-transparent opacity-20 animate-pulse animation-delay-500"></div>

      <!-- Particules événementielles (confettis) -->
      <div v-for="i in 20" :key="i"
           class="absolute w-3 h-3 opacity-30 animate-float"
           :style="{
             left: `${Math.random() * 100}%`,
             top: `${Math.random() * 100}%`,
             backgroundColor: ['#FFD166', '#EF476F', '#06D6A0', '#118AB2'][Math.floor(Math.random() * 4)],
             animationDelay: `${Math.random() * 3}s`,
             animationDuration: `${5 + Math.random() * 10}s`
           }"></div>

      <!-- Effet de foule subtil -->
      <div class="absolute bottom-0 inset-x-0 h-32 bg-gradient-to-t from-white/5 to-transparent"></div>
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
          <Calendar :size="36" class="text-white" />
        </div>
        <div class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white/20 backdrop-blur-lg text-white text-sm font-medium animate-bounce-subtle">
          <Sparkles :size="16" />
          <span>Événements & influence premium</span>
        </div>
      </div>

      <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 animate-slide-up">
        Événementiel & <span class="text-[#FFD166] relative">
          RP
          <span class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-[#FFD166] to-transparent animate-underline"></span>
        </span>
      </h1>

      <p class="text-xl md:text-2xl text-white/90 max-w-3xl leading-relaxed mb-10 animate-slide-up animation-delay-200">
        Organisez des événements <span class="text-[#FFD166] font-semibold">mémorables et impactants</span>
        qui développent votre influence médiatique et renforcent votre notoriété.
      </p>

      <!-- CTA Hero -->
      <div class="flex flex-col sm:flex-row gap-4 animate-slide-up animation-delay-400">
        <a href="/contact"
           class="group relative px-8 py-4 bg-gradient-to-r from-[#FFD166] to-[#FFB347] text-gray-900 rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105 animate-pulse-subtle max-w-xs">
          <span class="relative z-10 flex items-center gap-2">
            Planifier mon événement <ChevronRight :size="20" class="group-hover:translate-x-1 transition-transform" />
          </span>
          <div class="absolute inset-0 bg-gradient-to-r from-[#FFD166] to-[#FFB347] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </a>

        <a href="tel:+33612345678"
           class="group px-6 py-4 bg-white/10 backdrop-blur-lg text-white rounded-xl font-semibold text-lg border-2 border-white/20 hover:bg-white/20 hover:border-white/40 transition-all duration-300 max-w-xs">
          <span class="flex items-center gap-2">
            <Phone :size="20" /> Conseil événementiel gratuit
          </span>
        </a>
      </div>
    </div>
  </section>

  <!-- Statistiques événementielles -->
  <section class="py-16 bg-gradient-to-r from-white via-gray-50 to-white stats-section animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
        <div v-for="(stat, index) in [
          { value: '500+', label: 'Événements organisés', icon: Calendar },
          { value: '95%', label: 'Satisfaction clients', icon: Heart },
          { value: '100+', label: 'Contacts média', icon: Megaphone },
          { value: '24/7', label: 'Support événementiel', icon: Shield }
        ]" :key="index"
        class="text-center p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
          <div class="text-4xl font-bold text-[#22ae84] mb-2">{{ stat.value }}</div>
          <div class="text-gray-600 font-medium">{{ stat.label }}</div>
          <div class="w-12 h-1 bg-gradient-to-r from-[#22ae84] to-[#1c978a] mx-auto mt-3"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Nos services événementiels -->
  <section class="py-20 bg-white animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Nos Services Événementiels</h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">Une expertise complète pour des événements réussis</p>
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

          <!-- Échelle/Réseau -->
          <div class="p-4 bg-gradient-to-r from-gray-50 to-white rounded-xl border border-gray-100 mb-6">
            <div class="text-sm text-gray-500 mb-2">
              <span v-if="service.scale">Échelle :</span>
              <span v-if="service.contacts">Réseau :</span>
              <span v-if="service.platforms">Plateformes :</span>
              <span v-if="service.technologies">Technologies :</span>
              <span v-if="service.expertise">Expertise :</span>
              <span v-if="service.deliverables">Livrables :</span>
            </div>
            <div class="flex flex-wrap gap-2">
              <span v-for="item in (service.scale || service.contacts || service.platforms || service.technologies || service.expertise || service.deliverables)" :key="item"
                    class="inline-block px-3 py-1 bg-white text-gray-700 text-xs rounded-full border border-gray-200">
                {{ item }}
              </span>
            </div>
          </div>

          <!-- Lien vers plus d'info -->
          <div class="mt-6 pt-6 border-t border-gray-100">
            <div class="flex items-center text-sm text-[#22ae84] font-medium group-hover:text-[#1c978a] transition-colors cursor-pointer">
              <span>Voir des références</span>
              <ChevronRight :size="16" class="ml-1 group-hover:translate-x-1 transition-transform" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Types d'événements -->
  <section class="py-20 bg-gradient-to-br from-gray-50 via-white to-gray-50 animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Types d\'Événements</h2>
        <p class="text-gray-600 text-lg">Nous organisons tous types d'événements, du corporate au festif</p>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
        <div v-for="item in eventTypes" :key="item.name"
             class="group bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
          <div class="text-lg font-bold text-gray-900 mb-2 group-hover:text-[#22ae84] transition-colors">
            {{ item.name }}
          </div>
          <div class="text-sm text-gray-500">{{ item.category }}</div>
          <div class="w-8 h-1 bg-gradient-to-r from-[#22ae84] to-[#1c978a] mx-auto mt-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>
      </div>

      <!-- Note sur la personnalisation -->
      <div class="mt-12 bg-gradient-to-r from-[#22ae84]/5 to-[#1c978a]/5 rounded-2xl p-6 border border-[#22ae84]/10">
        <div class="flex items-start gap-4">
          <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#22ae84] to-[#1c978a] flex items-center justify-center flex-shrink-0">
            <Sparkles :size="24" class="text-white" />
          </div>
          <div>
            <h4 class="text-lg font-semibold text-gray-900 mb-2">Personnalisation complète</h4>
            <p class="text-gray-600">
              Chaque événement est conçu sur-mesure selon vos objectifs, votre budget et votre cible.
              Nous adaptons notre approche pour créer des expériences uniques et mémorables qui
              correspondent parfaitement à l'identité de votre marque.
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
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Pourquoi nous choisir ?</h2>
        <p class="text-gray-600 text-lg">L'expertise qui fait la différence pour vos événements</p>
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

  <!-- Processus événementiel -->
  <section class="py-20 bg-gradient-to-br from-[#22ae84]/5 to-[#1c978a]/5 animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Notre Processus Événementiel</h2>
        <p class="text-gray-600 text-lg">Une méthodologie structurée pour garantir le succès</p>
      </div>

      <div class="grid md:grid-cols-4 gap-8">
        <div v-for="(step, index) in [
          { title: 'Conception', desc: 'Brief, objectifs, stratégie' },
          { title: 'Planification', desc: 'Logistique, budget, planning' },
          { title: 'Exécution', desc: 'Organisation, animation, gestion' },
          { title: 'Suivi', desc: 'Reporting, ROI, fidélisation' }
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

  <!-- Galerie événementielle (placeholder) -->
  <section class="py-20 bg-white animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Nos Événements à Succès</h2>
        <p class="text-gray-600 text-lg">Des moments mémorables créés pour nos clients</p>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div v-for="i in 4" :key="i"
             class="group relative aspect-square bg-gradient-to-br from-[#22ae84]/20 to-[#1c978a]/20 rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-300">
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-16 h-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
              <Users :size="24" class="text-white" />
            </div>
          </div>
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          <div class="absolute bottom-0 left-0 right-0 p-4 text-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
            <p class="text-sm font-semibold">Événement {{ i }}</p>
          </div>
        </div>
      </div>

      <div class="text-center mt-8">
        <a href="/portfolio"
           class="group inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#22ae84] to-[#1c978a] text-white font-semibold rounded-xl hover:shadow-xl transition-all duration-300 hover:scale-105">
          <span>Voir notre portfolio événementiel</span>
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
        Prêt à créer un <span class="text-[#FFD166]">événement mémorable</span> ?
      </h2>

      <p class="text-xl opacity-90 mb-10 max-w-2xl mx-auto">
        Discutons de votre projet événementiel et créons ensemble une expérience unique.
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <a href="/contact"
           class="group relative px-8 py-4 bg-white text-[#22ae84] rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105">
          <span class="relative z-10 flex items-center gap-3">
            <Mail :size="20" /> Planifier mon événement
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
