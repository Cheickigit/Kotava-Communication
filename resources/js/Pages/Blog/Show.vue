<script setup>
import { Head, Link } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import {
  ArrowLeft,
  Calendar,
  Tag,
  Share2,
  Clock,
  BookOpen,
  Sparkles,
} from "lucide-vue-next";

defineOptions({ layout: GuestLayout });

const props = defineProps({
  actualite: {
    type: Object,
    required: true,
  },
});

const formatDate = (dateString) => {
  if (!dateString) return "Date non spécifiée";
  const date = new Date(dateString);
  return date.toLocaleDateString("fr-FR", {
    day: "numeric",
    month: "long",
    year: "numeric",
  });
};

const readingTime = (text) => {
  const t = String(text ?? "").replace(/<[^>]*>/g, " ").trim();
  const words = t ? t.split(/\s+/).length : 0;
  const minutes = Math.max(1, Math.round(words / 200));
  return `${minutes} min`;
};

const share = async () => {
  const url = typeof window !== "undefined" ? window.location.href : "";
  const title = props.actualite?.title ?? "Article";

  try {
    if (navigator?.share) {
      await navigator.share({ title, url });
      return;
    }
  } catch (_) {}

  try {
    await navigator.clipboard.writeText(url);
    alert("Lien copié !");
  } catch (_) {
    // fallback minimal
    prompt("Copie le lien :", url);
  }
};
</script>

<template>
  <GuestLayout>
    <Head :title="(actualite?.title ?? 'Article') + ' - KOTAVA Communication'" />

    <div class="min-h-screen bg-slate-50">
      <!-- Hero -->
      <section class="relative overflow-hidden">
        <div class="absolute inset-0">
          <div class="absolute inset-0 bg-gradient-to-br from-[#0e437d] via-[#1a6ca3] to-[#22ae84]" />
          <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-black/20 to-slate-50" />
        </div>

        <div class="relative max-w-6xl mx-auto px-6 pt-10 pb-14">
          <div class="flex items-center justify-between gap-4">
            <Link
              href="/blog"
              class="inline-flex items-center gap-2 rounded-xl bg-white/10 backdrop-blur-md px-4 py-2 text-white border border-white/20 hover:bg-white/15 transition"
            >
              <ArrowLeft :size="18" />
              <span class="text-sm font-semibold">Retour au blog</span>
            </Link>

            <button
              type="button"
              @click="share"
              class="inline-flex items-center gap-2 rounded-xl bg-white/10 backdrop-blur-md px-4 py-2 text-white border border-white/20 hover:bg-white/15 transition"
            >
              <Share2 :size="18" />
              <span class="text-sm font-semibold">Partager</span>
            </button>
          </div>

          <div class="mt-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/15 backdrop-blur-md text-white text-sm font-semibold border border-white/20">
              <Sparkles :size="14" />
              <span>{{ actualite?.category || "Article" }}</span>
            </div>

            <h1 class="mt-6 text-4xl md:text-6xl font-bold text-white leading-tight">
              {{ actualite?.title }}
            </h1>

            <div class="mt-6 flex flex-wrap items-center gap-3 text-white/90">
              <span class="inline-flex items-center gap-2 rounded-full bg-white/10 border border-white/15 px-4 py-2 text-sm">
                <Calendar :size="16" />
                {{ formatDate(actualite?.date_publication) }}
              </span>

              <span class="inline-flex items-center gap-2 rounded-full bg-white/10 border border-white/15 px-4 py-2 text-sm">
                <Clock :size="16" />
                {{ readingTime(actualite?.content) }}
              </span>

              <span v-if="actualite?.featured" class="inline-flex items-center gap-2 rounded-full bg-[#FFD166]/15 border border-[#FFD166]/30 px-4 py-2 text-sm text-[#FFD166]">
                <BookOpen :size="16" />
                En vedette
              </span>

              <span v-if="actualite?.tags" class="inline-flex items-center gap-2 rounded-full bg-white/10 border border-white/15 px-4 py-2 text-sm">
                <Tag :size="16" />
                {{ actualite?.tags }}
              </span>
            </div>

            <p v-if="actualite?.extrait" class="mt-8 max-w-3xl text-lg md:text-xl text-white/90 leading-relaxed">
              {{ actualite.extrait }}
            </p>
          </div>
        </div>
      </section>

      <!-- Cover -->
      <section v-if="actualite?.image" class="-mt-10">
        <div class="max-w-6xl mx-auto px-6">
          <div class="rounded-3xl overflow-hidden border border-slate-200 bg-white shadow-xl">
            <div class="relative h-64 sm:h-80 md:h-[420px]">
              <img
                :src="actualite.image"
                :alt="actualite?.title"
                class="absolute inset-0 w-full h-full object-cover"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent" />
            </div>
          </div>
        </div>
      </section>

      <!-- Content -->
      <section class="py-12">
        <div class="max-w-6xl mx-auto px-6">
          <div class="grid lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8">
              <article class="rounded-3xl border border-slate-200 bg-white shadow-sm p-6 sm:p-10">
                <div
                  v-if="actualite?.content"
                  class="prose prose-slate max-w-none"
                  v-html="actualite.content"
                />
                <div v-else class="text-slate-600">
                  Contenu indisponible.
                </div>

                <div class="mt-10 pt-8 border-t border-slate-200 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
                  <Link
                    href="/blog"
                    class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3 text-sm font-semibold border border-slate-200 bg-white hover:bg-slate-50 transition"
                  >
                    <ArrowLeft :size="18" />
                    Retour aux articles
                  </Link>

                  <button
                    type="button"
                    @click="share"
                    class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3 text-sm font-semibold bg-gradient-to-r from-[#0e437d] to-[#22ae84] text-white hover:shadow-lg transition"
                  >
                    <Share2 :size="18" />
                    Partager
                  </button>
                </div>
              </article>
            </div>

            <!-- Aside -->
            <aside class="lg:col-span-4">
              <div class="sticky top-6 space-y-6">
                <div class="rounded-3xl border border-slate-200 bg-white shadow-sm p-6">
                  <div class="text-sm font-semibold text-slate-900">Informations</div>
                  <div class="mt-4 space-y-3 text-sm text-slate-700">
                    <div class="flex items-center justify-between gap-3">
                      <span class="text-slate-500">Date</span>
                      <span class="font-medium">{{ formatDate(actualite?.date_publication) }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-3">
                      <span class="text-slate-500">Catégorie</span>
                      <span class="font-medium">{{ actualite?.category || "Article" }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-3">
                      <span class="text-slate-500">Lecture</span>
                      <span class="font-medium">{{ readingTime(actualite?.content) }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-3" v-if="actualite?.featured">
                      <span class="text-slate-500">Statut</span>
                      <span class="font-medium text-emerald-700">En vedette</span>
                    </div>
                  </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-[#0e437d] to-[#22ae84] text-white shadow-sm p-6">
                  <div class="text-sm font-semibold">Besoin d’aide sur votre communication ?</div>
                  <p class="mt-3 text-white/90 text-sm leading-relaxed">
                    Parlons de votre projet. Nous répondons rapidement et proposons une stratégie sur-mesure.
                  </p>
                  <Link
                    :href="route('contact')"
                    class="mt-5 inline-flex items-center justify-center w-full rounded-xl bg-white text-[#0e437d] px-5 py-3 text-sm font-semibold hover:bg-slate-100 transition"
                  >
                    Nous contacter
                  </Link>
                </div>
              </div>
            </aside>
          </div>
        </div>
      </section>
    </div>
  </GuestLayout>
</template>
