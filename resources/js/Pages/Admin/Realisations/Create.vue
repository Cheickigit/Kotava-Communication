<script setup>
import { computed, watch } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import {
  ArrowLeft,
  FileImage,
  Save,
  Sparkles,
  UploadCloud,
} from 'lucide-vue-next';

defineOptions({ layout: AppLayout });

const props = defineProps({
  categories: {
    type: Object,
    default: () => ({}),
  },
  statuses: {
    type: Object,
    default: () => ({}),
  },
  serviceTypes: {
    type: Object,
    default: () => ({}),
  },
});

const form = useForm({
  title: '',
  slug: '',
  description: '',
  client: '',
  category: '',
  service_type: '',
  status: 'brouillon',
  published: false,
  featured: false,
  image: null,
  cover_image: null,
  client_logo: null,
  budget: '',
  start_date: '',
  end_date: '',
  testimonial: '',
  testimonial_author: '',
  gallery: [],
  meta_title: '',
  meta_description: '',
});

const categoryOptions = computed(() => Object.entries(props.categories || {}));
const statusOptions = computed(() => Object.entries(props.statuses || {}));
const serviceTypeOptions = computed(() => Object.entries(props.serviceTypes || {}));

const slugify = (value) => {
  return value
    .toString()
    .normalize('NFD')
    .replace(/[\u0300-\u036f]/g, '')
    .toLowerCase()
    .trim()
    .replace(/[^a-z0-9]+/g, '-')
    .replace(/^-+|-+$/g, '');
};

watch(
  () => form.title,
  (value) => {
    if (!form.slug) {
      form.slug = slugify(value || '');
    }
  }
);

const setFile = (field, event) => {
  form[field] = event.target.files[0] || null;
};

const setGallery = (event) => {
  form.gallery = Array.from(event.target.files || []);
};

const submit = () => {
  form.post(route('dashboard.realisations.store'), {
    forceFormData: true,
  });
};
</script>

