<template>

</template>

<script>
    import Swal from "sweetalert2";

    export default {
        name: "Noty",
        created() {
            window.events.$on('notification', (payload) => {
                Swal.fire(payload.message)
            });
        }
    }
</script>

<style scoped>
    .alert-noty{ position: fixed; right: 20px; bottom: 40px; z-index: 1; }
</style>