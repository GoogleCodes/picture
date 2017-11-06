<template>
    <li class="fl" :class="className" @click="changeGuige(indexs, values, texts)">{{ texts }}</li>
</template>
<script type="text/javascript">
    export default {
        props: {
            list: {
                type: [Array,Object],
                required: true
            },
            indexs: {
                type: [Number],
                required: true,
            },
            values: {
                type: [Number,String],
                required: true,
            },
            texts: {
                type: String,
                default: ''
            },
            wrap: {
                type: [Array,Object],
                required: true,
            },
        },
        data() {
            return {
                guige: [],
                guigeName: [],
            }
        },
        computed: {
            className() {
                let name = {};
                if (this.guige.indexOf(this.values) >= 0) {
                    name['active'] = true;
                } else {
                    name['active'] = false;
                }
                return name;
            }
        },
        mounted() {
            
        },
        methods: {
            checkGuige() {
                if (this.guige.length !== this.list.length) {
                    return false;
                } else {
                    for (let g in this.guige) {
                        if (typeof this.guige[g] == 'undefined' || this.guige[g] == '') {
                            console.log(2);
                            return false;
                        }
                    }
                    return true;
                }
            },
            changeGuige(index, id, name) {
                for (let i in this.wrap) {
                    console.log(this.wrap[i].id == id);
                    if(this.wrap[i].id == id) {
                        this.className.active = true;
                    } else {
                        this.className.active = false;
                    }
                }
                return;
                this.$set(this.guige, index, id);
                this.$set(this.guigeName, index, name);
                if (!this.checkGuige()) {
                    return;
                }   
                console.log(this.guige, this.guigeName);
                this.$postData(this.$api.get_content.GET_POST_PRICE, {
                    spec: this.guige.join('-')
                }).then((res) => {
                    
                });
            }
        }
    }
</script>

<style type="text/css">

</style>