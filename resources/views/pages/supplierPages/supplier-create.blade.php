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
      <h1>Supplier Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Supplier create</li>
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
            <form action='{{ route('supplier-store') }}' method="post" class="row g-3 needs-validation" novalidate>
                @csrf
                <input type="hidden" class="form-control my-border formsrow" value="{{$company[0]->id }}"  name ="company_id" id="company_id"  >
                <div class="row mt-5">
                 
                  <div class="col-3 text-end">
                    <label for="name" class="form-label formsrow">Supplier Name <span style="color:red">*</span></label>
                  </div>
                  <div class="col-5 text-end">
                    <input type="text" placeholder="Supplier name" class="form-control formsrow" name ="name" id="name"  required>
                  </div>
                  <div class="col-4"></div>

                  <div class="col-3  text-end">
                    <label for="address" class="form-label formsrow">Address <span style="color:red">*</span></label>
                  </div>
                  <div class="col-9 text-end">
                    <input type="text" placeholder="address" class="form-control formsrow" name ="address" id="address"  required>
                  </div>
                  
                  <div class="col-3 text-end">
                    <label for="contactno" class="form-label formsrow">Contact No <span style="color:red">*</span></label>
                  </div>
                  <div class="col-5  text-end">
                    <input type="text" placeholder="contactno" class="form-control formsrow" name ="contactno" id="contactno"  required>
                  </div>
                  <div class="col-md-4"></div>

                  <div class="col-3 text-end">
                    <label for="email" class="form-label formsrow">Email</label>
                  </div>
                  <div class="col-5  text-end">
                    <input type="text" placeholder="email" class="form-control formsrow" name ="email" id="email"  required>
                  </div>
                  <div class="col-4"></div>

                  <div class="col-3 text-end">
                    <label for="website" class="form-label formsrow">Website</label>
                  </div>
                  <div class="col-5  text-end">
                    <input type="text" placeholder="website" class="form-control formsrow" name ="website" id="website"  required>
                  </div>
                  <div class="col-4"></div>
                  

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
              <h5 class="card-title">Supplier List</h5>

              <!-- Table with stripped rows -->
              <table id="datatable" class="table table-striped table-bordered datatable">
                <thead>
                  <tr class="text-center bg-dark text-light">

                    {{-- <th scope="col">Sl#</th>
                    <th scope="col">id</th> --}}
                    <th scope="col">Supplier Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Contact No</th>
                    <th scope="col">Email</th>
                    <th scope="col">Website</th>
                    <th scope="col">Compnay</th>
                    <th scope="col">Creator</th>
                   
                    <th scope="col">Actions</th>

                  </tr>
                </thead>
                <tbody>
                  @foreach ($supplier as $result)
                      <tr>
                          {{-- <th class="text-center" scope="row">{{  $loop->iteration }}</th>
                          <td>{{  $result->id }}</td>  --}}
                          <td>{{  $result->name }}</td>
                          <td>{{  $result->address }}</td>
                          <td>{{  $result->contactno }}</td>
                          <td>{{  $result->email }}</td>
                          <td>{{  $result->website }}</td>
                          <td>{{  $result->company->name }}</td>
                          <td>{{  $result->user->name }}</td>
                          <td class="text-center">
                              <a href="{{ route('supplier-edit',$result->id) }}"><span class="badge rounded-pill text-bg-warning">Edit</span></a>
                              
                          
                              <a onclick="return confirm('Are you sure to delete ?')" href="{{ url('supplier-delete/'.$result->id) }}" class="badge rounded-pill text-bg-danger">Delete</a>
                              
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