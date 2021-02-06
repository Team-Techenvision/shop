<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Print Barcode</h6>
        <form action="{{url('print-barcode')}}" method="post">
        @csrf
            <div class="row">
              <div class="col-sm-12">
              <div class="form-group">
                      <label class="control-label">Enter Quantity</label>
                      <input type="number" class="form-control" name="quantity" value="" required>
                      <input type="text" class="" name="barcode" value="{{$barcode}}">
                    </div>
                    <button type="submit">Submit</button>
              </div><!-- Col --> 
            </div>               
                      
              
          </form>            
      </div>
    </div>
  </div>
</div>