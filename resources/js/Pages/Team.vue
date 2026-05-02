<script setup>
import { computed, ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/GuestLayout.vue';
import {
  ArrowRight,
  Award,
  BadgeCheck,
  BriefcaseBusiness,
  CalendarDays,
  Code2,
  Globe2,
  Heart,
  Mail,
  Palette,
  Phone,
  ShieldCheck,
  Sparkles,
  Target,
  UsersRound,
  Zap,
} from 'lucide-vue-next';

defineOptions({ layout: MainLayout });

const contactEmail = 'Contact@kotavacom.com';
const contactPhoneDisplay = '+229 93 37 49 63';
const contactPhoneHref = 'tel:+22993374963';

const activeIndex = ref(0);
const imageErrors = ref({});

const teamMembers = [
  {
    name: 'SMILE TCHICAYA',
    role: 'CEO, Directeur Stratégique & Graphiste, Community Manager',
    photo: '/Smiley.png',
    icon: Target,
    accent: 'bg-brand-orange',
    glow: 'bg-brand-orange/[0.24]',
    expertise: ['Stratégie', 'Design', 'Management'],
    description:
      'Pilote la vision créative et stratégique de KOTAVA avec une approche orientée marque, impact et cohérence.',
  },
  {
    name: 'MODESTE METO',
    role: 'DG, Directeur Marketing & Communication',
    photo: '/Modeste.png',
    icon: BriefcaseBusiness,
    accent: 'bg-brand-emerald',
    glow: 'bg-brand-emerald/[0.24]',
    expertise: ['Marketing', 'Communication', 'Direction'],
    description:
      'Structure les actions marketing et communication pour connecter les marques à leurs audiences.',
  },
  {
    name: 'BAHAMA SANGARÉ',
    role: 'Directeur Technique, Consultant Digital & Architecte Solutions',
    photo: '/bahama.png',
    icon: Code2,
    accent: 'bg-brand-blue',
    glow: 'bg-brand-blue/[0.30]',
    expertise: ['Développement Web', 'Architecture Digitale', 'Conseil Tech'],
    description:
      'Accompagne la conception technique, le développement web, l’architecture des plateformes digitales et la mise en place de solutions numériques performantes.',
  },
];

const stats = [
  { value: '6', label: 'Pôles d’expertise', icon: Award },
  { value: '10+', label: 'Années d’expérience', icon: CalendarDays },
  { value: '100%', label: 'Engagement client', icon: Heart },
  { value: '360°', label: 'Vision intégrée', icon: Globe2 },
];

const values = [
  {
    title: 'Créativité utile',
    text: 'Chaque idée doit servir un objectif clair : image, notoriété, conversion ou impact.',
    icon: Palette,
  },
  {
    title: 'Vision stratégique',
    text: 'Nous pensons la communication comme un levier de positionnement, pas comme une simple production.',
    icon: Target,
  },
  {
    title: 'Exécution maîtrisée',
    text: 'Design, contenu, digital, événementiel et suivi sont structurés avec rigueur.',
    icon: ShieldCheck,
  },
  {
    title: 'Énergie collective',
    text: 'Chaque profil apporte une compétence différente pour construire une réponse complète.',
    icon: UsersRound,
  },
];

const activeMember = computed(() => teamMembers[activeIndex.value] || teamMembers[0]);

const setActive = (index) => {
  activeIndex.value = index;
};

const handleImageError = (memberName) => {
  imageErrors.value[memberName] = true;
};

const getMemberPhotoClass = (member, size = 'large') => {
  if (member.name === 'BAHAMA SANGARÉ') {
    return size === 'thumb'
      ? 'h-full w-full object-contain object-top bg-[#07101d] p-1'
      : 'h-full w-full object-contain object-top bg-[#07101d] p-3';
  }

  return 'h-full w-full object-cover object-center';
};
</script>

<template>
  <Head title="Notre Équipe — KOTAVA Communication">
    <meta
      name="description"
      content="Découvrez l’équipe KOTAVA Communication : stratégie, design, marketing, communication, digital et data au service des marques ambitieuses."
    />
  </Head>

  <main class="relative overflow-hidden bg-brand-dark text-white">
    <!-- HERO TEAM -->
    <section class="relative isolate overflow-hidden px-3 pb-14 pt-32 sm:px-4 lg:px-6 lg:pt-36">
      <div class="absolute inset-0 bg-grid-dark opacity-25"></div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_15%_18%,rgba(249,115,22,0.18),transparent_28%),radial-gradient(circle_at_86%_76%,rgba(16,185,129,0.15),transparent_30%),radial-gradient(circle_at_50%_44%,rgba(30,58,138,0.36),transparent_36%)]"></div>
      <div class="absolute inset-x-0 top-0 h-52 bg-gradient-to-b from-brand-dark via-brand-dark/[0.92] to-transparent"></div>

      <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute left-1/2 top-[12%] hidden -translate-x-1/2 select-none text-[10vw] font-black uppercase leading-none tracking-[-0.12em] text-white/[0.025] lg:block">
          TEAM
        </div>

        <div class="team-orb absolute left-[8%] top-[28%] h-14 w-14 rounded-[1.4rem] bg-brand-orange/[0.28]"></div>
        <div class="team-orb animation-delay-700 absolute right-[10%] top-[24%] h-12 w-12 rounded-full bg-brand-emerald/[0.25]"></div>
        <div class="team-orb animation-delay-1200 absolute bottom-[18%] left-[24%] h-16 w-16 rounded-[1.6rem] bg-brand-blue/[0.32]"></div>
      </div>

      <div class="site-container relative z-10">
        <div class="grid gap-10 lg:grid-cols-[0.78fr_1.22fr] lg:items-center">
          <div>
            <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-orange backdrop-blur">
              <Sparkles :size="14" />
              Notre force collective
            </div>

            <h1 class="mt-6 max-w-4xl text-5xl font-black leading-[0.9] tracking-[-0.075em] text-white sm:text-6xl lg:text-7xl">
              Une équipe,
              <span class="block bg-gradient-to-r from-brand-orange via-white to-brand-emerald bg-clip-text text-transparent">
                plusieurs expertises.
              </span>
            </h1>

            <p class="mt-6 max-w-xl text-base leading-8 text-white/[0.64]">
              KOTAVA réunit des profils complémentaires en stratégie, design, marketing,
              communication, digital et data pour accompagner les marques avec une vision complète.
            </p>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
              <Link
                href="/contact"
                class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] bg-brand-orange px-6 py-4 text-sm font-black text-white shadow-orange transition hover:-translate-y-0.5 hover:bg-brand-orange/90"
              >
                Travailler avec l’équipe
                <ArrowRight :size="18" />
              </Link>

              <a
                :href="contactPhoneHref"
                class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] border border-white/10 bg-white/[0.08] px-6 py-4 text-sm font-black text-white transition hover:-translate-y-0.5 hover:bg-white/[0.12]"
              >
                <Phone :size="18" />
                Nous appeler
              </a>
            </div>

            <div class="mt-8 grid grid-cols-2 gap-3 sm:grid-cols-4">
              <div
                v-for="stat in stats"
                :key="stat.label"
                class="rounded-[1.35rem] border border-white/10 bg-white/[0.055] p-4 backdrop-blur"
              >
                <component :is="stat.icon" :size="19" class="text-brand-emerald" />

                <div class="mt-3 text-2xl font-black tracking-[-0.055em] text-white">
                  {{ stat.value }}
                </div>

                <div class="text-[11px] font-bold uppercase tracking-[0.12em] text-white/[0.42]">
                  {{ stat.label }}
                </div>
              </div>
            </div>
          </div>

          <!-- Team board -->
          <div class="relative min-h-[680px]">
            <div
              :class="[
                'absolute left-1/2 top-1/2 h-[86%] w-[74%] -translate-x-1/2 -translate-y-1/2 rounded-[6rem] blur-3xl transition duration-700',
                activeMember.glow
              ]"
            ></div>

            <div class="team-board absolute left-1/2 top-1/2 z-20 w-full max-w-[720px] -translate-x-1/2 -translate-y-1/2 overflow-hidden rounded-[3rem] border border-white/10 bg-white/[0.065] p-5 shadow-[0_45px_150px_rgba(0,0,0,0.42)] backdrop-blur-2xl">
              <div class="relative overflow-hidden rounded-[2.4rem] border border-white/10 bg-[#080D15] p-6">
                <div class="absolute inset-0 bg-[linear-gradient(115deg,rgba(255,255,255,0.07)_0,transparent_24%,rgba(249,115,22,0.12)_52%,transparent_78%)]"></div>

                <div class="relative z-10 grid gap-6 lg:grid-cols-[0.42fr_0.58fr] lg:items-center">
                  <div>
                    <div class="relative mx-auto h-72 w-72 overflow-hidden rounded-[2.4rem] border border-white/10 bg-white/[0.06] shadow-2xl">
                      <img
                        v-if="!imageErrors[activeMember.name]"
                        :src="activeMember.photo"
                        :alt="activeMember.name"
                        :class="getMemberPhotoClass(activeMember)"
                        @error="handleImageError(activeMember.name)"
                      />

                      <div
                        v-else
                        :class="['flex h-full w-full items-center justify-center text-white', activeMember.accent]"
                      >
                        <component :is="activeMember.icon" :size="72" />
                      </div>

                      <div class="absolute inset-x-4 bottom-4 rounded-[1.3rem] border border-white/10 bg-black/[0.58] p-4 backdrop-blur">
                        <div class="text-[10px] font-black uppercase tracking-[0.18em] text-brand-orange">
                          Profil actif
                        </div>
                        <div class="mt-1 text-xl font-black tracking-[-0.04em] text-white">
                          {{ activeMember.name }}
                        </div>
                      </div>
                    </div>
                  </div>

                  <div>
                    <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.2em] text-brand-emerald">
                      <BadgeCheck :size="14" />
                      Leadership KOTAVA
                    </div>

                    <h2 class="mt-5 text-4xl font-black leading-[0.95] tracking-[-0.06em] text-white">
                      {{ activeMember.name }}
                    </h2>

                    <p class="mt-3 text-sm font-bold leading-7 text-brand-orange">
                      {{ activeMember.role }}
                    </p>

                    <p class="mt-5 max-w-md text-sm leading-7 text-white/[0.58]">
                      {{ activeMember.description }}
                    </p>

                    <div class="mt-5 flex flex-wrap gap-2">
                      <span
                        v-for="skill in activeMember.expertise"
                        :key="skill"
                        class="rounded-xl border border-white/10 bg-white/[0.07] px-3 py-2 text-[10px] font-black uppercase tracking-[0.12em] text-white/[0.55]"
                      >
                        {{ skill }}
                      </span>
                    </div>
                  </div>
                </div>

                <div class="relative z-10 mt-6 grid grid-cols-1 gap-3 sm:grid-cols-3">
                  <button
                    v-for="(member, index) in teamMembers"
                    :key="member.name"
                    type="button"
                    :class="[
                      'rounded-[1.3rem] border p-3 text-left transition',
                      activeIndex === index
                        ? 'border-brand-orange/50 bg-brand-orange/[0.16]'
                        : 'border-white/10 bg-white/[0.055] hover:bg-white/[0.10]'
                    ]"
                    @click="setActive(index)"
                  >
                    <div class="flex items-center gap-3">
                      <div class="h-11 w-11 overflow-hidden rounded-2xl bg-white/[0.08]">
                        <img
                          v-if="!imageErrors[`${member.name}-thumb`]"
                          :src="member.photo"
                          :alt="member.name"
                          :class="getMemberPhotoClass(member, 'thumb')"
                          @error="handleImageError(`${member.name}-thumb`)"
                        />

                        <div
                          v-else
                          :class="['flex h-full w-full items-center justify-center text-white', member.accent]"
                        >
                          <component :is="member.icon" :size="18" />
                        </div>
                      </div>

                      <div class="min-w-0">
                        <div
                          :class="[
                            'truncate text-xs font-black',
                            activeIndex === index ? 'text-white' : 'text-white/[0.55]'
                          ]"
                        >
                          {{ member.name }}
                        </div>

                        <div class="mt-0.5 truncate text-[10px] font-bold uppercase tracking-[0.1em] text-white/[0.35]">
                          {{ member.expertise[0] }}
                        </div>
                      </div>
                    </div>
                  </button>
                </div>
              </div>
            </div>

            <div class="team-note absolute left-0 top-16 hidden rotate-[-7deg] rounded-[1.5rem] bg-white p-5 text-slate-950 shadow-2xl lg:block">
              <UsersRound :size="22" class="text-brand-orange" />
              <div class="mt-4 text-xl font-black tracking-[-0.05em]">Équipe intégrée</div>
              <div class="mt-1 text-xs font-bold uppercase tracking-[0.14em] text-slate-400">Vision 360°</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- VALEURS -->
    <section class="relative isolate overflow-hidden px-3 py-14 sm:px-4 lg:px-6">
      <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(8,17,31,0.1),rgba(8,17,31,0.72),rgba(8,17,31,0.1))]"></div>

      <div class="site-container relative z-10">
        <div class="mb-8 max-w-3xl">
          <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.06] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-orange">
            <Heart :size="15" />
            Nos valeurs
          </div>

          <h2 class="mt-5 text-4xl font-black leading-[0.95] tracking-[-0.06em] text-white sm:text-5xl">
            Ce qui guide notre manière
            <span class="block text-brand-orange">de travailler.</span>
          </h2>
        </div>

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
          <div
            v-for="(value, index) in values"
            :key="value.title"
            class="group relative min-h-72 overflow-hidden rounded-[2rem] border border-white/10 bg-white/[0.055] p-5 backdrop-blur-xl transition hover:-translate-y-1 hover:bg-white/[0.09]"
          >
            <div class="absolute -right-12 -top-12 h-40 w-40 rounded-[3rem] bg-brand-orange/[0.14] blur-3xl transition group-hover:scale-125"></div>

            <div class="relative">
              <div class="flex items-center justify-between">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-brand-blue">
                  <component :is="value.icon" :size="24" />
                </div>

                <div class="text-5xl font-black tracking-[-0.1em] text-white/[0.10]">
                  0{{ index + 1 }}
                </div>
              </div>

              <h3 class="mt-16 text-xl font-black tracking-[-0.04em] text-white">
                {{ value.title }}
              </h3>

              <p class="mt-3 text-sm leading-7 text-white/[0.55]">
                {{ value.text }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA FINAL -->
    <section class="relative isolate overflow-hidden px-3 py-14 pb-20 sm:px-4 lg:px-6 lg:pb-24">
      <div class="site-container relative z-10">
        <div class="relative overflow-hidden rounded-[2.8rem] border border-white/10 bg-white/[0.065] p-6 backdrop-blur-2xl sm:p-8">
          <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_18%,rgba(249,115,22,0.16),transparent_30%),radial-gradient(circle_at_86%_80%,rgba(16,185,129,0.14),transparent_32%)]"></div>

          <div class="relative grid gap-8 lg:grid-cols-[0.9fr_1.1fr] lg:items-center">
            <div>
              <div class="flex h-16 w-16 items-center justify-center rounded-[1.4rem] bg-brand-orange text-white shadow-orange">
                <UsersRound :size="28" />
              </div>

              <h2 class="mt-6 text-4xl font-black leading-[0.95] tracking-[-0.06em] text-white sm:text-5xl">
                Une équipe prête
                <span class="block bg-gradient-to-r from-brand-orange via-white to-brand-emerald bg-clip-text text-transparent">
                  à construire votre image.
                </span>
              </h2>

              <p class="mt-4 max-w-xl text-sm leading-7 text-white/[0.60]">
                Parlons de votre projet et voyons comment nos expertises peuvent créer une communication plus claire,
                plus forte et plus visible.
              </p>
            </div>

            <div class="grid gap-3">
              <Link
                href="/contact"
                class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] bg-brand-orange px-6 py-4 text-sm font-black text-white shadow-orange transition hover:-translate-y-0.5 hover:bg-brand-orange/90"
              >
                Rencontrer l’équipe
                <ArrowRight :size="18" />
              </Link>

              <a
                :href="contactPhoneHref"
                class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] border border-white/10 bg-white/[0.08] px-6 py-4 text-sm font-black text-white transition hover:-translate-y-0.5 hover:bg-white/[0.12]"
              >
                <Phone :size="18" />
                {{ contactPhoneDisplay }}
              </a>

              <a
                :href="`mailto:${contactEmail}`"
                class="inline-flex items-center justify-center gap-2 rounded-[1.15rem] border border-white/10 bg-white/[0.08] px-6 py-4 text-sm font-black text-white transition hover:-translate-y-0.5 hover:bg-white/[0.12]"
              >
                <Mail :size="18" />
                {{ contactEmail }}
              </a>
            </div>
          </div>
        </div>

        <div class="mt-5 grid gap-3 sm:grid-cols-3">
          <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.055] p-5 backdrop-blur">
            <Zap :size="22" class="text-brand-orange" />
            <div class="mt-3 text-sm font-black text-white">Créativité rapide</div>
          </div>

          <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.055] p-5 backdrop-blur">
            <BadgeCheck :size="22" class="text-brand-emerald" />
            <div class="mt-3 text-sm font-black text-white">Exécution fiable</div>
          </div>

          <div class="rounded-[1.5rem] border border-white/10 bg-white/[0.055] p-5 backdrop-blur">
            <Globe2 :size="22" class="text-brand-orange" />
            <div class="mt-3 text-sm font-black text-white">Vision complète</div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<style scoped>
@keyframes teamOrb {
  0%, 100% {
    transform: translate3d(0, 0, 0) rotate(0deg);
    opacity: 0.35;
  }

  50% {
    transform: translate3d(18px, -24px, 0) rotate(12deg);
    opacity: 0.85;
  }
}

@keyframes teamBoard {
  0%, 100% {
    transform: translate(-50%, -50%) rotate(-0.8deg);
  }

  50% {
    transform: translate(-50%, calc(-50% - 10px)) rotate(0.8deg);
  }
}

@keyframes teamNote {
  0%, 100% {
    transform: translateY(0) rotate(-7deg);
  }

  50% {
    transform: translateY(-14px) rotate(-3deg);
  }
}

.team-orb {
  animation: teamOrb 7s ease-in-out infinite;
}

.team-board {
  animation: teamBoard 7s ease-in-out infinite;
}

.team-note {
  animation: teamNote 6s ease-in-out infinite;
}

.animation-delay-700 {
  animation-delay: 700ms;
}

.animation-delay-1200 {
  animation-delay: 1200ms;
}
</style>