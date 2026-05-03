<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import {
  ArrowLeft,
  CalendarDays,
  CheckCircle2,
  Edit3,
  Eye,
  FileText,
  Filter,
  Image as ImageIcon,
  Newspaper,
  Plus,
  Search,
  Star,
  Trash2,
  X,
} from 'lucide-vue-next';
import { computed, reactive } from 'vue';

defineOptions({ layout: AppLayout });

const props = defineProps({
  actualites: {
    type: Object,
    default: () => ({
      data: [],
      links: [],
      meta: {},
    }),
  },
  filters: {
    type: Object,
    default: () => ({}),
  },
  stats: {
    type: Object,
    default: () => ({}),
  },
  categories: {
    type: Object,
    default: () => ({}),
  },
  statuts: {
    type: Object,
    default: () => ({}),
  },
});

const form = reactive({
  search: props.filters?.search || '',
  statut: props.filters?.statut || 'tous',
  category: props.filters?.category || 'tous',
});

const actualitesList = computed(() => props.actualites?.data || []);
const paginationLinks = computed(() => props.actualites?.links || []);

const categoriesOptions = computed(() => ({
  tous: 'Toutes les catégories',
  ...(props.categories || {}),
}));

const statutsOptions = computed(() => ({
  tous: 'Tous les statuts',
  ...(props.statuts || {}),
}));

const statCards = computed(() => [
  {
    label: 'Total actualités',
    value: props.stats?.total || 0,
    icon: Newspaper,
  },
  {
    label: 'Publiées',
    value: props.stats?.publie || 0,
    icon: CheckCircle2,
  },
  {
    label: 'Brouillons',
    value: props.stats?.brouillon || 0,
    icon: FileText,
  },
  {
    label: 'En vedette',
    value: props.stats?.featured || 0,
    icon: Star,
  },
]);

const applyFilters = () => {
  router.get('/dashboard/actualites', {
    search: form.search || undefined,
    statut: form.statut !== 'tous' ? form.statut : undefined,
    category: form.category !== 'tous' ? form.category : undefined,
  }, {
    preserveScroll: true,
    preserveState: true,
    replace: true,
  });
};

const resetFilters = () => {
  form.search = '';
  form.statut = 'tous';
  form.category = 'tous';

  router.get('/dashboard/actualites', {}, {
    preserveScroll: true,
    replace: true,
  });
};

const publishActualite = (actualite) => {
  router.post(`/dashboard/actualites/${actualite.id}/publish`, {}, {
    preserveScroll: true,
  });
};

const featureActualite = (actualite) => {
  router.post(`/dashboard/actualites/${actualite.id}/feature`, {}, {
    preserveScroll: true,
  });
};

const deleteActualite = (actualite) => {
  if (!confirm(`Supprimer définitivement "${actualite.title || actualite.titre}" ?`)) {
    return;
  }

  router.delete(`/dashboard/actualites/${actualite.id}`, {
    preserveScroll: true,
  });
};

const statusLabel = (status) => {
  const value = status || 'brouillon';

  return props.statuts?.[value] || value;
};

const statusClass = (status) => {
  if (status === 'publié') {
    return 'bg-emerald-50 text-emerald-700 ring-emerald-200';
  }

  if (status === 'archivé') {
    return 'bg-slate-100 text-slate-500 ring-slate-200';
  }

  return 'bg-orange-50 text-orange-700 ring-orange-200';
};

const imageUrl = (actualite) => {
  return actualite?.image_url || actualite?.image || null;
};
</script>

