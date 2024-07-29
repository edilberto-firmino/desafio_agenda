<template>
  <GuestLayout>
    <div class="max-w-2xl mx-auto p-8 bg-white dark:bg-gray-800 rounded-lg shadow-md">
      <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-6">Detalhes do Contato</h1>
      
      <div class="mb-4">
        <InputLabel for="name" value="Name" />
        <p class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-100 dark:bg-gray-700">
          {{ contact.name }}
        </p>
      </div>
      
      <div class="mb-4">
        <InputLabel for="email" value="Email" />
        <p class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-100 dark:bg-gray-700">
          {{ contact.email }}
        </p>
      </div>
      
      <div class="mb-4">
        <InputLabel for="phone" value="Phone" />
        <p class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md bg-gray-100 dark:bg-gray-700">
          {{ contact.phone }}
        </p>
      </div>
      
      <div v-if="contact.foto" class="mb-4">
        <InputLabel for="foto" value="Photo" />
        <img :src="`/storage/${contact.foto}`" alt="Contact Photo" class="w-full rounded-lg">
      </div>
      
    </div>
  </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { defineProps } from 'vue';

const props = defineProps({
  contact: {
    type: Object,
    required: true
  }
});
</script>
