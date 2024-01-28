<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, createInertiaApp, useForm } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
    topic: Object,
    image: String,
});

const form = useForm({
    name: props.topic.name,
    image: null,
});

function updateTopic() {
    Inertia.post(`/topics/${props.topic.id}`,{
      _method: 'put',
      name: form.name,
      image: form.image
    });
}
</script>

<template>
    <Head title="Edit Topic" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-weight-bold h2 text-primary mb-0">Edit Topic</h2>
        </template>

        <div class="py-4">
            <div class="container">
                <div class="d-flex justify-content-end mb-2">
                    <Link href="/topics" class="btn btn-primary">Back</Link>
                </div>

                <div class="container">
                    <form @submit.prevent="updateTopic">
                        <div class="form-group row">
                            <label for="name" class="p-2 m-2 col-sm-2 col-form-label">Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control p-2 m-2" id="name" :placeholder="name" name="name" v-model="form.name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="p-2 m-2 col-sm-2 col-form-label">
                                <div class="m-2 p-2">
                                    <img :src="image" class="img-fluid">
                                </div>
                                Image:
                            </label>
                            <div class="col-sm-10">
                            <input type="file" class="form-control p-2 m-2" id="image" name="image" @input="form.image = $event.target.files[0]" style="background-color: blue; color: white;">
                        </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary px-4 py-2 m-2" style="background-color: blue; color: white;">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
