<!-- resources/views/pages/assetDisposePages/asset-dispose-edit.blade.php -->

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
      <h1>Asset Dispose Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Asset Dispose Approve or Decline</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    @if(session('message'))
      <script>
        Swal.fire({
        icon: "success",
        title: "Wow...",
        text: "{{ session('message') }}",
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
                      <form action='{{ route('assetDispose-update') }}' method="post" class="row g-3 needs-validation" novalidate>
                          @csrf
                          <input type="hidden" name="id" value="{{ $assetDisposeMst->id }}">
                          
                          <div class="row mt-5">
                              <div class="col-3 text-end">
                                <label for="panel_members" class="form-label formsrow">Panel Members</label>
                              </div>
                              <div class="col-5 text-end">
                                <input type="text" value="{{ $assetDisposeMst->panel_members }}" class="form-control formsrow" name="panel_members" id="panel_members" disabled>
                              </div>
                              <div class="col-4"></div>
            
                              <div class="col-3 text-end">
                                <label for="approver" class="form-label formsrow">Approver</label>
                              </div>
                              <div class="col-9 text-end">
                                <input type="text" value="{{ $assetDisposeMst->approver }}" class="form-control formsrow" name="approver" id="approver" disabled>
                              </div>
                              
                              <div class="col-3 text-end">
                                <label for="status" class="form-label formsrow">Status</label>
                              </div>
                              <div class="col-5 text-end">
                                <input type="text" value="{{ $assetDisposeMst->status }}" class="form-control formsrow" name="status" id="status" disabled>
                              </div>
                              <div class="col-4"></div>
                              
                              <div class="col-3 text-end">
                                <label for="remarks" class="form-label formsrow">Remarks</label>
                              </div>
                              <div class="col-5 text-end">
                                @foreach ($assetDisposeMst->details as $detail)
                                    <input type="text" value="{{ $detail->remarks }}" class="form-control formsrow" name="remarks[]" id="remarks" disabled>
                                @endforeach
                              </div>
                              <div class="col-4"></div>


                              <div class="col-3 text-end">
                                <label for="approval_status" class="form-label">Approval Status</label>
                              </div>
                              <div class="col-3">
                                <select class="form-select" name="approval_status" id="approval_status" required>
                                  <option selected disabled value="{{ $assetDisposeMst->status }}">Choose...</option>
                                  <option {{ $assetDisposeMst->status=='Approved'?'selected':'' }} value="Approved">Approved</option>
                                  <option {{ $assetDisposeMst->status=='Declined'?'selected':'' }} value="Declined">Declined</option>
                                  <option {{ $assetDisposeMst->status=='Pending'?'selected':'' }} value="Pending">Pending</option>
                                </select>
                              </div>
                          </div>
                          
                          <div class="col-12">
                            <div class="row mb-3">
                              <div class="col-3"></div>
                              <div class="col-5">
                                <button class="btn btn-success mybutton" type="submit">Update</button>
                                <button class="btn btn-info mybutton"><a href="{{ route('assetDispose-list') }}">Return</a></button>
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

<!-- Template Main JS File -->
<script src="{{ asset("admin/assets/js/main.js")}}"></script>
</body>
</html>
