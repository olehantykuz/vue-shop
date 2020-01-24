import { formatByRateFromCents } from "../helpers";

const productItemMixin = {
    props: {
        product: {
            type: Object,
            required: true
        },
        rate: {
            type: Number,
            required: true,
        },
    },
    computed: {
        formattedPrice: function () {
            return formatByRateFromCents (this.product.price, this.rate);
        },
    },
};

export default productItemMixin;
