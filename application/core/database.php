<?php
require_once "config.php";

class DataBase{
	var $Config;
	var $connect;
	public function __construct(){
		$this->Config  = new Config();
		$this->connect = new mysqli($this->Config->host,$this->Config->user,$this->Config->password,$this->Config->data_base);
		$this->query("SET NAMES utf8");
	}

	public function query($query){
		return $this->connect->query($query);
	}

	public function max_values($table_name){
		return count($this->select($table_name,"*"));
	}

	public function select($table_name,$field,$where="",$order="",$up=true,$limit=""){
		$table = "`".$this->Config->prefix.$table_name."`";

		if(is_string($field)){
			if($field == "*"){
			$fild = "*";
		}else{
			$array = explode(",",$field);
			foreach($array as $value){
			$fild .= "`".$value."`,";
		}
		$fild = substr($fild,0,-1);
		}
			$query = "SELECT {$fild} FROM {$table}";
		}elseif(is_array($field)){
		if(in_array("*",$field)){
			$fild = "*";
		}else{
			$string = implode(",",$field);
			$array = explode(",",$string);
			foreach($array as $value){
			$fild .= "`".$value."`,";
		}
		$fild = substr($fild,0,-1);

		}
			$query = "SELECT {$fild} FROM {$table}";
		}else throw new Exception("ERROR_INPUT_VALUE");

		if(!empty($limit)) $limit = "LIMIT $limit";
		if(!empty($order)) $order = "ORDER BY $order ";
		else $order = "ORDER BY `id` ";
		if($up = false) $up = $order."DESC";
		else $up = $order."ASC";
		if(!empty($where)) {
		$query .= " WHERE {$where} {$up} {$limit}";
		}else{
		$query .= " {$up} {$limit}";
		}

		if(is_object($result_set = $this->query($query))){

		while($row = $result_set -> fetch_assoc()){
			$data [] = $row;
		}
			return $data;
		}else 	DataBase::ErrorPage404();

	}


	public function insert($table_name,$fild,$values){
		$table = "`".$this->Config->prefix.$table_name."`";

	foreach( $fild as $value){
		$keys .= "`".$value."`,";
	}
		$keys = "(".substr($keys,0,-1).")";


	foreach( $values as $value){
		$val .= "'".$value."',";
	}

		$val = "(".substr($val,0,-1).")";

	$query = "INSERT INTO {$table} {$keys} VALUES {$val}";
		return  $this->query($query);
	}

	public function update($table_name,$upd,$where){
		$table = "`".$this->Config->prefix.$table_name."`";

	foreach($upd as $key => $values){
		$result .= "`".$key."` = '".$values."',";
	}
		$result = substr($result,0,-1);
		$query = "UPDATE {$table} SET  {$result} WHERE {$where}";
		return $this->query($query);
	}

	public function getAll($table_name){
		return $this->select($table_name,"*");
	}
	public function getFild($table_name,$fild_out,$fild_in,$value){
		return $this->select($table_name,"{$fild_out}","`{$fild_in}` = '{$value}'");
	}
	public function getFildOnID($table_name,$id){
		return $this->select($table_name,"*","`id` = '{$id}'");
	}

	public function __destructor(){
		$this->connect->close();
	}
	public function __call($name,$value){
		DataBase::ErrorPage404();
	}
	public function __set($name,$values){
		DataBase::ErrorPage404();
	}
	public function __get($name){
		DataBase::ErrorPage404();
	}
    public function ErrorPage404(){
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }


}

?>