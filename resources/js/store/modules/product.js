import axios from "axios";
import path from "../../envPath";

const state = () => {
    return {
        product: {},
        products: []
    };
};

const getters = {
    getProduct: state => state.product,
    getProducts: state => state.products
};

const mutations = {
    setProducts: (state, products) => (state.products = products),
    postProduct: (state, product) => {
        state.products.push(product);
    },
    deleteProduct: (state, idProduct) =>
        (state.products = state.products.filter(
            product => idProduct !== product.id
        )),
    editProduct: (state, upProduct) => {
        const index = state.products.findIndex(
            product => product.id === upProduct.id
        );
        if (index !== -1) {
            state.products.splice(index, 1, upProduct);
        }
    }
};

const actions = {
    // get product list
    async fetchProducts({ commit }) {
        await axios
            .get(path.baseUrl + "product")
            .then(response => {
                console.log(response.data.products);
                commit("setProducts", response.data.products);
            })
            .catch(error => console.log(error));
    },

    // submit product
    async postProduct({ commit }, product) {
        await axios
            .post(path.baseUrl + "product/submit", product)
            .then(response => {
                console.log(response.data);
                commit("postProduct", response.data.product);
            })
            .catch(error => console.log(error));
    },

    // edit product list
    async editProduct({ commit }, upProduct) {
        await axios
            .put(path.baseUrl + "product", { upProduct })
            .then(response => {
                commit("editProduct", response.data.product);
            })
            .catch(error => console.log(error));
    },

    // delete product
    async deleteProduct({ commit }, idProduct) {
        await axios
            .delete(path.baseUrl + `product/${idProduct}/delete`)
            .then(response => {
                commit("deleteProduct", response.id);
            })
            .catch(error => console.log(error));
    },

    // this function execute on load
    async nuxtServerInit({ commit, dispatch }, { req }) {}
};

export default {
    state,
    getters,
    actions,
    mutations
};
