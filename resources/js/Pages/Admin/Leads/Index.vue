<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import {
  Archive,
  ArrowLeft,
  CheckCircle2,
  Filter,
  Inbox,
  Mail,
  MessageSquare,
  Phone,
  Search,
  Trash2,
  UserRound,
  X,
} from 'lucide-vue-next';
import { computed, reactive } from 'vue';

defineOptions({ layout: AppLayout });

const props = defineProps({
  leads: {
    type: Object,
    default: () => ({
      data: [],
      links: [],
    }),
  },
  filters: {
    type: Object,
    default: () => ({}),
  },
  statuts: {
    type: Object,
    default: () => ({
      tous: 'Tous',
      nouveau: 'Nouveau',
      en_cours: 'En cours',
      traité: 'Traité',
      archive: 'Archivé',
    }),
  },
  stats: {
    type: Object,
    default: () => ({
      total: 0,
      nouveau: 0,
      non_lus: 0,
      traites: 0,
      archives: 0,
    }),
  },
});

const form = reactive({
  search: props.filters?.search || '',
  statut: props.filters?.statut || 'tous',
});

const leadsList = computed(() => props.leads?.data || []);
const paginationLinks = computed(() => props.leads?.links || []);

const statCards = computed(() => [
  {
    label: 'Messages',
    value: props.stats?.total || 0,
    icon: Inbox,
  },
  {
    label: 'Nouveaux',
    value: props.stats?.nouveau || 0,
    icon: MessageSquare,
  },
  {
    label: 'Non lus',
    value: props.stats?.non_lus || 0,
    icon: Mail,
  },
  {
    label: 'Traités',
    value: props.stats?.traites || 0,
    icon: CheckCircle2,
  },
]);

const statutsOptions = computed(() => ({
  tous: 'Tous les statuts',
  ...(props.statuts || {}),
}));

const applyFilters = () => {
  router.get('/dashboard/leads', {
    search: form.search || undefined,
    statut: form.statut !== 'tous' ? form.statut : undefined,
  }, {
    preserveState: true,
    preserveScroll: true,
    replace: true,
  });
};

const resetFilters = () => {
  form.search = '';
  form.statut = 'tous';

  router.get('/dashboard/leads', {}, {
    preserveScroll: true,
    replace: true,
  });
};

const markAsRead = (lead) => {
  router.post(`/dashboard/leads/${lead.id}/read`, {}, {
    preserveScroll: true,
  });
};

const archiveLead = (lead) => {
  router.post(`/dashboard/leads/${lead.id}/archive`, {}, {
    preserveScroll: true,
  });
};

const deleteLead = (lead) => {
  if (!confirm(`Supprimer définitivement le message de "${lead.name || lead.nom}" ?`)) {
    return;
  }

  router.delete(`/dashboard/leads/${lead.id}`, {
    preserveScroll: true,
  });
};

const statusLabel = (status) => {
  return props.statuts?.[status] || status || 'Nouveau';
};

const statusClass = (status) => {
  if (status === 'nouveau') {
    return 'bg-orange-50 text-orange-700 ring-orange-200';
  }

  if (status === 'en_cours') {
    return 'bg-blue-50 text-blue-700 ring-blue-200';
  }

  if (status === 'traité' || status === 'traite') {
    return 'bg-emerald-50 text-emerald-700 ring-emerald-200';
  }

  if (status === 'archive') {
    return 'bg-slate-100 text-slate-500 ring-slate-200';
  }

  return 'bg-slate-100 text-slate-600 ring-slate-200';
};

const leadName = (lead) => lead.name || lead.nom || 'Contact sans nom';
const leadPhone = (lead) => lead.phone || lead.telephone || null;
const leadSubject = (lead) => lead.subject || lead.service || 'Demande de contact';
const leadStatus = (lead) => lead.statut || lead.status || 'nouveau';
</script>

