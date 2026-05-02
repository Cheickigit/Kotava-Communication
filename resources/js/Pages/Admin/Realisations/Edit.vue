<script setup>
import { computed } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import {
  ArrowLeft,
  FileImage,
  Save,
  Trash2,
  UploadCloud,
} from 'lucide-vue-next';

defineOptions({ layout: AppLayout });

const props = defineProps({
  realisation: {
    type: Object,
    required: true,
  },
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
  gallery_images: {
    type: Array,
    default: () => [],
  },
});

const form = useForm({
  _method: 'put',
  title: props.realisation.title || '',
  slug: props.realisation.slug || '',
  description: props.realisation.description || '',
  client: props.realisation.client || '',
  category: props.realisation.category || '',
  service_type: props.realisation.service_type || '',
  status: props.realisation.statut || props.realisation.status || 'brouillon',
  published: Boolean(props.realisation.published),
  featured: Boolean(props.realisation.featured),
  image: null,
  cover_image: null,
  client_logo: null,
  budget: props.realisation.budget || '',
  start_date: props.realisation.start_date || '',
  end_date: props.realisation.end_date || '',
  testimonial: props.realisation.testimonial || '',
  testimonial_author: props.realisation.testimonial_author || '',
  gallery: [],
  remove_image: false,
  remove_cover: false,
  remove_logo: false,
  remove_gallery: [],
  meta_title: props.realisation.meta_title || '',
  meta_description: props.realisation.meta_description || '',
});

const categoryOptions = computed(() => Object.entries(props.categories || {}));
const statusOptions = computed(() => Object.entries(props.statuses || {}));
const serviceTypeOptions = computed(() => Object.entries(props.serviceTypes || {}));

const imageUrl = (path) => {
  if (!path) return null;
  if (path.startsWith('http')) return path;
  return `/storage/${path}`;
};

const setFile = (field, event) => {
  form[field] = event.target.files[0] || null;
};

const setGallery = (event) => {
  form.gallery = Array.from(event.target.files || []);
};

const toggleRemoveGallery = (path) => {
  if (form.remove_gallery.includes(path)) {
    form.remove_gallery = form.remove_gallery.filter((item) => item !== path);
    return;
  }

  form.remove_gallery.push(path);
};

const submit = () => {
  form.post(route('dashboard.realisations.update', props.realisation.id), {
    forceFormData: true,
  });
};
</script>

<template>
  <Head :title="`Modifier — ${realisation.title}`" />

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
          Modifier la réalisation
        </h1>

        <p class="mt-2 max-w-2xl text-sm leading-7 text-slate-500">
          Mettez à jour les informations, les médias, le statut et les réglages SEO du projet.
        </p>
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
                Slug *
              </label>
              <input
                v-model="form.slug"
                type="text"
                class="mt-2 w-full rounded-[1rem] border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold focus:border-brand-orange focus:ring-brand-orange"
                required
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
            Médias actuels
          </h2>

          <div class="mt-6 space-y-5">
            <div v-if="imageUrl(realisation.image)" class="overflow-hidden rounded-[1.2rem] bg-slate-100">
              <img :src="imageUrl(realisation.image)" alt="Image principale" class="h-40 w-full object-cover" />
              <label class="flex items-center gap-2 p-3 text-sm font-bold text-red-600">
                <input v-model="form.remove_image" type="checkbox" class="rounded border-slate-300 text-red-600 focus:ring-red-500" />
                Supprimer l’image principale
              </label>
            </div>

            <div v-if="imageUrl(realisation.cover_image)" class="overflow-hidden rounded-[1.2rem] bg-slate-100">
              <img :src="imageUrl(realisation.cover_image)" alt="Image de couverture" class="h-40 w-full object-cover" />
              <label class="flex items-center gap-2 p-3 text-sm font-bold text-red-600">
                <input v-model="form.remove_cover" type="checkbox" class="rounded border-slate-300 text-red-600 focus:ring-red-500" />
                Supprimer la couverture
              </label>
            </div>

            <div v-if="imageUrl(realisation.client_logo)" class="overflow-hidden rounded-[1.2rem] bg-slate-100">
              <img :src="imageUrl(realisation.client_logo)" alt="Logo client" class="h-32 w-full object-contain p-5" />
              <label class="flex items-center gap-2 p-3 text-sm font-bold text-red-600">
                <input v-model="form.remove_logo" type="checkbox" class="rounded border-slate-300 text-red-600 focus:ring-red-500" />
                Supprimer le logo
              </label>
            </div>

            <div v-if="gallery_images.length" class="grid grid-cols-2 gap-3">
              <button
                v-for="image in gallery_images"
                :key="image"
                type="button"
                :class="[
                  'relative overflow-hidden rounded-[1rem] ring-2 transition',
                  form.remove_gallery.includes(image) ? 'ring-red-500 opacity-50' : 'ring-transparent'
                ]"
                @click="toggleRemoveGallery(image)"
              >
                <img :src="imageUrl(image)" alt="Galerie" class="h-28 w-full object-cover" />
                <span
                  v-if="form.remove_gallery.includes(image)"
                  class="absolute inset-0 flex items-center justify-center bg-red-600/70 text-white"
                >
                  <Trash2 :size="22" />
                </span>
              </button>
            </div>
          </div>
        </section>

        <section class="rounded-[1.8rem] bg-white p-6 shadow-sm ring-1 ring-slate-200/70">
          <h2 class="text-xl font-black tracking-[-0.04em] text-slate-950">
            Remplacer / ajouter des médias
          </h2>

          <div class="mt-6 space-y-5">
            <label class="block rounded-[1.2rem] border border-dashed border-slate-300 bg-slate-50 p-5 text-center">
              <UploadCloud :size="28" class="mx-auto text-brand-orange" />
              <span class="mt-3 block text-sm font-black text-slate-950">Nouvelle image principale</span>
              <input type="file" accept="image/*" class="mt-4 w-full text-sm" @change="setFile('image', $event)" />
            </label>

            <label class="block rounded-[1.2rem] border border-dashed border-slate-300 bg-slate-50 p-5 text-center">
              <FileImage :size="28" class="mx-auto text-brand-orange" />
              <span class="mt-3 block text-sm font-black text-slate-950">Nouvelle couverture</span>
              <input type="file" accept="image/*" class="mt-4 w-full text-sm" @change="setFile('cover_image', $event)" />
            </label>

            <label class="block rounded-[1.2rem] border border-dashed border-slate-300 bg-slate-50 p-5 text-center">
              <UploadCloud :size="28" class="mx-auto text-brand-orange" />
              <span class="mt-3 block text-sm font-black text-slate-950">Nouveau logo client</span>
              <input type="file" accept="image/*" class="mt-4 w-full text-sm" @change="setFile('client_logo', $event)" />
            </label>

            <label class="block rounded-[1.2rem] border border-dashed border-slate-300 bg-slate-50 p-5 text-center">
              <FileImage :size="28" class="mx-auto text-brand-orange" />
              <span class="mt-3 block text-sm font-black text-slate-950">Ajouter à la galerie</span>
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
          {{ form.processing ? 'Mise à jour...' : 'Mettre à jour la réalisation' }}
        </button>
      </aside>
    </form>
  </div>
</template>