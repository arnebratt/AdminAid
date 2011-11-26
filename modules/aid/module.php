<?php

$Module = array( 'name' => 'AdminAid' );

$ViewList = array();
// Administrator user switching
$ViewList['user_switch'] = array( 'script' => 'user_switch.php', 'functions' => array( 'user_switch' ), 'params' => array( 'user_id' ) );
$ViewList['object_list'] = array( 'script' => 'object_list.php', 'functions' => array( 'object_view' ), 'params' => array( 'class_id', 'limit' ), 'unordered_params' => array( 'offset' => 'offset' ) );
$ViewList['object_view'] = array( 'script' => 'object_view.php', 'functions' => array( 'object_view' ), 'params' => array( 'object_id' ) );
$ViewList['class_translation'] = array( 'script' => 'class_translation.php', 'functions' => array( 'class_translate' ), 'params' => array( 'class_id' ), 'unordered_params' => array( 'from' => 'from_attribute_id', 'to' => 'to_attribute_id' ), 'default_navigation_part' => 'ezsetupnavigationpart' );
$ViewList['class_attribute_select'] = array( 'script' => 'class_attribute_select.php', 'functions' => array( 'class_translate' ), 'params' => array( 'class_id', 'to_attribute_id' ), 'default_navigation_part' => 'ezsetupnavigationpart' );
$ViewList['search'] = array( 'script' => 'search.php', 'functions' => array( 'search' ) );

// Access permission functions
$FunctionList = array();
$FunctionList['user_switch'] = array();
$FunctionList['object_view'] = array();
$FunctionList['class_translate'] = array();
$FunctionList['search'] = array();

?>
