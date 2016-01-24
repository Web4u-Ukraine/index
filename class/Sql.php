<?php
/**
 * Created by PhpStorm.
 * User: taras
 * Date: 15.01.16
 * Time: 14:55
 */
class Sql {
    public $data;

    public function __construct($data){
        $this->data=$data;
    }

    public function editSql($more, $not){
        foreach ($this->data as $key=>$value){
            if (!in_array($key, $not)){
                if (is_array($this->data[$key])){
                    $body.="`".$key."`='".implode('&', $value)."',";
                } else {
                    $body.="`".$key."`='".mysql_escape_string($value)."',";
                }
            }
        }

        foreach ($more as $k=>$v){
            $body.="`".$k."`='".mysql_escape_string($v)."',";
        }

        return substr($body, 0, -1);
    }

    public function addSql($more, $not){
        foreach ($this->data as $key=>$value){
            if (!in_array($key, $not)){
                if (is_array($this->data[$key])){
                    $body1.="`".$key."`,";
                    $body2.="'".implode('&', $value)."',";
                } else {
                    $body1.="`".$key."`,";
                    $body2.="'".mysql_escape_string($value)."',";
                }
            }
        }

        foreach ($more as $k=>$v){
            $body1.=$k.",";
            $body2.="'".mysql_escape_string($v)."',";
        }
        return "(".substr($body1, 0, -1).") values (".substr($body2, 0, -1).")";
    }
}