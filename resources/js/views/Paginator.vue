<template>
    <nav v-if="shouldPaginate" class="pagination is-right" role="navigation" aria-label="pagination">
        <router-link tag="a" :to="{ name: 'project.commits', query: { page: previousPage }}" exact>
            <a :disabled="isFirstPage" class="pagination-previous">Previous</a>
        </router-link>
        <router-link tag="a" :to="{ name: 'project.commits', query: { page: nextPage }}" exact>
            <a class="pagination-next" :disabled="isLastPage">Next page</a>
        </router-link>
        <ul class="pagination-list">
            <li>
                <router-link tag="a" :to="{ name: 'project.commits', query: { page: 1 }}" exact>
                    <a v-bind:class="{ 'is-current' : isFirstPage }" class="pagination-link">1</a>
                </router-link>
            </li>
            <li v-for="item in pagesData">
                <span v-if="item.dotes" class="pagination-ellipsis">&hellip;</span>
                <template v-if="item.page > 0">
                    <router-link tag="a" :to="{ name: 'project.commits', query: { page: item.page }}" exact>
                        <a v-bind:class="{ 'is-current' : item.active }" class="pagination-link">{{ item.page }}</a>
                    </router-link>
                </template>
            </li>
            <li>
                <router-link tag="a" :to="{ name: 'project.commits', query: { page: meta.last_page }}" exact>
                    <a v-bind:class="{ 'is-current' : isLastPage }" class="pagination-link">{{ meta.last_page }}</a>
                </router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        name: 'Paginator',
        props: ['metaData'],
        data() {
            return {
                someVariable: false,
                isFirstPage: false,
                isLastPage: false,
                meta: {},
                pagesData: {},
                sidePagesCount: 1,
                previousPage: 0,
                nextPage: 0
            };
        },
        methods: {
            calculatePageNumbersButtons() {
                let pd = [];

                if (this.meta.current_page - this.sidePagesCount > 2) {
                    pd.push({
                        dotes: true,
                        page: 0,
                        url: false,
                        active: false
                    });
                }

                let from = Math.max(this.meta.current_page - this.sidePagesCount, 2);
                let to = Math.min(this.meta.current_page + this.sidePagesCount, this.meta.last_page - 1);

                for (; from <= to; from++) {
                    pd.push({
                        dotes: false,
                        page: from,
                        url: this.path + '?page=' + from,
                        active: (parseInt(this.meta.current_page) === from)
                    });
                }

                if ((this.meta.last_page - to) > 1) {
                    pd.push({
                        dotes: true,
                        page: 0,
                        url: false,
                        active: false
                    });
                }

                this.pagesData = pd;

            },
            init() {
                this.meta.current_page = parseInt(this.metaData.current_page) || 0;
                this.meta.from = parseInt(this.metaData.from) || 0;
                this.meta.last_page = parseInt(this.metaData.last_page) || 0;
                this.meta.path = this.metaData.path || 0;
                this.meta.per_page = parseInt(this.metaData.per_page) || 0;
                this.meta.to = parseInt(this.metaData.to) || 0;
                this.meta.total = parseInt(this.metaData.total) || 0;

                if (this.meta.last_page < this.meta.current_page) {
                    this.$emit('showPage', this.meta.last_page);
                }

                this.isFirstPage = this.meta.current_page === 1;
                this.isLastPage = this.meta.current_page === this.meta.last_page;

                this.previousPage = this.meta.current_page - 1;
                this.nextPage = this.meta.current_page + 1;

                this.calculatePageNumbersButtons();
            }
        },
        computed: {
            shouldPaginate() {
                return this.metaData.total > 1;
            }
        },
        watch: {
            metaData() {
                this.init();
            }
        }
    };
</script>
