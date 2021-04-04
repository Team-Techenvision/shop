
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
                <th class="cust_order_id"><?php echo $cust_order->order_id; ?></th>
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
          <form>
              <div class="row m-auto">        
                <div class="w-auto text-right">                           
                  <div class="form-group">             
                    <label for="contact">Order Id :-</label>                      
                  </div>
                </div>
                <div class="col-sm-3">                           
                  <div class="form-group">             
                  <input type="text" class="form-control" name="order_id" readonly>
                  </div>
                </div>
                <div class="w-auto text-right">                           
                  <div class="form-group p-2">             
                  <label for="contact">Product Barcode:-</label>                      
                  </div>
                </div>
                <div class="col-sm-4">                           
                  <div class="form-group">             
                  <input type="text" class="form-control" name="p_barcode">
                  </div>
                </div>
                <div class="w-auto">                  
                  <div class="form-group"> 
                  <input type="submit" id="add_customer"  class="btn btn-primary" value="Check" >                  
                </div>
              </div>       
            </div>         
          </form>
        </div>
        <div class="modal-footer">
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