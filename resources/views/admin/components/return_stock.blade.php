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
      <form action="{{url('search-product-barcode') }}" method="post"> 
      @csrf    
        <div class="row">        
          <div class="col-sm-2 text-right">                           
            <div class="form-group p-2">             
            <label for="contact">Barcode :-</label>                      
            </div>
          </div>
          <div class="col-sm-4">                           
            <div class="form-group">             
              <input type="text" class="form-control" name="barcode"  id="barcode" minlength="4" maxlength="15" placeholder="Barcode" required>               
            </div>
          </div>
          <div class="col-sm-4">                  
            <div class="form-group"> 
            <input type="submit" id="add_customer"  class="btn btn-primary" value="Submit" > 
              <!-- <button name="submit"  id="add_customer" onclick="add_customer()" class="btn btn-primary">Submit</button>              -->
            </div>
          </div>       
      </div>
    </form> 

    
    @if(count($stock) > 0)

    <form action="{{url('return-product-submit') }}" method="post">
    @csrf  
        <div class="row mt-5">
                <div class="col-sm-4">                  
                    <div class="form-group">
                      <label class="control-label">Product Name</label>
                      <!-- < ?php print_r($stock);die(); ?> -->
                       @if(!$stock[0]->size_name)
                      <input type="text" class="form-control text-center" name="product_name" value="{{$stock[0]->product_name}}" id="product_name" readonly>
                       @else                      
                          <input type="text" class="form-control text-center" name="product_name" value="{{$stock[0]->product_name}} ({{$stock[0]->size_name}})" id="product_name" readonly>
                       @endif
                    </div>
                  </div>

                  <div class="col-sm-4">                  
                    <div class="form-group">
                      <label class="control-label">Available Quantity</label>                      
                      <input type="text" class="form-control text-center" name="avl_quantity" value="{{$stock[0]->avl_quantity}}" id="avl_quantity" readonly>
                    </div>
                  </div>
                  <div class="col-sm-4">                  
                    <div class="form-group">
                      <label class="control-label">Return Quantity</label>
                      <input type="number" class="form-control text-center" name="return_quantity" id="return_quantity" value="1" min="1" required>
                    </div>
                  </div>
            </div>

            <input type="hidden" name="id" value="{{$stock[0]->id}}">
            <?php $shop_id = Auth::user()->shop_id; ?>
            <input type="hidden" name="shop_id" value="{{$shop_id}}">
            <input type="hidden" name="products_id" value="{{$stock[0]->products_id}}">
            
            <div class="row">
              <div class="col-sm-6">
                  <div class="form-group">
                  <button class="btn btn-primary mr-1" type="submit">Return Quantity</button>
                  </div>
                </div>
            </div>        
    </form>

    @endif

  <div class="any_message mt-3">  
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

    </div>
  </div>
</div>




