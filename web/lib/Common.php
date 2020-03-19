<?php
class Common{
    function expand_items($item_l,$qty_l,$up_l)
    {
        $tmp1 = preg_replace('/\"|\[|\]/', '', $item_l);
        $tmp2 = explode(",", $tmp1);
        $tmp3 = preg_replace('/\"|\[|\]/', '', $qty_l);
        $tmp4 = explode(",", $tmp3);
        $tmp5 = preg_replace('/\"|\[|\]/', '', $up_l);
        $tmp6 = explode(",", $tmp5);

        $jj = 0;
        $item = '';

        foreach ($tmp2 as $values) {
            $item .= "{$values} จำนวน {$tmp4[$jj]} ราคา {$tmp6[$jj]}";
//            @$item .= "<p>" . $values . "จำนวน " . $tmp4[$jj] . " ราคา " . $tmp6[$jj];
//            @$item .= "</p>";
            $jj++;
        }
        return $item;
    }
}
