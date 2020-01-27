<template>
    <div>
        <p>
            <button @click="showModal = true" class="button is-primary is-large modal-button" data-target="modal" aria-haspopup="true">Create new project</button>
        </p>
        <div class="modal" :class="{'is-active' : showModal}">
            <div class="modal-background"></div>
            <div class="modal-content">
                <form method="post" @submit.prevent="onSubmit" class="box">
                    <div class="field">
                        <div class="control">
                            <div class="field is-horizontal">
                                <div class="field-body">
                                    <div class="field is-grouped">
                                        <p class="control is-expanded">
                                            <input @paste="onPaste" v-model="owner" class="input" type="text" placeholder="Owner">
                                        </p>
                                    </div>
                                    <div class="field">
                                        <p class="control is-expanded has-icon has-icon-right">
                                            <input v-model="repo" class="input" type="text" placeholder="Repo">
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <button class="button is-primary">Create</button>
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
                name: 'create-project',
                showModal: false,
                owner: '',
                repo: ''
            };
        },
        methods: {
            onPaste(evt) {

                if (result.length === 2) {
                    this.owner = result[0].trim();
                    this.repo = result[1].trim();
                }
            },
            onSubmit() {
                axios.post('/api/v1/project', {
                    owner: this.owner,
                    repo: this.repo
                })
                    .then((response) => {
                        this.owner = '';
                        this.repo = '';
                        this.showModal = false;
                    });
            }
        }
    };
</script>
