<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import {
  Menu, X, ChevronDown, Target, Palette, Globe,
  Video, Calendar, MessageSquare, Mail, Phone,
  ArrowRight, Sparkles
} from 'lucide-vue-next';

const mobileMenuOpen = ref(false);
const scrolled = ref(false);
const servicesOpen = ref(false);

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
  scrolled.value = window.scrollY > 50;
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
          ? 'backdrop-blur-xl bg-white/90 shadow-lg border-b border-gray-200'
          : 'backdrop-blur-lg bg-white/90 border-b border-gray-200 shadow-sm'
      ]"
    >
      <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-20">
          <!-- Logo -->
          <Link href="/" class="flex items-center gap-3 group">
            <div class="relative">
              <div class="absolute inset-0 bg-gradient-to-br from-[#0e437d] to-[#22ae84] rounded-xl blur-md opacity-50 group-hover:opacity-75 transition-opacity"></div>
              <div class="relative w-12 h-12 bg-gradient-to-br from-[#0e437d] to-[#22ae84] rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                <Sparkles :size="24" class="text-white" />
              </div>
            </div>
            <div class="hidden sm:block">
              <div class="text-xl font-bold text-gray-900">KOTAVA</div>
              <div class="text-xs text-gray-600">Communication</div>
            </div>
          </Link>

          <!-- Desktop Menu -->
          <div class="hidden lg:flex items-center gap-1">
            <Link
              href="/"
              class="px-4 py-2 rounded-lg font-medium text-gray-700 hover:text-[#22ae84] hover:bg-gray-50 transition-all duration-300"
            >
              Accueil
            </Link>

            <div class="relative group">
              <button class="flex items-center gap-1 px-4 py-2 rounded-lg font-medium text-gray-700 hover:text-[#22ae84] hover:bg-gray-50 transition-all duration-300">
                Services
                <ChevronDown :size="16" class="group-hover:rotate-180 transition-transform duration-300" />
              </button>
              <div class="absolute top-full left-0 mt-2 w-64 bg-white rounded-xl shadow-2xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                <Link href="/services#strategie" class="block px-6 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#22ae84] transition-colors">
                  Stratégie & Conseil
                </Link>
                <Link href="/services#branding" class="block px-6 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#22ae84] transition-colors">
                  Branding & Design
                </Link>
                <Link href="/services#digital" class="block px-6 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#22ae84] transition-colors">
                  Digital & Web
                </Link>
                <Link href="/services#audiovisuel" class="block px-6 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#22ae84] transition-colors">
                  Production Audiovisuel
                </Link>
                <Link href="/services#evenementiel" class="block px-6 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#22ae84] transition-colors">
                  Événementiel & RP
                </Link>
                <Link href="/services#social" class="block px-6 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#22ae84] transition-colors rounded-b-xl">
                  Social Media
                </Link>
              </div>
            </div>

            <Link
              href="/portfolio"
              class="px-4 py-2 rounded-lg font-medium text-gray-700 hover:text-[#22ae84] hover:bg-gray-50 transition-all duration-300"
            >
              Portfolio
            </Link>

            <Link
              href="/blog"
              class="px-4 py-2 rounded-lg font-medium text-gray-700 hover:text-[#22ae84] hover:bg-gray-50 transition-all duration-300"
            >
              Blog
            </Link>

            <Link
              href="/about"
              class="px-4 py-2 rounded-lg font-medium text-gray-700 hover:text-[#22ae84] hover:bg-gray-50 transition-all duration-300"
            >
              À propos
            </Link>

            <!-- CTA Buttons -->
            <div class="flex items-center gap-2 ml-4">
              <a
                href="tel:+33708999900"
                class="p-2.5 rounded-lg text-gray-700 hover:bg-gray-100 transition-all duration-300"
                title="Appelez-nous"
              >
                <Phone :size="20" />
              </a>

              <Link
                href="/contact"
                class="group relative bg-gradient-to-r from-[#0e437d] to-[#22ae84] text-white px-6 py-2.5 rounded-xl font-semibold shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 overflow-hidden"
              >
                <span class="relative z-10 flex items-center gap-2">
                  Contact
                  <Mail :size="18" />
                </span>
                <div class="absolute inset-0 bg-gradient-to-r from-[#22ae84] to-[#0e437d] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              </Link>
            </div>
          </div>

          <!-- Mobile Menu Button -->
          <button
            @click="mobileMenuOpen = !mobileMenuOpen"
            class="lg:hidden p-2.5 rounded-lg text-gray-700 hover:bg-gray-100 transition-all duration-300"
          >
            <Menu v-if="!mobileMenuOpen" :size="24" />
            <X v-else :size="24" />
          </button>
        </div>
      </div>

      <!-- Mobile Menu -->
      <Transition
        enter-active-class="transition-all duration-300 ease-out"
        enter-from-class="opacity-0 max-h-0"
        enter-to-class="opacity-100 max-h-screen"
        leave-active-class="transition-all duration-300 ease-in"
        leave-from-class="opacity-100 max-h-screen"
        leave-to-class="opacity-0 max-h-0"
      >
        <div v-if="mobileMenuOpen" class="lg:hidden bg-white border-t border-gray-200 shadow-lg overflow-hidden">
          <div class="px-6 py-4 space-y-2 max-h-[calc(100vh-5rem)] overflow-y-auto">
            <Link href="/" class="block text-gray-700 hover:text-[#22ae84] font-medium py-3 px-4 rounded-lg hover:bg-gray-50 transition-all">
              Accueil
            </Link>

            <!-- Mobile Services Accordion -->
            <div>
              <button
                @click="servicesOpen = !servicesOpen"
                class="flex items-center justify-between w-full text-gray-700 hover:text-[#22ae84] font-medium py-3 px-4 rounded-lg hover:bg-gray-50 transition-all"
              >
                Services
                <ChevronDown :size="16" :class="{ 'rotate-180': servicesOpen }" class="transition-transform duration-300" />
              </button>

              <Transition
                enter-active-class="transition-all duration-300 ease-out"
                enter-from-class="opacity-0 max-h-0"
                enter-to-class="opacity-100 max-h-96"
                leave-active-class="transition-all duration-200 ease-in"
                leave-from-class="opacity-100 max-h-96"
                leave-to-class="opacity-0 max-h-0"
              >
                <div v-if="servicesOpen" class="pl-4 space-y-2 mt-2 overflow-hidden">
                  <Link
                    v-for="service in services"
                    :key="service.title"
                    :href="service.href"
                    class="flex items-center gap-3 text-gray-600 hover:text-[#22ae84] py-2 px-3 rounded-lg hover:bg-gray-50 transition-all"
                  >
                    <component :is="service.icon" :size="18" />
                    {{ service.title }}
                  </Link>
                </div>
              </Transition>
            </div>

            <Link href="/portfolio" class="block text-gray-700 hover:text-[#22ae84] font-medium py-3 px-4 rounded-lg hover:bg-gray-50 transition-all">
              Portfolio
            </Link>

            <Link href="/blog" class="block text-gray-700 hover:text-[#22ae84] font-medium py-3 px-4 rounded-lg hover:bg-gray-50 transition-all">
              Blog
            </Link>

            <Link href="/about" class="block text-gray-700 hover:text-[#22ae84] font-medium py-3 px-4 rounded-lg hover:bg-gray-50 transition-all">
              À propos
            </Link>

            <div class="pt-4 space-y-2">
              <a
                href="tel:+33708999900"
                class="flex items-center justify-center gap-2 bg-gray-100 text-gray-900 px-6 py-3 rounded-xl font-semibold hover:bg-gray-200 transition-all"
              >
                <Phone :size="18" />
                +33 70 89 99 00
              </a>

              <Link
                href="/contact"
                class="flex items-center justify-center gap-2 bg-gradient-to-r from-[#0e437d] to-[#22ae84] text-white px-6 py-3 rounded-xl font-semibold shadow-lg"
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

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
      <div class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid md:grid-cols-4 gap-12 mb-12">
          <!-- Company Info -->
          <div class="col-span-2">
            <div class="flex items-center gap-3 mb-6">
              <div class="w-12 h-12 bg-gradient-to-br from-[#0e437d] to-[#22ae84] rounded-xl flex items-center justify-center">
                <Sparkles :size="24" class="text-white" />
              </div>
              <div>
                <div class="text-xl font-bold">KOTAVA</div>
                <div class="text-sm text-gray-400">Communication</div>
              </div>
            </div>
            <p class="text-gray-400 mb-6">
              Redéfinir la communication comme une expérience sensorielle et émotionnelle.
              Votre partenaire de confiance pour la transformation digitale.
            </p>
            <div class="space-y-2">
              <p class="text-gray-400 flex items-center gap-2">
                <Mail :size="16" />
                direction@kotavacommunication.com
              </p>
              <p class="text-gray-400 flex items-center gap-2">
                <Phone :size="16" />
                +33 70 89 99 00 / +216 56 455 743
              </p>
            </div>
          </div>

          <!-- Quick Links -->
          <div>
            <h3 class="text-lg font-bold mb-4">Liens Rapides</h3>
            <ul class="space-y-2">
              <li><Link href="/about" class="text-gray-400 hover:text-[#22ae84] transition-colors">À propos</Link></li>
              <li><Link href="/services" class="text-gray-400 hover:text-[#22ae84] transition-colors">Services</Link></li>
              <li><Link href="/portfolio" class="text-gray-400 hover:text-[#22ae84] transition-colors">Portfolio</Link></li>
              <li><Link href="/blog" class="text-gray-400 hover:text-[#22ae84] transition-colors">Blog</Link></li>
              <li><Link href="/contact" class="text-gray-400 hover:text-[#22ae84] transition-colors">Contact</Link></li>
            </ul>
          </div>

          <!-- Services -->
          <div>
            <h3 class="text-lg font-bold mb-4">Services</h3>
            <ul class="space-y-2">
              <li><Link href="/services#branding" class="text-gray-400 hover:text-[#22ae84] transition-colors">Branding</Link></li>
              <li><Link href="/services#digital" class="text-gray-400 hover:text-[#22ae84] transition-colors">Digital & Web</Link></li>
              <li><Link href="/services#social" class="text-gray-400 hover:text-[#22ae84] transition-colors">Social Media</Link></li>
              <li><Link href="/services#audiovisuel" class="text-gray-400 hover:text-[#22ae84] transition-colors">Audiovisuel</Link></li>
            </ul>
          </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
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
