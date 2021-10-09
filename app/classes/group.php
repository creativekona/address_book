<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH . '/database.php');

class Group extends DatabaseObject {
	
	protected static $table_name="all_groups";
	protected static $db_fields = array('id', 'group_name', 'parent_group_id', 'created_at');
	
	public $id;
	public $group_name;
	public $parent_group_id;
	public $created_at;
	
	public static function find_all() {
		return self::find_by_sql("SELECT * FROM ".self::$table_name."");
	}

	public static function find_by_id($id=0) {
		$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE id={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	public static function find_by_parent($parent_id=0){
		return self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE parent_group_id={$parent_id}");
	}
	
	public static function find_by_sql($sql="") {
		global $database;
		$result_set = $database->query($sql);
		$object_array = array();
		while ($row = $database->fetch_array($result_set)) {
			$object_array[] = self::instantiate($row);
		}
		return $object_array;
	}
	
	private static function instantiate($record) {
    $object = new self;
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}
	
	private function has_attribute($attribute) {
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() { 
		// return an array of attribute names and their values
		$attributes = array();
		foreach(self::$db_fields as $field) {
			if(property_exists($this, $field)) {
			$attributes[$field] = $this->$field;
			}
		}
		return $attributes;
	}
	
	protected function sanitized_attributes() {
		global $database;
		$clean_attributes = array();
		// sanitize the values before submitting
		// Note: does not alter the actual value of each attribute
		foreach($this->attributes() as $key => $value){
		  $clean_attributes[$key] = $database->escape_value($value);
		}
		return $clean_attributes;
	}
	  
	
	public function create() {
		global $database;
		$attributes = $this->sanitized_attributes();
	  	$sql = "INSERT INTO ".self::$table_name." (";
		$sql .= join(", ", array_keys($attributes));
	  	$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
	  	if($database->query($sql)) {
			$this->id = $database->insert_id();
			return true;
		} else {
			return false;
		}
	}
	
	public function update() {
		global $database;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
			$attribute_pairs[] = "{$key}='{$value}'";
		}
		$a = join(", ", $attribute_pairs);
		$sql = "UPDATE ".self::$table_name." SET ".$a." WHERE id='".$database->escape_value($this->id)."'";
		$database -> query($sql);
		return ($database -> affected_rows() == 1) ? true : false;
	  }

}

?>