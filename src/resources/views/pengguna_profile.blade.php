@extends('layouts.app')

@section('content')
<main>
 
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="#">Profile</a>
         
        </nav>
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <img class="img-account-profile rounded-circle mb-2" src="{{ asset('uploads/'.$data->foto) }}" alt="">
                        <!-- Profile picture help block-->
                       
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form action="{{ url('save_profile') }}" method="POST" enctype="multipart/form-data"> 
                            @csrf
                            <input type="hidden" value="{{ $data->id}}" id="id_employee" name="id_employee"> 
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">ID Employee</label>
                                <input class="form-control" id="employee_code" readonly="readonly" name="employee_code" value="{{ $data->employee_code }}"type="text"  >
    
 
                            </div>
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Employee Name</label>
                                    <input class="form-control" id="employee_name" value="{{ $data->employee_name }}"  readonly="readonly"  name="employee_name" type="text">
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Email</label>
                                    <input class="form-control" id="email"  readonly="readonly" value="{{ $data->email }}"  name="email" type="text">
                                </div>
                            </div>

                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Job Title</label>
                                    <input class="form-control onlytext" id="job_title" value="{{ $data->job_title }}" readonly="readonly"  name="job_title" type="text">
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Status</label>
                                    @if($data->status == 1)
                                        <input class="form-control" id="status"  readonly="readonly" value="Aktif" name="status" type="text">
                                    @else 
                                        <input class="form-control" id="status"  readonly="readonly" value="Non-Aktif" name="status" type="text">
                                    @endif
                                    
                                </div>
                            </div>

                            <label for=""> Change Password</label>
                            <br>
                            <span class="btn btn-danger"> Kosongkan password jika tidak ingin mengganti password</span>
                            <hr>
                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Password</label>
                                <input class="form-control" id="password" name="password" type="password" placeholder="Password" value="">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Configm Password</label>
                                <input class="form-control" id="cpassword" name="cpassword" type="password" placeholder="Confirm Password" value="" >
                            </div>
                           
                            <!-- Save changes button-->
                            <button class="btn btn-primary btn-block" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
