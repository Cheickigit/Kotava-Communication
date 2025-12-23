<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import {
  Menu, X, ChevronDown, Target, Palette, Globe,
  Video, Calendar, MessageSquare, Mail, Phone,
  MapPin, Facebook, Twitter, Linkedin, Instagram
} from 'lucide-vue-next';

const mobileMenuOpen = ref(false);
const scrolled = ref(false);
const servicesOpen = ref(false);
const showScrollTop = ref(false);

const services = [
  {
    icon: Target,
    title: 'Stratégie & Conseil',
    desc: 'Audit et positionnement de marque',
    href: '/services#strategie',
    color: 'from-[#0e437d] to-[#22ae84]'
  },
  {
    icon: Palette,
    title: 'Branding & Design',
    desc: 'Identité visuelle premium',
    href: '/services#branding',
    color: 'from-[#22ae84] to-[#1c978a]'
  },
  {
    icon: Globe,
    title: 'Digital & Web',
    desc: 'Sites web sur-mesure',
    href: '/services#digital',
    color: 'from-[#1c978a] to-[#178e8b]'
  },
  {
    icon: Video,
    title: 'Production Audiovisuel',
    desc: 'Vidéo et photographie pro',
    href: '/services#audiovisuel',
    color: 'from-[#178e8b] to-[#0e437d]'
  },
  {
    icon: Calendar,
    title: 'Événementiel & RP',
    desc: 'Organisation et influence',
    href: '/services#evenementiel',
    color: 'from-[#22ae84] to-[#1c978a]'
  },
  {
    icon: MessageSquare,
    title: 'Social Media',
    desc: 'Community management',
    href: '/services#social',
    color: 'from-[#0e437d] to-[#22ae84]'
  },
];

const handleScroll = () => {
  scrolled.value = window.scrollY > 20;
  showScrollTop.value = window.scrollY > 500;
};

const scrollToTop = () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
};

