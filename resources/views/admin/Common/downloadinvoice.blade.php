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
	<!-- <tr style="width: 100%;">
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
	</tr> -->


	<tr style="width: 100%;">
		<td style="width: 100%;">
			<table style="width: 100%;">
				<tr style="width: 100%;">
				<td style="width: 50%; text-align: left;">
						<table style="width: 100%;">
							<tr style="width: 100%;">
								<td style="font-size: 22px; margin-bottom: 0px; width: 100%; font-weight: 600;"> Tax Invoice</td>
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
			<table style="width: 100%; border-top: 4px dotted #000;">
				<tr style="width: 100%;">
					<td  style="width: 50%;">
						<table style="width: 100%;">
                        <tr style="width: 100%;">
								<td style="width: 100%; margin-top: 0px; margin-bottom: 0px; font-size: 14px; text-align: left; font-weight: 600; "> Invoice Number : <span style="font-weight: 600; font-size: 14px; padding-left:15px;">{{$orderDetails->order_id}}</span></td>
							</tr>
						</table>
					</td>
					<td  style="width: 50%;">
						<table style="width: 100%;">					
							<tr style="width: 100%;">
							<td style="width: 100%; margin-top: 0px; margin-bottom: 0px; font-size: 14px; text-align: left; font-weight: 600; "> Invoice Date : <span style="font-weight: 600; font-size: 14px; padding-left:15px;"><?php echo date("Y/m/d"); ?></span></td>
							</tr> 
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>

	 
	<tr style="width: 100%;">
		<td style="width: 100%;">
			<table style="width: 100%; border-bottom: 4px dotted #000;">
				<tr style="width: 100%;">
					<td  style="width: 50%;">
						<table style="width: 100%;">
						<tr style="width: 100%;">
								<td style="width: 100%; margin-top: 0px; margin-bottom: 0px; font-size: 14px; text-align: left; font-weight: 600; ">GST Number : <span style="font-weight: 600; font-size: 14px; padding-left:15px;">29ABJFA4579J1ZU</span></td>
							</tr>                       
						</table>
					</td>
					<!-- <td  style="width: 50%;">
						<table style="width: 100%;">						
						<tr style="width: 100%;">
							<td style="width: 100%; margin-top: 0px; margin-bottom: 0px; font-size: 14px; text-align: left; font-weight: 600; "> Invoice Date : <span style="font-weight: 600; font-size: 14px; padding-left:15px;"><?php echo date("Y/m/d"); ?></span></td>
							</tr> 
						</table>
					</td> -->
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
				<tr style="width: 100%;">
					<td colspan="8" style="font-weight: 400; color: black; text-align: left; font-size:14px;">CGST
					</td>
					<td style="text-align: center;  font-size:14px;">Rs 150.00</td> 
				</tr>
			
				<tr style="width: 100%;">
					<td colspan="8" style="font-weight: 400; color: black; text-align: left; font-size:14px;">SGST
					</td>
					<td style="text-align: center;  font-size:14px;">Rs 150.00</td> 
				</tr>

				<tr style="width: 100%;">
					<td colspan="8" style="font-weight: 400; color: black; text-align: left; font-size:14px;">IGST
					</td>
					<td style="text-align: center;  font-size:14px;">Rs 300.00</td> 
				</tr>
				<tr style="width: 100%;">
					<td colspan="8" style="font-weight: 400; color: black; text-align: left; font-size:14px;">Total Discount
					</td>
					<td style="text-align: center;  font-size:14px;">Rs 100.00</td> 
				</tr>

				<tr style="">
					<td colspan="8" style="font-weight: 700; color: black;  padding-top:10px; padding-bottom:10px;">TOTAL AMOUNT:</td>
					<td style=" background-color: #eee; text-align: center; padding-top:10px; padding-bottom:10px;">Rs {{$orderDetails->amount}}</td> 
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