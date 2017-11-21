<template>
  <div>

  </div>
</template>

<script type="text/javascript">
  export default {
    data() {
      return {
        dropDowm: false,
        data: {
          list: [],
        },
        visiLayer: false,
      }
    },
    created() {
      this.getNav();
    },
    mounted() {

    },
    methods: {
      showLayer() {
        this.visiLayer = false;
      },
      getNav() {
        this.$http.get(this.$api.get_content.nav).then((res) => {
          console.log(res);
          this.data.list = res.data.nav;
        });
      },
      handleOpen(key, keyPath) {
        console.log(key, keyPath);
      },
      handleClose(key, keyPath) {
        console.log(key, keyPath);
      }
    },
  }
</script>


<style>

  /* layer start */
  .layer {
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0px;
    left: 0px;
    background: rgba(0,0,0,0.0);
    z-index: 250;
  }
  /* layer end */

  /* nav start */
  .nav {
    width: 195px;
    height: 100%;
    position: fixed;
    left: 0px;
    top: 0px;
    z-index: 350;
    background: #333;
  }

  .nav .el-col-8 {
    width: 100%;
  }

  .el-submenu .el-menu-item {
    min-width: 195px;
  }

  .nav .el-menu--dark {
    background: #333;
  }

  .el-menu--dark .el-submenu .el-menu {
    background: #222;
  }

  .el-menu-item-group__title {
    color: #808080;
  }

  .el-menu--dark .el-menu-item, .el-menu--dark .el-submenu__title {
    color: #808080;
    border-bottom: 0.01rem solid #666;
  }
  /* nav end */
</style>
