<?
 $db_connection;
 $db_options['host'] = 'localhost';
 $db_options['user'] = 'admin_api';
 $db_options['password'] = 'rhfrflsk123';
 $db_options['database'] = 'admin_api';

function db_stat()
{
    return "Queries: ".$GLOBALS['query_count']." db_connections: ".$GLOBALS['conn_count'];
}

function db_connect()
{
     global $db_options;
     global $db_connection;

    $db_connection = mysql_connect($db_options['host'], $db_options['user'], $db_options['password'])
        or die("Невозможно подключится к MySQL.");
    mysql_select_db($db_options['database'], $db_connection)
        or die("Невозможно выбрать базу данных.");
    mysql_query("SET NAMES utf8", $db_connection);
    $GLOBALS['conn_count']++;
}



function db_select($sql)
 {
    global $db_connection;

     if(!$db_connection)
         {
             db_connect();
         }
     $GLOBALS['query_count']++;
     $result = mysql_query($sql, $db_connection) or die ("$sql");
       return $result;
 }

//функция для очистки полей
function clear($string){
	$string=strip_tags($string);
	return $string;
}

//функция очистки текста
function textClear($string){
	$string=str_replace("'", "\'", $string);
	$string=str_replace('"', '\"', $string);
	$string=strip_tags($string, '<p><img><ul><li>');
	return $string;
}

function dlina($text, $lenght){
	$text=strip_tags(htmlspecialchars_decode($text));
    $arr_str = explode(" ", $text);
	//берем первые 6 элементов
	$arr = array_slice($arr_str, 0, $lenght);
	//превращаем в строку
	$new_str = implode(" ", $arr);
	 
	// Если необходимо добавить многоточие
	if (count($arr_str) > 2) {
	   $new_str .= '...';
	} 
	return $new_str;
}

function slice($srt){
	$srt=substr($srt, 1, strlen($srt)-2);
	$srt=explode(',', $srt);
	return $srt;
}

$c=explode('.', $_SERVER['REMOTE_ADDR']);
$integer_ip = (16777216*$c[0])+(65536*$c[1])+(256*$c[2])+$c[3];

function sql($type, $table, $where, $dump){
	switch ($type){
		case 1:
			$res=db_select("select * from $table $where");
			if ($dump==1){
				echo "select * from $table $where";
			}
			while ($row=mysql_fetch_array($res)){
				$data[]=$row;
			}
			return $data;
			break;
			
		case 2:
			$res=db_select("insert into $table $where");
			if ($dump==1){
				echo "insert into $table $where";
			}
			break;
			
		case 3:
			$res=db_select("update $table set $where");
			if ($dump==1){
				echo "update $table set $where";
			}
			break;
			
		case 4:
			$res=db_select("delete from $table $where");
			if ($dump==1){
				echo "delete from $table $where";
			}
			break;
	}
}
?>