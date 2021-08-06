import { createStore } from 'vuex'

export default createStore({
  modules: {
    //=======individuel module==========
    individual: {
      namespaced: true,
      state: {
        activetab: "profile",
      },
      actions: {
        changeActivetab({ commit }, data) {
          commit("activateTab", data);
        }
      },
      mutations: {
        activateTab(state, payload) {
          state.activetab = payload;
        }
      },

    },
    //=======buissnes module=============
    Buissnes: {
      namespaced: true,
      state: {
      },
      mutations: {
      },
      actions: {
      },

    }

  }

})
