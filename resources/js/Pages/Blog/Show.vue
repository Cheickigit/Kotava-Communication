<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {
  ArrowLeft,
  ArrowRight,
  BookOpen,
  CalendarDays,
  CheckCircle2,
  ChevronRight,
  Clock3,
  Eye,
  FileText,
  Image as ImageIcon,
  Mail,
  MessageCircle,
  Newspaper,
  Phone,
  Quote,
  Share2,
  Sparkles,
  Star,
  Tag,
  Target,
} from 'lucide-vue-next';
import { computed, ref } from 'vue';

defineOptions({ layout: GuestLayout });

const props = defineProps({
  actualite: {
    type: Object,
    required: true,
  },
  relatedActualites: {
    type: Array,
    default: () => [],
  },
  recentActualites: {
    type: Array,
    default: () => [],
  },
  prevActualite: {
    type: Object,
    default: null,
  },
  nextActualite: {
    type: Object,
    default: null,
  },
  meta: {
    type: Object,
    default: () => ({}),
  },
});

const copied = ref(false);

const contactEmail = 'Contact@kotavacom.com';
const contactPhoneDisplay = '+229 93 37 49 63';
const contactPhoneHref = 'tel:+22993374963';
const whatsappHref = 'https://wa.me/22993374963';

const title = computed(() => props.actualite?.title || props.actualite?.titre || 'Article KOTAVA');

const pageTitle = computed(() =>
  props.meta?.title || `${title.value} - KOTAVA Communication`
);

const pageDescription = computed(() =>
  props.meta?.description ||
  props.actualite?.extrait ||
  props.actualite?.summary ||
  'Découvrez cet article de KOTAVA Communication.'
);

const coverImage = computed(() => props.actualite?.image_url || props.actualite?.image || null);

const content = computed(() =>
  props.actualite?.content ||
  props.actualite?.description ||
  ''
);

const hasHtmlContent = computed(() => /<\/?[a-z][\s\S]*>/i.test(content.value));

const articleDate = computed(() =>
  props.actualite?.date_publication_display ||
  props.actualite?.created_at ||
  'Date non spécifiée'
);

const categoryLabel = computed(() =>
  props.actualite?.category_label ||
  props.actualite?.category ||
  'Article'
);

const readingTime = computed(() => {
  const cleanText = String(content.value || '')
    .replace(/<[^>]*>/g, ' ')
    .replace(/\s+/g, ' ')
    .trim();

  const words = cleanText ? cleanText.split(' ').length : 0;
  const minutes = Math.max(1, Math.ceil(words / 220));

  return `${minutes} min`;
});

const articleHref = (article) => article?.url || (article?.slug ? `/blog/${article.slug}` : '/blog');

const articleImage = (article) => article?.image_url || article?.image || null;

const articleExcerpt = (article) => {
  return article?.extrait || article?.summary || article?.description || article?.content || '';
};

const articleDateDisplay = (article) => {
  return article?.date_publication_display || article?.created_at || 'Date non spécifiée';
};

const share = async () => {
  const url = typeof window !== 'undefined' ? window.location.href : '';

  try {
    if (navigator?.share) {
      await navigator.share({
        title: title.value,
        text: pageDescription.value,
        url,
      });

      return;
    }
  } catch (_) {}

  try {
    await navigator.clipboard.writeText(url);
    copied.value = true;

    setTimeout(() => {
      copied.value = false;
    }, 1800);
  } catch (_) {
    prompt('Copiez le lien :', url);
  }
};
</script>

