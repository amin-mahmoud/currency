<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid gap-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5">
                    <div class="p-6 text-gray-900">
                        <div class="flex flex-col">
                            <div class="-m-1.5 overflow-x-auto">
                                <div class="p-1.5 min-w-full inline-block align-middle">
                                    <div class="overflow-hidden">
                                        <div class="max-w-sm space-y-3">
                                            <label>Enter your currency amount </label>
                                            <input type="number" max="10000000" v-model="amount"
                                            @change="storeAmount"
                                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-bold
                                            disabled:opacity-50 disabled:pointer-events-none" placeholder="Enter your currency amount">

                                            <button type="button"  class="bg-blue-500 hover:bg-blue-700 text-white font-bold
                                                 py-2 px-4 rounded focus:outline-none focus:shadow-outline"  >

                                                Save
                                            </button>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-4 gap-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5">
                    <div class="p-6 text-gray-900">
                        <div class="flex flex-col">
                            <div class="-m-1.5 overflow-x-auto">
                                <div class="p-1.5 min-w-full inline-block align-middle">
                                    <div class="overflow-auto">
                                        <h2 class="mb-3">History</h2>
                                        <ul class="marker:text-blue-600 list-disc ps-5 space-y-2 text-bold text-gray-600 dark:text-neutral-400">
                                            <li  :class=" history.amount == amount ? 'cursor-pointer bg-gray-100 p-1 rounded-1' : 'cursor-pointer  p-1 rounded-1'" @click="setAmount(history.amount)" v-for="history in histories" :key="history.id">
                                                {{ history.amount }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden col-span-3 shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex flex-col">
                            <div class="-m-1.5 overflow-x-auto">
                                <div class="p-1.5 min-w-full inline-block align-middle">
                                    <div class="overflow-hidden">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Currency</th>
                                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Exchange rate</th>
                                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Equivalent</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                                <tr v-for="rate in exchange_rates" :key="rate.key">
                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-bold font-medium text-gray-800">
                                                        {{ rate.key.replace('_RATE', '') }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-bold text-gray-800">{{ rate.value }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-center text-bold text-gray-800">{{ (amount * rate.value).toFixed(2) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
import { Head , useForm} from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const amount = ref(0);

const props = defineProps({
    mustVerifyEmail: Boolean,
    status: String,
    exchange_rates: Object,
    histories: Object,
});

const setAmount = (HistoryAmount)=> {

    amount.value = HistoryAmount;
}


const form = useForm({
    NewAmount:amount.value,
})


function storeAmount(){

    form.NewAmount  = amount;

    if(form.NewAmount){
        form.post( route('stor-amount'), {
            preserveState: true,
            onSuccess: () => {
                is_create && (form.reset());
            },
        })

}
}

</script>
