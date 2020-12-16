<?php
require_once('../Dbcon.php');
require_once('../Product.php');
if(isset($_POST['submit'])){
  $obj = new DbCon();
  $obj2 = new Product();
  $prodname = isset($_POST['prodname'])?$_POST['prodname']:'';
  $prodlink = isset($_POST['prodlink'])?$_POST['prodlink']:'';
  $obj2->newcategory($prodname,$prodlink,$obj->conn);
  
  
}
?>
<?php
require_once('../Dbcon.php');
require_once('../Product.php');
if(isset($_POST['edit'])){
  $obj = new DbCon();
  $obj2 = new Product();
  $eid=isset($_POST['id'])?$_POST['id']:'';
  $updatedname=isset($_POST['name'])?$_POST['name']:'';
  $prodhtml=isset($_POST['link'])?$_POST['link']:'';
  $avail=isset($_POST['avb'])?$_POST['avb']:'';
  $obj2->cat_edit($eid,$updatedname,$prodhtml,$avail,$obj->conn);
  
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <link rel="icon" href="assets/img/brand/favicon.png" type="image/png">
      <!-- Fonts -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
      <!-- Icons -->
      <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
      <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
      <!-- Page plugins -->
      <!-- Argon CSS -->
      <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
      <link href="../css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Category</title>
   
</head>
<body>
<div class="container" style="margin-left:230px;"><?php include 'header.php';?></div>

<div class="container" style="margin-left:240px;">
<center>
<h1>Add Category</h1>
<form method="POST">
    <div class="col">
        <label for="prod_parent">Main Category</label>
        <input type="text" class="form-control w-50" id="prod_parent" value="Hosting" readonly>
    </div>
    <div class="col">
        <label for="prodname" >Category Name</label>
        <input type="text" name="prodname" class="form-control w-50" id="prodname" >
    </div>
    <div class="col">
    <label for="prodname">Category Link</label>
      <input type="text"  name="prodlink" class="form-control w-50" id="prodname" >
    </div>
    
  
  <div class="col" style="margin-top:20px;">
      <input type="submit" name="submit" value="Add Category" style="background-color:#e7663f;border:1px solid black;color:honeydew; margin-top:10px;border-radius:10px;">
  </div> 
  </center> 
</form>


</body>
</html>

<script>

$(document).ready( function () {
    $('#myTable').DataTable();
} );

</script>

<?php
$confirm="onClick=\"javascript: return confirm('Please confirm deletion')\"";
$obj = new DbCon();
$obj2 = new Product();
$values=$obj2->cat_display($obj->conn);
$a= '<div class="container" ><table id="myTable"><thead><tr><th>Id</th><th>Parent-Id</th><th>Product-Name</th><th>Is-Avb</th><th>Date</th><th>Action</th></thead></tr><tbody><tr>';
foreach($values as $val){
$a.='<td>'.$val['id'].'</td>';
$a.='<td>'.$val['prod_parent_id'].'</td>';
$a.='<td>'.$val['prod_name'].'</td>';

$a.='<td>'.$val['prod_available'].'</td>';
$a.='<td>'.$val['prod_launch_date'].'</td>';
$a.='<td><a '.$confirm.' href="deletecategory.php?id='.$val['id'].'" class="btn btn-default btn-rounded mb-4 sa" id="deletebtn">Delete</a><a href="deletecategory.php?eid='.$val['id'].'" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm'.$val['id'].'">Edit</a></td></tr>';
$b='
<center><div class="modal fade" id="modalLoginForm'.$val['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header text-center">
<h4 class="modal-title w-100 font-weight-bold">Edit</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<form method="POST">
<div class="modal-body mx-3">
<div class="md-form mb-5">
<i class="fas fa-envelope prefix grey-text"></i>
<input type ="hidden" value="'.$val['id'].'" name="id" id="defaultForm-email" class="form-control validate id ml-4">

<label data-error="wrong" data-success="right" for="defaultForm-email">Id--'.$val['id'].'</label>
</div>
<div class="md-form mb-5">
<i class="fas fa-envelope prefix grey-text"></i>
<input type ="text" value="'.$val['prod_parent_id'].'" name="parent-id" id="defaultForm-email" class="form-control validate id ml-4>

<label data-error="wrong" data-success="right" for="defaultForm-email" readonly>parent-Id</label>
</div>

<div class="md-form mb-4">
<i class="fas fa-lock prefix grey-text"></i>
<input type ="text" value="'.$val['prod_name'].'" name="name" id="defaultForm-email" class="form-control validate id ml-4">
<label data-error="wrong" data-success="right" for="defaultForm-pass">Product-name-name</label>
</div>


<div class="md-form mb-4">
<i class="fas fa-lock prefix grey-text"></i>
<input type ="number"  name="avb" pattern="/^[01]$/" placeholder="Either 0(Not available) or 1(Available)" id="defaultForm-email" class="form-control validate id ml-4">
<label data-error="wrong" data-success="right" for="defaultForm-pass"> Product-Avaiblable</label>
</div>
</div>
<div class="modal-footer d-flex justify-content-center">
<input type ="Submit" name="edit" value="Edit" class="btn btn-default">
</div>
</form>
</div>
</div>
</div></center>';
echo $b;
}
$a.='</tbody></table></div>';
echo $a;

?>