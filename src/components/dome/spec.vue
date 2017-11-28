<template>
  <li class="fl block" :class="className" @click="chonse()">{{ text }}</li>
</template>

<script type="text/javascript">
  export default {
    props: {
      value: {
        type: [String,Number],
        required: true
      },
      text: {
        type: String,
        default: ''
      }
    },
    data() {
      return {

      }
    },
    mounted() {

    },
    methods:{
      chonse() {
        this.$emit('chonseSpec');
      }
    },
    computed: {
      className() {
        const name = {};
        if(this.$parent.guige.indexOf(this.value) >= 0) {
          name['active'] = true;
        }else{
          name['active'] = false;
        }
        return name;
      }
    }
  }
</script>
