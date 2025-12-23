<!-- resources/js/Pages/Services/Audiovisuel.vue - Version finale corrigée -->
<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/GuestLayout.vue';
import { ArrowLeft, Video, Check, Sparkles, Camera, Film, Music, Mic, Image, Radio, Zap, Play, ChevronRight, Mail, Phone, Target, Award, TrendingUp, Heart, Users, Clock, Shield } from 'lucide-vue-next';
import { ref, onMounted } from 'vue';

defineOptions({ layout: MainLayout });

const services = ref([
  {
    title: 'Production Vidéo Corporate',
    description: 'Vidéos institutionnelles, interviews, reportages d\'entreprise sur mesure',
    icon: Film,
    color: 'from-[#178e8b] to-[#0e437d]',
    features: ['Scénarisation', 'Tournage professionnel', 'Montage avancé', 'Étalonnage colorimétrique'],
    equipment: ['Caméras 4K/6K', 'Éclairage LED pro', 'Stabilisateurs', 'Micros directionnels']
  },
  {
    title: 'Motion Design & Animation',
    description: 'Animations 2D/3D, infographies animées, vidéos explicatives',
    icon: Play,
    color: 'from-[#0e437d] to-[#22ae84]',
    features: ['Animations After Effects', 'Modélisation 3D', 'Sound design', 'VFX intégration'],
    software: ['Adobe After Effects', 'Cinema 4D', 'Blender', 'Premiere Pro']
  },
  {
    title: 'Photographie Professionnelle',
    description: 'Séances photo produit, portraits corporate, reportages événementiels',
    icon: Image,
    color: 'from-[#22ae84] to-[#1c978a]',
    features: ['Studio photo mobile', 'Éclairage professionnel', 'Retouche avancée', 'Prise de vue extérieure'],
    equipment: ['Appareils Full Frame', 'Objectifs premium', 'Flashs studio', 'Trépieds professionnels']
  },
  {
    title: 'Production Sonore & Podcast',
    description: 'Enregistrement studio, mixage audio, création sonore, podcasts',
    icon: Music,
    color: 'from-[#1c978a] to-[#178e8b]',
    features: ['Enregistrement studio', 'Montage audio', 'Mixage professionnel', 'Mastering final'],
    equipment: ['Studio insonorisé', 'Micros studio', 'Interface audio', 'Logiciels DAW']
  },
  {
    title: 'Tournage Drone & Aérien',
    description: 'Vues aériennes, plans spectaculaires, vidéos promotionnelles',
    icon: Camera,
    color: 'from-[#178e8b] to-[#0e437d]',
    features: ['Pilote certifié', 'Drone 4K/6K', 'Plans cinématiques', 'Stabilisation gyroscopique'],
    certifications: ['Certification DGAC', 'Assurance professionnelle', 'Formation sécurité']
  },
  {
    title: 'Live Streaming & Webinaire',
    description: 'Diffusions en direct, webinaires professionnels, événements virtuels',
    icon: Radio,
    color: 'from-[#0e437d] to-[#22ae84]',
    features: ['Installation multi-caméras', 'Régie live', 'Streaming multi-plateformes', 'Interaction en direct'],
    platforms: ['YouTube Live', 'Facebook Live', 'Zoom', 'Vimeo']
  }
]);

const equipment = ref([
  { name: 'Caméras Blackmagic 6K', category: 'Tournage' },
  { name: 'Drone DJI Inspire 3', category: 'Aérien' },
  { name: 'Éclairage Aputure', category: 'Lumière' },
  { name: 'Micros Sennheiser', category: 'Son' },
  { name: 'Stabilisateur Ronin', category: 'Mouvement' },
  { name: 'Studio mobile complet', category: 'Production' }
]);

