<!-- resources/views/pages/assetDisposePages/asset-dispose-approved-list.blade.php -->

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
      <h1>Approved Asset Dispose Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Approved Asset Dispose List</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->
  
  
    <section class="section">
      <div class="row">
          <div class="col-lg-12">
            <div class="card c-shadow">
              <div class="card-body">
                <h5 class="card-title">Approved Asset Dispose List</h5>
  
                <!-- Table with stripped rows -->
                <table id="datatable" class="table table-striped table-bordered datatable">
                  <thead>
                    <tr class="text-center bg-dark text-light">
                      <th scope="col">Workshop</th>
                      <th scope="col">Item Name</th>
                      <th scope="col">Category Model</th>
                      <th scope="col">Category Type</th>
                      <th scope="col">Remarks</th>
                      <th scope="col">Status</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($approvedAssetDisposeDetailsList as $detail)
                        <tr>
                            {{-- <th class="text-center" scope="row">{{  $loop->iteration }}</th> --}}

                            <td>{{  $detail->assetDisposeMst->workshop->name }}</td>
                            <td>{{  $detail->assetitemModel->asset_no }}</td>
                            <td>{{  $detail->assetitemModel->categorymodel->name}}</td>
                            <td>{{  $detail->assetitemModel->categorymodel->categorytype->name}}</td>
                            <td>{{  $detail->remarks }}</td>
                            <td>{{  $detail->assetDisposeMst->status }}</td>


                          <td class="text-center">
                            
                            <a href="{{ route('assetDispose-report', $detail->id) }}"<span class="badge rounded-pill text-white bg-dark">Show Report</span></a>

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
