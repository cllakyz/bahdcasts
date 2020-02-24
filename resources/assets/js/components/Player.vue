<template>
    <div>
        <div data-vimeo-id="19231868" id="handstick"></div>
    </div>
</template>

<script>
    import Player from '@vimeo/player';
    export default {
        name: "Player",
        mounted() {
            const player = new Player('handstick');
            player.on('play', () => {
                console.log('our video is playing');
            });
        }
    }
</script>

<style scoped>

</style>