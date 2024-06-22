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
            <h1>Maintenanceschedule Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Maintenance Schedule create</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        @if (session('message'))
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
                            <form action='{{ route('maintenanceschdule-store') }}' method="post"
                                class="row g-3 needs-validation" novalidate>
                                @csrf

                                {{-- <input type="hidden" class="form-control my-border formsrow" value="1"
                                    name ="maintenance_asset_id" id="company_id"> --}}

                                <div class="row mt-5">

                                    <div class="col-3 text-end">
                                        <label for="name" class="form-label formsrow">Asset Number <span
                                                style="color:red">*</span></label>
                                    </div>

                                    <div class="col-5 text-end mb-2">


                                        <select class="form-select " name="assetitem_id" id="module" required>
                                            <option selected disabled value="">Choose Asset</option>
                                            @foreach ($assets as $asset)
                                                <option value="{{ $asset->id }}">{{ $asset->asset_no }} </option>
                                            @endforeach
                                        </select>


                                    </div>

                                    <div class="col-4"></div>

                                    <div class="col-3 text-end">
                                        <label for="meter_no" class="form-label formsrow">Maintain Date<span
                                                style="color:red">*</span></label>
                                    </div>
                                    <div class="col-5 text-end">
                                        <input type="date" placeholder="Maintain Date" class="form-control formsrow"
                                            name ="maintain_date" required>
                                    </div>

                                    <div class="col-4"></div>

                                    <div class="col-3  text-end">
                                        <label class="form-label formsrow">Maintain Status<span
                                                style="color:red">*</span></label>
                                    </div>
                                    <div class="col-9 text-end">
                                        <input type="text" placeholder="Status" class="form-control formsrow"
                                            name ="maintain_status" required>
                                    </div>

                                    {{-- <div class="col-4"></div> --}}

                                    <div class="col-3 text-end">
                                        <label class="form-label formsrow">Total Amount<span
                                                style="color:red">*</span></label>
                                    </div>
                                    <div class="col-9 text-end">
                                        <input type="number" placeholder="Total Amount" class="form-control formsrow"
                                            name ="total_amount" required>
                                    </div>

                                    <div class="col-3 text-end">
                                        <label class="form-label formsrow">Uom Id<span
                                                style="color:red">*</span></label>
                                    </div>
                                    {{-- <div class="col-9 text-end">
                                        <input type="number" placeholder="Uom Id" class="form-control formsrow"
                                            name ="uom_id" required>
                                    </div> --}}

                                    <div class="col-5 text-end mb-2">

                                        <select class="form-select " name="uom_id" id="module" required>
                                            <option selected disabled value="">Choose Uom</option>
                                            @foreach ($umos as $umo)
                                                <option value="{{ $umo->id }}">{{ $umo->name }} </option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="col-4"></div>

                                    <div class="col-3 text-end">
                                        <label class="form-label formsrow">Workshop Id<span
                                                style="color:red">*</span></label>
                                    </div>
                                    {{-- <div class="col-9 text-end">
                                        <input type="number" placeholder="workshop_id" class="form-control formsrow"
                                            name ="workshop_id" required>
                                    </div> --}}

                                    <div class="col-5 text-end mb-2">


                                        <select class="form-select " name="workshop_id" id="module" required>
                                            <option selected disabled value="">Choose Workshop</option>
                                            @foreach ($workshops as $workshop)
                                                <option value="{{ $workshop->id }}">{{ $workshop->name }} </option>
                                            @endforeach
                                        </select>


                                    </div>

                                    <div class="col-4"></div>

                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-3"></div>
                                        <div class="col-6"><button class="btn btn-primary "
                                                type="submit">Save</button></div>
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
                            <h5 class="card-title">Maintenance Schedule List</h5>

                            <!-- Table with stripped rows -->
                            <table id="datatable" class="table table-striped table-bordered datatable">
                                <thead>
                                    <tr class="text-center bg-dark text-light">

                                        {{-- 
                                        <th scope="col">Sl#</th>
                                        <th scope="col">id</th> 
                                        --}}

                                        <th scope="col">Asset No</th>
                                        <th scope="col">Maintain Date</th>
                                        <th scope="col">Maintain Status</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">Uom Id</th>

                                        <th scope="col">Actions</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($maintenanceschdule as $result)
                                        <tr>

                                            <td>{{ $result->assetitem->asset_no }}</td>
                                            <td>{{ $result->maint_date }}</td>
                                            <td>{{ $result->maint_sts }}</td>
                                            <td>{{ $result->totla_amount }}</td>
                                            <td>{{ $result->uom_id }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('maintenanceSchdule-edit', $result->id) }}"><span
                                                        class="badge rounded-pill text-bg-warning">Edit</span></a>

                                                <a onclick="return confirm('Are you sure to delete ?')"
                                                    href="{{ url('meter-delete/' . $result->id) }}"
                                                    class="badge rounded-pill text-bg-danger">Delete</a>

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
            $(document).ready(function() {
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
<script src="{{ asset('admin/assets/js/main.js') }}"></script>

</html>
