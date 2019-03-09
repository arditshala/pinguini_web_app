<?php
class UserModel{
	
	private $username;
	private $password;
	private $user_ID;
	
	function __construct($username, $password, $user_ID)
	{
		$this->username = $username;
		$this->password = $password;
		$this->password = $user_ID;
	}
	
	function get_username()
	{
		return $this->username;
	}
	
	function get_password()
	{
		return $this->password;
	}
	
	function get_user_ID()
	{
		return $this->user_ID;
	}
	
	function set_username($username)
	{
		$this->username = $username;
	}
	
	function set_password($password)
	{
		$this->password = $password;
	}
	
	function set_user_ID($user_ID)
	{
		$this->user_ID = $user_ID;
	}
	
}
?>