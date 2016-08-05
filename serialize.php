<?php

$array = array(
		'session_name' 	=> '123',
		'member_id' 	=> '234',
		'group_type' 	=> '345',
);

$aaa = serialize($array);
$bbb = json_encode($array);
echo $aaa;
echo '<br>';
echo $bbb;