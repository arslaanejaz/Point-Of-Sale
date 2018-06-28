@extends('layouts.master')

@section('content')

    <h1>Transaction Print</h1>
    <?php 
if ($recipt) {
	?>
	
	<div class="right" id="section-to-print">
 <table>
 <tbody>
 <tr><td><img src="<?php echo url('/resources/assets/image/510.png')?>" style="width:1in;margin:0 auto"/></td></tr>
 <tr><td style="font-size: 12px;"> Chaudhary Traders</td></tr>
 <tr><td style="font-size: 12px;"> 143-B, Sector C, Commercial Area,</td></tr>
 <tr><td style="font-size: 12px;"> Bahria Town</td></tr>
 <tr><td style="font-size: 12px;"> Lahore</td></tr>
 <tr><td style="font-size: 12px;"> 042-37862661</td></tr>
 </tbody>
 </table>
<table style="border:1px solid #000;width:25%">
<tr><td><?php echo date('Y-m-d');?></td> <td><?php echo date('h:i:a');?></td> <td>ID: <?php echo $r_id?> </td></tr>
</table>
 
<table style="font-size: 12px;border:1px solid #000">
<tr><td>Itme Name</td><td>Qty</td> <td>Price</td></tr>
<tr style="height: 10px"></tr>
<?php
 $i = 0;
$itm_nbr =0;
$totl_price = 0;
foreach($recipt as $row)
{   $itm_nbr +=$row['qty'];
    $totl_price +=$row['amount'];
	echo '<tr><td>';
	echo $row['name'];
	echo '</td><td>'. $row['qty'].'</td><td align="right"">'. $row['amount'].'</td></tr>';
     $i++;
	}
 ?>
</table> 
 
 <table style="border 1px solid" >
 <tr><td>Total Items: <?php echo $itm_nbr;?></td></tr>
 </table>
 <table style="border 1px solid" >
 <tr> <td> Total Price: <?php echo $totl_price;?></td></tr>
 <tr><td>Discount :</td><td align="right">{{ $urldata['discount'] }}</td></tr>
  <tr><td>Pay :</td><td align="right">{{ $urldata['pay'] }}</td></tr>
  <tr><td>Change :</td><td align="right">{{ $urldata['change'] }}</td></tr>

 </table>
 
 </div>
 <script>$(document).ready(function(){
	 window.print();
	 })</script>
<?php }?>

@endsection
