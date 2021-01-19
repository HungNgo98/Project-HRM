<?php

/**
 * Defined function common
 */
namespace App\Http\Utils;

class CommonUtils
{   
   /**
    * Make alias to seo
    */
    function makeAlias($string) {
        $alias = $string;

        $coDau = array("à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă",
            "ằ", "ắ", "ặ", "ẳ", "ẵ",
            "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ",
            "ì", "í", "ị", "ỉ", "ĩ",
            "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ"
            , "ờ", "ớ", "ợ", "ở", "ỡ",
            "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ",
            "ỳ", "ý", "ỵ", "ỷ", "ỹ",
            "đ",
            "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă"
            , "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ",
            "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ",
            "Ì", "Í", "Ị", "Ỉ", "Ĩ",
            "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ"
            , "Ờ", "Ớ", "Ợ", "Ở", "Ỡ",
            "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ",
            "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ",
            "Đ", "ê", "ù", "à");

        $khongDau = array("a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a"
            , "a", "a", "a", "a", "a", "a",
            "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e",
            "i", "i", "i", "i", "i",
            "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o"
            , "o", "o", "o", "o", "o",
            "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
            "y", "y", "y", "y", "y",
            "d",
            "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A"
            , "A", "A", "A", "A", "A",
            "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E",
            "I", "I", "I", "I", "I",
            "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O"
            , "O", "O", "O", "O", "O",
            "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U",
            "Y", "Y", "Y", "Y", "Y",
            "D", "e", "u", "a");

        $alias = str_replace($coDau, $khongDau, $alias);

        $coDau = array("̀", "́", "̉", "̃", "̣", "“", "”", ".");
        $khongDau = array("", "", "", "", "", "", "", "");
        $alias = str_replace($coDau, $khongDau, $alias);

        $alias = preg_replace('/[^a-zA-Z0-9-.]/', '-', $alias);
        $alias = preg_replace('/^[-]+/', '', $alias);
        $alias = preg_replace('/[-]+$/', '', $alias);
        $alias = preg_replace('/[-]{2,}/', '-', $alias);
        return $alias;
    }

     /**
      * Build tree from array
      */
      public static function arrToTree($items, $fieldKey = 'id'){
        if(!count($items)) return $items;
        $childs = [];
        foreach ($items as $item) {
            if(is_object($item))
            {
                if($item->parent_id == null) $item->parent_id = 0;
                $childs[$item->parent_id][$item->$fieldKey] = $item;
            }else if(is_array($item)){
                if($item['parent_id'] == null) $item['parent_id'] = 0;
                $childs[$item['parent_id']][$item[$fieldKey]] = $item;
            }
            
        }

       foreach ($items as $item) {
            if (is_object($item) AND isset($childs[$item->$fieldKey]))
               $item->data_child = $childs[$item->$fieldKey];
            else if (is_array($item) AND isset($childs[$item[$fieldKey]]))
               $item['data_child'] = $childs[$item[$fieldKey]];
       }
       if (count($childs)){
           $items = $childs[0];
       }else{
           $items = [];
       }
       return $items;
    }

    /** 
     *  Get array tree from last sub to root
     *  $items: array object/array
     *  $onlyText: true - return array text, false - return array object/array
     */     
    public static function arrToTreeDown($items, $value = 0, $onlyText = false, $fieldText = 'text'){
       $arr_out = [];
       if(isset($items[$value])){
           $item = $items[$value];
           if($onlyText){
               if(\is_array($items[$value])){
                   $arr_out[] = $items[$value][$fieldText];
               }else if(\is_object($items[$value])) $arr_out[] = $items[$value]->$fieldText;
           }
           else $arr_out[] = $items[$value];

           if(is_object($item) AND $item->parent_id){
               $arr_out = array_merge($arr_out, CommonUtils::arrToTreeDown($items, $item->parent_id, $onlyText));
           }else if(is_array($item) AND $item['parent_id'])
           {
                $arr_out = array_merge($arr_out, CommonUtils::arrToTreeDown($items, $item['parent_id'], $onlyText));
           }
       }
       return $arr_out;
    }


    /**
     * tree to array. list sub after its parent
     */
    public static function treeToArr($items, $level = 1, $fieldText = 'text', $fieldValue = 'value'){
       $arr_out = [];
       if(count($items)){
           foreach($items as $item){
               $text_level = $item->$fieldText;
               if($level > 1){
                $text_level = "|".(str_repeat("____", $level - 1)) ." ".$text_level;
               }
               $arr_out[] = [
                   $fieldValue => $item->$fieldValue, 
                   $fieldText => $item->$fieldText, 
                   'text_level' => $text_level,
                   'level' => $level,
                   'parent_id' => $item->parent_id
                ];
               if(isset($item->data_child) and count($item->data_child)){
                   $arr_out = array_merge($arr_out, CommonUtils::treeToArr($item->data_child, $level + 1, $fieldText));
               }
           }
       }
       return $arr_out;
    }
}