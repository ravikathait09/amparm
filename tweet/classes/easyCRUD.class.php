<?php 
/**
* Easy Crud  -  This class kinda works like ORM. Just created for fun :) 
*
* @author		Author: Vivek Wicky Aswal. (https://twitter.com/#!/VivekWickyAswal)
* @version      0.1a
*/
require_once('Db.class.php');
class Crud {

	protected $db;

	public $variables;

	public function __construct($data = array()) {
		$this->db =  new DB();	
		$this->variables  = $data;
	}

	public function __set($name,$value){
		if(strtolower($name) === $this->pk) {
			$this->variables[$this->pk] = $value;
		}
		else {
			$this->variables[$name] = $value;                        
		}                         
	}

	public function __get($name)
	{	
		if(is_array($this->variables)) {
			if(array_key_exists($name,$this->variables)) {                        
				return $this->variables[$name];
			}                             
		}

		$trace = debug_backtrace();                           
		trigger_error(
		'Undefined property via __get(): ' . $name .
		' in ' . $trace[0]['file'] .
		' on line ' . $trace[0]['line'],
		E_USER_NOTICE);
		return null;
	}                        

	public function save($id = "0") {
		$this->variables[$this->pk] = (empty($this->variables[$this->pk])) ? $id : $this->variables[$this->pk];

		$fieldsvals = '';
		$columns = array_keys($this->variables);                        
		//print_r($columns);
		foreach($columns as $column)
		{
			if($column !== $this->pk)
			$fieldsvals .= $column . " = :". $column . ",";
		}

		$fieldsvals = substr_replace($fieldsvals , '', -1);

		if(count($columns) > 1 ) {
			$sql = "UPDATE " . $this->table .  " SET " . $fieldsvals . " WHERE " . $this->pk . "= :" . $this->pk;
			return $this->db->query($sql,$this->variables);
		}                               
	}

	public function create() {                                
		$bindings   	= $this->variables;

		if(!empty($bindings)) {
			$fields     =  array_keys($bindings);
			$fieldsvals =  array(implode(",",$fields),":" . implode(",:",$fields));
			$sql 		= "INSERT INTO ".$this->table." (".$fieldsvals[0].") VALUES (".$fieldsvals[1].")";
		}
		else {
			$sql 		= "INSERT INTO ".$this->table." () VALUES ()";
		}                                  
		$sql;
		return $this->db->query($sql,$bindings);
	}
	public function createCustom($Arr) {                                

		$sql= "INSERT INTO ".$this->table." SET ";
		foreach($Arr as $k=>$v){
			$sql .= " $k = '".$v."' ,";
		}
			trim($sql);
			rtrim($sql,',');
			substr($sql,0,strlen($sql)-1);
			$sql .= " created_on ='".time()."'"; 
		return $this->db->query($sql);
	}

	public function delete($id = "") {
		$id = (empty($this->variables[$this->pk])) ? $id : $this->variables[$this->pk];

		if(!empty($id)) {
			$sql = "DELETE FROM " . $this->table . " WHERE " . $this->pk . "= :" . $this->pk. " LIMIT 1" ;
			return $this->db->query($sql,array($this->pk=>$id));
		}
	}

	public function deleteCustom($col,$val) {
		$sql = "DELETE FROM " . $this->table . " WHERE $col = $val " ;
		return $this->db->query($sql);
	}
	public function deleteCustomQuery($cond) {
		$sql = "DELETE FROM " . $this->table . " WHERE $cond" ;
		return $this->db->query($sql);
	}
	public function findWhere($cond) {
		$sql = "Select * FROM " . $this->table . " WHERE $cond" ;
		return $this->db->query($sql);
	}

	public function find($id = "") {
		$id = (empty($this->variables[$this->pk])) ? $id : $this->variables[$this->pk];
		if(!empty($id)) {
			$sql = "SELECT * FROM " . $this->table ." WHERE " . $this->pk . "= :" . $this->pk . " LIMIT 1";	
			$this->variables = $this->db->row($sql,array($this->pk=>$id));
		}
	}

	public function getColumns() {
		$sql = "SHOW COLUMNS FROM  " . $this->table ;	
		return $this->variables = $this->db->query($sql);
	}

	public function findCustom($arr) {                            
		$whereString = '';
		foreach($arr as $k=>$v){
			$whereString .= $k." = :" . $k ." AND ";                               
		}
	
			$sql = "SELECT * FROM " . $this->table ." WHERE " . $whereString ." 1";	
			return $this->variables = $this->db->query($sql,$arr);
	}
	public function findCustomCol($arr,$cols) {                            
		$whereString = '';
		foreach($arr as $k=>$v){
			$whereString .= $k." = :" . $k ." AND ";                               
		}
	
			$sql = "SELECT distinct $cols FROM " . $this->table ." WHERE " . $whereString ." 1";	
			return $this->variables = $this->db->query($sql,$arr);
	}
	public function findCustomRow($arr) {                            
		$whereString = '';
		foreach($arr as $k=>$v){
			$whereString .= $k." = :" . $k ." AND ";                               
		}
	
			$sql = "SELECT * FROM " . $this->table ." WHERE " . $whereString ." 1";
			
			return $this->variables = $this->db->row($sql,$arr);
	}

	public function all(){
		  $query = "SELECT * FROM " . $this->table. " order by id desc";                            
		return $this->db->query($query);
	}

	public function getDistinctCol($cols){
		$query = "SELECT distinct $cols FROM " . $this->table;                            
		return $this->db->query($query);
	}

	public function customQuery($sql){
		$query = $sql;
		return $this->db->query($query);
	}

	public function leftJoin($tbl1,$col1,$tbl2,$col2){
		$query = "SELECT * FROM " . $this->table;
		return $this->db->query($query);
	}
	
	public function min($field)  {
		if($field)
		return $this->db->single("SELECT min(" . $field . ")" . " FROM " . $this->table);
	}

	public function max($field)  {
		if($field)
		return $this->db->single("SELECT max(" . $field . ")" . " FROM " . $this->table);
	}

	public function avg($field)  {
		if($field)
		return $this->db->single("SELECT avg(" . $field . ")" . " FROM " . $this->table);
	}

	public function sum($field)  {
		if($field)
		return $this->db->single("SELECT sum(" . $field . ")" . " FROM " . $this->table);
	}

	public function count($field)  {
		if($field)
		return $this->db->single("SELECT count(" . $field . ")" . " FROM " . $this->table);
	}	
	public function countWhere($field,$cond)  {
		if($field)
		return $this->db->single("SELECT count(" . $field . ")" . " FROM " . $this->table. " WHERE $cond");
	}	
	public function maxWhere($field,$cond)  {
		if($field){
			$sql = "SELECT max(" . $field . ")" . " FROM " . $this->table. " WHERE $cond";
		}
		return $this->db->single($sql);
	}	

	public function lastInsertId()  {
		return $this->db->lastInsertId();
	}	
	
}
?>
