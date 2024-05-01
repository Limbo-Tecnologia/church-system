<script setup>
import MagnifyingGlass from "@/Components/Icons/MagnifyingGlass.vue";
import Pagination from "@/Components/Pagination.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, useForm, usePage } from "@inertiajs/vue3";
import { ref, watch, computed } from "vue";
import { PencilAltIcon } from "@vue-hero-icons/outline";

defineProps({
    churchs: {
        type: Object,
    },
});

let pageNumber = ref(1),
    searchTerm = ref(usePage().props.search ?? "");

const pageNumberUpdated = (link) => {
    pageNumber.value = link.url.split("=")[1];
};

let churchsUrl = computed(() => {
    const url = new URL(route("igrejas.index"));

    url.searchParams.set("page", pageNumber.value);

    if (searchTerm.value) {
        url.searchParams.set("search", searchTerm.value);
    }

    return url;
});

watch(
    () => churchsUrl.value,
    (newValue) => {
        router.visit(newValue, {
            replace: true,
            preserveState: true,
            preserveScroll: true,
        });
    }
);

const deleteForm = useForm({});

const deleteChurch = (id) => {
    if (confirm("Você tem certeza que quer deletar essa igreja?")) {
        deleteForm.delete(route("igrejas.destroy", id), {
            preserveScroll: true,
        });
    }
};
</script>

<template>

    <Head title="Churchs" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Churchs
            </h2>
        </template>
        <div class="bg-gray-100 py-10">
            <div class="mx-auto max-w-7xl">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-gray-900">
                                Churchs
                            </h1>
                            <p class="mt-2 text-sm text-gray-700">
                                Lista de todas as igrejas cadastradas.
                            </p>
                        </div>

                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <Link :href="route('igrejas.create')"
                                class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                            Criar Igreja
                            </Link>
                        </div>
                    </div>

                    <div class="flex flex-col justify-between sm:flex-row mt-6">
                        <div class="relative text-sm text-gray-800 col-span-3">
                            <div
                                class="absolute pl-2 left-0 top-0 bottom-0 flex items-center pointer-events-none text-gray-500">
                                <MagnifyingGlass />
                            </div>

                            <!-- <input type="text" v-model="searchTerm" placeholder="Search churchs data..." id="search"
                                class="block rounded-lg border-0 py-2 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" /> -->
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div
                                    class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg relative">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-xs md:text-sm font-semibold text-gray-900 sm:pl-6">
                                                    Nome
                                                </th>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-xs md:text-sm font-semibold text-gray-900 sm:pl-6">
                                                    Email
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-xs md:text-sm font-semibold text-gray-900 hidden md:table-cell">
                                                    Pastor Presidente
                                                </th>
                                                <th scope="col"
                                                    class=" px-3 py-3.5 text-left text-xs md:text-sm font-semibold text-gray-900">
                                                    Membros
                                                </th>
                                                <th scope="col"
                                                    class=" px-3 py-3.5 text-left text-xs md:text-sm font-semibold text-gray-900">
                                                    Fundada em
                                                </th>
                                                <th scope="col"
                                                    class=" px-3 py-3.5 text-left text-xs md:text-sm font-semibold text-gray-900" />
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            <tr v-for="church in churchs.data" :key="church.id">
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-xs md:text-sm font-medium text-gray-900 sm:pl-6">
                                                    {{ church.name }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-3 py-4 text-xs md:text-sm text-gray-500">
                                                    {{ church.email }}
                                                </td>
                                                <td
                                                    class="px-3 py-4 text-xs md:text-sm text-gray-500 hidden md:table-cell">
                                                    {{ church.pastor_president.name }}
                                                </td>
                                                <td
                                                    class=" whitespace-nowrap px-3 py-4 text-xs md:text-sm text-gray-500">
                                                    {{ church.members_count }}
                                                </td>
                                                <td
                                                    class=" whitespace-nowrap px-3 py-4 text-xs md:text-sm text-gray-500">
                                                    {{ church.foundation_date }}
                                                </td>

                                                <td class="ml-2 text-indigo-600 hover:text-indigo-900 flex mt-3">
                                                    <Link :href="route(
                                                        'igrejas.show',
                                                        church.id
                                                    )" class="text-indigo-600 hover:text-indigo-900">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                    </svg>
                                                    </Link>

                                                    <Link :href="route(
                                                        'igrejas.edit',
                                                        church.id
                                                    )" class="ml-2 text-indigo-600 hover:text-indigo-900">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                    </svg>
                                                    </Link>
                                                    <button @click="
                                                        deleteChurch(
                                                            church.id
                                                        )
                                                        " class="ml-2 text-indigo-600 hover:text-indigo-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>

                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                                <Pagination :data="churchs" :pageNumberUpdated="pageNumberUpdated" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>