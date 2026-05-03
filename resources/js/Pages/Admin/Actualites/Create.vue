<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import {
  ArrowLeft,
  CalendarDays,
  FileText,
  Image as ImageIcon,
  Loader2,
  Newspaper,
  Save,
  Sparkles,
  UploadCloud,
} from 'lucide-vue-next';
import { computed, ref } from 'vue';

defineOptions({ layout: AppLayout });

const props = defineProps({
  categories: {
    type: Object,
    default: () => ({}),
  },
  statuts: {
    type: Object,
    default: () => ({}),
  },
});

const imagePreview = ref(null);

const form = useForm({
  title: '',
  slug: '',
  extrait: '',
  content: '',
  category: 'actualite',
  statut: 'brouillon',
  image: null,
  date_publication: '',
  featured: false,
  meta_title: '',
  meta_description: '',
});

const categoryOptions = computed(() => props.categories || {});
const statutOptions = computed(() => props.statuts || {});

const generateSlug = () => {
  if (form.slug) return;

  form.slug = form.title
    .toString()
    .normalize('NFD')
    .replace(/[\u0300-\u036f]/g, '')
    .toLowerCase()
    .trim()
    .replace(/[^a-z0-9]+/g, '-')
    .replace(/^-+|-+$/g, '');
};

const handleImage = (event) => {
  const file = event.target.files?.[0];

  if (!file) return;

  form.image = file;
  imagePreview.value = URL.createObjectURL(file);
};

const submit = () => {
  form.post('/dashboard/actualites', {
    forceFormData: true,
    preserveScroll: true,
  });
};
</script>

