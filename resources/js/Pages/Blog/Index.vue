<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {
  ArrowRight,
  BookOpen,
  CalendarDays,
  CheckCircle2,
  ChevronRight,
  Eye,
  FileText,
  Filter,
  Image as ImageIcon,
  Mail,
  MessageCircle,
  Newspaper,
  PenLine,
  Search,
  Sparkles,
  Star,
  Target,
  TrendingUp,
  UsersRound,
  X,
  Zap,
} from 'lucide-vue-next';
import { computed, reactive } from 'vue';

defineOptions({ layout: GuestLayout });

const props = defineProps({
  actualites: {
    type: [Object, Array],
    default: () => ({
      data: [],
      links: [],
      meta: {},
    }),
  },
  featuredActualites: {
    type: Array,
    default: () => [],
  },
  recentActualites: {
    type: Array,
    default: () => [],
  },
  categories: {
    type: [Array, Object],
    default: () => [],
  },
  filters: {
    type: Object,
    default: () => ({}),
  },
  currentFilter: {
    type: String,
    default: 'tous',
  },
  meta: {
    type: Object,
    default: () => ({}),
  },
});

const contactEmail = 'Contact@kotavacom.com';
const contactPhoneDisplay = '+229 93 37 49 63';
const whatsappHref = 'https://wa.me/22993374963';

const pageTitle = computed(() => props.meta?.title || 'Blog - KOTAVA Communication');
const pageDescription = computed(() =>
  props.meta?.description ||
  'Découvrez les actualités, articles, communiqués et analyses de KOTAVA Communication.'
);

const form = reactive({
  search: props.filters?.search || '',
  category: props.currentFilter || props.filters?.category || 'tous',
});

const articles = computed(() => {
  if (Array.isArray(props.actualites)) {
    return props.actualites;
  }

  return props.actualites?.data || [];
});

const paginationLinks = computed(() => {
  if (Array.isArray(props.actualites)) {
    return [];
  }

  return props.actualites?.links || [];
});

const normalizedCategories = computed(() => {
  if (Array.isArray(props.categories)) {
    return props.categories;
  }

  return Object.entries(props.categories || {}).map(([slug, label]) => ({
    slug,
    name: label,
    label,
    count: null,
  }));
});

const totalArticles = computed(() => {
  if (props.actualites?.meta?.total) {
    return props.actualites.meta.total;
  }

  if (typeof props.actualites?.total === 'number') {
    return props.actualites.total;
  }

  return articles.value.length;
});

const stats = computed(() => [
  {
    value: `${totalArticles.value}+`,
    label: 'Publications',
    icon: BookOpen,
  },
  {
    value: normalizedCategories.value.length || 5,
    label: 'Catégories',
    icon: Filter,
  },
  {
    value: props.featuredActualites?.length || 0,
    label: 'En vedette',
    icon: Star,
  },
  {
    value: '360°',
    label: 'Vision communication',
    icon: Zap,
  },
]);

const featuredArticle = computed(() => {
  if (props.featuredActualites?.length) {
    return props.featuredActualites[0];
  }

  return articles.value[0] || null;
});

const secondaryFeatured = computed(() => {
  if (props.featuredActualites?.length > 1) {
    return props.featuredActualites.slice(1, 3);
  }

  return articles.value.slice(1, 3);
});

const articleHref = (article) => article?.url || (article?.slug ? `/blog/${article.slug}` : '/blog');

const imageUrl = (article) => article?.image_url || article?.image || null;

const articleDate = (article) => {
  return article?.date_publication_display || article?.created_at || 'Date non spécifiée';
};

const articleExcerpt = (article) => {
  return article?.extrait || article?.summary || article?.description || article?.content || '';
};

const applyFilters = () => {
  router.get('/blog', {
    search: form.search || undefined,
    category: form.category !== 'tous' ? form.category : undefined,
  }, {
    preserveScroll: true,
    preserveState: true,
    replace: true,
  });
};

const resetFilters = () => {
  form.search = '';
  form.category = 'tous';

  router.get('/blog', {}, {
    preserveScroll: true,
    replace: true,
  });
};

const categoryColorClass = (index) => {
  const classes = [
    'from-brand-orange to-emerald-400',
    'from-brand-blue to-brand-orange',
    'from-emerald-400 to-brand-blue',
    'from-orange-400 to-brand-orange',
    'from-brand-blue to-emerald-400',
  ];

  return classes[index % classes.length];
};
</script>

