<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import {
  ArrowRight,
  ArrowUpRight,
  BookOpen,
  FileText,
  Layers3,
  Newspaper,
  PenLine,
  Radio,
  Sparkles,
} from 'lucide-vue-next';

const props = defineProps({
  actualites: {
    type: Array,
    default: () => [],
  },
});

const articles = computed(() => props.actualites.slice(0, 3));
const featuredArticle = computed(() => articles.value[0] || null);
const sideArticles = computed(() => articles.value.slice(1, 3));

const articleHref = (article) => {
  if (!article?.slug) {
    return '/blog';
  }

  return `/blog/${article.slug}`;
};
</script>

<template>
  <section class="relative isolate overflow-hidden bg-brand-dark py-20 text-white sm:py-24 lg:py-28">
    <!-- Background cohérent avec le reste -->
    <div class="absolute inset-0 bg-grid-dark opacity-35"></div>

    <div class="absolute inset-0 bg-[radial-gradient(circle_at_8%_18%,rgba(16,185,129,0.17),transparent_28%),radial-gradient(circle_at_92%_76%,rgba(249,115,22,0.14),transparent_28%),radial-gradient(circle_at_50%_48%,rgba(30,58,138,0.34),transparent_34%)]"></div>

    <div class="absolute inset-x-0 top-0 h-40 bg-gradient-to-b from-brand-dark via-brand-dark/90 to-transparent"></div>
    <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-brand-dark via-brand-dark/90 to-transparent"></div>

    <div class="pointer-events-none absolute inset-0 overflow-hidden">
      <div class="absolute inset-x-0 top-[12%] hidden select-none text-center text-[12vw] font-black uppercase leading-none tracking-[-0.09em] text-white/[0.025] lg:block">
        NEWS
      </div>

      <img
        src="/logo.png"
        alt=""
        class="absolute left-[5%] top-[18%] hidden h-24 w-auto opacity-[0.04] lg:block"
      />

      <img
        src="/logo.png"
        alt=""
        class="absolute right-[5%] bottom-[16%] hidden h-28 w-auto opacity-[0.035] lg:block"
      />
    </div>

    <div class="site-container relative z-10">
      <!-- Header -->
      <div class="mb-12 flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
        <div class="max-w-3xl">
          <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald backdrop-blur">
            <BookOpen :size="15" />
            Actualités
          </div>

          <h2 class="mt-5 text-4xl font-black leading-[0.94] tracking-[-0.055em] sm:text-5xl lg:text-6xl">
            Le journal
            <span class="block bg-gradient-to-r from-brand-emerald via-white to-brand-orange bg-clip-text text-transparent">
              de KOTAVA.
            </span>
          </h2>
        </div>

        <Link href="/blog" class="btn-light">
          Voir le blog
          <ArrowRight :size="18" />
        </Link>
      </div>

      <!-- Articles -->
      <div v-if="articles.length" class="grid gap-5 xl:grid-cols-[1.1fr_0.9fr] xl:items-stretch">
        <!-- Article principal -->
        <Link
          v-if="featuredArticle"
          :href="articleHref(featuredArticle)"
          class="group relative min-h-[520px] overflow-hidden rounded-[2.4rem] border border-white/10 bg-white/[0.06] shadow-[0_35px_110px_rgba(0,0,0,0.28)] backdrop-blur-2xl"
        >
          <div class="absolute inset-0">
            <img
              v-if="featuredArticle.image"
              :src="featuredArticle.image"
              :alt="featuredArticle.titre"
              class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
            />

            <div
              v-else
              class="flex h-full w-full items-center justify-center bg-[radial-gradient(circle_at_50%_40%,rgba(16,185,129,0.22),rgba(30,58,138,0.50),rgba(15,23,42,1))]"
            >
              <Newspaper :size="78" class="text-white/30" />
            </div>
          </div>

          <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/45 to-transparent"></div>
          <div class="absolute inset-0 bg-gradient-to-r from-slate-950/70 via-transparent to-transparent"></div>

          <div class="absolute left-6 top-6 flex flex-wrap gap-3">
            <span class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/15 px-4 py-2 text-[11px] font-black uppercase tracking-[0.18em] text-white backdrop-blur-xl">
              <Sparkles :size="14" class="text-brand-emerald" />
              À la une
            </span>

            <span class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-slate-950/35 px-4 py-2 text-[11px] font-black uppercase tracking-[0.18em] text-white/70 backdrop-blur-xl">
              01
            </span>
          </div>

          <div class="absolute right-6 top-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-brand-blue shadow-xl transition group-hover:scale-105">
            <ArrowUpRight :size="24" />
          </div>

          <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-8">
            <div class="max-w-2xl">
              <div class="inline-flex items-center gap-2 rounded-xl bg-brand-emerald px-3 py-2 text-[10px] font-black uppercase tracking-[0.18em] text-white">
                <Radio :size="14" />
                Publication KOTAVA
              </div>

              <h3 class="mt-4 text-3xl font-black leading-tight tracking-[-0.04em] text-white sm:text-4xl lg:text-5xl">
                {{ featuredArticle.titre }}
              </h3>

              <p
                v-if="featuredArticle.extrait"
                class="mt-4 max-w-xl line-clamp-2 text-sm leading-7 text-white/65 sm:text-base"
              >
                {{ featuredArticle.extrait }}
              </p>

              <div class="mt-6 inline-flex items-center gap-2 text-sm font-black text-brand-orange">
                Lire l’article
                <ArrowUpRight :size="18" class="transition group-hover:translate-x-1 group-hover:-translate-y-1" />
              </div>
            </div>
          </div>
        </Link>

        <!-- Articles secondaires + panneau éditorial -->
        <div class="grid gap-5">
          <Link
            v-for="(article, index) in sideArticles"
            :key="article.id"
            :href="articleHref(article)"
            class="group relative min-h-[240px] overflow-hidden rounded-[1.9rem] border border-white/10 bg-white/[0.06] p-3 backdrop-blur-xl transition duration-300 hover:-translate-y-1 hover:bg-white/[0.09]"
          >
            <div class="grid h-full gap-4 sm:grid-cols-[0.92fr_1.08fr]">
              <div class="relative min-h-[190px] overflow-hidden rounded-[1.45rem] bg-slate-950">
                <img
                  v-if="article.image"
                  :src="article.image"
                  :alt="article.titre"
                  class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                />

                <div
                  v-else
                  class="flex h-full w-full items-center justify-center bg-[radial-gradient(circle_at_50%_45%,rgba(16,185,129,0.18),rgba(30,58,138,0.44),rgba(15,23,42,1))]"
                >
                  <BookOpen :size="42" class="text-white/35" />
                </div>

                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/55 to-transparent"></div>
              </div>

              <div class="flex min-w-0 flex-col justify-between p-1">
                <div>
                  <div class="flex items-center justify-between gap-3">
                    <span class="rounded-xl bg-white/10 px-3 py-1.5 text-[10px] font-black uppercase tracking-[0.16em] text-white/45">
                      0{{ index + 2 }}
                    </span>

                    <ArrowUpRight
                      :size="18"
                      class="text-white/35 transition group-hover:translate-x-1 group-hover:-translate-y-1 group-hover:text-brand-orange"
                    />
                  </div>

                  <h3 class="mt-4 line-clamp-2 text-2xl font-black leading-tight text-white">
                    {{ article.titre }}
                  </h3>

                  <p
                    v-if="article.extrait"
                    class="mt-3 line-clamp-2 text-sm leading-6 text-white/55"
                  >
                    {{ article.extrait }}
                  </p>
                </div>

                <div class="mt-4 flex items-center gap-2 text-[11px] font-black uppercase tracking-[0.16em] text-brand-emerald">
                  <FileText :size="14" />
                  Article publié
                </div>
              </div>
            </div>
          </Link>

          <!-- Panneau newsroom -->
          <div class="relative overflow-hidden rounded-[1.9rem] border border-white/10 bg-white/[0.06] p-5 backdrop-blur-xl">
            <div class="absolute -right-14 -top-14 h-44 w-44 rounded-[3rem] bg-brand-orange/20 blur-3xl"></div>
            <div class="absolute -bottom-14 -left-14 h-44 w-44 rounded-[3rem] bg-brand-emerald/20 blur-3xl"></div>

            <div class="relative">
              <div class="flex items-start justify-between gap-4">
                <div>
                  <div class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-3 py-2 text-[11px] font-black uppercase tracking-[0.16em] text-brand-emerald">
                    <PenLine :size="14" />
                    Newsroom
                  </div>

                  <h3 class="mt-4 text-2xl font-black tracking-[-0.035em] text-white">
                    Idées, tendances et coulisses.
                  </h3>
                </div>

                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-brand-orange text-white shadow-lg">
                  <Layers3 :size="22" />
                </div>
              </div>

              <div class="mt-5 grid grid-cols-3 gap-3">
                <div class="rounded-2xl bg-white/10 p-4">
                  <BookOpen :size="18" class="text-brand-emerald" />
                  <div class="mt-4 text-xl font-black text-white">
                    {{ actualites.length }}
                  </div>
                  <div class="mt-1 text-[10px] font-black uppercase tracking-[0.14em] text-white/40">
                    Articles
                  </div>
                </div>

                <div class="rounded-2xl bg-white/10 p-4">
                  <Radio :size="18" class="text-brand-orange" />
                  <div class="mt-4 text-xl font-black text-white">
                    Live
                  </div>
                  <div class="mt-1 text-[10px] font-black uppercase tracking-[0.14em] text-white/40">
                    Actu
                  </div>
                </div>

                <div class="rounded-2xl bg-white/10 p-4">
                  <Newspaper :size="18" class="text-brand-blue" />
                  <div class="mt-4 text-xl font-black text-white">
                    KTV
                  </div>
                  <div class="mt-1 text-[10px] font-black uppercase tracking-[0.14em] text-white/40">
                    Média
                  </div>
                </div>
              </div>

              <Link
                href="/blog"
                class="mt-5 inline-flex w-full items-center justify-center gap-2 rounded-[1.15rem] bg-white px-5 py-3 text-sm font-black text-brand-blue transition hover:-translate-y-0.5"
              >
                Explorer le blog
                <ArrowRight :size="18" />
              </Link>
            </div>
          </div>
        </div>
      </div>

      <!-- État vide propre -->
      <div
        v-else
        class="relative overflow-hidden rounded-[2.4rem] border border-white/10 bg-white/[0.06] p-8 text-center shadow-[0_35px_110px_rgba(0,0,0,0.25)] backdrop-blur-2xl"
      >
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_20%,rgba(16,185,129,0.14),transparent_34%),radial-gradient(circle_at_80%_80%,rgba(249,115,22,0.12),transparent_32%)]"></div>

        <div class="relative mx-auto max-w-2xl">
          <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-[1.7rem] bg-white/10 text-brand-emerald">
            <BookOpen :size="36" />
          </div>

          <h3 class="mt-6 text-3xl font-black text-white">
            Les actualités arrivent bientôt.
          </h3>

          <p class="mt-3 text-sm leading-7 text-white/60">
            Les publications ajoutées depuis l’administration apparaîtront automatiquement ici.
          </p>

          <Link href="/blog" class="btn-light mt-7">
            Voir le blog
            <ArrowRight :size="18" />
          </Link>
        </div>
      </div>
    </div>
  </section>
</template>
