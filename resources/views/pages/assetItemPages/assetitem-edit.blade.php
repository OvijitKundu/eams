<!-- ======= Head ======= -->
@include('admin.inc.head')
<!-- ======= Head ======= -->
<body>

<!-- ======= Header ======= -->
@include('admin.inc.header')
<!-- End Header -->

<!-- ======= Sidebar ======= -->
{{-- @include('admin.inc.sidebar') --}}
<!-- End Sidebar-->

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Asset Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Asset Edit</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    
    @if(session('message'))
      <script>
        Swal.fire({
        icon: "Success",
        title: "Wow...",
        text: "You updated succssfully!",
       
        })
      </script>
    @endif
    <section class="section">
      <div class="row">
         <div class="col-lg-10">
              <div class="card c-shadow">
                  <div class="card-body">
                      @if ($errors->any())
                        <div class="alert alert-danger">
                          <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                        </div>
                      @endif
                      <form action='{{ route('asset-update') }}' method="post" class="row g-3 needs-validation" novalidate>
                            @csrf
                            <input type="hidden" name="id" value="{{ $assetitem->id }}">
                            <div class="row mt-5">
                 
                            <div class="col-3 text-end">
                              <label for="assetitem_po_mst_id" class="form-label formsrow">PO No <span style="color:red">*</span></label>
                            </div>
                            <div class="col-5 text-end">
                                <select class="form-select " name="assetitem_po_mst_id" id="supplier_id" required>
                                 
                                  @foreach ($pomst as $item)
                                      <option {{ $assetitem->assetitem_po_mst_id == $item->id?'selected':'' }} value="{{ $item->id }}">{{ $item->po_gen_id }}</option>
                                  @endforeach
                                </select>
                            </div>
                            <div class="col-4"></div>


                            <div class="col-3 text-end">
                              <label for="supplier_id" class="form-label formsrow">Supplier <span style="color:red">*</span></label>
                            </div>
                            <div class="col-5 text-end">
                                <select class="form-select " name="supplier_id" id="supplier_id" required>
                                 
                                  @foreach ($supplier as $item)
                                      <option {{ $assetitem->supplier_id == $item->id?'selected':'' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                  @endforeach
                                </select>
                            </div>
                            <div class="col-4"></div>


                              <div class="col-3 text-end">
                                <label for="brand_id" class="form-label formsrow">Brand <span style="color:red">*</span></label>
                              </div>
                              <div class="col-5 text-end">
                                <select class="form-select " name="brand_id" id="validationCustom05" required>
                                  
                                  @foreach ($brand as $item)
                                      <option {{ $assetitem->brand_id == $item->id?'selected':'' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="col-4"></div>
            
                              <div class="col-3 text-end">
                                <label for="categorymodel_id" class="form-label formsrow">Model <span style="color:red">*</span></label>
                              </div>
                              <div class="col-9 text-end">
                                <select class="form-select "  name="categorymodel_id" id="categorymodel_id" required>
                                  
                                  @foreach ($categorymodel as $result)
                                    <option {{ $assetitem->categorymodel_id == $result->id?'selected':'' }} 
                                    value="{{ $result->id }}">{{$result->name .' , -- '.$result->categorytype->name.' , -- '.$result->categorytype->category->name }}
                                    </option>
                                  @endforeach
                                </select>
                              </div>
                              <!-- <div class="col-4"></div> -->
                              <!-- <option value="{{ $result->id }}">{{$result->name .' , -- '.$result->categorytype->name.' , -- '.$result->categorytype->category->name }} </option> -->
            
                              <div class="col-3 text-end">
                                <label for="asset_no" class="form-label formsrow">Asset Number <span style="color:red">*</span></label>
                              </div>
                              <div class="col-5 text-end">
                                <input type="text" value="{{ $assetitem->asset_no }}" class="form-control formsrow" name ="asset_no" id="asset_no"  required>
                              </div>
                              <div class="col-4"></div>
            
                              <div class="col-3  text-end">
                                <label for="manufacture_no" class="form-label formsrow">Manufacture No <span style="color:red">*</span></label>
                              </div>
                              <div class="col-9 text-end">
                                <input type="text" value="{{ $assetitem->manufacture_no }}" class="form-control formsrow" name ="manufacture_no" id="manufacture_no"  required>
                              </div>
                              

                              <div class="col-3  text-end">
                                <label for="pruchase_date" class="form-label formsrow">Purchase Date <span style="color:red">*</span></label>
                              </div>
                              <div class="col-3 text-end">
                                <input type="date" value="{{ $assetitem->pruchase_date }}" class="form-control formsrow" name ="pruchase_date" id="pruchase_date"  required>
                              </div>

                            <div class="col-3  text-end">
                              <label for="unit_price" class="form-label formsrow">Unit Price <span style="color:red">*</span></label>
                            </div>
                            <div class="col-3 text-end">
                              <input type="text" value="{{ $assetitem->unit_price }}" class="form-control formsrow" name ="unit_price" id="unit_price"  required>
                            </div>

                            <div class="col-3  text-end">
                              <label for="WarrantyEndDate" class="form-label formsrow">WarrantyEndDate </label>
                            </div>
                            <div class="col-3 text-end">
                              <input type="date" value="{{ $assetitem->WarrantyEndDate }}" class="form-control formsrow" name ="WarrantyEndDate" id="WarrantyEndDate"  required>
                            </div>

                            <div class="col-3  text-end">
                              <label for="currency_id" class="form-label formsrow">Currency <span style="color:red">*</span></label>
                            </div>
                            <div class="col-3 text-end">
                              <select class="form-select " name="currency_id" id="validationCustom05" required>
                                
                                @foreach ($currency as $item)
                                    <option {{ $assetitem->currency_id == $item->id?'selected':'' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                              </select>
                            </div>
                

                            <div class="col-3 text-end">
                              <label for="DepreciationRate" class="form-label formsrow">DepreciationRate </label>
                            </div>
                            <div class="col-3  text-end">
                              <input type="text" value="{{ $assetitem->DepreciationRate }}" class="form-control formsrow" name ="DepreciationRate" id="DepreciationRate"  required>
                            </div>


                            <div class="col-3 text-end">
                              <label for="gov_registration_no" class="form-label formsrow">Gov. Registration No </label>
                            </div>
                            <div class="col-3  text-end">
                              <input type="text" value="{{ $assetitem->gov_registration_no }}" class="form-control formsrow" name ="gov_registration_no" id="gov_registration_no"  required>
                            </div>
                  

                            <div class="col-3 text-end">
                              <label for="chassis_no" class="form-label formsrow">Chassis No</label>
                            </div>
                            <div class="col-3  text-end">
                              <input type="text" value="{{ $assetitem->chassis_no }}" class="form-control formsrow" name ="chassis_no" id="chassis_no"  required>
                            </div>
                        
                            <div class="col-3 text-end">
                            <label for="enginee_no" class="form-label formsrow">Enginee No</label>
                            </div>
                            <div class="col-3  text-end">
                              <input type="text" value="{{ $assetitem->enginee_no }}" class="form-control formsrow" name ="enginee_no" id="enginee_no"  required>
                            </div>


                            <div class="col-3 text-end">
                              <label for="stock_sts" class="form-label formsrow">Stock Status</label>
                            </div>
                            <div class="col-3  text-end">
                             
                              <select class="form-select  " name="stock_sts" id="stock_sts" >
                               
                                <option {{ $assetitem->stock_sts=='Stock in hand'?'selected':'' }} value="Stock in hand">Stock in hand</option>
                                <option {{ $assetitem->stock_sts=='In maintenance'?'selected':'' }}  value="In maintenance">In maintenance</option>
                                <option {{ $assetitem->stock_sts=='Disposed'?'selected':'' }}  value="Disposed">Disposed</option>
                              </select>
                            </div>
           
                            <div class="col-3 text-end">
                              <label for="asset_status" class="form-label formsrow">Asset Status</label>
                            </div>
                            <div class="col-3  text-end">
                             
                              <select class="form-select" name="asset_status" id="asset_status" >
                               
                                <option {{ $assetitem->asset_status=='Active'?'selected':'' }} value="Active">Active</option>
                                <option {{ $assetitem->asset_status=='InActive'?'selected':'' }}  value="InActive">InActive</option>
                               
                              </select>
                            </div>

                         
                            <div class="col-12 mt-4">
                            <div class="row mb-3">
                              <div class="col-3"></div>
                              <div class="col-5">
                                <button class="btn btn-success mybutton" type="submit">Update</button>
                              
                                <button class="btn btn-info mybutton"><a href="{{ route('asset_view') }}"> Return</a></button>
                                </div>
                              <div class="col-4"></div>
                            </div>

                          </div>
                        </form>
                  </div>
              </div>
          </div>
      </div>
    </section>

</main>
  <!-- End #main -->

<!-- ======= Footer ======= -->
@include('admin.inc.footer')
<!-- End Footer -->

  

</body>
  <!-- Template Main JS File -->
  <script src="{{ asset("admin/assets/js/main.js")}}"></script>
</html>