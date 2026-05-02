<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import {
  ArrowLeft,
  ArrowRight,
  CheckCircle2,
  KeyRound,
  Mail,
  Send,
  ShieldCheck,
  Sparkles,
} from 'lucide-vue-next';

defineProps({
  status: String,
});

const form = useForm({
  email: '',
});

const submit = () => {
  form.post(route('password.email'));
};
</script>

<template>
  <Head title="Mot de passe oublié — KOTAVA Communication" />

  <main class="relative min-h-screen overflow-hidden bg-brand-dark text-white">
    <div class="absolute inset-0 bg-grid-dark opacity-25"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_15%_18%,rgba(249,115,22,0.18),transparent_28%),radial-gradient(circle_at_86%_76%,rgba(16,185,129,0.15),transparent_30%),radial-gradient(circle_at_50%_44%,rgba(30,58,138,0.36),transparent_36%)]"></div>
    <div class="absolute inset-x-0 top-0 h-52 bg-gradient-to-b from-brand-dark via-brand-dark/[0.92] to-transparent"></div>

    <div class="pointer-events-none absolute inset-0 overflow-hidden">
      <div class="absolute left-1/2 top-[10%] hidden -translate-x-1/2 select-none text-[10vw] font-black uppercase leading-none tracking-[-0.12em] text-white/[0.025] lg:block">
        RESET
      </div>

      <div class="reset-float absolute left-[8%] top-[24%] h-14 w-14 rounded-[1.4rem] bg-brand-orange/[0.28]"></div>
      <div class="reset-float animation-delay-700 absolute right-[10%] top-[22%] h-12 w-12 rounded-full bg-brand-emerald/[0.25]"></div>
      <div class="reset-float animation-delay-1200 absolute bottom-[18%] left-[24%] h-16 w-16 rounded-[1.6rem] bg-brand-blue/[0.32]"></div>
    </div>

    <section class="relative z-10 flex min-h-screen items-center px-4 py-10 sm:px-6 lg:px-8">
      <div class="mx-auto grid w-full max-w-7xl gap-8 lg:grid-cols-[0.95fr_1.05fr] lg:items-center">
        <!-- Left content -->
        <div class="hidden lg:block">
          <Link href="/" class="inline-flex items-center gap-4">
            <span class="flex h-16 w-16 items-center justify-center rounded-[1.4rem] border border-white/10 bg-white/[0.08] p-3 backdrop-blur">
              <img src="/logo_horizontal.png" alt="KOTAVA" class="h-full w-full object-contain" />
            </span>

            <span>
              <span class="block text-sm font-black uppercase tracking-[0.22em] text-brand-orange">
                KOTAVA Communication
              </span>
              <span class="mt-1 block text-xs font-bold uppercase tracking-[0.18em] text-white/[0.45]">
                Récupération sécurisée
              </span>
            </span>
          </Link>

          <h1 class="mt-10 max-w-3xl text-6xl font-black leading-[0.88] tracking-[-0.08em] text-white">
            Réinitialisez votre
            <span class="block bg-gradient-to-r from-brand-orange via-white to-brand-emerald bg-clip-text text-transparent">
              accès sécurisé.
            </span>
          </h1>

          <p class="mt-6 max-w-xl text-base leading-8 text-white/[0.64]">
            Saisissez votre adresse email. Si elle est associée à un compte, un lien de réinitialisation vous sera envoyé.
          </p>

          <div class="mt-10 grid max-w-2xl gap-3">
            <div class="rounded-[1.6rem] border border-white/10 bg-white/[0.055] p-5 backdrop-blur-xl">
              <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white text-brand-blue">
                  <ShieldCheck :size="21" />
                </div>

                <div>
                  <h2 class="text-base font-black text-white">
                    Procédure protégée
                  </h2>

                  <p class="mt-1 text-sm leading-6 text-white/[0.52]">
                    Le lien de réinitialisation est envoyé uniquement à l’adresse associée au compte.
                  </p>
                </div>
              </div>
            </div>

            <div class="rounded-[1.6rem] border border-white/10 bg-white/[0.055] p-5 backdrop-blur-xl">
              <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white text-brand-blue">
                  <KeyRound :size="21" />
                </div>

                <div>
                  <h2 class="text-base font-black text-white">
                    Nouveau mot de passe
                  </h2>

                  <p class="mt-1 text-sm leading-6 text-white/[0.52]">
                    Après réception du lien, vous pourrez définir un nouveau mot de passe pour votre espace.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Reset card -->
        <div class="relative mx-auto w-full max-w-[560px]">
          <div class="absolute left-1/2 top-1/2 h-[88%] w-[82%] -translate-x-1/2 -translate-y-1/2 rounded-[6rem] bg-brand-orange/[0.18] blur-3xl"></div>

          <div class="relative overflow-hidden rounded-[2.8rem] border border-white/10 bg-white/[0.065] p-5 shadow-[0_45px_150px_rgba(0,0,0,0.42)] backdrop-blur-2xl">
            <div class="relative overflow-hidden rounded-[2.25rem] border border-white/10 bg-[#080D15] p-6 sm:p-8">
              <div class="absolute inset-0 bg-[linear-gradient(115deg,rgba(255,255,255,0.07)_0,transparent_24%,rgba(249,115,22,0.12)_52%,transparent_78%)]"></div>

              <div class="relative z-10">
                <div class="flex items-center justify-between gap-5">
                  <Link href="/" class="flex items-center gap-3">
                    <span class="flex h-14 w-14 items-center justify-center rounded-[1.2rem] border border-white/10 bg-white/[0.08] p-3">
                      <img src="/logo_horizontal.png" alt="KOTAVA" class="h-full w-full object-contain" />
                    </span>

                    <span>
                      <span class="block text-sm font-black uppercase tracking-[0.18em] text-white">
                        KOTAVA
                      </span>
                      <span class="block text-[10px] font-bold uppercase tracking-[0.14em] text-white/[0.40]">
                        Mot de passe oublié
                      </span>
                    </span>
                  </Link>

                  <div class="hidden rounded-2xl bg-brand-orange px-4 py-3 text-[10px] font-black uppercase tracking-[0.18em] text-white sm:block">
                    Reset
                  </div>
                </div>

                <div class="mt-10">
                  <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.20em] text-brand-orange">
                    <Sparkles :size="14" />
                    Récupération
                  </div>

                  <h1 class="mt-5 text-4xl font-black leading-[0.92] tracking-[-0.065em] text-white sm:text-5xl">
                    Réinitialiser le mot de passe.
                  </h1>

                  <p class="mt-4 text-sm leading-7 text-white/[0.55]">
                    Entrez votre adresse email. Nous vous enverrons un lien sécurisé pour choisir un nouveau mot de passe.
                  </p>
                </div>

                <div
                  v-if="status"
                  class="mt-6 rounded-[1.2rem] border border-brand-emerald/20 bg-brand-emerald/[0.12] p-4 text-sm font-bold text-brand-emerald"
                >
                  <div class="flex items-start gap-2">
                    <CheckCircle2 :size="18" class="mt-0.5 shrink-0" />
                    <span>{{ status }}</span>
                  </div>
                </div>

                <form class="mt-8 space-y-5" @submit.prevent="submit">
                  <div>
                    <label for="email" class="text-xs font-black uppercase tracking-[0.18em] text-white/[0.48]">
                      Adresse email
                    </label>

                    <div class="mt-2 flex items-center gap-3 rounded-[1.2rem] border border-white/10 bg-white/[0.07] px-4 py-3 transition focus-within:border-brand-orange/50 focus-within:bg-white/[0.10]">
                      <Mail :size="20" class="shrink-0 text-brand-orange" />

                      <input
                        id="email"
                        v-model="form.email"
                        type="email"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="votre@email.com"
                        class="min-h-10 w-full border-0 bg-transparent p-0 text-sm font-bold text-white placeholder:text-white/[0.28] focus:ring-0"
                      />
                    </div>

                    <p v-if="form.errors.email" class="mt-2 text-sm font-bold text-red-400">
                      {{ form.errors.email }}
                    </p>
                  </div>

                  <button
                    type="submit"
                    :disabled="form.processing"
                    :class="[
                      'group inline-flex w-full items-center justify-center gap-2 rounded-[1.15rem] bg-brand-orange px-6 py-4 text-sm font-black text-white shadow-orange transition hover:-translate-y-0.5 hover:bg-brand-orange/90',
                      form.processing ? 'cursor-not-allowed opacity-60' : ''
                    ]"
                  >
                    <span v-if="form.processing">Envoi du lien...</span>
                    <span v-else>Envoyer le lien de réinitialisation</span>
                    <Send v-if="form.processing" :size="18" />
                    <ArrowRight v-else :size="18" class="transition group-hover:translate-x-1" />
                  </button>
                </form>

                <div class="mt-8 flex flex-col gap-3 border-t border-white/10 pt-5 sm:flex-row sm:items-center sm:justify-between">
                  <p class="text-xs font-bold leading-6 text-white/[0.42]">
                    Vous connaissez votre mot de passe ?
                  </p>

                  <Link
                    :href="route('login')"
                    class="inline-flex items-center gap-2 text-sm font-black text-brand-orange transition hover:text-white"
                  >
                    <ArrowLeft :size="16" />
                    Retour à la connexion
                  </Link>
                </div>
              </div>
            </div>
          </div>

          <div class="reset-note absolute -bottom-6 left-6 hidden rotate-[-5deg] rounded-[1.4rem] bg-white p-4 text-slate-950 shadow-2xl lg:block">
            <ShieldCheck :size="22" class="text-brand-orange" />
            <div class="mt-3 text-sm font-black tracking-[-0.03em]">Lien sécurisé</div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<style scoped>
@keyframes resetFloat {
  0%, 100% {
    transform: translate3d(0, 0, 0) rotate(0deg);
    opacity: 0.35;
  }

  50% {
    transform: translate3d(18px, -24px, 0) rotate(12deg);
    opacity: 0.85;
  }
}

@keyframes resetNote {
  0%, 100% {
    transform: translateY(0) rotate(-5deg);
  }

  50% {
    transform: translateY(-12px) rotate(-2deg);
  }
}

.reset-float {
  animation: resetFloat 7s ease-in-out infinite;
}

.reset-note {
  animation: resetNote 6s ease-in-out infinite;
}

.animation-delay-700 {
  animation-delay: 700ms;
}

.animation-delay-1200 {
  animation-delay: 1200ms;
}
</style>