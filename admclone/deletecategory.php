<?php
require_once '../Dbcon.php';
require_once '../Product.php';
$obj= new DbCon();
$obj2 = new Product();
if(isset($_GET['id'])){
    $get=$_GET['id'];
    $obj2->cat_delete($get,$obj->conn);
}
if(isset($_GET['proddel'])){
    $get=$_GET['proddel'];
    $obj2->prod_delete($get,$obj->conn);
}
?>
