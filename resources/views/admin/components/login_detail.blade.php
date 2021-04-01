
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{$page_title}}</h6>
        <div class="any_message">
              @if(session()->has('alert-danger'))
                        <div class="alert alert-danger">
                            {{ session()->get('alert-danger') }}
                        </div>
                    @endif
                    @if(session()->has('alert-success'))
                  <div class="alert alert-success">
                      {{ session()->get('alert-success') }}
                  </div>
              @endif
         </div>     
        <!-- <p class="card-description">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p> -->
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
          <thead>     
              <tr>
                <th>Sr. No.</th> 
                <th>First Name</th> 
                                
                <th>Phone</th>
                <th>Log In</th>
                <th>Log Out</th> 
               
                <th>Active Status</th>                  
              </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>            
            @foreach($shop_Employee as $row)
            <tr>
                <th><?php echo $i; ?></th> 
                <th>{{$row->name}}</th>
                                         
                <th>{{$row->phone}}</th>
                <!-- < ?php $login = date("Y-m-d  h:i:s A", {{$row->created_at}}); ?>  -->
                <?php $in_d = strtotime($row->created_at); ?>
                <th><?php echo date("Y-m-d h:i:s A", $in_d); ?></th>
                <!-- <th>{{$row->created_at}}</th>   -->
                <?php $out_d = strtotime($row->updated_at); ?>

                <th><?php echo date("Y-m-d h:i:s A", $out_d); ?></th> 
               
                  <th>                         
                   <form action="{{url('change-status')}}" method="post" >
                   @csrf
                   <div>
                       
                      <?php if($row->role != 1) {?>
                      <?php if($row->is_block != "1"){ ?>
                        <button type="submit" class="btn btn-primary" disabled>Active</button>
                        
                    <?php }else{?>  <button type="submit" class="btn btn-danger" disabled>In Active</button> <?php } } else {?>
                      <button type="submit" class="btn btn-warning" disabled>Admin</button>
                    <?php } ?>  
                     
                 
                      </div>
                      </form>
                    </th>                 
                </tr>
                <?php $i++; ?>
              @endforeach             
              </tbody>
                    </table>
                  </div>
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