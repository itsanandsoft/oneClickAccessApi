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
                                        <h2>2,315</h2>
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
                                        <h2>3,984</h2>
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
                <h4 class="header-title">Users</h4>
                <div class="data-tables">
                    <table id="dataTable" class="text-center">
                        <thead class="bg-light text-capitalize">
                            <tr>
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
                            <tr>
                                <td>1</td>
                                <td>Accountant</td>
                                <td>Tokyo@gmail.com</td>
                                <td>2008/11/28</td>
                                <td>3</td>
                                <td>2</td>
                                <td><span class="status-p bg-warning">panding</span></td>

                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="#" class="text-secondary"><i class="fa fa-check"></i></a></li>

                                    </ul>
                                </td>
                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="#" class="text-primary">Click Here to Fetch User's Machines <i class="fa fa-download"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Chief Executive Officer (CEO)</td>
                                <td>London@gmail.com</td>
                                <td>2009/10/09</td>
                                <td>4</td>
                                <td>1</td>
                                <td><span class="status-p bg-primary">verified</span></td>

                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="#" class="text-secondary"><i class="fa fa-check"></i></a></li>

                                    </ul>
                                </td>
                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="#" class="text-primary">Click Here to Fetch User's Machines <i class="fa fa-download"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Junior Technical Author</td>
                                <td>SanFrancisco@gmail.com</td>
                                <td>2009/01/12</td>
                                <td>6</td>
                                <td>6</td>
                                <td><span class="status-p bg-warning">panding</span></td>

                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="#" class="text-secondary"><i class="fa fa-check"></i></a></li>

                                    </ul>
                                </td>
                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="#" class="text-primary">Click Here to Fetch User's Machines <i class="fa fa-download"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>Bradley Greer</td>
                                <td>Software Engineer</td>
                                <td>London</td>
                                <td>41</td>
                                <td>2012/10/13</td>
                                <td>$132,000</td>
                                <td><span class="status-p bg-warning">panding</span></td>

                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="#" class="text-secondary"><i class="fa fa-check"></i></a></li>

                                    </ul>
                                </td>
                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="#" class="text-primary">Click Here to Fetch User's Machines <i class="fa fa-download"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>Brenden Wagner</td>
                                <td>Software Engineer</td>
                                <td>San Francisco</td>
                                <td>28</td>
                                <td>2011/06/07</td>
                                <td>$206,850</td>
                                <td><span class="status-p bg-warning">panding</span></td>

                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="#" class="text-secondary"><i class="fa fa-check"></i></a></li>

                                    </ul>
                                </td>
                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="#" class="text-primary">Click Here to Fetch User's Machines <i class="fa fa-download"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>Caesar Vance</td>
                                <td>Pre-Sales Support</td>
                                <td>New York</td>
                                <td>29</td>
                                <td>2011/12/12</td>
                                <td>$106,450</td>
                                <td><span class="status-p bg-warning">panding</span></td>

                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="#" class="text-secondary"><i class="fa fa-check"></i></a></li>

                                    </ul>
                                </td>
                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="#" class="text-primary">Click Here to Fetch User's Machines <i class="fa fa-download"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>Bruno Nash</td>
                                <td>Software Engineer</td>
                                <td>Edinburgh</td>
                                <td>21</td>
                                <td>2012/03/29</td>
                                <td>$433,060</td>
                                <td><span class="status-p bg-warning">panding</span></td>

                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="#" class="text-secondary"><i class="fa fa-check"></i></a></li>

                                    </ul>
                                </td>
                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="#" class="text-primary">Click Here to Fetch User's Machines <i class="fa fa-download"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>Bradley Greer</td>
                                <td>Software Engineer</td>
                                <td>London</td>
                                <td>41</td>
                                <td>2012/10/13</td>
                                <td>$132,000</td>
                                <td><span class="status-p bg-warning">panding</span></td>

                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="#" class="text-secondary"><i class="fa fa-check"></i></a></li>

                                    </ul>
                                </td>
                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="#" class="text-primary">Click Here to Fetch User's Machines <i class="fa fa-download"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>Brenden Wagner</td>
                                <td>Software Engineer</td>
                                <td>San Francisco</td>
                                <td>28</td>
                                <td>2011/06/07</td>
                                <td>$206,850</td>
                                <td><span class="status-p bg-warning">panding</span></td>

                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="#" class="text-secondary"><i class="fa fa-check"></i></a></li>

                                    </ul>
                                </td>
                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="#" class="text-primary">Click Here to Fetch User's Machines <i class="fa fa-download"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>Caesar Vance</td>
                                <td>Pre-Sales Support</td>
                                <td>New York</td>
                                <td>29</td>
                                <td>2011/12/12</td>
                                <td>$106,450</td>
                                <td><span class="status-p bg-warning">panding</span></td>

                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="#" class="text-secondary"><i class="fa fa-check"></i></a></li>

                                    </ul>
                                </td>
                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="#" class="text-primary">Click Here to Fetch User's Machines <i class="fa fa-download"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>Bruno Nash</td>
                                <td>Software Engineer</td>
                                <td>Edinburgh</td>
                                <td>21</td>
                                <td>2012/03/29</td>
                                <td>$433,060</td>
                                <td><span class="status-p bg-warning">panding</span></td>

                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="#" class="text-secondary"><i class="fa fa-check"></i></a></li>

                                    </ul>
                                </td>
                                <td>
                                    <ul class="d-flex justify-content-center">
                                        <li class="mr-3"><a href="#" class="text-primary">Click Here to Fetch User's Machines <i class="fa fa-download"></i></a></li>
                                    </ul>
                                </td>
                            </tr>
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
                <h4 class="header-title">Machine Data For User : email123@gmail.com(John Abra)</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover progress-table text-center">
                            <thead class="text-uppercase">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">MAC Adress</th>
                                    <th scope="col">Hard disk Serail</th>
                                    <th scope="col">status</th>
                                    <th scope="col">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
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
                                    <td><span class="status-p bg-success">allowed</span></td>
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
                                </tr>
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

    <script>

        // $('select').on('change', function() {
        // alert( this.value );
        // });
    </script>

@endpush



