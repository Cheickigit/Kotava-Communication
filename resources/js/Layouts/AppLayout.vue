<script setup>
import { computed, ref } from 'vue';
import { Head, router, usePage } from '@inertiajs/vue3';
import Banner from '@/Components/Banner.vue';
import {
  ArrowLeft,
  FileText,
  Home,
  Image,
  LayoutDashboard,
  LogOut,
  Mail,
  Menu,
  Sparkles,
  User,
  X,
} from 'lucide-vue-next';

defineProps({
  title: String,
});

const sidebarOpen = ref(true);
const mobileSidebarOpen = ref(false);
const profileOpen = ref(false);

const page = usePage();

const user = computed(() => page.props.auth?.user);

const userInitials = computed(() => {
  const name = user.value?.name || 'Admin';

  return name
    .split(' ')
    .filter(Boolean)
    .slice(0, 2)
    .map((part) => part.charAt(0).toUpperCase())
    .join('');
});

const normalizePath = (url) => {
  try {
    return new URL(url, window.location.origin).pathname;
  } catch {
    return String(url || '').split('?')[0];
  }
};

const currentPath = computed(() => normalizePath(page.url));

const menuItems = [
  {
    label: 'Retour au site',
    description: 'Voir le site public',
    icon: Home,
    href: '/',
    external: true,
  },
  {
    label: 'Dashboard',
    description: 'Vue générale',
    icon: LayoutDashboard,
    href: '/dashboard',
  },
  {
    label: 'Portfolio',
    description: 'Réalisations & projets',
    icon: Image,
    href: '/dashboard/realisations',
  },
  {
    label: 'Actualités',
    description: 'Articles & publications',
    icon: FileText,
    href: '/dashboard/actualites',
  },
  {
    label: 'Contacts',
    description: 'Messages reçus',
    icon: Mail,
    href: '/dashboard/leads',
  },
];

const primaryMenuItems = computed(() => menuItems.filter((item) => !item.external));
const externalMenuItem = computed(() => menuItems.find((item) => item.external));

const isActive = (href) => {
  const path = normalizePath(href);

  if (path === '/dashboard') {
    return currentPath.value === '/dashboard';
  }

  return currentPath.value === path || currentPath.value.startsWith(`${path}/`);
};

const currentPageTitle = computed(() => {
  const current = primaryMenuItems.value.find((item) => isActive(item.href));
  return current?.label || 'Dashboard';
});

const currentPageDescription = computed(() => {
  const current = primaryMenuItems.value.find((item) => isActive(item.href));
  return current?.description || 'Gestion de la plateforme KOTAVA';
});

const closeMobileSidebar = () => {
  mobileSidebarOpen.value = false;
};

const logout = () => {
  router.post(route('logout'));
};
</script>

