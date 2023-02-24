<template>
<!--  <div class="group">-->
    <div class="flex items-center space-x-4" :key="todo.id">
      <div class="flex-shrink-0 h-5 w-5 rounded-full border-2 border-gray-300" :class="{'border-green-500 bg-green-200': todo.completed}"/>
      <div class="flex flex-col text-sm font-semibold text-gray-900 w-full space-y-0.5">
        <input v-model="form.title" class="unset-appearance w-full" placeholder="Click to set a title"/>
        <input v-model="form.text" class="font-normal text-xs text-gray-500 unset-appearance" placeholder="Click to set a title"/>
      </div>
<!--      <div class="flex justify-end w-full">-->
<!--        <div class="flex border border-gray-100 rounded px-2 divide-x divide-gray-200">-->
<!--          <div class="px-4">-->
<!--            <dt class="text-xs font-base uppercase w-full text-gray-900">Created At</dt>-->
<!--            <dd>{{ todo.created_at }}</dd>-->
<!--          </div>-->
<!--          <div class="px-4">-->
<!--            <dt class="text-xs font-base uppercase w-full">Created At</dt>-->
<!--            <dd class="text-xs">{{ todo.completed_at }}</dd>-->
<!--          </div>-->
<!--          <div class="px-4">dateTime</div>-->
<!--        </div>-->
<!--      </div>-->
    </div>

<!--  </div>-->
</template>

<script lang="ts" setup>
import {PropType} from "vue";
import TodoItem from "@/ts/TodoItem";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
  todo: Object as PropType<TodoItem>,
})

const form = useForm({
  title: props.todo.title,
  text: props.todo.text,
  completed: props.todo.completed
});
</script>

<style scoped>
.unset-appearance {
  @apply p-0 outline-none ring-0 appearance-none border-0 resize-none focus:outline-none focus:border-0 focus:ring-0
}
</style>