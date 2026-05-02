<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {
  ArrowLeft,
  ArrowRight,
  Briefcase,
  Calendar,
  CheckCircle2,
  ChevronLeft,
  ChevronRight,
  Globe2,
  Image as ImageIcon,
  Layers3,
  Mail,
  MapPin,
  Phone,
  Quote,
  Share2,
  Sparkles,
  Tag,
  Target,
  X,
  ZoomIn,
} from 'lucide-vue-next';
import { computed, onMounted, onUnmounted, ref } from 'vue';

defineOptions({ layout: GuestLayout });

const props = defineProps({
  realisation: {
    type: Object,
    required: true,
  },
  relatedProjects: {
    type: Array,
    default: () => [],
  },
  nextProject: {
    type: Object,
    default: null,
  },
  prevProject: {
    type: Object,
    default: null,
  },
  gallery: {
    type: Array,
    default: () => [],
  },
  meta: {
    type: Object,
    default: () => ({}),
  },
});

const copied = ref(false);
const activeImage = ref(null);
const activeImageIndex = ref(0);

const contactEmail = 'Contact@kotavacom.com';
const contactPhoneDisplay = '+229 93 37 49 63';
const contactPhoneHref = 'tel:+22993374963';
const whatsappHref = 'https://wa.me/22993374963';

const title = computed(() => props.realisation?.title || 'Projet KOTAVA');
const pageTitle = computed(() => props.meta?.title || `${title.value} - KOTAVA Communication`);

const pageDescription = computed(() =>
  props.meta?.description ||
  props.realisation?.summary ||
  props.realisation?.description ||
  'Découvrez cette réalisation de KOTAVA Communication.'
);

const coverImage = computed(() => props.realisation?.cover_image || props.realisation?.image || null);

const galleryImages = computed(() => {
  const items = [];

  if (coverImage.value) {
    items.push({
      url: coverImage.value,
      alt: props.realisation?.title || 'Image principale du projet',
      label: 'Image principale',
    });
  }

  props.gallery.forEach((item, index) => {
    if (item?.url) {
      items.push({
        url: item.url,
        alt: item.alt || props.realisation?.title || `Image ${index + 1}`,
        label: `Galerie ${index + 1}`,
      });
    }
  });

  return items;
});

const textOrEmpty = (value) => String(value || '').trim();

const isDifferent = (value, ...others) => {
  const current = textOrEmpty(value);

  if (!current) {
    return false;
  }

  return !others.some((item) => textOrEmpty(item) === current);
};

const projectHref = (project) => project?.slug ? `/portfolio/${project.slug}` : '/portfolio';

const projectImage = (project) => project?.cover_image || project?.image || null;

const projectFacts = computed(() => [
  {
    label: 'Client',
    value: props.realisation?.client,
    icon: Briefcase,
  },
  {
    label: 'Catégorie',
    value: props.realisation?.category,
    icon: Tag,
  },
  {
    label: 'Secteur',
    value: props.realisation?.sector,
    icon: Layers3,
  },
  {
    label: 'Pays',
    value: props.realisation?.country,
    icon: MapPin,
  },
  {
    label: 'Type',
    value: props.realisation?.type,
    icon: Globe2,
  },
  {
    label: 'Livraison',
    value: props.realisation?.completion_date,
    icon: Calendar,
  },
].filter((item) => textOrEmpty(item.value)));

const narrativeSections = computed(() => {
  const description = props.realisation?.description;
  const context = props.realisation?.context;
  const solution = props.realisation?.solution;
  const results = props.realisation?.results;

  return [
    {
      number: '01',
      title: 'Présentation',
      eyebrow: 'Vue générale',
      text: description || 'Description indisponible.',
      icon: Target,
      variant: 'standard',
    },
    {
      number: '02',
      title: 'Contexte',
      eyebrow: 'Point de départ',
      text: isDifferent(context, description) ? context : null,
      icon: Layers3,
      variant: 'standard',
    },
    {
      number: '03',
      title: 'Solution apportée',
      eyebrow: 'Réponse KOTAVA',
      text: isDifferent(solution, description, context) ? solution : null,
      icon: Sparkles,
      variant: 'standard',
    },
    {
      number: '04',
      title: 'Résultats',
      eyebrow: 'Impact',
      text: results,
      icon: CheckCircle2,
      variant: 'result',
    },
  ].filter((section) => textOrEmpty(section.text));
});

const openImage = (image, index = 0) => {
  if (!image?.url) {
    return;
  }

  activeImage.value = image;
  activeImageIndex.value = index;
  document.body.style.overflow = 'hidden';
};

