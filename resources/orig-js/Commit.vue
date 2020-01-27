<template>
    <table class="table">
        <thead>
            <tr>
                <th><abbr title="Title">Title</abbr></th>
                <th><abbr title="Id">Id</abbr></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="commit in commits">
                <th v-text="commit.id"></th>
                <td>
                    <!--<commit-item :id="commit.id">{{ commit.title }}</commit-item>-->
                    <label class="panel-block">
                        <input type="checkbox" v-model="checkedList" :id="commit.id" :value="commit.id">
                        {{ commit.title }}
                    </label>
                </td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td colspan="2">
                    <button @click="deleteSelected">Delete Selected</button>
                </td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td colspan="2">
                    <paginator :url="getUrl" @dataUpdated="drawTable"></paginator>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    import Paginator from '@/views/Paginator';

    // import CommitItem from "./CommitItem";
    export default {
        name: 'Commit',
        components: {Paginator},
        // components: {
        //     CommitItem
        // },
        data: function () {
            return {
                checkedList: [],
                commits: [],
                currentPage: 0
            };
        },
        props: ['project_id', 'page_number'],
        computed: {
            getUrl() {
                return '/api/v1/project/' + this.project_id + '/commits'
                    + (this.currentPage > 0 ? '?page=' + this.currentPage : '');
            }
        },
        methods: {
            deleteSelected: function() {

                axios.post('/api/v1/project/' + this.project_id + '/commits', {
                    'list': this.checkedList
                })
                    .then((response) => {
                        this.commits = [];

                        // this.renewCommitList();
                    })
                ;
            },
            renewCommitList() {
                axios.get('/api/v1/project/' + this.project_id + '/commits')
                    .then((response) => {
                        console.log(response.data.data);

                        this.commits = response.data.data;
                    })
                ;
            },
            drawTable: function (data) {
                this.commits = data;
            },
            fetchTopics() {
                console.log('page changes');
            }
        },
        mounted() {
            console.log('Commit mounted');
        },
        created() {
            // this.renewCommitList();
            console.log('Commit created');
            console.log(this.page_number);
            let page = parseInt(this.$route.query.page);

            if (page > 0) {
                this.currentPage = page;
            }
        },
        watch: {
            '$route' (to, from) {
                // react to route changes...
                this.fetchTopics();
            }
        }
    }
</script>
