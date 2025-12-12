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
  Award
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
    color: 'from-[#0e437d] to-[#22ae84]'
  },
  {
    icon: Palette,
    title: 'Branding & Design',
    description: 'Identité visuelle complète, logo et charte graphique premium',
    color: 'from-[#22ae84] to-[#1c978a]'
  },
  {
    icon: Globe,
    title: 'Digital & Web',
    description: 'Sites web vitrine et e-commerce, UX/UI design optimisé',
    color: 'from-[#1c978a] to-[#178e8b]'
  },
  {
    icon: Video,
    title: 'Production Audiovisuel',
    description: 'Tournage vidéo, photographie et motion design professionnel',
    color: 'from-[#178e8b] to-[#0e437d]'
  },
  {
    icon: Calendar,
    title: 'Événementiel & RP',
    description: 'Organisation d\'événements et stratégie d\'influence',
    color: 'from-[#22ae84] to-[#1c978a]'
  },
  {
    icon: MessageSquare,
    title: 'Social Media & Contenu',
    description: 'Gestion réseaux sociaux et campagnes publicitaires ciblées',
    color: 'from-[#0e437d] to-[#22ae84]'
  }
];

const team = [
  { name: 'SMILE TCHICAYA', role: 'CEO, Strategic Director', image: null },
  { name: 'AARON LOEB', role: 'DG, Marketing Director', image: null },
  { name: 'MODESTE METO', role: 'Responsable Communication', image: null },
  { name: 'CLAUDIA ALVES', role: 'Développeur Web & Data Analyste', image: null }
];

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
  // Auto-rotate testimonials
  setInterval(() => {
    currentTestimonial.value = (currentTestimonial.value + 1) % testimonials.length;
  }, 5000);
});
</script>

