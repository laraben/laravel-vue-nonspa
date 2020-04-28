// /////////////////////////////////////////////
// Getters Module Counter
// /////////////////////////////////////////////
/*import axios from '@/axios.js'
*/
const getters = {
    doubleCounter: state => {
            return state.counter * 2;
    },
    clickCounter: state => {
        return state.clicks ;
    }
}

export default getters
