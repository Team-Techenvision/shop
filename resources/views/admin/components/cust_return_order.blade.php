
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{$page_title}}</h6>
        <div class="any_message mt-2">
          @if(session()->has('message_success'))
            <div class="alert alert-success">
                {{ session()->get('message_success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          @if(session()->has('message'))
            <div class="alert alert-danger">
                {{ session()->get('message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
        </div>
      <form action="{{url('cust-resturn-order-id') }}" method="post"> 
      @csrf    
        <div class="row">        
          <div class="col-sm-2 text-right">                           
            <div class="form-group p-2">             
            <label for="contact">Order Id :-</label>                      
            </div>
          </div>
          <div class="col-sm-4">                           
            <div class="form-group">             
              <input type="text" class="form-control" name="order_id"  id="order_id" placeholder="Customer Order Id" required>               
            </div>
          </div>
          <div class="col-sm-4">                  
            <div class="form-group"> 
            <input type="submit" id="add_customer"  class="btn btn-primary" value="Submit" > 
             
            </div>
          </div>       
      </div>
    </form> 
         
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
          <thead>     
              <tr>
                <!-- <th>Sr. No.</th>  -->              
                <th>Order ID</th>
                <th>Price</th>  
                <th>Customer No.</th> 
                <th>order Date</th>
                <th>Employee</th>    
                <th>Action</th>             
              </tr>
            </thead>
            <tbody> 
           <!-- < ?php  dd($cust_order1); ?> -->
            <?php  if($cust_order1==1) { ?>
            <tr>            
                <th class="cust_order_id"><span><?php echo $cust_order->order_id; ?></span</th>
                <th><?php echo $cust_order->amount; ?></th> 
                <th><?php echo $cust_order->phone; ?></th>   
                <th><?php echo $cust_order->created_at; ?></th>                  
                <th><?php echo $cust_order->name; ?></th> 
                <td><a href="{{url('download-invoice/'.$cust_order->order_id)}}" class="btn btn-info" target="_blank">View Bill</a>
                <!-- <a href="#" class="btn btn-warning ml-2">Return</a> -->
                <!-- <button type="button" class="btn btn-warning ml-2" data-toggle="modal" data-target=".bd-example-modal-lg"></button> -->
                <button type="button" class="btn btn-warning ml-2 cust_prod_return" data-toggle="modal" data-target="#myModal">Return</button>
                </td>
            </tr>
            <?php } ?>    
            </tbody>
                    </table>
<!-- ================================================= -->
 <!-- Modal -->
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">         
          <h4 class="modal-title">Customer Return Stock</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <!-- <p>This is a large modal.</p> -->
          <form action="{{url('cust-resturn-product') }}" method="post">
          <!-- <form action="{{url('br-return-cust-order') }}" method="post"> -->

            @csrf 
            <div class="row m-auto">        
              <div class="w-auto text-right">                           
                <div class="form-group">             
                  <label for="contact">Order Id :-</label>                      
                </div>
              </div>
              <div class="col-sm-3">                           
                <div class="form-group">             
                  <input type="text" class="form-control p_order_id" name="p_order_id" readonly>
                </div>
              </div>
              <div class="w-auto text-right">                           
                <div class="form-group p-2">             
                  <label for="contact">Product Barcode:-</label>                      
                </div>
              </div>
              <div class="col-sm-4">                           
                <div class="form-group">             
                  <input type="text" class="form-control p_barcode" name="p_barcode" placeholder="Product BarCode" required>
                </div>
              </div>
              <div class="w-auto">                  
                <div class="form-group"> 
                  <input type="button" id="check_brcode_product"  class="btn btn-primary" value="Check" >                  
                </div>
              </div>
              <div class="return_data_body">
                  <div class="d-flex">
                    <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Product Name</label>
                      <input type="text" class="form-control Product_Name" name="Product_Name" readonly>
                      <input type="text" class="d-none p_attr_id" name="p_attr_id" readonly>
                </div>
                    </div> 
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Price</label>
                        <input type="text" class="form-control Price" name="Price" readonly>
                      </div>
                    </div> 
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Quantity</label>
                        <input type="number" class="form-control quantity" min="1" name="Quantity" readonly>
                      </div>
                    </div> 
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Return Quantity</label>
                        <input type="text" class="form-control Return_Qty" min="1" name="Return_Qty" required>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group pt-1">                        
                        <input type="submit" class="btn btn-danger mt-4" value="Return Order" id="btn_return">
                      </div>
                    </div>  
                  </div>
              </div>       
            </div>         
          </form>
        </div>
        <div class="modal-footer">
        <div class="alert alert-danger model_error_sms m-auto text-center w-75" role="alert" style="display:none;">
        
        </div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- ============================================ -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <style>
          #dataTableExample_length, #dataTableExample_filter{
              display:none;
          }
          </style>

          <!-- <script>
            // $('table').on("keyup", ".product_brcodes", function(event)
            $('#check_brcode_product').click(function()
            {
              alert($(".p_barcode").val());
            });

  { 
  // $(".p_barcode").focusout(function(){
    // alert($(this).val());
    $len = $(this).val().length;
    var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td'); 
    if($len >= 10 )
    {
      // alert($(this).val());
      $.ajax({
                type: "post",          
                url: "{{ url('br-return-cust-order') }}",
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
                          // $columns.find('.product_price').val(response['data'][i].special_price);
                          $columns.find('.product_price').val(response['data'][i].price_per_pic);                         

                       }
                       else
                       {
                          // $columns.find('.product_price').val(response['data'][i].price); 
                          $columns.find('.product_price').val(response['data'][i].price_per_pic);                       

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
                            $columns.find('.amount').val($total.toFixed(3));
                            final_amount();                             
                      }
                    }
                  }
                }
            });
    }
  });
          </script> -->