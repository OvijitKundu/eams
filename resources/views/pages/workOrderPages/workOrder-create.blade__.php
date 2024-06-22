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

                <div>
            <label for="column1">Column1</label>
            <input type="text" name="column1" id="column1">
        </div>
        <div>
            <label for="column2">Column2</label>
            <input type="text" name="column2" id="column2">
        </div>
        <!-- More Work Order Fields -->

        <!-- Materials Section -->
        <div id="materials">
            <div class="material">
                <label for="materials[0][material_column1]">Material Column1</label>
                <input type="text" name="materials[0][material_column1]" id="materials[0][material_column1]">
                <label for="materials[0][material_column2]">Material Column2</label>
                <input type="text" name="materials[0][material_column2]" id="materials[0][material_column2]">
                <!-- More Material Fields -->
                <button type="button" onclick="removeMaterial(this)">Remove</button>
            </div>
        </div>
        <button type="button" onclick="addMaterial()">Add Material</button>

        <!-- Operations Section -->
        <div id="operations">
            <div class="operation">
                <label for="operations[0][operation_column1]">Operation Column1</label>
                <input type="text" name="operations[0][operation_column1]" id="operations[0][operation_column1]">
                <label for="operations[0][operation_column2]">Operation Column2</label>
                <input type="text" name="operations[0][operation_column2]" id="operations[0][operation_column2]">
                <!-- More Operation Fields -->
                <button type="button" onclick="removeOperation(this)">Remove</button>
            </div>
        </div>
        <button type="button" onclick="addOperation()">Add Operation</button>

        <button type="submit">Save Work Order</button>
            
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
  <script>
        let materialCount = 1;
        let operationCount = 1;

        function addMaterial() {
            const materialsDiv = document.getElementById('materials');
            const newMaterial = document.createElement('div');
            newMaterial.classList.add('material');
            newMaterial.innerHTML = `
                <label for="materials[${materialCount}][material_column1]">Material Column1</label>
                <input type="text" name="materials[${materialCount}][material_column1]" id="materials[${materialCount}][material_column1]">
                <label for="materials[${materialCount}][material_column2]">Material Column2</label>
                <input type="text" name="materials[${materialCount}][material_column2]" id="materials[${materialCount}][material_column2]">
                <!-- More Material Fields -->
                <button type="button" onclick="removeMaterial(this)">Remove</button>
            `;
            materialsDiv.appendChild(newMaterial);
            materialCount++;
        }

        function removeMaterial(button) {
            button.parentElement.remove();
        }

        function addOperation() {
            const operationsDiv = document.getElementById('operations');
            const newOperation = document.createElement('div');
            newOperation.classList.add('operation');
            newOperation.innerHTML = `
                <label for="operations[${operationCount}][operation_column1]">Operation Column1</label>
                <input type="text" name="operations[${operationCount}][operation_column1]" id="operations[${operationCount}][operation_column1]">
                <label for="operations[${operationCount}][operation_column2]">Operation Column2</label>
                <input type="text" name="operations[${operationCount}][operation_column2]" id="operations[${operationCount}][operation_column2]">
                <!-- More Operation Fields -->
                <button type="button" onclick="removeOperation(this)">Remove</button>
            `;
            operationsDiv.appendChild(newOperation);
            operationCount++;
        }

        function removeOperation(button) {
            button.parentElement.remove();
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