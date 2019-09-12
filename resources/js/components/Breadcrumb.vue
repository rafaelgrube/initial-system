<template>
  <div class="mb-2">
    <div class="px-4 py-2 flex items-center bg-gray-200 text-gray-700">
      <a href="/home" class="text-blue-500">Home</a>

      <div v-for="(nav, index) in items" :key="`breacrumb${index}`" class="flex items-center">
        <div class="text-gray-600 mx-2">/</div>
        <a v-if="nav.uri" :href="nav.uri" class="breacrumb-item text-blue-500">{{ nav.title }}</a>
      </div>

      <div class="text-gray-600 mx-2">/</div>
      <span class="breacrumb-item text-gray-600">{{ active }}</span>
    </div>
  </div>
</template>

<script>
export default {
  props: ["active", "items"]
};
</script>