<template>
    <div>
        <div>
            <Nav />
        </div>
        <div v-if="alert">
            <Alert :alert="alert"></Alert>
        </div>
        <div class="bg-purple-300">
            <form class="flex" @submit.prevent="submit">
                <div>
                    <select class="p-2 m-2 w-76 border-0 rounded" v-model="form.category" >
                        <option v-for="cat in cats" :value="cat">{{cat}}</option>
                    </select>
                </div>
                <div>
                    <select class="p-2 m-2 w-76 border-0 rounded"  v-model="form.payment_method" >
                        <option v-for="pay in pays" :value="pay">{{pay}}</option>
                    </select>
                </div>
                 <div>
                    <input type="month" v-model="form.month" class="p-1.5 m-2 w-76 border-0 rounded">
                </div>
                 <div>
                    <input type="date" v-model="form.day" class="p-1.5 m-2 w-76 border-0 rounded">
                </div>
                <div>
                    <button class="px-5 py-2 rounded text-white font-bold m-2 bg-purple-500">Filter</button>
                </div>
            </form>
        </div>
        <div class="flex justify-center align-items-center mt-24">
            <table class="border border-purple-200">
                <tr class="border-b-4 border-purple-500">
                    <th class="p-2 text-center">id</th>
                    <th class="p-2 text-center">description</th>
                    <th class="p-2 text-center">date</th>
                    <th class="p-2 text-center">amount</th>
                    <th class="p-2 text-center">category</th>
                    <th class="p-2 text-center">payment_method</th>
                    <th class="p-2 text-center">created_at</th>
                    <th class="p-2 text-center">Modify</th>
                </tr>
                <tr class="border-b-2 border-purple-200" v-for="da of data">
                    <td class="p-2 text-center" v-text="da.id"></td>
                    <td class="p-2 text-center" v-text="da.description"></td>
                    <td class="p-2 text-center" v-text="da.date"></td>
                    <td class="p-2 text-center" v-text="da.amount"></td>
                    <td class="p-2 text-center" v-text="da.category"></td>
                    <td class="p-2 text-center" v-text="da.payment_method"></td>
                    <td class="p-2 text-center" v-text="da.created_at"></td>
                    <td class="p-2 text-center flex">
                        <Link
                            title="update"
                            class="mx-1"
                            :href="'/update/' + da.id"
                            ><img
                                width="25"
                                src="/icons/edit.png"
                                alt="trash"
                                srcset=""
                        /></Link>
                        <button @click="del(da.id)" class="">
                            <img
                                width="25"
                                src="/icons/trash-bin.png"
                                alt="trash"
                                srcset=""
                            />
                        </button>
                        <Link
                            id="del"
                            class="hidden"
                            href="/delete"
                            method="delete"
                            :data="{ id: da.id }"
                        ></Link>
                    </td>
                </tr>
                <tr>
                    <th colspan='8'>Total: ₹ {{sum}}</th>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
import Nav from "../Includes/Nav";
import Alert from "../Includes/Alert";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { reactive } from "vue";

export default {
    components: { Nav, Link, Alert },
    props: {
        data: Array,
        time: String,
        alert: String,
        cats: Array,
        pays: Array,
        sum: Number,
    },
    setup(){
        const form = {}
        function submit()
        {
            Inertia.post('/view', form);
        }
        return { form, submit };
    },
    methods: {
        del: function (user_id) {
            if (confirm("Are you sure ?")) {
                document.getElementById("del").click();
            } else false;
        },
    },
};
</script>

<style lang="scss" scoped></style>
