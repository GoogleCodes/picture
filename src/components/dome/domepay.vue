<template>
  <div>
    <div class="pc-slide">
      <div class="view">
        <div class="swiper-container">
          <a class="arrow-left" href="#"></a>
          <a class="arrow-right" href="#"></a>
          <div class="swiper-wrapper">
            <template v-for="k in myspecList">
              <div class="swiper-slide">
                <a target="_blank">
                  <img :src="k.url" alt="">
                </a>
              </div>
            </template>
          </div>
        </div>
      </div>
      <div class="preview">
        <a class="arrow-left" href="#"></a>
        <a class="arrow-right" href="#"></a>
        <div class="swiper-container">
          <div class="swiper-wrapper">
            <template v-for="k in myspecList">
              <div class="swiper-slide active-nav">
                <img :src="k.url" alt="" style="width: 100%;height: 100%;">
              </div>
            </template>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script type="text/javascript">

  import Swiper from '../../../static/js/idangerous.swiper.min.js'

  export default {
    data() {
      return {
        dome: '',
        myspecList: JSON.parse(localStorage.getItem('swiper')),
        option: [
          {
            img: '../../../static/images/banner/01.jpg'
          }, {
            img: '../../../static/images/banner/02.jpg'
          }
        ],
      }
    },
    mounted() {

      this.getSwiper();

//      this.myspecList = JSON.parse(localStorage.getItem('swiper'));

      var viewSwiper = new Swiper('.view .swiper-container', {
        onSlideChangeStart: function () {
          updateNavPosition();
        }
      })

      $('.view .arrow-left,.preview .arrow-left').on('click', function (e) {
        e.preventDefault();
        if (viewSwiper.activeIndex == 0) {
          viewSwiper.swipeTo(viewSwiper.slides.length - 1, 1000);
          return;
        }
        viewSwiper.swipePrev();
      })

      $('.view .arrow-right,.preview .arrow-right').on('click', function (e) {
        e.preventDefault();
        if (viewSwiper.activeIndex == viewSwiper.slides.length - 1) {
          viewSwiper.swipeTo(0, 1000);
          return
        }
        viewSwiper.swipeNext();
      })

      var previewSwiper = new Swiper('.preview .swiper-container', {
        visibilityFullFit: true,
        slidesPerView: 'auto',
        onlyExternal: true,
        onSlideClick: function () {
          viewSwiper.swipeTo(previewSwiper.clickedSlideIndex);
        }
      })

      function updateNavPosition() {
        $('.preview .active-nav').removeClass('active-nav');
        var activeNav = $('.preview .swiper-slide').eq(viewSwiper.activeIndex).addClass('active-nav');
        if (!activeNav.hasClass('swiper-slide-visible')) {
          if (activeNav.index() > previewSwiper.activeIndex) {
            var thumbsPerNav = Math.floor(previewSwiper.width / activeNav.width()) - 1;
            previewSwiper.swipeTo(activeNav.index() - thumbsPerNav);
          } else {
            previewSwiper.swipeTo(activeNav.index());
          }
        }
      }
    },
    methods: {
      webchatpay() {
        this.$http.post('https://xinye-art.com/public/api/home/pay/getcode').then((res) => {
          console.log(res);
        });
      },
      alipay() {
        this.$ajax.HttpPost('/api/home/pay/alpay', {
          id: 28,
          uid: 8
        }).then((res) => {
          $("#box").html(res);
        })
      },
      getSwiper() {
        this.$ajax.HttpGet(this.$api.get_content.GET_STOP_MSG + '?id=' + 79).then((res) => {
          let that = this;
          switch (true) {
            case res.code == 1:
              this.list = res.data;
              that.myspecList = JSON.parse(res.data.photo);
              let swiper = res.data.photo;
              localStorage.setItem('swiper', swiper)
              return true;
            case res.data.code == 0:
              return false;
            default:
          }
        });
      },
    }
  }
</script>
<style>

  .pc-slide {
    width: 1200px;
    margin: 0 auto;
    position: relative;
  }

  .view .swiper-container {
    width: 100%;
    height: 350px;
  }

  .view .arrow-left {
    position: absolute;
    left: 10px;
    top: 50%;
    margin-top: -25px;
    width: 28px;
    height: 51px;
    z-index: 10;
  }

  .view .arrow-right {
    position: absolute;
    right: 10px;
    top: 50%;
    margin-top: -25px;
    width: 28px;
    height: 51px;
    z-index: 10;
  }

  .preview {
    width: 100%;
    margin-top: 10px;
    position: absolute;
    bottom: 0px;
  }

  .preview .swiper-container {
    width: 430px;
    height: 82px;
    margin-left: 35px;
  }

  .preview .swiper-slide {
    width: 100px;
    height: 82px;
  }

  .preview .slide6 {
    width: 82px;
  }

  .preview .arrow-left {
    position: absolute;
    left: 10px;
    top: 50%;
    margin-top: -9px;
    width: 9px;
    height: 18px;
    z-index: 10;
  }

  .preview .arrow-right {
    position: absolute;
    right: 10px;
    top: 50%;
    margin-top: -9px;
    width: 9px;
    height: 18px;
    z-index: 10;
  }

  .preview img {
    padding: 1px;
  }

  .preview .active-nav img {
    padding: 0;
  }
</style>
