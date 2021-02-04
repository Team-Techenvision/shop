




<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{$page_title}}</h6>         
     <div id="add_order_form">  

          <form action="{{url('submit-cust-order')}}" metho="post">
          @csrf
          <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">GST</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Amount</th>
                    <th scope="col"><a href="javascript:void(0);" id="addCF" class="btn btn-info mt-4">Add1</a></th>
                    </tr>
                </thead>
                <tbody class="invoice-iteam">
                    <!-- <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    </tr>
                    <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    </tr>
                    <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    </tr> -->
                </tbody>
            </table>
          </form> 
        </div>           
      </div> 
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
   
    $(document).ready(function(){

    $("#addCF").click(function()
    {
        $.ajax({
                type: "post",          
                url: "{{ url('new-product-detail') }}",
                dataType: "json",                
                success : function(response){ 
                 
                }
            });
         
    });
    
    $("#customFields").on('click', '.remCF', function()
    {
        $(this).parent().parent().remove();
    });
    
});

$('#customFields').on("keyup", ".productqty", function(event){ 
        
        var value = this.value;
       // alert(value)
       if(value < 1 || !$.isNumeric(value))
       { this.value = "";       
         this.value = 1;
       }
       total(this.value); 
    });
    function total( amt)
    {
      var tot = $('#total').val();
      if (tot == null)
      {
        tot = 0;
      }
      var total = tot + amt;
      $('#total').val(total);

    }
    $('.addrows').on("change", ".product_id", function(event){ 
        // $('.product_id').on('change', function() 
        // {
          //alert( this.value );
            var p_value = this.value;
          alert(p_value);
           
          //var tr = $(this).parent().parent();
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
                       // $this.parents('tr').prev('.product_price').val(response['data'][i].price);
                       if(response['data'][i].special_price)
                       {
                         $(this).find('.product_price').val(response['data'][i].special_price);
                         //tr.find(".product_price").val(response['data'][i].special_price);
                        //$('tr,this,.product_price').val(response['data'][i].special_price);
                        //$('tr,this').find('.product_price').val(response['data'][i].special_price);
                       }
                       else{
                       // tr.find(".product_price").val(response['data'][i].price);
                         // $('tr,this,.product_price').val(response['data'][i].price);
                         // $('tr,this').find('.product_price').val(response['data'][i].price);
                          $(this).find('.product_price').val(response['data'][i].price);
                       }
                      // tr.find(".product_gst").val(response['data'][i].gst_value_percentage);
                      // $('tr,this,.product_gst').val(response['data'][i].gst_value_percentage);
                      $(this).find('.product_price').val(response['data'][i].gst_value_percentage);
                     //  $('tr,this').find('.product_gst').val(response['data'][i].gst_value_percentage);
                      //  console.log(response['data'][i].price);
                      //  console.log(response['data'][i].special_price);
                      //  console.log(response['data'][i].gst_value_percentage);
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

        });
</script> 



