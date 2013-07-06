<?php
class users {
	function details($uname){
		$users = array (
			"jack" => array("last_login"=>"29/03/2013","login_times"=>20),
			"harry" => array("last_login"=>"28/03/2013","login_times"=>2),
			"jim" => array("last_login"=>"27/03/2013","login_times"=>10),
			"jasmin" => array("last_login"=>"26/03/2013","login_times"=>3),
			"jonny" => array("last_login"=>"25/03/2013","login_times"=>5),
			"albin" => array("last_login"=>"24/03/2013","login_times"=>9),
			"antony" => array("last_login"=>"24/03/2013","login_times"=>7)
		);

		if($uname && array_key_exists($uname,$users)){
			echo json_encode($users[$uname]);
		} else {
			echo json_encode('No data found');
		}
	}
}
$usr = htmlentities(trim($_POST['user_name']));
if($usr){
	$usrObj = new users();
	$usrObj->details(strtolower($usr));
} else {
	echo json_encode("Invalid input");
}
?>