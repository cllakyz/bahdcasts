<template>
    <div class="modal fade" id="createLesson" tabindex="-1" role="dialog" aria-labelledby="createLessonModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createLessonModalLabel">Create new lesson</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Lesson title" v-model="lesson.title">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Vimeo video id" v-model="lesson.video_id">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="Episode number" v-model="lesson.episode_number">
                    </div>

                    <div class="form-group">
                        <textarea cols="5" rows="5" class="form-control" v-model="lesson.description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="updateLesson()" v-if="editing">Save lesson</button>
                    <button type="button" class="btn btn-primary" @click="createLesson()" v-else>Create lesson</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "CreateLesson",
        mounted() {
            this.$parent.$on('create_new_lesson', () => {
                console.log('hello parent, we are creating a lesson.');
                $('#createLesson').modal();
            });
        },
        data(){
            return {
                title: '',
                video_id: '',
                episode_number: '',
                description: '',
            }
        }
    }
</script>

<style scoped>

</style>