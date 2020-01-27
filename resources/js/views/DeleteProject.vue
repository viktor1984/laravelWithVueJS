<template>
    <div>
        <p>
            <button @click="showModal = true" class="button is-danger is-small modal-button" data-target="modal" aria-haspopup="true">Delete the project</button>
        </p>
        <div class="modal" :class="{'is-active' : showModal}">
            <div class="modal-background"></div>
            <div class="modal-content">
                <form method="post" @submit.prevent="onSubmit" class="box">
                    <div class="field">
                        <div class="control">
                            Are you shore to want delete the project?
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <button class="button is-danger">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
            <button @click="showModal = false" class="modal-close is-large" aria-label="close"></button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: 'remove-project',
                showModal: false
            };
        },
        props: ['project_id'],
        methods: {
            onSubmit() {
                axios.delete('/api/v1/project/' + this.project_id)
                    .then((response) => {
                        this.showModal = false;
                        this.$emit('deleted');
                    });
            }
        }
    };
</script>
