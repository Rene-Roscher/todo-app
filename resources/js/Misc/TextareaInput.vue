<template>
  <div v-show="open" class="fixed inset-0 z-40" @click="open = false" />
  <div v-if="!open" class="bg-white text-center p-2 tracking-wide uppercase text-gray-700 font-semibold rounded-lg cursor-pointer" @click="open = true">
    {{ __('Add new Todo') }}
  </div>
  <form action="#" class="relative z-50" v-else @keyup.esc="open = false" @submit.prevent="submit" @keyup.enter.exact.prevent="submit">
    <overlay-spinner v-if="form.processing"/>
    <div class="overflow-hidden bg-white rounded-lg">
      <label for="title" class="sr-only">{{ __('Title') }}</label>
      <input type="text" name="title" v-model="form.title" @keydown.enter.prevent="$refs.text.focus()" id="title" class="block w-full border-0 pt-2.5 text-lg font-medium placeholder-gray-500 focus:ring-0" placeholder="Title" />
      <label for="description" class="sr-only">{{ __('Description') }}</label>
      <textarea ref="text" rows="2" name="description" v-model="form.text" id="description" class="block w-full resize-none border-0 py-0 placeholder-gray-500 focus:ring-0 sm:text-sm" placeholder="Write a description..." />

      <!-- Spacer element to match the height of the toolbar -->
      <div aria-hidden="true">
        <div class="py-2">
          <div class="h-9" />
        </div>
        <div class="h-px" />
        <div class="py-2">
          <div class="py-px">
            <div class="h-9" />
          </div>
        </div>
      </div>
    </div>

    <div class="absolute inset-x-px bottom-0">
      <div class="flex items-center justify-between space-x-3 border-t border-gray-200 px-2 py-2 sm:px-3 relative">
        <div class="flex flex-nowrap space-x-2 py-2 px-2">
          <date-picker v-model="form.due_at" mode="date" is24hr>
            <template v-slot="{ inputValue, inputEvents }">
              <a class="relative inline-flex items-center whitespace-nowrap rounded-full bg-gray-50 py-2 px-2 text-sm font-medium text-gray-500 hover:bg-gray-100 sm:px-3" v-on="inputEvents">
                <CalendarIcon :class="[form.due_at === null ? 'text-gray-300' : 'text-gray-500', 'h-5 w-5 flex-shrink-0 sm:-ml-1']" aria-hidden="true" />
                <span :class="[form.due_at === null ? '' : 'text-gray-900', 'hidden truncate sm:ml-2 sm:block']">{{ form.due_at === null ? 'Due date' : inputValue }}</span>
              </a>
            </template>
          </date-picker>
        </div>
        <div class="flex-shrink-0">
          <secondary-button type="submit">
            {{ __('Add Todo') }}
          </secondary-button>
        </div>
      </div>
    </div>
  </form>
</template>

<script lang="ts" setup>
import {PropType, ref} from 'vue'
import { CalendarIcon } from '@heroicons/vue/20/solid'
import {useForm} from "@inertiajs/vue3";
import CategoryItem from "../ts/CategoryItem";
import OverlaySpinner from "./Loaders/OverlaySpinner.vue";
import SecondaryButton from "../Components/SecondaryButton.vue";

const props = defineProps({
  category: Object as PropType<CategoryItem>,
});

const open = ref(false)

const form = useForm({
  title: null,
  text: null,
  due_at: null,
});

const submit = () => {
  form.post(route('category.add-todo-entry', {category: props.category}), {
    preserveScroll: true,
    onSuccess: () => {
      open.value = false;
      form.reset();
    }
  })
}

</script>