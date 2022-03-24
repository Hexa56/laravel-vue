<template>
    <div class="w-full">
        <header>
            <nav
                class="flex justify-between w-full bg-purple-500 text-white p-4"
            >
                <Link href="/home"
                    ><span class="font-semibold text-xl tracking-tight"
                        >Expense Tracker</span
                    ></Link
                >
                <div class="md:items-center md:w-auto flex">
                    <div class="flex" :class = "{'hidden' :$page.component == 'Index' || $page.component == 'Register'}">
                        <Link class="block md:text-white mr-4" href="/addexpense"
                            >Add Expense</Link
                        >
                        <Link class="block md:text-white mr-4" href="/view"
                            >view Expense</Link
                        >
                        <Link class="block md:text-white mr-4" href="/summery"
                            >Summery</Link
                        >
                        <Link class="block md:text-white mr-4" href="/logout"
                            >Logout</Link
                        >
                    </div>
                    <div class="flex text-sm" :class="{'hidden' :$page.component != 'Index' || $page.component != 'Register'}">
                        <Link
                            class="p-2 ml-2 bg-white text-teal-500 font-semibold leading-none border border-gray-100 rounded hover:border-transparent hover:bg-gray-100"
                            href="/login"
                            >Login</Link
                        >
                        <Link
                            class="p-2 ml-2 bg-teal-500 text-gray-100 font-semibold leading-none border border-teal-600 rounded hover:border-transparent hover:bg-teal-600"
                            href="/signup"
                            >Sign up</Link
                        >
                    </div>
                </div>
            </nav>
        </header>
        <main class="flex justify-center items-center">
        </main>
        <div class="bottomNav fixed bottom-0 w-full">
            <nav
                style="border: 1px solid blue"
                class="md:hidden bottom-0 w-full bg-gray-700 text-xs"
            >
                <ul
                    class="flex justify-around items-center text-white text-center opacity-75 text-lg font-bold"
                >
                    <li class="p-4 hover:bg-gray-500">
                        <Link href="/link">
                            <span>Link 1</span>
                            <svg
                                class="h-6 w-6 fill-current mx-auto"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M14 8a4 4 0 1 0-8 0v7h8V8zM8.027 2.332A6.003 6.003 0 0 0 4 8v6l-3 2v1h18v-1l-3-2V8a6.003 6.003 0 0 0-4.027-5.668 2 2 0 1 0-3.945 0zM12 18a2 2 0 1 1-4 0h4z"
                                    fill-rule="evenodd"
                                />
                            </svg>
                        </Link>
                    </li>
                    <li class="p-4 hover:bg-gray-500">
                        <Link href="/link">
                            <span>Link 2</span>
                            <svg
                                class="h-6 w-6 fill-current mx-auto"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M14 8a4 4 0 1 0-8 0v7h8V8zM8.027 2.332A6.003 6.003 0 0 0 4 8v6l-3 2v1h18v-1l-3-2V8a6.003 6.003 0 0 0-4.027-5.668 2 2 0 1 0-3.945 0zM12 18a2 2 0 1 1-4 0h4z"
                                    fill-rule="evenodd"
                                />
                            </svg>
                        </Link>
                    </li>
                    <li class="p-4 hover:bg-gray-500">
                        <Link href="/link">
                            <span>Link 3</span>
                            <svg
                                class="h-6 w-6 fill-current mx-auto"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M14 8a4 4 0 1 0-8 0v7h8V8zM8.027 2.332A6.003 6.003 0 0 0 4 8v6l-3 2v1h18v-1l-3-2V8a6.003 6.003 0 0 0-4.027-5.668 2 2 0 1 0-3.945 0zM12 18a2 2 0 1 1-4 0h4z"
                                    fill-rule="evenodd"
                                />
                            </svg>
                        </Link>
                    </li>
                    <li class="p-4 hover:bg-gray-500">
                        <Link href="/link">
                            <span>Link 4</span>
                            <svg
                                class="h-6 w-6 fill-current mx-auto"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M14 8a4 4 0 1 0-8 0v7h8V8zM8.027 2.332A6.003 6.003 0 0 0 4 8v6l-3 2v1h18v-1l-3-2V8a6.003 6.003 0 0 0-4.027-5.668 2 2 0 1 0-3.945 0zM12 18a2 2 0 1 1-4 0h4z"
                                    fill-rule="evenodd"
                                />
                            </svg>
                        </Link>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
    components: { Link },
};
</script>

<style lang="scss" scoped></style>
