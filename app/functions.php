<?php

function is_blank_single($val){
  if($val=="undefined" || $val=="")
  {
    return true;
  }
}

function my_autoloader($class) {
    if(is_readable(LIB_PATH .'/classes/' . strtolower($class).'.php')){
		include LIB_PATH .'/classes/' . strtolower($class).'.php';	
	}
}

spl_autoload_register('my_autoloader');

function export_to_xml(SimpleXMLElement $object, array $data){   
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $new_object = $object->addChild($key);
            export_to_xml($new_object, $value);
        } else {
            if ($key != 0 && $key == (int) $key) {
                $key = "key_$key";
            }

            $object->addChild($key, $value);
        }   
    }   
} 

function isHasChilds($group_id = 0){
    $groups = Group::find_by_parent($group_id);
    return count($groups);    
}  

// adding (-) "dash" to select option so it will mark as child and parent group
function getRlational($group_id = 0, $group_parent){        
    $opts_add = '';
    global $dashes;
    $groups = Group::find_by_parent($group_id);
    foreach ($groups as $group):
        $opts_add .= "<option value='".$group->id."' ". ( isset($group_parent) && $group_parent == $group->id ? 'selected' : '' ) .">" . $dashes . $group->group_name."</option>";    
        if(isHasChilds($group->id) > 0){
            $dashes .= '-';
            $opts_add .= getRlational($group->id, $group_parent);
        }
    endforeach;
    if(strlen($dashes) > 0){
        $dashes = substr($dashes, 1);
    }
    return $opts_add;
}

// it will check if a child group assigned to address
function check_child($key, $groups){
    $child_groups = Group::find_by_parent($key);
    foreach($child_groups as $child_group){
        if(array_key_exists($child_group -> id, $groups)){
            return true;
        }else{
            $is_child = check_child($child_group -> id, $groups);
            if ($is_child){
                return true;
            }
        }
    }
}

// if child group if assigned then remove parent group
function filter_groups($groups){    
    $groups = array_flip($groups);       
    foreach($groups as $key => $group){
        // get child group of it
        $group = $group;
        $is_parent = check_child($key, $groups);
        if($is_parent){
            unset($groups[$key]);
        }    
    }
    $groups = array_flip($groups);
    return $groups;
}

function fetch_relational_address($group_id){
    $realtions =  Group_address_relation::find_by_group($group_id); 
    return $realtions; 
}

function get_child_group($group_id){
    global $relatinal_address;
    $child_groups = Group::find_by_parent($group_id);
    foreach($child_groups as $child_group){
        $child_relatinal_addres = fetch_relational_address($child_group -> id);        
        foreach($child_relatinal_addres as $address){
            array_push($relatinal_address, $address);
        }
        get_child_group($child_group -> id);
    }
}

function get_rlational_address($group_id){
    global $relatinal_address;
    $relatinal_address = array();
    get_child_group($group_id);
    $new_array = array();
    foreach($relatinal_address as $relatinal){
        array_push($new_array, $relatinal -> address_id);
    }
    $new_array = array_flip($new_array);
    $new_array = array_flip($new_array);
    return $new_array;
}

?>