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
            <h1>Maintenanceschedule Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Maintenanceschedule Edit</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        @if (session('message'))
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
                            <form action='{{ route('maintenanceschdule-update') }}' method="post"
                                class="row g-3 needs-validation" novalidate>
                                @csrf
                                <input type="hidden" name="id" value="{{ $maintenanceschdule->id }}">
                                <div class="row mt-5">

                                    <div class="col-3 text-end">
                                        <label class="form-label formsrow">Maintain Date<span
                                                style="color:red">*</span></label>
                                    </div>
                                    <div class="col-5 text-end">
                                        <input type="date" value="{{ $maintenanceschdule->maint_date }}"
                                            class="form-control formsrow" name ="maintain_date" required>
                                    </div>
                                    <div class="col-4"></div>

                                    <div class="col-3  text-end">
                                        <label for="address" class="form-label formsrow">Status<span
                                                style="color:red">*</span></label>
                                    </div>
                                    <div class="col-9 text-end">
                                        <input type="text" value="{{ $maintenanceschdule->maint_sts }}"
                                            class="form-control formsrow" name ="maintain_status" required>
                                    </div>

                                    {{-- <div class="col-4"></div> --}}

                                    <div class="col-3  text-end">
                                        <label class="form-label formsrow">Total Amount<span
                                                style="color:red">*</span></label>
                                    </div>
                                    <div class="col-9 text-end">
                                        <input type="number" value="{{ $maintenanceschdule->totla_amount }}"
                                            class="form-control formsrow" name ="total_amount" required>
                                    </div>

                                    <div class="col-4"></div>

                                </div>

                                <div class="col-12">
                                    <div class="row mb-3">
                                        <div class="col-3"></div>
                                        <div class="col-5">
                                            <button class="btn btn-success mybutton" type="submit">Update</button>

                                            <button class="btn btn-info mybutton"><a
                                                    href="{{ route('maintenanceschdule-view') }}">
                                                    Return</a></button>
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
<script src="{{ asset('admin/assets/js/main.js') }}"></script>

</html>
