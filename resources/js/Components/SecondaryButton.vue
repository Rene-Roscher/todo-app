<script setup>
import {computed} from "vue";

const props = defineProps({
  type: {
    type: String,
    default: 'button',
  },
  size: {
    type: String,
    default: 'sm',
  },
});

</script>

<template>
  <button
      :type="type"
      :class="size"
  >
    <slot/>
  </button>
</template>

<style scoped>
button {
  @apply inline-flex items-center bg-white border border-gray-300 rounded-md font-semibold text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition;
}
.sm {
  @apply px-4 py-1.5 text-xs;
}
.md {
  @apply px-4 py-2 text-sm;
}
.lg {
  @apply px-6 py-3 text-base;
}
</style>