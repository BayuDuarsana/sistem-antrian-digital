<template>
  <div class="bg-white p-4 rounded shadow">
    <h3 class="text-lg font-semibold mb-2">Top 3 Staff</h3>
    <ul>
      <li
        v-for="(staff, index) in topStaff"
        :key="staff.id"
        class="flex justify-between border-b py-1"
      >
        <span>{{ index + 1 }}. {{ staff.name }}</span>
        <span>{{ staff.served_count }} layanan</span>
      </li>
    </ul>
  </div>
</template>

<script>
defineProps({
  topStaff: Array,
});
</script>