<template>
  <Head :title="pageTitle">
    <meta name="description" :content="pageDescription" />
    <meta name="keywords" content="KOTAVA Communication, blog communication, marketing digital, branding, communication digitale, actualités KOTAVA, agence communication Bénin" />
    <meta property="og:title" :content="pageTitle" />
    <meta property="og:description" :content="pageDescription" />
    <meta property="og:type" content="website" />
  </Head>

  <main class="overflow-hidden bg-[#07101d] text-white">
    <!-- HERO -->
    <section class="relative isolate px-4 pb-12 pt-16 sm:px-6 lg:px-8 lg:pb-16 lg:pt-20">
      <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_15%_18%,rgba(249,115,22,0.24),transparent_28%),radial-gradient(circle_at_88%_8%,rgba(16,185,129,0.16),transparent_30%),linear-gradient(135deg,#07101d_0%,#10235f_48%,#06131f_100%)]"></div>
      <div class="absolute inset-0 -z-10 bg-[linear-gradient(rgba(255,255,255,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.04)_1px,transparent_1px)] bg-[size:42px_42px] opacity-40"></div>

      <div class="mx-auto max-w-7xl">
        <div class="grid gap-10 lg:grid-cols-[0.95fr_1.05fr] lg:items-end">
          <div>
            <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-xs font-black uppercase tracking-[0.16em] text-white/[0.65] backdrop-blur">
              <Sparkles :size="15" class="text-brand-orange" />
              Insights & actualités
            </div>

            <h1 class="mt-6 max-w-4xl text-5xl font-black leading-[0.92] tracking-[-0.08em] text-white sm:text-6xl lg:text-7xl">
              Le blog de la communication qui construit des marques fortes.
            </h1>

            <p class="mt-6 max-w-2xl text-base leading-8 text-white/[0.62] sm:text-lg">
              Analyses, conseils pratiques, tendances digitales, branding, contenus et stratégies pour aider les entreprises à mieux communiquer.
            </p>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
              <a
                href="#articles"
                class="inline-flex items-center justify-center gap-3 rounded-2xl bg-brand-orange px-6 py-4 text-sm font-black text-white shadow-[0_18px_50px_rgba(249,115,22,0.28)] transition hover:-translate-y-1"
              >
                Lire les articles
                <ArrowRight :size="18" />
              </a>

              <a
                href="#categories"
                class="inline-flex items-center justify-center gap-3 rounded-2xl border border-white/10 bg-white/[0.08] px-6 py-4 text-sm font-black text-white/[0.76] backdrop-blur transition hover:-translate-y-1 hover:bg-white/[0.12] hover:text-white"
              >
                Explorer les thèmes
                <BookOpen :size="18" />
              </a>
            </div>
          </div>

          <div class="relative">
            <div class="absolute -inset-6 rounded-[2.7rem] bg-brand-orange/20 blur-3xl"></div>

            <div class="relative overflow-hidden rounded-[2.4rem] border border-white/10 bg-white/[0.08] p-4 shadow-2xl shadow-black/20 backdrop-blur-xl">
              <div class="rounded-[1.9rem] border border-white/10 bg-[#0b1524] p-5">
                <div class="flex items-center justify-between gap-4">
                  <div>
                    <p class="text-xs font-black uppercase tracking-[0.16em] text-brand-orange">
                      À la une
                    </p>
                    <h2 class="mt-2 text-2xl font-black tracking-[-0.05em] text-white">
                      Sélection éditoriale
                    </h2>
                  </div>

                  <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-orange text-white">
                    <Newspaper :size="23" />
                  </div>
                </div>

                <Link
                  v-if="featuredArticle"
                  :href="articleHref(featuredArticle)"
                  class="group mt-6 block overflow-hidden rounded-[1.6rem] border border-white/10 bg-white/[0.06] transition hover:border-brand-orange/50 hover:bg-white/[0.09]"
                >
                  <div class="relative h-64 overflow-hidden bg-[#07101d]">
                    <img
                      v-if="imageUrl(featuredArticle)"
                      :src="imageUrl(featuredArticle)"
                      :alt="featuredArticle.title"
                      class="h-full w-full object-cover opacity-90 transition duration-700 group-hover:scale-105 group-hover:opacity-100"
                    />

                    <div v-else class="flex h-full w-full items-center justify-center">
                      <div class="text-center">
                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-brand-orange text-white">
                          <BookOpen :size="25" />
                        </div>
                        <p class="mt-3 text-sm font-bold text-white/[0.42]">
                          Visuel à venir
                        </p>
                      </div>
                    </div>

                    <div class="absolute inset-0 bg-gradient-to-t from-[#07101d] via-transparent to-transparent"></div>

                    <div class="absolute bottom-4 left-4 right-4">
                      <span class="inline-flex rounded-xl bg-brand-orange px-3 py-1 text-xs font-black text-white">
                        {{ featuredArticle.category_label || featuredArticle.category || 'Article' }}
                      </span>

                      <h3 class="mt-3 line-clamp-2 text-2xl font-black tracking-[-0.05em] text-white">
                        {{ featuredArticle.title }}
                      </h3>
                    </div>
                  </div>

                  <div class="p-5">
                    <p class="line-clamp-2 text-sm leading-6 text-white/[0.55]">
                      {{ articleExcerpt(featuredArticle) }}
                    </p>

                    <div class="mt-5 flex items-center justify-between gap-4">
                      <span class="inline-flex items-center gap-2 text-xs font-bold text-white/[0.42]">
                        <CalendarDays :size="14" />
                        {{ articleDate(featuredArticle) }}
                      </span>

                      <span class="inline-flex items-center gap-2 text-sm font-black text-brand-orange">
                        Lire
                        <ChevronRight :size="16" class="transition group-hover:translate-x-1" />
                      </span>
                    </div>
                  </div>
                </Link>

                <div v-else class="mt-6 rounded-[1.6rem] border border-dashed border-white/10 bg-white/[0.04] p-8 text-center">
                  <BookOpen :size="40" class="mx-auto text-brand-orange" />
                  <p class="mt-4 text-sm font-bold text-white/[0.55]">
                    Les articles publiés apparaîtront ici.
                  </p>
                </div>

                <div v-if="secondaryFeatured.length" class="mt-4 grid gap-3 sm:grid-cols-2">
                  <Link
                    v-for="article in secondaryFeatured"
                    :key="article.id"
                    :href="articleHref(article)"
                    class="group rounded-2xl border border-white/10 bg-white/[0.045] p-4 transition hover:border-brand-orange/50 hover:bg-white/[0.08]"
                  >
                    <p class="text-xs font-black uppercase tracking-[0.14em] text-white/[0.35]">
                      {{ article.category_label || article.category || 'Article' }}
                    </p>

                    <h3 class="mt-2 line-clamp-2 text-sm font-black leading-5 text-white group-hover:text-brand-orange">
                      {{ article.title }}
                    </h3>
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- STATS -->
        <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
          <div
            v-for="stat in stats"
            :key="stat.label"
            class="rounded-[1.5rem] border border-white/10 bg-white/[0.07] p-5 backdrop-blur"
          >
            <div class="flex items-start justify-between gap-4">
              <div>
                <p class="text-3xl font-black tracking-[-0.05em] text-white">
                  {{ stat.value }}
                </p>

                <p class="mt-1 text-sm font-bold text-white/[0.48]">
                  {{ stat.label }}
                </p>
              </div>

              <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-brand-orange/15 text-brand-orange">
                <component :is="stat.icon" :size="21" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CATEGORIES -->
    <section id="categories" class="border-t border-white/10 px-4 py-14 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-7xl">
        <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
          <div>
            <div class="inline-flex items-center gap-2 rounded-2xl bg-brand-orange/10 px-4 py-2 text-xs font-black uppercase tracking-[0.14em] text-brand-orange">
              <BookOpen :size="15" />
              Thématiques
            </div>

            <h2 class="mt-4 text-4xl font-black tracking-[-0.06em] text-white">
              Explorer par catégorie
            </h2>
          </div>

          <p class="max-w-xl text-sm leading-6 text-white/[0.52]">
            Retrouvez rapidement les publications liées aux actualités, au blog, aux communiqués, aux témoignages et aux cas d’étude.
          </p>
        </div>

        <div class="mt-8 grid gap-4 md:grid-cols-2 lg:grid-cols-5">
          <Link
            v-for="(category, index) in normalizedCategories"
            :key="category.slug || category.name"
            :href="category.slug === 'tous' ? '/blog' : `/blog?category=${category.slug}`"
            :class="[
              'group relative overflow-hidden rounded-[1.7rem] border p-5 transition hover:-translate-y-1',
              form.category === category.slug || (!form.category && category.slug === 'tous')
                ? 'border-brand-orange bg-brand-orange text-white shadow-[0_18px_50px_rgba(249,115,22,0.24)]'
                : 'border-white/10 bg-white/[0.06] text-white hover:border-brand-orange/50 hover:bg-white/[0.09]'
            ]"
          >
            <div
              :class="[
                'absolute -right-8 -top-8 h-24 w-24 rounded-full bg-gradient-to-br opacity-25 blur-2xl',
                categoryColorClass(index)
              ]"
            ></div>

            <div class="relative">
              <div
                :class="[
                  'flex h-12 w-12 items-center justify-center rounded-2xl transition',
                  form.category === category.slug
                    ? 'bg-white text-brand-orange'
                    : 'bg-brand-orange/15 text-brand-orange group-hover:bg-brand-orange group-hover:text-white'
                ]"
              >
                <FileText :size="21" />
              </div>

              <h3 class="mt-5 text-lg font-black tracking-[-0.04em]">
                {{ category.label || category.name }}
              </h3>

              <p class="mt-2 text-sm font-bold opacity-60">
                {{ category.count ?? 0 }} publication(s)
              </p>
            </div>
          </Link>
        </div>
      </div>
    </section>

    <!-- ARTICLES -->
    <section id="articles" class="border-t border-white/10 px-4 py-14 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-7xl">
        <div class="rounded-[2rem] border border-white/10 bg-white/[0.06] p-5 backdrop-blur sm:p-6">
          <div class="grid gap-4 lg:grid-cols-[1fr_260px_auto] lg:items-end">
            <div>
              <label class="text-xs font-black uppercase tracking-[0.14em] text-white/[0.45]">
                Recherche
              </label>

              <div class="relative mt-2">
                <Search :size="18" class="absolute left-4 top-1/2 -translate-y-1/2 text-white/[0.35]" />

                <input
                  v-model="form.search"
                  type="text"
                  placeholder="Rechercher un article, une analyse, un communiqué..."
                  class="w-full rounded-2xl border border-white/10 bg-white/[0.07] py-3 pl-11 pr-4 text-sm font-semibold text-white outline-none transition placeholder:text-white/[0.32] focus:border-brand-orange focus:ring-4 focus:ring-brand-orange/10"
                  @keyup.enter="applyFilters"
                />
              </div>
            </div>

            <div>
              <label class="text-xs font-black uppercase tracking-[0.14em] text-white/[0.45]">
                Catégorie
              </label>

              <select
                v-model="form.category"
                class="mt-2 w-full rounded-2xl border border-white/10 bg-[#0b1524] px-4 py-3 text-sm font-bold text-white outline-none transition focus:border-brand-orange focus:ring-4 focus:ring-brand-orange/10"
              >
                <option
                  v-for="category in normalizedCategories"
                  :key="category.slug"
                  :value="category.slug"
                >
                  {{ category.label || category.name }}
                </option>
              </select>
            </div>

            <div class="flex gap-3">
              <button
                type="button"
                class="inline-flex items-center justify-center gap-2 rounded-2xl bg-brand-orange px-5 py-3 text-sm font-black text-white transition hover:-translate-y-1"
                @click="applyFilters"
              >
                <Filter :size="17" />
                Filtrer
              </button>

              <button
                type="button"
                class="inline-flex items-center justify-center gap-2 rounded-2xl border border-white/10 bg-white/[0.07] px-5 py-3 text-sm font-black text-white/[0.72] transition hover:bg-white/[0.12] hover:text-white"
                @click="resetFilters"
              >
                <X :size="17" />
                Reset
              </button>
            </div>
          </div>
        </div>

        <div class="mt-10 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
          <div>
            <div class="inline-flex items-center gap-2 rounded-2xl bg-emerald-400/10 px-4 py-2 text-xs font-black uppercase tracking-[0.14em] text-emerald-300">
              <Sparkles :size="15" />
              Publications
            </div>

            <h2 class="mt-4 text-4xl font-black tracking-[-0.06em] text-white">
              Derniers articles
            </h2>
          </div>

          <p class="text-sm font-bold text-white/[0.45]">
            {{ totalArticles }} publication(s) trouvée(s)
          </p>
        </div>

        <div v-if="articles.length" class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
          <article
            v-for="article in articles"
            :key="article.id"
            class="group overflow-hidden rounded-[2rem] border border-white/10 bg-white/[0.06] shadow-2xl shadow-black/10 backdrop-blur transition hover:-translate-y-2 hover:border-brand-orange/50 hover:bg-white/[0.09]"
          >
            <Link :href="articleHref(article)" class="block">
              <div class="relative h-64 overflow-hidden bg-[#0b1524]">
                <img
                  v-if="imageUrl(article)"
                  :src="imageUrl(article)"
                  :alt="article.title"
                  class="h-full w-full object-cover opacity-90 transition duration-700 group-hover:scale-105 group-hover:opacity-100"
                />

                <div v-else class="flex h-full w-full items-center justify-center">
                  <div class="text-center">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-brand-orange text-white">
                      <ImageIcon :size="25" />
                    </div>
                    <p class="mt-3 text-sm font-bold text-white/[0.42]">
                      Image à venir
                    </p>
                  </div>
                </div>

                <div class="absolute inset-0 bg-gradient-to-t from-[#07101d] via-transparent to-transparent"></div>

                <div class="absolute left-4 top-4 flex flex-wrap gap-2">
                  <span class="rounded-xl bg-brand-orange px-3 py-1 text-xs font-black text-white">
                    {{ article.category_label || article.category || 'Article' }}
                  </span>

                  <span
                    v-if="article.featured"
                    class="inline-flex items-center gap-1 rounded-xl bg-white px-3 py-1 text-xs font-black text-brand-orange"
                  >
                    <Star :size="13" />
                    Vedette
                  </span>
                </div>
              </div>

              <div class="p-6">
                <div class="flex flex-wrap items-center gap-3 text-xs font-bold text-white/[0.42]">
                  <span class="inline-flex items-center gap-1">
                    <CalendarDays :size="14" />
                    {{ articleDate(article) }}
                  </span>

                  <span class="inline-flex items-center gap-1">
                    <Eye :size="14" />
                    Lecture
                  </span>
                </div>

                <h3 class="mt-4 line-clamp-2 text-2xl font-black leading-tight tracking-[-0.05em] text-white transition group-hover:text-brand-orange">
                  {{ article.title }}
                </h3>

                <p class="mt-4 line-clamp-3 text-sm leading-7 text-white/[0.55]">
                  {{ articleExcerpt(article) }}
                </p>

                <div class="mt-6 inline-flex items-center gap-2 text-sm font-black text-brand-orange">
                  Lire l’article
                  <ChevronRight :size="16" class="transition group-hover:translate-x-1" />
                </div>
              </div>
            </Link>
          </article>
        </div>

        <div v-else class="mt-8 rounded-[2rem] border border-dashed border-white/10 bg-white/[0.04] p-12 text-center">
          <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-brand-orange/15 text-brand-orange">
            <BookOpen :size="32" />
          </div>

          <h3 class="mt-6 text-3xl font-black tracking-[-0.05em] text-white">
            Aucun article trouvé
          </h3>

          <p class="mx-auto mt-3 max-w-xl text-sm leading-7 text-white/[0.52]">
            Les publications apparaîtront ici après leur création et leur publication depuis le dashboard.
          </p>

          <button
            type="button"
            class="mt-6 inline-flex items-center justify-center gap-2 rounded-2xl bg-brand-orange px-5 py-3 text-sm font-black text-white"
            @click="resetFilters"
          >
            Réinitialiser les filtres
            <X :size="17" />
          </button>
        </div>

        <!-- PAGINATION -->
        <div
          v-if="paginationLinks.length > 3"
          class="mt-10 flex flex-wrap justify-center gap-2"
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
                  ? 'bg-white/[0.08] text-white/[0.72] ring-1 ring-white/10 hover:bg-brand-orange hover:text-white'
                  : 'bg-white/[0.04] text-white/[0.25]'
            ]"
            v-html="link.label"
          />
        </div>
      </div>
    </section>

    <!-- VALUE -->
    <section class="border-t border-white/10 px-4 py-16 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-7xl">
        <div class="grid gap-6 lg:grid-cols-3">
          <div class="rounded-[2rem] border border-white/10 bg-white/[0.06] p-7 backdrop-blur">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-orange text-white">
              <Target :size="23" />
            </div>

            <h3 class="mt-6 text-2xl font-black tracking-[-0.05em] text-white">
              Contenu orienté action
            </h3>

            <p class="mt-3 text-sm leading-7 text-white/[0.55]">
              Des conseils applicables pour améliorer votre présence digitale, votre image de marque et vos campagnes.
            </p>
          </div>

          <div class="rounded-[2rem] border border-white/10 bg-white/[0.06] p-7 backdrop-blur">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-orange text-white">
              <TrendingUp :size="23" />
            </div>

            <h3 class="mt-6 text-2xl font-black tracking-[-0.05em] text-white">
              Veille stratégique
            </h3>

            <p class="mt-3 text-sm leading-7 text-white/[0.55]">
              Des tendances suivies et interprétées pour aider les marques à rester pertinentes dans un environnement mouvant.
            </p>
          </div>

          <div class="rounded-[2rem] border border-white/10 bg-white/[0.06] p-7 backdrop-blur">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-orange text-white">
              <CheckCircle2 :size="23" />
            </div>

            <h3 class="mt-6 text-2xl font-black tracking-[-0.05em] text-white">
              Expertise terrain
            </h3>

            <p class="mt-3 text-sm leading-7 text-white/[0.55]">
              Des analyses issues de projets réels en communication, branding, digital, production et événementiel.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="px-4 pb-16 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-7xl">
        <div class="relative overflow-hidden rounded-[2.4rem] bg-brand-orange p-8 text-white shadow-2xl shadow-brand-orange/20 sm:p-10 lg:p-12">
          <div class="absolute -right-16 -top-16 h-64 w-64 rounded-full bg-white/20 blur-3xl"></div>
          <div class="absolute -bottom-20 -left-20 h-72 w-72 rounded-full bg-white/10 blur-3xl"></div>

          <div class="relative grid gap-8 lg:grid-cols-[1fr_auto] lg:items-center">
            <div>
              <div class="inline-flex items-center gap-2 rounded-2xl bg-white/15 px-4 py-2 text-xs font-black uppercase tracking-[0.14em] text-white">
                <MessageCircle :size="15" />
                Besoin d’une stratégie ?
              </div>

              <h2 class="mt-5 max-w-3xl text-4xl font-black leading-tight tracking-[-0.06em] sm:text-5xl">
                Vous voulez transformer vos idées en contenus qui marquent ?
              </h2>

              <p class="mt-4 max-w-2xl text-base leading-7 text-white/[0.82]">
                KOTAVA Communication vous accompagne sur la stratégie, le branding, le digital, l’audiovisuel, l’événementiel et les réseaux sociaux.
              </p>
            </div>

            <div class="flex flex-col gap-3">
              <Link
                href="/contact"
                class="inline-flex items-center justify-center gap-3 rounded-2xl bg-white px-6 py-4 text-sm font-black text-brand-orange transition hover:bg-slate-950 hover:text-white"
              >
                Nous contacter
                <ArrowRight :size="18" />
              </Link>

              <a
                :href="whatsappHref"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex items-center justify-center gap-3 rounded-2xl border border-white/25 bg-white/10 px-6 py-4 text-sm font-black text-white transition hover:bg-white/20"
              >
                WhatsApp direct
                <MessageCircle :size="18" />
              </a>
            </div>
          </div>

          <div class="relative mt-8 flex flex-wrap gap-3 text-sm font-bold text-white/[0.78]">
            <span class="inline-flex items-center gap-2 rounded-2xl bg-white/10 px-4 py-2">
              <Mail :size="16" />
              {{ contactEmail }}
            </span>

            <span class="inline-flex items-center gap-2 rounded-2xl bg-white/10 px-4 py-2">
              <UsersRound :size="16" />
              {{ contactPhoneDisplay }}
            </span>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<style scoped>
.line-clamp-2,
.line-clamp-3 {
  display: -webkit-box;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.line-clamp-2 {
  -webkit-line-clamp: 2;
}

.line-clamp-3 {
  -webkit-line-clamp: 3;
}
</style>