

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Env Editor</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

                <div class="overflow-x-auto">

                    <!-- component -->
                    <div class="max-w-2xl mx-auto p-4">
                        <div class="inline-block min-w-full py-2 align-middle">
                            <div class="overflow-hidden      ring-opacity-5 md:rounded-lg">
                                <div class="w-full ">
                                <form  @submit.prevent="submit" class="bg-white shadow-md rounded   p-3 mb-4">

                                    <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="key">
                                        Key
                                    </label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="key" type="text" v-model="form.key" >

                                    </div>
                                    <div class="mb-6">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="value">
                                    Enter new Value
                                    </label>
                                    <input  v-model="form.value"  class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3
                                    leading-tight focus:outline-none focus:shadow-outline" id="value" type="text" >

                                    </div>
                                    <div class="flex items-center justify-between">
                                    <button @click="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">

                                        {{ props.envKey ? 'update': 'Add' }}
                                    </button>

                                    </div>
                                </form>

                    </div>



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
import { Head, Link, useForm } from '@inertiajs/vue3';


const props = defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },

    envKey: {
        type: String,
    },
});



const key =  props?.envKey;
const value =  props?.value;

const form = useForm({
    key:key,
    value:value,

})

const submit = () => {


    form.post(key ? route('env-editor.update') : route('env-editor.store' ), {
        preserveState: true,
        onSuccess: () => {
            is_create && (form.reset());
        },
    })
}

</script>
