<?php

Class DbCon{
	public $siteurl = "http://localhost/Training/CedHosting/";
	public $dbhost = "localhost";
	public $dbuser = "root";
	public $dbpass = "";
	public $dbname = "CedHosting";

function __construct(){
	// Create connection


	$this->conn = new mysqli("localhost","root", "", "CedHosting");

	

}
}
?>	

