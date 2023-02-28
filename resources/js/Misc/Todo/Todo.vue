<template>
  <div class="group flex items-center">
    <div class="flex items-center space-x-4 w-8/12" :key="todo.id">
      <div
          class="flex-shrink-0 h-5 w-5 rounded-full border-2 border-gray-300"
          :class="{'border-green-500 bg-green-200': todo.completed}"
          @click="toggleCompleted"
      />
      <div class="flex flex-col text-sm font-semibold text-gray-900 w-full space-y-0.5">
        <input v-model="form.title" class="unset-appearance w-full" placeholder="Click to set a title"/>
        <input v-model="form.text" class="font-normal text-xs text-gray-500 unset-appearance"
               placeholder="Click to set a title"/>
      </div>
    </div>
    <div class="w-4/12 flex justify-end">
      <div
          class="group-hover:opacity-100 opacity-50 flex border border-gray-100 rounded px-2 divide-x divide-gray-200 transition ease-in-out duration-300">
        <div class="px-4">
          <dd class="text-xs" :title="__('Created At')">{{ dateTime(todo.created_at) }}</dd>
        </div>
        <div class="px-4 flex items-center space-x-2">
          <date-picker v-model="form.due_at" mode="date" is24hr @input="update">
            <template v-slot="{ inputValue, inputEvents }">
              <dd class="text-xs relative flex items-center" :title="__('Due At')" v-on="inputEvents">
                <CalendarIcon
                    :class="[form.due_at === null ? 'text-gray-300' : 'text-gray-500', 'h-3 w-3 flex-shrink-0 sm:-ml-1']"
                    aria-hidden="true"/>
                <span :class="[form.due_at === null ? '' : 'text-gray-900', 'hidden truncate sm:ml-2 sm:block']">{{
                    form.due_at === null ? 'Set Due Date' : inputValue
                  }}</span>
              </dd>
            </template>
          </date-picker>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
import {PropType, watch} from "vue";
import {CalendarIcon} from '@heroicons/vue/20/solid'
import TodoItem from "@/ts/TodoItem";
import {useForm} from "@inertiajs/vue3";
import {debounce} from "lodash";

const props = defineProps({
  todo: Object as PropType<TodoItem>,
})

const form = useForm({
  title: props.todo.title,
  text: props.todo.text,
  completed: props.todo.completed,
  completed_at: props.todo.completed_at,
  due_at: props.todo.due_at,
});

watch(() => [form.title, form.due_at, form.text, form.completed], () => update(), {deep: true});

const update = debounce(() => {
  form.post(route('todo.update-todo-entry', {todo: props.todo.id}))
}, 800);

const toggleCompleted = () => {
  var completed = form.completed = !form.completed;
  if (completed)
    form.completed_at = new Date();
  else
    form.completed_at = null;
}
</script>