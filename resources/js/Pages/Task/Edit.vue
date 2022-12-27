<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import EditTaskForm from './Partials/EditTaskForm.vue';
import { Head } from '@inertiajs/inertia-vue3';

defineProps({
    id: Number,
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Update Task</h2>
        </template>

        <div class="py-12">
            <div class="container mx-auto">
              <EditTaskForm :is-update="true" :id="id"></EditTaskForm>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
