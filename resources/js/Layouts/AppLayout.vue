<script setup>
import { ref, computed } from 'vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import Banner from '@/Components/Banner.vue';
import {
  LayoutDashboard, FileText, Image, Users, Calendar,
  MessageSquare, BarChart3, Settings, LogOut, Menu,
  Bell, Search, User, ChevronDown, Sparkles, Mail, Plus,
  X, Home
} from 'lucide-vue-next';

defineProps({
    title: String,
});

const sidebarOpen = ref(true);
const notificationsOpen = ref(false);
const profileOpen = ref(false);
const showingNavigationDropdown = ref(false);

const page = usePage();
const user = computed(() => page.props.auth?.user);

const menuItems = [
  {
    label: 'Retour au site',
    icon: Home,
    href: '/',
    external: true,
    roles: ['Super Admin', 'Administrateur', 'Community Manager', 'Designer']
  },
  {
    label: 'Dashboard',
    icon: LayoutDashboard,
    href: '/dashboard',
    badge: null,
    roles: ['Super Admin', 'Administrateur', 'Community Manager', 'Designer']
  },
  {
    label: 'Réalisations',
    icon: Image,
    href: '/dashboard/realisations',
    badge: null,
    roles: ['Super Admin', 'Administrateur', 'Designer']
  },
  {
    label: 'Actualités',
    icon: FileText,
    href: '/dashboard/actualites',
    badge: null,
    roles: ['Super Admin', 'Administrateur', 'Community Manager']
  },
  {
    label: 'Équipe',
    icon: Users,
    href: '/dashboard/equipe',
    badge: null,
    roles: ['Super Admin', 'Administrateur']
  },
  {
    label: 'Leads',
    icon: Mail,
    href: '/dashboard/leads',
    badge: null,
    roles: ['Super Admin', 'Administrateur', 'Community Manager']
  },
  {
    label: 'Analytics',
    icon: BarChart3,
    href: '/dashboard/analytics',
    badge: null,
    roles: ['Super Admin', 'Administrateur']
  },
  {
    label: 'Paramètres',
    icon: Settings,
    href: '/dashboard/settings',
    badge: null,
    roles: ['Super Admin', 'Administrateur']
  },
];

const notifications = [
  { id: 1, type: 'lead', message: 'Nouveau lead de Marie K.', time: '5 min' },
  { id: 2, type: 'comment', message: 'Commentaire sur "Branding 2024"', time: '1h' },
  { id: 3, type: 'system', message: 'Mise à jour système disponible', time: '2h' },
];

const toggleSidebar = () => {
  sidebarOpen.value = !sidebarOpen.value;
};

const isActive = (href) => {
  return page.url === href || page.url.startsWith(href + '/');
};

const logout = () => {
  router.post(route('logout'));
};
</script>

