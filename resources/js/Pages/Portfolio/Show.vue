<script setup>
import { Head, Link } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import {
  ArrowLeft,
  Calendar,
  MapPin,
  Briefcase,
  Tag,
  Share2,
  ChevronRight,
  Sparkles,
  Image as ImageIcon,
  CheckCircle2,
} from "lucide-vue-next";

defineOptions({ layout: GuestLayout });

const props = defineProps({
  realisation: { type: Object, required: true },
  relatedProjects: { type: Array, default: () => [] },
  nextProject: { type: Object, default: null },
  prevProject: { type: Object, default: null },
  gallery: { type: Array, default: () => [] },
  meta: { type: Object, default: () => ({}) },
});

const title = props.realisation?.title ?? "Projet";
const share = async () => {
  const url = typeof window !== "undefined" ? window.location.href : "";
  const t = title;

  try {
    if (navigator?.share) {
      await navigator.share({ title: t, url });
      return;
    }
  } catch (_) {}

  try {
    await navigator.clipboard.writeText(url);
    alert("Lien copié !");
  } catch (_) {
    prompt("Copie le lien :", url);
  }
};

const normalizeGallery = (items) => {
  const arr = Array.isArray(items) ? items : [];
  return arr
    .map((it) => {
      if (!it) return null;
      if (typeof it === "string") return { url: it };
      if (typeof it === "object") {
        return {
          url: it.url ?? it.src ?? it.path ?? it.image ?? it.original ?? null,
          alt: it.alt ?? it.caption ?? it.title ?? "",
        };
      }
      return null;
    })
    .filter((x) => x?.url);
};

const galleryItems = normalizeGallery(props.gallery);

// champs texte: peuvent être du HTML
const textOrEmpty = (v) => String(v ?? "").trim();
const hasHtml = (s) => /<[^>]+>/.test(String(s ?? ""));
</script>

