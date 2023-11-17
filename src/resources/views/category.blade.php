@extends('layouts.app')

@section('content')
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                           Category
                        </h1>
                        <div class="page-header-subtitle">Halaman untuk me-manage data category</div>
                    </div>
 
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="card">
            <div class="card-header">Master Category</div>
                <div class="card-body">

                    <button class="btn btn-primary" onclick="AddData();"> 
                        <div class="nav-link-icon"><i data-feather="archive"></i></div> &nbsp;
                        Tambah Data
                     </button>
                    <br>
                    &nbsp;
                    <table id="example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Action</th> 
                            </tr>
                        </thead>
                      
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Tambah Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="my-form">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Category</label>
                            <input class="form-control" id="category_name"  name="category_name" type="text"  >

                            {{-- <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'PHARMA') !!}</div> --}}
                        </div> 
                       
                    </form>
                </div>



            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                <div class="nav-link-icon"><i data-feather="x-square"></i></div> &nbsp;
                Close
            </button>
            <button type="button" class="btn btn-primary" onclick="SimpanData();">
                <div class="nav-link-icon"><i data-feather="database"></i></div> &nbsp;
                Simpan
            </button>
            </div> 
        </div>
        </div>
    </div>

    <div style="position: absolute; bottom: 1rem; right: 1rem;">
        <!-- Toast -->
        <div class="toast" id="toastSave" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
            <div class="toast-header bg-primary text-white">
                <i data-feather="bell"></i>
                <strong class="mr-auto">  &nbsp; Pesan Sistem</strong> 
                <button class="ml-2 mb-1 btn-close" type="button" data-bs-dismiss="toast" aria-label="Close">                                                                </button>
            </div>
            <div class="toast-body">Data yang diinput sudah berhasil di simpan ke database.</div>
        </div>
    </div>

    <div style="position: absolute; bottom: 1rem; right: 1rem;">
        <!-- Toast -->
        <div class="toast" id="toastDel" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
            <div class="toast-header bg-primary text-white">
                <i data-feather="bell"></i>
                <strong class="mr-auto"> &nbsp; Pesan Sistem</strong> 
                <button class="ml-2 mb-1 btn-close" style="float:right; margin-right:10px;" type="button" data-bs-dismiss="toast" aria-label="Close">                                                                </button>
            </div>
            <div class="toast-body bg-white text-black">Data yang terpilih sudah berhasil di hapus dari database.</div>
        </div>
    </div>
 
    
    
</main>
<script>
    $(document).ready(function () {
        $("#warning").hide();
    $("#pancing").on("click",function(){
        alert('apelu!');
        $("#warning").fadeIn("slow");
    });
    

        $('#example').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('category_list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'category_name', name: 'category_name'}, 
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: true, 
                    searchable: true
                },
            ]
        });
    }); 

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function AddData(){
        clearinput(); 
        $('#myModal').modal('show');  
    }
 

    function SimpanData(){
        var form = $('#my-form')[0]; 
        var data = new FormData(form);    
            $.ajax({ 
            type: "POST", 
            enctype: 'multipart/form-data', 
            url:"{{ route('category_save') }}", 
            data: data, 
            processData: false, 
            contentType: false, 
            cache: false, 
            timeout: 800000, 
            success: function (data) { 
                console.log("SUCCESS : ", data); 
                $('#myModal').modal('hide'); 
                $('#example').DataTable().ajax.reload();
                $("#toastSave").toast("show");
                clearinput();
            },

            error: function (e) { 
                console.log("ERROR : ", e);  
                $('#myModal').modal('hide'); 
                $('#example').DataTable().ajax.reload()
                clearinput();
            } 
        }); 
         
      
    }

    function clearinput(){
        $("input").val(""); 
    }

    function DeleteData(id){
        if(confirm('Anda yakin ingin menghapus data ini?')){
            $.ajax({
            url : "{{ route('category_destroy') }}",
            type: "POST",
            data: {id:id},
            success: function(data)
            { 
               $('#example').DataTable().ajax.reload();  
               $("#toastDel").toast("show");
			    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
        }
    }
    
    function UbahData(id){ 
        $('#myModal').modal('show');  
        $.ajax({
            url : "{{ route('category_get_data') }}",
            type: "POST",
            data: {id:id},
            success: function(data)
            {  
                // console.log(data);
                $("#id").val(data.id);
                $("#category_name").val(data.category_name);
                 
            } 
        });
}

</script>
@endsection
