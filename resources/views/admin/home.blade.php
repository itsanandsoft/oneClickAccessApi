@extends('admin.layouts.app')
@section('title', 'Home')
@push('cs')
    {{-- @include('admin.components.datatableStyle')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/pages/dashboard-ecommerce.css')}}"> --}}

@endpush
@section('content')
    <!-- page title area end -->
    <div class="main-content-inner">
        <div class="container">
            <div class="row">
                <!-- seo fact area start -->
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-6 mt-5 mb-3">
                            <div class="card">

                                <div class="seo-fact sbg1">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><i class="ti-user"></i> Number of Users</div>
                                        <h2>{{ $countUsers }}</h2>
                                    </div>
                                    <canvas id="seolinechart1" height="50"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-md-5 mb-3">
                            <div class="card">
                                <div class="seo-fact sbg2">
                                    <div class="p-4 d-flex justify-content-between align-items-center">
                                        <div class="seofct-icon"><i class="ti-share"></i> Number of Machines</div>
                                        <h2>{{ $countMachines }}</h2>
                                    </div>
                                    <canvas id="seolinechart2" height="50"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- main content area end -->

     <!-- data table start -->
     <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="alert-dismiss">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong>Operation Successful!</strong> You should check in on some of those fields below.<a href="#" class="alert-link">z
                <h4 class="header-title">Users</h4>
                <div class="data-tables">
                    <table id="dataTable" class="text-center">
                        <thead class="bg-light text-capitalize">
                            <tr>
                                <th>Sr</th>
                                <th>Id </th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Registeration Date</th>
                                <th>No of Machines</th>
                                <th>Verified Machines</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Get Machines Information</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allUsers as $user)
                                <tr>
                                    @php
                                         $verificationStatus = $user->email_verified_at ? 'Verified' : 'Pending';
                                         $verificationStatus_bg = $user->email_verified_at ? 'primary' : 'warning';
                                    @endphp
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{ $user->id}}</td>
                                            <td>{{ $user->name}}</td>
                                            <td>{{ $user->email}}</td>
                                            <td>{{ $user->created_at}}</td>
                                            <td>{{ $user->machines_count }}</td>
                                            <td>{{ $user->machines()->where('active', 1)->count() }}</td>
                                            <td><span class="status-p bg-{{ $verificationStatus_bg }}">{{ $verificationStatus }}</span></td>

                                            <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><a href="#" onClick="verifyUser({{ $user->id }})" class="text-secondary"><i class="fa fa-check"></i></a></li>

                                                </ul>
                                            </td>
                                            <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><a onClick="getMachine({{ $user->id }})" class="text-primary">Click Here to Fetch User's Machines <i class="fa fa-download"></i></a></li>
                                                </ul>
                                            </td>
                                </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- data table end -->

    <!-- Progress Table start -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title" id="header-card-machine">Machine Data For User : email123@gmail.com(John Abra)</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover progress-table text-center" id="data-table-machine">
                            <thead class="text-uppercase">
                                <tr>
                                    <th scope="col">Sr</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">MAC Adress</th>
                                    <th scope="col">Hard disk Serail</th>
                                    <th scope="col">status</th>
                                    <th scope="col">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    <th scope="row">1</th>
                                    <td>28:3a:4d:5b:9a:7fA</td>
                                    <td>slkdfjdlk/td>
                                    <td><span class="status-p bg-danger">restricted</span></td>
                                    <td>
                                        <ul class="d-flex justify-content-center">
                                            <li class="mr-3"><a href="#" class="text-success"><i class="fa fa-check"></i></a></li>
                                        <li><a href="#" class="text-danger"><i class="fa fa-undo"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>28:3a:4d:5b:9a:7fA</td>
                                    <td>skdlafjklds</td>
                                    <td><span class="status-p bg-success"></span></td>
                                    <td>
                                        <ul class="d-flex justify-content-center">
                                            <li class="mr-3"><a href="#" class="text-success"><i class="fa fa-check"></i></a></li>
                                        <li><a href="#" class="text-danger"><i class="fa fa-undo"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">4</th>
                                    <td>28:3a:4d:5b:9a:7fA</td>
                                    <td>sfakjhdskj</td>
                                    <td><span class="status-p bg-danger">restricted</span></td>
                                    <td>
                                        <ul class="d-flex justify-content-center">
                                            <li class="mr-3"><a href="#" class="text-success"><i class="fa fa-check"></i></a></li>
                                        <li><a href="#" class="text-danger"><i class="fa fa-undo"></i></a></li>
                                        </ul>
                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Progress Table end -->


    {{-- @include('admin.transactions.components.editCost') --}}