<template>
  <GuestLayout>
    <Head :title="(meta?.title ?? (title + ' - KOTAVA Communication'))" />

    <div class="min-h-screen bg-slate-50">
      <!-- HERO -->
      <section class="relative overflow-hidden">
        <div class="absolute inset-0">
          <div class="absolute inset-0 bg-gradient-to-br from-[#0e437d] via-[#1a6ca3] to-[#22ae84]" />
          <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-black/15 to-slate-50" />
        </div>

        <div class="relative max-w-6xl mx-auto px-6 pt-10 pb-14">
          <div class="flex items-center justify-between gap-4">
            <Link
              href="/portfolio"
              class="inline-flex items-center gap-2 rounded-xl bg-white/10 backdrop-blur-md px-4 py-2 text-white border border-white/20 hover:bg-white/15 transition"
            >
              <ArrowLeft :size="18" />
              <span class="text-sm font-semibold">Retour au portfolio</span>
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
            <div class="flex flex-wrap items-center gap-3">
              <span
                v-if="realisation?.category"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/15 backdrop-blur-md text-white text-sm font-semibold border border-white/20"
              >
                <Tag :size="14" />
                {{ realisation.category }}
              </span>

              <span
                v-if="realisation?.featured"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#FFD166]/15 border border-[#FFD166]/30 text-[#FFD166] text-sm font-semibold"
              >
                <Sparkles :size="14" />
                Projet en vedette
              </span>
            </div>

            <h1 class="mt-6 text-4xl md:text-6xl font-bold text-white leading-tight">
              {{ realisation?.title }}
            </h1>

            <p v-if="realisation?.summary" class="mt-6 max-w-3xl text-lg md:text-xl text-white/90 leading-relaxed">
              {{ realisation.summary }}
            </p>

            <div class="mt-8 flex flex-wrap items-center gap-3 text-white/90">
              <span
                v-if="realisation?.client"
                class="inline-flex items-center gap-2 rounded-full bg-white/10 border border-white/15 px-4 py-2 text-sm"
              >
                <Briefcase :size="16" />
                {{ realisation.client }}
              </span>

              <span
                v-if="realisation?.completion_date"
                class="inline-flex items-center gap-2 rounded-full bg-white/10 border border-white/15 px-4 py-2 text-sm"
              >
                <Calendar :size="16" />
                {{ realisation.completion_date }}
              </span>

              <span
                v-if="realisation?.country"
                class="inline-flex items-center gap-2 rounded-full bg-white/10 border border-white/15 px-4 py-2 text-sm"
              >
                <MapPin :size="16" />
                {{ realisation.country }}
              </span>

              <span
                v-if="realisation?.type"
                class="inline-flex items-center gap-2 rounded-full bg-white/10 border border-white/15 px-4 py-2 text-sm"
              >
                <Tag :size="16" />
                {{ realisation.type }}
              </span>
            </div>
          </div>
        </div>
      </section>

      <!-- COVER -->
      <section class="-mt-10">
        <div class="max-w-6xl mx-auto px-6">
          <div class="rounded-3xl overflow-hidden border border-slate-200 bg-white shadow-xl">
            <div class="relative h-64 sm:h-80 md:h-[440px] bg-gradient-to-br from-slate-100 to-slate-200">
              <img
                v-if="realisation?.image"
                :src="realisation.image"
                :alt="realisation?.title"
                class="absolute inset-0 w-full h-full object-cover"
              />
              <div v-else class="absolute inset-0 flex items-center justify-center">
                <div class="text-center">
                  <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#0e437d] to-[#22ae84] flex items-center justify-center mx-auto mb-3">
                    <ImageIcon :size="26" class="text-white" />
                  </div>
                  <div class="text-slate-500 text-sm">Visuel à venir</div>
                </div>
              </div>
              <div class="absolute inset-0 bg-gradient-to-t from-black/25 via-transparent to-transparent" />
            </div>
          </div>
        </div>
      </section>

      <!-- CONTENT -->
      <section class="py-12">
        <div class="max-w-6xl mx-auto px-6">
          <div class="grid lg:grid-cols-12 gap-8">
            <!-- Main -->
            <div class="lg:col-span-8 space-y-6">
              <!-- Description -->
              <article class="rounded-3xl border border-slate-200 bg-white shadow-sm p-6 sm:p-10">
                <h2 class="text-xl sm:text-2xl font-semibold text-slate-900">Présentation</h2>
                <p v-if="realisation?.description" class="mt-4 text-slate-700 leading-relaxed">
                  {{ realisation.description }}
                </p>
                <p v-else class="mt-4 text-slate-600">Description indisponible.</p>
              </article>

              <!-- Context -->
              <article v-if="textOrEmpty(realisation?.context)" class="rounded-3xl border border-slate-200 bg-white shadow-sm p-6 sm:p-10">
                <h2 class="text-xl sm:text-2xl font-semibold text-slate-900">Contexte</h2>
                <div
                  class="mt-4 prose prose-slate max-w-none"
                  v-if="hasHtml(realisation.context)"
                  v-html="realisation.context"
                />
                <p v-else class="mt-4 text-slate-700 leading-relaxed">
                  {{ realisation.context }}
                </p>
              </article>

              <!-- Solution -->
              <article v-if="textOrEmpty(realisation?.solution)" class="rounded-3xl border border-slate-200 bg-white shadow-sm p-6 sm:p-10">
                <h2 class="text-xl sm:text-2xl font-semibold text-slate-900">Solution</h2>
                <div
                  class="mt-4 prose prose-slate max-w-none"
                  v-if="hasHtml(realisation.solution)"
                  v-html="realisation.solution"
                />
                <p v-else class="mt-4 text-slate-700 leading-relaxed">
                  {{ realisation.solution }}
                </p>
              </article>

              <!-- Results -->
              <article v-if="textOrEmpty(realisation?.results)" class="rounded-3xl border border-slate-200 bg-white shadow-sm p-6 sm:p-10">
                <h2 class="text-xl sm:text-2xl font-semibold text-slate-900">Résultats</h2>

                <div
                  class="mt-4 prose prose-slate max-w-none"
                  v-if="hasHtml(realisation.results)"
                  v-html="realisation.results"
                />
                <ul v-else class="mt-4 space-y-3">
                  <li class="flex items-start gap-3 text-slate-700 leading-relaxed">
                    <CheckCircle2 :size="18" class="mt-0.5 text-emerald-600 flex-shrink-0" />
                    <span>{{ realisation.results }}</span>
                  </li>
                </ul>
              </article>

              <!-- Gallery -->
              <article v-if="galleryItems.length" class="rounded-3xl border border-slate-200 bg-white shadow-sm p-6 sm:p-10">
                <h2 class="text-xl sm:text-2xl font-semibold text-slate-900">Galerie</h2>

                <div class="mt-6 grid sm:grid-cols-2 gap-4">
                  <div
                    v-for="(g, idx) in galleryItems"
                    :key="idx"
                    class="rounded-2xl overflow-hidden border border-slate-200 bg-slate-100"
                  >
                    <img :src="g.url" :alt="g.alt || title" class="w-full h-56 object-cover" />
                    <div v-if="g.alt" class="px-4 py-3 text-sm text-slate-600 bg-white">
                      {{ g.alt }}
                    </div>
                  </div>
                </div>
              </article>

              <!-- Testimony -->
              <article v-if="textOrEmpty(realisation?.client_testimony)" class="rounded-3xl border border-slate-200 bg-gradient-to-br from-[#0e437d] to-[#22ae84] text-white shadow-sm p-6 sm:p-10">
                <div class="text-sm font-semibold text-white/90">Témoignage client</div>
                <p class="mt-4 text-lg leading-relaxed text-white/95 italic">
                  “{{ realisation.client_testimony }}”
                </p>
                <div v-if="realisation?.client" class="mt-4 text-sm text-white/80">
                  — {{ realisation.client }}
                </div>
              </article>

              <!-- Navigation -->
              <div class="rounded-3xl border border-slate-200 bg-white shadow-sm p-6 sm:p-8">
                <div class="grid sm:grid-cols-2 gap-4">
                  <Link
                    v-if="prevProject?.slug"
                    :href="`/portfolio/${prevProject.slug}`"
                    class="group rounded-2xl border border-slate-200 p-5 hover:bg-slate-50 transition"
                  >
                    <div class="text-xs text-slate-500">Projet précédent</div>
                    <div class="mt-2 font-semibold text-slate-900 group-hover:text-[#0e437d] transition">
                      {{ prevProject.title }}
                    </div>
                  </Link>

                  <Link
                    v-if="nextProject?.slug"
                    :href="`/portfolio/${nextProject.slug}`"
                    class="group rounded-2xl border border-slate-200 p-5 hover:bg-slate-50 transition"
                  >
                    <div class="text-xs text-slate-500">Projet suivant</div>
                    <div class="mt-2 font-semibold text-slate-900 group-hover:text-[#0e437d] transition">
                      {{ nextProject.title }}
                    </div>
                  </Link>
                </div>

                <div class="mt-4 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
                  <Link
                    href="/portfolio"
                    class="inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3 text-sm font-semibold border border-slate-200 bg-white hover:bg-slate-50 transition"
                  >
                    <ArrowLeft :size="18" />
                    Retour au portfolio
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
              </div>
            </div>

            <!-- Aside -->
            <aside class="lg:col-span-4">
              <div class="sticky top-6 space-y-6">
                <div class="rounded-3xl border border-slate-200 bg-white shadow-sm p-6">
                  <div class="text-sm font-semibold text-slate-900">Fiche projet</div>

                  <div class="mt-4 space-y-3 text-sm text-slate-700">
                    <div class="flex items-center justify-between gap-3">
                      <span class="text-slate-500">Client</span>
                      <span class="font-medium text-right">{{ realisation?.client || "—" }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-3">
                      <span class="text-slate-500">Catégorie</span>
                      <span class="font-medium text-right">{{ realisation?.category || "—" }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-3">
                      <span class="text-slate-500">Secteur</span>
                      <span class="font-medium text-right">{{ realisation?.sector || "—" }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-3">
                      <span class="text-slate-500">Pays</span>
                      <span class="font-medium text-right">{{ realisation?.country || "—" }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-3">
                      <span class="text-slate-500">Type</span>
                      <span class="font-medium text-right">{{ realisation?.type || "—" }}</span>
                    </div>
                    <div class="flex items-center justify-between gap-3">
                      <span class="text-slate-500">Livraison</span>
                      <span class="font-medium text-right">{{ realisation?.completion_date || "—" }}</span>
                    </div>
                  </div>
                </div>

                <div v-if="relatedProjects?.length" class="rounded-3xl border border-slate-200 bg-white shadow-sm p-6">
                  <div class="flex items-center justify-between gap-3">
                    <div class="text-sm font-semibold text-slate-900">Projets similaires</div>
                    <Link href="/portfolio" class="text-sm font-semibold text-[#0e437d] hover:text-[#22ae84] transition">
                      Tout voir
                    </Link>
                  </div>

                  <div class="mt-4 space-y-4">
                    <Link
                      v-for="p in relatedProjects"
                      :key="p.id"
                      :href="`/portfolio/${p.slug}`"
                      class="group block rounded-2xl border border-slate-200 overflow-hidden hover:bg-slate-50 transition"
                    >
                      <div class="flex gap-4 p-4">
                        <div class="w-16 h-16 rounded-xl overflow-hidden bg-slate-100 border border-slate-200 flex-shrink-0">
                          <img v-if="p.image" :src="p.image" :alt="p.title" class="w-full h-full object-cover" />
                          <div v-else class="w-full h-full flex items-center justify-center text-slate-400">
                            <ImageIcon :size="18" />
                          </div>
                        </div>

                        <div class="min-w-0">
                          <div class="text-xs text-slate-500">{{ p.category || "Projet" }}</div>
                          <div class="mt-1 font-semibold text-slate-900 truncate group-hover:text-[#0e437d] transition">
                            {{ p.title }}
                          </div>
                          <div class="mt-1 text-sm text-slate-600 line-clamp-2">
                            {{ p.short_description }}
                          </div>
                        </div>
                      </div>

                      <div class="px-4 pb-4">
                        <div class="inline-flex items-center gap-1 text-sm font-semibold text-[#0e437d] group-hover:text-[#22ae84] transition">
                          Voir le projet <ChevronRight :size="16" class="group-hover:translate-x-1 transition-transform" />
                        </div>
                      </div>
                    </Link>
                  </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-[#0e437d] to-[#22ae84] text-white shadow-sm p-6">
                  <div class="text-sm font-semibold">Vous avez un projet ?</div>
                  <p class="mt-3 text-white/90 text-sm leading-relaxed">
                    Décrivez votre besoin, on vous propose une approche claire et un plan d’exécution.
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

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
