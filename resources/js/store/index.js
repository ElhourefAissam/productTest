import Vue from "vue";
import Vuex from "vuex";

import product from "./modules/product";

Vue.use(Vuex);

// export const modules = {
//     product
// };

// export default new Vuex.Store({
//     modules
// });

export default new Vuex.Store({
    strict: true,
    modules: {
        product
    }
});
