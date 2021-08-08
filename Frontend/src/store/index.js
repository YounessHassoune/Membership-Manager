import { createStore } from 'vuex'
import createPersistedState from "vuex-persistedstate";
import SecureLS from "secure-ls";
const ls = new SecureLS({ isCompression: false });

export default createStore({
  modules: {
    //=======individuel module==========
    individual: {
      namespaced: true,
      state: {
        activetab: "profile",
        logged: false,
        indivInfo: {}
      },
      getters: {
        isLogged(state) {
          return state.logged
        }
      },
      actions: {
        getUserInfo({ dispatch }) {
          if (localStorage.getItem('indiv_token')) {
            return fetch(
              "http://localhost/Membership-Manager/Backend/user/info",
              {
                method: "GET",
                headers: {
                  "Content-Type": "application/json",
                  "Authorization": `Bearer ${localStorage.getItem('indiv_token')}`
                },
              }
            ).then(response => response.json())
              .then(data => {
                dispatch("updateIndivInfo", data);
                dispatch("changeloginstatus", true);
              })
          }
        },
        changeActivetab({ commit }, data) {
          commit("activateTab", data);
        },
        changeloginstatus({ commit }, data) {
          commit("loginstatus", data);
        },
        updateIndivInfo({ commit }, data) {
          commit("updateindivinfo", data);
        }
      },
      mutations: {
        activateTab(state, payload) {
          state.activetab = payload;
        },
        loginstatus(state, payload) {
          state.logged = payload
        },
        updateindivinfo(state, payload) {
          state.indivInfo = payload;
        }
      },

    },
    //=======buissnes module=============
    Buissnes: {
      namespaced: true,
      state: {
        logged: false,
        compInfo: {}
      },
      actions: {
        getcompanyinfo({ dispatch }) {
          if (localStorage.getItem('buiss_token')) {
            return fetch(
              "http://localhost/Membership-Manager/Backend/company/info",
              {
                method: "GET",
                headers: {
                  "Content-Type": "application/json",
                  "Authorization": `Bearer ${localStorage.getItem('buiss_token')}`
                },
              }
            ).then(response => response.json())
              .then(data => {
                dispatch("updateComInfo", data);
                dispatch("changeloginstatus", true);
              })
          }
        },
        changeloginstatus({ commit }, data) {
          commit("loginstatus", data);
        },
        updateComInfo({ commit }, data) {
          commit("updatcompanyinfo", data);
        }
      },
      mutations: {
        loginstatus(state, payload) {
          state.logged = payload
        },
        updatcompanyinfo(state, payload) {
          state.compInfo = payload;
        }
      },

    }

  },
  // plugins: [
  //   createPersistedState({
  //     key: 'uness',
  //     paths: ['individual', 'Buissnes'],
  //     storage: {
  //       getItem: key => ls.get(key),
  //       setItem: (key, value) => ls.set(key, value),
  //       removeItem: key => ls.remove(key)
  //     }
  //   })
  // ],

})
