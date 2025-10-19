<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

interface Staff {
    id: number;
    name: string;
    counter_number: string;
}

interface Props {
    staff: Staff[];
}

const props = defineProps<Props>();

const breadcrumbs = [{ title: 'Create Oueues', href: '/queues/create' }];

const form = useForm({
    queue_number: '',
    type: 'reservation',
    staff_id: '',
});

const handleSubmit = () => {
    form.post(route('queues.store'));
};
</script>

<template>
    <Head title="Create Queues" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <form @submit.prevent="handleSubmit" class="space-y-4">
                <div>
                    <label
                        for="type"
                        class="mb-2 block text-sm font-medium text-gray-900"
                        >Queue Type</label
                    >
                    <select
                        id="type"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400"
                        v-model="form.type"
                    >
                        <option value="reservation">Reservation</option>
                        <option value="walkin">Walk-in</option>
                    </select>
                    <div v-if="form.errors.type" class="text-sm text-red-600">
                        {{ form.errors.type }}
                    </div>
                </div>

                <div>
                    <label
                        for="staff_id"
                        class="mb-2 block text-sm font-medium text-gray-900"
                        >Assign to Staff
                    </label>
                    <select
                        id="staff_id"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400"
                        v-model="form.staff_id"
                    >
                        <option
                            v-for="staff in props.staff"
                            :key="staff.id"
                            :value="staff.id"
                        >
                            {{ staff.name }}
                        </option>
                    </select>

                    <div
                        v-if="form.errors.staff_id"
                        class="text-sm text-red-600"
                    >
                        {{ form.errors.staff_id }}
                    </div>
                </div>

                <div class="flex gap-2">
                    <Button type="submit">Save</Button>
                    <Link :href="route('queues.index')">
                        <Button variant="destructive">Back</Button>
                    </Link>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
