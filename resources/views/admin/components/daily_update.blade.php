
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{$page_title}}</h6>       
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
          <thead>     
              <tr>
                <th>Sr. No.</th>
                <!-- <th>Barcode</th>   -->
                <th>Date</th>
                <th>Sell Total Amount</th>                                
                <th>Send Mail</th>       
              </tr>
            </thead>
            <tbody> 
            @php 
              $count = 1;  

              @endphp 
              @foreach($daily_report as $r)
              
            <tr> 
            <td> {{$count++}} </td> 
            <td>{{$r->Date}}</td> 
            <td>{{number_format($r->tatal_amount, 2) }}</td>
            <td><a href="{{url('daily-sell-update/'.$r->Date)}}" class="btn btn-info">Send</a></td>            
            </tr>

            @endforeach
            </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>