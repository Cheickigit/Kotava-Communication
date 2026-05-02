<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import {
  ArrowRight,
  ArrowUp,
  CalendarDays,
  ChevronDown,
  Globe2,
  Mail,
  MapPin,
  Menu,
  MessageCircle,
  Palette,
  Phone,
  Sparkles,
  Target,
  Video,
  X,
} from 'lucide-vue-next';

const page = usePage();

const mobileMenuOpen = ref(false);
const servicesOpen = ref(false);
const scrolled = ref(false);
const showScrollTop = ref(false);

const currentUrl = computed(() => page.url || '/');

const contactEmail = 'Contact@kotavacom.com';
const contactPhoneDisplay = '+229 93 37 49 63';
const contactPhoneHref = 'tel:+22993374963';

const services = [
  {
    title: 'Stratégie & Conseil',
    desc: 'Audit, positionnement et plan de communication',
    href: '/services/strategie-conseil',
    icon: Target,
  },
  {
    title: 'Branding & Design',
    desc: 'Logo, identité visuelle et charte graphique',
    href: '/services/branding-design',
    icon: Palette,
  },
  {
    title: 'Digital & Web',
    desc: 'Sites web, plateformes et expériences digitales',
    href: '/services/digital-web',
    icon: Globe2,
  },
  {
    title: 'Production Audiovisuel',
    desc: 'Photo, vidéo, motion design et contenus premium',
    href: '/services/audiovisuel',
    icon: Video,
  },
  {
    title: 'Événementiel & RP',
    desc: 'Relations publiques, événements et influence',
    href: '/services/evenementiel',
    icon: CalendarDays,
  },
  {
    title: 'Social Media',
    desc: 'Community management et campagnes ciblées',
    href: '/services/social-media',
    icon: MessageCircle,
  },
];

const links = [
  { label: 'Accueil', href: '/' },
  { label: 'Services', href: '/services', children: services },
  { label: 'Portfolio', href: '/portfolio' },
  { label: 'Blog', href: '/blog' },
  { label: 'Équipe', href: '/team' },
  { label: 'À propos', href: '/about' },
];

const footerLinks = [
  { label: 'Accueil', href: '/' },
  { label: 'Services', href: '/services' },
  { label: 'Portfolio', href: '/portfolio' },
  { label: 'Blog', href: '/blog' },
  { label: 'Équipe', href: '/team' },
  { label: 'À propos', href: '/about' },
];

const footerTags = ['Stratégie', 'Branding', 'Digital', 'Influence'];

const isActive = (href, children = []) => {
  if (href === '/') return currentUrl.value === '/';

  return currentUrl.value === href
    || currentUrl.value.startsWith(`${href}/`)
    || children.some((child) => currentUrl.value === child.href || currentUrl.value.startsWith(`${child.href}/`));
};

const closeMenus = () => {
  mobileMenuOpen.value = false;
  servicesOpen.value = false;
};

const handleScroll = () => {
  scrolled.value = window.scrollY > 10;
  showScrollTop.value = window.scrollY > 500;
};

const handleClickOutside = (event) => {
  const target = event.target;

  if (!(target instanceof Element)) {
    return;
  }

  if (!target.closest('[data-services-dropdown]')) {
    servicesOpen.value = false;
  }
};

const handleEscape = (event) => {
  if (event.key === 'Escape') {
    closeMenus();
  }
};

const scrollToTop = () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
};

onMounted(() => {
  handleScroll();
  window.addEventListener('scroll', handleScroll);
  window.addEventListener('click', handleClickOutside);
  window.addEventListener('keydown', handleEscape);
});

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll);
  window.removeEventListener('click', handleClickOutside);
  window.removeEventListener('keydown', handleEscape);
});
</script>

