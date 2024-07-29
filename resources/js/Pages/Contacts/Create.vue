<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="max-w-md w-full p-8 bg-white dark:bg-gray-800 rounded-lg shadow-md">
      <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-6">Criar Contato</h1>
      <form @submit.prevent="submit" enctype="multipart/form-data">
        <div class="mb-4">
          <label for="name" class="block text-gray-700 dark:text-gray-300 mb-2">Nome</label>
          <input
            id="name"
            v-model="form.name"
            type="text"
            placeholder="Name"
            required
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:ring focus:border-blue-300 dark:focus:border-blue-700"
          />
        </div>
        <div class="mb-4">
          <label for="email" class="block text-gray-700 dark:text-gray-300 mb-2">Email</label>
          <input
            id="email"
            v-model="form.email"
            type="email"
            placeholder="Email"
            required
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:ring focus:border-blue-300 dark:focus:border-blue-700"
          />
          <p v-if="form.errors.email" class="text-red-500 text-sm mt-1">E-mail já existente.</p>
        </div>
        <div class="mb-4">
          <label for="phone" class="block text-gray-700 dark:text-gray-300 mb-2">Celular</label>
          <input
            id="phone"
            v-model="form.phone"
            type="text"
            placeholder="Phone"
            @input="validatePhone"
            @keypress="filterNonNumeric"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:ring focus:border-blue-300 dark:focus:border-blue-700"
          />
          <p v-if="phoneError" class="text-red-500 text-sm mt-1">{{ phoneError }}</p>
        </div>
        <div class="mb-4">
          <label for="foto" class="block text-gray-700 dark:text-gray-300 mb-2">Foto</label>
          <input
            id="foto"
            type="file"
            accept="image/*"
            @change="handleFileUpload"
            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md focus:outline-none focus:ring focus:border-blue-300 dark:focus:border-blue-700"
          />
        </div>
        <button
          type="submit"
          class="w-full px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-700"
        >
          Criar
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  name: '',
  email: '',
  phone: '',
  foto: null
});

const phoneError = ref('');

const filterNonNumeric = (event) => {
  const keyCode = event.keyCode || event.which;
  const key = String.fromCharCode(keyCode);
  if (!/^\d$/.test(key)) {
    event.preventDefault(); 
  }
};

const validatePhone = () => {
  const numericPhone = form.phone.replace(/\D/g, '');
  if (numericPhone.length > 11) {
    phoneError.value = 'O número de celular não pode exceder 11 caracteres.';
  } else {
    phoneError.value = '';
  }
  form.phone = numericPhone; 
};

const submit = () => {
  if (phoneError.value) {
    return; 
  }

  form.post(route('contacts.store'), {
    onSuccess: () => {
      form.reset();
    },
    onError: (errors) => {
      if (errors.email) {
        form.errors.email = errors.email[0];
      }
    }
  });
};

const handleFileUpload = (event) => {
  form.foto = event.target.files[0];
};
</script>

<style scoped>
body {
  font-family: 'Inter', sans-serif;
}
</style>
