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
    name: string;
    counter_number: string;
}

interface Props{
    staff: Queue[];
}

const props = defineProps<Props>();

// Breadcrumbs 
const breadcrumbs = [{ title: 'Staff', href: '/staff' }];

const page = usePage();
</script>

<template>
    <Head title="Staff" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="p-4"
        >
            <div v-if="page.props.flash?.message" class="mb-3 alert">
                <Alert class="bg-blue-200">
                    <AlertTitle>Notification!</AlertTitle>
                    <AlertDescription>
                        {{ page.props.flash.message }}
                    </AlertDescription>
                </Alert>
            </div>
            <Link :href="route('staff.create')">
                <Button>Create New Staff</Button>
            </Link>
        </div>

        <div class="mx-2 mt-3">
            <Table class="px-6">
                <TableCaption>A list of your recent staff.</TableCaption>
                <TableHeader>
                    <TableRow>
                        <TableHead> Name </TableHead>
                        <TableHead>Counter Number</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="staff in props.staff" :key="staff.id">
                        <TableCell>{{ staff.name }} </TableCell>
                        <TableCell>{{ staff.counter_number }}</TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>
