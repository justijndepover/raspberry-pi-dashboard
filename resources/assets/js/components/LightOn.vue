<template>
    <button type="button" @click="trigger" class="btn btn-success">Turn light on</button>
</template>

<script>
    var axios = require('axios');

    export default {
        methods: {
            trigger() {
                axios.get('/api/lights/on').then(response => {
                    // done
                });
            }
        }
    }
</script>
