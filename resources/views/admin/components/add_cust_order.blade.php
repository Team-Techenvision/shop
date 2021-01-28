




<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{$page_title}}</h6>         
     <div id="add_order_form">
        <!-- <form action="#" method="post">
        @csrf
            <div class="row">
              <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Product</label>
                    <select name="product_name" id="product" class="form-control rounded product_id" required>
                    @foreach($product as $row)
                      <option value="{{$row->products_id}}">{{$row->product_name}}</option>
                    @endforeach                   
                    </select>
                  </div>
                </div>
                <div class="col-sm-2">                  
                    <div class="form-group">
                      <label class="control-label">Price</label>
                      <input type="lable" class="form-control text-center" name="p_qty" id="product_price" value="1" readonly>
                    </div>
                </div>
                <div class="col-sm-2">                  
                    <div class="form-group">
                      <label class="control-label">GST</label>
                      <input type="lable" class="form-control text-center" name="p_qty" id="product_gst" value="1" readonly>
                    </div>
                </div>
                <div class="col-sm-2">                  
                    <div class="form-group">
                      <label class="control-label">Quantity</label>
                      <input type="number" class="form-control text-center" name="p_qty" id="productqty" value="1" required>
                    </div>
                </div>
                <div class="col-sm-2 m-auto pt-4">                  
                    <div class="form-group">                      
                      <button class="btn btn-success mr-1" id="add_more">&#x2B;</button>
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                  <button class="btn btn-primary mr-1" type="submit">Submit Order</button>
                  <! -- <button class="btn btn-light" type="reset">Reset</button> - ->
                  @if (count($errors) > 0)
                    <div class = "alert alert-danger">
                        <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                    </div>
                  @endif
                </div><! -- Col - -> 
            </div>
          </form> -->

          <form>
          @csrf
          <table class="form-table w-100" id="customFields">
            <tr valign="top" class="row">              
              <td class="col-sm-4">
                <div class="form-group">
                      <label class="control-label">Product</label>
                    <select name="product_name" id="product" class="form-control rounded product_id" required>
                      @foreach($product as $row)
                        <option value="{{$row->products_id}}">{{$row->product_name}}</option>
                      @endforeach                   
                    </select>
                </div>
              </td>
              <td class="col-sm-2">
                <div class="form-group">
                      <label class="control-label">Price</label>
                      <input type="lable" class="form-control text-center" name="p_qty" id="product_price" value="1" readonly>
                </div>
              </td>
              <td class="col-sm-2">                              
                <div class="form-group">
                  <label class="control-label">GST</label>
                  <input type="lable" class="form-control text-center" name="p_qty" id="product_gst" value="1" readonly>
                </div>              
              </td>
              <td class="col-sm-2">
                <div class="form-group">
                  <label class="control-label">Quantity</label>
                  <input type="number" class="form-control text-center" name="p_qty" id="productqty" value="1" required>
                </div>
              </td>
              <td class="col-sm-2">  
                <!-- <input type="text" class="code" name="customFieldName[]" value="" placeholder="Input Name" /> &nbsp;
                <input type="text" class="code" name="customFieldValue[]" value="" placeholder="Input Value" /> &nbsp; -->
                <a href="javascript:void(0);" id="addCF" class="btn btn-info mt-4">Add</a>
              </td>
            </tr>
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
        $("#customFields").append('<tr class="row"><td class="col-sm-4"> <select name="product_name" id="product" class="form-control rounded product_id">@foreach($product as $row)<option value="{{$row->products_id}}">{{$row->product_name}}</option>@endforeach</select></td><td class="col-sm-2"><input type="lable" class="form-control text-center" name="p_qty" id="product_price" value="1" readonly></td><td class="col-sm-2"><input type="lable" class="form-control text-center" name="p_qty" id="product_gst" value="1" readonly></td><td class="col-sm-2"><input type="number" class="form-control text-center" name="p_qty" id="productqty" value="1" required></td> <td class="col-sm-2"> <a href="javascript:void(0);" class="remCF btn btn-danger">Remove</a></td></tr>');
    });
    
    $("#customFields").on('click', '.remCF', function()
    {
        $(this).parent().parent().remove();
    });
    
});
        $('.product_id').on('change', function() 
        {
          //alert( this.value );
            var p_value = this.value;
          alert(p_value);  
                
          $.ajax({
                type: "post",          
                url: "{{ url('product-detail') }}",
                dataType: "json",
                data: {"_token": "{{ csrf_token() }}",
                      "product": p_value},
                success : function(data,status){
                  
                 // $('#product_price').val(price);
                  //$('#product_gst').val(gst);
                  //var arr = JSON.stringify(data);
                  //alert(arr[4]);
                  //alert(data);
                  //$('#product_price').val($.each(data.price));
                  //$('#product_gst').val(data.gst);
                     console.log(data);
                    // console.log(data)
                  // window.location.reload(true);
                }
            });

        });
</script> 



