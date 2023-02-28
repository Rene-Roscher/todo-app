<script lang="ts" setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {PropType, defineComponent, h} from "vue";
import CategoryItem from "../ts/CategoryItem";
import Pagination from "../ts/Pagination";
import SecondaryButton from "../Components/SecondaryButton.vue";
import Category from "../Misc/Todo/Category.vue";

defineProps({
  categories: Object as PropType<Pagination<CategoryItem>>,
})

const createCategory = () => {
  console.log('create category');
}

</script>

<template>
  <AppLayout title="Dashboard">
    <template #header>
      <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Dashboard
        </h2>

        <div>
          <secondary-button size="sm">
            Create Category
          </secondary-button>
        </div>
      </div>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
        <div class="">

          <!-- Input Create Category -->

          <!-- Category-List --->
          <div>
            <ul role="list">

              <li v-for="category in categories.data" :key="category.id">
                <category v-for="category in categories.data" :category="category" :key="category.id"/>
              </li>

            </ul>
          </div>

        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style lang="scss" scoped>
button {
  @apply inline-block rounded-lg px-3 py-1.5 text-sm font-semibold leading-6 text-gray-900 shadow-sm ring-1 ring-gray-900/10 hover:ring-gray-900/20;
  &.active {
    @apply bg-gray-900/10;
  }
}
</style>