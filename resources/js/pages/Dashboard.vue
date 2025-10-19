<script setup lang="ts">
import Card from '@/components/ui/card/Card.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const props = computed(() => page.props);

const breadcrumbs = [{ title: 'Dashboard', href: '/dashboard' }];

const activeQueues = computed(() => props.value.activeQueues);
const activeStaff = computed(() => props.value.activeStaff);
const topStaff = computed(() => props.value.topStaff);
const currentQueue = computed(() => props.value.currentQueue);
console.log('win the g', props);

const callNext = () => {
    router.post(route('call.next'));
    router.visit(window.location.href);
};

const completeQueue = () => {
    router.post(route('call.done', currentQueue.value.id));
    router.visit(window.location.href);
};
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <!-- 3 Summary Cards -->
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <!-- Active Queues -->
                <Card class="h-full justify-center text-center">
                    <CardHeader>
                        <CardTitle>Active Queue</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <p class="text-3xl font-bold text-primary">
                            {{ activeQueues }}
                        </p>
                    </CardContent>
                </Card>

                <!-- Active Staff -->
                <Card class="h-full justify-center text-center">
                    <CardHeader>
                        <CardTitle>Active Staff</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <p class="text-3xl font-bold text-primary">
                            {{ activeStaff }}
                        </p>
                    </CardContent>
                </Card>

                <!-- Top 3 Staff -->
                <Card class="h-full justify-center text-center">
                    <CardHeader>
                        <CardTitle>Top 3 Staff</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div class="p-4">
                            <h2 class="mb-2 text-lg font-bold">
                                Top 3 Staff Terbaik
                            </h2>
                            <table
                                class="w-full table-auto border-collapse border border-gray-200"
                            >
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border p-2 text-left">
                                            Nama Staff
                                        </th>
                                        <th class="border p-2 text-center">
                                            Jumlah Dilayani
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="staff in topStaff"
                                        :key="staff.staff_id"
                                    >
                                        <td class="border p-2">
                                            {{ staff.staff?.name }}
                                        </td>
                                        <td class="border p-2 text-center">
                                            {{ staff.served_count }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </CardContent>
                </Card>
            </div>

            <!-- Placeholder Section -->
            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border"
            >
                <Card class="mt-4 p-6 text-center">
                    <CardHeader>
                        <CardTitle>Queue Call</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div>
                            <p class="text-2xl font-bold">
                                Queue Number:
                                {{ currentQueue?.queue_number || ' - ' }}
                            </p>
                        </div>
                        <div class="mt-4 flex justify-center gap-4">
                            <button
                                @click="callNext"
                                class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                            >
                                Next
                            </button>
                            <button
                                @click="completeQueue"
                                class="rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700"
                            >
                                Completed
                            </button>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
