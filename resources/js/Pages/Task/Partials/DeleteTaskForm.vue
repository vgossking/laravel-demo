<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/inertia-vue3';

const props = defineProps({
    id: Number,
});

const user = usePage().props.value.auth.user;
const form = useForm({
});
</script>

<template>
    <section>

        <form @submit.prevent="form.delete(route('task.delete', id))" class="mt-6 space-y-6">
            

            <div class="flex justify-center items-center gap-4">
                <PrimaryButton :disabled="form.processing">Delete</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
