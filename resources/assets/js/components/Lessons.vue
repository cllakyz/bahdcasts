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

                    </p>
                </li>
            </ul>
        </div>
        <create-lesson></create-lesson>
    </div>
</template>

<script>
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
            }
        },
        mounted() {
            this.$on('lesson_created', (lesson) => {
                this.lessons.push(lesson);
            });
        }
    }
</script>

<style scoped>
    .container{ color: black; font-weight: bold; }
</style>