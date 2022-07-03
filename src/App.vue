<script setup>
import Clock2 from "./components/Clock2.vue";
</script>

<template>
  <main>
    <Clock2 />
  </main>
</template>

<style>
@import "./assets/base.css";

body {
  display: flex;
  place-items: center;
}

#app {
  max-width: 1280px;
  margin: 0 auto;
  padding: 2rem;
}
</style>