<template>
  <GuestLayout>
    <Head title="Accueil - KOTAVA Communication" />

    <!-- Hero Section avec Liquid Glass -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-[#0e437d] via-[#1c978a] to-[#22ae84]">
      <!-- Animated Background Blobs -->
      <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-1/2 -left-1/2 w-full h-full bg-gradient-to-br from-[#22ae84]/30 to-transparent rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-1/2 -right-1/2 w-full h-full bg-gradient-to-tl from-[#0e437d]/30 to-transparent rounded-full blur-3xl animate-pulse delay-1000"></div>
      </div>

      <!-- Glass Card Hero -->
      <div class="relative z-10 max-w-7xl mx-auto px-6 py-20 text-center">
        <div class="backdrop-blur-lg bg-white/10 rounded-3xl p-12 shadow-2xl border border-white/20">
          <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-6 py-2 rounded-full text-white mb-8">
            <Sparkles :size="20" class="text-[#22ae84]" />
            <span class="text-sm font-semibold">Agence de Communication Premium</span>
          </div>

          <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
            Transformez Votre
            <span class="block bg-gradient-to-r from-[#22ae84] to-[#1c978a] bg-clip-text text-transparent">
              Présence Digitale
            </span>
          </h1>

          <p class="text-xl md:text-2xl text-white/90 mb-10 max-w-3xl mx-auto leading-relaxed">
            Redéfinir la communication comme une expérience sensorielle et émotionnelle,
            où chaque interaction devient une connexion authentique.
          </p>

          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <Link href="/contact" class="group inline-flex items-center gap-2 bg-white text-[#0e437d] px-8 py-4 rounded-xl font-semibold text-lg shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
              Démarrer un Projet
              <ArrowRight :size="20" class="group-hover:translate-x-1 transition-transform" />
            </Link>
            <Link href="/portfolio" class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/30 text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-white/20 transition-all duration-300">
              Voir nos Réalisations
            </Link>
          </div>
        </div>

        <!-- Stats Cards Glassmorphism -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-16">
          <div class="backdrop-blur-md bg-white/10 rounded-2xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300">
            <div class="text-4xl font-bold text-white mb-2">60%</div>
            <div class="text-white/80 text-sm">Campagnes Pub</div>
          </div>
          <div class="backdrop-blur-md bg-white/10 rounded-2xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300">
            <div class="text-4xl font-bold text-white mb-2">30%</div>
            <div class="text-white/80 text-sm">Branding</div>
          </div>
          <div class="backdrop-blur-md bg-white/10 rounded-2xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300">
            <div class="text-4xl font-bold text-white mb-2">10%</div>
            <div class="text-white/80 text-sm">Dev Web</div>
          </div>
          <div class="backdrop-blur-md bg-white/10 rounded-2xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300">
            <div class="text-4xl font-bold text-white mb-2">50+</div>
            <div class="text-white/80 text-sm">Clients Satisfaits</div>
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
    <section class="py-24 bg-white">
      <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
          <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
            Nos Services <span class="text-[#22ae84]">Premium</span>
          </h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Une gamme complète de solutions pour propulser votre marque vers l'excellence digitale
          </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div
            v-for="(service, index) in services"
            :key="index"
            class="group relative bg-gradient-to-br from-gray-50 to-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:scale-105"
          >
            <div class="absolute inset-0 bg-gradient-to-br opacity-0 group-hover:opacity-10 rounded-2xl transition-opacity duration-500" :class="service.color"></div>

            <div class="relative z-10">
              <div class="w-16 h-16 bg-gradient-to-br rounded-xl flex items-center justify-center mb-6 shadow-lg" :class="service.color">
                <component :is="service.icon" :size="32" class="text-white" />
              </div>

              <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ service.title }}</h3>
              <p class="text-gray-600 mb-4">{{ service.description }}</p>

              <Link href="/services" class="inline-flex items-center gap-2 text-[#0e437d] font-semibold group-hover:gap-3 transition-all">
                En savoir plus
                <ChevronRight :size="20" />
              </Link>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Portfolio Featured -->
    <section class="py-24 bg-gradient-to-br from-gray-50 to-white">
      <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
          <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
            Nos <span class="text-[#22ae84]">Réalisations</span>
          </h2>
          <p class="text-xl text-gray-600">Des projets qui font la différence</p>
        </div>

        <div v-if="realisations && realisations.length > 0" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
          <div
            v-for="realisation in realisations.slice(0, 6)"
            :key="realisation.id"
            class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500"
          >
            <img
              v-if="realisation.image"
              :src="realisation.image"
              :alt="realisation.titre"
              class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-700"
            />
            <div v-else class="w-full h-80 bg-gradient-to-br from-[#0e437d] to-[#22ae84]"></div>

            <div class="absolute inset-0 bg-gradient-to-t from-[#0e437d]/90 via-[#0e437d]/50 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-6">
              <h3 class="text-2xl font-bold text-white mb-2">{{ realisation.titre }}</h3>
              <p class="text-white/90 mb-4">{{ realisation.description }}</p>
              <Link :href="`/portfolio/${realisation.slug}`" class="inline-flex items-center gap-2 text-white font-semibold">
                Voir le projet
                <ArrowRight :size="20" />
              </Link>
            </div>
          </div>
        </div>

        <div v-else class="text-center py-12">
          <p class="text-gray-500 text-lg">Nos projets arrivent bientôt...</p>
        </div>

        <div class="text-center">
          <Link href="/portfolio" class="inline-flex items-center gap-2 bg-[#0e437d] text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-[#22ae84] transition-all duration-300 shadow-lg hover:shadow-xl">
            Voir tout le Portfolio
            <ChevronRight :size="20" />
          </Link>
        </div>
      </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-24 bg-white">
      <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
          <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
            Pourquoi <span class="text-[#22ae84]">KOTAVA</span> ?
          </h2>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
          <div class="text-center">
            <div class="w-20 h-20 bg-gradient-to-br from-[#0e437d] to-[#22ae84] rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl">
              <Sparkles :size="36" class="text-white" />
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Créativité & Authenticité</h3>
            <p class="text-gray-600">Design percutant qui reste gravé dans l'esprit des clients</p>
          </div>

          <div class="text-center">
            <div class="w-20 h-20 bg-gradient-to-br from-[#22ae84] to-[#1c978a] rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl">
              <Users :size="36" class="text-white" />
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Connexion & Confiance</h3>
            <p class="text-gray-600">Stratégies qui rapprochent les marques de leur audience</p>
          </div>

          <div class="text-center">
            <div class="w-20 h-20 bg-gradient-to-br from-[#1c978a] to-[#178e8b] rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl">
              <TrendingUp :size="36" class="text-white" />
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Innovation & Excellence</h3>
            <p class="text-gray-600">Technologies digitales pour un avantage compétitif</p>
          </div>

          <div class="text-center">
            <div class="w-20 h-20 bg-gradient-to-br from-[#178e8b] to-[#0e437d] rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl">
              <Award :size="36" class="text-white" />
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Performance & Impact</h3>
            <p class="text-gray-600">Solutions qui génèrent un impact mesurable</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonials -->
    <section class="py-24 bg-gradient-to-br from-[#0e437d] to-[#22ae84] relative overflow-hidden">
      <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
      </div>

      <div class="max-w-4xl mx-auto px-6 relative z-10">
        <div class="text-center mb-16">
          <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">
            Ils Nous Font Confiance
          </h2>
        </div>

        <div class="backdrop-blur-lg bg-white/10 rounded-3xl p-12 border border-white/20 shadow-2xl">
          <div class="flex justify-center mb-6">
            <div class="flex gap-1">
              <Star v-for="i in 5" :key="i" :size="24" class="text-yellow-400 fill-yellow-400" />
            </div>
          </div>

          <p class="text-2xl text-white text-center mb-8 leading-relaxed">
            "{{ testimonials[currentTestimonial].content }}"
          </p>

          <div class="text-center">
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
              class="w-3 h-3 rounded-full transition-all duration-300"
              :class="currentTestimonial === index ? 'bg-white w-8' : 'bg-white/50'"
            ></button>
          </div>
        </div>
      </div>
    </section>

    <!-- Team -->
    <section class="py-24 bg-white">
      <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
          <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
            Notre <span class="text-[#22ae84]">Équipe</span>
          </h2>
          <p class="text-xl text-gray-600">Des experts passionnés à votre service</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
          <div
            v-for="(member, index) in team"
            :key="index"
            class="group text-center"
          >
            <div class="relative mb-6 overflow-hidden rounded-2xl shadow-lg">
              <div class="w-full h-80 bg-gradient-to-br from-[#0e437d] to-[#22ae84] flex items-center justify-center">
                <Users :size="64" class="text-white/50" />
              </div>
              <div class="absolute inset-0 bg-gradient-to-t from-[#0e437d]/90 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                <Link href="/equipe" class="text-white font-semibold flex items-center gap-2">
                  Voir profil
                  <ArrowRight :size="18" />
                </Link>
              </div>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ member.name }}</h3>
            <p class="text-gray-600">{{ member.role }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Blog/Actualités -->
    <section v-if="actualites && actualites.length > 0" class="py-24 bg-gray-50">
      <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
          <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
            Dernières <span class="text-[#22ae84]">Actualités</span>
          </h2>
        </div>

        <div class="grid md:grid-cols-3 gap-8 mb-12">
          <article
            v-for="article in actualites.slice(0, 3)"
            :key="article.id"
            class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105"
          >
            <img
              v-if="article.image"
              :src="article.image"
              :alt="article.titre"
              class="w-full h-56 object-cover"
            />
            <div v-else class="w-full h-56 bg-gradient-to-br from-[#0e437d] to-[#22ae84]"></div>

            <div class="p-6">
              <div class="text-sm text-[#22ae84] font-semibold mb-2">{{ article.date }}</div>
              <h3 class="text-xl font-bold text-gray-900 mb-3">{{ article.titre }}</h3>
              <p class="text-gray-600 mb-4">{{ article.extrait }}</p>
              <Link :href="`/blog/${article.slug}`" class="inline-flex items-center gap-2 text-[#0e437d] font-semibold hover:gap-3 transition-all">
                Lire la suite
                <ArrowRight :size="18" />
              </Link>
            </div>
          </article>
        </div>

        <div class="text-center">
          <Link href="/blog" class="inline-flex items-center gap-2 bg-[#0e437d] text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-[#22ae84] transition-all duration-300">
            Toutes les actualités
            <ChevronRight :size="20" />
          </Link>
        </div>
      </div>
    </section>

    <!-- CTA Final -->
    <section class="py-24 bg-gradient-to-br from-[#0e437d] via-[#1c978a] to-[#22ae84] relative overflow-hidden">
      <div class="absolute inset-0 opacity-20">
        <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl animate-pulse delay-1000"></div>
      </div>

      <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
        <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
          Prêt à Transformer Votre Marque ?
        </h2>
        <p class="text-xl text-white/90 mb-10">
          Contactez-nous dès aujourd'hui et découvrez comment nous pouvons propulser votre entreprise vers le succès
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <Link href="/contact" class="inline-flex items-center gap-2 bg-white text-[#0e437d] px-8 py-4 rounded-xl font-semibold text-lg shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
            Démarrer Maintenant
            <ArrowRight :size="20" />
          </Link>
          <a href="tel:+33708999900" class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/30 text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-white/20 transition-all duration-300">
            +33 70 89 99 00
          </a>
        </div>
      </div>
    </section>
  </GuestLayout>
</template>

<style scoped>
@keyframes pulse {
  0%, 100% {
    opacity: 0.3;
  }
  50% {
    opacity: 0.5;
  }
}

.delay-1000 {
  animation-delay: 1s;
}
</style>
