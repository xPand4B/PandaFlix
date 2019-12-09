<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: "App",

        mounted: () => {
            console.log('Vue mounted successfully.')
        }
    }
</script>
