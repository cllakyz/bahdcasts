<template>
    <div>
        <div v-if="lesson" :data-vimeo-id="lesson.video_id" data-vimeo-width="900" id="handstick"></div>
    </div>
</template>

<script>
    import Player from '@vimeo/player';
    import Swal from 'sweetalert2';
    import Axios from 'axios';

    export default {
        name: "Player",
        props: ['default_lesson', 'next_lesson_url'],
        data() {
            return {
                lesson: JSON.parse(this.default_lesson)
            }
        },
        mounted() {
            const player = new Player('handstick');
            player.on('ended', () => {
                this.completeLesson();
            });
        },
        methods: {
            displayVideoEndedAlert(){
                Swal.fire('Yaaay ! You completed this lesson!')
                    .then(() => {
                        if (this.next_lesson_url){
                            window.location = this.next_lesson_url;
                        } else{
                            Swal.close();
                        }
                    });
            },
            completeLesson(){
                Axios.post(`series/complete-lesson/${this.lesson.slug}`)
                    .then(resp => {
                        this.displayVideoEndedAlert();
                    })
                    .catch(error => {
                        window.handleErrors(error);
                    })
            }
        }
    }
</script>

<style scoped>

</style>