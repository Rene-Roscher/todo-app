<script lang="ts" setup>
import CategoryTodoItem from "./CategoryTodoItem.vue";
import {defineComponent, h, PropType} from "vue";
import CategoryItem from "../../ts/CategoryItem";
import Todo from "./Todo.vue";
import TextInput from "../../Components/TextInput.vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
  category: Object as PropType<CategoryItem>
})

// Form
const createTodoForm = useForm({
  title: '',
});

const countOpenTodosInCategory = (category: CategoryItem) => {
  return category.todos.filter(todo => !todo.completed).length;
}

const submitTodoForm = () => {
  createTodoForm.post(route('category.add-todo-entry', {category: props.category}), {
    onSuccess: () => {
      createTodoForm.reset();
    }
  })
}

const arrowCircleIcon = defineComponent({
  render() {
    return h('svg', {
      width: '22',
      height: '22',
      viewBox: '0 0 22 22',
      fill: 'none',
      xmlns: 'http://www.w3.org/2000/svg'
    }, [
      h('path', {
        d: 'M16 2.33782C18.989 4.06687 21 7.29859 21 11C21 16.5228 16.5228 21 11 21C5.47715 21 1 16.5228 1 11C1 7.29859 3.01099 4.06687 6 2.33782M7 11L11 15M11 15L15 11M11 15V1',
        stroke: 'currentColor',
        'stroke-width': '2',
        'stroke-linecap': 'round',
        'stroke-linejoin': 'round'
      })
    ]);
  }
})
</script>

<template>
  <div class="block divide-y divide-gray-200">
    <!-- Head of Category -->
    <div class="px-4 py-4 sm:px-6">
      <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
          <component :is="arrowCircleIcon" class="h-5 w-5 text-gray-400"/>
          <p class="truncate text-base font-semibold text-gray-900">
            {{ category.name }}
          </p>
        </div>
        <div class="ml-2 flex flex-shrink-0">
          <p
              class="inline-flex rounded-full bg-green-500/75 px-2 text-xs font-semibold leading-5 text-white"
              :class="{'bg-amber-500': countOpenTodosInCategory(category) > 0}"
          >
            {{ countOpenTodosInCategory(category) }}
          </p>
        </div>
      </div>
    </div>
    <!-- Content of Category -->
    <div class="px-4 py-4 sm:px-6">
      <div class="flex flex-col space-y-4">
        <!-- List of all Todos -->
        <todo v-for="todo in category.todos" :todo="todo" :key="todo.id"/>
      </div>
    </div>
    <div class="border-t px-6 py-4">
      <text-input class="w-full border" :class="{'opacity-75': createTodoForm.processing}" v-model="createTodoForm.title" @keyup.enter="submitTodoForm" placeholder="Typing the next todo..." :disabled="createTodoForm.processing"/>
    </div>
  </div>
</template>