<template>
  <GuestLayout>
    <Head title="À propos - KOTAVA Communication" />

    <!-- Hero Section -->
    <section class="relative py-24 bg-gradient-to-br from-[#0e437d] via-[#1c978a] to-[#22ae84] overflow-hidden">
      <!-- Animated Background -->
      <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl animate-pulse delay-1000"></div>
      </div>

      <div class="relative max-w-6xl mx-auto px-6 text-center">
        <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-6 py-2 rounded-full text-white mb-8">
          <svg class="w-5 h-5 text-[#22ae84]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span class="text-sm font-semibold">Notre Histoire</span>
        </div>

        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">
          À propos de <span class="bg-gradient-to-r from-[#22ae84] to-[#1c978a] bg-clip-text text-transparent">KOTAVA</span>
        </h1>

        <p class="text-xl text-white/90 max-w-3xl mx-auto leading-relaxed">
          Redéfinir la communication comme une expérience sensorielle et émotionnelle,
          où chaque interaction devient une connexion authentique entre les marques et leur audience.
        </p>
      </div>
    </section>

    <!-- Notre Histoire -->
    <section class="py-24 bg-white">
      <div class="max-w-6xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
          <!-- Texte -->
          <div>
            <h2 class="text-4xl font-bold text-gray-900 mb-6">
              Notre <span class="text-[#22ae84]">Histoire</span>
            </h2>

            <div class="space-y-4 text-gray-600">
              <p>
                Fondée avec une vision claire, <strong>KOTAVA Communication</strong> est née de la passion
                pour la transformation digitale des entreprises africaines. Notre parcours a débuté par
                une observation simple mais puissante : de nombreuses entreprises possèdent un potentiel
                extraordinaire, mais manquent d'une identité digitale forte pour le révéler.
              </p>

              <p>
                Nous croyons fermement que chaque marque a une histoire unique à raconter.
                Notre mission est de donner vie à ces histoires à travers des solutions de communication
                innovantes, créatives et stratégiques.
              </p>

              <p>
                Aujourd'hui, KOTAVA s'est imposée comme un partenaire de confiance pour les entreprises
                qui aspirent à l'excellence digitale, en combinant expertise technique, créativité
                et profonde compréhension des marchés africains.
              </p>
            </div>

            <!-- Chiffres clés -->
            <div class="grid grid-cols-2 gap-6 mt-10">
              <div class="text-center p-6 bg-gradient-to-br from-gray-50 to-white rounded-2xl border border-gray-100">
                <div class="text-3xl font-bold text-[#0e437d] mb-2">50+</div>
                <div class="text-gray-600">Clients satisfaits</div>
              </div>
              <div class="text-center p-6 bg-gradient-to-br from-gray-50 to-white rounded-2xl border border-gray-100">
                <div class="text-3xl font-bold text-[#22ae84] mb-2">100+</div>
                <div class="text-gray-600">Projets réalisés</div>
              </div>
            </div>
          </div>

          <!-- Image/Illustration -->
          <div class="relative">
            <div class="aspect-square rounded-3xl overflow-hidden bg-gradient-to-br from-[#0e437d]/10 to-[#22ae84]/10">
              <div class="w-full h-full flex items-center justify-center p-8">
                <div class="text-center">
                  <div class="w-32 h-32 bg-gradient-to-br from-[#0e437d] to-[#22ae84] rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-2xl">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                  </div>
                  <h3 class="text-2xl font-bold text-gray-900 mb-2">KOTAVA Communication</h3>
                  <p class="text-gray-600">Depuis 2023</p>
                </div>
              </div>
            </div>

            <!-- Décoration -->
            <div class="absolute -top-4 -right-4 w-24 h-24 bg-gradient-to-br from-[#1c978a] to-[#178e8b] rounded-2xl blur-xl opacity-30"></div>
            <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-gradient-to-br from-[#0e437d] to-[#22ae84] rounded-2xl blur-xl opacity-30"></div>
          </div>
        </div>
      </div>
    </section>

    <!-- Notre Vision & Mission -->
    <section class="py-24 bg-gradient-to-br from-gray-50 to-white">
      <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold text-gray-900 mb-4">
            Notre <span class="text-[#22ae84]">Vision</span> & <span class="text-[#0e437d]">Mission</span>
          </h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Les principes fondateurs qui guident chaque décision et chaque projet
          </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
          <!-- Vision -->
          <div class="bg-white rounded-3xl p-8 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-500">
            <div class="w-16 h-16 bg-gradient-to-br from-[#0e437d] to-[#22ae84] rounded-2xl flex items-center justify-center mb-6">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>
            </div>

            <h3 class="text-2xl font-bold text-gray-900 mb-4">Notre Vision</h3>

            <div class="space-y-4 text-gray-600">
              <p>
                Être le <strong>catalyseur de la transformation digitale</strong> des entreprises africaines,
                en redéfinissant les standards d'excellence dans la communication.
              </p>

              <p>
                Nous aspirons à créer un écosystème où chaque marque peut exprimer son plein potentiel
                à travers des expériences digitales mémorables et impactantes.
              </p>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-100">
              <h4 class="font-semibold text-gray-900 mb-3">Notre ambition :</h4>
              <ul class="space-y-2 text-gray-600">
                <li class="flex items-start gap-2">
                  <svg class="w-5 h-5 text-[#22ae84] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                  <span>Devenir la référence en communication digitale en Afrique</span>
                </li>
                <li class="flex items-start gap-2">
                  <svg class="w-5 h-5 text-[#22ae84] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                  <span>Inspirer l'innovation et la créativité dans l'industrie</span>
                </li>
                <li class="flex items-start gap-2">
                  <svg class="w-5 h-5 text-[#22ae84] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                  <span>Former la prochaine génération de communicateurs digitaux</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- Mission -->
          <div class="bg-white rounded-3xl p-8 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-500">
            <div class="w-16 h-16 bg-gradient-to-br from-[#22ae84] to-[#1c978a] rounded-2xl flex items-center justify-center mb-6">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>

            <h3 class="text-2xl font-bold text-gray-900 mb-4">Notre Mission</h3>

            <div class="space-y-4 text-gray-600">
              <p>
                <strong>Accompagner nos clients</strong> dans leur transformation digitale en proposant
                des solutions sur-mesure qui allient stratégie, créativité et technologie.
              </p>

              <p>
                Notre mission quotidienne est de comprendre les défis uniques de chaque entreprise
                et de traduire leurs objectifs en résultats concrets et mesurables.
              </p>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-100">
              <h4 class="font-semibold text-gray-900 mb-3">Nos engagements :</h4>
              <ul class="space-y-2 text-gray-600">
                <li class="flex items-start gap-2">
                  <svg class="w-5 h-5 text-[#0e437d] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                  <span>Excellence et qualité dans chaque projet</span>
                </li>
                <li class="flex items-start gap-2">
                  <svg class="w-5 h-5 text-[#0e437d] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                  <span>Approche personnalisée et centrée sur le client</span>
                </li>
                <li class="flex items-start gap-2">
                  <svg class="w-5 h-5 text-[#0e437d] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                  <span>Innovation constante et veille technologique</span>
                </li>
                <li class="flex items-start gap-2">
                  <svg class="w-5 h-5 text-[#0e437d] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                  <span>Transparence et communication régulière</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Nos Valeurs -->
    <section class="py-24 bg-white">
      <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold text-gray-900 mb-4">
            Nos <span class="text-[#22ae84]">Valeurs</span>
          </h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Les principes qui guident nos actions et nos relations
          </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <!-- Valeur 1 -->
          <div class="text-center p-8 bg-gradient-to-br from-gray-50 to-white rounded-3xl border border-gray-100 hover:shadow-xl transition-all duration-500">
            <div class="w-20 h-20 bg-gradient-to-br from-[#0e437d] to-[#22ae84] rounded-2xl flex items-center justify-center mx-auto mb-6">
              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Créativité & Innovation</h3>
            <p class="text-gray-600">
              Nous repoussons constamment les limites pour offrir des solutions uniques et impactantes.
            </p>
          </div>

          <!-- Valeur 2 -->
          <div class="text-center p-8 bg-gradient-to-br from-gray-50 to-white rounded-3xl border border-gray-100 hover:shadow-xl transition-all duration-500">
            <div class="w-20 h-20 bg-gradient-to-br from-[#22ae84] to-[#1c978a] rounded-2xl flex items-center justify-center mx-auto mb-6">
              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Confiance & Transparence</h3>
            <p class="text-gray-600">
              Nous construisons des relations durables basées sur l'honnêteté et la franchise.
            </p>
          </div>

          <!-- Valeur 3 -->
          <div class="text-center p-8 bg-gradient-to-br from-gray-50 to-white rounded-3xl border border-gray-100 hover:shadow-xl transition-all duration-500">
            <div class="w-20 h-20 bg-gradient-to-br from-[#1c978a] to-[#178e8b] rounded-2xl flex items-center justify-center mx-auto mb-6">
              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Collaboration</h3>
            <p class="text-gray-600">
              Nous travaillons main dans la main avec nos clients pour des résultats exceptionnels.
            </p>
          </div>

          <!-- Valeur 4 -->
          <div class="text-center p-8 bg-gradient-to-br from-gray-50 to-white rounded-3xl border border-gray-100 hover:shadow-xl transition-all duration-500">
            <div class="w-20 h-20 bg-gradient-to-br from-[#178e8b] to-[#0e437d] rounded-2xl flex items-center justify-center mx-auto mb-6">
              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Excellence</h3>
            <p class="text-gray-600">
              Nous visons la perfection dans chaque détail pour dépasser les attentes.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Final -->
    <section class="py-24 bg-gradient-to-br from-[#0e437d] via-[#1c978a] to-[#22ae84] relative overflow-hidden">
      <div class="absolute inset-0 opacity-20">
        <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl animate-pulse delay-1000"></div>
      </div>

      <div class="relative max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
          Prêt à Écrire Votre Histoire ?
        </h2>
        <p class="text-xl text-white/90 mb-10">
          Rejoignez les entreprises qui nous font confiance pour leur transformation digitale
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <Link
            href="/contact"
            class="inline-flex items-center gap-2 bg-white text-[#0e437d] px-8 py-4 rounded-xl font-semibold text-lg shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300"
          >
            Nous Contacter
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
          </Link>

          <Link
            href="/services"
            class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/30 text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-white/20 transition-all duration-300"
          >
            Découvrir nos Services
          </Link>
        </div>
      </div>
    </section>
  </GuestLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
</script>

<style scoped>
@keyframes pulse {
  0%, 100% {
    opacity: 0.3;
  }
  50% {
    opacity: 0.5;
  }
}

.delay-1000 {
  animation-delay: 1s;
}
</style>