<template>
  <Head title="Actualités - Dashboard KOTAVA" />

  <main class="min-h-screen bg-[#F3F5F8] px-4 py-8 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
      <section class="relative overflow-hidden rounded-[2rem] bg-[#07101d] p-6 text-white shadow-2xl sm:p-8">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_18%,rgba(249,115,22,0.28),transparent_28%),radial-gradient(circle_at_85%_18%,rgba(16,185,129,0.18),transparent_30%),linear-gradient(135deg,#07101d_0%,#10235f_52%,#06131f_100%)]"></div>
        <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.045)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.045)_1px,transparent_1px)] bg-[size:42px_42px] opacity-35"></div>

        <div class="relative z-10 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
          <div>
            <Link
              href="/dashboard"
              class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-xs font-black uppercase tracking-[0.14em] text-white/65 transition hover:bg-white/[0.12] hover:text-white"
            >
              <ArrowLeft :size="15" />
              Dashboard
            </Link>

            <h1 class="mt-5 text-4xl font-black tracking-[-0.06em] sm:text-5xl">
              Actualités
            </h1>

            <p class="mt-4 max-w-2xl text-base leading-7 text-white/60">
              Gérez les articles, communiqués, témoignages et publications visibles sur le site KOTAVA Communication.
            </p>
          </div>

          <Link
            href="/dashboard/actualites/create"
            class="inline-flex items-center justify-center gap-3 rounded-2xl bg-brand-orange px-5 py-3 text-sm font-black text-white shadow-[0_18px_50px_rgba(249,115,22,0.28)] transition hover:-translate-y-1"
          >
            <Plus :size="18" />
            Ajouter une actualité
          </Link>
        </div>
      </section>

      <section class="mt-8 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
        <div
          v-for="card in statCards"
          :key="card.label"
          class="rounded-[1.7rem] border border-slate-200 bg-white p-6 shadow-sm"
        >
          <div class="flex items-start justify-between gap-4">
            <div>
              <p class="text-sm font-bold text-slate-500">
                {{ card.label }}
              </p>

              <p class="mt-3 text-4xl font-black tracking-[-0.05em] text-slate-950">
                {{ card.value }}
              </p>
            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-orange/10 text-brand-orange">
              <component :is="card.icon" :size="22" />
            </div>
          </div>
        </div>
      </section>

      <section class="mt-8 rounded-[2rem] border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end">
          <div class="flex-1">
            <label class="text-xs font-black uppercase tracking-[0.14em] text-slate-500">
              Recherche
            </label>

            <div class="relative mt-2">
              <Search :size="18" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400" />

              <input
                v-model="form.search"
                type="text"
                placeholder="Rechercher par titre, contenu ou extrait..."
                class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm font-semibold text-slate-700 outline-none transition focus:border-brand-orange focus:bg-white focus:ring-4 focus:ring-brand-orange/10"
                @keyup.enter="applyFilters"
              />
            </div>
          </div>

          <div class="w-full lg:w-64">
            <label class="text-xs font-black uppercase tracking-[0.14em] text-slate-500">
              Statut
            </label>

            <select
              v-model="form.statut"
              class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold text-slate-700 outline-none transition focus:border-brand-orange focus:bg-white focus:ring-4 focus:ring-brand-orange/10"
            >
              <option
                v-for="(label, value) in statutsOptions"
                :key="value"
                :value="value"
              >
                {{ label }}
              </option>
            </select>
          </div>

          <div class="w-full lg:w-72">
            <label class="text-xs font-black uppercase tracking-[0.14em] text-slate-500">
              Catégorie
            </label>

            <select
              v-model="form.category"
              class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold text-slate-700 outline-none transition focus:border-brand-orange focus:bg-white focus:ring-4 focus:ring-brand-orange/10"
            >
              <option
                v-for="(label, value) in categoriesOptions"
                :key="value"
                :value="value"
              >
                {{ label }}
              </option>
            </select>
          </div>

          <div class="flex gap-3">
            <button
              type="button"
              class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-950 px-5 py-3 text-sm font-black text-white transition hover:-translate-y-1 hover:bg-brand-orange"
              @click="applyFilters"
            >
              <Filter :size="17" />
              Filtrer
            </button>

            <button
              type="button"
              class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-black text-slate-600 transition hover:bg-slate-100"
              @click="resetFilters"
            >
              <X :size="17" />
              Reset
            </button>
          </div>
        </div>
      </section>

      <section class="mt-8 rounded-[2rem] border border-slate-200 bg-white shadow-sm">
        <div class="flex flex-col gap-4 border-b border-slate-200 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
          <div>
            <h2 class="text-2xl font-black tracking-[-0.04em] text-slate-950">
              Liste des actualités
            </h2>

            <p class="mt-1 text-sm text-slate-500">
              {{ actualitesList.length }} élément(s) affiché(s) sur cette page.
            </p>
          </div>
        </div>

        <div v-if="actualitesList.length" class="divide-y divide-slate-100">
          <article
            v-for="actualite in actualitesList"
            :key="actualite.id"
            class="grid gap-5 p-5 transition hover:bg-slate-50 sm:p-6 lg:grid-cols-[110px_1fr_auto]"
          >
            <div class="h-24 w-full overflow-hidden rounded-2xl bg-slate-100 lg:h-24 lg:w-28">
              <img
                v-if="imageUrl(actualite)"
                :src="imageUrl(actualite)"
                :alt="actualite.title || actualite.titre"
                class="h-full w-full object-cover"
              />

              <div v-else class="flex h-full w-full items-center justify-center text-slate-400">
                <ImageIcon :size="28" />
              </div>
            </div>

            <div class="min-w-0">
              <div class="flex flex-wrap items-center gap-2">
                <span
                  :class="[
                    'inline-flex items-center rounded-xl px-3 py-1 text-xs font-black ring-1',
                    statusClass(actualite.statut || actualite.status)
                  ]"
                >
                  {{ statusLabel(actualite.statut || actualite.status) }}
                </span>

                <span class="inline-flex items-center rounded-xl bg-slate-100 px-3 py-1 text-xs font-black text-slate-500">
                  {{ actualite.category_label || actualite.category || 'Actualité' }}
                </span>

                <span
                  v-if="actualite.featured"
                  class="inline-flex items-center gap-1 rounded-xl bg-brand-orange/10 px-3 py-1 text-xs font-black text-brand-orange"
                >
                  <Star :size="13" />
                  Vedette
                </span>
              </div>

              <h3 class="mt-3 line-clamp-1 text-xl font-black tracking-[-0.04em] text-slate-950">
                {{ actualite.title || actualite.titre }}
              </h3>

              <p class="mt-2 line-clamp-2 max-w-3xl text-sm leading-6 text-slate-500">
                {{ actualite.extrait || actualite.description || actualite.content }}
              </p>

              <div class="mt-3 flex flex-wrap items-center gap-4 text-xs font-bold text-slate-400">
                <span class="inline-flex items-center gap-1">
                  <CalendarDays :size="14" />
                  {{ actualite.date_publication_display || actualite.created_at || 'Non publié' }}
                </span>

                <span v-if="actualite.user?.name">
                  Par {{ actualite.user.name }}
                </span>
              </div>
            </div>

            <div class="flex flex-wrap items-center gap-2 lg:justify-end">
              <a
                v-if="actualite.slug"
                :href="`/blog/${actualite.slug}`"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition hover:border-brand-orange hover:text-brand-orange"
                title="Voir côté public"
              >
                <Eye :size="17" />
              </a>

              <Link
                :href="`/dashboard/actualites/${actualite.id}/edit`"
                class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition hover:border-brand-orange hover:text-brand-orange"
                title="Modifier"
              >
                <Edit3 :size="17" />
              </Link>

              <button
                type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition hover:border-emerald-500 hover:text-emerald-600"
                title="Publier / dépublier"
                @click="publishActualite(actualite)"
              >
                <CheckCircle2 :size="17" />
              </button>

              <button
                type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition hover:border-brand-orange hover:text-brand-orange"
                title="Mettre en vedette"
                @click="featureActualite(actualite)"
              >
                <Star :size="17" />
              </button>

              <button
                type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-red-100 bg-red-50 text-red-500 transition hover:bg-red-600 hover:text-white"
                title="Supprimer"
                @click="deleteActualite(actualite)"
              >
                <Trash2 :size="17" />
              </button>
            </div>
          </article>
        </div>

        <div v-else class="p-12 text-center">
          <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
            <Newspaper :size="30" />
          </div>

          <h3 class="mt-6 text-2xl font-black text-slate-950">
            Aucune actualité trouvée
          </h3>

          <p class="mt-2 text-sm text-slate-500">
            Créez votre première actualité ou modifiez les filtres.
          </p>

          <Link
            href="/dashboard/actualites/create"
            class="mt-6 inline-flex items-center justify-center gap-2 rounded-2xl bg-brand-orange px-5 py-3 text-sm font-black text-white"
          >
            <Plus :size="17" />
            Ajouter une actualité
          </Link>
        </div>

        <div
          v-if="paginationLinks.length > 3"
          class="flex flex-wrap justify-center gap-2 border-t border-slate-200 p-5"
        >
          <component
            :is="link.url ? Link : 'span'"
            v-for="(link, index) in paginationLinks"
            :key="index"
            :href="link.url || undefined"
            :class="[
              'rounded-xl px-4 py-2 text-sm font-black transition',
              link.active
                ? 'bg-brand-orange text-white'
                : link.url
                  ? 'bg-white text-slate-700 ring-1 ring-slate-200 hover:bg-slate-950 hover:text-white'
                  : 'bg-slate-100 text-slate-400'
            ]"
            v-html="link.label"
          />
        </div>
      </section>
    </div>
  </main>
</template>

<style scoped>
.line-clamp-1,
.line-clamp-2 {
  display: -webkit-box;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.line-clamp-1 {
  -webkit-line-clamp: 1;
}

.line-clamp-2 {
  -webkit-line-clamp: 2;
}
</style>