<template>
    <Head title="Welcome" />
  
    <div class="container-fluid bg-light py-4">
        <div class="text-center">
            <h1 class="font-weight-bold mb-3">Welcome to Student Registration System</h1>
    
            <p class="lead mb-4">
                This system allows you to manage student registrations efficiently. You can easily add, edit, and delete student records.
            </p>
    
            <div v-if="canLogin" class="d-flex justify-content-center">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="font-weight-bold text-gray-600 text-decoration-none mx-2">Dashboard</Link>
                
                <template v-else>
                    <Link :href="route('login')" class="font-weight-bold text-gray-600 text-decoration-none mx-2" :class="{ 'text-dark': !hoverLogin, 'text-primary': hoverLogin }" @mouseover="hoverLogin = true" @mouseleave="hoverLogin = false">Log in</Link>
                    
                    <Link v-if="canRegister" :href="route('register')" class="ms-4 font-weight-bold text-gray-600 text-decoration-none" :class="{ 'text-dark': !hoverRegister, 'text-primary': hoverRegister }" @mouseover="hoverRegister = true" @mouseleave="hoverRegister = false">Register</Link>
                </template>
            </div>
        </div>
    </div>
  
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">System Overview</div>
                    
                    <div class="card-body">
                        <div class="card-body">
                            <p class="card-text">
                            The Student Registration System is a comprehensive platform designed to streamline the process of managing student registrations. With its user-friendly interface and robust features, the system offers the following capabilities:
                            </p>
                            <ul class="list-group">
                                <li class="list-group-item">Efficient management of student records, including personal details, contact information, and enrollment status.</li>
                                <li class="list-group-item">Secure authentication and role-based access control for administrators, teachers, and students.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <footer class="footer">
        <div class="container">
            <span class="text-muted">© 2024 Student Registration System</span>
        </div>
    </footer>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';
  
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
  
let hoverLogin = false;
let hoverRegister = false;
</script>

<style>
.footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    background-color: #f8f9fa;
    text-align: center;
    padding: 10px 0;
}
</style>
