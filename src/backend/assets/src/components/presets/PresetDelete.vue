<template>

</template>

<script>

    export default {
        // TODO: must be removed
        created () {
            this.$store.dispatch('files-presets/delete', this.$route.query.id).then(() => {
                this.$notify({type: 'success', text: 'Пресет удален'});
                this.$store.dispatch('commerce/fetchSettings');
                this.$router.push({ path: '/files/preset/index' });
            });
        }
    }

</script>