<template>
  <Head :title="pageTitle">
    <meta name="description" :content="pageDescription" />
    <meta property="og:title" :content="pageTitle" />
    <meta property="og:description" :content="pageDescription" />
    <meta property="og:type" content="article" />
    <meta v-if="meta?.image" property="og:image" :content="meta.image" />
    <meta v-if="meta?.url" property="og:url" :content="meta.url" />
  </Head>

  <main class="overflow-hidden bg-[#07101d] text-white">
    <!-- HERO -->
    <section class="relative isolate px-4 pb-12 pt-10 sm:px-6 lg:px-8 lg:pb-16">
      <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_15%_15%,rgba(249,115,22,0.24),transparent_28%),radial-gradient(circle_at_88%_8%,rgba(16,185,129,0.16),transparent_30%),linear-gradient(135deg,#07101d_0%,#10235f_48%,#06131f_100%)]"></div>
      <div class="absolute inset-0 -z-10 bg-[linear-gradient(rgba(255,255,255,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.04)_1px,transparent_1px)] bg-[size:42px_42px] opacity-40"></div>

      <div class="mx-auto max-w-7xl">
        <div class="flex flex-wrap items-center justify-between gap-4">
          <Link
            href="/blog"
            class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-3 text-sm font-black text-white/[0.72] backdrop-blur transition hover:bg-white/[0.12] hover:text-white"
          >
            <ArrowLeft :size="18" />
            Retour au blog
          </Link>

          <button
            type="button"
            class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-3 text-sm font-black text-white/[0.72] backdrop-blur transition hover:bg-white/[0.12] hover:text-white"
            @click="share"
          >
            <Share2 :size="18" />
            {{ copied ? 'Lien copié' : 'Partager' }}
          </button>
        </div>

        <div class="mt-10 grid gap-8 lg:grid-cols-[0.95fr_1.05fr] lg:items-end">
          <div>
            <div class="flex flex-wrap items-center gap-3">
              <span class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-xs font-black uppercase tracking-[0.14em] text-white/[0.72]">
                <Tag :size="14" class="text-brand-orange" />
                {{ categoryLabel }}
              </span>

              <span
                v-if="actualite?.featured"
                class="inline-flex items-center gap-2 rounded-2xl bg-brand-orange px-4 py-2 text-xs font-black uppercase tracking-[0.14em] text-white"
              >
                <Star :size="14" />
                En vedette
              </span>
            </div>

            <h1 class="mt-6 max-w-4xl text-4xl font-black leading-[0.95] tracking-[-0.07em] text-white sm:text-5xl lg:text-6xl">
              {{ title }}
            </h1>

            <p v-if="actualite?.extrait || actualite?.summary" class="mt-6 max-w-3xl text-base leading-8 text-white/[0.62] sm:text-lg">
              {{ actualite.extrait || actualite.summary }}
            </p>

            <div class="mt-8 flex flex-wrap gap-3">
              <span class="inline-flex items-center gap-2 rounded-2xl bg-white/[0.08] px-4 py-3 text-sm font-bold text-white/[0.76] ring-1 ring-white/10">
                <CalendarDays :size="17" />
                {{ articleDate }}
              </span>

              <span class="inline-flex items-center gap-2 rounded-2xl bg-white/[0.08] px-4 py-3 text-sm font-bold text-white/[0.76] ring-1 ring-white/10">
                <Clock3 :size="17" />
                {{ readingTime }} de lecture
              </span>

              <span class="inline-flex items-center gap-2 rounded-2xl bg-white/[0.08] px-4 py-3 text-sm font-bold text-white/[0.76] ring-1 ring-white/10">
                <BookOpen :size="17" />
                Publication KOTAVA
              </span>
            </div>
          </div>

          <div class="relative">
            <div class="absolute -inset-5 rounded-[2.5rem] bg-brand-orange/20 blur-3xl"></div>

            <div class="relative overflow-hidden rounded-[2.3rem] border border-white/10 bg-white/[0.08] p-3 shadow-2xl shadow-black/20 backdrop-blur-xl">
              <div class="relative h-[22rem] overflow-hidden rounded-[1.8rem] bg-[#0b1524] sm:h-[26rem] lg:h-[30rem]">
                <img
                  v-if="coverImage"
                  :src="coverImage"
                  :alt="title"
                  class="absolute inset-0 h-full w-full object-cover opacity-90"
                />

                <div v-else class="absolute inset-0 flex items-center justify-center bg-[radial-gradient(circle_at_30%_20%,rgba(249,115,22,0.20),transparent_32%),linear-gradient(135deg,#0f172a,#07101d)]">
                  <div class="text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-brand-orange text-white">
                      <ImageIcon :size="28" />
                    </div>

                    <p class="mt-4 text-sm font-bold text-white/[0.42]">
                      Visuel à venir
                    </p>
                  </div>
                </div>

                <div class="absolute inset-0 bg-gradient-to-t from-[#07101d] via-[#07101d]/15 to-transparent"></div>

                <div class="absolute bottom-5 left-5 right-5">
                  <div class="rounded-2xl border border-white/10 bg-white/[0.08] p-4 backdrop-blur-xl">
                    <p class="text-xs font-black uppercase tracking-[0.14em] text-white/[0.42]">
                      Article
                    </p>

                    <div class="mt-3 grid gap-3 sm:grid-cols-2">
                      <div class="rounded-xl bg-white/[0.07] px-3 py-2">
                        <p class="text-[0.65rem] font-black uppercase tracking-[0.12em] text-white/[0.35]">
                          Catégorie
                        </p>
                        <p class="mt-1 truncate text-sm font-black text-white">
                          {{ categoryLabel }}
                        </p>
                      </div>

                      <div class="rounded-xl bg-white/[0.07] px-3 py-2">
                        <p class="text-[0.65rem] font-black uppercase tracking-[0.12em] text-white/[0.35]">
                          Lecture
                        </p>
                        <p class="mt-1 truncate text-sm font-black text-white">
                          {{ readingTime }}
                        </p>
                      </div>

                      <div class="rounded-xl bg-white/[0.07] px-3 py-2">
                        <p class="text-[0.65rem] font-black uppercase tracking-[0.12em] text-white/[0.35]">
                          Date
                        </p>
                        <p class="mt-1 truncate text-sm font-black text-white">
                          {{ articleDate }}
                        </p>
                      </div>

                      <div class="rounded-xl bg-white/[0.07] px-3 py-2">
                        <p class="text-[0.65rem] font-black uppercase tracking-[0.12em] text-white/[0.35]">
                          Source
                        </p>
                        <p class="mt-1 truncate text-sm font-black text-white">
                          KOTAVA
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CONTENT -->
    <section class="relative border-t border-white/10 px-4 py-14 sm:px-6 lg:px-8">
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_10%_18%,rgba(16,185,129,0.10),transparent_25%),radial-gradient(circle_at_90%_40%,rgba(249,115,22,0.10),transparent_28%)]"></div>

      <div class="relative mx-auto grid max-w-7xl gap-8 lg:grid-cols-[1fr_380px]">
        <div class="space-y-6">
          <article class="rounded-[2rem] border border-white/10 bg-white/[0.06] p-6 shadow-2xl shadow-black/10 backdrop-blur sm:p-9">
            <div class="mb-8 flex items-center gap-3">
              <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-orange text-white">
                <Newspaper :size="22" />
              </div>

              <div>
                <p class="text-xs font-black uppercase tracking-[0.16em] text-brand-orange">
                  Lecture
                </p>
                <h2 class="text-2xl font-black tracking-[-0.05em] text-white">
                  Contenu de l’article
                </h2>
              </div>
            </div>

            <div
              v-if="content && hasHtmlContent"
              class="article-content"
              v-html="content"
            ></div>

            <div
              v-else-if="content"
              class="whitespace-pre-line text-base leading-8 text-white/[0.68]"
            >
              {{ content }}
            </div>

            <div v-else class="rounded-2xl border border-dashed border-white/10 bg-white/[0.04] p-8 text-center">
              <BookOpen :size="34" class="mx-auto text-brand-orange" />
              <p class="mt-4 text-sm font-bold text-white/[0.50]">
                Contenu indisponible.
              </p>
            </div>
          </article>

          <article
            v-if="actualite?.extrait"
            class="relative overflow-hidden rounded-[2rem] border border-brand-orange/25 bg-brand-orange p-6 text-white shadow-2xl shadow-brand-orange/20 sm:p-9"
          >
            <div class="absolute -right-10 -top-10 h-44 w-44 rounded-full bg-white/20 blur-3xl"></div>

            <div class="relative">
              <Quote :size="42" class="text-white" />

              <p class="mt-5 text-xl font-semibold leading-9 text-white/[0.90]">
                {{ actualite.extrait }}
              </p>
            </div>
          </article>

          <div class="rounded-[2rem] border border-white/10 bg-white/[0.06] p-5 shadow-2xl shadow-black/10 backdrop-blur">
            <div class="grid gap-4 sm:grid-cols-2">
              <Link
                v-if="prevActualite?.slug"
                :href="articleHref(prevActualite)"
                class="group rounded-2xl border border-white/10 bg-white/[0.045] p-5 transition hover:border-brand-orange/50 hover:bg-white/[0.08]"
              >
                <div class="flex items-center gap-2 text-xs font-black uppercase tracking-[0.14em] text-white/[0.38]">
                  <ArrowLeft :size="15" />
                  Article précédent
                </div>

                <div class="mt-3 line-clamp-2 text-lg font-black text-white group-hover:text-brand-orange">
                  {{ prevActualite.title }}
                </div>
              </Link>

              <Link
                v-if="nextActualite?.slug"
                :href="articleHref(nextActualite)"
                class="group rounded-2xl border border-white/10 bg-white/[0.045] p-5 text-right transition hover:border-brand-orange/50 hover:bg-white/[0.08]"
              >
                <div class="flex items-center justify-end gap-2 text-xs font-black uppercase tracking-[0.14em] text-white/[0.38]">
                  Article suivant
                  <ArrowRight :size="15" />
                </div>

                <div class="mt-3 line-clamp-2 text-lg font-black text-white group-hover:text-brand-orange">
                  {{ nextActualite.title }}
                </div>
              </Link>
            </div>
          </div>
        </div>

        <!-- ASIDE -->
        <aside class="space-y-6 lg:sticky lg:top-24 lg:self-start">
          <div class="rounded-[2rem] border border-white/10 bg-white/[0.06] p-6 shadow-2xl shadow-black/10 backdrop-blur">
            <h3 class="text-xl font-black tracking-[-0.04em] text-white">
              Informations
            </h3>

            <div class="mt-6 space-y-3">
              <div class="flex items-center justify-between gap-4 rounded-2xl bg-white/[0.045] px-4 py-3">
                <span class="inline-flex items-center gap-2 text-sm font-bold text-white/[0.45]">
                  <CalendarDays :size="16" />
                  Date
                </span>

                <span class="max-w-[11rem] truncate text-right text-sm font-black text-white">
                  {{ articleDate }}
                </span>
              </div>

              <div class="flex items-center justify-between gap-4 rounded-2xl bg-white/[0.045] px-4 py-3">
                <span class="inline-flex items-center gap-2 text-sm font-bold text-white/[0.45]">
                  <Tag :size="16" />
                  Catégorie
                </span>

                <span class="max-w-[11rem] truncate text-right text-sm font-black text-white">
                  {{ categoryLabel }}
                </span>
              </div>

              <div class="flex items-center justify-between gap-4 rounded-2xl bg-white/[0.045] px-4 py-3">
                <span class="inline-flex items-center gap-2 text-sm font-bold text-white/[0.45]">
                  <Clock3 :size="16" />
                  Lecture
                </span>

                <span class="max-w-[11rem] truncate text-right text-sm font-black text-white">
                  {{ readingTime }}
                </span>
              </div>

              <div
                v-if="actualite?.featured"
                class="flex items-center justify-between gap-4 rounded-2xl bg-brand-orange/10 px-4 py-3"
              >
                <span class="inline-flex items-center gap-2 text-sm font-bold text-brand-orange">
                  <Star :size="16" />
                  Statut
                </span>

                <span class="text-right text-sm font-black text-brand-orange">
                  En vedette
                </span>
              </div>
            </div>

            <button
              type="button"
              class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-5 py-3 text-sm font-black text-white/[0.76] transition hover:bg-white/[0.12] hover:text-white"
              @click="share"
            >
              <Share2 :size="17" />
              {{ copied ? 'Lien copié' : 'Partager l’article' }}
            </button>
          </div>

          <div
            v-if="relatedActualites?.length"
            class="rounded-[2rem] border border-white/10 bg-white/[0.06] p-6 shadow-2xl shadow-black/10 backdrop-blur"
          >
            <div class="flex items-center justify-between gap-4">
              <h3 class="text-xl font-black tracking-[-0.04em] text-white">
                Articles similaires
              </h3>

              <Link href="/blog" class="text-sm font-black text-brand-orange">
                Tout voir
              </Link>
            </div>

            <div class="mt-5 space-y-4">
              <Link
                v-for="article in relatedActualites"
                :key="article.id"
                :href="articleHref(article)"
                class="group block overflow-hidden rounded-2xl border border-white/10 bg-white/[0.045] transition hover:border-brand-orange/50 hover:bg-white/[0.08]"
              >
                <div class="flex gap-4 p-4">
                  <div class="h-16 w-16 shrink-0 overflow-hidden rounded-xl bg-[#0b1524]">
                    <img
                      v-if="articleImage(article)"
                      :src="articleImage(article)"
                      :alt="article.title"
                      class="h-full w-full object-cover"
                    />

                    <div v-else class="flex h-full w-full items-center justify-center text-white/[0.25]">
                      <ImageIcon :size="18" />
                    </div>
                  </div>

                  <div class="min-w-0">
                    <p class="text-xs font-black uppercase tracking-[0.12em] text-white/[0.35]">
                      {{ article.category_label || article.category || 'Article' }}
                    </p>

                    <h4 class="mt-1 line-clamp-2 text-sm font-black leading-5 text-white group-hover:text-brand-orange">
                      {{ article.title }}
                    </h4>

                    <p class="mt-1 text-xs font-bold text-white/[0.35]">
                      {{ articleDateDisplay(article) }}
                    </p>
                  </div>
                </div>
              </Link>
            </div>
          </div>

          <div
            v-if="recentActualites?.length"
            class="rounded-[2rem] border border-white/10 bg-white/[0.06] p-6 shadow-2xl shadow-black/10 backdrop-blur"
          >
            <h3 class="text-xl font-black tracking-[-0.04em] text-white">
              Dernières publications
            </h3>

            <div class="mt-5 space-y-3">
              <Link
                v-for="article in recentActualites"
                :key="article.id"
                :href="articleHref(article)"
                class="group block rounded-2xl border border-white/10 bg-white/[0.045] p-4 transition hover:border-brand-orange/50 hover:bg-white/[0.08]"
              >
                <p class="text-xs font-black uppercase tracking-[0.12em] text-white/[0.35]">
                  {{ articleDateDisplay(article) }}
                </p>

                <h4 class="mt-2 line-clamp-2 text-sm font-black leading-5 text-white group-hover:text-brand-orange">
                  {{ article.title }}
                </h4>
              </Link>
            </div>
          </div>

          <div class="rounded-[2rem] bg-brand-orange p-6 text-white shadow-2xl shadow-brand-orange/20">
            <h3 class="text-xl font-black tracking-[-0.04em]">
              Besoin d’une stratégie ?
            </h3>

            <p class="mt-3 text-sm leading-6 text-white/[0.82]">
              Parlons de votre image, de vos contenus et de vos objectifs de communication.
            </p>

            <div class="mt-6 space-y-3">
              <Link
                href="/contact"
                class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-white px-5 py-3 text-sm font-black text-brand-orange transition hover:bg-slate-950 hover:text-white"
              >
                <Mail :size="17" />
                Nous contacter
              </Link>

              <a
                :href="contactPhoneHref"
                class="inline-flex w-full items-center justify-center gap-2 rounded-2xl border border-white/30 bg-white/10 px-5 py-3 text-sm font-black text-white transition hover:bg-white/20"
              >
                <Phone :size="17" />
                {{ contactPhoneDisplay }}
              </a>

              <a
                :href="whatsappHref"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex w-full items-center justify-center gap-2 rounded-2xl border border-white/30 bg-white/10 px-5 py-3 text-sm font-black text-white transition hover:bg-white/20"
              >
                <MessageCircle :size="17" />
                WhatsApp direct
              </a>
            </div>

            <p class="mt-5 text-center text-xs font-bold text-white/[0.72]">
              {{ contactEmail }}
            </p>
          </div>
        </aside>
      </div>
    </section>
  </main>
