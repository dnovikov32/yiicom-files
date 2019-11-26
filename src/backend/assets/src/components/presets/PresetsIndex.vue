<template>

    <div>

        <yc-admin-buttons :model="model"></yc-admin-buttons>

        <div v-html="grid"></div>

    </div>

</template>

<script>
    export default {

        computed: {
            grid () {
                return this.$store.getters['presets/grid'];
            }
        },

        watch: {
            '$route': function () {
                this.$store.dispatch('presets/all', this.$route.query);
            }
        },

        created () {
            this.$store.dispatch('presets/all');
        }

    }
</script>
