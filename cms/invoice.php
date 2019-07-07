<?php
require_once('../incDB/session.php');
if($_SESSION['userinfo'] == false) header ('Location:../index.php');

if($_SERVER['REQUEST_METHOD'] != 'POST'){
	die( 'Request faild, please try agin' );
}
?>
<div class="col-lg-11">
  
  <style>
  .back-inv{
		font-weight:bold;
	}
</style>

<table id="sm-table" class="table table-hover">
<thead class=""><!--<thead class="hidden">-->
    <tr>
        <th style="text-align: -webkit-left;">Mobile</th>
        <th style="text-align: -webkit-left;">Product</th>
        <th style="text-align: -webkit-left;">Date</th>
        <th style="text-align: -webkit-left;">Total Amt.</th>
        <th style="text-align: -webkit-left;">System Machine</th>
    </tr>
</thead>

<?php
require_once('../incDB/invoiceAPI.php');

$qry_inv = invoice_get();
$invJson = json_decode($qry_inv, true);

foreach($invJson as $pInv){
	$getProdDet = invoice_detail_get_by_id($pInv['ID']);
	$invDetJson = json_decode($getProdDet, true);
	$invDetStr = '';
	$cnt = 0;
	foreach($invDetJson as $pDetInv){
		
		if($cnt > 0 && $cnt != count($invDetJson)) $invDetStr = $invDetStr.' / ' ;
		$invDetStr = $invDetStr.$pDetInv['prodName'] ;
		$cnt ++;
	}
	
?>
  
    <tr class="">
    <td class="col-lg-2">
		<a data-toggle="tab" href="#ord" id="<?php echo $pInv['ID'] ;?>" class="inv-row" style="display: block;width: 100%; text-decoration:none; color:#000;">
		  <?php echo '0'.$pInv['MOBILE'] ;?>
	    </a>
    </td>
	<td class="col-lg-3">
		<a data-toggle="tab" href="#ord" id="<?php echo $pInv['ID'] ;?>" class="inv-row" style="display: block;width: 100%; text-decoration:none; color:#000;">
		  <?php echo substr($invDetStr,0,20).'...' ;?>
	    </a>
    </td>
    <td  class="col-lg-2" style="text-align: -webkit-left;">
		<a data-toggle="tab" href="#ord" id="<?php echo $pInv['ID'] ;?>" class="inv-row" style="display: block;width: 100%; text-decoration:none; color:#000;">
		  <?php echo $pInv['DATE'] ;?>
	    </a>
    </td>
    <td class="col-lg-2" style="text-align: -webkit-center;">
		<a data-toggle="tab" href="#ord" id="<?php echo $pInv['ID'] ;?>" class="inv-row" style="display: block;width: 100%; text-decoration:none; color:#000;">
		  <?php echo $pInv['TOTAL'].' SR' ;?>
	    </a>
    </td>
    
    <td class="col-lg-2" style="text-align: -webkit-center;">
		<a data-toggle="tab" href="#ord" id="<?php echo $pInv['ID'] ;?>" class="inv-row" style="display: block;width: 100%; text-decoration:none; color:#000;">
		  <?php echo $pInv['sName'] ;?>
	    </a>
    </td>
      
  </tr>                                              
    <?php 
  } // end foreach loop
?>
</table>
	
<script>


  var table = $('#sm-table').dataTable({
					"pageLength":12
		});
		
		$('#searchBox').keyup(function() {
		   table.fnFilter(this.value);
		});
 
 
 // This code for open invoice detail on click row
$(document).on('click','.inv-row',function(){
    var id_ord = $(this).attr("id");
    $.ajax({
        url:'row_inv_detail.php',
        type:'POST',
        data:'id='+id_ord,
        success:function(data){
            if(data != ''){
                $(".nav-in li.active").removeClass("active");
                $('.tab-content').children().remove();
                 $('.tab-content').append( "<div id='aja_content'></div>" );
                 $('#aja_content').html(data);
            }else{
                $('.tab-content').load('href');
            }
        }
    });
    
    return false;
});
// End invice Detail


	
</script>

  
</div>