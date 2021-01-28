




<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{$page_title}}</h6>
        <form action="{{url('product-order')}}" method="post">
        @csrf
            <div class="row">
              <div class="col-sm-12">
                  <div class="form-group">
                    <label class="control-label">Product</label>
                    <select name="product_name" id="product_id" class="form-control rounded" required>
                    @foreach($product as $row)
                      <option value="{{$row->products_id}}">{{$row->product_name}}</option>
                    @endforeach                   
                    </select>
                  </div>
              </div><!-- Col --> 
            </div>               
                <div class="row">
                  <div class="col-sm-4">                  
                    <div class="form-group">
                      <label class="control-label">Quantity</label>
                      <input type="number" class="form-control text-center" name="p_qty" id="productqty" value="1" required>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Expiry Date</label>
                      <input type="date" class="form-control" name="exp_date">
                    </div>
                  </div>
                  <!-- <div class="col-sm-4">                  
                    <div class="form-group">
                      <label class="control-label">Tax</label>
                      <select name="product_tax" id="tax" class="form-control rounded" required>
                      <option value="10">5%</option>
                      <option value="12">12%</option>
                      <option value="18">18%</option>
                      <option value="20">28%</option>
                      </select>
                    </div>
                  </div> -->
                </div>           
              <div class="row">
              <div class="col-sm-6">
                  <div class="form-group">
                  <button class="btn btn-primary mr-1" type="submit">Add Quantity</button>
                  <button class="btn btn-light" type="reset">Reset</button>
                  @if (count($errors) > 0)
                    <div class = "alert alert-danger">
                        <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                    </div>
                  @endif
                </div>
              </div><!-- Col --> 
            </div> 
          </form>
            <!-- Row -->
            <!-- <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Email address</label>
                  <input type="email" class="form-control" placeholder="Enter email">
                </div>
              </div><! -- Col - ->
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Password</label>
                  <input type="password" class="form-control" autocomplete="off" placeholder="Password">
                </div>
              </div><! -- Col - ->
            </div>Row -->
          <!-- </form> -->

        <!-- <form>
          <div class="form-group">
            <label for="exampleInputText1">Select Product</label>
            <select name="product" id="product_id" class="form-control rounded w-50" required>
                <option value="pr_one">Product One</option>
                <option value="pr_two">Product Two</option>
                <option value="pr_three">OpProduct Three</option>
                <option value="pr_four">Product Four</option>
            </select>
            <! -- <input type="text" class="form-control" id="exampleInputText1" value="Amiah Burton" placeholder="Enter Name"> -- >
          </div>
          <div class="form-group">
            <label for="exampleInputEmail3">Quantity</label>
            <input type="text" class="form-control text-center" name="p_qty" id="productqty" value="1" required>
            <! -- <input type="email" class="form-control" id="exampleInputEmail3" value="amiahburton@gmail.com" placeholder="Enter Email"> - ->
          </div>
          <div class="form-group">
            <label for="exampleInputNumber1">Number Input</label>
            <input type="number" class="form-control" id="exampleInputNumber1" value="6473786">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword3">Password Input</label>
            <input type="password" class="form-control" id="exampleInputPassword3" value="amiahburton" placeholder="Enter Password">
          </div>
          <div class="form-group">
            <label for="exampleInputDisabled1">Disabled Input</label>
            <input type="text" class="form-control" id="exampleInputDisabled1" disabled value="Amiah Burton">
          </div>
          <div class="form-group">
            <label for="exampleInputPlaceholder">Placeholder</label>
            <input type="text" class="form-control" id="exampleInputPlaceholder" placeholder="Enter Your Name">
          </div>
          <div class="form-group">
            <label for="exampleInputReadonly">Readonly</label>
            <input type="text" class="form-control" id="exampleInputReadonly" readonly value="Amiah Burton">
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Select Input</label>
            <select class="form-control" id="exampleFormControlSelect1">
              <option selected disabled>Select your age</option>
              <option>12-18</option>
              <option>18-22</option>
              <option>22-30</option>
              <option>30-60</option>
              <option>Above 60</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect2">Example multiple select</label>
            <select multiple class="form-control" id="exampleFormControlSelect2">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>
              <option>7</option>
              <option>8</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Example textarea</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
          </div>
          <div class="form-groupp">
            <label for="customRange1">Range Input</label>
            <input type="range" class="custom-range" id="customRange1">
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input">
                Default checkbox
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" checked class="form-check-input">
                Checked
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" disabled class="form-check-input">
                Disabled checkbox
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" disabled checked>
                Disabled checked
              </label>
            </div>
          </div>
          <div>
            <div class="form-check form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input">
                Inline checkbox
              </label>
            </div>
            <div class="form-check form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" checked class="form-check-input">
                Checked
              </label>
            </div>
            <div class="form-check form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" disabled class="form-check-input">
                Inline disabled checkbox
              </label>
            </div>
            <div class="form-check form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" disabled checked>
                Disabled checked
              </label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios" value="option1">
                Default
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="option1">
                Default
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optionsRadios2" id="optionsRadios2" value="option2" checked="">
                Selected
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optionsRadios3" id="optionsRadios3" value="option3" disabled="">
                Disabled
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optionsRadios4" id="optionsRadios4" value="option4" disabled="" checked="">
                Selected and disabled
              </label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-check form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optionsRadios5" id="optionsRadios5" value="option5">
                Default
              </label>
            </div>
            <div class="form-check form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optionsRadios5" id="optionsRadios6" value="option5">
                Default
              </label>
            </div>
            <div class="form-check form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optionsRadios7" id="optionsRadios7" value="option6" checked="">
                Selected
              </label>
            </div>
            <div class="form-check form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optionsRadios8" id="optionsRadios8" value="option7" disabled="">
                Disabled
              </label>
            </div>
            <div class="form-check form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optionsRadios9" id="optionsRadios9" value="option8" disabled="" checked="">
                Selected and disabled
              </label>
            </div>
          </div>
          <div class="form-group">
            <label>File upload</label>
            <input type="file" name="img[]" class="file-upload-default">
            <div class="input-group col-xs-12">
              <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
              <span class="input-group-append">
                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
              </span>
            </div>
          </div>
          <button class="btn btn-primary" type="submit">Submit form</button>
        </form> -->
      </div>
    </div>
  </div>
</div>

