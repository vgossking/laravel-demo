<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteTaskForm from './Partials/DeleteTaskForm.vue';
import { Head } from '@inertiajs/inertia-vue3';

defineProps({
    tasks: Array,
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">List tasks</h2>
        </template>
      
        <div class="py-12">
          <div class="container mx-auto">
            <table class="w-full table-fixed">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <tr v-for="(task, index) in tasks" :key="index">
                  <td>{{ task.id }}</td>
                  <td>{{ task.name }}</td>
                  <td>{{ task.description }}</td>
                  <td><DeleteTaskForm :id="task.id"></DeleteTaskForm></td>
                </tr>
              </tbody>
            </table>
          </div>
          
        </div>
    </AuthenticatedLayout>
</template>
