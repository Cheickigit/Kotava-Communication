<script setup>
import { Link } from '@inertiajs/vue3';
import {
  ArrowRight,
  BadgeCheck,
  Mail,
  MapPin,
  MessageCircle,
  Phone,
  Send,
  Sparkles,
  Zap,
} from 'lucide-vue-next';

const contactEmail = 'Contact@kotavacom.com';
const contactPhoneDisplay = '+229 93 37 49 63';
const contactPhoneHref = 'tel:+22993374963';
const whatsappHref = 'https://wa.me/22993374963';
</script>

<template>
  <section class="relative isolate overflow-hidden bg-brand-dark py-20 text-white sm:py-24 lg:py-28">
    <!-- Background cohérent -->
    <div class="absolute inset-0 bg-grid-dark opacity-35"></div>

    <div class="absolute inset-0 bg-[radial-gradient(circle_at_8%_18%,rgba(16,185,129,0.18),transparent_28%),radial-gradient(circle_at_92%_72%,rgba(249,115,22,0.16),transparent_28%),radial-gradient(circle_at_50%_48%,rgba(30,58,138,0.34),transparent_34%)]"></div>

    <div class="absolute inset-x-0 top-0 h-40 bg-gradient-to-b from-brand-dark via-brand-dark/90 to-transparent"></div>
    <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-brand-dark via-brand-dark/90 to-transparent"></div>

    <div class="pointer-events-none absolute inset-0 overflow-hidden">
      <div class="absolute inset-x-0 top-[10%] hidden select-none text-center text-[12vw] font-black uppercase leading-none tracking-[-0.09em] text-white/[0.025] lg:block">
        START
      </div>

      <img
        src="/logo.png"
        alt=""
        class="absolute left-[5%] top-[20%] hidden h-24 w-auto opacity-[0.04] lg:block"
      />

      <img
        src="/logo.png"
        alt=""
        class="absolute right-[5%] bottom-[18%] hidden h-28 w-auto opacity-[0.035] lg:block"
      />
    </div>

    <div class="site-container relative z-10">
      <div class="relative overflow-hidden rounded-[2.6rem] border border-white/10 bg-white/[0.065] p-6 shadow-[0_40px_120px_rgba(0,0,0,0.30)] backdrop-blur-2xl sm:p-8 lg:p-10">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_18%,rgba(16,185,129,0.16),transparent_30%),radial-gradient(circle_at_86%_80%,rgba(249,115,22,0.14),transparent_32%)]"></div>

        <div class="absolute -right-24 -top-24 h-80 w-80 rounded-[5rem] bg-brand-orange/20 blur-3xl"></div>
        <div class="absolute -bottom-28 -left-24 h-96 w-96 rounded-[5rem] bg-brand-emerald/18 blur-3xl"></div>

        <div class="relative grid gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
          <!-- Texte CTA -->
          <div>
            <div class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/[0.08] px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-brand-emerald backdrop-blur">
              <Sparkles :size="14" />
              Ready to build
            </div>

            <h2 class="mt-6 max-w-4xl text-4xl font-black leading-[0.94] tracking-[-0.055em] text-white sm:text-5xl lg:text-6xl">
              Donnons à votre marque
              <span class="block bg-gradient-to-r from-brand-emerald via-white to-brand-orange bg-clip-text text-transparent">
                la présence qu’elle mérite.
              </span>
            </h2>

            <p class="mt-5 max-w-2xl text-base leading-8 text-white/60">
              Branding, stratégie, digital, contenu ou activation : KOTAVA vous accompagne avec une approche claire, créative et orientée impact.
            </p>

            <div class="mt-8 grid gap-3 sm:grid-cols-3">
              <div class="rounded-[1.4rem] border border-white/10 bg-white/[0.07] p-4 backdrop-blur">
                <BadgeCheck :size="21" class="text-brand-emerald" />
                <div class="mt-3 text-sm font-black text-white">
                  Conseil clair
                </div>
              </div>

              <div class="rounded-[1.4rem] border border-white/10 bg-white/[0.07] p-4 backdrop-blur">
                <Zap :size="21" class="text-brand-orange" />
                <div class="mt-3 text-sm font-black text-white">
                  Exécution rapide
                </div>
              </div>

              <div class="rounded-[1.4rem] border border-white/10 bg-white/[0.07] p-4 backdrop-blur">
                <Send :size="21" class="text-brand-blue" />
                <div class="mt-3 text-sm font-black text-white">
                  Impact mesurable
                </div>
              </div>
            </div>
          </div>

          <!-- Bloc contact -->
          <div class="relative">
            <div class="absolute left-1/2 top-1/2 h-[105%] w-[84%] -translate-x-1/2 -translate-y-1/2 rounded-[4rem] bg-gradient-to-br from-brand-blue/20 via-brand-emerald/20 to-brand-orange/20 blur-3xl"></div>

            <div class="relative rounded-[2.2rem] border border-white/10 bg-slate-950/80 p-5 shadow-[0_30px_90px_rgba(0,0,0,0.34)] backdrop-blur-xl">
              <div class="flex items-center justify-between gap-4">
                <div>
                  <div class="text-[11px] font-black uppercase tracking-[0.2em] text-white/45">
                    Contact direct
                  </div>

                  <h3 class="mt-2 text-2xl font-black text-white">
                    Lancer un projet
                  </h3>
                </div>

                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-brand-orange text-white shadow-orange">
                  <MessageCircle :size="24" />
                </div>
              </div>

              <div class="mt-6 grid gap-3">
                <Link
                  href="/contact"
                  class="inline-flex items-center justify-center gap-2 rounded-[1.2rem] bg-brand-orange px-5 py-4 text-sm font-black text-white shadow-orange transition hover:-translate-y-0.5 hover:bg-brand-orange/90"
                >
                  Lancer le projet
                  <ArrowRight :size="18" />
                </Link>

                <a
                  :href="whatsappHref"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="inline-flex items-center justify-center gap-2 rounded-[1.2rem] bg-brand-emerald px-5 py-4 text-sm font-black text-white transition hover:-translate-y-0.5 hover:bg-brand-emerald/90"
                >
                  <MessageCircle :size="18" />
                  Écrire sur WhatsApp
                </a>

                <a
                  :href="contactPhoneHref"
                  class="inline-flex items-center justify-center gap-2 rounded-[1.2rem] border border-white/10 bg-white/[0.08] px-5 py-4 text-sm font-black text-white transition hover:-translate-y-0.5 hover:bg-white/[0.12]"
                >
                  <Phone :size="18" />
                  {{ contactPhoneDisplay }}
                </a>

                <a
                  :href="`mailto:${contactEmail}`"
                  class="inline-flex items-center justify-center gap-2 rounded-[1.2rem] border border-white/10 bg-white/[0.08] px-5 py-4 text-sm font-black text-white transition hover:-translate-y-0.5 hover:bg-white/[0.12]"
                >
                  <Mail :size="18" />
                  {{ contactEmail }}
                </a>
              </div>

              <div class="mt-5 rounded-[1.5rem] border border-white/10 bg-white/[0.06] p-4">
                <div class="flex items-center gap-3">
                  <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white text-brand-blue">
                    <MapPin :size="20" />
                  </div>

                  <div>
                    <div class="text-[10px] font-black uppercase tracking-[0.18em] text-white/40">
                      Basé à
                    </div>

                    <div class="mt-1 text-sm font-black text-white">
                      Cotonou, Bénin
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Floating card -->
            <div class="absolute -right-3 -top-4 hidden rounded-[1.3rem] border border-white/10 bg-white p-4 text-brand-ink shadow-xl lg:block [transform:rotate(7deg)]">
              <Sparkles :size="20" class="text-brand-orange" />
              <div class="mt-2 text-sm font-black">
                Projet prêt ?
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
