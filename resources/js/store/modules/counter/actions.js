// /////////////////////////////////////////////
// Actions Module Counter
// /////////////////////////////////////////////
/*import axios from '@/axios.js'*/

const actions = {
    increment: ({ commit }, payload) => {
        commit('increment', payload),
        commit('clicks', payload)
    }
}

export default actions
