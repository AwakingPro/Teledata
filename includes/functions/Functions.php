<?php
    if (!isset($_SESSION)){
        session_start();
    }
    function include_all_php($folder){
        foreach ((array)glob("{$folder}/*.php") as $filename)
        {
            if($filename != ""){
                include $filename;   
            }
        }
    }
    function Main_IncludeClasses($folder){
        include_all_php("../class/".$folder);
    }
    function QueryPHP_IncludeClasses($folder){
        include_all_php("../../class/".$folder);
    }
    function Prints_IncludeClasses($folder){
        include_all_php("../../../class/".$folder);
    }
    function array_sort($array, $on, $order=SORT_ASC){
        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                break;
                case SORT_DESC:
                    arsort($sortable_array);
                break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }

        return $new_array;
    }
?>