<template>
  <Head>
    <meta name="theme-color" content="#1E3A8A" />
    <meta name="application-name" content="KOTAVA Communication" />
    <meta property="og:site_name" content="KOTAVA Communication" />
    <meta name="twitter:card" content="summary_large_image" />
  </Head>

  <div class="min-h-screen bg-white text-brand-ink">
    <header class="fixed inset-x-0 top-0 z-50 px-[clamp(0.5rem,2vw,2rem)] pt-3">
      <div
        :class="[
          'relative z-20 mx-auto w-full max-w-[96rem] transition-all duration-300',
          scrolled
            ? 'rounded-2xl border border-slate-200/80 bg-white/[0.96] shadow-soft backdrop-blur-xl'
            : 'rounded-2xl border border-white/70 bg-white/[0.88] shadow-sm backdrop-blur-xl'
        ]"
      >
        <div class="flex h-16 items-center justify-between gap-3 px-3 sm:px-4 lg:px-5">
          <Link href="/" class="flex shrink-0 items-center" @click="closeMenus">
            <img
              src="/logo.png"
              alt="KOTAVA Communication"
              class="h-9 w-auto object-contain sm:h-10 lg:h-11"
            />
          </Link>

          <nav class="hidden xl:flex xl:items-center xl:gap-1">
            <div
              v-for="item in links"
              :key="item.label"
              class="relative"
              data-services-dropdown
            >
              <button
                v-if="item.children"
                type="button"
                @click.stop="servicesOpen = !servicesOpen"
                :class="[
                  'inline-flex items-center gap-1.5 rounded-xl px-4 py-2 text-sm font-extrabold transition-all duration-200',
                  isActive(item.href, item.children)
                    ? 'bg-brand-light text-brand-blue'
                    : 'text-slate-700 hover:bg-slate-100 hover:text-brand-blue'
                ]"
                :aria-expanded="servicesOpen"
              >
                {{ item.label }}
                <ChevronDown
                  :size="15"
                  :class="[
                    'transition-transform duration-200',
                    servicesOpen ? 'rotate-180' : ''
                  ]"
                />
              </button>

              <Link
                v-else
                :href="item.href"
                :class="[
                  'inline-flex rounded-xl px-4 py-2 text-sm font-extrabold transition-all duration-200',
                  isActive(item.href)
                    ? 'bg-brand-light text-brand-blue'
                    : 'text-slate-700 hover:bg-slate-100 hover:text-brand-blue'
                ]"
              >
                {{ item.label }}
              </Link>

              <Transition
                enter-active-class="transition duration-200 ease-out"
                enter-from-class="opacity-0 translate-y-2 scale-[0.98]"
                enter-to-class="opacity-100 translate-y-0 scale-100"
                leave-active-class="transition duration-150 ease-in"
                leave-from-class="opacity-100 translate-y-0 scale-100"
                leave-to-class="opacity-0 translate-y-2 scale-[0.98]"
              >
                <div
                  v-if="item.children && servicesOpen"
                  class="absolute left-1/2 top-full z-50 mt-4 w-[min(94vw,820px)] -translate-x-1/2 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-soft"
                >
                  <div class="grid lg:grid-cols-[0.75fr_1.25fr]">
                    <div class="relative overflow-hidden bg-brand-dark p-5 text-white">
                      <div class="absolute -right-16 -top-16 h-44 w-44 rounded-2xl bg-brand-blue/35 blur-3xl"></div>
                      <div class="absolute -bottom-20 left-6 h-44 w-44 rounded-2xl bg-brand-emerald/20 blur-3xl"></div>

                      <div class="relative">
                        <div class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-3 py-2 text-xs font-black uppercase tracking-[0.18em] text-brand-emerald">
                          <img src="/logo_horizontal.png" alt="" class="h-5 w-5 object-contain" />
                          Studio KOTAVA
                        </div>

                        <h3 class="mt-5 text-2xl font-black leading-tight">
                          Penser, créer et faire évoluer votre marque.
                        </h3>

                        <p class="mt-3 text-sm leading-6 text-white/65">
                          Une approche intégrée pour connecter stratégie, image, contenu et visibilité.
                        </p>

                        <Link
                          href="/services"
                          class="mt-5 inline-flex items-center gap-2 rounded-xl bg-brand-orange px-4 py-2.5 text-xs font-black text-white shadow-orange transition hover:-translate-y-0.5"
                          @click="closeMenus"
                        >
                          Tous les services
                          <ArrowRight :size="15" />
                        </Link>
                      </div>
                    </div>

                    <div class="grid gap-px bg-slate-200 sm:grid-cols-2">
                      <Link
                        v-for="service in services"
                        :key="service.href"
                        :href="service.href"
                        class="group bg-white p-4 transition hover:bg-brand-light"
                        @click="closeMenus"
                      >
                        <div class="flex items-start gap-3">
                          <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-brand-blue text-white shadow-brand transition group-hover:bg-brand-emerald">
                            <component :is="service.icon" :size="18" />
                          </div>

                          <div class="min-w-0">
                            <h4 class="text-sm font-black text-brand-ink transition group-hover:text-brand-blue">
                              {{ service.title }}
                            </h4>

                            <p class="mt-1 line-clamp-2 text-xs leading-5 text-brand-gray">
                              {{ service.desc }}
                            </p>
                          </div>
                        </div>
                      </Link>
                    </div>
                  </div>
                </div>
              </Transition>
            </div>
          </nav>

          <div class="hidden items-center gap-2 xl:flex">
            <a
              :href="`mailto:${contactEmail}`"
              class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-brand-blue transition hover:border-brand-emerald/40 hover:bg-brand-light"
              aria-label="Email"
            >
              <Mail :size="17" />
            </a>

            <a
              :href="contactPhoneHref"
              class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-brand-blue transition hover:border-brand-emerald/40 hover:bg-brand-light"
              aria-label="Téléphone"
            >
              <Phone :size="17" />
            </a>

            <Link href="/contact" class="btn-primary h-10 px-5 text-sm">
              Demander un devis
              <ArrowRight :size="16" />
            </Link>
          </div>

          <button
            type="button"
            class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-brand-ink xl:hidden"
            @click="mobileMenuOpen = !mobileMenuOpen"
            aria-label="Ouvrir le menu"
            :aria-expanded="mobileMenuOpen"
          >
            <X v-if="mobileMenuOpen" :size="20" />
            <Menu v-else :size="20" />
          </button>
        </div>
      </div>

      <Transition
        enter-active-class="transition duration-200 ease-out"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition duration-150 ease-in"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <div
          v-if="mobileMenuOpen"
          class="fixed inset-0 z-0 bg-brand-dark/25 backdrop-blur-sm xl:hidden"
          @click="closeMenus"
        ></div>
      </Transition>

      <Transition
        enter-active-class="transition duration-200 ease-out"
        enter-from-class="opacity-0 -translate-y-3 scale-[0.98]"
        enter-to-class="opacity-100 translate-y-0 scale-100"
        leave-active-class="transition duration-150 ease-in"
        leave-from-class="opacity-100 translate-y-0 scale-100"
        leave-to-class="opacity-0 -translate-y-3 scale-[0.98]"
      >
        <div
          v-if="mobileMenuOpen"
          class="relative z-10 mx-auto mt-2 w-full max-w-[96rem] overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-soft xl:hidden"
        >
          <div class="max-h-[calc(100vh-6.5rem)] overflow-y-auto p-3 sm:p-4">
            <div class="flex items-center justify-between rounded-2xl bg-brand-light p-3">
              <div class="flex items-center gap-3">
                <img src="/logo_horizontal.png" alt="" class="h-9 w-9 object-contain" />
                <div>
                  <div class="text-sm font-black text-brand-blue">Menu KOTAVA</div>
                  <div class="text-xs font-semibold text-brand-gray">Navigation & expertises</div>
                </div>
              </div>

              <button
                type="button"
                class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-white text-brand-ink ring-1 ring-slate-200"
                @click="closeMenus"
                aria-label="Fermer le menu"
              >
                <X :size="18" />
              </button>
            </div>

            <div class="mt-3 grid gap-2 sm:grid-cols-2">
              <Link
                v-for="item in links.filter((link) => !link.children)"
                :key="item.href"
                :href="item.href"
                :class="[
                  'group flex items-center justify-between rounded-xl border px-4 py-3 text-sm font-black transition',
                  isActive(item.href)
                    ? 'border-brand-blue bg-brand-blue text-white'
                    : 'border-slate-200 bg-white text-brand-ink hover:border-brand-emerald/40 hover:bg-brand-light hover:text-brand-blue'
                ]"
                @click="closeMenus"
              >
                {{ item.label }}
                <ArrowRight :size="15" class="transition group-hover:translate-x-0.5" />
              </Link>
            </div>

            <div class="mt-3 rounded-2xl border border-slate-200 bg-white p-3">
              <div class="flex items-start justify-between gap-4 px-1 pb-3">
                <div>
                  <div class="text-xs font-black uppercase tracking-[0.18em] text-brand-blue">
                    Services
                  </div>
                  <p class="mt-1 max-w-lg text-xs leading-5 text-brand-gray">
                    Des expertises complémentaires pour construire une marque claire, visible et cohérente.
                  </p>
                </div>

                <Sparkles :size="18" class="mt-1 shrink-0 text-brand-orange" />
              </div>

              <div class="grid gap-2 sm:grid-cols-2">
                <Link
                  v-for="service in services"
                  :key="service.href"
                  :href="service.href"
                  class="group rounded-xl bg-slate-50 p-3 transition hover:bg-brand-light"
                  @click="closeMenus"
                >
                  <div class="flex items-start gap-3">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-brand-blue text-white transition group-hover:bg-brand-emerald">
                      <component :is="service.icon" :size="17" />
                    </div>

                    <div>
                      <h4 class="text-sm font-black text-brand-ink group-hover:text-brand-blue">
                        {{ service.title }}
                      </h4>
                      <p class="mt-1 text-xs leading-5 text-brand-gray">
                        {{ service.desc }}
                      </p>
                    </div>
                  </div>
                </Link>
              </div>

              <Link
                href="/services"
                class="mt-3 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-brand-dark px-4 py-3 text-sm font-black text-white"
                @click="closeMenus"
              >
                Voir toutes les expertises
                <ArrowRight :size="16" />
              </Link>
            </div>

            <div class="mt-3 grid gap-2 sm:grid-cols-3">
              <a :href="`mailto:${contactEmail}`" class="btn-secondary w-full" @click="closeMenus">
                <Mail :size="16" />
                Email
              </a>

              <a :href="contactPhoneHref" class="btn-secondary w-full" @click="closeMenus">
                <Phone :size="16" />
                Appeler
              </a>

              <Link href="/contact" class="btn-primary w-full" @click="closeMenus">
                Devis
                <ArrowRight :size="16" />
              </Link>
            </div>
          </div>
        </div>
      </Transition>
    </header>

    <main class="relative">
      <slot />
    </main>

    <footer class="mt-20 bg-white px-3 pb-6 sm:px-4 lg:px-6">
      <div class="site-container">
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-gradient-to-br from-slate-50 via-white to-brand-light shadow-soft">
          <div class="grid gap-8 p-6 sm:p-8 lg:grid-cols-12 lg:p-10">
            <div class="lg:col-span-5">
              <Link href="/" class="inline-flex items-center">
                <img
                  src="/logo.png"
                  alt="KOTAVA Communication"
                  class="h-10 w-auto object-contain sm:h-12"
                />
              </Link>

              <p class="mt-5 max-w-md text-sm leading-7 text-brand-gray">
                KOTAVA Communication accompagne les marques, entreprises et institutions
                dans leur stratégie, leur image et leur déploiement digital avec une approche
                créative, moderne et cohérente.
              </p>

              <div class="mt-5 flex flex-wrap gap-2">
                <span
                  v-for="tag in footerTags"
                  :key="tag"
                  class="inline-flex items-center gap-2 rounded-xl bg-white px-3 py-2 text-xs font-black text-brand-blue ring-1 ring-slate-200"
                >
                  <img src="/logo_horizontal.png" alt="" class="h-4 w-4 object-contain" />
                  {{ tag }}
                </span>
              </div>
            </div>

            <div class="lg:col-span-3">
              <h3 class="text-sm font-black uppercase tracking-[0.18em] text-brand-blue">
                Navigation
              </h3>

              <div class="mt-5 grid grid-cols-2 gap-3 sm:max-w-sm lg:grid-cols-1">
                <Link
                  v-for="item in footerLinks"
                  :key="item.href"
                  :href="item.href"
                  class="text-sm font-semibold text-brand-gray transition hover:text-brand-blue"
                >
                  {{ item.label }}
                </Link>
              </div>
            </div>

            <div class="lg:col-span-4">
              <h3 class="text-sm font-black uppercase tracking-[0.18em] text-brand-blue">
                Contact
              </h3>

              <div class="mt-5 space-y-4">
                <a :href="`mailto:${contactEmail}`" class="group flex items-start gap-3">
                  <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-brand-blue ring-1 ring-slate-200 transition group-hover:text-brand-emerald">
                    <Mail :size="17" />
                  </span>
                  <span>
                    <span class="block text-xs font-black uppercase tracking-[0.14em] text-brand-gray">
                      Email
                    </span>
                    <span class="mt-1 block break-all text-sm font-semibold text-brand-ink transition group-hover:text-brand-blue">
                      {{ contactEmail }}
                    </span>
                  </span>
                </a>

                <a :href="contactPhoneHref" class="group flex items-start gap-3">
                  <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-brand-blue ring-1 ring-slate-200 transition group-hover:text-brand-emerald">
                    <Phone :size="17" />
                  </span>
                  <span>
                    <span class="block text-xs font-black uppercase tracking-[0.14em] text-brand-gray">
                      Téléphone
                    </span>
                    <span class="mt-1 block text-sm font-semibold text-brand-ink transition group-hover:text-brand-blue">
                      {{ contactPhoneDisplay }}
                    </span>
                  </span>
                </a>

                <div class="flex items-start gap-3">
                  <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-brand-blue ring-1 ring-slate-200">
                    <MapPin :size="17" />
                  </span>
                  <span>
                    <span class="block text-xs font-black uppercase tracking-[0.14em] text-brand-gray">
                      Localisation
                    </span>
                    <span class="mt-1 block text-sm font-semibold text-brand-ink">
                      Cotonou, Bénin
                    </span>
                  </span>
                </div>
              </div>

              <Link href="/contact" class="btn-primary mt-6 w-full justify-center sm:w-auto">
                Démarrer un projet
                <ArrowRight :size="16" />
              </Link>
            </div>
          </div>

          <div class="border-t border-slate-200 bg-white/80 px-6 py-5 sm:px-8 lg:px-10">
            <div class="flex flex-col gap-3 text-xs font-semibold text-brand-gray sm:flex-row sm:items-center sm:justify-between">
              <p>© {{ new Date().getFullYear() }} KOTAVA Communication. Tous droits réservés.</p>

              <div class="flex flex-wrap gap-4">
                <Link href="/mentions-legales" class="transition hover:text-brand-blue">
                  Mentions légales
                </Link>
                <Link href="/politique-confidentialite" class="transition hover:text-brand-blue">
                  Confidentialité
                </Link>
                <Link href="/login" class="transition hover:text-brand-blue">
                  Administration
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <Transition
      enter-active-class="transition duration-300 ease-out"
      enter-from-class="opacity-0 translate-y-4 scale-90"
      enter-to-class="opacity-100 translate-y-0 scale-100"
      leave-active-class="transition duration-200 ease-in"
      leave-from-class="opacity-100 translate-y-0 scale-100"
      leave-to-class="opacity-0 translate-y-4 scale-90"
    >
      <button
        v-if="showScrollTop"
        type="button"
        class="fixed bottom-5 right-5 z-40 inline-flex h-11 w-11 items-center justify-center rounded-xl bg-brand-orange text-white shadow-orange transition hover:-translate-y-1"
        @click="scrollToTop"
        aria-label="Retour en haut"
      >
        <ArrowUp :size="18" />
      </button>
    </Transition>
  </div>
</template>
