<template>
    <nav class="pagination is-right" role="navigation" aria-label="pagination">
        <a class="pagination-previous" :disabled="pd.current_page == 1">Previous</a>
        <a class="pagination-next" :disabled="pd.current_page == pd.last_page">Next page</a>
        <ul class="pagination-list">
            <li><a  v-bind:class="{ 'is-current' : pd.current_page == 1 }" class="pagination-link" aria-label="Goto page 1">1</a></li>
            <li v-for="item in pagesData">
                <span v-if="item.dotes" class="pagination-ellipsis">&hellip;</span>
                <template v-if="item.page > 0">
                    <!--<a @click="loadData(item.url)" v-bind:class="{ 'is-current' : item.active }" class="pagination-link" aria-label="Goto page ">{{ item.page }}</a>-->
                    <router-link tag="a" :to="{ name: 'project.commits.pages', params: { page_number: 1 }}" exact>
                        <a v-bind:class="{ 'is-current' : item.active }" class="pagination-link" aria-label="Goto page ">{{ item.page }}</a>
                    </router-link>
                </template>
            </li>
            <!--<li><a @click="goToPage(pd.last_page)" v-bind:class="{ 'is-current' : pd.current_page == pd.last_page }" class="pagination-link" aria-label="Goto page 00">{{ pd.last_page }}</a></li>-->
            <li>
                <router-link tag="a" :to="{ name: 'project.commits.pages', params: { page_number: 3 }}" exact>
                    <a v-bind:class="{ 'is-current' : pd.current_page == pd.last_page }" class="pagination-link" aria-label="Goto page 00">{{ pd.last_page }}</a>
                </router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        name: 'Paginator',
        data: function() {
            return {
                data: {},
                pd: {},
                path: '',
                pagesData: []
            };
        },
        props: [
            'url'
        ],
        methods: {
            goToPage: function (pageNumber) {
                // load data form target url
                this.loadData(this.path + '?page=' + pageNumber);

            },
            loadData: function (url) {

                axios.get(url)
                    .then((response) => {
                        console.log(response.data);

                        this.data = response.data.data;
                        let meta = response.data.meta;
                        let links = response.data.links;

                        this.path = meta.path;

                        this.pd = {
                            current_page: meta.current_page,
                            from: meta.from,
                            last_page: meta.last_page,
                            first_page_url: links.first,
                            last_page_url: links.last,
                            next_page_url: links.next,//page < dummyData.length ? 'http://example.com/page/2' : null,
                            per_page: meta.per_page,
                            prev_page_url: links.prev,//page > 1 ? 'http://example.com/page/1' : null,
                            to: meta.to,
                            total: meta.total
                        };


                        // parsing
                        let sidePagesCount = 1;
                        let pd = [];

                        if (meta.current_page - sidePagesCount > 3) {
                            pd.push({
                                dotes: true,
                                page: 0,
                                url: false,
                                active: false
                            });
                        }

                        //

                        let from = Math.max(meta.current_page - sidePagesCount, 2);
                        let to = Math.min(meta.current_page + sidePagesCount, meta.last_page - 1);

                        for (; from <= to; from++) {
                            pd.push({
                                dotes: false,
                                page: from,
                                url: this.path + '?page=' + from,
                                active: (parseInt(meta.current_page) === from)
                            });
                        }

                        // if page equals 2
                        // but we can add some more pages?

                        if ((meta.last_page - to) > 1) {
                            pd.push({
                                dotes: true,
                                page: 0,
                                url: false,
                                active: false
                            });
                        }

                        this.pagesData = pd;

                        this.$emit('dataUpdated', this.data);
                    })
                ;
            }
        },
        mounted() {
            // load data form target url
            this.loadData(this.url)
        }
    };
</script>
