




<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{$page_title}}</h6>         
     <div id="add_order_form">  

          <form action="{{url('submit-cust-order')}}" method="post">
          @csrf
          <div class="d-flex justify-content-between">
          <div class="d-block">
          shop id :
          <input type="text" class="form-control text-center col-sm-4" name="shop_id"  value="101" readonly>
         </div>
         <div class="d-block">
          customer id:
          <input type="text" class="form-control text-center col-sm-4" name="cust_id"  value="{{$u_id}}" readonly>
          </div>
           </div>
          <table class="form-table w-100" id="customFields">
            <tr valign="top" class="row addrows">              
              <td class="col-sm-3">
                <div class="form-group">
                      <label class="control-label">Product</label>
                    <select name="product_name[]" class="form-control rounded product_id" required>
                    <option value="">Select Order</option>
                      @foreach($product as $row)
                        <option value="{{$row->products_id}}">{{$row->product_name}}</option>
                      @endforeach                   
                    </select>
                </div>
              </td>
              <td class="col-sm-2">
                <div class="form-group">
                      <label class="control-label">Price</label>
                      <input type="text" class="form-control text-center product_price" name="p_price[]"  value="1" readonly>
                </div>
              </td>
              <td class="col-sm-1">                              
                <div class="form-group">
                  <label class="control-label">GST %</label>
                  <input type="text" class="form-control text-center product_gst" name="gst[]"  value="1" readonly>
                </div>              
              </td>
              <td class="col-sm-2">
                <div class="form-group">
                  <label class="control-label">Quantity</label>
                  <input type="number" class="form-control text-center productqty" name="p_qty[]"  value="1" required>
                </div>
              </td>
              <td class="col-sm-2">
                <div class="form-group">
                  <label class="control-label">Amount</label>
                  <input type="text" class="form-control text-center amount" name="amt[]"  value="" readonly>
                </div>
              </td>
              <td class="col-sm-2">  
                <!-- <input type="text" class="code" name="customFieldName[]" value="" placeholder="Input Name" /> &nbsp;
                <input type="text" class="code" name="customFieldValue[]" value="" placeholder="Input Value" /> &nbsp; -->
                <a href="javascript:void(0);" id="addCF" class="btn btn-info mt-4">Add</a>
              </td>
            </tr>
          </table>          
          <div class="d-flex justify-content-end mr-3">
          <input type="text" name="total" id="total" value="" class="form-control col-sm-2" readonly>
          </div>
          <div>
          <button class="btn btn-primary" >Submit</button> 
          <!-- <input type="submit" name="Submit" class="btn btn-primary" > -->
           
          </div>
          </form> 
        </div>           
      </div> 
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
   
    $(document).ready(function(){
// ====================================
    $("#addCF").click(function()
    {
        $("#customFields").append('<tr class="row addrows"><td class="col-sm-3"> <select name="product_name[]" class="form-control rounded product_id"> <option value="">Select Order</option>@foreach($product as $row)<option value="{{$row->products_id}}">{{$row->product_name}}</option>@endforeach</select></td><td class="col-sm-2"><input type="text" class="form-control text-center product_price" name="p_price[]"  value="1" readonly></td><td class="col-sm-1"><input type="text" class="form-control text-center product_gst" name="gst[]" value="1" readonly></td><td class="col-sm-2"><input type="number" class="form-control text-center productqty" name="p_qty[]"  value="1" required></td><td class="col-sm-2"><input type="text" class="form-control text-center amount" name="amt[]"  value="" readonly></td> <td class="col-sm-2"> <a href="javascript:void(0);" class="remCF btn btn-danger">Remove</a></td></tr>');
        final_amount();
    });
  // =========================
    $("#customFields").on('click', '.remCF', function()
    {
        $(this).parent().parent().remove();
        final_amount();
    });
    
});
// ==========================================
$('table').on("change", ".productqty", function(event){ 
        
        var qtyvalue = this.value;
        //alert(qtyvalue);
        var $row = jQuery(this).closest('tr');
        var $columns = $row.find('td');
       if(qtyvalue < 1 || !$.isNumeric(qtyvalue))
       {         
         this.qtyvalue="";       
         this.qtyvalue=1;
       }
        var $row = jQuery(this).closest('tr');
        var $columns = $row.find('td');
        $price = $columns.find('.product_price').val();
        $gst = $columns.find('.product_gst').val();

        $total = $price * qtyvalue;
        $gst_amt = ($price * qtyvalue)/100 * 10;
        $final_amt =$total + $gst_amt;
        $columns.find('.amount').val($final_amt);       
        final_amount();
        //total($final_amt);
    });
    // ==================================     

    function final_amount()
    {
        var $row = jQuery(this).closest('tr');
        var $columns = $row.find('td');

        var sum=0;
        $('.amount').each(function(i, obj)
        {
          if($.isNumeric(this.value)) 
          {
              sum += parseFloat(this.value);
          }

        })
        $('#total').val(sum.toFixed(2)); 
    }
    // ============================================
    $('table').on("change", ".product_id", function(event){ 
        
          //alert( this.value );
            var p_value = this.value;
            var $row = jQuery(this).closest('tr');
            var $columns = $row.find('td');           
           
           // console.log($columns.addClass('product_price'));       
         
         
          if(p_value)
          {               
          $.ajax({
                type: "post",          
                url: "{{ url('product-detail') }}",
                dataType: "json",
                data: {"_token": "{{ csrf_token() }}",
                      "product": p_value},
                success : function(response){ 
                  var len = 0;

                 // tr.find('.product_price').val(response["special_price"]);

                  if(response['data'] != null)
                  {
                    len = response['data'].length;
                    if(len > 0 )
                    {
                      for(var i = 0;i < len;i++){
                       
                       if(response['data'][i].special_price)
                       {
                        $columns.find('.product_price').val(response['data'][i].special_price);
                         
                        //var amt = (response['data'][i].special_price * 1)/100 * 10;
                        //$columns.find('.amount').val(response['data'][i].special_price * 1);
                        //$columns.find('.amount').val(response['data'][i].special_price-amt);
                       }
                       else{
                        $columns.find('.product_price').val(response['data'][i].price);
                       
                         //var amt = (response['data'][i].special_price * 1)/100 * 10;
                        // $columns.find('.amount').val(response['data'][i].special_price * 1);
                        // $columns.find('.amount').val(response['data'][i].special_price-amt);
                       }
                       $columns.find('.product_gst').val(response['data'][i].gst_value_percentage);
                       

                            $price = $columns.find('.product_price').val();
                            $gst = $columns.find('.product_gst').val();
                             

                            $total = $price * 1;
                            $gst_amt = ($price * 1)/100 * 10;
                            $final_amt =$total + $gst_amt;                            
                            $columns.find('.amount').val($final_amt);

                            final_amount(); 
                            //total($final_amt);
                            //total_amount();
                     // console.log($columns.find('.product_gst').val());
                      //   console.log(response['data'][i].gst_value_percentage);
                      }
                    }
                  }
                }
            });
          }
          else
          {
           // tr.find(".product_price").val();
            //tr.find(".product_gst").val();
           
            $('tr,this,.product_price').val("");
            $('tr,this,.product_gst').val("");
          }
// ======================================
// ====================================
// ====================================
        });
</script> 



