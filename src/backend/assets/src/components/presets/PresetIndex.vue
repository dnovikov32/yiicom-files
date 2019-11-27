<template>

    <div>

        <yc-admin-buttons></yc-admin-buttons>

        <div v-html="grid"></div>

    </div>

</template>

<script>
    export default {

        computed: {
            grid () {
                return this.$store.getters['files-presets/grid'];
            }
        },

        watch: {
            '$route': function () {
                this.$store.dispatch('files-presets/all', this.$route.query);
            }
        },

        created () {
            this.$store.dispatch('files-presets/all');
        }

    }
</script>
