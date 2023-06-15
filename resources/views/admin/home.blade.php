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
                <div class="alert-dismiss" id="alert-success-user">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong>Operation Successful!</strong> <span id="alert-success-user-span"> Message <a href="#" onclick="location.reload();" class="alert-link"> Click Here to Reload</a></span>
                    </div>
                </div>
                <div class="alert-dismiss" id="alert-danger-user">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Operation Failed!</strong> <span id="alert-danger-user-span"> Message <a href="#" onclick="location.reload();" class="alert-link"> Click Here to Reload</a></span>
                    </div>
                </div>
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
                                                    <li class="mr-3"><a  onClick="verifyUser('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}')" class="text-secondary"><i class="fa fa-check"></i></a></li>

                                                </ul>
                                            </td>
                                            <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><a onClick="getMachine('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}')" class="text-primary">Click Here to Fetch User's Machines <i class="fa fa-download"></i></a></li>
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
                <input id="userId" type="hidden" value="0"/>;
                <div class="alert-dismiss" id="alert-success-machine">
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong>Operation Successful!</strong><span id="alert-success-machine-span"> Message <a href="#" onclick="location.reload();" class="alert-link"> Click Here to Reload</a></span>
                    </div>
                </div>
                <div class="alert-dismiss" id="alert-danger-machine">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Operation Failed!</strong> <span id="alert-danger-machine-span"> Message <a href="#" onclick="location.reload();" class="alert-link"> Click Here to Reload</a></span>
                    </div>
                </div>
                <h4 class="header-title" id="header-card-machine">Machine Data For User </h4>
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
        $(document).ready(function() {
            $('.alert-dismiss').hide();
            });

    function getMachine(dataStr){
        //selectedRow = btn.parentElement;
        const myArray = dataStr.split(',');
        const id = myArray[0];
        const name = myArray[1];
        const email = myArray[2];
        //var idU = selectedRow.cells[1].innerHTML;
        // Set inner HTML using jQuery
        $('#header-card-machine').html('Machine Data For User : '+name+'('+email+')');
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
            id: id, // Pass the condition value
        },
        success: function(response) {
            // Clear existing table rows
            $('#data-table-machine tbody').empty();

            // Iterate through the response data and populate the table
            $.each(response, function(index, item) {
                document.getElementById('userId').value = item.userId;

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
                                '<li class="mr-3"><a  onClick="verifyMachine(' + item.id.toString()  + ',' + item.user_id.toString()  + ')" class="text-success"><i class="fa fa-check"></i></a></li>' +
                                            '<li><a  onClick="restrictMachine(' + item.id.toString()  + ',' + item.user_id.toString()  + ')" class="text-danger"><i class="fa fa-undo"></i></a></li>' +
                                            '</ul>' +
                                        '</td>' +
                            '</tr>';
                $('#data-table-machine tbody').append(row);

            });
            $('#alert-success-user-span').html('Fetched Machine Data. Check below table');

            $('#alert-success-user').show();
                setTimeout(function(){
                $("#alert-success-user").slideUp(500);
            }, 4000);

        },
        error: function(xhr, status, error) {
            console.log(error); // Handle error gracefully
            $('#alert-danger-user-span').html('Error in fatching machine Data');
            $('#alert-danger-user').show();
                setTimeout(function(){
                $("#alert-danger-user").slideUp(500);
            }, 3000);
        }
        });
    }

    function verifyUser(dataStr){
        const myArray = dataStr.split(',');
        const id = myArray[0];
        const name = myArray[1];
        const email = myArray[2];
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

            $('#alert-success-user-span').html(response.message+ ' <a href="#" onclick="location.reload();" class="alert-link"> Click Here to Reload</a>');
            // Clear existing table rows
            $('#data-table-machine tbody').empty();

            // Iterate through the response data and populate the table
            $.each(response.data, function(index, item) {
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
                                '<li class="mr-3"><a onClick="verifyMachine(' + item.id + ')" class="text-success"><i class="fa fa-check"></i></a></li>' +
                                            '<li><a onClick="restrictMachine(' + item.id+ ')" class="text-danger"><i class="fa fa-undo"></i></a></li>' +
                                            '</ul>' +
                                        '</td>' +
                            '</tr>';
                $('#data-table-machine tbody').append(row);

            });

        },
        error: function(xhr, status, error) {
            if(xhr.status === 400)
            {
            $('#alert-danger-user-span').html(response.message);
            $('#alert-danger-user').show();
                setTimeout(function(){
                $("#alert-danger-user").slideUp(500);
            }, 3000);
            }
            else
            {
                $('#alert-danger-user-span').html('Some Error occured!');
                $('#alert-danger-user').show();
                setTimeout(function(){
                $("#alert-danger-user").slideUp(500);
            }, 3000);
            }
            console.log(error); // Handle error gracefully
        }
        });
}


function verifyMachine(id){
    var idU = document.getElementById('userId').value;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        url: '{{ route('admin.verify_machine') }}', // Replace with your Laravel route URL
        type: 'POST', // Adjust the request type as needed (GET or POST)
        dataType: 'json',
        data: {
            id: id,
            idU: idU, // Pass the condition value
        },
        success: function(response) {
            ///////

            $('#alert-success-user-span').html(response.message);
            // Clear existing table rows
            $('#data-table-machine tbody').empty();

            // Iterate through the response data and populate the table
            $.each(response.data, function(index, item) {
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
                                '<li class="mr-3"><a  onClick="verifyMachine(' + item.id + ',' + item.user_id + ')" class="text-success"><i class="fa fa-check"></i></a></li>' +
                                            '<li><a |onClick="restrictMachine(' + item.id + ',' + item.user_id + ')" class="text-danger"><i class="fa fa-undo"></i></a></li>' +
                                            '</ul>' +
                                        '</td>' +
                            '</tr>';
                $('#data-table-machine tbody').append(row);

            });

        },
        error: function(xhr, status, error) {
            if(xhr.status === 400)
            {
            $('#alert-danger-machine-span').html(response.message);
            $('#alert-danger-machine').show();
                setTimeout(function(){
                $("#alert-danger-user").slideUp(500);
            }, 3000);
            }
            else
            {
                $('#alert-danger-machine-span').html('Some Error occured!');
                $('#alert-danger-machine').show();
                setTimeout(function(){
                $("#alert-danger-machine").slideUp(500);
            }, 3000);
            }
            console.log(error); // Handle error gracefully
        }
        });
}

function restrictMachine(id){
    var idU = document.getElementById('userId').value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
        url: '{{ route('admin.restrict_machine') }}', // Replace with your Laravel route URL
        type: 'POST', // Adjust the request type as needed (GET or POST)
        dataType: 'json',
        data: {
            id: id,
            idU: idU,  // Pass the condition value
        },
        success: function(response) {
            ///////

            $('#alert-success-user-span').html(response.message);


        },
        error: function(xhr, status, error) {
            if(xhr.status === 400)
            {
            $('#alert-danger-machine-span').html(response.message);
            $('#alert-danger-machine').show();
                setTimeout(function(){
                $("#alert-danger-user").slideUp(500);
            }, 3000);
            }
            else
            {
                $('#alert-danger-machine-span').html('Some Error occured!');
                $('#alert-danger-machine').show();
                setTimeout(function(){
                $("#alert-danger-machine").slideUp(500);
            }, 3000);
            }
            console.log(error); // Handle error gracefully
        }
        });
}


    </script>

@endpush



