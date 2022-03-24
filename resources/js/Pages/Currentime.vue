<template>
    <div>
        <div>
            <Link href="/time">Refresh</Link>
        </div>
        <div class="text-center mt-56">
            <h1 class="text-xl font-bold">Current Time</h1>
            <h2 class="text-l">{{ time }}</h2>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
    components: { Link },
    props: {
        time: String,
    },
};
</script>

<style lang="scss" scoped></style>
