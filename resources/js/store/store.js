import Vue from 'vue';
import Vuex from 'vuex';

//import counter from './modules/counter/counter';

import state from './state'
import mutations from './mutations'
import actions from './actions'
import getters from './getters'

Vue.use(Vuex);

export const store = new Vuex.Store({
    getters,
    mutations,
    state,
    actions,
    modules: {
        //
    }
});
