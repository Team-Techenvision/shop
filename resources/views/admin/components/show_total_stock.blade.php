
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{$page_title}}</h6>
        <!-- <p class="card-description">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p> -->
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
          <thead>     
              <tr>
                <th>Sr. No.</th>
                <!-- <th>Barcode</th>   -->
                <th>Product Name</th>                 
                <th>Available Quantity</th>               
              </tr>
            </thead>
            <tbody> 
            @php 
              $count = 1;  

              @endphp 
              @foreach($product as $r)
              
            <tr> 
            <td> {{$count++}} </td>           
          <?php  $product_name = DB::table('products')->select('product_name')->where('products_id',$r->products_id)->first();  ?> 
          
            <td>{{$product_name->product_name}}</td> 
            <?php if($r->total) { ?>                  
            <td>{{$r->total}}</td> 
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