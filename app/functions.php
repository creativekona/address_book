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

?>