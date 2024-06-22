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
      <h1>Asset Dispose Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Asset Dispose</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->


    @if(session('message'))
      <script>
        Swal.fire({
        icon: "Success",
        title: "Wow...",
        text: "Asset Dispose Succssfully Generated!",
       
        })
      </script>
    @endif

    <section class="section">
            <div class="row">
                <div class="col-lg-12">
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

                            <form action="{{ route('assetDispose-store') }}" method="post" class="needs-validation" novalidate>
                                @csrf
                                <!-- Asset Dispose Master Fields -->
                                <div class="card p-3" style="border: 1px solid black; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                                  <h4>Asset Dispose Master</h4>
                                  <div class="row">
                                      <div class="col-md-6">
                                            <div class="form-group row mt-3">
                                                <label for="panel_members" class="col-sm-3 col-form-label text-end">Panel Members</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="panel_members" id="panel_members">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row mt-3">
                                                <label for="approver" class="col-sm-3 col-form-label text-end">Approver<span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <select class="form-select" name="approver" id="approver" required>
                                                        <option >Approver</option>
                                                        @foreach ($member as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
    
                                            {{-- <div class="form-group row mt-3">
                                                <label for="status" class="col-sm-3 col-form-label text-end">Status</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="status" id="status">
                                                </div>
                                            </div> --}}

                                            <div class="form-group row mt-3">
                                                <label for="workshop_id" class="col-sm-3 col-form-label text-end">Workshop<span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <select class="form-select" name="workshop_id" id="workshop_id" required>
                                                        <option >Workshop</option>
                                                        @foreach ($workShopName as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            {{-- <div class="form-group row mt-3">
                                                <label for="company_id" class="col-sm-3 col-form-label text-end">Company<span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                <select class="form-select" name="company_id" id="company_id" required>
                                                    <option >Company</option>
                                                    @foreach ($companyName as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                </div>
                                            </div> --}}

                                            {{-- <div class="form-group row mt-3">
                                                <label for="user_id" class="col-sm-3 col-form-label text-end">User<span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                <select class="form-select" name="user_id" id="user_id" required>
                                                    <option >User</option>
                                                    @foreach ($users as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                </div>
                                            </div> --}}
                                          
                                      </div>
                                  </div>
                                </div>

                                <!-- Asset Item PO Details Fields -->
                                <div class="card p-1 mt-2" style="border: 1px solid black; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                                    <h4>Asset Dispose Details</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Item Name</th>
                                                    <th>Remarks</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="detailRows">
                                                <tr>
                                                    <td>
                                                        <select class="form-select" name="assetitem_id[]" id="assetitem_id" required>
                                                            <option >Asset Item</option>
                                                            @foreach ($assetitems as $model)
                                                                <option value="{{ $model->id }}">{{ $model->asset_no.' -- '.$model->categorymodel->name .' -- '.$model->categorymodel->categorytype->name  }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                            
                                                    <td><input type="text" class="form-control" name="remarks[]" id="remarks" placeholder="Remarks" required></td>
                                                    
                                                    <td><button type="button" class="btn btn-danger removeRow">Remove</button></td>
                                                </tr>
                                            </tbody>
                                    
                                        </table>
                                    </div>
                                    
                                    <div class="text-center mt-3">
                                        <button type="button" class="btn btn-success" id="addRow">Add Row</button>
                                    </div>
                                </div>

                                <!-- Save Button -->
                                <div class="col-12 mt-4">
                                    <div class="row">
                                        <div class="col-3"></div>
                                        <div class="col-6 text-center">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
        document.addEventListener('DOMContentLoaded', (event) => {



            // Add row functionality
            document.getElementById('addRow').addEventListener('click', () => {
                const detailRows = document.getElementById('detailRows');
                const newRow = detailRows.children[0].cloneNode(true);
                newRow.querySelectorAll('input, select').forEach(input => input.value = '');
                detailRows.appendChild(newRow);

            });

            // Remove row functionality
            document.addEventListener('click', (event) => {
                if (event.target.classList.contains('removeRow')) {
                    event.target.closest('tr').remove();
  
                }
            });

            // Remove row functionality
            document.addEventListener('click', (event) => {
                if (event.target.classList.contains('removeRow')) {
                    event.target.closest('tr').remove();

                }
            });

        });
    </script>
  
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