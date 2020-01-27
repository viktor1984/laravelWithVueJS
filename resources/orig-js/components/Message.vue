<template>
    <div class="box">
        <p>
            <slot></slot>
        </p>
        <counter></counter>
    </div>
</template>

<script>
    import Counter from "./Counter";

    export default {
        name: 'Message',
        components: {Counter}
    }
</script>

<style>
    .box {
        background-color: #e3e3e3;
        padding: 10px;
        border: 1px solid #c5c5c5;
        margin-bottom: 10px;
    }
</style>
