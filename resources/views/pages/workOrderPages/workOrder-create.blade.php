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
      <h1>Maintenance Workbench Dashboard</h1>
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
                  <div class="row mt-4 mb-2 ">
                    
                  <h5 class="mt-2">Step : 1, Request Workorder</h5>

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
                    <div class="col-6 mb-2 text-end">
                      <select class="form-select "  name="approve_stats_by" id="approve_stats_by"   >
                        <option selected disabled value="">Choose Approver</option>
                        @foreach ($members as $result)
                            <option value="{{ $result->name }}">{{ $result->name}} </option>
                        @endforeach
                      </select>
                    <div class="col-3"></div>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-3"></div>
                    <div class="col-2">
                      <div class=""> <button class="form-control bg-success text-light"  
                          type="submit">Save </button>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </form>
      </div>
    </div>
  </section>
    

  <section class="section">
    <div class="row">
        <div class="col-lg-12">
          <div class="card c-shadow">
            <div class="card-body">
              <h5 class="card-title">Draft Workorder List</h5>

              <!-- Table with stripped rows -->
              <table id="datatable" class="table table-striped table-bordered datatable">
                <thead>
                  <tr class="text-center bg-dark text-light">
                    <th scope="col">id</th>
                    <th scope="col">WO NO</th>
                    <th scope="col">Asset Detail</th>
                    <th scope="col">Cause</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Before Efficiency</th>
                    <th scope="col">Approver</th>
                    <th scope="col">Workshop</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($org_workorder as $result)
                      <tr>
                          
                          <td>{{  $result->id }}</td> 
                          <td>{{  $result->workorder_no }}</td> 
                          <td>{{  $result->assetitem->asset_no }}</td> 
                          <td>{{  $result->failure_cause }}</td> 
                          <td>{{  $result->priority }}</td> 
                          <td>{{  $result->before_efficiency.'%' }}</td> 
                          <td>{{  $result->approve_stats_by }}</td> 
                        
                          <td>{{  $result->workshop->name.'-'.$result->workshop->address }}</td> 
                        
                          <td class="text-center">
                              <a href="{{ route('workorder-edit',$result->id) }}"><span class="badge rounded-pill text-bg-info">Edit</span></a>
                              
                          
                              <a onclick="return confirm('Are you sure to delete ?')" href="{{ url('workorder-delete-creator/'.$result->id) }}" class="badge rounded-pill text-bg-danger">Delete</a>
                              
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