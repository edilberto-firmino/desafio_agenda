<script setup>
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Welcome" />
    <div class="bg-gray-50 text-black dark:bg-black dark:text-white min-h-screen flex flex-col items-center justify-center">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-6">Bem-Vindo ao Desafio Agenda</h1>
            <p class="mb-6 text-lg">Video de Apresentação do Projeto.</p>



            <div class="mb-6">
                <iframe
                    width="560"
                    height="315"
                    src="https://www.youtube.com/embed/WekOmX3gfLk?si=AaGbbG2SXAVTULOa"
                    title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen
                ></iframe>
            </div>

            <p class="mb-6 text-lg">Por favor, Se não Estiver Registro, então Registri-se primeiro.</p>

            <div class="flex flex-col gap-4 sm:flex-row sm:gap-4 justify-center">
                <a
                    href="/login"
                    class="px-4 py-2 bg-blue-500 text-white rounded-md text-sm font-medium hover:bg-blue-600 transition"
                >
                    Login
                </a>

                <a
                    href="/register"
                    class="px-4 py-2 bg-green-500 text-white rounded-md text-sm font-medium hover:bg-green-600 transition"
                >
                    Register
                </a>

                <a
                    href="/dashboard"
                    class="px-4 py-2 bg-gray-500 text-white rounded-md text-sm font-medium hover:bg-gray-600 transition"
                >
                    Dashboard
                </a>
            </div>
        </div>
    </div>
</template>

<style scoped>
iframe {
    max-width: 100%;
    height: auto;
}
</style>
