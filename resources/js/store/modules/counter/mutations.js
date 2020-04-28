// /////////////////////////////////////////////
// Mutations Module Counter
// /////////////////////////////////////////////
//import axios from '@/axios.js'

const mutations = {
    increment: (state, payload) => {
        return state.counter+= payload;
    },
    decrement: (state, payload) => {
        return state.counter-= payload;
    },
    clicks: (state, payload) => {
        return state.clicks++;
    }
}

export default mutations
