<template>
  <div :class="{ screen: true, 'is-night': isNight }">
    <ClockTwo :hrs="oatsHrs" :mins="oatsMins" :secs="oatsSecs" />
    <p class="credits">
      <a href="https://github.com/LennartJKlein/oats-jenkins-clock-2"
        ><img class="credits__github" src="./assets/github-icon.svg"
      /></a>
      - Concept by
      <a href="https://www.youtube.com/watch?v=iHK-aN3XZqw">Oats Jenkins</a>
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
    let secsToday = ref();
    const getTime = function () {
      secsToday.value = moment().diff(moment().startOf("day"), "seconds");
      requestAnimationFrame(getTime);
    };
    requestAnimationFrame(getTime);

    const oatsHrs = computed(() => {
      return secsToday.value / 4320 || 0;
    });
    const oatsHrsTrunc = computed(() => {
      return Math.trunc(oatsHrs.value);
    });
    const oatsMins = computed(() => {
      return (secsToday.value - oatsHrsTrunc.value * 4320) / 216 || 0;
    });
    const oatsMinsTrunc = computed(() => {
      return Math.trunc(oatsMins.value);
    });
    const oatsSecs = computed(() => {
      return (
        secsToday.value -
          oatsHrsTrunc.value * 4320 -
          oatsMinsTrunc.value * 216 || 0
      );
    });

    const isNight = computed(() => {
      return oatsHrs.value < 6 || oatsHrs.value > 16;
    });

    return {
      oatsHrs,
      oatsMins,
      oatsSecs,
      isNight,
    };
  },
};
</script>

<style lang="scss">
@import "./assets/base.scss";

.screen {
  background-color: var(--color-background);
  display: flex;
  place-items: center;
  flex-direction: column;
  height: 100vh;
  width: 100vw;
  overflow: hidden;
}

.credits {
  background-color: var(--color-background);
  color: var(--color-description);
  position: absolute;
  height: 2em;
  bottom: 0.25em;
  margin: 0 auto;
  padding: 0.25em 0.4em;

  a {
    color: var(--color-link);
  }

  &__github {
    margin-bottom: -0.25em;
    width: 1.25em;
  }
}
</style>