onMounted(() => {
  window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
  <div class="min-h-screen bg-white">
    <!-- Navigation -->
    <nav
      :class="[
        'fixed top-0 w-full z-50 transition-all duration-500',
        scrolled
          ? 'backdrop-blur-xl bg-white/95 shadow-xl border-b border-gray-200/50'
          : 'backdrop-blur-md bg-white/80 border-b border-transparent'
      ]"
    >
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
          <!-- Logo Enhanced -->
          <Link href="/" class="flex items-center gap-3 group">
            <div class="relative">
              <!-- Glow effect -->
              <div class="absolute -inset-1 bg-gradient-to-br from-[#0e437d] via-[#22ae84] to-[#1c978a] rounded-2xl blur-lg opacity-40 group-hover:opacity-70 transition-all duration-500 animate-pulse"></div>

              <!-- Logo container -->
              <div class="relative w-12 h-12 rounded-xl overflow-hidden ring-2 ring-white/50 shadow-xl group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                <img
                  src="/Com B.png"
                  alt="KOTAVA Communication"
                  class="w-full h-full object-cover"
                />
              </div>
            </div>

            <div class="hidden sm:block">
              <div class="text-xl font-bold bg-gradient-to-r from-[#0e437d] to-[#22ae84] bg-clip-text text-transparent group-hover:from-[#22ae84] group-hover:to-[#0e437d] transition-all duration-500">
                KOTAVA
              </div>
              <div class="text-xs text-gray-600 group-hover:text-[#22ae84] transition-colors duration-300">
                Communication
              </div>
            </div>
          </Link>

          <!-- Desktop Menu -->
          <div class="hidden lg:flex items-center gap-1">
            <Link
              href="/"
              :class="[
                'px-4 py-2 rounded-xl font-medium transition-all duration-300 relative group',
                route().current('home')
                  ? 'text-[#22ae84]'
                  : 'text-gray-700 hover:text-[#22ae84]'
              ]"
            >
              <span class="relative z-10">Accueil</span>
              <div class="absolute inset-0 bg-gradient-to-r from-[#22ae84]/10 to-[#0e437d]/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </Link>
            <!-- Dans le menu desktop -->
            <Link
                href="/team"
                class="px-4 py-2 rounded-lg font-medium text-gray-700 hover:text-[#22ae84] hover:bg-gray-50 transition-all duration-300"
            >
                Équipe
            </Link>


            <!-- Services Mega Menu -->
            <div class="relative group">
              <button class="flex items-center gap-1 px-4 py-2 rounded-xl font-medium text-gray-700 hover:text-[#22ae84] transition-all duration-300 relative">
                <span class="relative z-10">Services</span>
                <ChevronDown :size="16" class="group-hover:rotate-180 transition-transform duration-500" />
                <div class="absolute inset-0 bg-gradient-to-r from-[#22ae84]/10 to-[#0e437d]/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              </button>

              <!-- Improved Dropdown -->
              <div class="absolute top-full left-1/2 -translate-x-1/2 mt-3 w-[600px] bg-white rounded-2xl shadow-2xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 translate-y-2 transition-all duration-500 overflow-hidden">
                <div class="p-4">
                  <div class="grid grid-cols-2 gap-3">
                    <Link
                      v-for="service in services"
                      :key="service.title"
                      :href="service.href"
                      class="group/item flex items-start gap-4 p-4 rounded-xl hover:bg-gradient-to-br hover:from-gray-50 hover:to-[#22ae84]/5 transition-all duration-300"
                    >
                      <div :class="['w-12 h-12 rounded-xl bg-gradient-to-br', service.color, 'flex items-center justify-center text-white shadow-lg group-hover/item:scale-110 group-hover/item:rotate-6 transition-all duration-300']">
                        <component :is="service.icon" :size="20" />
                      </div>
                      <div class="flex-1 min-w-0">
                        <div class="font-semibold text-gray-900 group-hover/item:text-[#22ae84] transition-colors mb-1">
                          {{ service.title }}
                        </div>
                        <div class="text-xs text-gray-500 line-clamp-1">
                          {{ service.desc }}
                        </div>
                      </div>
                    </Link>
                  </div>
                </div>

                <!-- View All Services -->
                <Link
                  href="/services"
                  class="block bg-gradient-to-r from-gray-50 to-[#22ae84]/5 px-6 py-3 text-center text-sm font-semibold text-[#22ae84] hover:from-[#22ae84]/10 hover:to-[#0e437d]/10 transition-all duration-300"
                >
                  Voir tous les services →
                </Link>
              </div>
            </div>

            <Link
              href="/portfolio"
              :class="[
                'px-4 py-2 rounded-xl font-medium transition-all duration-300 relative group',
                route().current('portfolio')
                  ? 'text-[#22ae84]'
                  : 'text-gray-700 hover:text-[#22ae84]'
              ]"
            >
              <span class="relative z-10">Portfolio</span>
              <div class="absolute inset-0 bg-gradient-to-r from-[#22ae84]/10 to-[#0e437d]/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </Link>

            <Link
              href="/blog"
              :class="[
                'px-4 py-2 rounded-xl font-medium transition-all duration-300 relative group',
                route().current('blog')
                  ? 'text-[#22ae84]'
                  : 'text-gray-700 hover:text-[#22ae84]'
              ]"
            >
              <span class="relative z-10">Blog</span>
              <div class="absolute inset-0 bg-gradient-to-r from-[#22ae84]/10 to-[#0e437d]/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </Link>

            <Link
              href="/about"
              :class="[
                'px-4 py-2 rounded-xl font-medium transition-all duration-300 relative group',
                route().current('about')
                  ? 'text-[#22ae84]'
                  : 'text-gray-700 hover:text-[#22ae84]'
              ]"
            >
              <span class="relative z-10">À propos</span>
              <div class="absolute inset-0 bg-gradient-to-r from-[#22ae84]/10 to-[#0e437d]/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </Link>

            <!-- Enhanced CTA Buttons -->
            <div class="flex items-center gap-3 ml-4 pl-4 border-l border-gray-200">
              <a
                href="tel:+33708999900"
                class="group p-2.5 rounded-xl text-gray-700 hover:text-[#22ae84] hover:bg-gradient-to-br hover:from-gray-50 hover:to-[#22ae84]/10 transition-all duration-300"
                title="Appelez-nous"
              >
                <Phone :size="20" class="group-hover:rotate-12 transition-transform duration-300" />
              </a>

              <Link
                href="/contact"
                class="group relative bg-gradient-to-r from-[#0e437d] via-[#22ae84] to-[#1c978a] text-white px-6 py-2.5 rounded-xl font-semibold shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-500 overflow-hidden"
              >
                <span class="relative z-10 flex items-center gap-2">
                  Contact
                  <Mail :size="18" class="group-hover:translate-x-1 transition-transform duration-300" />
                </span>
                <div class="absolute inset-0 bg-gradient-to-r from-[#1c978a] via-[#22ae84] to-[#0e437d] opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
              </Link>
            </div>
          </div>

          <!-- Mobile Menu Button -->
          <button
            @click="mobileMenuOpen = !mobileMenuOpen"
            class="lg:hidden p-2.5 rounded-xl text-gray-700 hover:text-[#22ae84] hover:bg-gray-100 transition-all duration-300"
          >
            <Menu v-if="!mobileMenuOpen" :size="24" class="transition-transform duration-300" />
            <X v-else :size="24" class="rotate-90 transition-transform duration-300" />
          </button>
        </div>
      </div>

      <!-- Mobile Menu Enhanced -->
      <Transition
        enter-active-class="transition-all duration-500 ease-out"
        enter-from-class="opacity-0 -translate-y-4"
        enter-to-class="opacity-100 translate-y-0"
        leave-active-class="transition-all duration-300 ease-in"
        leave-from-class="opacity-100 translate-y-0"
        leave-to-class="opacity-0 -translate-y-4"
      >
        <div v-if="mobileMenuOpen" class="lg:hidden bg-white/95 backdrop-blur-xl border-t border-gray-200 shadow-2xl">
          <div class="px-4 py-6 space-y-2 max-h-[calc(100vh-5rem)] overflow-y-auto">
            <Link
              href="/"
              @click="mobileMenuOpen = false"
              :class="[
                'block font-medium py-3 px-4 rounded-xl transition-all duration-300',
                route().current('home')
                  ? 'bg-gradient-to-r from-[#22ae84]/10 to-[#0e437d]/10 text-[#22ae84]'
                  : 'text-gray-700 hover:bg-gray-50'
              ]"
            >
              Accueil
            </Link>
            <!-- Dans le menu mobile -->
            <Link href="/team" class="block text-gray-700 hover:text-[#22ae84] font-medium py-3 px-4 rounded-lg hover:bg-gray-50 transition-all">
                Équipe
            </Link>


            <!-- Mobile Services Accordion Enhanced -->
            <div>
              <button
                @click="servicesOpen = !servicesOpen"
                class="flex items-center justify-between w-full text-gray-700 hover:text-[#22ae84] font-medium py-3 px-4 rounded-xl hover:bg-gray-50 transition-all duration-300"
              >
                Services
                <ChevronDown :size="16" :class="{ 'rotate-180': servicesOpen }" class="transition-transform duration-500" />
              </button>

              <Transition
                enter-active-class="transition-all duration-500 ease-out"
                enter-from-class="opacity-0 max-h-0"
                enter-to-class="opacity-100 max-h-96"
                leave-active-class="transition-all duration-300 ease-in"
                leave-from-class="opacity-100 max-h-96"
                leave-to-class="opacity-0 max-h-0"
              >
                <div v-if="servicesOpen" class="pl-2 space-y-1 mt-2 overflow-hidden">
                  <Link
                    v-for="service in services"
                    :key="service.title"
                    :href="service.href"
                    @click="mobileMenuOpen = false"
                    class="flex items-center gap-3 text-gray-600 hover:text-[#22ae84] py-3 px-3 rounded-xl hover:bg-gradient-to-r hover:from-gray-50 hover:to-[#22ae84]/5 transition-all duration-300"
                  >
                    <div :class="['w-8 h-8 rounded-lg bg-gradient-to-br', service.color, 'flex items-center justify-center text-white shadow-md']">
                      <component :is="service.icon" :size="16" />
                    </div>
                    <span class="font-medium">{{ service.title }}</span>
                  </Link>
                </div>
              </Transition>
            </div>

            <Link
              href="/portfolio"
              @click="mobileMenuOpen = false"
              :class="[
                'block font-medium py-3 px-4 rounded-xl transition-all duration-300',
                route().current('portfolio')
                  ? 'bg-gradient-to-r from-[#22ae84]/10 to-[#0e437d]/10 text-[#22ae84]'
                  : 'text-gray-700 hover:bg-gray-50'
              ]"
            >
              Portfolio
            </Link>

            <Link
              href="/blog"
              @click="mobileMenuOpen = false"
              :class="[
                'block font-medium py-3 px-4 rounded-xl transition-all duration-300',
                route().current('blog')
                  ? 'bg-gradient-to-r from-[#22ae84]/10 to-[#0e437d]/10 text-[#22ae84]'
                  : 'text-gray-700 hover:bg-gray-50'
              ]"
            >
              Blog
            </Link>

            <Link
              href="/about"
              @click="mobileMenuOpen = false"
              :class="[
                'block font-medium py-3 px-4 rounded-xl transition-all duration-300',
                route().current('about')
                  ? 'bg-gradient-to-r from-[#22ae84]/10 to-[#0e437d]/10 text-[#22ae84]'
                  : 'text-gray-700 hover:bg-gray-50'
              ]"
            >
              À propos
            </Link>

            <div class="pt-4 space-y-3 border-t border-gray-200 mt-4">
              <a
                href="tel:+33708999900"
                class="flex items-center justify-center gap-3 bg-gray-100 text-gray-900 px-6 py-3.5 rounded-xl font-semibold hover:bg-gray-200 transition-all duration-300 shadow-md"
              >
                <Phone :size="18" />
                +33 70 89 99 00
              </a>

              <Link
                href="/contact"
                @click="mobileMenuOpen = false"
                class="flex items-center justify-center gap-3 bg-gradient-to-r from-[#0e437d] via-[#22ae84] to-[#1c978a] text-white px-6 py-3.5 rounded-xl font-semibold shadow-xl hover:shadow-2xl transition-all duration-300"
              >
                <Mail :size="18" />
                Nous Contacter
              </Link>
            </div>
          </div>
        </div>
      </Transition>
    </nav>

    <!-- Page Content -->
    <main class="pt-20">
      <slot />
    </main>

    <!-- Scroll to Top Button -->
    <Transition
      enter-active-class="transition-all duration-300 ease-out"
      enter-from-class="opacity-0 scale-0"
      enter-to-class="opacity-100 scale-100"
      leave-active-class="transition-all duration-200 ease-in"
      leave-from-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-0"
    >
      <button
        v-if="showScrollTop"
        @click="scrollToTop"
        class="fixed bottom-8 right-8 z-40 p-4 bg-gradient-to-br from-[#0e437d] to-[#22ae84] text-white rounded-full shadow-2xl hover:shadow-3xl hover:scale-110 transition-all duration-300 group"
        title="Retour en haut"
      >
        <svg class="w-6 h-6 group-hover:-translate-y-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
      </button>
    </Transition>

    <!-- Enhanced Footer -->
    <footer class="relative bg-gradient-to-br from-gray-900 via-[#0e437d] to-gray-900 text-white overflow-hidden">
      <!-- Decorative elements -->
      <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-[#22ae84] rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-[#1c978a] rounded-full blur-3xl"></div>
      </div>

      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid md:grid-cols-4 gap-12 mb-12">
          <!-- Company Info Enhanced -->
          <div class="col-span-2">
            <div class="flex items-center gap-3 mb-6 group">
              <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-br from-[#22ae84] to-[#1c978a] rounded-xl blur-md opacity-50 group-hover:opacity-75 transition-opacity"></div>
                <div class="relative w-12 h-12 rounded-xl overflow-hidden ring-2 ring-white/20">
                  <img src="/Com B.png" alt="KOTAVA" class="w-full h-full object-cover" />
                </div>
              </div>
              <div>
                <div class="text-xl font-bold">KOTAVA</div>
                <div class="text-sm text-gray-400">Communication</div>
              </div>
            </div>

            <p class="text-gray-300 mb-6 leading-relaxed">
              Redéfinir la communication comme une expérience sensorielle et émotionnelle.
              Votre partenaire de confiance pour la transformation digitale.
            </p>

            <div class="space-y-3">
              <a href="mailto:direction@kotavacommunication.com" class="flex items-center gap-3 text-gray-300 hover:text-[#22ae84] transition-colors group">
                <div class="p-2 rounded-lg bg-white/5 group-hover:bg-[#22ae84]/20 transition-colors">
                  <Mail :size="16" />
                </div>
                <span class="text-sm">direction@kotavacommunication.com</span>
              </a>

              <a href="tel:+33708999900" class="flex items-center gap-3 text-gray-300 hover:text-[#22ae84] transition-colors group">
                <div class="p-2 rounded-lg bg-white/5 group-hover:bg-[#22ae84]/20 transition-colors">
                  <Phone :size="16" />
                </div>
                <span class="text-sm">+33 70 89 99 00 / +216 56 455 743</span>
              </a>
            </div>

            <!-- Social Media -->
            <div class="flex gap-3 mt-6">
              <a href="#" class="group p-3 rounded-xl bg-white/5 hover:bg-[#22ae84]/20 transition-all duration-300 hover:scale-110">
                <Facebook :size="18" class="text-gray-400 group-hover:text-[#22ae84] transition-colors" />
              </a>
              <a href="#" class="group p-3 rounded-xl bg-white/5 hover:bg-[#22ae84]/20 transition-all duration-300 hover:scale-110">
                <Twitter :size="18" class="text-gray-400 group-hover:text-[#22ae84] transition-colors" />
              </a>
              <a href="#" class="group p-3 rounded-xl bg-white/5 hover:bg-[#22ae84]/20 transition-all duration-300 hover:scale-110">
                <Linkedin :size="18" class="text-gray-400 group-hover:text-[#22ae84] transition-colors" />
              </a>
              <a href="#" class="group p-3 rounded-xl bg-white/5 hover:bg-[#22ae84]/20 transition-all duration-300 hover:scale-110">
                <Instagram :size="18" class="text-gray-400 group-hover:text-[#22ae84] transition-colors" />
              </a>
            </div>
          </div>

          <!-- Quick Links -->
          <div>
            <h3 class="text-lg font-bold mb-6 bg-gradient-to-r from-white to-[#22ae84] bg-clip-text text-transparent">
              Liens Rapides
            </h3>
            <ul class="space-y-3">
              <li>
                <Link href="/about" class="text-gray-400 hover:text-[#22ae84] transition-colors flex items-center gap-2 group">
                  <span class="w-1.5 h-1.5 rounded-full bg-gray-600 group-hover:bg-[#22ae84] transition-colors"></span>
                  À propos
                </Link>
              </li>
              <li>
                <Link href="/services" class="text-gray-400 hover:text-[#22ae84] transition-colors flex items-center gap-2 group">
                  <span class="w-1.5 h-1.5 rounded-full bg-gray-600 group-hover:bg-[#22ae84] transition-colors"></span>
                  Services
                </Link>
              </li>
              <li>
                <Link href="/portfolio" class="text-gray-400 hover:text-[#22ae84] transition-colors flex items-center gap-2 group">
                  <span class="w-1.5 h-1.5 rounded-full bg-gray-600 group-hover:bg-[#22ae84] transition-colors"></span>
                  Portfolio
                </Link>
              </li>
              <li>
                <Link href="/blog" class="text-gray-400 hover:text-[#22ae84] transition-colors flex items-center gap-2 group">
                  <span class="w-1.5 h-1.5 rounded-full bg-gray-600 group-hover:bg-[#22ae84] transition-colors"></span>
                  Blog
                </Link>
              </li>
              <li>
                <Link href="/contact" class="text-gray-400 hover:text-[#22ae84] transition-colors flex items-center gap-2 group">
                  <span class="w-1.5 h-1.5 rounded-full bg-gray-600 group-hover:bg-[#22ae84] transition-colors"></span>
                  Contact
                </Link>
              </li>
            </ul>
          </div>

          <!-- Services -->
          <div>
            <h3 class="text-lg font-bold mb-6 bg-gradient-to-r from-white to-[#22ae84] bg-clip-text text-transparent">
              Nos Services
            </h3>
            <ul class="space-y-3">
              <li>
                <Link href="/services#branding" class="text-gray-400 hover:text-[#22ae84] transition-colors flex items-center gap-2 group">
                  <span class="w-1.5 h-1.5 rounded-full bg-gray-600 group-hover:bg-[#22ae84] transition-colors"></span>
                  Branding & Design
                </Link>
              </li>
              <li>
                <Link href="/services#digital" class="text-gray-400 hover:text-[#22ae84] transition-colors flex items-center gap-2 group">
                  <span class="w-1.5 h-1.5 rounded-full bg-gray-600 group-hover:bg-[#22ae84] transition-colors"></span>
                  Digital & Web
                </Link>
              </li>
              <li>
                <Link href="/services#social" class="text-gray-400 hover:text-[#22ae84] transition-colors flex items-center gap-2 group">
                  <span class="w-1.5 h-1.5 rounded-full bg-gray-600 group-hover:bg-[#22ae84] transition-colors"></span>
                  Social Media
                </Link>
              </li>
              <li>
                <Link href="/services#audiovisuel" class="text-gray-400 hover:text-[#22ae84] transition-colors flex items-center gap-2 group">
                  <span class="w-1.5 h-1.5 rounded-full bg-gray-600 group-hover:bg-[#22ae84] transition-colors"></span>
                  Production Audiovisuel
                </Link>
              </li>
            </ul>
          </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
          <p class="text-gray-400 text-sm">
            © {{ new Date().getFullYear() }} KOTAVA Communication. Tous droits réservés.
          </p>
          <div class="flex gap-6">
            <Link href="/mentions-legales" class="text-gray-400 hover:text-[#22ae84] text-sm transition-colors">
              Mentions légales
            </Link>
            <Link href="/politique-confidentialite" class="text-gray-400 hover:text-[#22ae84] text-sm transition-colors">
              Confidentialité
            </Link>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>
