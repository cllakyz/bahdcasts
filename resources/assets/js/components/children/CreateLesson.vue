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

    class Lesson
    {
        constructor(lesson)
        {
            this.title          = lesson.title || '';
            this.slug           = lesson.slug || '';
            this.description    = lesson.description || '';
            this.episode_number = lesson.episode_number || '';
            this.video_id       = lesson.video_id || '';
        }
    }

    export default {
        name: "CreateLesson",
        mounted() {
            this.$parent.$on('create_new_lesson', (seriesId) => {
                this.editing = false;
                this.seriesId = seriesId;
                this.lesson = new Lesson({});
                $('#createLesson').modal('show');
            });

            this.$parent.$on('edit_lesson', (lesson) => {
                this.editing = true;
                this.lesson = new Lesson(lesson);
                this.seriesId = lesson.series_id;
                $('#createLesson').modal('show');
            });
        },
        data(){
            return {
                lesson: {},
                seriesId: '',
                editing: false,
            }
        },
        methods: {
            createLesson(){
                axios.post(`admin/${this.seriesId}/lessons`, this.lesson)
                    .then(resp => {
                        this.$parent.$emit('lesson_created', resp.data);
                        $('#createLesson').modal('hide');
                    })
                    .catch(resp => {
                        console.log(resp);
                    });
            },
            updateLesson(){
                axios.put(`admin/${this.seriesId}/lessons/${this.lesson.slug}`, this.lesson)
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