<template>
  <div>
    <Head :title="title" />
    <Banner />

    <div class="min-h-screen bg-[#F3F5F8] text-slate-950">
      <Transition
        enter-active-class="transition-opacity duration-300"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition-opacity duration-200"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <button
          v-if="mobileSidebarOpen"
          type="button"
          class="fixed inset-0 z-40 bg-slate-950/55 backdrop-blur-sm sm:hidden"
          aria-label="Fermer le menu"
          @click="closeMobileSidebar"
        ></button>
      </Transition>

      <aside
        :class="[
          'fixed left-0 top-0 z-50 h-full w-72 border-r border-white/10 bg-[#08111F] text-white shadow-[30px_0_90px_rgba(8,17,31,0.22)] transition-all duration-300',
          sidebarOpen ? 'sm:w-72' : 'sm:w-24',
          mobileSidebarOpen ? 'translate-x-0' : '-translate-x-full sm:translate-x-0'
        ]"
      >
        <div class="pointer-events-none absolute inset-0 bg-grid-dark opacity-20"></div>
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_15%_12%,rgba(249,115,22,0.18),transparent_26%),radial-gradient(circle_at_88%_80%,rgba(16,185,129,0.14),transparent_30%)]"></div>

        <div class="relative z-10 flex h-full flex-col">
          <div class="flex h-24 items-center justify-between border-b border-white/10 px-5">
            <a
              href="/dashboard"
              class="flex min-w-0 items-center gap-3"
              @click="closeMobileSidebar"
            >
              <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-[1.15rem] border border-white/10 bg-white/[0.08] p-2.5">
                <img src="/logo_horizontal.png" alt="KOTAVA" class="h-full w-full object-contain" />
              </span>

              <Transition
                enter-active-class="transition-all duration-300"
                enter-from-class="opacity-0 translate-x-2"
                enter-to-class="opacity-100 translate-x-0"
                leave-active-class="transition-all duration-200"
                leave-from-class="opacity-100 translate-x-0"
                leave-to-class="opacity-0 translate-x-2"
              >
                <div v-if="sidebarOpen" class="min-w-0">
                  <div class="truncate text-sm font-black uppercase tracking-[0.18em] text-white">
                    KOTAVA
                  </div>
                  <div class="mt-0.5 truncate text-[10px] font-bold uppercase tracking-[0.14em] text-white/[0.42]">
                    Administration
                  </div>
                </div>
              </Transition>
            </a>

            <button
              type="button"
              class="rounded-xl p-2 text-white/[0.55] transition hover:bg-white/[0.08] hover:text-white sm:hidden"
              @click="closeMobileSidebar"
            >
              <X :size="21" />
            </button>
          </div>

          <div class="px-4 pt-5">
            <a
              v-if="externalMenuItem"
              :href="externalMenuItem.href"
              class="group flex items-center gap-3 rounded-[1.15rem] border border-white/10 bg-white/[0.06] px-4 py-3 text-sm font-black text-white/[0.78] transition hover:bg-white/[0.10] hover:text-white"
              @click="closeMobileSidebar"
            >
              <ArrowLeft :size="19" class="text-brand-orange transition group-hover:-translate-x-1" />

              <span v-if="sidebarOpen" class="truncate">
                {{ externalMenuItem.label }}
              </span>
            </a>
          </div>

          <nav class="relative z-20 flex-1 space-y-1 overflow-y-auto px-4 py-5">
            <a
              v-for="item in primaryMenuItems"
              :key="item.href"
              :href="item.href"
              :class="[
                'group relative flex items-center gap-3 rounded-[1.15rem] px-4 py-3.5 transition',
                isActive(item.href)
                  ? 'bg-brand-orange text-white shadow-orange'
                  : 'text-white/[0.62] hover:bg-white/[0.075] hover:text-white'
              ]"
              @click="closeMobileSidebar"
            >
              <component
                :is="item.icon"
                :size="21"
                :class="[
                  'shrink-0 transition group-hover:scale-110',
                  isActive(item.href) ? 'text-white' : 'text-white/[0.62] group-hover:text-brand-orange'
                ]"
              />

              <Transition
                enter-active-class="transition-all duration-300"
                enter-from-class="opacity-0 translate-x-2"
                enter-to-class="opacity-100 translate-x-0"
                leave-active-class="transition-all duration-200"
                leave-from-class="opacity-100 translate-x-0"
                leave-to-class="opacity-0 translate-x-2"
              >
                <span v-if="sidebarOpen" class="min-w-0">
                  <span class="block truncate text-sm font-black">
                    {{ item.label }}
                  </span>

                  <span
                    :class="[
                      'mt-0.5 block truncate text-[10px] font-bold uppercase tracking-[0.12em]',
                      isActive(item.href) ? 'text-white/[0.72]' : 'text-white/[0.34]'
                    ]"
                  >
                    {{ item.description }}
                  </span>
                </span>
              </Transition>

              <span
                v-if="isActive(item.href)"
                class="absolute right-3 h-2 w-2 rounded-full bg-white"
              ></span>

              <div
                v-if="!sidebarOpen"
                class="pointer-events-none absolute left-full ml-3 min-w-max rounded-xl bg-slate-950 px-3 py-2 text-xs font-black text-white opacity-0 shadow-2xl transition group-hover:opacity-100"
              >
                {{ item.label }}
              </div>
            </a>
          </nav>

          <div class="relative z-20 border-t border-white/10 p-4">
            <button
              type="button"
              :class="[
                'flex w-full items-center gap-3 rounded-[1.15rem] border border-white/10 bg-white/[0.06] p-3 text-left transition hover:bg-white/[0.10]',
                !sidebarOpen && 'sm:justify-center'
              ]"
              @click="profileOpen = !profileOpen"
            >
              <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-[1rem] bg-brand-orange text-sm font-black text-white shadow-orange">
                {{ userInitials }}
              </span>

              <Transition
                enter-active-class="transition-all duration-300"
                enter-from-class="opacity-0 translate-x-2"
                enter-to-class="opacity-100 translate-x-0"
                leave-active-class="transition-all duration-200"
                leave-from-class="opacity-100 translate-x-0"
                leave-to-class="opacity-0 translate-x-2"
              >
                <span v-if="sidebarOpen" class="min-w-0 flex-1">
                  <span class="block truncate text-sm font-black text-white">
                    {{ user?.name || 'Administrateur' }}
                  </span>

                  <span class="mt-0.5 block truncate text-xs font-bold text-white/[0.42]">
                    {{ user?.email }}
                  </span>
                </span>
              </Transition>
            </button>

            <Transition
              enter-active-class="transition-all duration-200 ease-out"
              enter-from-class="opacity-0 -translate-y-2 scale-95"
              enter-to-class="opacity-100 translate-y-0 scale-100"
              leave-active-class="transition-all duration-150 ease-in"
              leave-from-class="opacity-100 translate-y-0 scale-100"
              leave-to-class="opacity-0 -translate-y-2 scale-95"
            >
              <div
                v-if="profileOpen && sidebarOpen"
                class="mt-3 overflow-hidden rounded-[1.15rem] border border-white/10 bg-white/[0.08] p-2 backdrop-blur"
              >
                <a
                  :href="route('profile.show')"
                  class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-bold text-white/[0.72] transition hover:bg-white/[0.08] hover:text-white"
                  @click="closeMobileSidebar"
                >
                  <User :size="18" />
                  Mon profil
                </a>

                <button
                  type="button"
                  class="flex w-full items-center gap-3 rounded-xl px-3 py-3 text-sm font-bold text-red-300 transition hover:bg-red-500/10 hover:text-red-200"
                  @click="logout"
                >
                  <LogOut :size="18" />
                  Déconnexion
                </button>
              </div>
            </Transition>
          </div>
        </div>
      </aside>

      <div
        :class="[
          'min-h-screen transition-all duration-300',
          sidebarOpen ? 'sm:pl-72' : 'sm:pl-24'
        ]"
      >
        <header class="sticky top-0 z-30 border-b border-slate-200/80 bg-white/85 backdrop-blur-xl">
          <div class="flex h-20 items-center justify-between gap-4 px-4 sm:px-6">
            <div class="flex min-w-0 items-center gap-3">
              <button
                type="button"
                class="hidden rounded-xl p-2.5 text-slate-600 transition hover:bg-slate-100 hover:text-slate-950 sm:inline-flex"
                @click="sidebarOpen = !sidebarOpen"
              >
                <Menu :size="22" />
              </button>

              <button
                type="button"
                class="rounded-xl p-2.5 text-slate-600 transition hover:bg-slate-100 hover:text-slate-950 sm:hidden"
                @click="mobileSidebarOpen = true"
              >
                <Menu :size="22" />
              </button>

              <div class="min-w-0">
                <div class="flex items-center gap-2">
                  <Sparkles :size="16" class="text-brand-orange" />
                  <p class="truncate text-[11px] font-black uppercase tracking-[0.18em] text-brand-orange">
                    KOTAVA Dashboard
                  </p>
                </div>

                <h1 class="mt-1 truncate text-xl font-black tracking-[-0.04em] text-slate-950 sm:text-2xl">
                  {{ currentPageTitle }}
                </h1>
              </div>
            </div>

            <div class="hidden text-right md:block">
              <p class="text-sm font-black text-slate-950">
                {{ user?.name || 'Administrateur' }}
              </p>

              <p class="mt-0.5 text-xs font-bold text-slate-500">
                {{ currentPageDescription }}
              </p>
            </div>

            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-orange text-sm font-black text-white shadow-orange md:hidden">
              {{ userInitials }}
            </div>
          </div>
        </header>

        <section v-if="$slots.header" class="border-b border-slate-200 bg-white">
          <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <slot name="header" />
          </div>
        </section>

        <main class="px-4 py-6 sm:px-6 lg:px-8">
          <div class="mx-auto max-w-7xl">
            <slot />
          </div>
        </main>
      </div>
    </div>
  </div>
</template>