<?php
require_once('../incDB/session.php');
if($_SESSION['userinfo'] == false) header ('Location:../index.php');

if($_SERVER['REQUEST_METHOD'] != 'POST'){
	die( 'Request faild, please try agin' );
}

if(!isset($_POST['id'])){
	die("you dont have access");
}

require_once('../incDB/invoiceAPI.php');

$qry_inv = invoice_get_by_id($_POST['id']);
$invDetJson = json_decode($qry_inv, true);

foreach($invDetJson as $pInvDet){
?>

<style>
  .back-inv{
		font-weight:bold;
	}
</style>
<div class="col-lg-11">

<table id="product-item-detail-table1" class="table table-bordered">
<!-- <thead class="hidden"> -->
	<tr>
        <td colspan="2" align="center">
			<div>
                <b>System Machine Name: </b><span> <?php echo $pInvDet['sName'] ;?> </span>
             </div>
             <div>
                <b>User Mobile: </b><span> <?php echo '0'.$pInvDet['MOBILE'] ;?> </span>
             </div>
			 <div>
                <b>Invoice Date: </b><span> <?php echo $pInvDet['DATE'] ;?> </span>
             </div>
		</td>
		
    

	<tr>
       <td colspan="2" align="center">
		 
    


<table class="table table-hover">
<thead class="thead-dark">
    <tr>
        <th style="text-align:-webkit-left;">Name</th>
        <th style="text-align:-webkit-left;">Quantity</th>
        <th style="text-align:-webkit-left;">Price</th>
        <th style="text-align:-webkit-left;">Total</th>
    </tr>
</thead>
  
<?php
require_once('../incDB/db.php');
$statment_product_item = mysqli_query($mp_handle, "SELECT * FROM `inv_detail` WHERE `InvID` = ".$_POST['id']);
    if(!$statment_product_item) die('qyr');
    $total_rows = mysqli_num_rows($statment_product_item);
            
if($total_rows > 0 ){
	while($rowInv = mysqli_fetch_assoc($statment_product_item)){
		$order_id = $rowInv["itemID"];
		$qty = intval($rowInv["qty"]);
		$price = floatval($rowInv["price"]);
		$tot = $qty * $price ;
		echo '<tr class="">';
		echo '
			<td class="col-lg-4">
				'.$rowInv["prodName"].'
			</td>
			<td  class="col-lg-2" style="text-align: -webkit-left;">
			  '.$rowInv["qty"].'
			</td>
			<td class="col-lg-3" style="text-align: -webkit-left;">
			  '.$rowInv["price"].'
			</td>
			<td  class="col-lg-3" style="text-align: -webkit-left;">
			  '.$tot.'
			
		  </tr>
		  ';
	}
}
                            
?>
</table>

</td>
</tr>
<td colspan="2" align="right">
	<div>
		<b style="color:red;">Total Amount: </b><span> <?php echo $pInvDet['TOTAL'].' SR' ;?></span>
	 </div>
</td>
</tr>
</table>
</div>
	
<?php
}
?>