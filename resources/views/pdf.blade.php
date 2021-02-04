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
						<img src="" alt="Dr. Helpdesk"  class="img-fluid" style="height: 150px;">
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
					<td style="width: 50%;">						 
					</td>
					<td style="width: 50%; vertical-align: text-top;">						 
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
								<td style="width: 100%; margin-top: 0px; margin-bottom: 0px; font-size: 22px; text-align: right;">Order Number:<span style="font-weight: 100; font-size: 14px;">order_id</span></td>
							</tr>
							
							<tr style="width: 100%;">
								<td style="width: 100%; margin-top: 0px; margin-bottom: 0px; font-size: 22px; text-align: right;">Order Date:<span style="font-weight: 100; font-size: 14px;">Date</span></td>
							</tr> 
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr style="width: 100%;">
		<td style="width: 100%;">			
			<table style="width: 100%;" class="table">  
				<tr>
					<td style="border: 1px solid black;">Sr.No.</td> 
			 		<!-- <td style="border: 1px solid black;">Order Id</td>
					<td style="border: 1px solid black;">Sub Order Id</td> -->
					<td style="border: 1px solid black;width:200px;" colspan="4">Product Name</td>
					<td style="border: 1px solid black;width:100px;">Quantity</td>
					<td style="border: 1px solid black;width:100px;">Amount</td>
					<td style="border: 1px solid black;width:100px;">Extra Discount</td>
					<td style="border: 1px solid black;width:100px;">Total Amount</td> 
				</tr>
					<tr>
						<td style="border: 1px solid black;">1</td>	 
						 
						<td style="border:1px solid black;" colspan="4">Product Name</td> 
						<td style="border: 1px solid black;">10</td> 
						<td style="border: 1px solid black;">100</td>  
						<td style="border: 1px solid black;">10%						
						</td> 
						<td style="border: 1px solid black;">900</td> 
					</tr>
                    <tr>
						<td style="border: 1px solid black;">1</td>
						<td style="border:1px solid black;" colspan="4">Product Name</td> 
						<td style="border: 1px solid black;">10</td> 
						<td style="border: 1px solid black;">100</td>  
						<td style="border: 1px solid black;">10%						
						</td> 
						<td style="border: 1px solid black;">900</td> 
					</tr>
				 
				<tr>
					<td colspan="8" style="font-weight: 700; color: black;">SUB TOTAL:</td>
					<td style=" background-color: #eee;">Rs f</td> 
				</tr>
				<tr>
					<td colspan="8" style="font-weight: 700; color: black;">COUPON AMOUNT:</td>
				 
						<td style=" background-color: #eee;">Rs copoun1 = amount</td> 
						 
						<td style=" background-color: #eee;">Rs copoun1 = f * amount/100 </td>
						 
					<td style=" background-color: #eee;">Rs 0</td> 
					 
				</tr>
				<tr>
					<td colspan="8" style="font-weight: 700; color: black;">DEWALLET AMOUNT:</td>
					 
					<td style=" background-color: #eee;">Rs de_wallet_coin  * 0.25</td> 
			 
					<td style=" background-color: #eee;">Rs 0</td> 
					 
				</tr>
				<tr>
					<td colspan="8" style="font-weight: 700; color: black;">SHIPPING CHARGES:</td>
					 
					<td style=" background-color: #eee;">Rs shipping_charge</td> 
			 
					<td style=" background-color: #eee;">Rs 0</td> 
				 
				</tr>
			 
				<tr>
					<td colspan="8" style="font-weight: 700; color: black;">TOTAL AMOUNT:</td>
					<td style=" background-color: #eee;">Rs 90.00 </td> 
				</tr> 
				<tr style="width: 100%;">
					<td colspan="9" style="font-weight: 700; color: black; text-align: right; ">For Aensa Health Solutions Private Limited:<br> <br> <img src="" style="width: 100px; border: 1px solid black;"> <br>Authorized Signatory
					</td>
				</tr>
            	<tr style="width: 100%;">
					<td colspan="9" style="font-weight: 700; color: black; text-align: center; ">All prices inclusive of GST as per Applicable Rate.
					</td>
				</tr>
            
			</table>
		 
		</td>
	</tr>
</table>
</body>
</html>