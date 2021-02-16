
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
            <td>{{$r->product_name}}</td>     
            <!-- <td>{{$r->shop_id}}</td> -->
            <td>{{$r->input_quantity}}</td>
            <td>{{$r->avl_quantity}}</td>
            <td>{{$r->expiry_date}}</td> 
            <td> <a href="{{url('generate-barcode/'.$r->barcode)}}"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> </a> </td>   
            </tr>

            @endforeach
            </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>