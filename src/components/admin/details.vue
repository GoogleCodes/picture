<template>
    <div>
        <template v-for="(item, index) in skuList">
            <div class="skuList clear">
                <div class="itemName fl">{{ item.skuName }}:</div>
                <ul class="fl">
                    <template v-for="(x, i) in item.attribute">
                        <li class="fl" :class="{'active':i == colSelected}"
                        @click="colChose(i)">{{ x.value }}</li>
                    </template>
                </ul>
            </div>
        </template>
    </div>
</template>

<script type="text/javascript">
    export default {
        data() {
            return {
                skuList: [],
                attributeName:[],       //存储了属性类型，就是['颜色','大小']
                attrList:[],            //存储了每个属性类型下的值
                attrValueList:[],       //存储了去重后的有效属性值
                chooseAttrList:[],      //存储当前选择的属性对象的linkto(属性对应的所有产品的skuId)
                chooseAttrItemList:[],  //存储当前选中的完整对象
                activeSkuList:[],       //存储了所有的skuId
                postSkuId:0,            //最终选定的产品ID
                colSelected: 0,
                sizeSelected: 0,
            }
        },
        computed: {

        },
        mounted() {
            this.getSkuList();
        },
        methods: {
            getSkuList() {
                this.$http.get("../../../static/data/skuList.json").then((res) => {
                    this.skuList = res.data;
                });
            },
            colChose(index) {
                this.colSelected = index;
            },
            sizeChose(index) {
                this.sizeSelected = index;
            }
        },
    }

</script>

<style type="text/css">
    .skuList {
        width: 350px;
    }
    .skuList .itemName {
        width: 80px;
        height: 40px;
        line-height: 40px;
        text-align: right;
    }

    .skuList ul li {
        height: 40px;
        line-height: 40px;
        padding: 0 10px;
        cursor: pointer;
    }

    .skuList ul .active {
        color: #c40000;
    }
</style>