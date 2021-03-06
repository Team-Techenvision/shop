

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{$page_title}}</h6>
        <!-- <p class="card-description">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p> -->
        
              <div class="row pb-4">
                <div class="col-sm-6">
                  <form action="{{url('form-to-expiry')}}" method="post">
                    @csrf                 
                    <div class="d-flex">
                    <label class="control-label mr-1 mt-2 h5">Form </label>
                    <input type="text" name="f_date" class="form-control" id="form_date" placeholder="Form Date" required>
                    <label class="control-label ml-2 mt-2 h5">To </label>
                    <input type="text" name="t_date" class="form-control" id="to_date" placeholder="To Date" required>
                    <input type="submit" name="search" value="Search" class="btn btn-outline-primary ml-2" >
                    </div>                 
                  </form>
                </div>   
                <!-- ============================================================= -->
                <div class="col-sm-6 m-auto">
                  <form action="{{url('check-expiry2')}}" method="post">
                  @csrf             
                    <div class="d-flex float-right">
                      <label class="control-label mr-1 mt-2 h5">Check </label>
                      <select name="Exp_date" id="Exp_date" class="form-control w-50 rounded mr-2" required>
                        <option value="">Select Day</option>                   
                        <!-- <option value="5">5 Day</option> -->
                        <option value="15">15 Day</option>
                        <option value="30">1 Month</option>
                        <option value="60">2 Month</option>
                        <option value="90">3 Month</option>
                        <option value="180">6 Month</option>
                      </select> 
                      <input type="submit" name="search" value="Search" class="btn btn-outline-primary" >
                    </div> 
                  </form> 
                </div> 
                <!-- Col -->
                <!-- <div  class="col-sm-4 text-left"> 
                <! -- <button type="submit" name="search" class="btn btn-info mt-4">Search</button>            - ->
                  <! -- <input type="submit" name="search" value="search" class="btn btn-info" > - >
                </div>   -->
              </div>
        
        <!-- ======================================= -->
        <div class="d-flex">
          <label class="bg-danger btn" data-toggle="tooltip" title="Less Than 90 Days!">90 Day</label><label  class="btn bg-warning" data-toggle="tooltip" title="Less Than 180 Days!">180 Day</label>
          <!-- <a class="btn btn-success m-auto" href="{{ url('Expiry_s_export_excel/'.$record_Date) }}">Export In Excel</a> -->
          <?php if(!$store_product){ ?>
          <button class="btn btn-success m-auto" disabled>Export In Excel</button>
         <?php }else{ ?>
          <a class="btn btn-success m-auto" href="{{ url('Expiry_s_export_excel/'.$record_Date) }}">Export In Excel</a>
        <?php }?>
        </div>
        <!-- <div class="d-flex text-center">
        <a class="btn btn-success m-auto" href="{{ route('export') }}">Export In Excel</a>
        </div> -->
        <!-- ========================================== -->
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
          <thead>     
              <tr>
                <th>Sr. No.</th>
                <!-- <th>Barcode</th>   -->
                <th>Product Name</th>               
                <th>Expiry Date</th>                  
                <th>Available Quantity</th>               
              </tr>
            </thead>
            <tbody> 
            @php 
              $count = 1;  

              @endphp 
              @foreach($store_product as $r)
              <?php             
             
                if($r->expiry_day < 90)
                { ?>
                  <tr class="bg-danger"> 
          <?php }
                elseif($r->expiry_day < 180)
                { ?>
                  <tr class="bg-warning"> 
          <?php } else { ?>
                  <tr>
          <?php } ?>
            <td> {{$count++}} </td>
            @if($r->size_name!="Main")
            <td>{{$r->product_name}} ({{$r->size_name}})</td> 
            @else
            <td>{{$r->product_name}}</td> 
            @endif
            <td>{{$r->expiry_date}}</td>
            <?php if($r->avl_quantity) { ?>                  
            <td>{{$r->avl_quantity}} (@if($r->per_stript_qty){{round(($r->avl_quantity /$r->per_stript_qty),2)}}@else{{round(($r->avl_quantity /1),2)}} @endif)</td> 
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
          <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script> -->
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script> -->
          <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
          <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
        <script type="text/javascript">
          $(document).ready(function()
          {
            $("#form_date").datepicker({
              minDate: 0
            });
            
            $("#to_date").datepicker({
              minDate: 0
            });
          });
        </script> -->