
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{$page_title}}</h6>
        <!-- <p class="card-description">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p> -->
        <form action="{{url('top-selling')}}" method="post">
        @csrf 
              <div class="row m-auto">
                <div class="col-sm-8">
                  <div class="form-group text-right">
                    <label class="control-label mr-1 mt-2 h4">Check </label>
                    <select name="within_date" id="Exp_date" class="form-control rounded w-50 float-right" required>
                      <option value="">Select Day</option>                   
                      <!-- <option value="5">5 Day</option> -->
                      <option value="15">15 Day</option>
                      <option value="30">1 Month</option>
                      <option value="60">2 Month</option>
                      <option value="90">3 Month</option>
                    </select>                   
                  </div>                         
                </div><!-- Col -->
              <div  class="col-sm-4 text-left"> 
              <!-- <button type="submit" name="search" class="btn btn-info mt-4">Search</button>            -->
                <input type="submit" name="search" value="search" class="btn btn-info" >
              </div>  
            </div>
        </form>
        <div class="d-flex">
        <!-- <label class="bg-info btn" data-toggle="tooltip" title="Top Selling Product!">Top Selling</label> -->
        <!-- <a class="btn btn-success m-auto" href="{{ url('top_s_export_excel/'.$record_Date) }}">Export In Excel</a> -->
        <?php if(!$top_selling){ ?>
        <button class="btn btn-success m-auto" disabled>Export In Excel</button>
        <?php }else{ ?>
        <a class="btn btn-success m-auto" href="{{ url('top_s_export_excel/'.$record_Date) }}" >Export In Excel</a>
          
         <?php }?>
        </div>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
          <thead>     
              <tr>
                <th>Sr. No.</th>
                <!-- <th>Barcode</th>   -->
                <th>Product Name</th> 
                <th>Selling Quantity</th>               
              </tr>
            </thead>
            <tbody> 
            
            </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>