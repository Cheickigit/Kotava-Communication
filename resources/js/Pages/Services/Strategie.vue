<script setup>
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/GuestLayout.vue';
import {
  ArrowLeft,
  Target,
  Check,
  BarChart,
  Users,
  TrendingUp,
  Globe,
  Shield,
  Award,
  Clock,
  Zap,
  FileText,
  Search,
  PieChart,
  ChevronRight,
  Sparkles,
  Rocket,
  Star,
  MessageCircle,
  Mail,
  Phone,
  Heart
} from 'lucide-vue-next';
import { ref, onMounted } from 'vue';

defineOptions({ layout: MainLayout });

const stats = ref([
  { value: '95%', label: 'Taux de réussite' },
  { value: '150+', label: 'Stratégies réussies' },
  { value: '360°', label: 'Analyse complète' },
  { value: '24/7', label: 'Accompagnement' }
]);

onMounted(() => {
  // Animation des statistiques
  const animateStats = () => {
    const statElements = document.querySelectorAll('.stat-value');
    statElements.forEach((el, index) => {
      const stat = stats.value[index];
      if (stat.value === '24/7' || stat.value === '360°') {
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
});
</script>

<template>
  <Head title="Stratégie & Conseil - KOTAVA Communication" />

  <!-- HERO SECTION avec animations -->
  <section class="relative bg-gradient-to-br from-[#0e437d] via-[#1a6ca3] to-[#22ae84] py-24 overflow-hidden min-h-[90vh] flex items-center animate-on-scroll">
    <!-- Animation background -->
    <div class="absolute inset-0 overflow-hidden">
      <div class="absolute top-20 left-10 w-64 h-64 bg-[#FFD166] rounded-full opacity-20 animate-pulse animation-delay-1000"></div>
      <div class="absolute bottom-20 right-10 w-80 h-80 bg-[#EF476F] rounded-full opacity-15 animate-pulse animation-delay-2000"></div>
      <div class="absolute top-1/2 left-1/4 w-48 h-48 bg-[#06D6A0] rounded-full opacity-20 animate-pulse"></div>

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

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <Link :href="route('services')" class="inline-flex items-center gap-2 text-white hover:text-white/80 mb-6 transition-colors group animate-slide-up">
        <ArrowLeft :size="20" class="group-hover:-translate-x-1 transition-transform" /> Retour aux services
      </Link>

      <div class="flex items-center gap-4 mb-6 animate-slide-up animation-delay-200">
        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#0e437d] to-[#22ae84] flex items-center justify-center shadow-xl hover:scale-105 transition-transform duration-300">
          <Target :size="32" class="text-white" />
        </div>
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 backdrop-blur-sm text-white text-sm font-medium border border-white/30 animate-bounce-subtle">
          <Sparkles :size="14" /> Expertise stratégique certifiée
        </div>
      </div>

      <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 animate-slide-up animation-delay-400">
        Stratégie & <span class="text-white/80 relative">
          Conseil
          <span class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-[#FFD166] to-transparent animate-underline"></span>
        </span>
      </h1>

      <p class="text-xl md:text-2xl text-white/90 max-w-3xl leading-relaxed mb-10 animate-slide-up animation-delay-600">
        Transformez votre vision en <span class="text-[#FFD166] font-semibold">stratégie gagnante</span> avec notre accompagnement expert en conseil et analyse de marché.
      </p>

      <!-- CTA Hero -->
      <div class="flex flex-col sm:flex-row gap-4 justify-start items-center animate-slide-up animation-delay-800">
        <Link
          :href="route('contact')"
          class="group relative px-8 py-4 bg-gradient-to-r from-[#FFD166] to-[#FFB347] text-gray-900 rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105 animate-pulse-subtle"
        >
          <span class="relative z-10 flex items-center gap-2">
            Demander un audit gratuit <ChevronRight :size="20" class="group-hover:translate-x-1 transition-transform" />
          </span>
        </Link>

        <a
          href="tel:+33708999900"
          class="group px-6 py-4 bg-white/10 backdrop-blur-lg text-white rounded-xl font-semibold text-lg border-2 border-white/20 hover:bg-white/20 hover:border-white/40 transition-all duration-300"
        >
          <span class="flex items-center gap-2">
            <Phone :size="20" /> +33 70 89 99 00
          </span>
        </a>
      </div>
    </div>
  </section>

  <!-- Statistiques animées -->
  <section class="py-16 bg-gradient-to-r from-white via-gray-50 to-white stats-section animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
        <div v-for="(stat, index) in stats" :key="index"
             class="text-center p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 group">
          <div class="text-4xl font-bold text-[#0e437d] mb-2 stat-value">{{ stat.value }}</div>
          <div class="text-gray-600 font-medium">{{ stat.label }}</div>
          <div class="w-12 h-1 bg-gradient-to-r from-[#0e437d] to-[#22ae84] mx-auto mt-3 opacity-0 group-hover:opacity-100 transition-opacity"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- INTRODUCTION -->
  <section class="py-20 bg-white animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div class="stagger-children">
          <h2 class="text-3xl font-bold text-gray-900 mb-6">
            L'art de la stratégie pour <span class="text-[#0e437d]">dominer votre marché</span>
          </h2>
          <p class="text-gray-600 mb-4 leading-relaxed">
            Chez KOTAVA Communication, nous croyons qu'une stratégie bien définie est le fondement de toute réussite.
            Notre équipe d'experts vous accompagne dans l'analyse approfondie de votre environnement concurrentiel,
            l'identification des opportunités de croissance et la définition d'un plan d'action sur mesure.
          </p>
          <p class="text-gray-600 mb-6 leading-relaxed">
            Nous combinons données analytiques, intelligence marché et vision créative pour développer des
            stratégies qui non seulement répondent à vos objectifs, mais anticipent les tendances futures.
          </p>

          <div class="grid grid-cols-3 gap-6 mt-8">
            <div class="text-center p-4 bg-gradient-to-br from-gray-50 to-white rounded-xl border border-gray-100 hover:border-[#22ae84]/30 transition-all duration-300 hover:-translate-y-1 group">
              <div class="text-3xl font-bold text-[#0e437d] mb-2">95%</div>
              <div class="text-sm text-gray-600 group-hover:text-[#0e437d] transition-colors">Taux de réussite</div>
            </div>
            <div class="text-center p-4 bg-gradient-to-br from-gray-50 to-white rounded-xl border border-gray-100 hover:border-[#22ae84]/30 transition-all duration-300 hover:-translate-y-1 group">
              <div class="text-3xl font-bold text-[#0e437d] mb-2">150+</div>
              <div class="text-sm text-gray-600 group-hover:text-[#0e437d] transition-colors">Stratégies réussies</div>
            </div>
            <div class="text-center p-4 bg-gradient-to-br from-gray-50 to-white rounded-xl border border-gray-100 hover:border-[#22ae84]/30 transition-all duration-300 hover:-translate-y-1 group">
              <div class="text-3xl font-bold text-[#0e437d] mb-2">360°</div>
              <div class="text-sm text-gray-600 group-hover:text-[#0e437d] transition-colors">Analyse complète</div>
            </div>
          </div>
        </div>

        <div class="relative">
          <div class="absolute inset-0 bg-gradient-to-br from-[#0e437d]/10 to-[#22ae84]/10 rounded-3xl blur-xl"></div>
          <div class="relative bg-white rounded-3xl p-8 shadow-2xl border border-gray-100 hover:shadow-3xl transition-all duration-500 group">
            <div class="flex items-center gap-3 mb-6">
              <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#0e437d] to-[#22ae84] flex items-center justify-center">
                <Award :size="20" class="text-white" />
              </div>
              <h3 class="text-xl font-bold text-gray-900">Pourquoi nous choisir ?</h3>
            </div>
            <ul class="space-y-4">
              <li class="flex items-start gap-3 group/item hover:translate-x-2 transition-transform duration-300">
                <Check :size="20" class="text-[#22ae84] mt-1 flex-shrink-0" />
                <span class="text-gray-700 group-hover/item:text-[#0e437d] transition-colors">Expertise certifiée en stratégie d'entreprise</span>
              </li>
              <li class="flex items-start gap-3 group/item hover:translate-x-2 transition-transform duration-300">
                <Check :size="20" class="text-[#22ae84] mt-1 flex-shrink-0" />
                <span class="text-gray-700 group-hover/item:text-[#0e437d] transition-colors">Méthodologie éprouvée sur 150+ projets</span>
              </li>
              <li class="flex items-start gap-3 group/item hover:translate-x-2 transition-transform duration-300">
                <Check :size="20" class="text-[#22ae84] mt-1 flex-shrink-0" />
                <span class="text-gray-700 group-hover/item:text-[#0e437d] transition-colors">Approche data-driven basée sur l'analyse</span>
              </li>
              <li class="flex items-start gap-3 group/item hover:translate-x-2 transition-transform duration-300">
                <Check :size="20" class="text-[#22ae84] mt-1 flex-shrink-0" />
                <span class="text-gray-700 group-hover/item:text-[#0e437d] transition-colors">Accompagnement personnalisé et continu</span>
              </li>
              <li class="flex items-start gap-3 group/item hover:translate-x-2 transition-transform duration-300">
                <Check :size="20" class="text-[#22ae84] mt-1 flex-shrink-0" />
                <span class="text-gray-700 group-hover/item:text-[#0e437d] transition-colors">Résultats mesurables et ROI garanti</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- NOS PRESTATIONS -->
  <section class="py-20 bg-gray-50 animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#0e437d]/10 text-[#0e437d] mb-4 text-sm font-semibold animate-fade-in">
          <Rocket :size="14" />
          Nos offres
        </div>
        <h2 class="text-3xl font-bold text-gray-900 mb-4 animate-fade-in animation-delay-200">Nos Prestations Stratégiques</h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto animate-fade-in animation-delay-400">
          Une gamme complète de services pour couvrir tous vos besoins en stratégie
        </p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 stagger-children">
        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 group border border-gray-100">
          <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#0e437d]/10 to-[#22ae84]/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
            <Search :size="24" class="text-[#0e437d]" />
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-[#0e437d] transition-colors">Audit Stratégique</h3>
          <p class="text-gray-600">Analyse complète de votre positionnement et opportunités</p>
          <ul class="mt-4 space-y-2">
            <li class="flex items-center text-sm text-gray-600 hover:text-[#0e437d] transition-colors">
              <div class="w-1.5 h-1.5 bg-[#22ae84] rounded-full mr-2"></div>
              Analyse SWOT
            </li>
            <li class="flex items-center text-sm text-gray-600 hover:text-[#0e437d] transition-colors">
              <div class="w-1.5 h-1.5 bg-[#22ae84] rounded-full mr-2"></div>
              Benchmark concurrentiel
            </li>
          </ul>
          <div class="mt-6 pt-4 border-t border-gray-100">
            <Link :href="route('contact')" class="text-sm text-[#0e437d] font-medium hover:text-[#22ae84] transition-colors inline-flex items-center gap-1 group/link">
              En savoir plus <ChevronRight :size="14" class="group-hover/link:translate-x-1 transition-transform" />
            </Link>
          </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 group border border-gray-100">
          <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#0e437d]/10 to-[#22ae84]/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
            <PieChart :size="24" class="text-[#0e437d]" />
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-[#0e437d] transition-colors">Plan Stratégique</h3>
          <p class="text-gray-600">Développement d'une roadmap stratégique sur mesure</p>
          <ul class="mt-4 space-y-2">
            <li class="flex items-center text-sm text-gray-600 hover:text-[#0e437d] transition-colors">
              <div class="w-1.5 h-1.5 bg-[#22ae84] rounded-full mr-2"></div>
              Définition d'objectifs SMART
            </li>
            <li class="flex items-center text-sm text-gray-600 hover:text-[#0e437d] transition-colors">
              <div class="w-1.5 h-1.5 bg-[#22ae84] rounded-full mr-2"></div>
              Plan d'action détaillé
            </li>
          </ul>
          <div class="mt-6 pt-4 border-t border-gray-100">
            <Link :href="route('contact')" class="text-sm text-[#0e437d] font-medium hover:text-[#22ae84] transition-colors inline-flex items-center gap-1 group/link">
              En savoir plus <ChevronRight :size="14" class="group-hover/link:translate-x-1 transition-transform" />
            </Link>
          </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 group border border-gray-100">
          <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#0e437d]/10 to-[#22ae84]/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
            <BarChart :size="24" class="text-[#0e437d]" />
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-[#0e437d] transition-colors">Stratégie Digitale</h3>
          <p class="text-gray-600">Développement d'une présence digitale optimisée</p>
          <ul class="mt-4 space-y-2">
            <li class="flex items-center text-sm text-gray-600 hover:text-[#0e437d] transition-colors">
              <div class="w-1.5 h-1.5 bg-[#22ae84] rounded-full mr-2"></div>
              Stratégie réseaux sociaux
            </li>
            <li class="flex items-center text-sm text-gray-600 hover:text-[#0e437d] transition-colors">
              <div class="w-1.5 h-1.5 bg-[#22ae84] rounded-full mr-2"></div>
              Plan marketing digital
            </li>
          </ul>
          <div class="mt-6 pt-4 border-t border-gray-100">
            <Link :href="route('contact')" class="text-sm text-[#0e437d] font-medium hover:text-[#22ae84] transition-colors inline-flex items-center gap-1 group/link">
              En savoir plus <ChevronRight :size="14" class="group-hover/link:translate-x-1 transition-transform" />
            </Link>
          </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 group border border-gray-100">
          <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#0e437d]/10 to-[#22ae84]/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
            <TrendingUp :size="24" class="text-[#0e437d]" />
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-[#0e437d] transition-colors">Conseil en Croissance</h3>
          <p class="text-gray-600">Accompagnement pour accélérer votre développement</p>
          <ul class="mt-4 space-y-2">
            <li class="flex items-center text-sm text-gray-600 hover:text-[#0e437d] transition-colors">
              <div class="w-1.5 h-1.5 bg-[#22ae84] rounded-full mr-2"></div>
              Identification de leviers
            </li>
            <li class="flex items-center text-sm text-gray-600 hover:text-[#0e437d] transition-colors">
              <div class="w-1.5 h-1.5 bg-[#22ae84] rounded-full mr-2"></div>
              Optimisation de la croissance
            </li>
          </ul>
          <div class="mt-6 pt-4 border-t border-gray-100">
            <Link :href="route('contact')" class="text-sm text-[#0e437d] font-medium hover:text-[#22ae84] transition-colors inline-flex items-center gap-1 group/link">
              En savoir plus <ChevronRight :size="14" class="group-hover/link:translate-x-1 transition-transform" />
            </Link>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- PROCESSUS -->
  <section class="py-20 bg-white animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-4 animate-fade-in">
          Notre Processus en <span class="text-[#0e437d]">4 Étapes</span>
        </h2>
        <p class="text-gray-600 max-w-2xl mx-auto animate-fade-in animation-delay-200">
          Une méthodologie éprouvée pour garantir le succès de votre stratégie
        </p>
      </div>

      <div class="relative">
        <!-- Ligne de connexion -->
        <div class="hidden md:block absolute top-1/2 left-0 right-0 h-0.5 bg-gradient-to-r from-[#0e437d] via-[#22ae84] to-[#FFD166] transform -translate-y-1/2"></div>

        <div class="grid md:grid-cols-4 gap-8 relative">
          <div class="text-center group">
            <div class="relative mb-6">
              <div class="absolute inset-0 bg-gradient-to-br from-[#0e437d]/10 to-[#22ae84]/10 rounded-full blur-lg group-hover:blur-xl transition-all duration-500"></div>
              <div class="relative w-20 h-20 rounded-full bg-gradient-to-br from-[#0e437d] to-[#22ae84] flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-500 border-4 border-white shadow-lg">
                <span class="text-white text-2xl font-bold">1</span>
              </div>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-[#0e437d] transition-colors">Diagnostic</h3>
            <p class="text-gray-600">Analyse approfondie de votre situation actuelle</p>
          </div>

          <div class="text-center group">
            <div class="relative mb-6">
              <div class="absolute inset-0 bg-gradient-to-br from-[#0e437d]/10 to-[#22ae84]/10 rounded-full blur-lg group-hover:blur-xl transition-all duration-500"></div>
              <div class="relative w-20 h-20 rounded-full bg-gradient-to-br from-[#0e437d] to-[#22ae84] flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-500 border-4 border-white shadow-lg">
                <span class="text-white text-2xl font-bold">2</span>
              </div>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-[#0e437d] transition-colors">Stratégie</h3>
            <p class="text-gray-600">Définition de la stratégie et des objectifs</p>
          </div>

          <div class="text-center group">
            <div class="relative mb-6">
              <div class="absolute inset-0 bg-gradient-to-br from-[#0e437d]/10 to-[#22ae84]/10 rounded-full blur-lg group-hover:blur-xl transition-all duration-500"></div>
              <div class="relative w-20 h-20 rounded-full bg-gradient-to-br from-[#0e437d] to-[#22ae84] flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-500 border-4 border-white shadow-lg">
                <span class="text-white text-2xl font-bold">3</span>
              </div>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-[#0e437d] transition-colors">Mise en œuvre</h3>
            <p class="text-gray-600">Implémentation du plan d'action</p>
          </div>

          <div class="text-center group">
            <div class="relative mb-6">
              <div class="absolute inset-0 bg-gradient-to-br from-[#0e437d]/10 to-[#22ae84]/10 rounded-full blur-lg group-hover:blur-xl transition-all duration-500"></div>
              <div class="relative w-20 h-20 rounded-full bg-gradient-to-br from-[#0e437d] to-[#22ae84] flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-500 border-4 border-white shadow-lg">
                <span class="text-white text-2xl font-bold">4</span>
              </div>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-[#0e437d] transition-colors">Suivi</h3>
            <p class="text-gray-600">Mesure des résultats et optimisation</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TÉMOIGNAGES -->
  <section class="py-20 bg-gradient-to-br from-gray-50 to-white animate-on-scroll">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#22ae84]/10 text-[#22ae84] mb-4 text-sm font-semibold animate-fade-in">
          <MessageCircle :size="14" />
          Ils nous font confiance
        </div>
        <h2 class="text-3xl font-bold text-gray-900 mb-4 animate-fade-in animation-delay-200">Retours d'expérience</h2>
        <p class="text-gray-600 max-w-2xl mx-auto animate-fade-in animation-delay-400">Découvrez ce que nos clients disent de notre accompagnement stratégique</p>
      </div>

      <div class="grid md:grid-cols-3 gap-8 stagger-children">
        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
          <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#0e437d] to-[#22ae84] flex items-center justify-center">
              <span class="text-white font-bold">JD</span>
            </div>
            <div>
              <h4 class="font-semibold text-gray-900">Jean Dupont</h4>
              <p class="text-sm text-gray-600">CEO - TechStartup</p>
            </div>
          </div>
          <p class="text-gray-600 italic mb-4">"La stratégie développée par KOTAVA a transformé notre approche marché. Résultat : +40% de croissance en 6 mois."</p>
          <div class="flex text-[#FFD166]">
            <Star :size="16" fill="currentColor" />
            <Star :size="16" fill="currentColor" />
            <Star :size="16" fill="currentColor" />
            <Star :size="16" fill="currentColor" />
            <Star :size="16" fill="currentColor" />
          </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
          <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#0e437d] to-[#22ae84] flex items-center justify-center">
              <span class="text-white font-bold">MS</span>
            </div>
            <div>
              <h4 class="font-semibold text-gray-900">Marie Sanchez</h4>
              <p class="text-sm text-gray-600">Directrice Marketing - LuxeBrand</p>
            </div>
          </div>
          <p class="text-gray-600 italic mb-4">"L'audit stratégique a mis en lumière des opportunités que nous n'avions pas identifiées. Un travail remarquable."</p>
          <div class="flex text-[#FFD166]">
            <Star :size="16" fill="currentColor" />
            <Star :size="16" fill="currentColor" />
            <Star :size="16" fill="currentColor" />
            <Star :size="16" fill="currentColor" />
            <Star :size="16" fill="currentColor" />
          </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
          <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#0e437d] to-[#22ae84] flex items-center justify-center">
              <span class="text-white font-bold">TM</span>
            </div>
            <div>
              <h4 class="font-semibold text-gray-900">Thomas Martin</h4>
              <p class="text-sm text-gray-600">Fondateur - EcoSolutions</p>
            </div>
          </div>
          <p class="text-gray-600 italic mb-4">"L'accompagnement en conseil de croissance a été déterminant pour notre expansion internationale."</p>
          <div class="flex text-[#FFD166]">
            <Star :size="16" fill="currentColor" />
            <Star :size="16" fill="currentColor" />
            <Star :size="16" fill="currentColor" />
            <Star :size="16" fill="currentColor" />
            <Star :size="16" fill="currentColor" />
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA FINAL -->
  <section class="py-20 bg-gradient-to-br from-[#0e437d] to-[#22ae84] text-white animate-on-scroll">
    <div class="absolute inset-0 overflow-hidden">
      <div class="absolute -top-20 -left-20 w-64 h-64 bg-white rounded-full opacity-10 blur-3xl"></div>
      <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-white rounded-full opacity-10 blur-3xl"></div>
    </div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 backdrop-blur-sm text-white mb-6 text-sm font-medium animate-bounce-subtle">
        <Sparkles :size="14" /> Offre limitée
      </div>

      <h2 class="text-4xl md:text-5xl font-bold mb-6">
        Prêt à définir votre <span class="text-[#FFD166]">stratégie gagnante</span> ?
      </h2>

      <p class="text-xl opacity-90 mb-8 max-w-2xl mx-auto">
        Contactez-nous pour un <span class="font-semibold">diagnostic stratégique gratuit</span> et découvrez comment nous pouvons transformer votre vision en succès concret.
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <Link
          :href="route('contact')"
          class="group relative px-8 py-4 bg-white text-[#0e437d] rounded-xl font-bold text-lg overflow-hidden hover:shadow-2xl transition-all duration-300 hover:scale-105"
        >
          <span class="relative z-10 flex items-center gap-3">
            <Mail :size="20" /> Demander un audit gratuit
          </span>
        </Link>

        <a
          href="tel:+33708999900"
          class="px-6 py-3 bg-transparent border-2 border-white text-white rounded-lg font-semibold hover:bg-white/10 transition-all duration-300 inline-flex items-center gap-3 group"
        >
          <Phone :size="18" class="group-hover:scale-110 transition-transform" /> +33 70 89 99 00
        </a>
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

.animate-float {
  animation: float linear infinite;
}

.animate-slide-up {
  animation: slideUp 0.8s ease-out forwards;
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

.animate-fade-in {
  animation: fadeIn 0.8s ease-out forwards;
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

.animation-delay-800 {
  animation-delay: 800ms;
}

.animation-delay-1000 {
  animation-delay: 1000ms;
}

.animation-delay-2000 {
  animation-delay: 2000ms;
}

.stagger-children > * {
  opacity: 0;
  animation: slideUp 0.8s ease-out forwards;
}

.stagger-children > *:nth-child(1) { animation-delay: 100ms; }
.stagger-children > *:nth-child(2) { animation-delay: 200ms; }
.stagger-children > *:nth-child(3) { animation-delay: 300ms; }
.stagger-children > *:nth-child(4) { animation-delay: 400ms; }
.stagger-children > *:nth-child(5) { animation-delay: 500ms; }
.stagger-children > *:nth-child(6) { animation-delay: 600ms; }

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
