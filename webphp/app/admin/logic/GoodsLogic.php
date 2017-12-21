<?php
namespace app\admin\logic;

use think\Model;
use think\Db;

class GoodsLogic extends Model
{

    public function getSpecInput($goods_id, $spec_arr)
    {
        if ($spec_arr){

            $spec_arr_sort = [];
            // 排序
            foreach ($spec_arr as $k => $v)
            {
                $spec_arr_sort[$k] = count($v);
            }
            //asort($spec_arr_sort);
            foreach ($spec_arr_sort as $key =>$val)
            {
                $spec_arr2[$key] = $spec_arr[$key];
            }

            $clo_name = array_keys($spec_arr2);
            $spec_arr2 = $this->combineDika($spec_arr2); //  获取 规格的 笛卡尔积

            $spec = Db::name('spec')->column('id,spec_name');

            $specItem = Db::name('spec_item')->column('id,item,spec_id');//规格项
            //$goods_sku = M('GoodsSku')->where('goods_id = '.$goods_id)->getField('item_path,price,store_count');//规格项
            $goods_sku = Db::name('good_sku')->where(array("goods_id"=>$goods_id))->column('item_path,price,store_count');

            $str = "<table class='table table-bordered' id='spec_input_tab'>";
            $str .="<tr>";

            // 显示第一行的数据

            foreach ($clo_name as $k=>$v)
            {
                $str .=" <td><b>{$spec[$v]}</b></td>";
            }

            $str .="<td width=120><b>价格</b></td>                          
             </tr>";

//            <td width=120><b>库存</b></td>
            // 显示第二行开始



          //  dump($spec_arr2);
            foreach ($spec_arr2 as $k => $v)
            {
                $str .="<tr>";
                $item_key_name = array();
                foreach($v as $k2 => $v2)
                {
                    $str .="<td>{$specItem[$v2]['item']}</td>";
                    $item_key_name[$v2] = $spec[$specItem[$v2]['spec_id']].':'.$specItem[$v2]['item'];
                }
                ksort($item_key_name);

                $item_key = implode('-', array_keys($item_key_name));

                $item_key = $this->chanitem($item_key);


                $item_name = implode(' ', $item_key_name);



              //  dump($goods_sku);

                if (empty($goods_sku[$item_key]['price'])){
                    $goods_sku[$item_key]['price'] = 0; // 价格默认为0
                }
//                if (empty($goods_sku[$item_key]['store_count'] )){
//                    $goods_sku[$item_key]['store_count'] = 0; //库存默认为0
//                }
                $str .="<td><input name='item[$item_key]['price']' value='{$goods_sku[$item_key]['price']}' onkeyup='this.value=this.value.replace(/[^\d.]/g,\"\")' onpaste='this.value=this.value.replace(/[^\d.]/g,\"\")' /></td>";
//                $str .="<td><input name='item[$item_key][store_count]' value='{$goods_sku[$item_key]['store_count']}' onkeyup='this.value=this.value.replace(/[^\d.]/g,\"\")' onpaste='this.value=this.value.replace(/[^\d.]/g,\"\")'/></td>";
                $str .="</tr>";
            }
            $str .= "</table>";



        }else{

            $str = "<table class='table table-bordered' id='spec_input_tab'>";
            $str .="<tr>";

            $str .="<td width=120><b>价格</b></td>
               <td width=120><b>库存</b></td>              
             </tr>";
        }


        return $str;
    }

    function chanitem($arr){
        $arrv =explode('-',$arr);
        foreach ($arrv as $k=>&$v){
            $v = '{'.$v.'}';
        }
        $new = implode('-', $arrv);
        return $new;
    }

    /*function chanitem($arr){

        $arrv =explode('-',$arr);

        foreach ($arrv as $k=>&$v){
            $v = '{'.$v.'}';
        }

        $new = $arrv[0].'-'.$arrv[1];
        return $new;
    }*/

    public function getSpecList($goods_id){
        //详细页获取规格
        //规格
        $sku = M('GoodsSku')->where(array("goods_id"=>$goods_id))->getField("GROUP_CONCAT(`item_path` SEPARATOR '-') AS items_id");
        $sku = array_unique(explode('-', $sku));

        $spec_item = M('SpecItem')->order(array("item_order ASC"))->select();
        $spec_img = M('SpecImg')->where(array("goods_id"=>$goods_id))->select();

        $arr = array();
        foreach($spec_item as $v){
            if(in_array($v['id'],$sku)){
                $arr[getSpecName($goods_id,$v['spec_id'])][] = array("item_id"=>$v['id'],"item"=>$v['item'],"img"=>getItemImg($goods_id,$v['id']));

            }
        }
        return $arr;
    }



    /**
     * 两个数组的笛卡尔积
     * @param unknown_type $arr1
     * @param unknown_type $arr2
     */
    function combineArray($arr1,$arr2) {
        $result = array();
        foreach ($arr1 as $item1)
        {
            foreach ($arr2 as $item2)
            {
                $temp = $item1;
                $temp[] = $item2;
                $result[] = $temp;
            }
        }
        return $result;
    }


    /**
     * 多个数组的笛卡尔积
     *
     * @param unknown_type $data
     */
    function combineDika() {
        $data = func_get_args();
        $data = current($data);
        $cnt = count($data);
        $result = array();
        $arr1 = array_shift($data);
        foreach($arr1 as $key=>$item)
        {
            $result[] = array($item);
        }

        foreach($data as $key=>$item)
        {
            $result = $this->combineArray($result,$item);
        }
        return $result;
    }

}


