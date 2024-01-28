<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: null,
    image: null,
    age:null,
    status:null
})

function storeTopic(){
   form.post('/topics');
}
</script>


<template>
  <Head title="Topics" />

  <AuthenticatedLayout>
    <template #header>
            <h2 class="font-weight-bold h2 text-primary mb-0">Topics Create</h2>
        </template>

        <div class="py-4">
            <div class="container">
                <div class="d-flex justify-content-end mb-2">
                    <Link href="/topics" class="btn btn-primary">Back</Link>
                </div>

                <div class="container">
                    <form @submit.prevent="storeTopic">
                        <div class="form-group row">
                            <label for="name" class="p-2 m-2 col-sm-2 col-form-label">Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control p-2 m-2" id="name" placeholder="Enter Your name" name="name" v-model="form.name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="p-2 m-2 col-sm-2 col-form-label">Image:</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control p-2 m-2" id="image" name="image" @input="form.image = $event.target.files[0]">
                            </div>
                        </div>


                         <label for="age" class="p-2 m-2 col-sm-2 col-form-label">Age:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control p-2 m-2" id="age" placeholder="Enter Your age" name="age" v-model="form.age">
                            </div>

                             <label for="status" class="p-2 m-2 col-sm-2 col-form-label">Status:</label>
                            <div class="col-sm-10">
                            
                                <select class="form-control p-2 m-2" id="status" name="status" v-model="form.status">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                               
                                </select>
                            </div>


                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                              <div class="col-sm-10 offset-sm-2">
                              <button type="submit" class="btn btn-primary px-4 py-2 m-2" style="background-color: blue; color: white;">Submit</button>
                              </div>

                            </div>



                        </div>
                    </form>
                </div>
            </div>
        </div>
  </AuthenticatedLayout>
</template>
