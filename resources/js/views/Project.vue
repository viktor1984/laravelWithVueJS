<template>
    <div>
        <nav class="panel">
            <p class="panel-heading">
                Repositories
            </p>
            <p class="panel-block" v-for="project in projects">
                <router-link
                        :to="{ name: 'project.commits', params: { project_id: project.id }}"
                        >
                    {{ project.owner + '/' + project.repo + ' (' + project.commits_count + ')' }}
                </router-link>
                <span v-if="project.status === 1" class="icon has-text-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                </span>
                <span v-if="project.status === 2" class="icon has-text-info">
                    <i class="fas fa-info-circle"></i>
                </span>
                <span v-if="project.status === 3" class="icon has-text-danger">
                    <i class="fas fa-ban"></i>
                </span>
                <delete-project @deleted="fetch" v-bind:project_id="project.id"></delete-project>
            </p>
        </nav>
        <create-project></create-project>
    </div>
</template>

<script>
    import CreateProject from '@/views/CreateProject';
    import DeleteProject from '@/views/DeleteProject';

    export default {
        name: 'Project',
        components: {
            CreateProject,
            DeleteProject
        },
        data: function () {
            return {
                projects: []
            }
        },
        methods: {
            fetch() {
                axios.get('/api/v1/project')
                // .then(response => this.projects = response.data)
                    .then((response) => {
                        this.projects = response.data.data;
                    })
                ;
            }
        },
        created() {
            this.fetch();
        }
    }
</script>
