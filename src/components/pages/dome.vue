<template>
    <li class="fl" :class="className">{{ texts }}</li>
</template>
<script type="text/javascript">
    export default {
        props: {
            values: {
                type: [Number,String],
                required: true,
            },
            texts: {
                type: String,
                default: ''
            },
        },
        data() {
            return {

            }
        },
        computed: {
            className() {
                console.log(this.$parent);
            }
        },
        mounted() {
            
        },
        methods: {
            
        }
    }
</script>

<style type="text/css">

</style>