<template>

</template>

<script>

    export default {
        // TODO: must be removed
        created () {
            this.$store.dispatch('presets/delete', this.$route.query.id).then(() => {
                this.$notify({type: 'success', text: 'Пресет удален'});
                this.$store.dispatch('settings');
                this.$router.push({ path: '/files/preset/index' });
            });
        }
    }

</script>
