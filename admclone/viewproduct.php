<?php 

require_once('../Product.php');
require_once('../Dbcon.php');
$obj= new DbCon();
$obj2=new Product();
?>
<?php 
if(isset($_POST['submitt'])){
  $id=isset($_POST['id'])?$_POST['id']:'';
  $parentid=isset($_POST['drop'])?$_POST['drop']:'';
  $parent=isset($_POST['parent-id'])?$_POST['parent-id']:'';
  $name=isset($_POST['name'])?$_POST['name']:'';
  $url=isset($_POST['url'])?$_POST['url']:'';
  $avb=isset($_POST['avb'])?$_POST['avb']:'';
  $mprice=isset($_POST['mprice'])?$_POST['mprice']:'';
  $aprice=isset($_POST['aprice'])?$_POST['aprice']:'';
  $sku=isset($_POST['sku'])?$_POST['sku']:'';
  $web_space=isset($_POST['web_space'])?$_POST['web_space']:'';
  $band=isset($_POST['band'])?$_POST['band']:'';
  $free=isset($_POST['free'])?$_POST['free']:'';
  $lang=isset($_POST['lang'])?$_POST['lang']:'';
  $mail=isset($_POST['mail'])?$_POST['mail']:'';
  $obj2->update_prod($id,$parentid,$parent,$name,$url,$avb,$obj->conn);
  $discription = array("Webspace"=>$web_space,
               "Bandwidth"=>$band, 
               "FreeDomain"=>$free, 
               "Mailbox"=>$mail, 
               "TechnologySupported"=>$lang);
              
   $Desc= json_encode($discription);
  
   $obj2->update_desc($id,$Desc,$mprice,$aprice,$sku,$obj->conn);
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
    <title>View Product</title>
   
</head>
<body>
<div class="container" style="margin-left:230px;"><?php include 'header.php';?></div>

</body>
<script>

$(document).ready( function () {
    $('#myTable').DataTable();
} );

</script>
<?php 
          
          require_once('../Product.php');
          require_once('../Dbcon.php');
          $obj= new DbCon();
          $obj2=new Product();
          $back=$obj2->cat_list($obj->conn);
         $a1=' <div id="cid_3" class="form-input-wide jf-required" data-layout="half"> <i class="fas fa-envelope prefix grey-text"></i>
         <select class="form-dropdown validate[required]" id="input_3" name="drop" style="width:310px" data-component="dropdown"  aria-labelledby="label_3"><option value=""> Please Select </option>';
          foreach($back as $val){
            $a1.=' <option value="'.$val['id'].'"> '.$val['prod_name'].'</option>';
          }
          $a1.='</select> <label data-error="wrong" data-success="right" for="defaultForm-email">Parent-Name</label> </div>';
      
          ?>
<?php
$back=$obj2->prod_list($obj->conn);
echo '<center><h3>View Product List</h3></center>';
$a='<div class="table-responsive"><table id="myTable" style="margin-left:250px;"><thead><tr><th>Product-Parent-id</th><th>Product-Name</th><th>Product-Launch-Date</th><th>Monthly-Price</th><th>Yearly-Price</th><th>Sku</th><th>Web-Space</th><th>Band-Width</th><th>Free-Domain</th><th>Mail-box</th><th>L/T-Support</th><th>Action</th></tr></thead><tbody><tr>';
foreach($back as $val){
  $val3='';
    $checkid=$val['prod_parent_id'];
    $back2=$obj2->prod_name($checkid,$obj->conn);

    foreach((array)$back2 as $val2){
        $val3=$val2['prod_name'];
    }
    $confirm="onClick=\"javascript: return confirm('Please confirm deletion')\"";
    $abc=json_decode($val['description'], true);
    $a.='<td>'.$val['prod_parent_id'].'</td>';
    $a.='<td>'.$val['prod_name'].'</td>';
    $a.='<td>'.$val['prod_launch_date'].'</td>';
    $a.='<td>$'.$val['mon_price'].'</td>';
    $a.='<td>$'.$val['annual_price'].'</td>';
    $a.='<td>'.$val['sku'].'</td>';
    $a.='<td>'.$abc['Webspace'].' GB</td>';
    $a.='<td>'.$abc['Bandwidth'].' GB</td>';
    $a.='<td>'.$abc['FreeDomain'].'</td>';
    $a.='<td>'.$abc['Mailbox'].'</td>';
    $a.='<td>'.$abc['TechnologySupported'].'</td>';
    $a.='<td><a '.$confirm.' href="deletecategory.php?proddel='.$val['prod_id'].'" class="btn btn-default btn-rounded mb-4 sa">Delete</a><a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm'.$val['prod_id'].'">Edit</a></td></tr>';
    $b='
    <div class="modal fade" id="modalLoginForm'.$val['prod_id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
          <input type ="hidden" value="'.$val['prod_id'].'" name="id" id="defaultForm-email" class="form-control validate id ml-4" readonly >
       
          <label data-error="wrong" data-success="right" for="defaultForm-email">Product-Id=='.$val['prod_id'].'</label>                                                                                                                                                                                                       
        </div>
        <div class="md-form mb-5">
        <i class="fas fa-envelope prefix grey-text"></i>
        <input type ="hidden" value="'.$val3.'" name="pname" id="defaultForm-email" class="form-control validate id ml-4" readonly >
     
        <label data-error="wrong" data-success="right" for="defaultForm-email">Parent-Name=='.$val3.'</label>                                                                                                                                                                                                                                                                                                                                                                                                  
      </div>
     
      '.$a1.'
     
       <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input type ="hidden" value="'.$val['prod_parent_id'].'" name="parent-id" id="defaultForm-email" class="form-control validate id ml-4 >
       
          <label data-error="wrong" data-success="right" for="defaultForm-email">Product-Parent-Id=='.$val['prod_parent_id'].'</label>
        </div>
        <div class="md-form mb-5">
        <i class="fas fa-envelope prefix grey-text"></i>
        <input type ="text" value="'.$val['prod_name'].'" name="name" id="defaultForm-email" class="form-control validate id ml-4" >
     
        <label data-error="wrong" data-success="right" for="defaultForm-email">Product-Name</label>                                                                                                                                                                                                                                                                                                                                                                                                  
      </div>

        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type ="text" value="'.$abc['Webspace'].'" name="web_space"  id="defaultForm-email" class="form-control validate id ml-4">
          <label data-error="wrong" data-success="right" for="defaultForm-pass">Web-space</label>
        </div>
        <div class="md-form mb-4">
        <i class="fas fa-lock prefix grey-text"></i>
        <input type ="text" value="'.$abc['Bandwidth'].'" name="band"  id="defaultForm-email" class="form-control validate id ml-4">
        <label data-error="wrong" data-success="right" for="defaultForm-pass">Band-width</label>
      </div>
      <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type ="text" value="'.$abc['FreeDomain'].'" name="free"  id="defaultForm-email" class="form-control validate id ml-4">
          <label data-error="wrong" data-success="right" for="defaultForm-pass">Free-Domain</label>
        </div>
        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type ="text" value="'.$abc['Mailbox'].'" name="mail"  id="defaultForm-email" class="form-control validate id ml-4">
          <label data-error="wrong" data-success="right" for="defaultForm-pass">Mail</label>
        </div>
        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type ="text" value="'.$abc['TechnologySupported'].'" name="lang"  id="defaultForm-email" class="form-control validate id ml-4">
          <label data-error="wrong" data-success="right" for="defaultForm-pass">L/T Support</label>
        </div>
        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type ="text" value="'.$val['mon_price'].'" name="mprice"  id="defaultForm-email" class="form-control validate id ml-4">
          <label data-error="wrong" data-success="right" for="defaultForm-pass">Monthly Price</label>
        </div>
        <div class="md-form mb-4">
        <i class="fas fa-lock prefix grey-text"></i>
        <input type ="text" value="'.$val['annual_price'].'" name="aprice"  id="defaultForm-email" class="form-control validate id ml-4">
        <label data-error="wrong" data-success="right" for="defaultForm-pass">Yearly-Price</label>
      </div>
      <div class="md-form mb-4">
      <i class="fas fa-lock prefix grey-text"></i>
      <input type ="text" value="'.$val['sku'].'" name="sku"  id="defaultForm-email" class="form-control validate id ml-4">
      <label data-error="wrong" data-success="right" for="defaultForm-pass">Sku</label>
    </div>
    <div class="md-form mb-4">
    <i class="fas fa-lock prefix grey-text"></i>
    <input type ="text" value="'.$val['html'].'" name="url"  id="defaultForm-email" class="form-control validate id ml-4">
    <label data-error="wrong" data-success="right" for="defaultForm-pass">Html</label>
  </div>
  <div class="md-form mb-4">
  <i class="fas fa-lock prefix grey-text"></i>
  <input type ="text" value="'.$val['prod_available'].'" name="avb"  id="defaultForm-email" class="form-control validate id ml-4">
  <label data-error="wrong" data-success="right" for="defaultForm-pass">Product-Available</label>
</div>
</div>
      <div class="modal-footer d-flex justify-content-center">
      <input type ="Submit" name="submitt" class="btn btn-default">
      </div>
      </form>
    </div>
  </div>
</div>';
    echo $b;
}
$a.='</tbody></table></div>';
echo $a;
?>
