<template>
    <table class="table">
        <thead>
        <tr>
            <th><abbr title="Id">Id</abbr></th>
            <th><abbr title="Title">Hash</abbr></th>
            <th><abbr title="Title">Comment</abbr></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="commit in items">
            <td>
                <label class="panel-block">
                    <input type="checkbox" v-model="checkedList" :id="commit.id" :value="commit.id">
                    {{ commit.id }}
                </label>
            </td>
            <td v-text="commit.hash"></td>
            <td v-text="commit.comment"></td>
        </tr>
        </tbody>
        <tbody>
        <tr>
            <td colspan="2">
                <button :disabled="!checkedList.length" @click="deleteSelected">Delete Selected</button>
            </td>
        </tr>
        </tbody>
        <tbody>
        <tr>
            <td colspan="2">
                <paginator :metaData="metaData" @showPage="showPage"></paginator>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    import Collection from '@/mixin/Collection';
    import Paginator from '@/views/Paginator';

    export default {
        name: 'Commit',
        props: ['project_id'],
        mixins: [Collection],
        components: {Paginator},
        data: function () {
            return {
                currentPage: 0,
                checkedList: [],
                dataSet: false,
                metaData: {}
            };
        },
        methods: {
            fetch(page) {
                page = parseInt(this.$route.query.page) || 1;

                axios.get(this.url(page))
                    .then((response) => {
                        this.metaData = response.data.meta;
                        this.items = response.data.data;
                    })
                ;
            },
            url(page) {
                return '/api/v1/project/' + this.project_id + '/commits?page=' + page;
            },
            deleteSelected() {
                axios.post('/api/v1/project/' + this.project_id + '/delete-commits', {
                    'list': this.checkedList
                })
                    .then((response) => {
                        this.checkedList.length = 0;
                        this.fetch();
                    })
                ;
            },
            showPage(page) {
                this.$router.push({ name: 'project.commits', query: { page: page } });
            }
        },
        created() {
            this.fetch();
        },
        watch: {
            '$route' (to, from) {
                this.fetch();
            }
        }
    };
</script>
