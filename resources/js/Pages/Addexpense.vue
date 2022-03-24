<template>
    <div>
    <Nav/>
    
    <div class="container flex justify-center mt-24 fixed h-full w-full ">
        
    <form class="form flex flex-col w-96 h-full" @submit.prevent="submit">
        <h2 class="text-xl font-bold m-2">Add Expense</h2>
        <input class="p-2 border m-2 rounded" type="text" v-model="form.description" placeholder="description">
        <input class="p-2 border m-2 rounded" type="number" v-model="form.amount" placeholder="amount"> 
        <select class="p-2 border m-2 rounded" v-model="form.category" id="" title="Select Category">
            <option v-for="cat in cats" :value="cat">{{cat}}</option>
        </select>
        <select class="p-2 border m-2 rounded" v-model="form.payment_method" id="" title="Payment_method">
            <option v-for="paymth in paymths" :value="paymth">{{paymth}}</option>
        </select>
        <button type="submit" :disabled="form.processing" class="bg-black text-white py-2 m-2 rounded">Add</button>
    </form>
    </div>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div id="model" v-if="model" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
    
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Successfully Added</h3>
                        
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button onclick="hidemodel()" type="button"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Ok</button>
                    
                </div>
            </div>
        </div>
    </div>

    
    </div>
</template>

<script>
import Nav from "../Includes/Nav";
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'
    
    export default {
        
        setup () {
           const form = reactive({
                description: null,
                amount: null,
                category: null,
                payment_method: null,
            });

            function submit() {
            Inertia.post('/addexpense', form)
                form.description = '';
                form.amount = '';
                    
            }

            return { form, submit }
        },
        components: {Nav},
        props: {
            model: String,
            cats: Array,
            paymths: Array,
            errors: Object,
        },

      
        
    }
    
</script>

<style lang="scss" scoped>

</style>