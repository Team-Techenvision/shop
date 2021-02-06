




<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{$page_title}}</h6>
      <form action="{{url('add-cust-order') }}" method="post"> 
      @csrf
      shop id :
          <input type="text" class="form-control text-center col-sm-2 ml-1" name="shop_id"  value="101" readonly>
        <div class="row">        
          <div class="col-sm-2 text-right">                           
            <div class="form-group p-2">             
            <label for="contact">Contact No :</label>                      
            </div>
          </div>
          <div class="col-sm-4">                           
            <div class="form-group">             
              <input type="text" class="form-control" name="customer_no"  id="customer_no" minlength="10" maxlength="10" placeholder="Contact No" required>               
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

    </div>
  </div>
</div>

         
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script>
      $(document).ready(function()
      {
        $('.any_message').fadeOut(5500);
      });
         
      </script>  