@endsection
@push('js')
    {{-- @include('admin.components.datatableScript') --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>

    function getMachine(idU){
        //selectedRow = btn.parentElement;

        //var idU = selectedRow.cells[1].innerHTML;
        // Set inner HTML using jQuery
        //$('#header-card-machine').html('Machine Data For User : '+selectedRow.cells[3].innerHTML+'('+selectedRow.cells[2].innerHTML+')');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        url: '{{ route('admin.get_machine_data') }}', // Replace with your Laravel route URL
        type: 'POST', // Adjust the request type as needed (GET or POST)
        dataType: 'json',
        data: {
            id: idU, // Pass the condition value
        },
        success: function(response) {
            // Clear existing table rows
            $('#data-table-machine tbody').empty();

            // Iterate through the response data and populate the table
            $.each(response, function(index, item) {
             var status,status_bg ='';
                if(item.active == '1')
                {
                    status = 'allowed';
                    status_bg = 'success';
                }
                else
                {
                    status = 'restricted';
                    status_bg = 'danger';
                }
                var row = '<tr>' +
                            '<td>' + index + '</td>' +
                            '<td>' + item.id + '</td>' +
                            '<td>' + item.mac_address + '</td>' +
                            '<td>' + item.hard_disk_serial + '</td>' +
                            '<td><span class="status-p bg-'+status_bg+'">'+status+'</span></td>' +
                            '<td><ul class="d-flex justify-content-center">' +
                                '<li class="mr-3"><a href="#" onClick="verifyMachine(this)" class="text-success"><i class="fa fa-check"></i></a></li>' +
                                            '<li><a href="#" onClick="rejectMachine(this)" class="text-danger"><i class="fa fa-undo"></i></a></li>' +
                                            '</ul>' +
                                        '</td>' +
                            '</tr>';
                $('#data-table-machine tbody').append(row);
            });
        },
        error: function(xhr, status, error) {
            console.log(error); // Handle error gracefully
        }
        });
    }

    function verifyUser(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        url: '{{ route('admin.verify_user') }}', // Replace with your Laravel route URL
        type: 'POST', // Adjust the request type as needed (GET or POST)
        dataType: 'json',
        data: {
            id: id, // Pass the condition value
        },
        success: function(response) {
            ///////
        },
        error: function(xhr, status, error) {
            console.log(error); // Handle error gracefully
        }
        });
    // selectedRow = btn.parentElement.parentElement;
    // const data = {
    // id: selectedRow.cells[0].innerHTML,
    // col:'verified_by'
    // };

    // axios.post('/verifyInvoice', data)
    // .then(response => {
    //     if(response.data == -1)
    //     {
    //         $('#av1').show();
    //     }
    //     if(response.data == 0)
    //     {
    //         $('#av').show();
    //         document.body.scrollTop = 0; // For Safari
    //         document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    //     }
    //     if(response.data == 1)
    //     {
    //         window.location.reload();
    //     }
    // })
    // .catch (response => {
    //     // List errors on response...
    // });
}
        // $('select').on('change', function() {
        // alert( this.value );
        // });
    </script>

@endpush



