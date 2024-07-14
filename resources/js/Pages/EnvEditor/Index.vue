

<template>
    <Head title="Exchange Rates" />

    <AuthenticatedLayout>
 

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

                <div class="overflow-x-auto">

                    <!-- component -->
<div class="max-w-7xl mx-auto">
    <div class="inline-block min-w-full py-2 align-middle">

        <Link :href="route('env-editor.create', envKey?.key)"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4   rounded"
          role="menuitem" tabindex="-1" id="menu-item-0">
            create

        </Link>
        <div class="overflow-hidden shadow ring-1 ring-black mt-4 ring-opacity-5 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="py-2  text-start px-4">Key</th>
                <th scope="col" class="py-3.5 pl-4 pr-3  text-start text-sm font-semibold text-gray-900">Value</th>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-center text-sm font-semibold text-gray-900">Actions</th>

                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">

                    <tr v-for="envKey in envValues" >

                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm  text-start font-semibold text-gray-900 sm:pl-6"  v-if="!envKey.isSeparator">{{envKey.key}}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm  text-start text-gray-500"  v-if="!envKey.isSeparator">{{envKey.value}}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-center"  v-if="!envKey.isSeparator">
                            <Link :href="route('env-editor.edit', envKey.key)" class="text-gray-500 font-medium hover:text-gray-900 hover:bg-gray-50   px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">
                            Edit
                        </Link>
                         <Link :href="route('env-editor.destroy', envKey.key)" :method="'POST'" class="text-red-500 font-medium hover:text-red-900 hover:bg-red-50   px-4 py-2 text-sm"
                          role="menuitem" tabindex="-1" id="menu-item-0">

                            Delete
                        </Link>

                        </td>


                    </tr>


                </tbody>
            </table>
        </div>
    </div>
</div>


</div>


            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>


import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';


defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    envValues: {
        type: Object,
    },
});
</script>
