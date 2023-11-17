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
                           Service
                        </h1>
                        <div class="page-header-subtitle">Halaman untuk me-manage data service</div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="card">
            <div class="card-header">Master Service</div>
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
                                <th>Service Code</th>
                                <th>Service Name</th>
                                <th>Group</th>
                                <th>Price</th>
                                <th>Actions</th>
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
                            <label class="small mb-1" for="inputUsername">Service Code</label>
                            <input class="form-control" id="service_code" readonly="readonly" name="service_code" type="text"  >

                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">

                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Service Name</label>
                                <input class="form-control" id="service_name" name="service_name" type="text">
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Remark</label>
                                <input class="form-control onlytext" id="remark" name="remark" type="text">
                            </div>
                        </div>
                        <!-- Form Row-->
                          <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Category</label>
                                    <select class="form-control" name="category" id="category">
                                        <option value="" selected="selected">--Select--</option>
                                        <option value="1">Service</option>
                                        <option value="2">Barang</option>
                                    </select>
                            </div>
                            <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Group</label>
                                    <select class="form-control" name="id_group" id="id_group">
                                    @foreach ($group as $key=>$value)
                                        <option value="{{ $value['id'] }}"> {{ $value['group_name'] }} </option>
                                    @endforeach
                                    </select>
                            </div>
                        </div>
                         <!-- Form Row-->
                         <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Kategori</label>
                                    <select class="form-control" name="kategori" id="kategori">
                                        <option value="" selected="selected">--Select--</option>
                                        <option value="1">Per Kedatangan</option>
                                        <option value="2">Per Session</option>
                                    </select>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Qty</label>
                                <input class="form-control " id="qty" name="qty" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  type="text">
                            </div>
                        </div>
                        <!-- Form Row-->
                          <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                            <label class="small mb-1" for="inputLastName">Price</label>
                                <input class="form-control " id="price" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  name="price" type="text">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Expire Service/Package</label>
                                <input class="form-control " id="expire_service" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" name="expire_service" type="text">
                            </div>
                        </div>
                           <!-- Form Row-->
                           <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Acc Revenue</label>
                                    <select class="form-control" name="acc_revenue" id="acc_revenue">
                                        <option value="" selected="selected">--Select--</option>
                                        <option value="1">Pendapatan Fitnes & Gym</option>
                                        <option value="2">Penjualan Item</option>
                                    </select>
                            </div>
                            <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Aggrement Type</label>
                                    <select class="form-control" name="agreement_type" id="agreement_type">
                                        <option value="" selected="selected">--Select--</option>
                                        <option value="1">None</option>
                                        <option value="2">License</option>
                                    </select>
                            </div>
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


        $(".onlytext").keypress(function(e) {
                    var key = e.keyCode;
                    if (key >= 48 && key <= 57) {
                        e.preventDefault();
                    }

                });

        $('#example').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('service_list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'service_code', name: 'service_code'},
                {data: 'service_name', name: 'service_name'},
                {data: 'group_name', name: 'group_name'},
                {data: 'price', name: 'price'},
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
        $.get('{{ route('service_add_form') }}',function(result){
            console.log(result);
            $("#service_code").val(result);
        });
        $('#myModal').modal('show');
    }

    function SimpanData(){

        var form = $('#my-form')[0];
        var data = new FormData(form);


            $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url:"{{ route('service_save') }}",
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
        $("#pict_view").html("");
        $("#pict_view").css('display','none');
    }

    function DeleteData(id){
        if(confirm('Anda yakin ingin menghapus data ini?')){
            $.ajax({
            url : "{{ route('service_destroy') }}",
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
            url : "{{ route('service_get_data') }}",
            type: "POST",
            data: {id:id},
            success: function(data)
            {
                // console.log(data);
                $("#id").val(data.id);
                $("#service_code").val(data.service_code);
                $("#service_name").val(data.service_name);
                $("#remark").val(data.remark);

                $("#id_group").val(data.id_group);
                $("#category").val(data.category);
                $("#kategori").val(data.kategori);
                $("#qty").val(data.qty);
                $("#price").val(data.price);

                $("#expire_service").val(data.expire_service);
                $("#acc_revenue").val(data.acc_revenue);
                $("#agreement_type").val(data.agreement_type);
            }
        });
}

</script>
@endsection
