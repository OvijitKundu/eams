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
            <h1>Operation Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Operation Edit</li>
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
                            <form action='{{ route('operation-update') }}' method="post"
                                class="row g-3 needs-validation" novalidate>
                                @csrf
                                <input type="hidden" name="id" value="{{ $operation->id }}">
                                <div class="row mt-5">

                                    <div class="col-3 text-end">
                                        <label for="operation_name" class="form-label formsrow">Operation Name <span
                                                style="color:red">*</span></label>
                                    </div>
                                    <div class="col-5 text-end">
                                        <input type="text" value="{{ $operation->operation_name }}"
                                            class="form-control formsrow" name ="operation_name" id="operation_name"
                                            required>
                                    </div>
                                    <div class="col-4"></div>

                                    <div class="col-3  text-end">
                                        <label for="description" class="form-label formsrow">Description <span
                                                style="color:red">*</span></label>
                                    </div>
                                    <div class="col-9 text-end">
                                        <input type="text" value="{{ $operation->description }}"
                                            class="form-control formsrow" name ="description" id="description" required>
                                    </div>
                                    <div class="col-4"></div>
                                </div>

                                <div class="col-12">
                                    <div class="row mb-3">
                                        <div class="col-3"></div>
                                        <div class="col-5">
                                            <button class="btn btn-success mybutton" type="submit">Update</button>

                                            <button class="btn btn-info mybutton"><a
                                                    href="{{ route('operation-view') }}"> Return</a></button>
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
