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
      <h1>Work Order Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Generate Work Order</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->
        @if(session('message'))
          <script>
            Swal.fire({
            icon: "Success",
            title: "Wow...",
            text: "Data Successfully Saved!",
          
            })
          </script>
        @endif
         

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form action="{{ route('workorder-store') }}" method="post" class="row g-3 needs-validation" novalidate> 
            @csrf
              <div class="card c-shadow">
                <div class="card-body">
                    <input type="hidden" class="form-control my-border formsrow" value="{{$company[0]->id }}"  name ="company_id" id="company_id"  >
                  <div class="row mt-4 mb-2 border border-1 border-dark">
                    <h5 class="mt-2">Step : 1, Basic Information of Asset</h5>

                    <div class="col-3 mt-2 text-end"><label for="assetitem_id"> Asset Details <span style="color:red;font-size:22px;">*</span> </label></div>
                    <div class="col-9  mt-2 text-end">

                      <select class="form-select "  name="assetitem_id" id="assetitem_id"   >
                        <option selected disabled value="">Choose Asset</option>
                        @foreach ($assetitem as $result)
                            <option value="{{ $result->id }}">{{ $result->asset_no.' -- '.$result->categorymodel->name .' -- '.$result->categorymodel->categorytype->name}} </option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-3 text-end"><label for="workshop_id"> Workshop<span style="color:red;font-size:22px;">*</span></label></div>
                    <div class="col-9 mb-2 text-end">

                      <select class="form-select "  name="workshop_id" id="workshop_id"   >
                        <option selected disabled value="">Choose Workshop</option>
                        @foreach ($workshop as $result)
                            <option value="{{ $result->id }}">{{ $result->name}} </option>
                        @endforeach
                      </select>
                    
                    </div>

                    <div class="col-3 text-end"><label for="failure_cause"> Failure Cause<span style="color:red;font-size:22px;">*</span></label></div>
                    <div class="col-9 mb-2 text-end">
                      <input type="text" placeholder="failure_cause" class="form-control formsrow" name ="failure_cause" id="failure_cause"    >
                    </div>

                    <div class="col-3 text-end"><label for="priority"> Priority<span style="color:red;font-size:22px;">*</span></label></div>
                    <div class="col-3 mb-2 text-start">
                      <select name="priority" id="priority">
                        <option value="Urgent">Urgent</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                      </select>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-3 mb-2 text-end"><label for="workorder_type"> WorkOrder Type<span style="color:red;font-size:22px;">*</span></label></div>
                    <div class="col-2  text-start">
                      <select name="workorder_type" id="workorder_type">
                        <option value="Corrective">Corrective</option>
                        <option value="Preventive">Preventive</option>
                        <option value="Regular">Regular</option>
                      </select>
                    </div>

                    <div class="col-3 text-end"><label for="before_efficiency">Efficiency %( Before)<span style="color:red;font-size:22px;">*</span></label></div>
                    <div class="col-2 mb-2 text-end">
                      <input type="text" placeholder="Efficiency before maintenance" class="form-control formsrow" name ="before_efficiency" id="before_efficiency"    >
                    </div>
                    <div class="col-2"></div>

                    <div class="col-3 text-end"><label for="after_efficiency">Efficiency %( After)</label></div>
                    <div class="col-2  mb-2 text-end">
                      <input type="text" placeholder="Efficiency After maintenance" class="form-control formsrow" name ="after_efficiency" id="after_efficiency"    >
                    </div>

                    <div class="col-3 text-end"><label for="approve_stats_by">Approve by<span style="color:red;font-size:22px;">*</span></label></div>
                    <div class="col-9 mb-2 text-end">
                      <input type="text" placeholder="Approve By" class="form-control formsrow" name ="approve_stats_by" id="approve_stats_by"    >
                    </div>

                  </div>
                </div>
              </div>
              <!-- Standard Operation -->
              <div class="card c-shadow">
                <div class="card-body">       
                  <div class="card p-1 mt-2 " style="border: 1px solid black; box-shadow: 0px 0px 
                    10px rgba(0, 0, 0, 0.1);">
                    <h5 class="mt-2 mb-3">Step 2 : Standard Operation</h5>
                    <div class="table-responsive">
                        <table id="op" class="table table-bordered">
                      
                          <thead>
                              <tr>
                                  <!-- <th>Activities Name<span style="color:red;font-size:22px;">*</span></th> -->
                                  <th>Opearation Name<span style="color:red;font-size:22px;">*</span></th>
                                  <!-- <th>resoulation<span style="color:red;font-size:22px;">*</span></th>
                                  <th>member_id<span style="color:red;font-size:22px;">*</span></th> -->
                                  <!-- <th >duration<span style="color:red;font-size:22px;" >*</span></th>
                                  <th >started_at<span style="color:red;font-size:22px;" >*</span></th>
                                  <th >ended_at<span style="color:red;font-size:22px;" >*</span></th> -->
                                  <th><button type="button" id="addRowOP">Add OP</button></th>

                                  <!-- `workorder_id`, `operation_id`, `resoulation`, `member_id`, `duration`, `started_at`, `ended_at`, `updated_by`, `created_at`, `updated_at` -->
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <!-- <td>
                                    <input type="text" class="form-control" name="items[0][activities]"> </td>
                                  <td> -->
                                  <td>
                                    <select class="form-select " name="op[0][operation_id]" id="operation_id"   >
                                        <option selected disabled value="">Choose Operation</option>
                                          @foreach ($operations as $result)
                                              <option value="{{ $result->id }}">{{ $result->operation_name }} </option>
                                          @endforeach
                                    </select>
                                  </td>
                                  <td>
                                    <input type="text" class="form-control" name="op[0][resoulations]" > </td>
                                  <td>
                                  <!-- <td>
                                    <input type="text" class="form-control" name="op[0][resoulations]" > </td>
                                  <td>

                                  <td>
                                    <select class="form-select " name="op[0][member_id]"   id="member_id"   >
                                        <option selected disabled value="">Choose Operation</option>
                                          @foreach ($operations as $result)
                                              <option value="{{ $result->id }}">{{ $result->operation_name }} </option>
                                          @endforeach
                                    </select>
                                  </td> -->
                                  <!-- <td> 
                                      <select class="form-select " name="items[0][uom_id]" name="uom_id[]" id="spartpart_id"   >
                                        <option selected disabled value="">Choose uom</option>
                                        @foreach ($uom as $result)
                                            <option value="{{ $result->id }}">{{ $result->name }} </option>
                                        @endforeach
                                      </select>
                                  </td>
                                  <td  ><input type="text" class="form-control" style="width:40px; text-align:center" name="items[0][quantity]"></td> -->
                                  <td><button type="button" class="removeRow form-control bg-danger text-light">X</button></td>
                              </tr>

                            
                          </tbody>
                        </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Materials -->
              <div class="card c-shadow">
                <div class="card-body">       
                  <div class="card p-1 mt-2 " style="border: 1px solid black; box-shadow: 0px 0px 
                    10px rgba(0, 0, 0, 0.1);">
                    <h5 class="mt-2 mb-3">Step 2 : Materials Information</h5>
                    <div class="table-responsive">
                        <table id="mtr" class="table table-bordered">
                      
                          <thead>
                              <tr>
                                  <th>Activities Name<span style="color:red;font-size:22px;">*</span></th>
                                  <th>Opearation Name<span style="color:red;font-size:22px;">*</span></th>
                                  <th>Spareparts Name<span style="color:red;font-size:22px;">*</span></th>
                                  <th>UOM Name<span style="color:red;font-size:22px;">*</span></th>
                                  <th >Qty<span style="color:red;font-size:22px;" >*</span></th>
                                  <th><button type="button" id="addRowmtr">Add mtr</button></th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>
                                    <input type="text" class="form-control" name="items[0][activities]"> </td>
                                  <td>
                                    
                                    <select class="form-select " name="items[0][operation_id]"  id="operation_id"   >
                                        <option selected disabled value="">Choose Operation</option>
                                          @foreach ($operations as $result)
                                              <option value="{{ $result->id }}">{{ $result->operation_name }} </option>
                                          @endforeach
                                    </select>
                                  </td>
                                  <td>
                                  
                                    <select class="form-select " name="items[0][spartpart_id]" name="spartpart_id[]" id="spartpart_id"   >
                                      <option selected disabled value="">Choose Spareparts</option>
                                      @foreach ($spareparts as $result)
                                          <option value="{{ $result->id }}">{{ $result->part_no.' -- '.$result->name }} </option>
                                      @endforeach
                                    </select>
                                  </td>
                                  <td>
                                    
                                      <select class="form-select " name="items[0][uom_id]" name="uom_id[]" id="spartpart_id"   >
                                        <option selected disabled value="">Choose uom</option>
                                        @foreach ($uom as $result)
                                            <option value="{{ $result->id }}">{{ $result->name }} </option>
                                        @endforeach
                                      </select>
                                  </td>
                                  <td  ><input type="text" class="form-control" style="width:40px; text-align:center" name="items[0][quantity]"></td>
                                  <td><button type="button" class="removeRow form-control bg-danger text-light">X</button></td>
                              </tr>

                            
                          </tbody>
                        </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-2"> <button class="form-control bg-success text-light"  
                        type="submit">Save </button>
              </div>
            </form>
      </div>
    </div>
  </section>
     

 
    
  <!-- <section class="section">
    <div class="row">
        <div class="col-lg-12">
          <div class="card c-shadow">
            <div class="card-body">
              <h5 class="card-title">Asset List</h5>

              
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
             
              <div class="pages">
              </div>
            </div>
      </div>
    </div>
  </section> -->




  
  
  <!-- bootstrap5 dataTables js cdn -->
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  

  <!-- Materials -->
  <script>
      let rowIdx1 = 1;
      document.getElementById('addRowOP').addEventListener('click', function () {
          let table = document.getElementById('op').getElementsByTagName('tbody')[0];
          let newRow = table.insertRow();
          newRow.innerHTML = `
              <td>
                  <select class="form-select " name="op[${rowIdx1}][operation_id]" id="operation_id"   >
                      <option selected disabled value="">Choose Operation</option>
                        @foreach ($operations as $result)
                            <option value="{{ $result->id }}">{{ $result->operation_name }} </option>
                        @endforeach
                  </select>
              </td>
             
             
              <td>
                <button type="button" class="removeRow form-control bg-danger text-light">X</button>
              </td>
          `;
          rowIdx++;
      });

      document.getElementById('op').addEventListener('click', function (e) {
          if (e.target && e.target.classList.contains('removeRow')) {
              e.target.parentNode.parentNode.remove();
          }
      });
