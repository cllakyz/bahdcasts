<template>
    <div class="container">
        <h1 class="text-center">
            <button class="btn btn-primary" @click="createNewLesson()" data-toggle="modal" data-target="#createLesson">
                Create New Lesson
            </button>
        </h1>
        <div>
            <ul class="list-group d-flex">
                <li class="list-group-item d-flex justify-content-between" v-for="lesson, key in lessons">
                    <p>{{ lesson.title }}</p>
                    <p>
                        <button class="btn btn-primary btn-xs" @click="editLesson(lesson)">
                            Edit
                        </button>
                        <button class="btn btn-danger btn-xs" @click="deleteLesson(lesson.slug, key)">
                            Delete
                        </button>
                    </p>
                </li>
            </ul>
        </div>
        <create-lesson></create-lesson>
    </div>
</template>

<script>
    import Axios from 'axios';
    import Swal from "sweetalert2";

    export default {
        name: "Lessons",
        props: ['default_lessons', 'series_id'],
        data() {
            return {
                lessons: JSON.parse(this.default_lessons)
            }
        },
        components: {
            "create-lesson": require('./children/CreateLesson.vue')
        },
        methods: {
            createNewLesson(){
                this.$emit('create_new_lesson', this.series_id);
            },
            deleteLesson(slug, key){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Are you sure wanna delete?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        Axios.delete(`admin/${this.series_id}/lessons/${slug}`)
                            .then(resp => {
                                window.noty({
                                    message: 'Lesson deleted successfully',
                                    type: 'success'
                                });
                                this.lessons.splice(key, 1);
                            })
                            .catch(error => {
                                window.handleErrors(error)
                            });
                    }
                });
            },
            editLesson(lesson){
                this.$emit('edit_lesson', lesson);
            }
        },
        mounted() {
            this.$on('lesson_created', (lesson) => {
                this.lessons.push(lesson);
            });

            this.$on('lesson_updated', (lesson) => {
                let lessonIndex = this.lessons.findIndex(l => {
                    return lesson.id === l.id;
                });

                this.lessons.splice(lessonIndex, 1, lesson);
            });
        }
    }
</script>

<style scoped>
    .container{ color: black; font-weight: bold; }
</style>