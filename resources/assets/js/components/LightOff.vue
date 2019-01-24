<template>
    <button type="button" @click="trigger" class="btn btn-danger">Turn light off</button>
</template>

<script>
    var axios = require('axios');

    export default {
        methods: {
            trigger() {
                axios.get('/api/lights/off').then(response => {
                    // done
                });
            }
        }
    }
</script>
