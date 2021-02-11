<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<style>
		.table{
			border-collapse: collapse;
			font-family: arial;
		} 
		.table td, th {
		  border: 1px solid #dddddd;
		  text-align: left;
		  padding: 2px;
		  font-family: arial;
		}
		.table th {
		  background-color: #eee; 
		  color: black;
		  font-family: arial;
		}
	</style>
</head>
<body>
<table style="width: 100%; border: none !important;">
	<tr style="width: 100%;">
		<td style="width: 100%;">
			<table style="width: 100%;">
				<tr style="width: 100%;">
					<td style="width: 30%; text-align: left;">
						<img src="{{asset('images/DHD-Logo.png')}}" alt="Dr. Helpdesk"  class="img-fluid" style="height: 150px;">
					</td>
                <td style="width: 10%; text-align: right;"></td>
					<td style="width: 50%; text-align: right;">
						<table style="width: 100%;">
							<tr style="width: 100%;">
								<td style="font-size: 22px; margin-bottom: 0px; width: 100%; font-weight: 700;">Tax Invoice/Bill of Supply/Cash Memo</td>
							</tr>
							<tr style="width: 100%;">
								<td style="margin-top: 5px; font-size: 18px; font-weight: 100; width: 100%;">AENSA Health Solutions Private Limited</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	 
	<tr style="width: 100%;">
		<td style="width: 100%;">
			<table style="width: 100%;">
				<tr style="width: 100%;">
					<td  style="width: 50%;">
						<table style="width: 100%;">
                        <tr style="width: 100%;">
								<td style="width: 100%; margin-top: 0px; margin-bottom: 0px; font-size: 22px; text-align: left;">Invoice Number:<span style="font-weight: 100; font-size: 14px;">{{$orderDetails->order_id}}</span></td>
							</tr>
						</table>
					</td>
					<td  style="width: 50%;">
						<table style="width: 100%;">
							
							<?php 
			                	$dt = new DateTime($orderDetails->created_at);
		                        $tz = new DateTimeZone('Asia/Kolkata'); // or whatever zone you're after

		                        $dt->setTimezone($tz);
		                        $start_date = $dt->format("d-m-Y H:i:s");   
			                    $ex = explode(" ",$orderDetails->created_at)
			                ?>
							<tr style="width: 100%;">
								<td style="width: 100%; margin-top: 0px; margin-bottom: 0px; font-size: 22px; text-align: right;">Invoice Date:<span style="font-weight: 100; font-size: 14px;">{{$start_date}}</span></td>
							</tr> 
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr style="width: 100%;">
		<td style="width: 100%;">
			@if(count($order)>0)
			<table style="width: 100%;" class="table">  
				<tr>
					<td style="border: 1px solid black;text-align: center;">Sr.No.</td> 
			 		<!-- <td style="border: 1px solid black;">Order Id</td>
					<td style="border: 1px solid black;">Sub Order Id</td> -->
					<td style="border: 1px solid black;text-align: center;" colspan="4">Product Name</td>
					<td style="border: 1px solid black;text-align: center;">Quantity</td>
					<td style="border: 1px solid black;text-align: center;">Amount</td>
					<td style="border: 1px solid black;text-align: center;">GST</td>
					<td style="border: 1px solid black;text-align: center;">Total Amount</td> 
				</tr> 
				<?php
					$f = 0;
					$copoun1= 0;
					$count = 1;
				?> 				
				 @foreach($order as $row)					
					<tr>
						<td style="border: 1px solid black;text-align: center;">{{$count++}}</td>	 
						 
						<td style="border:1px solid black;" colspan="4">{{$row->product_name}} </td> <!--<br> Sub Order Id : {{$row-> sub_order_id}}  -->
						<td style="border: 1px solid black;text-align: center;">{{$row->quantity}}</td> 
						<td style="border: 1px solid black;text-align: center;">Rs {{$row->sub_total}}</td>  
						<td style="border: 1px solid black;text-align: center;">{{$row->gst_value_percentage}}</td> 
						<td style="border: 1px solid black;text-align: center;">{{(($row->sub_total * $row->quantity)/100 * $row->gst_value_percentage) + ($row->sub_total * $row->quantity)}}</td> 
					</tr>
				@endforeach 				
				<tr>
					<td colspan="8" style="font-weight: 700; color: black;">TOTAL AMOUNT:</td>
					<td style=" background-color: #eee;;text-align: center;">Rs {{$orderDetails->amount}}</td> 
				</tr> 
				<tr style="width: 100%;">
					<td colspan="9" style="font-weight: 700; color: black; text-align: right; ">For Aensa Health Solutions Private Limited:<br> <br> <img src="{{asset('images/invoice-signature.jpeg')}}" style="width: 100px; border: 1px solid black;"> <br>Authorized Signatory
					</td>
				</tr>
            	<tr style="width: 100%;">
					<td colspan="9" style="font-weight: 700; color: black; text-align: center; ">All prices inclusive of GST as per Applicable Rate.
					</td>
				</tr>
            
			</table>
			@else
	            No Record found
			@endif
		</td>
	</tr>
</table>
<script type="text/javascript">
      window.onload = function() { window.print(); }
 </script>
</body>
</html>