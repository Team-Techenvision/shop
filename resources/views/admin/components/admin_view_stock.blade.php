
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{$page_title}}</h6>
        <!-- <p class="card-description">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p> -->
        <!-- <form action="{{url('check-expiry')}}" method="post">
        @csrf 
              <div class="row m-auto">
                <div class="col-sm-8  text-right">
                  <div class="form-group">
                    <label class="control-label">Filter</label>
                    <select name="Exp_date" id="Exp_date" class="form-control rounded" required>
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
              <! -- <button type="submit" name="search" class="btn btn-info mt-4">Search</button>            -- >
                <input type="submit" name="search" value="search" class="btn btn-info mt-4" >
              </div>  
            </div>
        </form> -->
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
          <thead>     
              <tr>
                <th>Sr. No.</th> 
                <th>Product Name</th> 
                <th>Quantity</th>
                <th>Available Quantity</th>  
                <th>Expiry Date</th>    
                <th>Print Barcode</th>             
              </tr>
            </thead>
            <tbody> 
            @php 
              $count = 1;  
           
              @endphp 

              @foreach($product as $r)
              
            <tr> 
            <td> {{$count++}} </td>
            @if($r->size_name!="Main")
            <td>{{$r->product_name}} ({{$r->size_name}})</td>
            @else
              <td>{{$r->product_name}}</td>
            @endif           
            <td>{{round($r->input_quantity,2)}} (@if($r->per_stript_qty){{round(($r->input_quantity /$r->per_stript_qty),2)}}@else{{round(($r->input_quantity /1),2)}} @endif)</td>
            <td>{{round($r->avl_quantity,2)}} (@if($r->per_stript_qty){{round(($r->avl_quantity /$r->per_stript_qty),2)}}@else{{round(($r->avl_quantity /1),2)}} @endif)</td>
            <td>{{$r->expiry_date}}</td> 
           <?php  $no = strlen($r->barcode);
                if($no ==10)
                { ?>
                  <td> <a href="{{url('generate-barcode/'.$r->barcode)}}"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> </a> </td>
              <?  }else{ ?> <td></td> <?php  } ?>
               
            <!-- <td> <a href="{{url('generate-barcode/'.$r->barcode)}}"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> </a> </td>    -->
            </tr>

            @endforeach
            </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>