<template>
  <Head title="Ajouter une actualité - Dashboard KOTAVA" />

  <main class="min-h-screen bg-[#F3F5F8] px-4 py-8 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-5xl">
      <section class="relative overflow-hidden rounded-[2rem] bg-[#07101d] p-6 text-white shadow-2xl sm:p-8">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_18%,rgba(249,115,22,0.28),transparent_28%),radial-gradient(circle_at_85%_18%,rgba(16,185,129,0.18),transparent_30%),linear-gradient(135deg,#07101d_0%,#10235f_52%,#06131f_100%)]"></div>

        <div class="relative z-10">
          <Link
            href="/dashboard/actualites"
            class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-xs font-black uppercase tracking-[0.14em] text-white/65 transition hover:bg-white/[0.12] hover:text-white"
          >
            <ArrowLeft :size="15" />
            Retour aux actualités
          </Link>

          <h1 class="mt-5 text-4xl font-black tracking-[-0.06em] sm:text-5xl">
            Ajouter une actualité
          </h1>

          <p class="mt-4 max-w-2xl text-base leading-7 text-white/60">
            Créez une publication pour alimenter le blog, les communiqués ou les actualités de KOTAVA Communication.
          </p>
        </div>
      </section>

      <form class="mt-8 grid gap-8 lg:grid-cols-[1fr_340px]" @submit.prevent="submit">
        <section class="space-y-6">
          <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <div class="flex items-center gap-3">
              <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-brand-orange/10 text-brand-orange">
                <Newspaper :size="22" />
              </div>

              <div>
                <h2 class="text-2xl font-black tracking-[-0.04em] text-slate-950">
                  Informations principales
                </h2>
                <p class="text-sm text-slate-500">
                  Titre, résumé et contenu de l’actualité.
                </p>
              </div>
            </div>

            <div class="mt-7 space-y-5">
              <div>
                <label class="text-sm font-black text-slate-700">Titre</label>
                <input
                  v-model="form.title"
                  type="text"
                  class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700 outline-none transition focus:border-brand-orange focus:bg-white focus:ring-4 focus:ring-brand-orange/10"
                  placeholder="Ex: Lancement d’une nouvelle campagne..."
                  @blur="generateSlug"
                />
                <p v-if="form.errors.title" class="mt-2 text-sm font-semibold text-red-600">
                  {{ form.errors.title }}
                </p>
              </div>

              <div>
                <label class="text-sm font-black text-slate-700">Slug</label>
                <input
                  v-model="form.slug"
                  type="text"
                  class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700 outline-none transition focus:border-brand-orange focus:bg-white focus:ring-4 focus:ring-brand-orange/10"
                  placeholder="lancement-nouvelle-campagne"
                />
                <p v-if="form.errors.slug" class="mt-2 text-sm font-semibold text-red-600">
                  {{ form.errors.slug }}
                </p>
              </div>

              <div>
                <label class="text-sm font-black text-slate-700">Extrait</label>
                <textarea
                  v-model="form.extrait"
                  rows="3"
                  class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700 outline-none transition focus:border-brand-orange focus:bg-white focus:ring-4 focus:ring-brand-orange/10"
                  placeholder="Résumé court affiché dans les listes..."
                ></textarea>
                <p v-if="form.errors.extrait" class="mt-2 text-sm font-semibold text-red-600">
                  {{ form.errors.extrait }}
                </p>
              </div>

              <div>
                <label class="text-sm font-black text-slate-700">Contenu</label>
                <textarea
                  v-model="form.content"
                  rows="12"
                  class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold leading-7 text-slate-700 outline-none transition focus:border-brand-orange focus:bg-white focus:ring-4 focus:ring-brand-orange/10"
                  placeholder="Rédigez le contenu complet..."
                ></textarea>
                <p v-if="form.errors.content" class="mt-2 text-sm font-semibold text-red-600">
                  {{ form.errors.content }}
                </p>
              </div>
            </div>
          </div>

          <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <div class="flex items-center gap-3">
              <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-brand-orange/10 text-brand-orange">
                <FileText :size="22" />
              </div>

              <div>
                <h2 class="text-2xl font-black tracking-[-0.04em] text-slate-950">
                  SEO
                </h2>
                <p class="text-sm text-slate-500">
                  Optimisation du titre et de la description.
                </p>
              </div>
            </div>

            <div class="mt-7 space-y-5">
              <div>
                <label class="text-sm font-black text-slate-700">Meta title</label>
                <input
                  v-model="form.meta_title"
                  type="text"
                  class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700 outline-none transition focus:border-brand-orange focus:bg-white focus:ring-4 focus:ring-brand-orange/10"
                  placeholder="Titre SEO"
                />
              </div>

              <div>
                <label class="text-sm font-black text-slate-700">Meta description</label>
                <textarea
                  v-model="form.meta_description"
                  rows="3"
                  class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700 outline-none transition focus:border-brand-orange focus:bg-white focus:ring-4 focus:ring-brand-orange/10"
                  placeholder="Description SEO courte..."
                ></textarea>
              </div>
            </div>
          </div>
        </section>

        <aside class="space-y-6">
          <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-black tracking-[-0.04em] text-slate-950">
              Publication
            </h2>

            <div class="mt-6 space-y-5">
              <div>
                <label class="text-sm font-black text-slate-700">Catégorie</label>
                <select
                  v-model="form.category"
                  class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold text-slate-700 outline-none transition focus:border-brand-orange focus:bg-white focus:ring-4 focus:ring-brand-orange/10"
                >
                  <option v-for="(label, value) in categoryOptions" :key="value" :value="value">
                    {{ label }}
                  </option>
                </select>
              </div>

              <div>
                <label class="text-sm font-black text-slate-700">Statut</label>
                <select
                  v-model="form.statut"
                  class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold text-slate-700 outline-none transition focus:border-brand-orange focus:bg-white focus:ring-4 focus:ring-brand-orange/10"
                >
                  <option v-for="(label, value) in statutOptions" :key="value" :value="value">
                    {{ label }}
                  </option>
                </select>
              </div>

              <div>
                <label class="text-sm font-black text-slate-700">Date de publication</label>
                <div class="relative mt-2">
                  <CalendarDays :size="18" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400" />
                  <input
                    v-model="form.date_publication"
                    type="date"
                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm font-bold text-slate-700 outline-none transition focus:border-brand-orange focus:bg-white focus:ring-4 focus:ring-brand-orange/10"
                  />
                </div>
              </div>

              <label class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                <input
                  v-model="form.featured"
                  type="checkbox"
                  class="h-5 w-5 rounded border-slate-300 text-brand-orange focus:ring-brand-orange"
                />
                <span class="text-sm font-black text-slate-700">
                  Mettre en vedette
                </span>
              </label>
            </div>
          </div>

          <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-black tracking-[-0.04em] text-slate-950">
              Image
            </h2>

            <label class="mt-5 flex cursor-pointer flex-col items-center justify-center rounded-[1.5rem] border-2 border-dashed border-slate-200 bg-slate-50 p-6 text-center transition hover:border-brand-orange hover:bg-brand-orange/5">
              <input type="file" accept="image/*" class="hidden" @change="handleImage" />

              <img
                v-if="imagePreview"
                :src="imagePreview"
                alt="Aperçu"
                class="h-44 w-full rounded-2xl object-cover"
              />

              <template v-else>
                <UploadCloud :size="34" class="text-brand-orange" />
                <p class="mt-3 text-sm font-black text-slate-700">
                  Importer une image
                </p>
                <p class="mt-1 text-xs text-slate-500">
                  JPEG, PNG, WEBP — 4 Mo max
                </p>
              </template>
            </label>

            <p v-if="form.errors.image" class="mt-2 text-sm font-semibold text-red-600">
              {{ form.errors.image }}
            </p>
          </div>

          <button
            type="submit"
            :disabled="form.processing"
            class="inline-flex w-full items-center justify-center gap-3 rounded-2xl bg-brand-orange px-5 py-4 text-sm font-black text-white shadow-[0_18px_50px_rgba(249,115,22,0.25)] transition hover:-translate-y-1 disabled:cursor-not-allowed disabled:opacity-60"
          >
            <Loader2 v-if="form.processing" :size="18" class="animate-spin" />
            <Save v-else :size="18" />
            Enregistrer l’actualité
          </button>
        </aside>
      </form>
    </div>
  </main>
</template>