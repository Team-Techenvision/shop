




<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{$page_title}}</h6>         
     <div id="add_order_form">  

          <form action="{{url('submit-cust-order')}}" method="post">
          @csrf
          <div class="d-flex justify-content-between mb-3">
            <div class="d-flex">
               <lable class="form-control text-right w-auto"> Shop Id :</lable>
               <?php  if(Auth::user()->shop_id != ""){ ?>             
               <input type="text" class="form-control text-center col-sm-4" name="shop_id"  value="<?php  echo Auth::user()->shop_id; ?>" readonly>
            <?php } ?>
            </div>
            <div class="d-flex">
              <lable class="form-control text-right w-auto" > Customer Id :</lable>
              <input type="text" class="form-control text-center col-sm-4" name="cust_id"  value="{{$u_id}}" readonly>
            </div>
          </div>
          <table class="form-table w-100" id="customFields">
            <tr valign="top" class="row addrows">
            <td class="col-sm-2">
                <div class="form-group">
                      <label class="control-label">BarCode</label>
                     <input type="text" class="form-control product_brcodes" name="product_brcode" >
                </div>
              </td>                
              <td class="col-sm-3">
                <div class="form-group">
                      <label class="control-label">Product</label>
                      <input type="text" class="form-control text-center product_name" name="product_name[]" readonly>
                      <input type="hidden" class="form-control text-center product_id" name="product_id[]" readonly>                       
                </div>
              </td>
              <td class="col-sm-1">
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
                  <input type="number" class="form-control text-center productqty" name="p_qty[]"  value="1" min="1" required>
                </div>
              </td>
              <td class="col-sm-2">
                <div class="form-group">
                  <label class="control-label">Amount</label>
                  <input type="text" class="form-control text-center amount" name="amt[]"  value="" readonly>
                </div>
              </td>
              <td class="col-sm-1">                  
                <a href="javascript:void(0);" id="addCF" class="btn btn-info mt-4">Add</a>
              </td>
            </tr>
          </table>          
          <div class="d-flex justify-content-end mr-3 mt-3">
            <input type="text" name="total" id="total" value="" class="form-control col-sm-2" readonly>
          </div>
          <div>
          <button type="button" class="btn btn-primary submit_btn" >Submit</button> 
          <!-- <input type="submit" name="Submit" class="btn btn-primary" > -->           
          </div>
          </form> 
        </div>
        <!-- ================================== -->
        <div class="any_message">  
              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          </div>   
          <!-- ==================================         -->
      </div> 
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
   