<template>
  <Head title="Contacts - Dashboard KOTAVA" />

  <main class="min-h-screen bg-[#F3F5F8] px-4 py-8 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
      <!-- HEADER -->
      <section class="relative overflow-hidden rounded-[2rem] bg-[#07101d] p-6 text-white shadow-2xl sm:p-8">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_18%,rgba(249,115,22,0.28),transparent_28%),radial-gradient(circle_at_85%_18%,rgba(16,185,129,0.18),transparent_30%),linear-gradient(135deg,#07101d_0%,#10235f_52%,#06131f_100%)]"></div>
        <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.045)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.045)_1px,transparent_1px)] bg-[size:42px_42px] opacity-35"></div>

        <div class="relative z-10">
          <Link
            href="/dashboard"
            class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-xs font-black uppercase tracking-[0.14em] text-white/[0.65] transition hover:bg-white/[0.12] hover:text-white"
          >
            <ArrowLeft :size="15" />
            Dashboard
          </Link>

          <h1 class="mt-5 text-4xl font-black tracking-[-0.06em] sm:text-5xl">
            Contacts & leads
          </h1>

          <p class="mt-4 max-w-2xl text-base leading-7 text-white/[0.60]">
            Suivez les demandes reçues depuis le formulaire de contact public du site KOTAVA Communication.
          </p>
        </div>
      </section>

      <!-- STATS -->
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

      <!-- FILTERS -->
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
                placeholder="Nom, email, téléphone, entreprise, service ou message..."
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

      <!-- LIST -->
      <section class="mt-8 rounded-[2rem] border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 p-5 sm:p-6">
          <h2 class="text-2xl font-black tracking-[-0.04em] text-slate-950">
            Messages reçus
          </h2>

          <p class="mt-1 text-sm text-slate-500">
            {{ leadsList.length }} message(s) affiché(s) sur cette page.
          </p>
        </div>

        <div v-if="leadsList.length" class="divide-y divide-slate-100">
          <article
            v-for="lead in leadsList"
            :key="lead.id"
            :class="[
              'grid gap-5 p-5 transition sm:p-6 lg:grid-cols-[1fr_auto]',
              lead.is_read ? 'bg-white hover:bg-slate-50' : 'bg-orange-50/50 hover:bg-orange-50'
            ]"
          >
            <div class="min-w-0">
              <div class="flex flex-wrap items-center gap-2">
                <span
                  :class="[
                    'inline-flex items-center rounded-xl px-3 py-1 text-xs font-black ring-1',
                    statusClass(leadStatus(lead))
                  ]"
                >
                  {{ statusLabel(leadStatus(lead)) }}
                </span>

                <span
                  v-if="!lead.is_read"
                  class="inline-flex items-center rounded-xl bg-brand-orange px-3 py-1 text-xs font-black text-white"
                >
                  Non lu
                </span>

                <span class="text-xs font-bold text-slate-400">
                  {{ lead.created_at || lead.created_at_human }}
                </span>

                <span
                  v-if="lead.source"
                  class="rounded-xl bg-slate-100 px-3 py-1 text-xs font-black text-slate-500"
                >
                  {{ lead.source }}
                </span>
              </div>

              <h3 class="mt-3 text-xl font-black tracking-[-0.04em] text-slate-950">
                {{ leadSubject(lead) }}
              </h3>

              <div class="mt-3 flex flex-wrap gap-3 text-sm font-bold text-slate-500">
                <span class="inline-flex items-center gap-2">
                  <UserRound :size="16" />
                  {{ leadName(lead) }}
                </span>

                <a
                  :href="`mailto:${lead.email}`"
                  class="inline-flex items-center gap-2 text-brand-orange"
                >
                  <Mail :size="16" />
                  {{ lead.email }}
                </a>

                <a
                  v-if="leadPhone(lead)"
                  :href="`tel:${leadPhone(lead)}`"
                  class="inline-flex items-center gap-2 text-slate-600"
                >
                  <Phone :size="16" />
                  {{ leadPhone(lead) }}
                </a>

                <span
                  v-if="lead.entreprise"
                  class="inline-flex items-center gap-2 text-slate-600"
                >
                  {{ lead.entreprise }}
                </span>
              </div>

              <p class="mt-4 whitespace-pre-line rounded-2xl bg-white p-4 text-sm leading-7 text-slate-600 ring-1 ring-slate-100">
                {{ lead.message || 'Aucun message.' }}
              </p>
            </div>

            <div class="flex flex-wrap items-start gap-2 lg:justify-end">
              <button
                type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition hover:border-emerald-500 hover:text-emerald-600"
                title="Marquer comme lu"
                @click="markAsRead(lead)"
              >
                <CheckCircle2 :size="17" />
              </button>

              <button
                type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-500 transition hover:border-brand-orange hover:text-brand-orange"
                title="Archiver"
                @click="archiveLead(lead)"
              >
                <Archive :size="17" />
              </button>

              <button
                type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-red-100 bg-red-50 text-red-500 transition hover:bg-red-600 hover:text-white"
                title="Supprimer"
                @click="deleteLead(lead)"
              >
                <Trash2 :size="17" />
              </button>
            </div>
          </article>
        </div>

        <div v-else class="p-12 text-center">
          <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
            <Inbox :size="30" />
          </div>

          <h3 class="mt-6 text-2xl font-black text-slate-950">
            Aucun message trouvé
          </h3>

          <p class="mt-2 text-sm text-slate-500">
            Les demandes envoyées depuis le formulaire de contact apparaîtront ici.
          </p>
        </div>

        <!-- PAGINATION -->
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