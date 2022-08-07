<template>
  <div
    :class="{
      screen: true,
      'is-night': isNight,
      'is-iframe': isIframe,
    }"
  >
    <ClockTwo :hrs="oatsHrs" :mins="oatsMins" :secs="oatsSecs" />
    <p class="credits">
      <span class="credits__concept">
        Concept by
        <a
          class="credits__concept-label"
          href="https://www.youtube.com/watch?v=iHK-aN3XZqw"
          target="_blank"
          >Oats Jenkins</a
        >
      </span>
      <span class="credits__code">
        App by
        <a
          class="credits__code-label"
          href="https://github.com/LennartJKlein/oats-jenkins-clock-2"
          target="_blank"
          ><img class="credits__code-icon" src="./assets/icon-github.svg"
        /></a>
      </span>
      <a
        class="credits__source"
        href="https://clock-two.netlify.app/"
        target="_blank"
      ><img class="credits__source-icon" src="./assets/icon-fullscreen.svg"
      /></a>
    </p>
  </div>
</template>

<script>
import ClockTwo from "./components/ClockTwo.vue";
import { ref, computed } from "vue";
import moment from "moment";

export default {
  components: {
    ClockTwo,
  },
  setup() {
    let millSecsToday = ref();
    const getTime = function () {
      millSecsToday.value = moment().diff(
        moment().startOf("day"),
        "milliseconds"
      );
      requestAnimationFrame(getTime);
    };
    requestAnimationFrame(getTime);

    const oatsHrs = computed(() => {
      return millSecsToday.value / 1000 / 4320 || 0;
    });
    const oatsHrsTrunc = computed(() => {
      return Math.trunc(oatsHrs.value);
    });
    const oatsMins = computed(() => {
      return (
        (millSecsToday.value / 1000 - oatsHrsTrunc.value * 4320) / 216 || 0
      );
    });
    const oatsMinsTrunc = computed(() => {
      return Math.trunc(oatsMins.value);
    });
    const oatsSecs = computed(() => {
      return (
        millSecsToday.value / 1000 -
          oatsHrsTrunc.value * 4320 -
          oatsMinsTrunc.value * 216 || 0
      );
    });

    const isNight = computed(() => {
      return oatsHrs.value < 5 || oatsHrs.value > 15;
    });

    const isIframe = window.self !== window.top || false;

    return {
      oatsHrs,
      oatsMins,
      oatsSecs,
      isNight,
      isIframe,
    };
  },
};
</script>

<style lang="scss">
@import "./assets/base.scss";
</style>
