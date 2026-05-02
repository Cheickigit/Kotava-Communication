<script setup>
import { Link } from '@inertiajs/vue3';
import { ArrowRight, Mail, Phone, Sparkles } from 'lucide-vue-next';

const contactEmail = 'Contact@kotavacom.com';
const contactPhoneDisplay = '+33 70 89 99 00';
const contactPhoneHref = 'tel:+33708999900';
</script>

<template>
  <section class="relative overflow-hidden bg-white py-20">
    <div class="site-container">
      <div class="relative overflow-hidden rounded-[2rem] bg-brand-dark p-8 text-white shadow-soft sm:p-10 lg:p-14">
        <div class="absolute inset-0 opacity-[0.06] bg-grid-soft"></div>

        <div class="relative grid gap-10 lg:grid-cols-12 lg:items-center">
          <div class="lg:col-span-8">
            <div class="eyebrow-dark">
              <Sparkles :size="14" />
              Ready to build
            </div>

            <h2 class="mt-6 max-w-4xl text-4xl font-black tracking-tight text-white sm:text-5xl lg:text-6xl">
              Votre marque mérite une présence qui marque les esprits.
            </h2>
          </div>

          <div class="flex flex-col gap-3 lg:col-span-4">
            <Link href="/contact" class="btn-primary">
              Lancer le projet
              <ArrowRight :size="18" />
            </Link>

            <a :href="contactPhoneHref" class="btn-light">
              <Phone :size="18" />
              {{ contactPhoneDisplay }}
            </a>

            <a :href="`mailto:${contactEmail}`" class="btn-light">
              <Mail :size="18" />
              {{ contactEmail }}
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
