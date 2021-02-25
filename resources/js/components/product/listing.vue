<template>
    <div>
        <ul>
            <li v-for="(product, i) in getProducts" :key="i">{{ product.name }}</li>
        </ul>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    methods: {
        ...mapActions(["fetchProducts"])
    },
    computed: {
        ...mapGetters(["getProducts"])
    },
    created() {
        this.fetchProducts();
    }
};
</script>

<style></style>
