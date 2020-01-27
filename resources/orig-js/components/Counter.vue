<template>
    <div>
        <div>The count is: {{ count }}</div>
        <button @click="count += 1">Count up</button>
    </div>
</template>

<script>
    export default {
        name: 'Counter',
        data: function() {
            return {
                count: 0
            }
        }
    }
</script>
