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
    <h1>Maintenance Workbench Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Complete Workorder</li>
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
      <div class="card">
        <div class="row shadow">
          <div class="col-lg-12">
                <div class="card c-shadow">
                    <div class="card-body ">
                      
                        <input type="text" name="id" value="{{ $workorder->id }}">
                        <div class="row mt-3">
                          <div class="col-6"><h4>Step : 1 , Workorder Request </h4></div>
                          <div class="col-6 text-end"> <button class="btn btn-info mybutton"><a href="{{ route('workOrderApprovalPending') }}"> Return</a></button></div>
                          
                          
                          <div class="col-3 text-end">
                            <label for="name" class="form-label   ">Workorder NO</label>
                          </div>
                          <div class="col-3">
                            <input type="text" value="{{ $workorder->workorder_no }}"  class="form-control woupdateRow  m-0 p-0 " name ="workorder_no" id="workorder_no"  required>
                          </div>
                          <div class="col-6"></div>
                          
                          <div class="col-3 text-end">
                            <label for="assetitem_id" class="form-label   ">Asset Details</label>
                          </div>
                          <div class="col-9">
                            <input type="text" value="{{ $workorder->assetitem->asset_no.' , '.$workorder->assetitem->categorymodel->name.' , '.$workorder->assetitem->categorymodel->categorytype->name }}"  class="form-control woupdateRow m-0 p-0 " name ="assetitem_id" id="assetitem_id"  required>
                          </div>
                          
                          <div class="col-3 text-end">
                            <label for="failure_cause" class="form-label   ">Failure Cause</label>
                          </div>
                          <div class="col-9">
                            <input type="text" value="{{ $workorder->failure_cause }}"  class="form-control woupdateRow m-0 p-0 " name ="failure_cause" id="failure_cause"  required>
                          </div>

                          <div class="col-3 text-end">
                            <label for="workorder_type" class="form-label   ">Workorder Type</label>
                          </div>
                          <div class="col-3">
                            <input type="text" value="{{ $workorder->workorder_type }}"  class="form-control  woupdateRow m-0 p-0" name ="workorder_type" id="workorder_type"  required>
                          </div>
                          <div class="col-6"></div>

                          <div class="col-3 text-end">
                            <label for="priority" class="form-label   ">Priority</label>
                          </div>
                          <div class="col-3">
                            <input type="text" value="{{ $workorder->priority }}"  class="form-control woupdateRow  m-0 p-0" name ="priority" id="priority"  required>
                          </div>
                          <div class="col-6"></div>

                          <div class="col-3 text-end">
                            <label for="before_efficiency" class="form-label   ">Efficiency Before Maint</label>
                          </div>
                          <div class="col-3">
                            <input type="text" value="{{ $workorder->before_efficiency .'%'}}"  class="form-control woupdateRow m-0 p-0 " name ="before_efficiency" id="before_efficiency"  required>
                          </div>
                          <div class="col-6"></div>

                          <div class="col-3 text-end">
                            <label for="workshop_id" class="form-label   ">Workshop</label>
                          </div>
                          <div class="col-9">
                            <input type="text" value="{{ $workorder->workshop->name . ' , '.$workorder->workshop->address }}"  class="form-control woupdateRow  m-0 p-0" name ="workshop_id" id="workshop_id"  required>
                          </div>
                          
                          <div class="col-3 text-end">
                            <label for="status" class="form-label   ">WO Mood</label>
                          </div>
                          <div class="col-2">
                            <input type="text" value="{{ $workorder->status }}"  class="form-control woupdateRow m-0 p-0 " name ="status" id="status"  required>
                          </div>
                          <div class="col-7"></div>
                          <div class="col-3 text-end">
                            <label for="approval_stas" class="form-label   ">Approval Status</label>
                          </div>
                          <div class="col-3">
                            <input type="text" value="{{ $workorder->approval_stas }}"  class="form-control woupdateRow m-0 p-0 " name ="approval_stas" id="approval_stas"  required>
                          </div>
                        </div>
                      </div>
                        
                            
                          
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>

    <section class="section mt-2">
      <div class="card ">
        <div class="row mt-3 shadow">
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
                <form action="{{ route('workorder-maintenance-store') }}" method="post" class="row g-3 needs-validation" novalidate> 
                @csrf
                  <!-- Standard Operation -->
                  <h4>Step : 2 , Standard Operation </h4></div>
                  <input type="hidden" name="id" value="{{ $workorder->id }}">
                  <table class="table table-bordered" id="operationsTable">
                    <thead>
                        <tr>
                            <th>Resoulation</th>
                            <th>Operation Details</th>
                            <th>Resources</th>
                            <th>Time</th>
                            <th>Started</th>
                            <th>Ended</th>
                            <th><button type="button" class="btn btn-success " id="addRow">Add </button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="operations[0][resoulation]" class="form-control m-0 p-0 border border-dark" required></td>
                            <td>
                              <select class="form-select m-0 p-0"  name="operations[0][operation_id]"  id="operation_id"  required >
                                  <option selected disabled value="">Choose Operation</option>
                                    @foreach ($operations as $result)
                                        <option value="{{ $result->id }}">{{ $result->operation_name }} </option>
                                    @endforeach
                              </select>
                            
                            </td>

                            <td>
                              <select class="form-select m-0 p-0"  name="operations[0][member_id]" id="member_id"  required >
                                  <option selected disabled value="">Choose Operation</option>
                                    @foreach ($members as $result)
                                        <option value="{{ $result->id }}">{{ $result->name }} </option>
                                    @endforeach
                              </select>
                              
                            </td>
                            <td><input type="text" name="operations[0][duration]"  style="width:35px; text-align:center" class="form-control m-0 p-0 border border-dark" required></td>
                            <td><input type="date" name="operations[0][started_at]" class="form-control m-0 p-0" required></td>
                            <td><input type="date" name="operations[0][ended_at]" class="form-control m-0 p-0" required></td>
                            <td><button type="button" class="btn btn-danger removeRow p-0">X</button></td>
                        </tr>
                    </tbody>
                  </table>
                  <button type="submit" class="btn btn-primary">Submit</button>

                  <!-- Standard Operation -->
                  <!-- <div class="card c-shadow">
                    <div class="card-body">       
                      <div class="card p-1 mt-2 " style="border: 1px solid black; box-shadow: 0px 0px 
                        10px rgba(0, 0, 0, 0.1);">
                        <input type="text" name="id" value="{{ $workorder->id }}">
                        <h5 class="mt-2 mb-3">Step 2 : Standard Operataion</h5>
                        <div class="table-responsive">
                            <table id="op" class="table table-bordered">
                          
                              <thead>
                                <tr>
                                    <th>Resolution<span style="color:red;font-size:22px;">*</span></th>
                                    <th>Opearation Name<span style="color:red;font-size:22px;">*</span></th>
                                    <th>Resources<span style="color:red;font-size:22px;">*</span></th>
                                  
                                    <th >Time<span style="color:red;font-size:22px;" >*</span></th>
                                    <th >Started at<span style="color:red;font-size:22px;" >*</span></th>
                                    <th >Ended at<span style="color:red;font-size:22px;" >*</span></th>
                                    <th ><button type="button" class="btn btn-success" id="addRow">Add Row</button></th>
                                    <th><button type="button" class="m-0 p-0 form-control bg-info" id="addRowOP">Add</button></th>
                                </tr>
                              
                              </thead>
                              <tbody id="detailRows">
                                <tr>
                                    <td>
                                      <input type="text" class="form-control m-0 p-0" name="resoulation[]" > </td>
                                    <td>
                                      
                                      <select class="form-select m-0 p-0" name="operation_id[]"  id="operation_id"   >
                                          <option selected disabled value="">Choose Operation</option>
                                            @foreach ($operations as $result)
                                                <option value="{{ $result->id }}">{{ $result->operation_name }} </option>
                                            @endforeach
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-select m-0 p-0" name="member_id[]"  id="member_id"   >
                                        <option selected disabled value="">Choose Resource</option>
                                        @foreach ($members as $result)
                                            <option value="{{ $result->id }}">{{ $result->name }} </option>
                                        @endforeach
                                      </select>
                                    </td>
                                  
                                    <td>
                                      <input type="text" class="form-control m-0 p-0" style="width:35px" name="duration[]" >
                                    </td>

                                    <td>
                                      <input type="date" class="form-control m-0 p-0" style="width:115px"name="started_at[]" >
                                    </td>

                                    <td>
                                      <input type="date" class="form-control m-0 p-0" style="width:115px" name="ended_at[]" >
                                    </td>

                                    <td><button type="button" class="removeRow form-control bg-danger text-light m-0 p-0">X</button></td>
                                    <td><button type="button" class="btn btn-danger removeRow">Remove</button></td>
                                  </tr>
                                <button type="button" class="btn btn-success" id="addRow">Add Row..</button>
                              </tbody>
                            </table>
                        </div>
                      </div>
                    </div>
                  </div> -->
                  <!-- <div class="card c-shadow">
                    <div class="card-body">       
                      <div class="card p-1 mt-2 " style="border: 1px solid black; box-shadow: 0px 0px 
                        10px rgba(0, 0, 0, 0.1);">
                        <input type="text" name="id" value="{{ $workorder->id }}">
                        <h5 class="mt-2 mb-3">Step 2 : Standard Operataion</h5>
                        <div class="table-responsive">
                            <table id="op" class="table table-bordered">
                          
                              <thead>
                                <tr>
                                    <th>Resolution<span style="color:red;font-size:22px;">*</span></th>
                                    <th>Opearation Name<span style="color:red;font-size:22px;">*</span></th>
                                    <th>Resources<span style="color:red;font-size:22px;">*</span></th>
                                  
                                    <th >Time<span style="color:red;font-size:22px;" >*</span></th>
                                    <th >Started at<span style="color:red;font-size:22px;" >*</span></th>
                                    <th >Ended at<span style="color:red;font-size:22px;" >*</span></th>
                                    <th><button type="button" class="m-0 p-0 form-control bg-info" id="addRowOP">Add</button></th>
                                </tr>
                              
                              </thead>
                              <tbody>
                                <tr>
                                    <td>
                                      <input type="text" class="form-control m-0 p-0" name="wooperation[0][resoulation]"> </td>
                                    <td>
                                      
                                      <select class="form-select m-0 p-0" name="wooperation[0][resoulation]"  id="resoulation"   >
                                          <option selected disabled value="">Choose Operation</option>
                                            @foreach ($operations as $result)
                                                <option value="{{ $result->id }}">{{ $result->operation_name }} </option>
                                            @endforeach
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-select m-0 p-0" name="wooperation[0][member_id]"  id="member_id"   >
                                        <option selected disabled value="">Choose Resource</option>
                                        @foreach ($members as $result)
                                            <option value="{{ $result->id }}">{{ $result->name }} </option>
                                        @endforeach
                                      </select>
                                    </td>
                                  
                                    <td>
                                      <input type="text" class="form-control m-0 p-0" style="width:35px" name="wooperation[0][duration]">
                                    </td>

                                    <td>
                                      <input type="date" class="form-control m-0 p-0" style="width:115px" name="wooperation[0][started_at]">
                                    </td>

                                    <td>
                                      <input type="date" class="form-control m-0 p-0" style="width:115px" name="wooperation[0][ended_at]">
                                    </td>

                                    <td><button type="button" class="removeRow form-control bg-danger text-light m-0 p-0">X</button></td>
                                </tr>
                              </tbody>
                            </table>
                        </div>
                      </div>
                    </div>
                  </div> -->
                  <!-- Materials -->
                  <div class="card c-shadow">
                    <div class="card-body">       
                      <div class="card p-1 mt-2 " style="border: 1px solid black; box-shadow: 0px 0px 
                        10px rgba(0, 0, 0, 0.1);">
                        <h5 class="mt-2 mb-3">Step 3 : Materials Information</h5>
                        <div class="table-responsive">
                            <table id="mtr" class="table table-bordered">
                          
                              <thead>
                                <tr>
                                    <th>Activities Name<span style="color:red;font-size:22px;">*</span></th>
                                    <th>Opearation Name<span style="color:red;font-size:22px;">*</span></th>
                                    <th>Spareparts Name<span style="color:red;font-size:22px;">*</span></th>
                                    <th>UOM Name<span style="color:red;font-size:22px;">*</span></th>
                                    <th >Qty<span style="color:red;font-size:22px;" >*</span></th>
                                    <th><button type="button" class="m-0 p-0 form-control bg-info" id="addRowmtr">Add</button></th>
                                </tr>
                              </thead>
                              <tbody id="detailRows">
                                <tr>
                                    <td>
                                      <input type="text" class="form-control m-0 p-0" name="womaterials[0][activities]"> </td>
                                    <td>
                                      
                                      <select class="form-select m-0 p-0" name="womaterials[0][operation_id]"  id="operation_id"   >
                                          <option selected disabled value="">Choose Operation</option>
                                            @foreach ($operations as $result)
                                                <option value="{{ $result->id }}">{{ $result->operation_name }} </option>
                                            @endforeach
                                      </select>
                                    </td>
                                    <td>
                                    
                                      <select class="form-select m-0 p-0" name="womaterials[0][spartpart_id]" name="spartpart_id[]" id="spartpart_id"   >
                                        <option selected disabled value="">Choose Spareparts</option>
                                        @foreach ($spartparts as $result)
                                            <option value="{{ $result->id }}">{{ $result->part_no.' -- '.$result->name }} </option>
                                        @endforeach
                                      </select>
                                    </td>
                                    <td>
                                      
                                        <select class="form-select m-0 p-0" name="womaterials[0][uom_id]" name="uom_id[]" id="spartpart_id"   >
                                          <option selected disabled value="">Choose uom</option>
                                          @foreach ($uom as $result)
                                              <option value="{{ $result->id }}">{{ $result->name }} </option>
                                          @endforeach
                                        </select>
                                    </td>
                                    <td  ><input type="text" class="form-control m-0 p-0" style="width:40px; text-align:center" name="womaterials[0][quantity]"></td>
                                    <td><button type="button" class="removeRow form-control bg-danger text-light m-0 p-0">X</button></td>
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

  
  <!-- Standard operation -->
  <script>
    $(document).ready(function() {
        var rowCount = 1;

        $('#addRow').click(function() {
            $('#operationsTable tbody').append(`
                <tr>
                    <td><input type="text" name="operations[${rowCount}][resoulation]" class="form-control m-0 p-0 border border-dark"></td>
                    <td>
                      <select class="form-select m-0 p-0" name="operations[${rowCount}][operation_id]" id="operation_id"   >
                        <option selected disabled value="">Choose Operation</option>
                          @foreach ($operations as $result)
                              <option value="{{ $result->id }}">{{ $result->operation_name }} </option>
                          @endforeach
                      </select>
                      
                    </td>
                    <td>
                      <select class="form-select m-0 p-0" name="operations[${rowCount}][member_id]" id="operation_id"   >
                        <option selected disabled value="">Choose Resources</option>
                          @foreach ($members as $result)
                              <option value="{{ $result->id }}">{{ $result->name }} </option>
                          @endforeach
                      </select>
                     
                    </td>
                    <td><input type="text" name="operations[${rowCount}][duration]" style="width:35px;" class="form-control m-0 p-0 border border-dark"></td>
                    <td><input type="date" name="operations[${rowCount}][started_at]" class="form-control m-0 p-0"></td>
                    <td><input type="date" name="operations[${rowCount}][ended_at]" class="form-control m-0 p-0"></td>


                    <td><button type="button" class="btn btn-danger removeRow m-0 p-0">X</button></td>
                </tr>
            `);
            rowCount++;
        });

        $(document).on('click', '.removeRow', function() {
            $(this).closest('tr').remove();
        });
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