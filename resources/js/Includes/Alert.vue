<template>
    <div class='w-full bg-green-400 text-white p-3'>
        <h5 class='text-xl'>{{alert}}</h5>
    </div>
</template>

<script>
    export default {
        props:{
            alert: String,
        }
    }
</script>

<style lang="scss" scoped>

</style>