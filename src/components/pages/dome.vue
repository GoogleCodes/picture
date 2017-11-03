<template>
    <li class="fl" :class="className">{{ texts }}</li>
</template>
<script type="text/javascript">
    export default {
        props: {
            list: {
                type: [Array,Object],
                required: true
            },
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
                
            }
        },
        mounted() {
            
        },
        methods: {
            goToDome() {
                
            }
        }
    }
</script>

<style type="text/css">

</style>