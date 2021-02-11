<div class="col-md-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">                       
                        <div class="table-responsive">
                        <div class="d-flex d-flex justify-content-between p-2"> 
                            <div>
                                <!-- <div class="d-block">Customer :</div>
                                <div class="d-block">Date :</div> -->
                            </div>
                            <div>
                          
                            <!-- {{$order_id}} -->
                            <a href="{{url('download-invoice/'. $order_id)}}" target="_blank"><button class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> Print Order Invioce</button></a>
                            </div>
                        </div>
                        <table class="table mt-2">
                            <thead>     
                                <tr>
                                    <th>Sr. No.</th> 
                                    <th>Product Name</th> 
                                    <th>Price</th>
                                    <th>GST %</th>  
                                    <th>Quantity</th>
                                    <th>Amount</th>                                                      
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                        @foreach($product_order as $row)
                            <tr>
                                <th><?php echo $i; ?></th> 
                                <th>{{$row->product_name}}</th> 
                                <th>{{$row->sub_total}}</th>
                                <th>{{$row->gst_value_percentage}}</th>  
                                <th>{{$row->quantity}}</th>
                                <th>{{(($row->sub_total * $row->quantity)/100 * $row->gst_value_percentage) + ($row->sub_total * $row->quantity) }}</th>                                            
                            </tr>
                            <?php $i++; ?>
                         @endforeach
                         <tr>
                                <th></th> 
                                <th></th> 
                                <th></th>
                                <th></th> 
                                <th>Total</th>  
                                <th>{{$row->amount}}</th>
                                                                             
                            </tr>               
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
                </div>
            </div>	
        </div> 
    </div>    
</div>