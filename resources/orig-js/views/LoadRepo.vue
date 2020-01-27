<template>
    <div>
        <message>Hello there</message>

        <input type="text" v-model="owner" />

        <button @click="loadRepo">LoadRepo</button>
    </div>

</template>

<script>
    import Message from "../components/Message";

    export default {
        name: 'LoadRepo',
        components: {Message},
        data: function() {
            return {
                count: 0,
                owner: ''
            }
        },
        computed: {
            credentials () {
                return {
                    owner: this.owner,
                    repo: 'this.password'
                }
            }
        },
        methods: {
            loadRepo: function () {
                this.$store.dispatch('downloadRepo', this.credentials)
                    .then(() => {
                        this.$router.push({ name: 'my-app.load-repo' })
                    })
                    .catch(err => {
                        if (typeof err.errors === 'object') {
                            for (let key in err.errors) {
                                this.$toasted.error(err.errors[key][0])
                            }
                        } else {
                            this.$toasted.error(err.error)
                        }
                    })
            }
        }
    }
</script>