</template>

<style scoped>
.article-content {
  color: rgba(255, 255, 255, 0.68);
  font-size: 1rem;
  line-height: 2rem;
}

.article-content :deep(h1),
.article-content :deep(h2),
.article-content :deep(h3),
.article-content :deep(h4) {
  color: #ffffff;
  font-weight: 900;
  letter-spacing: -0.04em;
  line-height: 1.15;
  margin-bottom: 1rem;
  margin-top: 2rem;
}

.article-content :deep(h1) {
  font-size: 2.4rem;
}

.article-content :deep(h2) {
  font-size: 2rem;
}

.article-content :deep(h3) {
  font-size: 1.5rem;
}

.article-content :deep(p) {
  margin-bottom: 1.25rem;
}

.article-content :deep(a) {
  color: #f97316;
  font-weight: 800;
  text-decoration: underline;
  text-underline-offset: 4px;
}

.article-content :deep(ul),
.article-content :deep(ol) {
  margin-bottom: 1.25rem;
  margin-left: 1.5rem;
}

.article-content :deep(ul) {
  list-style: disc;
}

.article-content :deep(ol) {
  list-style: decimal;
}

.article-content :deep(li) {
  margin-bottom: 0.55rem;
}

.article-content :deep(blockquote) {
  border-left: 4px solid #f97316;
  background: rgba(255, 255, 255, 0.06);
  border-radius: 1rem;
  color: rgba(255, 255, 255, 0.82);
  font-weight: 700;
  margin: 1.5rem 0;
  padding: 1rem 1.25rem;
}

.article-content :deep(img) {
  border-radius: 1.5rem;
  margin: 1.5rem 0;
  width: 100%;
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>