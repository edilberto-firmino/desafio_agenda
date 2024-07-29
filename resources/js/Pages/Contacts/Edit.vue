<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="max-w-md w-full p-8 bg-white dark:bg-gray-800 rounded-lg shadow-md">
      <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-6">Editar Contato</h1>
      <form @submit.prevent="submit">
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
        <button
          type="submit"
          class="w-full px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-700"
        >
          Atualizar
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

const { props } = usePage();
const contact = props.contact;

const form = useForm({
  name: '',
  email: '',
  phone: ''
});

const phoneError = ref('');

onMounted(() => {
  form.name = contact.name;
  form.email = contact.email;
  form.phone = contact.phone;
});

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

  form.patch(route('contacts.update', contact.id), {
    onSuccess: () => {
      console.log('Contato atualizado com sucesso!');
    },
    onError: (errors) => {
      console.error('Erro ao atualizar contato:', errors);
    },
    preserveState: true,
  });
};
</script>

<style scoped>
body {
  font-family: 'Inter', sans-serif;
}
</style>
