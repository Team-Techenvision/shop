
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
                <th>Product Name</th> 
                <th>Quantity</th>
                <th>Available Quantity</th>  
                <th>Expiry Date</th>                 
              </tr>
            </thead>
            <tbody> 
            @php 
              $count = 1;  

              @endphp 
              @foreach($product as $r)
              
            <tr> 
            <td> {{$count++}} </td>
            <td>{{$r->product_name}}</td>     
            <!-- <td>{{$r->shop_id}}</td> -->
            <td>{{$r->input_quantity}}</td>
            <td>{{$r->input_quantity}}</td>
            <td>{{$r->expiry_date}}</td>    
            </tr>

            @endforeach
            </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>