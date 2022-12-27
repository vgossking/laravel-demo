<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/inertia-vue3';

const props = defineProps({
    name: String,
    description: String,
    isUpdate: Boolean,
    id: Number,
});

const user = usePage().props.value.auth.user;

const form = useForm({
    name: usePage().props.value.name,
    description: usePage().props.value.description,
});
</script>

<template>
    <section>
        <header>
            <h2 v-if="isUpdate" class="text-lg font-medium text-gray-900">Update Task</h2>
            <h2 v-if="!isUpdate" class="text-lg font-medium text-gray-900">Create Task</h2>
        </header>

        <form @submit.prevent="isUpdate ? form.patch(route('task.update', id)) : form.post(route('task.store'))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="description" value="Description" />

                <TextInput
                    id="description"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.description"
                    required
                    autocomplete="description"
                />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