const benefits = ref([
  { title: 'Équipement Pro', description: 'Matériel haut de gamme et régulièrement mis à jour', icon: Camera },
  { title: 'Équipe Expérimentée', description: 'Réalisateurs, cadreurs, monteurs professionnels', icon: Users },
  { title: 'Montage Rapide', description: 'Délais de production optimisés sans compromis qualité', icon: Clock },
  { title: 'Qualité 4K/6K', description: 'Résolution ultra HD pour un rendu cinématographique', icon: Zap }
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
  <Head title="Production Audiovisuel - KOTAVA Communication" />

  <!-- Hero Section avec animation -->
  <section class="relative bg-gradient-to-br from-[#178e8b] via-[#0e437d] to-[#22ae84] py-24 overflow-hidden min-h-[80vh] flex items-center">
    <!-- Animation background simplifiée (sans SVG problématique) -->
    <div class="absolute inset-0 overflow-hidden">
      <!-- Effet flicker vidéo -->
      <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/3 to-transparent animate-shimmer animation-delay-500"></div>
      <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/2 to-transparent animate-shimmer"></div>

      <!-- Particules cinématographiques -->
      <div v-for="i in 12" :key="i"
           class="absolute w-1 h-1 bg-white rounded-full opacity-30 animate-float"
           :style="{
             left: `${Math.random() * 100}%`,
             top: `${Math.random() * 100}%`,
             animationDelay: `${Math.random() * 3}s`,
             animationDuration: `${5 + Math.random() * 10}s`
           }"></div>

      <!-- Effet film grain simplifié (CSS pur) -->
      <div class="absolute inset-0 opacity-[0.02] bg-[length:200px_200px]"
           style="background-image: radial-gradient(circle at 25% 25%, rgba(255,255,255,0.2) 1px, transparent 1px)"></div>
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
        <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-[#178e8b] to-[#0e437d] flex items-center justify-center shadow-2xl group-hover:scale-110 transition-transform duration-500">
          <Video :size="36" class="text-white" />
        </div>
        <div class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white/20 backdrop-blur-lg text-white text-sm font-medium animate-bounce-subtle">
          <Sparkles :size="16" />
          <span>Production professionnelle</span>
        </div>
      </div>

      <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 animate-slide-up">
        Production <span class="text-[#FFD166] relative">
          Audiovisuel
          <span class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-[#FFD166] to-transparent animate-underline"></span>
        </span>
      </h1>

      <p class="text-xl md:text-2xl text-white/90 max-w-3xl leading-relaxed mb-10 animate-slide-up animation-delay-200">
        Captez l'attention avec des productions audiovisuelles <span class="text-[#FFD166] font-semibold">professionnelles, cinématographiques et impactantes</span>
        qui racontent votre histoire de manière mémorable.
      </p>

      <!-- CTA Hero -->
      <div class="flex flex-col sm:flex-row gap-4 animate-slide-up animation-delay-400">
        <a href="/contact"
           class="group relative px-8 py-4 bg-gradient-to-r from-[#FFD166] to-[#FFB347] text-gray-900 rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105 animate-pulse-subtle max-w-xs">
          <span class="relative z-10 flex items-center gap-2">
            Démarrer mon projet vidéo <ChevronRight :size="20" class="group-hover:translate-x-1 transition-transform" />
          </span>
          <div class="absolute inset-0 bg-gradient-to-r from-[#FFD166] to-[#FFB347] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </a>

        <a href="tel:+33612345678"
           class="group px-6 py-4 bg-white/10 backdrop-blur-lg text-white rounded-xl font-semibold text-lg border-2 border-white/20 hover:bg-white/20 hover:border-white/40 transition-all duration-300 max-w-xs">
          <span class="flex items-center gap-2">
            <Phone :size="20" /> Demander un devis
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
          { value: '4K/6K', label: 'Résolution Ultra HD', icon: Zap },
          { value: '99%', label: 'Clients satisfaits', icon: Heart },
          { value: '48h', label: 'Montage rapide', icon: Clock },
          { value: '10+', label: 'Experts dédiés', icon: Users }
        ]" :key="index"
        class="text-center p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
          <div class="text-4xl font-bold text-[#178e8b] mb-2">{{ stat.value }}</div>
          <div class="text-gray-600 font-medium">{{ stat.label }}</div>
          <div class="w-12 h-1 bg-gradient-to-r from-[#178e8b] to-[#0e437d] mx-auto mt-3"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Nos services audiovisuels -->
  <section class="py-20 bg-white animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Nos Services Audiovisuels</h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">Des productions de qualité cinéma pour tous vos besoins</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div v-for="(service, index) in services" :key="service.title"
             class="group bg-white rounded-3xl p-8 border border-gray-100 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
          <!-- Icon animé -->
          <div :class="['w-16 h-16 mb-6 rounded-2xl bg-gradient-to-br flex items-center justify-center group-hover:scale-110 transition-transform duration-300', service.color]">
            <component :is="service.icon" :size="28" class="text-white" />
          </div>

          <!-- Titre et description -->
          <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-[#178e8b] transition-colors duration-300">
            {{ service.title }}
          </h3>
          <p class="text-gray-600 mb-6 leading-relaxed">{{ service.description }}</p>

          <!-- Features -->
          <div class="space-y-3 mb-6">
            <div v-for="feature in service.features" :key="feature"
                 class="flex items-center gap-3 group-hover:translate-x-2 transition-transform duration-300">
              <div class="w-2 h-2 bg-gradient-to-r from-[#178e8b] to-[#0e437d] rounded-full flex-shrink-0"></div>
              <span class="text-gray-700 font-medium text-sm">{{ feature }}</span>
            </div>
          </div>

          <!-- Équipement/Logiciels -->
          <div class="p-4 bg-gradient-to-r from-gray-50 to-white rounded-xl border border-gray-100 mb-6">
            <div class="text-sm text-gray-500 mb-2">
              <span v-if="service.equipment">Équipement :</span>
              <span v-if="service.software">Logiciels :</span>
              <span v-if="service.certifications">Certifications :</span>
              <span v-if="service.platforms">Plateformes :</span>
            </div>
            <div class="flex flex-wrap gap-2">
              <span v-for="item in (service.equipment || service.software || service.certifications || service.platforms)" :key="item"
                    class="inline-block px-3 py-1 bg-white text-gray-700 text-xs rounded-full border border-gray-200">
                {{ item }}
              </span>
            </div>
          </div>

          <!-- Lien vers plus d'info -->
          <div class="mt-6 pt-6 border-t border-gray-100">
            <div class="flex items-center text-sm text-[#178e8b] font-medium group-hover:text-[#0e437d] transition-colors cursor-pointer">
              <span>Voir des exemples</span>
              <ChevronRight :size="16" class="ml-1 group-hover:translate-x-1 transition-transform" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Équipement professionnel -->
  <section class="py-20 bg-gradient-to-br from-gray-50 via-white to-gray-50 animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Notre Équipement Professionnel</h2>
        <p class="text-gray-600 text-lg">Du matériel haut de gamme pour des résultats cinéma</p>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
        <div v-for="item in equipment" :key="item.name"
             class="group bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
          <div class="text-lg font-bold text-gray-900 mb-2 group-hover:text-[#178e8b] transition-colors">
            {{ item.name }}
          </div>
          <div class="text-sm text-gray-500">{{ item.category }}</div>
          <div class="w-8 h-1 bg-gradient-to-r from-[#178e8b] to-[#0e437d] mx-auto mt-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>
      </div>

      <!-- Note sur l'équipement -->
      <div class="mt-12 bg-gradient-to-r from-[#178e8b]/5 to-[#0e437d]/5 rounded-2xl p-6 border border-[#178e8b]/10">
        <div class="flex items-start gap-4">
          <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#178e8b] to-[#0e437d] flex items-center justify-center flex-shrink-0">
            <Shield :size="24" class="text-white" />
          </div>
          <div>
            <h4 class="text-lg font-semibold text-gray-900 mb-2">Matériel régulièrement mis à jour</h4>
            <p class="text-gray-600">
              Nous investissons continuellement dans du matériel de pointe pour garantir la meilleure qualité possible.
              Tous nos équipements sont assurés et entretenus régulièrement par des professionnels.
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
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Pourquoi choisir notre production ?</h2>
        <p class="text-gray-600 text-lg">La qualité cinéma au service de votre communication</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div v-for="(benefit, index) in benefits" :key="benefit.title"
             class="group text-center p-6 bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
          <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-[#178e8b]/10 to-[#0e437d]/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
            <component :is="benefit.icon" :size="28" class="text-[#178e8b]" />
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">{{ benefit.title }}</h3>
          <p class="text-gray-600">{{ benefit.description }}</p>
          <div class="w-12 h-1 bg-gradient-to-r from-[#178e8b] to-[#0e437d] mx-auto mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Processus de production -->
  <section class="py-20 bg-gradient-to-br from-[#178e8b]/5 to-[#0e437d]/5 animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Notre Processus de Production</h2>
        <p class="text-gray-600 text-lg">De l'idée à la diffusion, un accompagnement complet</p>
      </div>

      <div class="grid md:grid-cols-4 gap-8">
        <div v-for="(step, index) in [
          { title: 'Pré-production', desc: 'Scénario, storyboard, planification' },
          { title: 'Production', desc: 'Tournage, éclairage, prise de son' },
          { title: 'Post-production', desc: 'Montage, étalonnage, sound design' },
          { title: 'Diffusion', desc: 'Export, livraison, optimisation' }
        ]" :key="index"
        class="relative">
          <div class="text-center p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
            <div class="text-4xl font-bold text-[#178e8b]/20 mb-4">0{{ index + 1 }}</div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ step.title }}</h3>
            <p class="text-gray-600">{{ step.desc }}</p>
          </div>
          <div v-if="index < 3" class="hidden md:block absolute top-1/2 right-0 w-8 h-1 bg-gradient-to-r from-[#178e8b] to-[#0e437d] transform translate-x-full"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Galerie témoin (placeholder) -->
  <section class="py-20 bg-white animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Galerie de Réalisations</h2>
        <p class="text-gray-600 text-lg">Découvrez un aperçu de nos productions</p>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div v-for="i in 4" :key="i"
             class="group relative aspect-video bg-gradient-to-br from-[#178e8b]/20 to-[#0e437d]/20 rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-300">
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-16 h-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
              <Play :size="24" class="text-white" />
            </div>
          </div>
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          <div class="absolute bottom-0 left-0 right-0 p-4 text-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
            <p class="text-sm font-semibold">Production {{ i }}</p>
          </div>
        </div>
      </div>

      <div class="text-center mt-8">
        <a href="/portfolio"
           class="group inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#178e8b] to-[#0e437d] text-white font-semibold rounded-xl hover:shadow-xl transition-all duration-300 hover:scale-105">
          <span>Voir notre portfolio complet</span>
          <ChevronRight :size="18" class="group-hover:translate-x-1 transition-transform" />
        </a>
      </div>
    </div>
  </section>

  <!-- CTA Final -->
  <section class="py-20 bg-gradient-to-br from-[#178e8b] via-[#0e437d] to-[#22ae84] text-white animate-on-scroll">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <Sparkles :size="48" class="mx-auto mb-6 text-[#FFD166] animate-pulse" />

      <h2 class="text-4xl md:text-5xl font-bold mb-6">
        Prêt à donner vie à votre <span class="text-[#FFD166]">histoire</span> ?
      </h2>

      <p class="text-xl opacity-90 mb-10 max-w-2xl mx-auto">
        Discutons de votre projet audiovisuel et créons ensemble une production qui marquera les esprits.
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <a href="/contact"
           class="group relative px-8 py-4 bg-white text-[#178e8b] rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105">
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