const closeImage = () => {
  activeImage.value = null;
  document.body.style.overflow = '';
};

const nextImage = () => {
  if (!galleryImages.value.length) {
    return;
  }

  const nextIndex = (activeImageIndex.value + 1) % galleryImages.value.length;

  activeImageIndex.value = nextIndex;
  activeImage.value = galleryImages.value[nextIndex];
};

const prevImage = () => {
  if (!galleryImages.value.length) {
    return;
  }

  const prevIndex =
    activeImageIndex.value === 0
      ? galleryImages.value.length - 1
      : activeImageIndex.value - 1;

  activeImageIndex.value = prevIndex;
  activeImage.value = galleryImages.value[prevIndex];
};

const handleKeydown = (event) => {
  if (!activeImage.value) {
    return;
  }

  if (event.key === 'Escape') {
    closeImage();
  }

  if (event.key === 'ArrowRight') {
    nextImage();
  }

  if (event.key === 'ArrowLeft') {
    prevImage();
  }
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

onMounted(() => {
  window.addEventListener('keydown', handleKeydown);
});

onUnmounted(() => {
  window.removeEventListener('keydown', handleKeydown);
  document.body.style.overflow = '';
});
</script>

<template>
  <Head :title="pageTitle">
    <meta name="description" :content="pageDescription" />
    <meta property="og:title" :content="pageTitle" />
    <meta property="og:description" :content="pageDescription" />
    <meta property="og:type" content="article" />
    <meta v-if="meta?.image" property="og:image" :content="meta.image" />
  </Head>

  <main class="overflow-hidden bg-[#07101d] text-white">
    <!-- HERO -->
    <section class="relative isolate overflow-hidden px-4 pb-12 pt-10 sm:px-6 lg:px-8 lg:pb-16">
      <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_15%_15%,rgba(249,115,22,0.24),transparent_28%),radial-gradient(circle_at_88%_8%,rgba(16,185,129,0.16),transparent_30%),linear-gradient(135deg,#07101d_0%,#10235f_48%,#06131f_100%)]"></div>
      <div class="absolute inset-0 -z-10 bg-[linear-gradient(rgba(255,255,255,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.04)_1px,transparent_1px)] bg-[size:42px_42px] opacity-40"></div>

      <div class="relative z-10 mx-auto max-w-7xl">
        <div class="flex flex-wrap items-center justify-between gap-4">
          <Link
            href="/portfolio"
            class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-3 text-sm font-black text-white/[0.76] backdrop-blur transition hover:bg-white/[0.12] hover:text-white"
          >
            <ArrowLeft :size="18" />
            Retour au portfolio
          </Link>

          <button
            type="button"
            class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-3 text-sm font-black text-white/[0.76] backdrop-blur transition hover:bg-white/[0.12] hover:text-white"
            @click="share"
          >
            <Share2 :size="18" />
            {{ copied ? 'Lien copié' : 'Partager' }}
          </button>
        </div>

        <div class="mt-10 grid gap-8 lg:grid-cols-[0.95fr_1.05fr] lg:items-end">
          <div>
            <div class="flex flex-wrap items-center gap-3">
              <span
                v-if="realisation?.category"
                class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-xs font-black uppercase tracking-[0.14em] text-white/[0.72]"
              >
                <Tag :size="14" class="text-brand-orange" />
                {{ realisation.category }}
              </span>

              <span
                v-if="realisation?.featured"
                class="inline-flex items-center gap-2 rounded-2xl bg-brand-orange px-4 py-2 text-xs font-black uppercase tracking-[0.14em] text-white"
              >
                <Sparkles :size="14" />
                Projet en vedette
              </span>
            </div>

            <h1 class="mt-6 max-w-4xl text-4xl font-black leading-[0.95] tracking-[-0.07em] text-white sm:text-5xl lg:text-6xl">
              {{ realisation?.title }}
            </h1>

            <p v-if="realisation?.summary" class="mt-6 max-w-3xl text-base leading-7 text-white/[0.62] sm:text-lg">
              {{ realisation.summary }}
            </p>

            <div class="mt-8 flex flex-wrap gap-3">
              <span
                v-for="fact in projectFacts.slice(0, 3)"
                :key="fact.label"
                class="inline-flex items-center gap-2 rounded-2xl bg-white/[0.08] px-4 py-3 text-sm font-bold text-white/[0.76] ring-1 ring-white/10"
              >
                <component :is="fact.icon" :size="17" />
                {{ fact.value }}
              </span>
            </div>
          </div>

          <div class="relative">
            <div class="absolute -inset-5 rounded-[2.5rem] bg-brand-orange/20 blur-3xl"></div>

            <div class="relative overflow-hidden rounded-[2.3rem] border border-white/10 bg-white/[0.08] p-3 shadow-2xl shadow-black/20 backdrop-blur-xl">
              <div class="relative h-[22rem] overflow-hidden rounded-[1.8rem] bg-[#0b1524] sm:h-[26rem] lg:h-[30rem]">
                <button
                  v-if="coverImage"
                  type="button"
                  class="group/image absolute inset-0"
                  @click="openImage(galleryImages[0], 0)"
                >
                  <img
                    :src="coverImage"
                    :alt="realisation?.title"
                    class="h-full w-full object-cover opacity-90 transition duration-700 group-hover/image:scale-105 group-hover/image:opacity-100"
                  />

                  <div class="absolute inset-0 bg-black/0 transition group-hover/image:bg-black/20"></div>

                  <div class="absolute right-5 top-5 inline-flex items-center gap-2 rounded-2xl bg-black/45 px-4 py-3 text-sm font-black text-white opacity-0 backdrop-blur transition group-hover/image:opacity-100">
                    <ZoomIn :size="18" />
                    Voir en grand
                  </div>
                </button>

                <div v-else class="absolute inset-0 flex items-center justify-center bg-[radial-gradient(circle_at_30%_20%,rgba(249,115,22,0.20),transparent_32%),linear-gradient(135deg,#0f172a,#07101d)]">
                  <div class="text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-brand-orange text-white">
                      <ImageIcon :size="28" />
                    </div>
                    <p class="mt-4 text-sm font-bold text-white/[0.42]">
                      Visuel du projet à venir
                    </p>
                  </div>
                </div>

                <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-[#07101d] via-[#07101d]/20 to-transparent"></div>

                <div class="pointer-events-none absolute bottom-5 left-5 right-5">
                  <div class="rounded-2xl border border-white/10 bg-white/[0.08] p-4 backdrop-blur-xl">
                    <p class="text-xs font-black uppercase tracking-[0.14em] text-white/[0.42]">
                      Fiche projet
                    </p>

                    <div class="mt-3 grid gap-3 sm:grid-cols-2">
                      <div
                        v-for="fact in projectFacts.slice(0, 4)"
                        :key="fact.label"
                        class="rounded-xl bg-white/[0.07] px-3 py-2"
                      >
                        <p class="text-[0.65rem] font-black uppercase tracking-[0.12em] text-white/[0.35]">
                          {{ fact.label }}
                        </p>
                        <p class="mt-1 truncate text-sm font-black text-white">
                          {{ fact.value }}
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
          <article
            v-for="section in narrativeSections"
            :key="section.title"
            :class="[
              'overflow-hidden rounded-[2rem] border p-6 shadow-2xl shadow-black/10 backdrop-blur sm:p-9',
              section.variant === 'result'
                ? 'border-emerald-400/20 bg-emerald-400/[0.08]'
                : 'border-white/10 bg-white/[0.06]'
            ]"
          >
            <div class="flex flex-col gap-5 sm:flex-row sm:items-start">
              <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-brand-orange text-white">
                <component :is="section.icon" :size="23" />
              </div>

              <div class="min-w-0 flex-1">
                <div class="flex flex-wrap items-center gap-3">
                  <span class="text-xs font-black uppercase tracking-[0.16em] text-brand-orange">
                    {{ section.eyebrow }}
                  </span>

                  <span class="rounded-xl border border-white/10 bg-white/[0.06] px-3 py-1 text-xs font-black text-white/[0.38]">
                    {{ section.number }}
                  </span>
                </div>

                <h2 class="mt-3 text-3xl font-black tracking-[-0.05em] text-white">
                  {{ section.title }}
                </h2>

                <p class="mt-5 whitespace-pre-line text-base leading-8 text-white/[0.62]">
                  {{ section.text }}
                </p>
              </div>
            </div>
          </article>

          <article
            v-if="gallery?.length"
            class="rounded-[2rem] border border-white/10 bg-white/[0.06] p-6 shadow-2xl shadow-black/10 backdrop-blur sm:p-9"
          >
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
              <div>
                <p class="text-xs font-black uppercase tracking-[0.16em] text-brand-orange">
                  Visuels
                </p>

                <h2 class="mt-3 text-3xl font-black tracking-[-0.05em] text-white">
                  Galerie du projet
                </h2>
              </div>

              <span class="rounded-2xl bg-white/[0.06] px-4 py-2 text-xs font-black text-white/[0.45]">
                {{ gallery.length }} média(s)
              </span>
            </div>

            <div class="mt-7 grid gap-4 sm:grid-cols-2">
              <button
                v-for="(item, index) in gallery"
                :key="index"
                type="button"
                class="group relative overflow-hidden rounded-[1.6rem] border border-white/10 bg-[#0b1524] text-left"
                @click="openImage(galleryImages[coverImage ? index + 1 : index], coverImage ? index + 1 : index)"
              >
                <img
                  :src="item.url"
                  :alt="item.alt || realisation?.title"
                  class="h-72 w-full object-cover opacity-90 transition duration-700 group-hover:scale-105 group-hover:opacity-100"
                />

                <div class="absolute inset-0 bg-black/0 transition group-hover:bg-black/25"></div>

                <div class="absolute right-4 top-4 inline-flex items-center gap-2 rounded-2xl bg-black/45 px-4 py-2 text-xs font-black text-white opacity-0 backdrop-blur transition group-hover:opacity-100">
                  <ZoomIn :size="16" />
                  Agrandir
                </div>
              </button>
            </div>
          </article>

          <article
            v-if="textOrEmpty(realisation?.client_testimony)"
            class="relative overflow-hidden rounded-[2rem] border border-brand-orange/25 bg-brand-orange p-6 text-white shadow-2xl shadow-brand-orange/20 sm:p-9"
          >
            <div class="absolute -right-10 -top-10 h-44 w-44 rounded-full bg-white/20 blur-3xl"></div>

            <div class="relative">
              <Quote :size="42" class="text-white" />

              <p class="mt-5 whitespace-pre-line text-xl font-semibold leading-9 text-white/[0.90]">
                {{ realisation.client_testimony }}
              </p>

              <p v-if="realisation?.testimonial_author || realisation?.client" class="mt-6 text-sm font-black uppercase tracking-[0.16em] text-white/[0.65]">
                {{ realisation?.testimonial_author || realisation?.client }}
              </p>
            </div>
          </article>

          <div class="rounded-[2rem] border border-white/10 bg-white/[0.06] p-5 shadow-2xl shadow-black/10 backdrop-blur">
            <div class="grid gap-4 sm:grid-cols-2">
              <Link
                v-if="prevProject?.slug"
                :href="projectHref(prevProject)"
                class="group rounded-2xl border border-white/10 bg-white/[0.045] p-5 transition hover:border-brand-orange/50 hover:bg-white/[0.08]"
              >
                <div class="flex items-center gap-2 text-xs font-black uppercase tracking-[0.14em] text-white/[0.38]">
                  <ArrowLeft :size="15" />
                  Projet précédent
                </div>

                <div class="mt-3 text-lg font-black text-white group-hover:text-brand-orange">
                  {{ prevProject.title }}
                </div>
              </Link>

              <Link
                v-if="nextProject?.slug"
                :href="projectHref(nextProject)"
                class="group rounded-2xl border border-white/10 bg-white/[0.045] p-5 text-right transition hover:border-brand-orange/50 hover:bg-white/[0.08]"
              >
                <div class="flex items-center justify-end gap-2 text-xs font-black uppercase tracking-[0.14em] text-white/[0.38]">
                  Projet suivant
                  <ArrowRight :size="15" />
                </div>

                <div class="mt-3 text-lg font-black text-white group-hover:text-brand-orange">
                  {{ nextProject.title }}
                </div>
              </Link>
            </div>
          </div>
        </div>

        <!-- ASIDE -->
        <aside class="space-y-6 lg:sticky lg:top-24 lg:self-start">
          <div class="rounded-[2rem] border border-white/10 bg-white/[0.06] p-6 shadow-2xl shadow-black/10 backdrop-blur">
            <h3 class="text-xl font-black tracking-[-0.04em] text-white">
              Fiche projet
            </h3>

            <div class="mt-6 space-y-3">
              <div
                v-for="fact in projectFacts"
                :key="fact.label"
                class="flex items-center justify-between gap-4 rounded-2xl bg-white/[0.045] px-4 py-3"
              >
                <span class="inline-flex items-center gap-2 text-sm font-bold text-white/[0.45]">
                  <component :is="fact.icon" :size="16" />
                  {{ fact.label }}
                </span>

                <span class="max-w-[11rem] truncate text-right text-sm font-black text-white">
                  {{ fact.value }}
                </span>
              </div>
            </div>
          </div>

          <div
            v-if="relatedProjects?.length"
            class="rounded-[2rem] border border-white/10 bg-white/[0.06] p-6 shadow-2xl shadow-black/10 backdrop-blur"
          >
            <div class="flex items-center justify-between gap-4">
              <h3 class="text-xl font-black tracking-[-0.04em] text-white">
                Projets similaires
              </h3>

              <Link href="/portfolio" class="text-sm font-black text-brand-orange">
                Tout voir
              </Link>
            </div>

            <div class="mt-5 space-y-4">
              <Link
                v-for="project in relatedProjects"
                :key="project.id"
                :href="projectHref(project)"
                class="group block overflow-hidden rounded-2xl border border-white/10 bg-white/[0.045] transition hover:border-brand-orange/50 hover:bg-white/[0.08]"
              >
                <div class="flex gap-4 p-4">
                  <div class="h-16 w-16 shrink-0 overflow-hidden rounded-xl bg-[#0b1524]">
                    <img
                      v-if="projectImage(project)"
                      :src="projectImage(project)"
                      :alt="project.title"
                      class="h-full w-full object-cover"
                    />

                    <div v-else class="flex h-full w-full items-center justify-center text-white/[0.25]">
                      <ImageIcon :size="18" />
                    </div>
                  </div>

                  <div class="min-w-0">
                    <p class="text-xs font-black uppercase tracking-[0.12em] text-white/[0.35]">
                      {{ project.category || 'Projet' }}
                    </p>

                    <h4 class="mt-1 truncate text-sm font-black text-white group-hover:text-brand-orange">
                      {{ project.title }}
                    </h4>

                    <p class="mt-1 line-clamp-2 text-xs leading-5 text-white/[0.45]">
                      {{ project.short_description }}
                    </p>
                  </div>
                </div>
              </Link>
            </div>
          </div>

          <div class="rounded-[2rem] bg-brand-orange p-6 text-white shadow-2xl shadow-brand-orange/20">
            <h3 class="text-xl font-black tracking-[-0.04em]">
              Vous avez un projet ?
            </h3>

            <p class="mt-3 text-sm leading-6 text-white/[0.82]">
              Décrivez votre besoin, nous vous proposerons une approche claire et un plan d’exécution réaliste.
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
                <ArrowRight :size="17" />
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

    <!-- LIGHTBOX IMAGE -->
    <div
      v-if="activeImage"
      class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/90 p-4 backdrop-blur-xl"
      @click.self="closeImage"
    >
      <button
        type="button"
        class="absolute right-4 top-4 z-20 inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-white/10 bg-white/[0.08] text-white backdrop-blur transition hover:bg-white/[0.16]"
        @click="closeImage"
      >
        <X :size="24" />
      </button>

      <button
        v-if="galleryImages.length > 1"
        type="button"
        class="absolute left-4 top-1/2 z-20 inline-flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-2xl border border-white/10 bg-white/[0.08] text-white backdrop-blur transition hover:bg-white/[0.16]"
        @click="prevImage"
      >
        <ChevronLeft :size="26" />
      </button>

      <button
        v-if="galleryImages.length > 1"
        type="button"
        class="absolute right-4 top-1/2 z-20 inline-flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-2xl border border-white/10 bg-white/[0.08] text-white backdrop-blur transition hover:bg-white/[0.16]"
        @click="nextImage"
      >
        <ChevronRight :size="26" />
      </button>

      <div class="relative max-h-[92vh] w-full max-w-7xl overflow-hidden rounded-[2rem] border border-white/10 bg-white/[0.06] p-3 shadow-2xl">
        <img
          :src="activeImage.url"
          :alt="activeImage.alt || realisation?.title"
          class="max-h-[82vh] w-full rounded-[1.5rem] object-contain"
        />

        <div class="mt-3 flex flex-col gap-2 px-2 pb-1 sm:flex-row sm:items-center sm:justify-between">
          <div>
            <p class="text-sm font-black text-white">
              {{ activeImage.label || realisation?.title }}
            </p>

            <p class="mt-1 text-xs font-bold text-white/45">
              {{ activeImageIndex + 1 }} / {{ galleryImages.length }}
            </p>
          </div>

          <p class="text-xs font-bold text-white/40">
            Échap pour fermer · ← → pour naviguer
          </p>
        </div>
      </div>
    </div>
  </main>
</template>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>