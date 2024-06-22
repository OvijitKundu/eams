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
          <li class="breadcrumb-item active">Workorder Approve or Decline</li>
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
                      <form action='{{ route('workorder-update') }}' method="post" class="row g-3 needs-validation" novalidate>
                          @csrf
                            <input type="text" name="id" value="{{ $workorder->id }}">
                            <div class="row mt-5">
                              <div class="col-3 text-end">
                                <label for="name" class="form-label   ">Workorder NO</label>
                              </div>
                              <div class="col-3">
                                <input type="text" value="{{ $workorder->workorder_no }}"  class="form-control woupdateRow   " name ="workorder_no" id="workorder_no"  required>
                              </div>
                              <div class="col-6"></div>
                              
                              <div class="col-3 text-end">
                                <label for="assetitem_id" class="form-label   ">Asset Details</label>
                              </div>
                              <div class="col-9">
                                <input type="text" value="{{ $workorder->assetitem->asset_no.' , '.$workorder->assetitem->categorymodel->name.' , '.$workorder->assetitem->categorymodel->categorytype->name }}"  class="form-control woupdateRow  " name ="assetitem_id" id="assetitem_id"  required>
                              </div>
                             
                              <div class="col-3 text-end">
                                <label for="failure_cause" class="form-label   ">Failure Cause</label>
                              </div>
                              <div class="col-9">
                                <input type="text" value="{{ $workorder->failure_cause }}"  class="form-control woupdateRow  " name ="failure_cause" id="failure_cause"  required>
                              </div>

                              <div class="col-3 text-end">
                                <label for="workorder_type" class="form-label   ">Workorder Type</label>
                              </div>
                              <div class="col-3">
                                <input type="text" value="{{ $workorder->workorder_type }}"  class="form-control  woupdateRow " name ="workorder_type" id="workorder_type"  required>
                              </div>
                              <div class="col-6"></div>

                              <div class="col-3 text-end">
                                <label for="priority" class="form-label   ">Priority</label>
                              </div>
                              <div class="col-3">
                                <input type="text" value="{{ $workorder->priority }}"  class="form-control woupdateRow  " name ="priority" id="priority"  required>
                              </div>
                              <div class="col-6"></div>

                              <div class="col-3 text-end">
                                <label for="before_efficiency" class="form-label   ">Efficiency Before Maint</label>
                              </div>
                              <div class="col-3">
                                <input type="text" value="{{ $workorder->before_efficiency .'%'}}"  class="form-control woupdateRow  " name ="before_efficiency" id="before_efficiency"  required>
                              </div>
                              <div class="col-6"></div>

                              <div class="col-3 text-end">
                                <label for="workshop_id" class="form-label   ">Workshop</label>
                              </div>
                              <div class="col-9">
                                <input type="text" value="{{ $workorder->workshop->name . ' , '.$workorder->workshop->address }}"  class="form-control woupdateRow  " name ="workshop_id" id="workshop_id"  required>
                              </div>
                             
                              <div class="col-3 text-end">
                                <label for="status" class="form-label   ">WO Mood</label>
                              </div>
                              <div class="col-2">
                                <input type="text" value="{{ $workorder->status }}"  class="form-control woupdateRow  " name ="status" id="status"  required>
                              </div>
                              <div class="col-7"></div>
                              <div class="col-3 text-end">
                                <label for="approval_stas" class="form-label   ">Approval Status</label>
                              </div>
                              <div class="col-3">
                               

                                <select class="form-select " name="approval_stas" id="approval_stas" required>
                                  <option selected disabled value="{{$workorder->approval_stas}}">Choose...</option>
                                  <option {{ $workorder->approval_stas=='Approved'?'selected':'' }} value="Approved">Approved</option>
                                  <option {{ $workorder->approval_stas=='Decline'?'selected':'' }}  value="Decline">Decline</option>
                                  <option {{ $workorder->approval_stas=='Pending'?'selected':'' }}  value="Pending">Pending</option>
                                </select>
                              </div>
                              

                              

                            </div>
                          </div>
                      
                          <div class="col-12">
                            <div class="row mb-3">
                              <div class="col-3"></div>
                              <div class="col-5">
                                <button class="btn btn-success mybutton" type="submit">Update</button>
                             
                                <button class="btn btn-info mybutton"><a href="{{ route('work_order_list') }}"> Return</a></button>
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