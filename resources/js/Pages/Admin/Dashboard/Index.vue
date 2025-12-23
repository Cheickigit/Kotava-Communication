<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import {
  Users, Shield, Briefcase, UserCheck, TrendingUp,
  Eye, Calendar, Mail, ArrowUp, ArrowDown
} from 'lucide-vue-next';

defineProps({
    stats: Object,
    recentUsers: Array,
    permissions: Array,
});
</script>

<template>
    <AppLayout title="Dashboard Admin">
        <Head title="Dashboard Admin - Kotava Communication" />

        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    Tableau de bord
                </h2>
                <div class="text-sm text-gray-600">
                    <Calendar :size="16" class="inline mr-1" />
                    {{ new Date().toLocaleDateString('fr-FR', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }) }}
                </div>
            </div>
        </template>

        <div class="space-y-6">
            <!-- Message de bienvenue avec design premium -->
            <div class="relative overflow-hidden bg-gradient-to-br from-[#0e437d] via-[#1c978a] to-[#22ae84] rounded-2xl shadow-xl">
                <!-- Animated blobs -->
                <div class="absolute inset-0 overflow-hidden opacity-20">
                    <div class="absolute -top-1/2 -left-1/2 w-full h-full bg-gradient-to-br from-white/30 to-transparent rounded-full blur-3xl animate-pulse"></div>
                    <div class="absolute -bottom-1/2 -right-1/2 w-full h-full bg-gradient-to-tl from-white/30 to-transparent rounded-full blur-3xl animate-pulse delay-1000"></div>
                </div>

                <div class="relative p-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-3xl font-bold text-white mb-2">
                                Bienvenue, {{ $page.props.auth.user.name }} ! 👋
                            </h3>
                            <p class="text-white/90 text-lg">
                                Vous êtes connecté en tant que
                                <span class="font-semibold bg-white/20 px-3 py-1 rounded-full ml-1">
                                    {{ stats.userRole }}
                                </span>
                            </p>
                        </div>
                        <div class="hidden md:block">
                            <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                                <Shield :size="40" class="text-white" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistiques Cards Premium -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Utilisateurs -->
                <div class="group relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>

                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                <Users :size="28" class="text-white" />
                            </div>
                            <div class="flex items-center gap-1 text-green-600 text-sm font-semibold">
                                <ArrowUp :size="16" />
                                +12%
                            </div>
                        </div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Total Utilisateurs</p>
                        <p class="text-4xl font-bold text-gray-900">{{ stats.totalUsers }}</p>
                    </div>
                </div>

                <!-- Admins -->
                <div class="group relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>

                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                <Shield :size="28" class="text-white" />
                            </div>
                            <div class="flex items-center gap-1 text-green-600 text-sm font-semibold">
                                <ArrowUp :size="16" />
                                +5%
                            </div>
                        </div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Administrateurs</p>
                        <p class="text-4xl font-bold text-gray-900">{{ stats.adminCount }}</p>
                    </div>
                </div>

                <!-- Managers -->
                <div class="group relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>

                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-[#22ae84] to-[#1c978a] rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                <Briefcase :size="28" class="text-white" />
                            </div>
                            <div class="flex items-center gap-1 text-green-600 text-sm font-semibold">
                                <ArrowUp :size="16" />
                                +8%
                            </div>
                        </div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Managers</p>
                        <p class="text-4xl font-bold text-gray-900">{{ stats.managerCount }}</p>
                    </div>
                </div>

                <!-- Employés -->
                <div class="group relative bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-500/5 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>

                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                <UserCheck :size="28" class="text-white" />
                            </div>
                            <div class="flex items-center gap-1 text-red-600 text-sm font-semibold">
                                <ArrowDown :size="16" />
                                -2%
                            </div>
                        </div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Employés</p>
                        <p class="text-4xl font-bold text-gray-900">{{ stats.employeeCount }}</p>
                    </div>
                </div>
            </div>

            <!-- Quick Stats Row -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Taux d'activité</p>
                            <p class="text-3xl font-bold text-gray-900">87%</p>
                        </div>
                        <div class="w-16 h-16 bg-gradient-to-br from-[#0e437d] to-[#22ae84] rounded-xl flex items-center justify-center">
                            <TrendingUp :size="32" class="text-white" />
                        </div>
                    </div>
                    <div class="mt-4 h-2 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-[#0e437d] to-[#22ae84] w-[87%]"></div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Nouveaux ce mois</p>
                            <p class="text-3xl font-bold text-gray-900">{{ recentUsers.length }}</p>
                        </div>
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                            <Users :size="32" class="text-white" />
                        </div>
                    </div>
                    <p class="mt-4 text-sm text-green-600 font-semibold">
                        <ArrowUp :size="14" class="inline" /> +15% vs mois dernier
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Messages non lus</p>
                            <p class="text-3xl font-bold text-gray-900">24</p>
                        </div>
                        <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center">
                            <Mail :size="32" class="text-white" />
                        </div>
                    </div>
                    <p class="mt-4 text-sm text-orange-600 font-semibold">
                        Dernière réception : il y a 5min
                    </p>
                </div>
            </div>

            <!-- Derniers utilisateurs avec design moderne -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-900">Derniers utilisateurs inscrits</h3>
                        <span class="text-sm text-gray-600 bg-gray-100 px-3 py-1 rounded-full">
                            {{ recentUsers.length }} nouveaux
                        </span>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Utilisateur
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Email
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Rôle
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Date d'inscription
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            <tr v-for="user in recentUsers" :key="user.id" class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-br from-[#0e437d] to-[#22ae84] rounded-lg flex items-center justify-center flex-shrink-0">
                                            <span class="text-white font-semibold text-sm">
                                                {{ user.name.charAt(0).toUpperCase() }}
                                            </span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900">{{ user.name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-600">{{ user.email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800">
                                        {{ user.role }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ user.created_at }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Mes permissions avec design moderne -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-900">Mes permissions</h3>
                        <span class="text-sm text-gray-600 bg-gray-100 px-3 py-1 rounded-full">
                            {{ permissions.length }} permissions
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <div class="flex flex-wrap gap-3">
                        <span
                            v-for="permission in permissions"
                            :key="permission"
                            class="group px-4 py-2 bg-gradient-to-r from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 text-blue-800 text-sm font-medium rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-md cursor-default"
                        >
                            <Shield :size="14" class="inline mr-1" />
                            {{ permission }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
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
