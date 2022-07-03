<template>
  <svg
    xmlns="http://www.w3.org/2000/svg"
    class="clock"
    preserveAspectRatio="xMidYMid meet"
    viewBox="0 0 1122 858"
  >
    <image
      class="clock__hand-hours"
      :style="handHoursStyle"
      preserveAspectRatio="xMidYMid meet"
      xlink:href="../assets/hand-hours.png"
    />
    <image
      class="clock__hand-minutes"
      :style="handMinutesStyle"
      preserveAspectRatio="xMidYMid meet"
      xlink:href="../assets/hand-minutes.png"
    />
    <text class="clock__digital" x="50%" y="54.5%" text-anchor="middle">
      {{ Math.trunc(oatsHrs + 1) }}:{{
        String(Math.trunc(oatsMins + 1)).padStart(2, "0")
      }}:{{ String(Math.trunc(oatsSecs + 1)).padStart(3, "0") }}
    </text>
  </svg>
</template>

<script>
import { computed, toRefs } from "vue";
export default {
  props: {
    hrs: Number,
    mins: Number,
    secs: Number,
  },
  setup(props) {
    const { hrs, mins, secs } = toRefs(props);

    const handHoursStyle = computed(() => {
      return { "--progress": `${(hrs.value / 20) * 100}%` };
    });
    const handMinutesStyle = computed(() => {
      return { "--progress": `${(mins.value / 20) * 100}%` };
    });

    return {
      oatsHrs: hrs,
      oatsMins: mins,
      oatsSecs: secs,
      handHoursStyle,
      handMinutesStyle,
    };
  },
};
</script>
<style lang="scss">
@import url("https://fonts.googleapis.com/css2?family=Nanum+Pen+Script&display=swap");

$breakpoint-xs: 0px;
$breakpoint-sm: 600px;
$breakpoint-md: 900px;

.clock {
  $aspect-ratio-h: 1.3077 * 100;
  $aspect-ratio-w: 0.7647 * 100;
  aspect-ratio: 1122 / 858;
  background: url("../assets/background.png") no-repeat center center;
  background-size: contain;
  bottom: 0;
  height: #{$aspect-ratio-w}vw;
  left: 0;
  margin: auto;
  max-height: 100vh;
  max-width: #{$aspect-ratio-h}vh;
  position: absolute;
  right: 0;
  top: 0;
  transform: scale(0.88);
  width: 100vw;

  @media (min-width: $breakpoint-sm) {
    height: #{$aspect-ratio-w}vw;
    max-height: 100vh;
    max-width: #{$aspect-ratio-h}vh;
    width: 100vw;
  }

  @media (min-width: $breakpoint-md) {
    height: #{$aspect-ratio-w}vw;
    max-height: 100vh;
    max-width: #{$aspect-ratio-h}vh;
    width: 100vw;
  }

  &__hand-hours {
    --progress: 0%;
    height: 64px;
    offset-distance: var(--progress);
    offset-path: path(
      "M 565.226 667 L 630.5 667 C 767.7 667 879 555.7 879 418.5 C 879 281.3 767.7 170 630.5 170 L 499.5 170 C 362.3 170 251 281.3 251 418.5 C 251 555.7 362.3 667 499.5 667 Z"
    );
    offset-rotate: 0deg;
    transform-origin: 41px 32px;
    width: 82px;
  }

  &__hand-minutes {
    --progress: 0%;
    height: 47px;
    offset-distance: var(--progress);
    offset-path: path(
      "M 565.645 721 L 646.5 721 C 813.6 721 949 585.6 949 418.5 C 949 251.4 813.6 116 646.5 116 L 484.5 116 C 317.4 116 182 251.4 182 418.5 C 182 585.6 317.4 720.832 484.5 720.832 Z"
    );
    offset-rotate: 0deg;
    transform-origin: 26.5px 23.5px;
    width: 53px;
  }

  &__digital {
    color: black;
    font-family: "Nanum Pen Script", cursive;
    font-size: 125px;
  }
}
</style>
