




<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{$page_title}}</h6>
        <form action="{{url('product-order')}}" method="post">
        @csrf
            <div class="row">
              <div class="col-sm-12">
                  <div class="form-group">
                    <label class="control-label">Product</label>
                    <select name="product_name" id="product_id" class="form-control rounded" required>
                    <option value="">Select Product</option>
                    @foreach($product as $row)
                      <option value="{{$row->products_id}}">{{$row->product_name}}</option>
                    @endforeach                   
                    </select>
                  </div>
              </div><!-- Col --> 
            </div>               
                <div class="row">
                  <div class="col-sm-4">                  
                    <div class="form-group">
                      <label class="control-label">Quantity</label>
                      <input type="number" class="form-control text-center" name="p_qty" id="productqty" value="1" min="1" required>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Expiry Date</label>
                      <input type="date" class="form-control" name="exp_date">
                    </div>
                  </div>                 
                </div>           
              <div class="row">
              <div class="col-sm-6">
                  <div class="form-group">
                  <button class="btn btn-primary mr-1" type="submit">Add Quantity</button>
                  <button class="btn btn-light" type="reset">Reset</button>
                  <div class="any_message mt-3">
                      @if (count($errors) > 0)
                        <div class = "alert alert-danger">
                            <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                            </ul>
                        </div>
                      @endif                   
                    @if(session()->has('alert-danger'))
                      <div class="alert alert-danger">
                          {{ session()->get('alert-danger') }}
                      </div>
                    @endif
                    @if(session()->has('alert-success'))
                      <div class="alert alert-success">
                          {{ session()->get('alert-success') }}
                      </div>
                    @endif
                  </div> 
              </div><!-- Col --> 
            </div> 
          </form>            
      </div>
    </div>
  </div>
</div>

