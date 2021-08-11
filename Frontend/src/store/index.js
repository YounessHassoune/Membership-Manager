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
        indivInfo: {},
        registerinfo: { firstname: '', lastname: '', cin: '', birth: '', phone: '', email: '', password: '', image: null },
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
        },
        //====register actions==================
        updatefirstname({ commit }, data) {
          commit("updatefirstname", data);
        },
        updatelastname({ commit }, data) {
          commit("updatelastname", data);
        },
        updatecin({ commit }, data) {
          commit("updatecin", data);
        },
        updatebirth({ commit }, data) {
          commit("updatebirth", data);
        },
        updatephone({ commit }, data) {
          commit("updatephone", data);
        },
        updatemail({ commit }, data) {
          commit("updatemail", data);
        },
        updatepassword({ commit }, data) {
          commit("updatepassword", data);
        },
        updateimage({ commit }, data) {
          commit("updateimage", data);
        },


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
        },
        //====register mutations===============
        updatefirstname(state, payload) {
          state.registerinfo.firstname = payload;
        },
        updatecin(state, payload) {
          state.registerinfo.cin = payload;
        },
        updatelastname(state, payload) {
          state.registerinfo.lastname = payload;
        },
        updatebirth(state, payload) {
          state.registerinfo.birth = payload;
        },
        updatephone(state, payload) {
          state.registerinfo.phone = payload;
        },
        updatemail(state, payload) {
          state.registerinfo.email = payload;
        },
        updatepassword(state, payload) {
          state.registerinfo.password = payload;
        },
        updateimage(state, payload) {
          state.registerinfo.image = payload;
        }

      },

    },
    //=======buissnes module=============
    Buissnes: {
      namespaced: true,
      state: {
        logged: false,
        compInfo: {},
        registerinfo: { name: '', about: '', address: '', city: '', phone: '', email: '', password: '', image: null },
      },
      getters: {
        isLogged(state) {
          return state.logged
        }
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
        },
        //====register actions==================
        updatename({ commit }, data) {
          commit("updatename", data);
        },
        updateabout({ commit }, data) {
          commit("updateabout", data);
        },
        updateadress({ commit }, data) {
          commit("updateadress", data);
        },
        updatecity({ commit }, data) {
          commit("updatecity", data);
        },
        updatephone({ commit }, data) {
          commit("updatephone", data);
        },
        updatemail({ commit }, data) {
          commit("updatemail", data);
        },
        updatepassword({ commit }, data) {
          commit("updatepassword", data);
        },
        updateimage({ commit }, data) {
          commit("updateimage", data);
        },
      },
      mutations: {
        loginstatus(state, payload) {
          state.logged = payload
        },
        updatcompanyinfo(state, payload) {
          state.compInfo = payload;
        },
        //========== register mutations
        updatename(state, payload) {
          state.registerinfo.name = payload;
        },
        updateabout(state, payload) {
          state.registerinfo.about = payload;
        },
        updateadress(state, payload) {
          state.registerinfo.address = payload;
        },
        updatecity(state, payload) {
          state.registerinfo.city = payload;
        },
        updatephone(state, payload) {
          state.registerinfo.phone = payload;
        },
        updatemail(state, payload) {
          state.registerinfo.email = payload;
        },
        updatepassword(state, payload) {
          state.registerinfo.password = payload;
        },
        updateimage(state, payload) {
          state.registerinfo.image = payload;
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
