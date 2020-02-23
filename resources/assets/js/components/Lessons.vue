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
    import axis from 'axios';
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
                console.log(slug, typeof slug);
                if(confirm('Are you sure wanna delete?')){
                    axios.delete(`admin/${this.series_id}/lessons/${slug}`)
                        .then(resp => {
                            this.lessons.splice(key, 1);
                        })
                        .catch(resp => {
                            console.log(resp);
                        });
                }
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