$(document).ready(function()
{

  $('.submit_btn').click(function(){
    $('.submit_btn').removeAttr("type").attr("type", "submit");
  });
 
// ====================================
    $("#addCF").click(function()
    {
        $("#customFields").append('<tr class="row addrows"><td class="col-sm-2 mt-3"><input type="text" class="form-control product_brcodes" name="product_brcode" ></td><td class="col-sm-3"> <input type="text" class="form-control text-center product_name" name="product_name[]" readonly><input type="hidden" class="form-control text-center product_id" name="product_id[]" readonly></td><td class="col-sm-1"><input type="text" class="form-control text-center product_price" name="p_price[]"  value="1" readonly></td><td class="col-sm-1"><input type="text" class="form-control text-center product_gst" name="gst[]" value="1" readonly></td><td class="col-sm-2"><input type="number" class="form-control text-center productqty" name="p_qty[]"  value="1" min="1" required></td><td class="col-sm-2"><input type="text" class="form-control text-center amount" name="amt[]"  value="" readonly></td> <td class="col-sm-1"> <a href="javascript:void(0);" class="remCF btn btn-danger">Remove</a></td></tr>');
        final_amount();
    });
  // =========================
    $("#customFields").on('click', '.remCF', function()
    {
        $(this).parent().parent().remove();
        final_amount();
    });
    

// ==========================================
  $('table').on("change", ".productqty", function(event)
  { 
        
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
        // $gst_amt = ($price * qtyvalue)/100 * 10;
        // $final_amt =$total + $gst_amt;
        $columns.find('.amount').val($total);       
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
  // $('table').on("change", ".product_id", function(event)
  // { 
        
  //         //alert( this.value );
  //           var p_value = this.value;
  //           var $row = jQuery(this).closest('tr');
  //           var $columns = $row.find('td');           
           
  //          // console.log($columns.addClass('product_price'));          
         
  //         if(p_value)
  //         {               
  //         $.ajax({
  //               type: "post",          
  //               url: "{{ url('product-detail') }}",
  //               dataType: "json",
  //               data: {"_token": "{{ csrf_token() }}",
  //                     "product": p_value},
  //               success : function(response){ 
  //                 var len = 0;

  //                // tr.find('.product_price').val(response["special_price"]);

  //                 if(response['data'] != null)
  //                 {
  //                   len = response['data'].length;
  //                   if(len > 0 )
  //                   {
  //                     for(var i = 0;i < len;i++)
  //                     {
                       
  //                      if(response['data'][i].special_price)
  //                      {
  //                         $columns.find('.product_price').val(response['data'][i].special_price);                         
  //                      }
  //                      else
  //                      {
  //                         $columns.find('.product_price').val(response['data'][i].price);                       
  //                      }
  //                      $columns.find('.product_gst').val(response['data'][i].gst_value_percentage);

  //                      $columns.find('.productqty').val(1);
                       

  //                           $price = $columns.find('.product_price').val();
  //                           $gst = $columns.find('.product_gst').val();
                             

  //                           $total = $price * 1;
  //                           // $gst_amt = ($price * 1)/100 * 10;
  //                           // $final_amt =$total + $gst_amt;                            
  //                           $columns.find('.amount').val($total);
  //                           final_amount();                             
  //                     }
  //                   }
  //                 }
  //               }
  //           });
  //         }
  //         else
  //         {
  //           $('tr,this,.product_price').val("");
  //           $('tr,this,.product_gst').val("");
  //         }
  // });        
// ======================================
$('table').on("keyup", ".product_brcodes", function(event)
  { 
  // $(".product_brcodes").focusout(function(){
    // alert($(this).val());
    $len = $(this).val().length;
    var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td'); 
    if($len >= 10 )
    {
      // alert($(this).val());
      $.ajax({
                type: "post",          
                url: "{{ url('br-product-detail') }}",
                dataType: "json",
                data: {"_token": "{{ csrf_token() }}",
                      "product": $(this).val()},
                success : function(response){ 
                  var len = 0;
                  // alert(response);
                  // console.log(response);
                 // tr.find('.product_price').val(response["special_price"]);

                  if(response['data'] != null)
                  {
                    len = response['data'].length;
                    if(len > 0 )
                    {
                      for(var i = 0;i < len;i++)
                      {
                       
                       if(response['data'][i].special_price)
                       {
                          $columns.find('.product_price').val(response['data'][i].special_price);                         
                       }
                       else
                       {
                          $columns.find('.product_price').val(response['data'][i].price);                       
                       }
                       $p_name  = "";
                       if(response['data'][i].size_name)
                       {
                        $p_name = response['data'][i].product_name + ' '+response['data'][i].size_name;
                       }
                       else
                       {
                          $p_name = response['data'][i].product_name;
                       }
                      //  $columns.find('.product_name').val(response['data'][i].product_name);
                      $columns.find('.product_name').val($p_name);
                       $columns.find('.product_id').val(response['data'][i].id);


                       $columns.find('.product_gst').val(response['data'][i].gst_value_percentage);

                       $columns.find('.productqty').val(1);
                       

                            $price = $columns.find('.product_price').val();
                            $gst = $columns.find('.product_gst').val();
                             

                            $total = $price * 1;
                            // $gst_amt = ($price * 1)/100 * 10;
                            // $final_amt =$total + $gst_amt;                            
                            $columns.find('.amount').val($total);
                            final_amount();                             
                      }
                    }
                  }
                }
            });
    }
  });
// ====================================
// ====================================
});
</script> 



