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
                           POS (Point of Sale)
                        </h1>
                        <div class="page-header-subtitle">Halaman untuk melakukan transaksi jual beli</div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="card">
            <div class="card-header">Point of Sale</div>
                <div class="card-body">

                  <div class="col-lg-12">
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (first name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="fakturno">Faktur No</label>
                            <input class="form-control" id="fakturno" type="text" readonly="readonly" value="{{ $faktur }}" >
                        </div>
                        <!-- Form Group (last name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="date_trans">Date Transcation</label>
                            <input class="form-control" id="date_trans" type="text" readonly="readonly" value="{{ date('Y-m-d') }}" >
                        </div>
                    </div>

                    <div class="row gx-3 mb-3">
                        <!-- Form Group (first name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputFirstName">Visit Type</label>
                            {{-- <input class="form-control" id="inputFirstName" type="text"  > --}}
                            <select name="visit_type" id="visit_type" class="form-control">
                                <option value="1">New</option>
                                <option value="2">Renew</option>
                                <option value="3">Other</option>
                            </select>
                        </div>
                        <!-- Form Group (last name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputLastName">Marketing Referal</label>
                            <select name="id_marketing" id="id_marketing" class="form-control">
                                @foreach ($marketing_ref as $mf=>$vmf)
                                @if($vmf->id != 1)
                                <option value="{{ $vmf->id }}"> {{ $vmf->employee_name }} </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row gx-3 mb-3">
                        <!-- Form Group (first name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputFirstName">ID Member</label>
                            <input class="form-control" id="id_member" name="id_member" readonly="readonly" type="text"  >
                        </div>
                        <!-- Form Group (last name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputLastName">Member Name</label>
                            <input class="form-control" id="member_name" name="member_name" readonly="readonly" type="text" >
                        </div>
                    </div>

                    <div class="row gx-3 mb-3">
                        <!-- Form Group (first name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputFirstName">Member Referal  </label>
                                <select name="id_member_referal" id="id_member_referal" class="form-control">
                                    @foreach ($member_ref as $mmf=>$vmmf)
                                    <option value="{{ $vmmf->id }}"> {{ $vmmf->member_name }} </option>
                                    @endforeach
                                </select>
                        </div>
                        <!-- Form Group (last name)-->
                        <div class="col-md-6">

                        </div>
                    </div>

                    <div class="row gx-3 mb-3">
                       <button type="button" id="search" onclick="SearchMember();"  class="btn btn-primary btn-block"> Search Member</button>
                       <button type="button" id="service" onclick="SearchForm();"  class="btn btn-success btn-block"> Add Order</button>
                    </div>
                  </div>

                  <hr>
                    <h3> Your Order</h3>
                  &nbsp;

             
                  <table class="table table-result">
                      <tr>
                        <td>Service Name</th>
                        <td>Personal Trainer</th>
                        <td>Price</th>
                        <td>Qty</th>
                        <td>Discount</th>
                        <td>Total</th>
                      </tr>
                  </table>
                  <table class="table table-subco">
                    <tr>
                        <td colspan="5">Sub TOTAL</td>
                        <td id="subtotal"></td>
                    </tr>
                  </table>

                  <br>
                  <hr>
                  <button class="btn btn-success btn-block"> Checkout </button>
                  <button class="btn btn-danger btn-block"> Cancel </button>

                </div>
        </div>
    </div>
    <!-- Modal -->

    <!-- {{-- SearchModal --}} -->
    <div class="modal" id="SearchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Search Member</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="listmember">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Barcode</th>
                            <th>Member Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead> 
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>

    {{-- SearchServiceModal --}}
    <div class="modal" id="SearchServiceModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title">Search Service</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            
            <div class="modal-body">
                <table id="listservice">
                    <thead>
                        <tr>
                            <th>Service Code</th>
                            <th>Service Name</th>
                            <th>Category</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
    </div>



    <!-- {{-- searchservicemodal --}} -->
    <div class="modal" id="ModalFormOrder" tabindex="-1">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Order</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            
            <div class="modal-body">

                <form action=""> 
                    <label for="servicename"> Service Name </label>
                    
                   <div class="row">
                    <div class="col-lg-9">
                        <input type="text" name="servicename" readonly="readonly" class="form-control" id="servicename">
                        <input type="hidden" name="idservice">
                    </div>
                    <div class="col-lg-3">
                        <button class="btn btn-primary btn-block" type="button" onclick="SearchService();"> Choose Service / Package</button>
                    </div>
                   </div>
                    
    
                    <label for=""> Price </label>
                    <input type="text" name="price" class="form-control" id="price">
                    <label for=""> Qty </label>
                    <input type="text" name="servicename" class="form-control" id="servicename">
                    <button class="btn btn-primary btn-block"> Add to Cart</button>
                </form>
       

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        var fakturno = $("#fakturno").val();
        $('#listpos').DataTable({
            processing: true,
            serverSide: true,
            ajax: "listpos/"+fakturno,
            data: { params: fakturno},
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'instructur_code', name: 'instructur_code'},
                {data: 'instructur_name', name: 'instructur_name'},
                {data: 'email', name: 'email'}, 
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: true, 
                    searchable: true
                },
            ]
        });

    $(document).ready(function () {
   
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

    function GantiHarga(){
        var itung_total = 0;
        var price = $(".price").text();

        $(".getqty").each(function(){
            var isi = $(this).val(); 
            console.log(isi + ' - ' + price);
        });

    }

    function SearchForm(){
        $('#ModalFormOrder').modal('show'); 
    }
    function SearchService() {
        $('#SearchServiceModal').modal('show');
        $('#ModalFormOrder').modal('hide'); 
        $('#listservice').DataTable({
            processing: true,
            destroy: true,
            serverSide: true,
            ajax: "{{ route('service_list_get') }}",
            columns: [
                {data: 'service_code', name: 'service_code'},
                {data: 'service_name', name: 'service_name'},
                {data: 'category', name: 'category'},
                {data: 'qty', name: 'qty'},
                {data: 'price', name: 'price'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
    }
    function SearchMember() {
        $('#SearchModal').modal('show');

        $('#listmember').DataTable({
            processing: true,
            destroy: true,
            serverSide: true,
            ajax: "{{ route('member_list_get') }}",
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
    }


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function ChooseMember(id){
       $.ajax({
        type: "POST",
        url: "{{ route('member_get_data') }}",
        data: {id:id},
        success:function(result){
            console.log(result);
            $("#id_member").val(result.barcode);
            $("#member_name").val(result.member_name);
            $('#SearchModal').modal('hide');
        }
       });

    }

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
    function isNumber(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    function calc(){
        let lt = 0;
        $(".sakit").each(function(){
            lt += isNumber($(this).text()) ? parseInt($(this).text(), 10) : 0;
        });
        $("#subtotal").html(lt);
    }


    function ChooseService(id){
        let isian = '';
        let st = 0;
        var id_trans_code
        var i
        $.ajax({
            type: "POST",
            data: {id:id},
            url:"{{ route('service_get_data') }}",
            success: function(result){
                //savetopos();
                console.log(result);
                isian = '<tr><td>'+result.service_code+'</td><td>'+result.service_name+'</td><td class="price">'+result.price+'</td><td><input type="text" onKeyup="GantiHarga();" class="getqty form-control" value="'+result.qty+'""></td></td><td>0</td></td><td class="sakit">'+parseInt(result.price * result.qty)+'</td></tr>';
                $(".table-result").append(isian);
                calc();
            }
        })
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
