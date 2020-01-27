<template>
    <ul>
        <li>
            <h1>Repo list</h1>
        </li>
        <li v-for="repo in repoList">111</li>
    </ul>
</template>

<script>
    export default {
        name: 'RepoList',
        data: function () {
            return {
                repoList: []
            };
        }
    }
</script>
