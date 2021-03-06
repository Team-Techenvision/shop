
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{$page_title}}</h6>        
        <!-- <form action="{{url('check-expiry')}}" method="post">
        @csrf 
              <div class="row m-auto">
                <div class="col-sm-8">
                  <div class="form-group text-right">
                    <label class="control-label mr-1 mt-2 h4">Check</label>
                    <select name="Exp_date" id="Exp_date" class="form-control rounded w-50 float-right" required>
                      <option value="">Select Day</option>                   
                      <option value="5">5 Day</option>
                      <option value="15">15 Day</option>
                      <option value="30">1 Month</option>
                      <option value="60">2 Month</option>
                      <option value="180">6 Month</option>
                    </select>                   
                  </div>                         
                </div><! -- Col - ->
              <div  class="col-sm-4 text-left"> 
              <! -- <button type="submit" name="search" class="btn btn-info mt-4">Search</button>            - ->
                <input type="submit" name="search" value="search" class="btn btn-info" >
              </div>  
            </div>
        </form> -->
        <div class="d-flex">
        <label class="bg-danger btn"  data-toggle="tooltip" title="Less Than 10 Quantity!">10 Quantity</label><label  class="btn bg-warning"  data-toggle="tooltip" title="Less Than 50 Quantity!">50 Quantity</label>
        <a class="btn btn-success m-auto" href="{{url('export')}}">Export In Excel</a>
        </div>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
          <thead>     
              <tr>
                <th>Sr. No.</th>
                <!-- <th>Barcode</th>   -->
                <th>Product Name</th>
                <!-- <th>Expiry Date</th>                   -->
                <th>Available Quantity</th>               
              </tr>
            </thead>
            <tbody> 
            @php 
              $count = 1;  

              @endphp 
              @foreach($product as $r)
              <?php
                if($r->avl_quantity <= 10)
                { ?>
                  <tr class="bg-danger"> 
          <?php }
             elseif($r->avl_quantity <= 50)
             { ?>
               <tr class="bg-warning"> 
              <?php }
                else
                { ?>
                  <tr> 
          <?php } ?>
            <td> {{$count++}} </td> 
            <td>{{$r->product_name}} ({{$r->size_name}})</td> 
            <?php if($r->avl_quantity) { ?>                  
            <td>{{$r->avl_quantity}}</td> 
            <?php } else { ?> 
                <td>00</td> <?php } ?>
            </tr>

            @endforeach
            </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>