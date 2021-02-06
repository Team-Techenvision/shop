
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
                <th>Customer Name</th> 
                <th>Order ID</th>
                <th>Price</th>  
                <th>order Date</th>    
                <th>Action</th>             
              </tr>
            </thead>
            <tbody> 
            @php 
              $count = 1;  

              @endphp 
              @foreach($shop_orders as $r)
              
            <tr> 
            <td> {{$count++}} </td>
            <td>{{$r->phone}}</td>     
            <!-- <td>{{$r->shop_id}}</td> -->
            <td>{{$r->order_id}}</td>
            <td>{{$r->amount}}</td>
            <td>{{$r->created_at}}</td> 
            <td><a href="{{url('cust-orderDetail/'.$r->order_id)}}" class="btn btn-success">View Details</a></td>   
            </tr>

            @endforeach
            </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>