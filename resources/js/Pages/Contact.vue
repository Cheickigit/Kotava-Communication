<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {
  ArrowRight,
  Award,
  CalendarDays,
  CheckCircle2,
  ExternalLink,
  Globe2,
  Loader2,
  Mail,
  MapPin,
  MessageCircle,
  MessageSquare,
  Phone,
  Send,
  Sparkles,
  Target,
  UsersRound,
  Zap,
} from 'lucide-vue-next';
import { computed } from 'vue';

defineOptions({ layout: GuestLayout });

const page = usePage();

const contactEmail = 'Contact@kotavacom.com';
const contactPhoneDisplay = '+229 93 37 49 63';
const contactPhoneHref = 'tel:+22993374963';
const whatsappHref = 'https://wa.me/22993374963';
const websiteUrl = 'https://www.kotavacom.com';

const facebookUrl = 'https://www.facebook.com/share/1HxWwTMMmm/?mibextid=wwXIfr';
const instagramUrl = 'https://www.instagram.com/kotava_communication?igsh=MTJhbzdjZnhsOTJ4NQ%3D%3D&utm_source=qr';
const tiktokUrl = 'https://www.tiktok.com/@kotava_communication?_r=1&_t=ZS-962ZWKhduiL';

const flashSuccess = computed(() => page.props?.flash?.success || null);

const form = useForm({
  name: '',
  email: '',
  phone: '',
  subject: '',
  message: '',
});

const subjects = [
  { value: '', label: 'Choisir un sujet' },
  { value: 'Stratégie & Conseil', label: 'Stratégie & Conseil' },
  { value: 'Branding & Design', label: 'Branding & Design' },
  { value: 'Digital & Web', label: 'Digital & Web' },
  { value: 'Production Audiovisuelle', label: 'Production Audiovisuelle' },
  { value: 'Événementiel & RP', label: 'Événementiel & RP' },
  { value: 'Social Media', label: 'Social Media' },
  { value: 'Autre demande', label: 'Autre demande' },
];

const contactInfo = [
  {
    icon: Mail,
    title: 'Email',
    content: contactEmail,
    link: `mailto:${contactEmail}`,
    description: 'Pour les demandes professionnelles, devis et collaborations.',
  },
  {
    icon: Phone,
    title: 'Téléphone',
    content: contactPhoneDisplay,
    link: contactPhoneHref,
    description: 'Pour échanger rapidement avec notre équipe.',
  },
  {
    icon: MessageCircle,
    title: 'WhatsApp',
    content: 'Discussion directe',
    link: whatsappHref,
    target: '_blank',
    description: 'Idéal pour une demande rapide ou un premier échange.',
  },
  {
    icon: MapPin,
    title: 'Localisation',
    content: 'Cotonou, Bénin',
    link: null,
    description: 'Agence disponible pour des projets locaux et internationaux.',
  },
];

const socialLinks = [
  {
    name: 'Facebook',
    label: 'FB',
    url: facebookUrl,
    handle: 'KOTAVA Communication',
  },
  {
    name: 'Instagram',
    label: 'IG',
    url: instagramUrl,
    handle: '@kotava_communication',
  },
  {
    name: 'TikTok',
    label: 'TK',
    url: tiktokUrl,
    handle: '@kotava_communication',
  },
];

const stats = [
  { value: '24h', label: 'Délai de réponse', icon: CalendarDays },
  { value: '360°', label: 'Communication intégrée', icon: Target },
  { value: '6+', label: 'Expertises clés', icon: Award },
  { value: '100%', label: 'Approche sur mesure', icon: Zap },
];

const process = [
  {
    number: '01',
    title: 'Analyse du besoin',
    text: 'Nous clarifions vos objectifs, votre cible, votre contexte et vos priorités.',
  },
  {
    number: '02',
    title: 'Proposition adaptée',
    text: 'Nous construisons une approche claire avec les livrables, délais et axes d’exécution.',
  },
  {
    number: '03',
    title: 'Démarrage structuré',
    text: 'Nous lançons le projet avec un cadre de suivi précis, transparent et professionnel.',
  },
];

const submit = () => {
  form.post('/contact', {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
    },
  });
};
</script>

