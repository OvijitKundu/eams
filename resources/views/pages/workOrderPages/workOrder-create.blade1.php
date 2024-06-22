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
      <h1>Work Order Dashboard</h1>
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
               
            <!-- step 1 : asset basic informtion -->
            <form action="{{ route('workorder-store') }}" method="post" class="row g-3 needs-validation" novalidate>
                @csrf 
                <div class="card">

                
                  <h5 class="mt-4 mb-3">Step : 1, Basic Information of Asset</h5>

                  <input type="text" class="form-control my-border formsrow" value="{{$company[0]->id }}"  name ="company_id" id="company_id"  >

                  <div class="row">
                    <div class="col-3 mb-2 text-end"><label for="workorder_no"> Work Order No</label></div>
                    <div class="col-3 mb-2 text-end">
                      <input type="text" placeholder="workorder_no" class="form-control formsrow" name ="workorder_no" id="workorder_no"    >
                    </div>
                    <div class="col-6"></div>

                    <div class="col-3 text-end"><label for="assetitem_id"> Asset Details</label></div>
                    <div class="col-9  mb-2 text-end">

                      <select class="form-select "  name="assetitem_id" id="assetitem_id"   >
                        <option selected disabled value="">Choose Asset</option>
                        @foreach ($assetitem as $result)
                            <option value="{{ $result->id }}">{{ $result->asset_no.' -- '.$result->categorymodel->name .' -- '.$result->categorymodel->categorytype->name}} </option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-3 text-end"><label for="workshop_id"> Workshop</label></div>
                    <div class="col-9 mb-2 text-end">

                      <select class="form-select "  name="workshop_id" id="workshop_id"   >
                        <option selected disabled value="">Choose Workshop</option>
                        @foreach ($workshop as $result)
                            <option value="{{ $result->id }}">{{ $result->name}} </option>
                        @endforeach
                      </select>
                    
                    </div>

                    <div class="col-3 text-end"><label for="failure_cause"> Failure Cause</label></div>
                    <div class="col-9 mb-2 text-end">
                      <input type="text" placeholder="failure_cause" class="form-control formsrow" name ="failure_cause" id="failure_cause"    >
                    </div>

                    <div class="col-3 text-end"><label for="priority"> Priority</label></div>
                    <div class="col-3 mb-2 text-start">
                      <select name="priority" id="priority">
                        <option value="Urgent">Urgent</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                      </select>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-3 mb-2 text-end"><label for="workorder_type"> Work Order Type</label></div>
                    <div class="col-2  text-start">
                      <select name="workorder_type" id="workorder_type">
                        <option value="Corrective">Corrective</option>
                        <option value="Preventive">Preventive</option>
                        <option value="Regular">Regular</option>
                      </select>
                    </div>

                    <div class="col-3 text-end"><label for="before_efficiency">Efficiency %( Before)</label></div>
                    <div class="col-2 mb-2 text-end">
                      <input type="text" placeholder="Efficiency before maintenance" class="form-control formsrow" name ="before_efficiency" id="before_efficiency"    >
                    </div>
                    <div class="col-2"></div>

                    <div class="col-3 text-end"><label for="after_efficiency">Efficiency %( After)</label></div>
                    <div class="col-2  mb-2 text-end">
                      <input type="text" placeholder="Efficiency After maintenance" class="form-control formsrow" name ="after_efficiency" id="after_efficiency"    >
                    </div>

                    <div class="col-3 text-end"><label for="approve_stats_by">Approve by</label></div>
                    <div class="col-9 mb-2 text-end">
                      <input type="text" placeholder="Approve By" class="form-control formsrow" name ="approve_stats_by" id="approve_stats_by"    >
                    </div>

                  </div>

                  Materials
                  <div id="materials">
                      <div class="material">
                  <table class="table" id="products_table">
                        <thead>
                            <tr>
                                <th class="m-0 p-0" >workorder_id</th>
                                <th class="m-0 p-0" >operation_id</th>
                                <th class="m-0 p-0" >activities</th>
                                <th class="m-0 p-0" >spartpart_id</th>
                                <th class="m-0 p-0" >quantity</th>
                                <th class="m-0 p-0" >company</th>
                                <th class="m-0 p-0" >user</th>
                                <th class="m-0 p-0" >uom_id</th>

                            </tr>
                        </thead>

                        womaterials
                        <tbody>
                            <tr id="product0" class="m-0 p-0">
                                <!-- <td style="" class="m-0 p-0">
                                  
                                    <select class="form-select "  name="workorder_id[]" id="workorder_id"   >
                                        <option selected disabled value="">Choose Woek order</option>
                                        @foreach ($workorder as $result)
                                            <option value="{{ $result->id }}">{{ $result->workorder_no.' -- '.$result->user->name}} </option>
                                        @endforeach
                                    </select>

                                </td> -->
                                <td style="" class="m-0 p-0">

                                <select class="form-select " name="materials[0][operation_id]" name="operation_id[]" id="operation_id"   >
                                  <option selected disabled value="">Choose Operation</option>
                                    @foreach ($operations as $result)
                                        <option value="{{ $result->id }}">{{ $result->operation_name }} </option>
                                    @endforeach
                                </select>
                                </td>
                                <td style="" class="m-0 p-0">
                                    <input type="text" name="materials[0][activities]" name="activities[]" class="form-control text-center m-0 p-0" value="1" />
                                </td>
                                <td style="" class="m-0 p-0">
                                  
                                  <select class="form-select " name="materials[0][spartpart_id]" name="spartpart_id[]" id="spartpart_id"   >
                                    <option selected disabled value="">Choose Spareparts</option>
                                    @foreach ($spareparts as $result)
                                        <option value="{{ $result->id }}">{{ $result->part_no.' -- '.$result->name }} </option>
                                    @endforeach
                                  </select>
                                </td>

                                <td style="" class="m-0 p-0">
                                    <input type="number" name="materials[0][quantity]" name="quantity[]" class="form-control text-center m-0 p-0" value="1" />
                                </td>


                                <td style="" class="m-0 p-0">
                                    <select class="form-select " name="materials[0][uom_id]" name="uom_id[]" id="spartpart_id"   >
                                    <option selected disabled value="">Choose uom</option>
                                    @foreach ($uom as $result)
                                        <option value="{{ $result->id }}">{{ $result->name }} </option>
                                    @endforeach
                                  </select>
                                </td>

                              

                            </tr>
                            <tr id="product1"></tr>
                        </tbody>
                  </table>
                  </div>
                  </div>
                  <!-- <div id="materials">
                      <div class="material">
                          <label for="workorder_id">WOID:</label>
                          <input type="text" placeholder="WO" name="materials[0][workorder_id]" id="workorder_id">
                          
                          <label for="quantity">qty:</label>
                          <input type="text" name="materials[0][quantity]" id="quantity">

                          <label for="operation_id">op:</label>
                          <input type="text" name="materials[0][operation_id]" id="operation_id">


                          
                          <label for="activities">act:</label>
                          <input type="text" name="materials[0][activities]" id="activities">
                          <label for="spartpart_id">sp:</label>
                          <input type="text" name="materials[0][spartpart_id]" id="spartpart_id">
                          <label for="uom_id">uom:</label>
                          <input type="text" name="materials[0][uom_id]" id="uom_id">
                      </div>
                  </div> -->

                 
                  <button type="button" onclick="addMaterial()">Add Material</button>

                  <div class="row ">
                      <div class="col-md-1"></div>
                      <div class="col-md-1 m-0 p-0"><input class="bg-primary border border-0 text-light" type="submit" value="{{ trans('Save') }}"></div>
                      <div class="col-md-7"></div>

                      <div class="col-md-1 m-0 p-0"><button id='delete_row' class="bg-danger border border-0 text-light">Delete</button></div>
                      <div class="col-md-1 m-0 p-0"><button id="add_row" class=" bg-primary border border-0 text-light">Add</button></div>
                      <div class="col-md-1 "></div>
                  </div>
                  
                  <div class="col-12 mb-2">
                    <div class="row">
                      <div class="col-3"></div>
                      <div class="col-6"><button class="btn btn-success " type="submit">Create Work Order</button></div>
                    </div>  
                  </div>
                </div>

                
            </form>
            <!-- <form action=" {{route('wooperation-store') }}" -->
            <form action="{{ route('wooperation-store') }}" method="post" class="row g-3 needs-validation" novalidate>
                @csrf             
                <div class="card">

                
                  <h5 class="mt-4 mb-3">Step : 2, Standard Operation</h5>

                  <input type="hidden" class="form-control my-border formsrow" value="{{$company[0]->id }}"  name ="company_id" id="company_id"  >

                 

                  <div class="row">
                    <div class="col-3 mb-2 text-end"><label for="workorder_id"> Work Order No</label></div>
                    <div class="col-3 mb-2 text-end">

                    <select class="form-select "  name="workorder_id" id="workorder_id"   >
                        <option selected disabled value="">Choose Woek order</option>
                        @foreach ($workorder as $result)
                            <option value="{{ $result->id }}">{{ $result->workorder_no.' -- '.$result->user->name}} </option>
                        @endforeach
                    </select>

                     
                    </div>
                    <div class="col-6"></div>

                    <div class="col-3 text-end"><label for="resoulation"> Resoulation</label></div>
                    <div class="col-9  mb-2 text-end">
                      <input type="text" placeholder="resoulation" class="form-control formsrow" name ="resoulation" id="resoulation"    >
                    </div>

                    <div class="col-3 text-end"><label for="operation_id"> Operatrion</label></div>
                    <div class="col-9 mb-2 text-end">

                      <select class="form-select "  name="operation_id" id="operation_id"   >
                        <option selected disabled value="">Choose Operation</option>
                        @foreach ($operations as $result)
                            <option value="{{ $result->id }}">{{ $result->operation_name.' -- '. $result->description}} </option>
                        @endforeach
                      </select>
                    
                     
                    </div>

                    <div class="col-3 text-end"><label for="no_of_engineer"> Number of Person</label></div>
                    <div class="col-2 mb-2 text-end">
                      <input type="text" placeholder="no_of_engineer" class="form-control formsrow" name ="no_of_engineer" id="no_of_engineer"    >
                    </div>
                    <div class="col-7"></div>

                    <div class="col-3 text-end"><label for="started_at"> Started Time</label></div>
                    <div class="col-3 mb-2 text-end">
                      <input type="date" placeholder="started_at" class="form-control formsrow" name ="started_at" id="started_at"    >
                    </div>

                    <div class="col-3 text-end"><label for="ended_at"> Ended Time</label></div>
                    <div class="col-3 mb-2 text-end">
                      <input type="date" placeholder="ended_at" class="form-control formsrow" name ="ended_at" id="ended_at"    >
                    </div>

                  </div>

                
                  
                  <div class="col-12 mb-2">
                    <div class="row">
                      <div class="col-3"></div>
                      <div class="col-6"><button class="btn btn-success " type="submit">Set Operation</button></div>
                    </div>  
                  </div>
                </div>
            </form>
            
             <!-- step 3 : Materials on  maintenance -->
             <form action="{{ route('womaterial-store') }}" method="post" class="row g-3 needs-validation" novalidate>
                @csrf
                <!-- <div class="card mt-4">

                
                  <h5 class="mt-4 mb-3">Step : 3, Maintenance Materials</h5>

                  <input type="hidden" class="form-control my-border formsrow" value="{{$company[0]->id }}"  name ="company_id" id="company_id"  >

                  
                  <table class="table" id="products_table">
                      <thead>
                          <tr>
                              <th class="m-0 p-0" >workorder_id</th>
                              <th class="m-0 p-0" >operation_id</th>
                              <th class="m-0 p-0" >activities</th>
                              <th class="m-0 p-0" >spartpart_id</th>
                              <th class="m-0 p-0" >quantity</th>
                              <th class="m-0 p-0" >company</th>
                              <th class="m-0 p-0" >user</th>
                              <th class="m-0 p-0" >uom_id</th>

                          </tr>
                      </thead>

                     
                      <tbody>
                          <tr id="product0" class="m-0 p-0">
                              <td style="" class="m-0 p-0">
                                 
                                  <select class="form-select "  name="workorder_id[]" id="workorder_id"   >
                                      <option selected disabled value="">Choose Woek order</option>
                                      @foreach ($workorder as $result)
                                          <option value="{{ $result->id }}">{{ $result->workorder_no.' -- '.$result->user->name}} </option>
                                      @endforeach
                                  </select>

                              </td>
                              <td style="" class="m-0 p-0">

                              <select class="form-select "  name="operation_id[]" id="operation_id"   >
                                <option selected disabled value="">Choose Operation</option>
                                  @foreach ($operations as $result)
                                      <option value="{{ $result->id }}">{{ $result->operation_name }} </option>
                                  @endforeach
                              </select>
                              </td>
                              <td style="" class="m-0 p-0">
                                  <input type="text" name="activities[]" class="form-control text-center m-0 p-0" value="1" />
                              </td>
                              <td style="" class="m-0 p-0">
                                
                                <select class="form-select "  name="spartpart_id[]" id="spartpart_id"   >
                                  <option selected disabled value="">Choose Spareparts</option>
                                  @foreach ($spareparts as $result)
                                      <option value="{{ $result->id }}">{{ $result->part_no.' -- '.$result->name }} </option>
                                  @endforeach
                                </select>
                              </td>

                              <td style="" class="m-0 p-0">
                                  <input type="number" name="quantity[]" class="form-control text-center m-0 p-0" value="1" />
                              </td>

                              <td style="" class="m-0 p-0">
                                  <input type="number" name="company_id[]" class="form-control text-center m-0 p-0" value="1" />
                              </td>

                              <td style="" class="m-0 p-0">
                                  <input type="number" name="user_id[]" class="form-control text-center m-0 p-0" value="1" />
                              </td>

                              <td style="" class="m-0 p-0">
                                  <select class="form-select "  name="uom_id[]" id="spartpart_id"   >
                                  <option selected disabled value="">Choose uom</option>
                                  @foreach ($uom as $result)
                                      <option value="{{ $result->id }}">{{ $result->name }} </option>
                                  @endforeach
                                </select>
                              </td>

                            

                          </tr>
                          <tr id="product1"></tr>
                      </tbody>
                  </table>
                  <div class="row ">
                      <div class="col-md-1"></div>
                      <div class="col-md-1 m-0 p-0"><input class="bg-primary border border-0 text-light" type="submit" value="{{ trans('Save') }}"></div>
                      <div class="col-md-7"></div>

                      <div class="col-md-1 m-0 p-0"><button id='delete_row' class="bg-danger border border-0 text-light">Delete</button></div>
                      <div class="col-md-1 m-0 p-0"><button id="add_row" class=" bg-primary border border-0 text-light">Add</button></div>
                      <div class="col-md-1 "></div>
                  </div>
                
                  
                  <div class="col-12 mb-2">
                    <div class="row">
                      <div class="col-3"></div>
                      <div class="col-6"><button class="btn btn-success " type="submit">Set Operation</button></div>
                    </div>  
                  </div>
                </div> -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

 
 

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
                @if(session('message1'))
                  <script>
                    Swal.fire({
                    icon: "Success",
                    title: "Wow...",
                    text: "Operation Succssfully Tagged!",
                  
                    })
                  </script>
                @endif

            <!-- step 4 : Work Permit -->
            <form action='{{ route('asset-store') }}' method="post" class="row g-3 needs-validation" novalidate>
                @csrf
                 <div class="card mt-4">

                
                  <h5 class="mt-4 mb-3">Step : 4, Work Permit</h5>

                  <input type="hidden" class="form-control my-border formsrow" value="{{$company[0]->id }}"  name ="company_id" id="company_id"  >

                  <!-- `title`, `permissionNote`, `started_at`, `ended_at`, `panel_memebers`, `superVisor`, `user_id`, `workorder_id`, `updated_by`, `created_at`, `updated_at` -->

                  <div class="row">
                    <div class="col-3 mb-2 text-end"><label for="workorder_id"> Work Order No</label></div>
                    <div class="col-3 mb-2 text-end">
                      <input type="text" placeholder="workorder_id" class="form-control formsrow" name ="workorder_id" id="workorder_id"    >
                    </div>
                    <div class="col-3 mb-2 text-end"><label for="title"> Title</label></div>
                    <div class="col-3 mb-2 text-end">
                      <input type="text" placeholder="title" class="form-control formsrow" name ="title" id="title"    >
                    </div>

                    <div class="col-3 text-end"><label for="panel_memebers"> Panel Members</label></div>
                    <div class="col-9  mb-2 text-end">
                      <input type="text" placeholder="panel_memebers" class="form-control formsrow" name ="panel_memebers" id="panel_memebers"    >
                    </div>

                    <div class="col-3 text-end"><label for="superVisor"> SuperVisor</label></div>
                    <div class="col-9 mb-2 text-end">
                      <input type="text" placeholder="superVisor" class="form-control formsrow" name ="superVisor" id="superVisor"    >
                    </div>
                   
                    <div class="col-3 text-end"><label for="started_at"> Started Time</label></div>
                    <div class="col-3 mb-2 text-end">
                      <input type="date" placeholder="started_at" class="form-control formsrow" name ="started_at" id="started_at"    >
                    </div>

                    <div class="col-3 text-end"><label for="ended_at"> Ended Time</label></div>
                    <div class="col-3 mb-2 text-end">
                      <input type="date" placeholder="ended_at" class="form-control formsrow" name ="ended_at" id="ended_at"    >
                    </div>

                    <div class="col-3 text-end"><label for="permissionNote"> Permit Note</label></div>
                    <div class="col-9"> 
                      <textarea id="w3review" name="w3review" rows="14" cols="60">
                      At w3schools.com you will learn how to make a website. They offer free tutorials in all web development technologies.
                      </textarea>
                    </div>
                    
                  </div>

                  <div class="col-12 mb-2">
                    <div class="row">
                      <div class="col-3"></div>
                      <div class="col-6"><button class="btn btn-success " type="submit">Set Operation</button></div>
                    </div>  
                  </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
    
  <!-- <section class="section">
    <div class="row">
        <div class="col-lg-12">
          <div class="card c-shadow">
            <div class="card-body">
              <h5 class="card-title">Asset List</h5>

              
              <table id="datatable" class="table table-striped table-bordered datatable">
                <thead>
                  <tr class="text-center bg-dark text-light">

                    <th scope="col">ID</th>
                    <th scope="col">Category</th>
                    <th scope="col">Sub-Category</th>
                    <th scope="col">Model</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Asset No</th>
                    <th scope="col">Manufacture No</th>
                    <th scope="col">Action</th>

                  </tr>
                </thead>
                <tbody>
                  @foreach ($assetitem as $result)
                      <tr>
                          
                          <td>{{  $result->id }}</td>
                          
                          <td>{{  $result->categorymodel->categorytype->category->name }}</td>
                          <td>{{  $result->categorymodel->categorytype->name }}</td>
                          <td>{{  $result->categorymodel->name }}</td>
                          <td>{{  $result->brand->name }}</td>
                          <td>{{  $result->asset_no }}</td>
                          <td>{{  $result->manufacture_no }}</td>
                          
                          <td class="text-center">
                              <a href="{{ route('asset-edit',$result->id) }}"><span class="badge rounded-pill text-bg-warning">Edit</span></a>
                              
                          
                              <a onclick="return confirm('Are you sure to delete ?')" href="{{ url('asset-delete/'.$result->id) }}" class="badge rounded-pill text-bg-danger">Delete</a>
                              
                          </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
             
              <div class="pages">
              </div>
            </div>
      </div>
    </div>
  </section> -->




  
  
  <!-- bootstrap5 dataTables js cdn -->
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
  <script>
    let materialIndex = 1;

    function addMaterial() {
        const materialsDiv = document.getElementById('materials');
        const newMaterial = document.createElement('div');
        newMaterial.classList.add('material');
        newMaterial.innerHTML = `
            // <label for="workorder_id">wo Name:</label>
            // <input type="text" name="materials[${materialIndex}][workorder_id]" id="workorder_id">

            <label for="quantity">qty:</label>
            <input type="text" name="materials[${materialIndex}][quantity]" id="quantity">

            <label for="operation_id">op:</label>
            <input type="text" name="materials[${materialIndex}][operation_id]" id="operation_id">

            <label for="activities">act:</label> 
            <input type="text" name="materials[${materialIndex}][activities]" id="activities">
            
            <label for="spartpart_id">sp:</label>
            <input type="text" name="materials[${materialIndex}][spartpart_id]" id="spartpart_id">

            <label for="uom_id">uom:</label>
            <input type="text" name="materials[${materialIndex}][uom_id]" id="uom_id">

            
        `;
        materialsDiv.appendChild(newMaterial);
        materialIndex++;
    }
  </script>




<script>
 
    $(document).ready(function(){
    let row_number = 1;
    $("#add_row").click(function(e){
      e.preventDefault();
      let new_row_number = row_number - 1;
      $('#product' + row_number).html($('#product' + new_row_number).html()).find('td:first-child');
      $('#products_table').append('<tr id="product' + (row_number + 1) + '"></tr>');
      row_number++;
    });

    $("#delete_row").click(function(e){
      e.preventDefault();
      if(row_number > 1){
        $("#product" + (row_number - 1)).html('');
        row_number--;
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