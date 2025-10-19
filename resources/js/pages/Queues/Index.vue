<script setup lang="ts">
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import Button from '@/components/ui/button/Button.vue';
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

interface Queue {
    id: number;
    queue_number: string;
    type: string;
    status: string;
    call_time: string;
    done_time: string;
    staff_id: number;
}

interface Props{
    queues: Queue[];
}

const props = defineProps<Props>();

const breadcrumbs = [{ title: 'Oueues', href: '/queues' }];

const page = usePage();
</script>

<template>
    <Head title="Queues" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="p-4"
        >
            <div v-if="page.props.flash?.message" class="alert mb-3">
                <Alert class="bg-blue-200">
                    <AlertTitle>Notification!</AlertTitle>
                    <AlertDescription>
                        {{ page.props.flash.message }}
                    </AlertDescription>
                </Alert>
            </div>
            <Link :href="route('queues.create')">
                <Button>Create New Queue</Button>
            </Link>
        </div>

        <div class="mx-2 mt-3">
            <Table class="px-6">
                <TableCaption>A list of your recent queues.</TableCaption>
                <TableHeader>
                    <TableRow>
                        <TableHead class="w-[100px]"> Queue Number </TableHead>
                        <TableHead>Status</TableHead>
                        <TableHead>Type</TableHead>
                        <TableHead>Call Time</TableHead>
                        <TableHead>Done Time</TableHead>
                        <TableHead>Staff </TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="queue in props.queues" :key="queue.id">
                        <TableCell class="font-medium"> {{ queue.queue_number }} </TableCell>
                        <TableCell>{{ queue.status }}</TableCell>
                        <TableCell>{{ queue.type }}</TableCell>
                        <TableCell>{{ queue.called_at }} </TableCell>
                        <TableCell>{{ queue.done_at }} </TableCell>
                        <TableCell>{{ queue.staff_id }} </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>