<template>
  <Head title="Nouvelle réalisation" />

  <div class="space-y-6">
    <div class="flex flex-col gap-4 rounded-[1.8rem] bg-white p-6 shadow-sm ring-1 ring-slate-200/70 lg:flex-row lg:items-center lg:justify-between">
      <div>
        <Link
          :href="route('dashboard.realisations.index')"
          class="inline-flex items-center gap-2 text-sm font-black text-slate-500 transition hover:text-brand-orange"
        >
          <ArrowLeft :size="18" />
          Retour au portfolio
        </Link>

        <h1 class="mt-4 text-3xl font-black tracking-[-0.05em] text-slate-950 sm:text-4xl">
          Nouvelle réalisation
        </h1>

        <p class="mt-2 max-w-2xl text-sm leading-7 text-slate-500">
          Créez un projet complet pour alimenter le portfolio public de KOTAVA.
        </p>
      </div>

      <div class="hidden rounded-[1.3rem] bg-brand-orange/10 p-4 text-brand-orange lg:block">
        <Sparkles :size="28" />
      </div>
    </div>

    <form class="grid gap-6 xl:grid-cols-[1.35fr_0.65fr]" @submit.prevent="submit">
      <div class="space-y-6">
        <section class="rounded-[1.8rem] bg-white p-6 shadow-sm ring-1 ring-slate-200/70">
          <h2 class="text-xl font-black tracking-[-0.04em] text-slate-950">
            Informations principales
          </h2>

          <div class="mt-6 grid gap-5 md:grid-cols-2">
            <div>
              <label class="text-xs font-black uppercase tracking-[0.14em] text-slate-500">
                Titre *
              </label>
              <input
                v-model="form.title"
                type="text"
                class="mt-2 w-full rounded-[1rem] border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold focus:border-brand-orange focus:ring-brand-orange"
                required
              />
              <p v-if="form.errors.title" class="mt-2 text-sm font-bold text-red-500">
                {{ form.errors.title }}
              </p>
            </div>

            <div>
              <label class="text-xs font-black uppercase tracking-[0.14em] text-slate-500">
                Slug
              </label>
              <input
                v-model="form.slug"
                type="text"
                class="mt-2 w-full rounded-[1rem] border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold focus:border-brand-orange focus:ring-brand-orange"
              />
              <p v-if="form.errors.slug" class="mt-2 text-sm font-bold text-red-500">
                {{ form.errors.slug }}
              </p>
            </div>

            <div>
              <label class="text-xs font-black uppercase tracking-[0.14em] text-slate-500">
                Client *
              </label>
              <input
                v-model="form.client"
                type="text"
                class="mt-2 w-full rounded-[1rem] border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold focus:border-brand-orange focus:ring-brand-orange"
                required
              />
              <p v-if="form.errors.client" class="mt-2 text-sm font-bold text-red-500">
                {{ form.errors.client }}
              </p>
            </div>

            <div>
              <label class="text-xs font-black uppercase tracking-[0.14em] text-slate-500">
                Budget
              </label>
              <input
                v-model="form.budget"
                type="number"
                min="0"
                class="mt-2 w-full rounded-[1rem] border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold focus:border-brand-orange focus:ring-brand-orange"
              />
            </div>

            <div>
              <label class="text-xs font-black uppercase tracking-[0.14em] text-slate-500">
                Catégorie *
              </label>
              <select
                v-model="form.category"
                class="mt-2 w-full rounded-[1rem] border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold focus:border-brand-orange focus:ring-brand-orange"
                required
              >
                <option value="">Sélectionner</option>
                <option
                  v-for="[value, label] in categoryOptions"
                  :key="value"
                  :value="value"
                >
                  {{ label }}
                </option>
              </select>
              <p v-if="form.errors.category" class="mt-2 text-sm font-bold text-red-500">
                {{ form.errors.category }}
              </p>
            </div>

            <div>
              <label class="text-xs font-black uppercase tracking-[0.14em] text-slate-500">
                Type de service
              </label>
              <select
                v-model="form.service_type"
                class="mt-2 w-full rounded-[1rem] border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold focus:border-brand-orange focus:ring-brand-orange"
              >
                <option
                  v-for="[value, label] in serviceTypeOptions"
                  :key="value"
                  :value="value"
                >
                  {{ label }}
                </option>
              </select>
            </div>

            <div>
              <label class="text-xs font-black uppercase tracking-[0.14em] text-slate-500">
                Date de début
              </label>
              <input
                v-model="form.start_date"
                type="date"
                class="mt-2 w-full rounded-[1rem] border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold focus:border-brand-orange focus:ring-brand-orange"
              />
            </div>

            <div>
              <label class="text-xs font-black uppercase tracking-[0.14em] text-slate-500">
                Date de fin
              </label>
              <input
                v-model="form.end_date"
                type="date"
                class="mt-2 w-full rounded-[1rem] border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold focus:border-brand-orange focus:ring-brand-orange"
              />
            </div>
          </div>
        </section>

        <section class="rounded-[1.8rem] bg-white p-6 shadow-sm ring-1 ring-slate-200/70">
          <h2 class="text-xl font-black tracking-[-0.04em] text-slate-950">
            Contenu du projet
          </h2>

          <div class="mt-6 space-y-5">
            <div>
              <label class="text-xs font-black uppercase tracking-[0.14em] text-slate-500">
                Description *
              </label>
              <textarea
                v-model="form.description"
                rows="7"
                class="mt-2 w-full rounded-[1rem] border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold leading-7 focus:border-brand-orange focus:ring-brand-orange"
                required
              ></textarea>
              <p v-if="form.errors.description" class="mt-2 text-sm font-bold text-red-500">
                {{ form.errors.description }}
              </p>
            </div>

            <div>
              <label class="text-xs font-black uppercase tracking-[0.14em] text-slate-500">
                Témoignage client
              </label>
              <textarea
                v-model="form.testimonial"
                rows="4"
                class="mt-2 w-full rounded-[1rem] border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold leading-7 focus:border-brand-orange focus:ring-brand-orange"
              ></textarea>
            </div>

            <div>
              <label class="text-xs font-black uppercase tracking-[0.14em] text-slate-500">
                Auteur du témoignage
              </label>
              <input
                v-model="form.testimonial_author"
                type="text"
                class="mt-2 w-full rounded-[1rem] border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold focus:border-brand-orange focus:ring-brand-orange"
              />
            </div>
          </div>
        </section>

        <section class="rounded-[1.8rem] bg-white p-6 shadow-sm ring-1 ring-slate-200/70">
          <h2 class="text-xl font-black tracking-[-0.04em] text-slate-950">
            SEO
          </h2>

          <div class="mt-6 space-y-5">
            <div>
              <label class="text-xs font-black uppercase tracking-[0.14em] text-slate-500">
                Meta title
              </label>
              <input
                v-model="form.meta_title"
                type="text"
                class="mt-2 w-full rounded-[1rem] border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold focus:border-brand-orange focus:ring-brand-orange"
              />
            </div>

            <div>
              <label class="text-xs font-black uppercase tracking-[0.14em] text-slate-500">
                Meta description
              </label>
              <textarea
                v-model="form.meta_description"
                rows="3"
                class="mt-2 w-full rounded-[1rem] border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold leading-7 focus:border-brand-orange focus:ring-brand-orange"
              ></textarea>
            </div>
          </div>
        </section>
      </div>

      <aside class="space-y-6">
        <section class="rounded-[1.8rem] bg-white p-6 shadow-sm ring-1 ring-slate-200/70">
          <h2 class="text-xl font-black tracking-[-0.04em] text-slate-950">
            Publication
          </h2>

          <div class="mt-6 space-y-5">
            <div>
              <label class="text-xs font-black uppercase tracking-[0.14em] text-slate-500">
                Statut *
              </label>
              <select
                v-model="form.status"
                class="mt-2 w-full rounded-[1rem] border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold focus:border-brand-orange focus:ring-brand-orange"
                required
              >
                <option
                  v-for="[value, label] in statusOptions"
                  :key="value"
                  :value="value"
                >
                  {{ label }}
                </option>
              </select>
            </div>

            <label class="flex items-center justify-between rounded-[1rem] border border-slate-200 bg-slate-50 p-4">
              <span>
                <span class="block text-sm font-black text-slate-950">Publier</span>
                <span class="text-xs font-bold text-slate-500">Visible sur le site public</span>
              </span>
              <input
                v-model="form.published"
                type="checkbox"
                class="rounded border-slate-300 text-brand-orange focus:ring-brand-orange"
              />
            </label>

            <label class="flex items-center justify-between rounded-[1rem] border border-slate-200 bg-slate-50 p-4">
              <span>
                <span class="block text-sm font-black text-slate-950">Mettre en avant</span>
                <span class="text-xs font-bold text-slate-500">Projet prioritaire</span>
              </span>
              <input
                v-model="form.featured"
                type="checkbox"
                class="rounded border-slate-300 text-brand-orange focus:ring-brand-orange"
              />
            </label>
          </div>
        </section>

        <section class="rounded-[1.8rem] bg-white p-6 shadow-sm ring-1 ring-slate-200/70">
          <h2 class="text-xl font-black tracking-[-0.04em] text-slate-950">
            Médias
          </h2>

          <div class="mt-6 space-y-5">
            <label class="block rounded-[1.2rem] border border-dashed border-slate-300 bg-slate-50 p-5 text-center">
              <UploadCloud :size="28" class="mx-auto text-brand-orange" />
              <span class="mt-3 block text-sm font-black text-slate-950">Image principale</span>
              <input type="file" accept="image/*" class="mt-4 w-full text-sm" @change="setFile('image', $event)" />
            </label>

            <label class="block rounded-[1.2rem] border border-dashed border-slate-300 bg-slate-50 p-5 text-center">
              <FileImage :size="28" class="mx-auto text-brand-orange" />
              <span class="mt-3 block text-sm font-black text-slate-950">Image de couverture</span>
              <input type="file" accept="image/*" class="mt-4 w-full text-sm" @change="setFile('cover_image', $event)" />
            </label>

            <label class="block rounded-[1.2rem] border border-dashed border-slate-300 bg-slate-50 p-5 text-center">
              <UploadCloud :size="28" class="mx-auto text-brand-orange" />
              <span class="mt-3 block text-sm font-black text-slate-950">Logo client</span>
              <input type="file" accept="image/*" class="mt-4 w-full text-sm" @change="setFile('client_logo', $event)" />
            </label>

            <label class="block rounded-[1.2rem] border border-dashed border-slate-300 bg-slate-50 p-5 text-center">
              <FileImage :size="28" class="mx-auto text-brand-orange" />
              <span class="mt-3 block text-sm font-black text-slate-950">Galerie</span>
              <input type="file" accept="image/*" multiple class="mt-4 w-full text-sm" @change="setGallery" />
            </label>
          </div>
        </section>

        <button
          type="submit"
          :disabled="form.processing"
          :class="[
            'inline-flex w-full items-center justify-center gap-2 rounded-[1rem] bg-brand-orange px-6 py-4 text-sm font-black text-white shadow-orange transition hover:-translate-y-0.5 hover:bg-brand-orange/90',
            form.processing ? 'cursor-not-allowed opacity-60' : ''
          ]"
        >
          <Save :size="18" />
          {{ form.processing ? 'Enregistrement...' : 'Enregistrer la réalisation' }}
        </button>
      </aside>
    </form>
  </div>
</template>