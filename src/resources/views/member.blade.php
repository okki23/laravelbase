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
                           Member
                        </h1>
                        <div class="page-header-subtitle">Halaman untuk me-manage data member</div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="card">
            <div class="card-header">Master Member</div>
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
                                <th>Barcode</th>
                                <th>Member Name</th>
                                <th>Email</th>
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
                            <label class="small mb-1" for="inputUsername">Barcode</label>
                            <input class="form-control" id="barcode" readonly="readonly" name="barcode" type="text"  >

                            {{-- <div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'PHARMA') !!}</div> --}}
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Title</label>
                                <select class="form-control" id="title" name="title">
                                    <option value="" selected="selected">--Select--</option>
                                    <option value="1">Mr</option>
                                    <option value="2">Mrs</option>
                                </select>
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Member name</label>
                                <input class="form-control onlytext" id="member_name" name="member_name" type="text">
                            </div>
                        </div>
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (organization name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOrgName">Identity Number</label>
                                <input class="form-control" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" id="id_number" name="id_number" type="text" >
                            </div>
                            <!-- Form Group (location)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLocation">Date of Birth</label>
                                <input class="form-control" id="dob" name="dob" type="date" >
                            </div>
                        </div>

                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Place Of Birth</label>
                                <input class="form-control onlytext" id="pob" name="pob" type="text"  >
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Phone </label>
                                <input class="form-control" id="phone" type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" name="phone" >
                            </div>
                        </div>
                        <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Gender</label>
                                    <select class="form-control" name="gender" id="gender">
                                        <option value="" selected="selected">--Select--</option>
                                        <option value="1">Pria</option>
                                        <option value="2">Wanita</option>
                                    </select>
                                </div>
                                <!-- Form Group (birthday)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputBirthday">Email </label>
                                    <input class="form-control onlyemail" id="email" required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" type="text" name="email" >
                                    <div id="valid"></div>
                                </div>
                        </div>
                        <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (phone number)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Emergency Contact</label>
                                    <input class="form-control" name="emer_contact" id="emer_contact" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" type="text">
                                </div>
                                <!-- Form Group (birthday)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputBirthday">Referal </label>
                                    <input class="form-control" id="referal" type="text" name="referal">
                                </div>
                        </div>
                        <!-- Form Group (username)-->


                          <!-- Form Row-->
                          <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Address</label>
                                <input class="form-control" name="address" id="address" type="text">
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <div id="pict_view"></div>
                                <label class="small mb-1 btn btn-danger btn-xs" >Photo (*max 5 MB - JPG | JPEG | PNG) </label>
                                <input type="file" name="foto" id="foto" class="form-control">
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

        $('#foto').bind('change', function() {
            if(this.files[0].size > 5000000) {
                alert("File maksimum yang diizinkan 5MB!!");
                $(this).val('');
            }

            var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("File yang diizinkan hanya: "+fileExtension.join(', ')+" ! ");
            }
            //this.files[0].size gets the size of your file.
            // alert(this.files[0].size);

        });

        $('.onlyemail').on('keypress', function(){
            var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(this.value) && this.value.length;
            if(!valid){
                $(this).addClass('is-invalid');
            }else{
                $(this).removeClass('is-invalid');
            }
        });

        $(".onlytext").keypress(function(e) {
                    var key = e.keyCode;
                    if (key >= 48 && key <= 57) {
                        e.preventDefault();
                    }
                    // $(this).addClass('is-invalid');
                });

        $('#example').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('member_list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'barcode', name: 'barcode'},
                {data: 'member_name', name: 'member_name'},
                {data: 'email', name: 'email'},
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
        $.get('{{ route('member_add_form') }}',function(result){
            console.log(result);
            $("#barcode").val(result);
        });
        $('#myModal').modal('show');
    }

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }


    function SimpanData(){

        var form = $('#my-form')[0];
        var data = new FormData(form);
        var email = $("#email").val();
        if(isEmail(email)){
            $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url:"{{ route('member_save') }}",
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
        }else{
            alert('Email tidak valid!');
            $(".onlyemail").focus().addClass('is-invalid');
        }

    }

    function clearinput(){
        $("input").val("");
        $("#pict_view").html("");
        $("#pict_view").css('display','none');
    }

    function DeleteData(id){
        if(confirm('Anda yakin ingin menghapus data ini?')){
            $.ajax({
            url : "{{ route('member_destroy') }}",
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
            url : "{{ route('member_get_data') }}",
            type: "POST",
            data: {id:id},
            success: function(data)
            {
                // console.log(data);
                $("#id").val(data.id);
                $("#barcode").val(data.barcode);
                $("#title").val(data.title);
                $("#member_name").val(data.member_name);

                $("#id_number").val(data.id_number);
                $("#dob").val(data.dob);
                $("#pob").val(data.pob);
                $("#phone").val(data.phone);
                $("#gender").val(data.gender);

                $("#email").val(data.email);
                $("#address").val(data.address);
                $("#emer_contact").val(data.emer_contact);
                $("#referal").val(data.referal);

                if(data.foto != null || data.foto != ''){
                    image = new Image();
                    image.src = '{{ asset('uploads/') }}/'+data.foto;
                    image.style.width = '50%';
                    image.style.height = '50%';
                    $("#pict_view").empty().append(image);
                    $("#foto").css({"margin-top":"5%"})
                }
            }
        });
}

</script>
@endsection
