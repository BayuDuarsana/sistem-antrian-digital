<template>
  <table class="table-auto w-full border">
    <thead class="bg-gray-100">
      <tr>
        <th>No</th>
        <th>Nomor Antrian</th>
        <th>Nama Customer</th>
        <th>Jenis</th>
        <th>Status</th>
        <th>Staff</th>
        <th>Service</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(q, i) in queues" :key="q.id" class="border-b">
        <td>{{ i + 1 }}</td>
        <td>{{ q.queue_number }}</td>
        <td>{{ q.customer_name || '-' }}</td>
        <td>{{ q.type }}</td>
        <td>{{ q.status }}</td>
        <td>{{ q.staff?.name || '-' }}</td>
        <td>{{ q.service?.name || '-' }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script setup>
defineProps({
  queues: Array,
});
</script>
