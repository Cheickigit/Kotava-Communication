<script setup>
import { computed, ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import {
  CheckCircle2,
  Edit3,
  Eye,
  FileImage,
  Filter,
  Image,
  Plus,
  Search,
  Star,
  Trash2,
} from 'lucide-vue-next';

defineOptions({ layout: AppLayout });

const props = defineProps({
  realisations: {
    type: [Array, Object],
    default: () => [],
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
  statuses: {
    type: Object,
    default: () => ({}),
  },
});

const filterForm = ref({
  search: props.filters.search || '',
  status: props.filters.status || 'tous',
  category: props.filters.category || 'tous',
  published: props.filters.published || 'tous',
});

const items = computed(() => props.realisations?.data || props.realisations || []);
const links = computed(() => props.realisations?.links || []);

const categoryOptions = computed(() => Object.entries(props.categories || {}));
const statusOptions = computed(() => Object.entries(props.statuses || {}));

const imageUrl = (path) => {
  if (!path) return null;
  if (path.startsWith('http')) return path;
  return `/storage/${path}`;
};

const getStatus = (realisation) => {
  return realisation.statut || realisation.status || 'brouillon';
};

const statusLabel = (status) => {
  return props.statuses?.[status] || status;
};

const statusClass = (status) => {
  const classes = {
    publié: 'bg-emerald-50 text-emerald-700 border-emerald-200',
    en_cours: 'bg-blue-50 text-blue-700 border-blue-200',
    brouillon: 'bg-slate-50 text-slate-700 border-slate-200',
    termine: 'bg-emerald-50 text-emerald-700 border-emerald-200',
    en_attente: 'bg-orange-50 text-orange-700 border-orange-200',
    annule: 'bg-red-50 text-red-700 border-red-200',
    archive: 'bg-slate-100 text-slate-500 border-slate-200',
  };

  return classes[status] || 'bg-slate-50 text-slate-700 border-slate-200';
};

const applyFilters = () => {
  router.get(route('dashboard.realisations.index'), filterForm.value, {
    preserveState: true,
    preserveScroll: true,
  });
};

const resetFilters = () => {
  filterForm.value = {
    search: '',
    status: 'tous',
    category: 'tous',
    published: 'tous',
  };

  router.get(route('dashboard.realisations.index'), {}, {
    preserveState: true,
    preserveScroll: true,
  });
};

const destroyRealisation = (realisation) => {
  if (!confirm(`Supprimer définitivement la réalisation "${realisation.title}" ?`)) {
    return;
  }

  router.delete(route('dashboard.realisations.destroy', realisation.id), {
    preserveScroll: true,
  });
};

const togglePublish = (realisation) => {
  router.post(route('dashboard.realisations.publish', realisation.id), {}, {
    preserveScroll: true,
  });
};

const toggleFeature = (realisation) => {
  router.post(route('dashboard.realisations.feature', realisation.id), {}, {
    preserveScroll: true,
  });
};
</script>

<template>
  <Head title="Gestion du portfolio" />

  <div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col gap-4 rounded-[1.8rem] bg-white p-6 shadow-sm ring-1 ring-slate-200/70 lg:flex-row lg:items-center lg:justify-between">
      <div>
        <div class="inline-flex items-center gap-2 rounded-xl bg-brand-orange/10 px-3 py-2 text-[11px] font-black uppercase tracking-[0.18em] text-brand-orange">
          <Image :size="15" />
          Portfolio
        </div>

        <h1 class="mt-4 text-3xl font-black tracking-[-0.05em] text-slate-950 sm:text-4xl">
          Gestion des réalisations
        </h1>

        <p class="mt-2 max-w-2xl text-sm leading-7 text-slate-500">
          Ajoutez, modifiez, publiez et mettez en avant les projets visibles dans le portfolio public.
        </p>
      </div>

      <Link
        :href="route('dashboard.realisations.create')"
        class="inline-flex items-center justify-center gap-2 rounded-[1rem] bg-brand-orange px-5 py-3 text-sm font-black text-white shadow-orange transition hover:-translate-y-0.5 hover:bg-brand-orange/90"
      >
        <Plus :size="18" />
        Nouvelle réalisation
      </Link>
    </div>

    <!-- Stats -->
    <div class="grid gap-4 md:grid-cols-4">
      <div class="rounded-[1.4rem] bg-white p-5 shadow-sm ring-1 ring-slate-200/70">
        <Image :size="23" class="text-brand-orange" />
        <div class="mt-5 text-3xl font-black tracking-[-0.06em] text-slate-950">
          {{ stats.total || 0 }}
        </div>
        <div class="text-xs font-bold uppercase tracking-[0.14em] text-slate-400">
          Total
        </div>
      </div>

      <div class="rounded-[1.4rem] bg-white p-5 shadow-sm ring-1 ring-slate-200/70">
        <Eye :size="23" class="text-emerald-600" />
        <div class="mt-5 text-3xl font-black tracking-[-0.06em] text-slate-950">
          {{ stats.published || 0 }}
        </div>
        <div class="text-xs font-bold uppercase tracking-[0.14em] text-slate-400">
          Publiées
        </div>
      </div>

      <div class="rounded-[1.4rem] bg-white p-5 shadow-sm ring-1 ring-slate-200/70">
        <Star :size="23" class="text-brand-orange" />
        <div class="mt-5 text-3xl font-black tracking-[-0.06em] text-slate-950">
          {{ stats.featured || 0 }}
        </div>
        <div class="text-xs font-bold uppercase tracking-[0.14em] text-slate-400">
          En avant
        </div>
      </div>

      <div class="rounded-[1.4rem] bg-white p-5 shadow-sm ring-1 ring-slate-200/70">
        <CheckCircle2 :size="23" class="text-blue-600" />
        <div class="mt-5 text-3xl font-black tracking-[-0.06em] text-slate-950">
          {{ stats.en_cours || 0 }}
        </div>
        <div class="text-xs font-bold uppercase tracking-[0.14em] text-slate-400">
          En cours
        </div>
      </div>
    </div>

    <!-- Filters -->
    <form
      class="rounded-[1.6rem] bg-white p-5 shadow-sm ring-1 ring-slate-200/70"
      @submit.prevent="applyFilters"
    >
      <div class="mb-4 flex items-center gap-2 text-sm font-black text-slate-950">
        <Filter :size="18" class="text-brand-orange" />
        Filtres
      </div>

      <div class="grid gap-3 lg:grid-cols-[1.4fr_0.9fr_0.9fr_0.9fr_auto]">
        <div class="relative">
          <Search :size="18" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400" />
          <input
            v-model="filterForm.search"
            type="text"
            placeholder="Rechercher par titre, client ou description..."
            class="w-full rounded-[1rem] border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm font-bold text-slate-800 focus:border-brand-orange focus:ring-brand-orange"
          />
        </div>

        <select
          v-model="filterForm.status"
          class="rounded-[1rem] border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold text-slate-800 focus:border-brand-orange focus:ring-brand-orange"
        >
          <option value="tous">Tous les statuts</option>
          <option
            v-for="[value, label] in statusOptions"
            :key="value"
            :value="value"
          >
            {{ label }}
          </option>
        </select>

        <select
          v-model="filterForm.category"
          class="rounded-[1rem] border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold text-slate-800 focus:border-brand-orange focus:ring-brand-orange"
        >
          <option value="tous">Toutes les catégories</option>
          <option
            v-for="[value, label] in categoryOptions"
            :key="value"
            :value="value"
          >
            {{ label }}
          </option>
        </select>

        <select
          v-model="filterForm.published"
          class="rounded-[1rem] border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold text-slate-800 focus:border-brand-orange focus:ring-brand-orange"
        >
          <option value="tous">Publication</option>
          <option value="oui">Publié</option>
          <option value="non">Non publié</option>
        </select>

        <div class="flex gap-2">
          <button
            type="submit"
            class="rounded-[1rem] bg-slate-950 px-5 py-3 text-sm font-black text-white transition hover:bg-brand-orange"
          >
            Filtrer
          </button>

          <button
            type="button"
            class="rounded-[1rem] border border-slate-200 bg-white px-5 py-3 text-sm font-black text-slate-600 transition hover:bg-slate-50"
            @click="resetFilters"
          >
            Reset
          </button>
        </div>
      </div>
    </form>

    <!-- List -->
    <div class="overflow-hidden rounded-[1.8rem] bg-white shadow-sm ring-1 ring-slate-200/70">
      <div v-if="items.length" class="divide-y divide-slate-100">
        <div
          v-for="realisation in items"
          :key="realisation.id"
          class="grid gap-5 p-5 transition hover:bg-slate-50 lg:grid-cols-[0.9fr_1.5fr_0.9fr_auto] lg:items-center"
        >
          <div class="h-32 overflow-hidden rounded-[1.2rem] bg-slate-100">
            <img
              v-if="imageUrl(realisation.image || realisation.cover_image)"
              :src="imageUrl(realisation.image || realisation.cover_image)"
              :alt="realisation.title"
              class="h-full w-full object-cover"
            />

            <div v-else class="flex h-full w-full items-center justify-center text-slate-300">
              <FileImage :size="34" />
            </div>
          </div>

          <div>
            <div class="flex flex-wrap items-center gap-2">
              <span
                :class="[
                  'rounded-full border px-3 py-1 text-[11px] font-black uppercase tracking-[0.12em]',
                  statusClass(getStatus(realisation))
                ]"
              >
                {{ statusLabel(getStatus(realisation)) }}
              </span>

              <span
                v-if="realisation.published"
                class="rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-[11px] font-black uppercase tracking-[0.12em] text-emerald-700"
              >
                Visible
              </span>

              <span
                v-if="realisation.featured"
                class="rounded-full border border-orange-200 bg-orange-50 px-3 py-1 text-[11px] font-black uppercase tracking-[0.12em] text-orange-700"
              >
                Vedette
              </span>
            </div>

            <h2 class="mt-3 text-xl font-black tracking-[-0.04em] text-slate-950">
              {{ realisation.title }}
            </h2>

            <p class="mt-1 text-sm font-bold text-slate-500">
              {{ realisation.client || 'Client non renseigné' }}
            </p>

            <p class="mt-2 line-clamp-2 max-w-2xl text-sm leading-6 text-slate-500">
              {{ realisation.description }}
            </p>
          </div>

          <div class="text-sm">
            <div class="font-black text-slate-950">
              {{ categories?.[realisation.category] || realisation.category || 'Non classé' }}
            </div>
            <div class="mt-1 text-slate-500">
              {{ realisation.service_type || 'Service non spécifié' }}
            </div>
          </div>

          <div class="flex flex-wrap gap-2 lg:justify-end">
            <button
              type="button"
              class="rounded-xl border border-slate-200 bg-white p-3 text-slate-600 transition hover:bg-emerald-50 hover:text-emerald-700"
              title="Publier / dépublier"
              @click="togglePublish(realisation)"
            >
              <Eye :size="18" />
            </button>

            <button
              type="button"
              class="rounded-xl border border-slate-200 bg-white p-3 text-slate-600 transition hover:bg-orange-50 hover:text-orange-700"
              title="Mettre en avant"
              @click="toggleFeature(realisation)"
            >
              <Star :size="18" />
            </button>

            <Link
              :href="route('dashboard.realisations.edit', realisation.id)"
              class="rounded-xl border border-slate-200 bg-white p-3 text-slate-600 transition hover:bg-blue-50 hover:text-blue-700"
              title="Modifier"
            >
              <Edit3 :size="18" />
            </Link>

            <button
              type="button"
              class="rounded-xl border border-slate-200 bg-white p-3 text-slate-600 transition hover:bg-red-50 hover:text-red-700"
              title="Supprimer"
              @click="destroyRealisation(realisation)"
            >
              <Trash2 :size="18" />
            </button>
          </div>
        </div>
      </div>

      <div v-else class="p-12 text-center">
        <FileImage :size="48" class="mx-auto text-slate-300" />
        <h2 class="mt-4 text-xl font-black text-slate-950">
          Aucune réalisation trouvée
        </h2>
        <p class="mt-2 text-sm text-slate-500">
          Ajoutez votre premier projet pour alimenter le portfolio.
        </p>
      </div>
    </div>

    <!-- Pagination -->
    <div v-if="links.length > 3" class="flex flex-wrap justify-center gap-2">
      <Link
        v-for="link in links"
        :key="link.label"
        :href="link.url || '#'"
        :class="[
          'rounded-xl border px-4 py-2 text-sm font-black transition',
          link.active
            ? 'border-brand-orange bg-brand-orange text-white'
            : 'border-slate-200 bg-white text-slate-600 hover:bg-slate-50',
          !link.url ? 'pointer-events-none opacity-40' : ''
        ]"
        v-html="link.label"
      />
    </div>
  </div>
</template>