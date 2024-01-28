<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props=defineProps({
    topics:Array
})
</script>

<template>
    <Head title="Dashbord" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-weight-bold h2 text-primary mb-0">Topics Index</h2>
        </template>

        <div class="py-4">
            <div class="container">
                <div class="d-flex justify-content-end mb-2">
                    <Link href="/topics/create" class="btn btn-primary">Create</Link>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Age</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="topic in topics" :key="topic.id">
                                <td class="py-3 px-6">{{ topic.id }}</td>
                                <td class="py-3 px-6">{{ topic.name }}</td>
                                <td class="py-3 px-6">
                                    <div class="d-flex align-items-center">
                                        <img :src="topic.image" class="w-12 h-12 rounded-circle border border-primary me-2">
                                        {{ topic.image }}
                                    </div>
                                </td>
                                <td class="py-3 px-6">{{ topic.age }}</td>
                                <td class="py-3 px-6">{{ topic.status }}</td>

                                <td class="py-3 px-6">
                                    <Link :href="`/topics/${topic.id}/edit`" class="btn btn-primary me-2">Edit</Link>
                                    <Link :href="`/topics/${topic.id}`" method="delete" as="button" type="button" class="btn btn-danger" style="background-color: white; color: red;">Delete</Link>

                                </td>


                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