<template>
  <Head title="Contact - KOTAVA Communication">
    <meta
      name="description"
      content="Contactez KOTAVA Communication à Cotonou pour vos projets de stratégie, branding, digital, audiovisuel, événementiel et social media."
    />
    <meta
      name="keywords"
      content="KOTAVA Communication, contact KOTAVA, agence communication Bénin, agence communication Cotonou, branding, digital, audiovisuel, événementiel, social media"
    />
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
              <MessageSquare :size="15" class="text-brand-orange" />
              Parlons de votre projet
            </div>

            <h1 class="mt-6 max-w-4xl text-5xl font-black leading-[0.92] tracking-[-0.08em] text-white sm:text-6xl lg:text-7xl">
              Contactez KOTAVA pour construire une communication plus forte.
            </h1>

            <p class="mt-6 max-w-2xl text-base leading-8 text-white/[0.62] sm:text-lg">
              Branding, digital, audiovisuel, événementiel, social media ou stratégie globale :
              décrivez votre besoin, notre équipe vous répond avec une approche claire.
            </p>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
              <a
                href="#formulaire"
                class="inline-flex items-center justify-center gap-3 rounded-2xl bg-brand-orange px-6 py-4 text-sm font-black text-white shadow-[0_18px_50px_rgba(249,115,22,0.28)] transition hover:-translate-y-1"
              >
                Envoyer un message
                <ArrowRight :size="18" />
              </a>

              <a
                :href="whatsappHref"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex items-center justify-center gap-3 rounded-2xl border border-white/10 bg-white/[0.08] px-6 py-4 text-sm font-black text-white/[0.76] backdrop-blur transition hover:-translate-y-1 hover:bg-white/[0.12] hover:text-white"
              >
                WhatsApp direct
                <MessageCircle :size="18" />
              </a>
            </div>
          </div>

          <div class="relative">
            <div class="absolute -inset-6 rounded-[2.7rem] bg-brand-orange/20 blur-3xl"></div>

            <div class="relative rounded-[2.4rem] border border-white/10 bg-white/[0.08] p-5 shadow-2xl shadow-black/20 backdrop-blur-xl">
              <div class="rounded-[1.9rem] border border-white/10 bg-[#0b1524] p-6">
                <div class="flex items-center justify-between gap-4">
                  <div>
                    <p class="text-xs font-black uppercase tracking-[0.16em] text-brand-orange">
                      Coordonnées
                    </p>
                    <h2 class="mt-2 text-2xl font-black tracking-[-0.05em] text-white">
                      KOTAVA Communication
                    </h2>
                  </div>

                  <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-orange text-white">
                    <Mail :size="23" />
                  </div>
                </div>

                <div class="mt-6 space-y-4">
                  <a
                    :href="`mailto:${contactEmail}`"
                    class="flex items-center gap-4 rounded-2xl border border-white/10 bg-white/[0.055] p-4 transition hover:border-brand-orange/50 hover:bg-white/[0.08]"
                  >
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-brand-orange/15 text-brand-orange">
                      <Mail :size="20" />
                    </div>
                    <div>
                      <p class="text-xs font-black uppercase tracking-[0.12em] text-white/[0.35]">
                        Email
                      </p>
                      <p class="mt-1 text-sm font-black text-white">
                        {{ contactEmail }}
                      </p>
                    </div>
                  </a>

                  <a
                    :href="contactPhoneHref"
                    class="flex items-center gap-4 rounded-2xl border border-white/10 bg-white/[0.055] p-4 transition hover:border-brand-orange/50 hover:bg-white/[0.08]"
                  >
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-brand-orange/15 text-brand-orange">
                      <Phone :size="20" />
                    </div>
                    <div>
                      <p class="text-xs font-black uppercase tracking-[0.12em] text-white/[0.35]">
                        Téléphone
                      </p>
                      <p class="mt-1 text-sm font-black text-white">
                        {{ contactPhoneDisplay }}
                      </p>
                    </div>
                  </a>

                  <a
                    :href="websiteUrl"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="flex items-center gap-4 rounded-2xl border border-white/10 bg-white/[0.055] p-4 transition hover:border-brand-orange/50 hover:bg-white/[0.08]"
                  >
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-brand-orange/15 text-brand-orange">
                      <Globe2 :size="20" />
                    </div>
                    <div>
                      <p class="text-xs font-black uppercase tracking-[0.12em] text-white/[0.35]">
                        Site web
                      </p>
                      <p class="mt-1 text-sm font-black text-white">
                        www.kotavacom.com
                      </p>
                    </div>
                  </a>

                  <div class="flex items-center gap-4 rounded-2xl border border-white/10 bg-white/[0.055] p-4">
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-brand-orange/15 text-brand-orange">
                      <MapPin :size="20" />
                    </div>
                    <div>
                      <p class="text-xs font-black uppercase tracking-[0.12em] text-white/[0.35]">
                        Localisation
                      </p>
                      <p class="mt-1 text-sm font-black text-white">
                        Cotonou, Bénin
                      </p>
                    </div>
                  </div>
                </div>

                <div class="mt-6 rounded-2xl bg-brand-orange p-5">
                  <p class="text-sm font-black text-white">
                    Réponse rapide, approche claire, accompagnement professionnel.
                  </p>
                  <p class="mt-2 text-sm leading-6 text-white/[0.78]">
                    Votre message sera enregistré dans le dashboard afin de faciliter le suivi commercial.
                  </p>
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

    <!-- CONTACT -->
    <section id="formulaire" class="border-t border-white/10 px-4 py-14 sm:px-6 lg:px-8">
      <div class="mx-auto grid max-w-7xl gap-8 lg:grid-cols-[380px_1fr]">
        <aside class="space-y-5 lg:sticky lg:top-24 lg:self-start">
          <div
            v-for="info in contactInfo"
            :key="info.title"
            class="rounded-[2rem] border border-white/10 bg-white/[0.06] p-6 shadow-2xl shadow-black/10 backdrop-blur"
          >
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-orange text-white">
              <component :is="info.icon" :size="22" />
            </div>

            <h3 class="mt-5 text-xl font-black tracking-[-0.04em] text-white">
              {{ info.title }}
            </h3>

            <a
              v-if="info.link"
              :href="info.link"
              :target="info.target || '_self'"
              rel="noopener noreferrer"
              class="mt-2 block text-sm font-black text-brand-orange"
            >
              {{ info.content }}
            </a>

            <p v-else class="mt-2 text-sm font-black text-white">
              {{ info.content }}
            </p>

            <p class="mt-3 text-sm leading-6 text-white/[0.50]">
              {{ info.description }}
            </p>
          </div>

          <div class="rounded-[2rem] border border-white/10 bg-white/[0.06] p-6 shadow-2xl shadow-black/10 backdrop-blur">
            <div class="flex items-center gap-3">
              <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-orange text-white">
                <UsersRound :size="22" />
              </div>

              <div>
                <h3 class="text-xl font-black tracking-[-0.04em] text-white">
                  Réseaux sociaux
                </h3>
                <p class="mt-1 text-sm text-white/[0.45]">
                  Suivez nos actualités.
                </p>
              </div>
            </div>

            <div class="mt-5 space-y-3">
              <a
                v-for="social in socialLinks"
                :key="social.name"
                :href="social.url"
                target="_blank"
                rel="noopener noreferrer"
                class="group flex items-center justify-between gap-4 rounded-2xl border border-white/10 bg-white/[0.055] p-4 transition hover:border-brand-orange/50 hover:bg-white/[0.08]"
              >
                <div class="flex items-center gap-4">
                  <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-brand-orange/15 text-sm font-black text-brand-orange">
                    {{ social.label }}
                  </div>

                  <div>
                    <p class="text-sm font-black text-white">
                      {{ social.name }}
                    </p>
                    <p class="mt-1 text-xs font-bold text-white/[0.38]">
                      {{ social.handle }}
                    </p>
                  </div>
                </div>

                <ExternalLink :size="16" class="text-white/[0.35] transition group-hover:text-brand-orange" />
              </a>
            </div>
          </div>
        </aside>

        <div class="space-y-8">
          <div class="rounded-[2.2rem] border border-white/10 bg-white/[0.06] p-6 shadow-2xl shadow-black/10 backdrop-blur sm:p-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
              <div>
                <div class="inline-flex items-center gap-2 rounded-2xl bg-brand-orange/10 px-4 py-2 text-xs font-black uppercase tracking-[0.14em] text-brand-orange">
                  <Send :size="15" />
                  Formulaire de contact
                </div>

                <h2 class="mt-4 text-4xl font-black tracking-[-0.06em] text-white">
                  Décrivez votre projet
                </h2>

                <p class="mt-3 max-w-2xl text-sm leading-7 text-white/[0.55]">
                  Plus votre demande est précise, plus nous pourrons vous proposer une réponse adaptée.
                </p>
              </div>
            </div>

            <div
              v-if="flashSuccess || form.recentlySuccessful"
              class="mt-6 rounded-2xl border border-emerald-400/20 bg-emerald-400/[0.10] p-4 text-sm font-bold text-emerald-200"
            >
              <div class="flex items-center gap-2">
                <CheckCircle2 :size="18" />
                {{ flashSuccess || 'Votre message a bien été envoyé.' }}
              </div>
            </div>

            <form class="mt-8 space-y-5" @submit.prevent="submit">
              <div class="grid gap-5 md:grid-cols-2">
                <div>
                  <label class="text-sm font-black text-white/[0.72]">Nom complet</label>
                  <input
                    v-model="form.name"
                    type="text"
                    class="mt-2 w-full rounded-2xl border border-white/10 bg-white/[0.07] px-4 py-3 text-sm font-semibold text-white outline-none transition placeholder:text-white/[0.32] focus:border-brand-orange focus:ring-4 focus:ring-brand-orange/10"
                    placeholder="Votre nom"
                  />
                  <p v-if="form.errors.name" class="mt-2 text-sm font-semibold text-red-300">
                    {{ form.errors.name }}
                  </p>
                </div>

                <div>
                  <label class="text-sm font-black text-white/[0.72]">Email</label>
                  <input
                    v-model="form.email"
                    type="email"
                    class="mt-2 w-full rounded-2xl border border-white/10 bg-white/[0.07] px-4 py-3 text-sm font-semibold text-white outline-none transition placeholder:text-white/[0.32] focus:border-brand-orange focus:ring-4 focus:ring-brand-orange/10"
                    placeholder="votre@email.com"
                  />
                  <p v-if="form.errors.email" class="mt-2 text-sm font-semibold text-red-300">
                    {{ form.errors.email }}
                  </p>
                </div>
              </div>

              <div class="grid gap-5 md:grid-cols-2">
                <div>
                  <label class="text-sm font-black text-white/[0.72]">Téléphone</label>
                  <input
                    v-model="form.phone"
                    type="tel"
                    class="mt-2 w-full rounded-2xl border border-white/10 bg-white/[0.07] px-4 py-3 text-sm font-semibold text-white outline-none transition placeholder:text-white/[0.32] focus:border-brand-orange focus:ring-4 focus:ring-brand-orange/10"
                    :placeholder="contactPhoneDisplay"
                  />
                  <p v-if="form.errors.phone" class="mt-2 text-sm font-semibold text-red-300">
                    {{ form.errors.phone }}
                  </p>
                </div>

                <div>
                  <label class="text-sm font-black text-white/[0.72]">Sujet</label>
                  <select
                    v-model="form.subject"
                    class="mt-2 w-full rounded-2xl border border-white/10 bg-[#0b1524] px-4 py-3 text-sm font-bold text-white outline-none transition focus:border-brand-orange focus:ring-4 focus:ring-brand-orange/10"
                  >
                    <option
                      v-for="subject in subjects"
                      :key="subject.value"
                      :value="subject.value"
                    >
                      {{ subject.label }}
                    </option>
                  </select>
                  <p v-if="form.errors.subject" class="mt-2 text-sm font-semibold text-red-300">
                    {{ form.errors.subject }}
                  </p>
                </div>
              </div>

              <div>
                <label class="text-sm font-black text-white/[0.72]">Message</label>
                <textarea
                  v-model="form.message"
                  rows="7"
                  class="mt-2 w-full resize-none rounded-2xl border border-white/10 bg-white/[0.07] px-4 py-3 text-sm font-semibold leading-7 text-white outline-none transition placeholder:text-white/[0.32] focus:border-brand-orange focus:ring-4 focus:ring-brand-orange/10"
                  placeholder="Présentez votre projet, vos objectifs, vos délais, votre budget indicatif si disponible..."
                ></textarea>
                <p v-if="form.errors.message" class="mt-2 text-sm font-semibold text-red-300">
                  {{ form.errors.message }}
                </p>
              </div>

              <button
                type="submit"
                :disabled="form.processing"
                class="inline-flex w-full items-center justify-center gap-3 rounded-2xl bg-brand-orange px-6 py-4 text-sm font-black text-white shadow-[0_18px_50px_rgba(249,115,22,0.25)] transition hover:-translate-y-1 disabled:cursor-not-allowed disabled:opacity-60"
              >
                <Loader2 v-if="form.processing" :size="18" class="animate-spin" />
                <Send v-else :size="18" />
                {{ form.processing ? 'Envoi en cours...' : 'Envoyer le message' }}
              </button>
            </form>
          </div>

          <div class="grid gap-5 md:grid-cols-3">
            <div
              v-for="step in process"
              :key="step.number"
              class="rounded-[2rem] border border-white/10 bg-white/[0.06] p-6 backdrop-blur"
            >
              <span class="inline-flex rounded-2xl bg-brand-orange px-3 py-1 text-xs font-black text-white">
                {{ step.number }}
              </span>

              <h3 class="mt-5 text-xl font-black tracking-[-0.04em] text-white">
                {{ step.title }}
              </h3>

              <p class="mt-3 text-sm leading-7 text-white/[0.52]">
                {{ step.text }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FINAL CTA -->
    <section class="px-4 pb-16 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-7xl">
        <div class="relative overflow-hidden rounded-[2.4rem] bg-brand-orange p-8 text-white shadow-2xl shadow-brand-orange/20 sm:p-10 lg:p-12">
          <div class="absolute -right-16 -top-16 h-64 w-64 rounded-full bg-white/20 blur-3xl"></div>
          <div class="absolute -bottom-20 -left-20 h-72 w-72 rounded-full bg-white/10 blur-3xl"></div>

          <div class="relative grid gap-8 lg:grid-cols-[1fr_auto] lg:items-center">
            <div>
              <div class="inline-flex items-center gap-2 rounded-2xl bg-white/15 px-4 py-2 text-xs font-black uppercase tracking-[0.14em] text-white">
                <Sparkles :size="15" />
                Réponse rapide
              </div>

              <h2 class="mt-5 max-w-3xl text-4xl font-black leading-tight tracking-[-0.06em] sm:text-5xl">
                Besoin d’un échange direct avec notre équipe ?
              </h2>

              <p class="mt-4 max-w-2xl text-base leading-7 text-white/[0.82]">
                Appelez-nous, envoyez-nous un email ou contactez-nous sur WhatsApp.
              </p>
            </div>

            <div class="flex flex-col gap-3">
              <a
                :href="contactPhoneHref"
                class="inline-flex items-center justify-center gap-3 rounded-2xl bg-white px-6 py-4 text-sm font-black text-brand-orange transition hover:bg-slate-950 hover:text-white"
              >
                <Phone :size="18" />
                Appeler maintenant
              </a>

              <a
                :href="whatsappHref"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex items-center justify-center gap-3 rounded-2xl border border-white/25 bg-white/10 px-6 py-4 text-sm font-black text-white transition hover:bg-white/20"
              >
                <MessageCircle :size="18" />
                WhatsApp direct
              </a>

              <a
                :href="`mailto:${contactEmail}`"
                class="inline-flex items-center justify-center gap-3 rounded-2xl border border-white/25 bg-white/10 px-6 py-4 text-sm font-black text-white transition hover:bg-white/20"
              >
                <Mail :size="18" />
                Envoyer un email
              </a>
            </div>
          </div>

          <div class="relative mt-8 flex flex-wrap gap-3 text-sm font-bold text-white/[0.78]">
            <a
              :href="facebookUrl"
              target="_blank"
              rel="noopener noreferrer"
              class="inline-flex items-center gap-2 rounded-2xl bg-white/10 px-4 py-2 transition hover:bg-white/20"
            >
              FB
              Facebook
            </a>

            <a
              :href="instagramUrl"
              target="_blank"
              rel="noopener noreferrer"
              class="inline-flex items-center gap-2 rounded-2xl bg-white/10 px-4 py-2 transition hover:bg-white/20"
            >
              IG
              Instagram
            </a>

            <a
              :href="tiktokUrl"
              target="_blank"
              rel="noopener noreferrer"
              class="inline-flex items-center gap-2 rounded-2xl bg-white/10 px-4 py-2 transition hover:bg-white/20"
            >
              TK
              TikTok
            </a>

            <Link
              href="/services"
              class="inline-flex items-center gap-2 rounded-2xl bg-white/10 px-4 py-2 transition hover:bg-white/20"
            >
              Voir nos services
              <ArrowRight :size="15" />
            </Link>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>