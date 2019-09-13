<template>
  <ul class="navigation-group">
    <li @click="show = !show" class="font-bold" role="button">{{ title }}</li>
    <transition name="fade">
      <ul v-if="show">
        <slot></slot>
      </ul>
    </transition>
  </ul>
</template>

<script>
export default {
  props: ["active", "title"],

  data() {
    return {
      show: this.active
    };
  }
};
</script>