</script>


<script>
      let rowIdx = 1;
      document.getElementById('addRowmtr').addEventListener('click', function () {
          let table = document.getElementById('mtr').getElementsByTagName('tbody')[0];
          let newRow = table.insertRow();
          newRow.innerHTML = `
              <td>
              <input type="text" class="form-control" name="items[${rowIdx}][activities]"></td>
              <td>
                
                  <select class="form-select " name="items[${rowIdx}][operation_id]" id="operation_id"   >
                      <option selected disabled value="">Choose Operation</option>
                        @foreach ($operations as $result)
                            <option value="{{ $result->id }}">{{ $result->operation_name }} </option>
                        @endforeach
                  </select>
              </td>
              <td>
              
                <select class="form-select " name="items[${rowIdx}][spartpart_id]" id="spartpart_id"   >
                  <option selected disabled value="">Choose Spareparts</option>
                  @foreach ($spareparts as $result)
                      <option value="{{ $result->id }}">{{ $result->part_no.' -- '.$result->name }} </option>
                  @endforeach
                </select>
              </td>
              <td>
              
                <select class="form-select " name="items[${rowIdx}][uom_id]" id="spartpart_id"   >
                  <option selected disabled value="">Choose uom</option>
                  @foreach ($uom as $result)
                      <option value="{{ $result->id }}">{{ $result->name }} </option>
                  @endforeach
                </select>
              </td>
              <td><input type="text" class="form-control" style="width:40px; text-align:center" name="items[${rowIdx}][quantity]"></td>
              <td><button type="button" class="removeRow form-control bg-danger text-light">X</button></td>
          `;
          rowIdx++;
      });

      document.getElementById('mtr').addEventListener('click', function (e) {
          if (e.target && e.target.classList.contains('removeRow')) {
              e.target.parentNode.parentNode.remove();
          }
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