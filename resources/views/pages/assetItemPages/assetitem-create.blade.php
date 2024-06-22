<!-- ======= Head ======= -->
@include('admin.inc.head')
<!-- ======= Head ======= -->
<body>

<!-- ======= Header ======= -->
@include('admin.inc.header')
<!-- End Header -->

<!-- ======= Sidebar ======= -->
@include('admin.inc.sidebar')
<!-- End Sidebar-->

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Asset Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Asset Registration</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->


    @if(session('message'))
      <script>
        Swal.fire({
        icon: "Success",
        title: "Wow...",
        text: "Succssfully Completed!",
       
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
            <form action='{{ route('asset-store') }}' method="post" class="row g-3 needs-validation" novalidate>
                @csrf
                <input type="hidden" class="form-control my-border formsrow" value="{{$company[0]->id }}"  name ="company_id" id="company_id"  >
                <div class="row mt-5">
                 
                
                  <div class="col-3 text-end">
                    <label for="assetitem_po_mst_id" class="form-label formsrow">PO NO <span style="color:red">*</span></label>
                  </div>
                  <div class="col-5 text-end">
                    <select class="form-select "  name="assetitem_po_mst_id" id="assetitem_po_mst_id" required>
                      <option selected disabled value="">Choose PO</option>
                      @foreach ($pomst as $result)
                          <option value="{{ $result->id }}">{{ $result->po_gen_id }} </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-4"></div>

                  <div class="col-3 text-end">
                    <label for="supplier_id" class="form-label formsrow">Supplier <span style="color:red">*</span></label>
                  </div>
                  <div class="col-5 text-end">
                    <select class="form-select  "  name="supplier_id" id="supplier_id" required>
                      <option selected disabled value="">Choose Supplier</option>
                      @foreach ($supplier as $result)
                          <option value="{{ $result->id }}">{{ $result->name }} </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-4"></div>


                  <div class="col-3 text-end">
                    <label for="brand_id" class="form-label formsrow">Brand <span style="color:red">*</span></label>
                  </div>
                  <div class="col-5 text-end">
                    <select class="form-select "  name="brand_id" id="brand_id" required>
                      <option selected disabled value="">Choose Brand</option>
                      @foreach ($brand as $result)
                          <option value="{{ $result->id }}">{{ $result->name }} </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-4"></div>

                  <div class="col-3 text-end">
                    <label for="categorymodel_id" class="form-label formsrow">Model No/Name <span style="color:red">*</span></label>
                  </div>
                  <div class="col-9 text-end">
                    <select class="form-select "  name="categorymodel_id" id="categorymodel_id" required>
                      <option selected disabled value="">Model- Sub-Category- Category</option>
                      @foreach ($categorymodel as $result)
                          <option value="{{ $result->id }}">{{$result->name .' , -- '.$result->categorytype->name.' , -- '.$result->categorytype->category->name }} </option>

                          
                          
                      @endforeach
                      <!--  Relational data category-> categorytype->model 
                    <option value="{{ $result->id }}">{{'model id:'. $result->id.''.$result->name .'categorytype_id '.$result->categorytype_id.' categoryname '.$result->categorytype->name.' category_id '.$result->categorytype->category_id.' category_name '.$result->categorytype->category->name }} </option>-->
                    </select>
                  </div>
                  <!-- <div class="col-4"></div> -->


                  <div class="col-3 text-end">
                    <label for="asset_no" class="form-label formsrow">Asset Number <span style="color:red">*</span></label>
                  </div>
                  <div class="col-3 text-end">
                    <input type="text" placeholder="asset_no" class="form-control formsrow" name ="asset_no" id="asset_no"  required>
                  </div>
                  

                  <div class="col-3  text-end">
                    <label for="manufacture_no" class="form-label formsrow">Manufacture No <span style="color:red">*</span></label>
                  </div>
                  <div class="col-3 text-end">
                    <input type="text" placeholder="manufacture_no" class="form-control formsrow" name ="manufacture_no" id="manufacture_no"  required>
                  </div>
                  
                  <div class="col-3  text-end">
                    <label for="pruchase_date" class="form-label formsrow">Purchase Date <span style="color:red">*</span></label>
                  </div>
                  <div class="col-3 text-end">
                    <input type="date" placeholder="pruchase_date" class="form-control formsrow" name ="pruchase_date" id="pruchase_date"  required>
                  </div>

                  <div class="col-3  text-end">
                    <label for="unit_price" class="form-label formsrow">Unit Price <span style="color:red">*</span></label>
                  </div>
                  <div class="col-3 text-end">
                    <input type="text" placeholder="unit_price" class="form-control formsrow" name ="unit_price" id="unit_price"  required>
                  </div>

                  <div class="col-3  text-end">
                    <label for="WarrantyEndDate" class="form-label formsrow">WarrantyEndDate </label>
                  </div>
                  <div class="col-3 text-end">
                    <input type="date" placeholder="WarrantyEndDate" class="form-control formsrow" name ="WarrantyEndDate" id="WarrantyEndDate"  required>
                  </div>

                  <div class="col-3  text-end">
                    <label for="currency_id" class="form-label formsrow">Currency <span style="color:red">*</span></label>
                  </div>
                  <div class="col-3 text-end">
                  <select class="form-select "  name="currency_id" id="currency_id" required>
                      <option selected disabled value="">Choose Currency</option>
                      @foreach ($currency as $result)
                          <option value="{{ $result->id }}">{{ $result->name }} </option>
                      @endforeach
                    </select>
                  </div>
                

                  <div class="col-3 text-end">
                    <label for="DepreciationRate" class="form-label formsrow">DepreciationRate </label>
                  </div>
                  <div class="col-3  text-end">
                    <input type="text" placeholder="DepreciationRate" class="form-control formsrow" name ="DepreciationRate" id="DepreciationRate"  required>
                  </div>
                 
                  <div class="col-3 text-end">
                    <label for="gov_registration_no" class="form-label formsrow">Gov. Registration No </label>
                  </div>
                  <div class="col-3  text-end">
                    <input type="text" placeholder="gov_registration_no" class="form-control formsrow" name ="gov_registration_no" id="gov_registration_no"  required>
                  </div>


                  <div class="col-3 text-end">
                    <label for="chassis_no" class="form-label formsrow">Chassis No</label>
                  </div>
                  <div class="col-3  text-end">
                    <input type="text" placeholder="chassis_no" class="form-control formsrow" name ="chassis_no" id="chassis_no"  required>
                  </div>
                 

                  <div class="col-3 text-end">
                    <label for="enginee_no" class="form-label formsrow">Enginee No</label>
                  </div>
                  <div class="col-3  text-end">
                    <input type="text" placeholder="enginee_no" class="form-control formsrow" name ="enginee_no" id="enginee_no"  required>
                  </div>
                

                </div>

               
                <div class="col-12">
                  <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6"><button class="btn btn-primary " type="submit">Save</button></div>
                  </div>
                    
                </div>
            </form>
            

          </div>
        </div>
      </div>
    </div>
  </section>
    
  <section class="section">
    <div class="row">
        <div class="col-lg-12">
          <div class="card c-shadow">
            <div class="card-body">
              <h5 class="card-title">Asset List</h5>

              <!-- Table with stripped rows -->
              <table id="datatable" class="table table-striped table-bordered datatable">
                <thead>
                  <tr class="text-center bg-dark text-light">

                    <th scope="col">ID</th>
                    <th scope="col">Category</th>
                    <th scope="col">Sub-Category</th>
                    <th scope="col">Model</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Asset No</th>
                    <th scope="col">Manufacture No</th>
                    <th scope="col">Action</th>

                  </tr>
                </thead>
                <tbody>
                  @foreach ($assetitem as $result)
                      <tr>
                          
                          <td>{{  $result->id }}</td>
                          
                          <td>{{  $result->categorymodel->categorytype->category->name }}</td>
                          <td>{{  $result->categorymodel->categorytype->name }}</td>
                          <td>{{  $result->categorymodel->name }}</td>
                          <td>{{  $result->brand->name }}</td>
                          <td>{{  $result->asset_no }}</td>
                          <td>{{  $result->manufacture_no }}</td>
                          
                          <td class="text-center">
                              <a href="{{ route('asset-edit',$result->id) }}"><span class="badge rounded-pill text-bg-warning">Edit</span></a>
                              
                          
                              <a onclick="return confirm('Are you sure to delete ?')" href="{{ url('asset-delete/'.$result->id) }}" class="badge rounded-pill text-bg-danger">Delete</a>
                              
                          </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
              <div class="pages">
              </div>
            </div>
      </div>
    </div>
  </section>


 
  
  
  <!-- bootstrap5 dataTables js cdn -->
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#datatable').DataTable();
    });
  </script>

</main>
  <!-- End #main -->

<!-- ======= Footer ======= -->
@include('admin.inc.footer')
<!-- End Footer -->

  

</body>
  <!-- Template Main JS File -->
  <script src="{{ asset("admin/assets/js/main.js")}}"></script>
</html>