<?php
class Sql{

    protected $_dbh;
    public $data;

    public function  __construct($data){

        try {
            $this->data=$data;
            //******DB configs********//
            $host = 'localhost';
            $dbname = 'admin_game';
            $user = 'admin_game';
            $pass = 'xhbR06ETRe';
            //**********************//
            $dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            return $this->_dbh = $dbh;
        }
        catch(PDOException $e) {
            echo $e->getMessage().' Connection to DB failed!';
        }
    }

    public function select($table, $fields, $query, $data, $limit = null, $order = null){

        //$query format - name = ?

        $sth = $this->_dbh->prepare("SELECT ".$fields." FROM `".$table."` WHERE ".$query." ".$limit." ".$order);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute($data);

        return $sth->fetchAll();
    }

    public function insert($table, $query, $data = array()){

        //$query format - (name, addr, city) values (?, ?, ?)

        $sth = $this->_dbh->prepare("INSERT INTO `".$table."` ".$query);

        $sth->execute($data);
    }

    public function update($table, $query, $where){

        //$query format - `name` = '?'

        $sth = $this->_dbh->prepare("UPDATE `".$table."` SET ".$query." WHERE ".$where);
        $sth->execute();
    }

    public function delete($table, $where){

        $sth = $this->_dbh->prepare("DELETE FROM `".$table."` WHERE ".$where);
        $sth->execute();
    }

    public function edit($more, $not){
        foreach ($this->data as $key=>$value){
            if (!in_array($key, $not)){
                if (is_array($this->data[$key])){
                    $body.="`".$key."`='".mysql_escape_string(json_encode($value))."',";
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

    public function add($more, $not){
        foreach ($this->data as $key=>$value){
            if (!in_array($key, $not)){
                if (is_array($this->data[$key])){
                    $body1.="`".$key."`,";
                    $body2.="'".mysql_escape_string(json_encode($value))."',";
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