<template>
  <div>
    <Head :title="title" />
    <Banner />

    <div class="min-h-screen bg-gray-50">
      <!-- Sidebar -->
      <aside
        :class="[
          'fixed top-0 left-0 h-full bg-white border-r border-gray-200 transition-all duration-300 z-40 shadow-xl',
          sidebarOpen ? 'w-72' : 'w-20',
          showingNavigationDropdown ? 'translate-x-0' : '-translate-x-full sm:translate-x-0'
        ]"
      >
        <!-- Logo -->
        <div class="h-20 flex items-center px-6 border-b border-gray-200">
          <Link :href="route('dashboard')" class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-[#0e437d] to-[#22ae84] rounded-xl flex items-center justify-center shadow-lg">
              <Sparkles :size="20" class="text-white" />
            </div>
            <Transition
              enter-active-class="transition-all duration-300"
              enter-from-class="opacity-0 w-0"
              enter-to-class="opacity-100 w-auto"
              leave-active-class="transition-all duration-200"
              leave-from-class="opacity-100 w-auto"
              leave-to-class="opacity-0 w-0"
            >
              <div v-if="sidebarOpen" class="overflow-hidden">
                <div class="text-lg font-bold text-gray-900">KOTAVA</div>
                <div class="text-xs text-gray-600">Dashboard</div>
              </div>
            </Transition>
          </Link>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto max-h-[calc(100vh-160px)]">
          <component
            :is="item.external ? 'a' : Link"
            v-for="item in menuItems"
            :key="item.href"
            :href="item.href"
            :class="[
              'flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300 group relative',
              isActive(item.href) && !item.external
                ? 'bg-gradient-to-r from-[#0e437d] to-[#22ae84] text-white shadow-lg'
                : 'text-gray-700 hover:bg-gray-50 hover:text-[#22ae84]'
            ]"
          >
            <component
              :is="item.icon"
              :size="22"
              :class="[
                'flex-shrink-0 transition-transform group-hover:scale-110',
                isActive(item.href) && !item.external ? 'text-white' : ''
              ]"
            />

            <Transition
              enter-active-class="transition-all duration-300"
              enter-from-class="opacity-0 w-0"
              enter-to-class="opacity-100 w-auto"
              leave-active-class="transition-all duration-200"
              leave-from-class="opacity-100 w-auto"
              leave-to-class="opacity-0 w-0"
            >
              <span v-if="sidebarOpen" class="font-medium overflow-hidden whitespace-nowrap">
                {{ item.label }}
              </span>
            </Transition>

            <!-- Badge -->
            <span
              v-if="item.badge && sidebarOpen"
              :class="[
                'ml-auto px-2 py-1 text-xs font-bold rounded-full',
                isActive(item.href)
                  ? 'bg-white/20 text-white'
                  : 'bg-[#22ae84] text-white'
              ]"
            >
              {{ item.badge }}
            </span>

            <!-- Tooltip pour sidebar fermée -->
            <div
              v-if="!sidebarOpen"
              class="absolute left-full ml-2 px-3 py-2 bg-gray-900 text-white text-sm rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 whitespace-nowrap z-50"
            >
              {{ item.label }}
            </div>
          </component>
        </nav>

        <!-- User Profile (Bottom) -->
        <div class="border-t border-gray-200 p-4">
          <div
            @click="profileOpen = !profileOpen"
            :class="[
              'flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-gray-100 transition-all cursor-pointer',
              !sidebarOpen && 'justify-center'
            ]"
          >
            <div class="w-10 h-10 bg-gradient-to-br from-[#0e437d] to-[#22ae84] rounded-xl flex items-center justify-center flex-shrink-0">
              <User :size="20" class="text-white" />
            </div>

            <Transition
              enter-active-class="transition-all duration-300"
              enter-from-class="opacity-0 w-0"
              enter-to-class="opacity-100 w-auto"
              leave-active-class="transition-all duration-200"
              leave-from-class="opacity-100 w-auto"
              leave-to-class="opacity-0 w-0"
            >
              <div v-if="sidebarOpen" class="flex-1 overflow-hidden">
                <div class="font-medium text-gray-900 text-sm truncate">
                  {{ user?.name }}
                </div>
                <div class="text-xs text-gray-600 truncate">
                  {{ user?.email }}
                </div>
              </div>
            </Transition>
          </div>

          <!-- Profile Dropdown (appears when clicked) -->
          <Transition
            enter-active-class="transition-all duration-200 ease-out"
            enter-from-class="opacity-0 scale-95 -translate-y-2"
            enter-to-class="opacity-100 scale-100 translate-y-0"
            leave-active-class="transition-all duration-150 ease-in"
            leave-from-class="opacity-100 scale-100 translate-y-0"
            leave-to-class="opacity-0 scale-95 -translate-y-2"
          >
            <div
              v-if="profileOpen && sidebarOpen"
              class="mt-2 bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden"
            >
              <div class="p-2">
                <Link :href="route('profile.show')" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-50 transition-all text-gray-700">
                  <User :size="18" class="text-gray-600" />
                  <span>Mon Profil</span>
                </Link>
              </div>
              <div class="p-2 border-t border-gray-200">
                <button @click="logout" class="flex items-center gap-3 w-full px-4 py-3 rounded-lg hover:bg-red-50 text-red-600 transition-all">
                  <LogOut :size="18" />
                  <span>Déconnexion</span>
                </button>
              </div>
            </div>
          </Transition>
        </div>
      </aside>

      <!-- Main Content Area -->
      <div
        :class="[
          'transition-all duration-300',
          sidebarOpen ? 'sm:ml-72' : 'sm:ml-20'
        ]"
      >
        <!-- Top Bar -->
        <header class="sticky top-0 z-30 h-20 bg-white border-b border-gray-200 shadow-sm">
          <div class="h-full px-6 flex items-center justify-between">
            <!-- Left: Menu Toggle + Search -->
            <div class="flex items-center gap-4">
              <button
                @click="toggleSidebar"
                class="hidden sm:block p-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-all"
              >
                <Menu :size="22" />
              </button>

              <!-- Mobile menu button -->
              <button
                @click="showingNavigationDropdown = !showingNavigationDropdown"
                class="sm:hidden p-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-all"
              >
                <Menu v-if="!showingNavigationDropdown" :size="22" />
                <X v-else :size="22" />
              </button>

              <div class="relative hidden md:block">
                <Search :size="20" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" />
                <input
                  type="text"
                  placeholder="Rechercher..."
                  class="pl-10 pr-4 py-2 w-80 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#22ae84] focus:border-transparent transition-all"
                />
              </div>
            </div>

            <!-- Right: Actions -->
            <div class="flex items-center gap-3">
              <!-- Quick Add -->
              <button class="p-2.5 rounded-xl bg-gradient-to-r from-[#0e437d] to-[#22ae84] text-white hover:shadow-lg hover:scale-105 transition-all">
                <Plus :size="20" />
              </button>

              <!-- Notifications -->
              <div class="relative">
                <button
                  @click="notificationsOpen = !notificationsOpen"
                  class="relative p-2.5 rounded-xl text-gray-700 hover:bg-gray-100 transition-all"
                >
                  <Bell :size="20" />
                  <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                <!-- Notifications Dropdown -->
                <Transition
                  enter-active-class="transition-all duration-200 ease-out"
                  enter-from-class="opacity-0 scale-95 translate-y-2"
                  enter-to-class="opacity-100 scale-100 translate-y-0"
                  leave-active-class="transition-all duration-150 ease-in"
                  leave-from-class="opacity-100 scale-100 translate-y-0"
                  leave-to-class="opacity-0 scale-95 translate-y-2"
                >
                  <div
                    v-if="notificationsOpen"
                    class="absolute right-0 mt-2 w-80 bg-white rounded-2xl shadow-2xl border border-gray-200 overflow-hidden"
                  >
                    <div class="p-4 border-b border-gray-200">
                      <h3 class="font-semibold text-gray-900">Notifications</h3>
                    </div>
                    <div class="max-h-96 overflow-y-auto">
                      <div
                        v-for="notif in notifications"
                        :key="notif.id"
                        class="p-4 hover:bg-gray-50 transition-colors cursor-pointer border-b border-gray-100 last:border-0"
                      >
                        <p class="text-sm text-gray-900 mb-1">{{ notif.message }}</p>
                        <p class="text-xs text-gray-600">Il y a {{ notif.time }}</p>
                      </div>
                    </div>
                  </div>
                </Transition>
              </div>

              <!-- Profile Desktop -->
              <div class="hidden sm:block">
                <div class="w-9 h-9 bg-gradient-to-br from-[#0e437d] to-[#22ae84] rounded-lg flex items-center justify-center cursor-pointer">
                  <User :size="18" class="text-white" />
                </div>
              </div>
            </div>
          </div>
        </header>

        <!-- Page Heading -->
        <header v-if="$slots.header" class="bg-white shadow">
          <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <slot name="header" />
          </div>
        </header>

        <!-- Page Content -->
        <main class="p-6">
          <slot />
        </main>
      </div>

      <!-- Mobile Overlay -->
      <Transition
        enter-active-class="transition-opacity duration-300"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition-opacity duration-200"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <div
          v-if="showingNavigationDropdown"
          @click="showingNavigationDropdown = false"
          class="fixed inset-0 bg-black/50 z-30 sm:hidden"
        ></div>
      </Transition>
    </div>
  </div>
</template>
