<template>
  <div class="left-side">
    <svg
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 24 24"
      fill="none"
      stroke="currentColor"
      stroke-width="1.5"
      stroke-linecap="round"
      stroke-linejoin="round"
      :class="activetab == 'profile' ? 'active' : ''"
      @click="change('profile')"
    >
      <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
      <circle cx="12" cy="7" r="4"></circle>
    </svg>
    <svg
      viewBox="0 0 24 24"
      fill="none"
      stroke="currentColor"
      stroke-width="1.5"
      stroke-linecap="round"
      stroke-linejoin="round"
      :class="activetab == 'myplans' ? 'active' : ''"
      @click="change('myplans')"
    >
      <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
    </svg>
    <svg
      viewBox="0 1 511 512"
      fill="currentColor"
      :class="activetab == 'getplans' ? 'active' : ''"
      @click="change('getplans')"
    >
      <path
        d="M498.7 222.7L289.8 13.8a46.8 46.8 0 00-66.7 0L14.4 222.6l-.2.2A47.2 47.2 0 0047 303h8.3v153.7a55.2 55.2 0 0055.2 55.2h81.7a15 15 0 0015-15V376.5a25.2 25.2 0 0125.2-25.2h48.2a25.2 25.2 0 0125.1 25.2V497a15 15 0 0015 15h81.8a55.2 55.2 0 0055.1-55.2V303.1h7.7a47.2 47.2 0 0033.4-80.4zm-21.2 45.4a17 17 0 01-12.2 5h-22.7a15 15 0 00-15 15v168.7a25.2 25.2 0 01-25.1 25.2h-66.8V376.5a55.2 55.2 0 00-55.1-55.2h-48.2a55.2 55.2 0 00-55.2 55.2V482h-66.7a25.2 25.2 0 01-25.2-25.2V288.1a15 15 0 00-15-15h-23A17.2 17.2 0 0135.5 244L244.4 35a17 17 0 0124.2 0l208.8 208.8v.1a17.2 17.2 0 010 24.2zm0 0"
      />
    </svg>

    <svg viewBox="0 0 512 512" fill="currentColor" @click="logout">
      <path
        d="M255.2 468.6H63.8a21.3 21.3 0 01-21.3-21.2V64.6c0-11.7 9.6-21.2 21.3-21.2h191.4a21.2 21.2 0 100-42.5H63.8A63.9 63.9 0 000 64.6v382.8A63.9 63.9 0 0063.8 511H255a21.2 21.2 0 100-42.5z"
      />
      <path
        d="M505.7 240.9L376.4 113.3a21.3 21.3 0 10-29.9 30.3l92.4 91.1H191.4a21.2 21.2 0 100 42.6h247.5l-92.4 91.1a21.3 21.3 0 1029.9 30.3l129.3-127.6a21.3 21.3 0 000-30.2z"
      />
    </svg>
  </div>
</template>

<script>
import { createNamespacedHelpers } from "vuex";
import router from "../../router";
const { mapState, mapActions } = createNamespacedHelpers("individual");
export default {
  data() {
    return {};
  },

  computed: {
    ...mapState({
      activetab: ({ activetab }) => activetab,
    }),
  },

  methods: {
    ...mapActions(["changeActivetab"]),

    change(data) {
      this.changeActivetab(data);
    },
    logout() {
      localStorage.clear();
      router.push({ path: "/" });
    },
  },
};
</script>

<style scoped lang="scss">
@import "../../assets/scss/_variabales.scss";
:root {
  --delay: 0s;
}
.left-side {
  width: 6rem;
  height: 100%;
  display: flex;
  flex-direction: column;
  flex-shrink: 0;
  align-items: center;
  padding: 170px 0 40px;

  svg {
    width: 24px;
    cursor: pointer;
    & + svg {
      margin-top: 34px;
    }
    &:last-child {
      margin-top: auto;
    }
    &.active,
    &:hover {
      color: $primary;
    }
  }
}
</style>