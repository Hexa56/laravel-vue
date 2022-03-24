<template>
    <div>
    <Link :class="{ 'font-bold underline' :active }">
    <slot />
    </Link>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
    export default {
       components: { Link },
       props:{
           active: Boolean,
       }
    }
</script>

<style lang="scss" scoped>

</style>