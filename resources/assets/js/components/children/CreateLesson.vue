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
                        <input type="text" class="form-control" placeholder="Lesson title" v-model="title">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Vimeo video id" v-model="video_id">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="Episode number" v-model="episode_number">
                    </div>

                    <div class="form-group">
                        <textarea cols="5" rows="5" class="form-control" v-model="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-close-modal" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="createLesson()" v-if="!editing">Create lesson</button>
                    <button type="button" class="btn btn-primary" @click="updateLesson()" v-else>Update lesson</button>
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
            this.$parent.$on('create_new_lesson', (seriesId) => {
                this.seriesId = seriesId;
                $('#createLesson').modal('show');

            });

            this.$parent.$on('edit_lesson', (lesson) => {
                this.editing = true;
                this.title = lesson.title;
                this.description = lesson.description;
                this.video_id = lesson.video_id;
                this.episode_number = lesson.episode_number;
                this.seriesId = lesson.series_id;
                this.lessonSlug = lesson.slug;
                $('#createLesson').modal('show');
            });
        },
        data(){
            return {
                seriesId: '',
                lessonId: '',
                title: '',
                video_id: '',
                episode_number: '',
                description: '',
                editing: false,
            }
        },
        methods: {
            createLesson(){
                axios.post(`admin/${this.seriesId}/lessons`, {
                    title: this.title,
                    video_id: this.video_id,
                    episode_number: this.episode_number,
                    description: this.description,
                })
                .then(resp => {
                    this.$parent.$emit('lesson_created', resp.data);
                    $('#createLesson').modal('hide');
                })
                .catch(resp => {
                    console.log(resp);
                });
            },
            updateLesson(){
                axios.put(`admin/${this.seriesId}/lessons/${this.lessonSlug}`, {
                    title: this.title,
                    video_id: this.video_id,
                    episode_number: this.episode_number,
                    description: this.description,
                })
                .then(resp => {
                    this.$parent.$emit('lesson_updated', resp.data);
                    $('#createLesson').modal('hide');
                })
                .catch(resp => {
                    console.log(resp);
                });
            }
        }
    }
</script>

<style scoped>
.modal-title{ color: black; }
</style>