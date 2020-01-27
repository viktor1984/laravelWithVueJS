export default {
    data() {
        return {
            items: []
        };
    },
    methods: {
        remove(index) {
            this.items.slice(index, 1);

            this.$emit('removed');
        }
    }
};
