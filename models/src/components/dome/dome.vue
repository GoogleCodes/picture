<template>
    <div>
        <div style="margin-bottom: 20px">
            <h2>选择图片</h2>
            <a id='addPic' @click="setAvatar">添加图片 </a>
            <input type="file" name="img" accept="image/gif,image/jpeg,image/jpg,image/png" style="display:none" 
            @change="changeImage($event)" ref="avatarInput">
        </div>
    </div>
</template>

<script>
      export default {
          data() {
            images: []
          },
          created() {

          },
          methods: {
            changeImage() {
                
            },
            setAvatar() {
                
            },
          },
      }    
</script>