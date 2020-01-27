<template>
    <div id="app">
        <router-link to="/load-repo">Load Repo</router-link>
        <router-link to="/repo-list">Repo list</router-link>
        <router-link to="/repo/rid/commits">Repo list</router-link>

        <v-fade-transition mode="out-in">
            <router-view/>
        </v-fade-transition>
    </div>
</template>

<script>

    import Message from "./components/Message";

    export default {
        name: 'Application',
        components: {
            Message
        },
        data () {
            return {

            }
        }
    }
</script>

