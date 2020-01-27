<template>
    <label class="panel-block">
        <input type="checkbox" v-model="isChecked" v-bind:id="id">
        <slot></slot>
    </label>
</template>

<script>
    export default {
        name: 'CommitItem',
        data: function () {
            return {
                isChecked: false
            };
        },
        props: ['id']
    }
</script>
