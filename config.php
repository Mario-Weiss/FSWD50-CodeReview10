<?php 
class Database
{	
	public $host = "localhost";
	public $user = "username";
	public $pw = "password";
	public $db = "cr10_mario_weiss_biglibrary";
	public $connect;

	public function connect(){
		$this->connect = mysqli_connect($this->host,$this->user,$this->pw,$this->db);
		if (!$this->connect) {
			echo "Error in Connecting ".mysqli_connect_error();
		}
	}
	public function insert($table, $fields, $values) {
		$this->connect();
		$fields = is_array($fields) ? implode(", ", $fields) : $fields;
		//$values = implode("','", $values);
		$sql = '';
		foreach ($values as $value) {
			if ($sql !=''){
				$sql .=", ";
			}
			$sql .= "'".mysqli_real_escape_string($this->connect,$value)."'";
		}
		$sql = "INSERT INTO ".$table." (".$fields.") VALUES (".$sql.");";
		$this->connect->query($sql);
		mysqli_close($this->connect);
	}
	public function fetch_data($table,$fields='*',$join=''){
		$this->connect();
		$fields = is_array($fields) ? implode(",", $fields) : $fields;
		$join = is_array($join) ? implode(" ", $join) : $join;
		$sql = "SELECT ".$fields." FROM ".$table." ".$join.";";
		$result = $this->connect->query($sql);
		return $result->fetch_all(MYSQLI_ASSOC);
	}
	public function getData($table,$fields='*',$condition) {
		$this->connect();
		$sql='';
		$fields = is_array($fields) ? implode(",", $fields) : $fields;
		foreach ($condition as $key => $value) {
			if($sql != ''){
   				$sql .=" AND ";
  			}
 			$sql .= $key . "='" . $value . "'";
 		}
		$sql="Select ".$fields." FROM ".$table." WHERE ".$sql;
		$result = $this->connect->query($sql);
		return $result->fetch_all(MYSQLI_ASSOC);
	}
	public function update($table,$set,$condition) {
		$this->connect();
		$sql = '';
		$where= '';
		foreach ($set as $key => $value) {
			if($sql != ''){
   				$sql .=", ";
  			}
			$sql .= $key . "='".$value."' ";
		}
		foreach ($condition as $key => $value) {
			if($where != ''){
   				$where .=" AND ";
  			}
 			$where .= $key . "='" . $value . "'";
 		}
		$sql = "UPDATE ".$table." SET ".$sql." WHERE ".$where.";";
		$this->connect->query($sql);
		mysqli_close($this->connect);
	}
	public function delete($table,$condition) {
		$this->connect();
		$sql='';
		foreach ($condition as $key => $value) {
			if($sql != ''){
   				$sql .=" AND ";
  			}
 			$sql .= $key . "='" . $value . "'";
 		}
		$sql="DELETE FROM ".$table." WHERE ".$sql;
		$result = $this->connect->query($sql);
		mysqli_close($this->connect);
	}
	public static function mediafields(){
		return array("id","title","img","author_id","ISBN","short_desc","publish_date","publisher_id","type","status");
	}
	public static function authorfields(){
		return array("id","name","surname");
	}
	public static function publisherfields(){
		return array("id","name","adress","size");
	}
}
$obj = new Database;
?>