<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { computed } from 'vue';

const props = defineProps({
    contacts: Array
});

const contacts = computed(() => props.contacts);


const appUrl = import.meta.env.VITE_APP_URL;


const destroy = async (contactId) => {
    if (confirm('Tem certeza que deseja apagar este contato?')) {
        try {
            const form = useForm({
            });
            
            await form.delete(route('contacts.destroy', contactId), {
                preserveState: true,
                onSuccess: () => {
                    console.log('Contato deletado com sucesso!');
                    const updatedContacts = contacts.value.filter(contact => contact.id !== contactId);
                    props.contacts = updatedContacts;
                },
                onError: (errors) => {
                    console.error('Erro ao deletar o contato:', errors);
                }
            });
        } catch (error) {
            console.error('Erro ao executar a operação de deleção:', error);
        }
    }
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="py-6">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 sm:p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium">Contatos</h3>
                            <Link href="/contacts/create" class="inline-block px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-150 ease-in-out">Novo Contato</Link>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Foto</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Nome</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Email</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Contato</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    <tr v-for="contact in contacts" :key="contact.id">
                                        <td class="border px-4 py-2">
                                            <img v-if="contact.foto" :src="`${appUrl}/storage/${contact.foto}`" class="h-12 w-12 rounded-full object-cover" :alt="'Foto de ' + contact.name">
                                            <span v-else>Foto</span>
                                        </td>
                                        <td class="border px-4 py-2 text-sm">{{ contact.name }}</td>
                                        <td class="border px-4 py-2 text-sm">{{ contact.email }}</td>
                                        <td class="border px-4 py-2 text-sm">{{ contact.phone }}</td>
                                        <td class="border px-4 py-2 text-sm">
                                            <Link :href="`/contacts/${contact.id}`" class="px-2 py-1 bg-gray-200 text-gray-700 font-semibold rounded-lg shadow hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-150 ease-in-out text-xs">Ver</Link>
                                            <Link :href="`/contacts/${contact.id}/edit`" class="px-2 py-1 bg-yellow-500 text-white font-semibold rounded-lg shadow hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-150 ease-in-out text-xs">Editar</Link>
                                            <button @click="destroy(contact.id)" class="px-2 py-1 bg-red-500 text-white font-semibold rounded-lg shadow hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-150 ease-in-out text-xs">Apagar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
