<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { Link} from '@inertiajs/vue3';

const breadcrumbs = [{ title: 'Create Staff', href: '/staff/create' }];

const form = useForm({
    counter_number: '',
    name: '',
});

const handleSubmit = () => {
    form.post(route('staff.store'));
};
</script>

<template>
    <Head title="Create Staff" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <form @submit.prevent="handleSubmit" class="space-y-4">
                <div>
                    <label
                        for="name"
                        class="mb-2 block text-sm font-medium text-gray-900"
                        >Name</label
                    >
                    <input
                        id="name"
                        type="text"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400"
                        placeholder="Enter staff name"
                        v-model="form.name"
                    />
                    <div
                        v-if="form.errors.name"
                        class="text-sm text-red-600"
                    >
                        {{ form.errors.name }}
                    </div>
                </div>

                <div>
                    <label
                        for="name"
                        class="mb-2 block text-sm font-medium text-gray-900"
                        >Counter Number</label
                    >
                    <input
                        id="counter_number"
                        type="text"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400"
                        placeholder="Enter counter number"
                        v-model="form.counter_number"
                    />
                    <div
                        v-if="form.errors.counter_number"
                        class="text-sm text-red-600"
                    >
                        {{ form.errors.counter_number }}
                    </div>
                </div>

                

                <div class="flex gap-2">
                    <Button type="submit">Save</Button>
                    <Link :href="route('staff.index')">
                        <Button variant="destructive">Back</Button>
                    </Link>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
