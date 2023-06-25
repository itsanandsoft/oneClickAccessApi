@extends('admin.layouts.app')
@section('title', 'Home')
@push('cs')
    {{-- @include('admin.components.datatableStyle')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/pages/dashboard-ecommerce.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{ mix('css/fancytree/ui.fancytree.css') }}">
    <script src="{{ mix('js/fancytree/jquery.fancytree-all.min.js') }}"></script> --}}


    {{-- <link rel="stylesheet" href="{{ asset('css/fancytree/ui.fancytree.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/fancytree/jquery.fancytree-all.min.js') }}"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/jquery.fancytree@2.27/dist/skin-win8/ui.fancytree.min.css" rel="stylesheet">

@endpush
@section('content')
 <!-- Modal -->
 <div class="modal fade" id="exampleModalCenter">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload JSON File</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <h4 class="header-title">Import Data</h4>
                <form action="#">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inputGroupFile04" accept=".json">
                      <label class="custom-file-label" for="inputGroupFile04" id="selectedFileName">Choose file</label>
                    </div>
                  </div>
                </form>
              </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="uploadJSONOfUser()">Save User Data</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleLongModalLong2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User's Uploaded JSON Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div id="fancytree-container"></div>
            <div class="modal-body" id="json-modal-data">

                <div id="tree" data-source="ajax" class="sampletree " ></div>
                {{-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia reprehenderit eligendi unde, dolore vero ullam repudiandae molestias ratione suscipit nobis quas repellat asperiores ab? Atque sequi in deserunt accusamus error ad rerum delectus cupiditate, nesciunt odit! Recusandae vitae est, veritatis sit culpa aperiam omnis! Nesciunt magni est hic, quis facilis iure fugit voluptatibus laborum suscipit accusamus. Adipisci, dolorem similique excepturi quaerat deleniti voluptate possimus ullam exercitationem aliquam perferendis, eaque dolorum nobis sed quidem! Eos, nihil eveniet itaque, deserunt ea impedit cumque eligendi tempore sint, et laborum! Quaerat beatae necessitatibus ad! Id natus, incidunt possimus corporis harum in, quis est provident nisi quaerat impedit! Voluptate debitis laborum quod reiciendis at quisquam enim deleniti, impedit, adipisci praesentium quaerat aut molestiae tenetur, amet iusto autem necessitatibus aliquam tempora cumque placeat sed ratione minima. Modi, ipsum temporibus distinctio quidem magnam, totam, expedita voluptates ducimus libero nesciunt corrupti? Sit officiis nam itaque ducimus laudantium commodi laboriosam consequuntur, natus cum assumenda nisi veritatis magnam reiciendis voluptatibus provident voluptates officia odit necessitatibus libero iure eaque, error praesentium? Neque deserunt fugiat consequuntur explicabo optio commodi quis quia tempore, ut quidem repellendus nobis eligendi quos aperiam assumenda dignissimos praesentium quasi eveniet! Sit adipisci nesciunt veritatis harum mollitia, in quos quam, atque quo aliquam delectus aspernatur perferendis quidem animi quia magni voluptatum commodi eligendi obcaecati pariatur esse dicta deleniti fugit. Id, ad incidunt, repudiandae consequuntur possimus sit expedita soluta ratione quidem nisi officiis itaque atque impedit ullam voluptas perspiciatis maiores repellat quia culpa. Ipsum nisi eos assumenda? Omnis ipsum officiis maxime quo voluptate doloremque numquam tenetur quisquam, corrupti odio porro, exercitationem nemo voluptatum quos necessitatibus. Laudantium animi quod quasi, ratione a facere vel placeat sint necessitatibus neque cumque aspernatur aliquam accusamus ipsam dolore iste. Harum beatae ea, sunt quidem pariatur eaque quos exercitationem vitae consequatur iusto minima illo provident et dolorum culpa tenetur. Eveniet magni error quisquam quia quo debitis temporibus nemo corporis amet ex voluptatum delectus, excepturi commodi. Doloremque, voluptates ducimus alias, asperiores dolorum vitae fugit harum illum accusantium eos quidem libero fugiat sapiente eum earum aliquam facilis corrupti ullam obcaecati et sed quo nobis! Commodi, explicabo perspiciatis modi et quam, suscipit enim dolorem accusantium assumenda, harum ex doloremque. Error fuga eos accusantium consectetur perferendis mollitia unde beatae eaque reiciendis ipsam vel minus fugit quis amet a, sapiente, voluptatem natus delectus? Dicta ad totam voluptas eveniet, laboriosam officia aut, quo dolorum esse laudantium rerum. Quam officiis quibusdam maiores, obcaecati sit sint id dignissimos rerum tempora facilis! Expedita assumenda hic odit, autem alias fugiat voluptas consequuntur. Velit, illum numquam? Velit asperiores accusamus magnam minus quo ex, sunt in molestias alias suscipit! Beatae, eos. Ipsa explicabo possimus repellendus saepe placeat veritatis libero, recusandae quisquam nobis amet assumenda asperiores eveniet inventore totam repellat pariatur ea! Voluptate numquam illo non sed ratione aliquam sequi debitis, ipsam, esse aut tempore quod quam. Quos doloremque, asperiores alias facere dolore, quidem impedit atque odio, dolor adipisci explicabo harum. Pariatur harum enim, quasi excepturi amet architecto maiores illo rem, hic eveniet unde, autem officia id consequuntur atque tempore repellat magnam incidunt nulla. Modi eum commodi ex corporis delectus laudantium nihil. Esse odio aut magni vero autem consectetur repellat quisquam perferendis placeat sint, saepe praesentium nemo deleniti corrupti aperiam totam voluptate libero omnis. Harum placeat nostrum officia odio excepturi doloribus exercitationem totam quibusdam vero quis molestias possimus, optio iusto pariatur. In ea unde doloribus, consequatur odit rerum sunt accusamus quam molestiae necessitatibus, ratione distinctio harum minus. Maxime numquam aperiam inventore totam officia atque, quod asperiores modi ipsum quidem magnam dignissimos laborum nemo in maiores veritatis iste aliquid, voluptas possimus corporis dolor vel cumque debitis. Officiis eaque debitis quia, in ut nisi commodi, quasi fugit blanditiis earum atque asperiores dolorem quaerat temporibus, sunt officia dignissimos sit natus a dolorum non porro repellendus.</p> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- <div id="tree" data-source="ajax" class="sampletree " ></div> --}}
     <!-- data table start -->
     <div class="col-12 mt-1">
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
                <h4 class="header-title">Set Data for Users</h4>
                <div class="data-tables  datatable-dark">
                    <table id="dataTable" class="text-center">
                        <thead class="text-capitalize">
                            <tr>
                                <th>Sr</th>
                                <th>Id </th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>No of Machines</th>
                                <th>Verified Machines</th>
                                <th>Status</th>
                                <th>User Fetched Last Data</th>
                                <th>Action</th>
                                <th>Set User Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allUsers as $user)
                                <tr>
                                    @php
                                         $verificationStatus = $user->email_verified_at ? 'Verified' : 'Pending';
                                         $verificationStatus_bg = $user->email_verified_at ? 'primary' : 'warning';
                                         $file_uploaded = $user->json_data_for_user ? 'Data Uploaded' : 'Empty';
                                         $file_uploaded_bg = $user->json_data_for_user ? 'success' : 'danger';
                                    @endphp
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{ $user->id}}</td>
                                            <td>{{ $user->name}}</td>
                                            <td>{{ $user->email}}</td>
                                            <td>{{ $user->machines_count }}</td>
                                            <td>{{ $user->machines()->where('active', 1)->count() }}</td>
                                            <td><span class="status-p bg-{{ $verificationStatus_bg }}">{{ $verificationStatus }}</span></td>
                                            <td><span class="status-p bg-{{ $file_uploaded_bg }}">{{ $file_uploaded }}</span></td>

                                            <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><a  onClick="fetchJSONUserData('{{ $user->id }}')"  data-toggle="modal" data-target="#exampleLongModalLong2" class="text-secondary"><i class="fa fa-eye"></i></a></li>

                                                </ul>
                                            </td>
                                            <td>
                                                <ul class="d-flex justify-content-center">
                                                    <li class="mr-3"><a onClick="selectedUserFunc('{{ $user->id }}')"  data-toggle="modal" data-target="#exampleModalCenter" class="text-primary">Click Here to Upload User's Data <i class="fa fa-upload"></i></a></li>
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

    {{-- @include('admin.transactions.components.editCost') --}}
@endsection
@push('js')
    {{-- @include('admin.components.datatableScript') --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.fancytree@2.27/dist/jquery.fancytree-all-deps.min.js"></script>


    {{-- <script>
          $(document).ready(function() {
        $("#tree").fancytree({
                source: [
                    {title: "Node 1", key: "1"},
                    {title: "Folder 2", key: "2", folder: true, children: [
                    {title: "Node 2.1", key: "3"},
                    {title: "Node 2.2", key: "4"}
                    ]}
                ],});
            });
        // $('select').on('change', function() {
        // alert( this.value );
        // });
    </script> --}}

<script>
    var selectedUser = 0;
    var dataStringifyJSON = null;
    $(document).ready(function() {

        $('.alert-dismiss').hide();

        const fileInput = document.getElementById("inputGroupFile04");
        const selectedFileName = document.getElementById("selectedFileName");

        fileInput.addEventListener("change", (event) => {
        const file = event.target.files[0];
        if (file) {
            selectedFileName.textContent = file.name;
        } else {
            selectedFileName.textContent = "Choose file";
        }
        });

        });

    function selectedUserFunc(id){
        selectedUser = id;
    }

    function uploadJSONOfUser() {
  $('#alert-success-user-span').html('Please Wait! Converting Data...');
  $('#alert-success-user').show();
  const fileInput = document.getElementById("inputGroupFile04");
  const file = fileInput.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = (event) => {
      const fileContent = event.target.result;
      const jsonData = JSON.parse(fileContent);
      console.log(jsonData);
      const dataStringifyJSON = JSON.stringify(jsonData); // Assign value to dataStringifyJSON

      // Perform AJAX request inside the onload event handler
      $('#alert-success-user-span').html('Please Wait! Uploading Data...');
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: '{{ route('admin.uploadJSONOfUser') }}',
        type: 'POST',
        dataType: 'json',
        data: {
          id: selectedUser,
          dataStringifyJSON: dataStringifyJSON,
        },
        success: function(response) {
          $('#alert-success-user-span').html(response.message + ' <a href="#" onclick="location.reload();" class="alert-link"> Click Here to Reload</a>');
          $('#alert-success-user').show();
          setTimeout(function() {
            $("#alert-success-user").slideUp(500);
          }, 4000);
        },
        error: function(xhr, status, error) {
          console.log(error);
          $('#alert-danger-user-span').html('Error in Uploading User Data. Try Again!');
          $('#alert-danger-user').show();
          setTimeout(function() {
            $("#alert-danger-user").slideUp(500);
          }, 3000);
        }
      });
    };
    reader.readAsText(file);
  }
}

function fetchJSONUserData(selectedUserId){



    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
    url: '{{ route('admin.fetchJSONUserData') }}', // Replace with your Laravel route URL
    type: 'POST', // Adjust the request type as needed (GET or POST)
    dataType: 'json',
    data: {
        id: selectedUserId,
    },
    success: function(response) {
       // const responcedData = JSON.parse(response.data);
       // const stringRes = JSON.stringify(responcedData);
       // const modifiedJsonString = stringRes.replace(/\\"/g, '"');


        if (response.message == "No Data Found") {
        console.log("The object is empty.");
        $('#json-modal-data').hide();
        } else {
            $('#json-modal-data').show();

            const jsonDataRes = JSON.parse(response.data);
//        console.log(jsonDataRes);

        $("#tree").fancytree({
            activeVisible: true, // Make sure, active nodes are visible (expanded)
            aria: true, // Enable WAI-ARIA support
            autoActivate: true, // Automatically activate a node when it is focused using keyboard
            autoCollapse: false, // Automatically collapse all siblings, when a node is expanded
            autoScroll: false, // Automatically scroll nodes into visible area
            clickFolderMode: 3, // 1:activate, 2:expand, 3:activate and expand, 4:activate (dblclick expands)
            checkbox: false, // Show check boxes
            checkboxAutoHide: true, // Display check boxes on hover only
            debugLevel: 4, // 0:quiet, 1:errors, 2:warnings, 3:infos, 4:debug
            disabled: false, // Disable control
            editable: true,
            focusOnSelect: false, // Set focus when node is checked by a mouse click
            escapeTitles: false, // Escape `node.title` content for display
            generateIds: false, // Generate id attributes like <span id='fancytree-id-KEY'>
            idPrefix: "ft_", // Used to generate node idÂ´s like <span id='fancytree-id-<key>'>
            icon: false, // Display node icons
            keyboard: true, // Support keyboard navigation
            keyPathSeparator: "/", // Used by node.getKeyPath() and tree.loadKeyPath()
            minExpandLevel: 1, // 1: root node is not collapsible
            rtl: false, // Enable RTL (right-to-left) mode
            selectMode: 1, // 1:single, 2:multi, 3:multi-hier
            tabindex: "0", // Whole tree behaves as one single control
            tooltip: false, // Use title as tooltip (also a callback could be specified)
            titlesTabbable: true, // Add all node titles to TAB chain// Node titles can receive keyboard focus
            quicksearch: true, // Jump to nodes when pressing first character///must true for filter

            source: JSON.parse(jsonDataRes),
            extraClasses: {
            get: function(node) {
                return node.data.shortcutKey ? "has-shortcut-key" : "";
            },
            },
            renderNode: function(event, data) {
              //////logEvent(event, data);
              var node = data.node;
              var $titleSpan = $(node.span).find(".fancytree-title");

              if ((typeof node.data.shortcutKeys !== "undefined") && (node.data.shortcutKeys != ""))
              {
                var stringTitle = $titleSpan.text();
                if (stringTitle.includes("(") && stringTitle.includes("+") && stringTitle.includes(")")) {
                  console.log("The string contains Shortcut key No render.");
                } else {
                  console.log(stringTitle);
                  $titleSpan.append(" (" + node.data.shortcutKeys + ")");
                }

              }
            },
        });


        }

       // $('#json-modal-data').html(JSON.stringify(jsonData));

    },
    error: function(xhr, status, error) {
        $('#json-modal-data').hide();

        console.log(error); // Handle error gracefully
        $('#alert-danger-user-span').html('Error in Fetching User Data. Try Again!');
        $('#alert-danger-user').show();
            setTimeout(function(){
            $("#alert-danger-user").slideUp(500);
        }, 6000);
    }
    });
}

// function verifyUser(id, name, email){

//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });

//     $.ajax({
//     url: '{{ route('admin.verify_user') }}', // Replace with your Laravel route URL
//     type: 'POST', // Adjust the request type as needed (GET or POST)
//     dataType: 'json',
//     data: {
//         id: id, // Pass the condition value
//     },
//     success: function(response) {
//         ///////

//         $('#alert-success-user-span').html(response.message+ ' <a href="#" onclick="location.reload();" class="alert-link"> Click Here to Reload</a>');
//         // Clear existing table rows
//         $('#data-table-machine tbody').empty();

//         // Iterate through the response data and populate the table
//         $.each(response.data, function(index, item) {
//          var status,status_bg ='';
//             if(item.active == '1')
//             {
//                 status = 'allowed';
//                 status_bg = 'success';
//             }
//             else
//             {
//                 status = 'restricted';
//                 status_bg = 'danger';
//             }
//             var row = '<tr>' +
//                         '<td>' + index + '</td>' +
//                         '<td>' + item.id + '</td>' +
//                         '<td>' + item.mac_address + '</td>' +
//                         '<td>' + item.hard_disk_serial + '</td>' +
//                         '<td><span class="status-p bg-'+status_bg+'">'+status+'</span></td>' +
//                         '<td><ul class="d-flex justify-content-center">' +
//                             '<li class="mr-3"><a onClick="verifyMachine(' + item.id.toString()  + ',' + item.user_id.toString()  + ')" class="text-success"><i class="fa fa-check"></i></a></li>' +
//                                         '<li><a onClick="restrictMachine(' + item.id.toString()  + ',' + item.user_id.toString()  + ')" class="text-danger"><i class="fa fa-undo"></i></a></li>' +
//                                         '</ul>' +
//                                     '</td>' +
//                         '</tr>';
//             $('#data-table-machine tbody').append(row);

//         });

//     },
//     error: function(xhr, status, error) {
//         if(xhr.status === 400)
//         {
//         $('#alert-danger-user-span').html(xhr.responseJSON.message);
//         $('#alert-danger-user').show();
//             setTimeout(function(){
//             $("#alert-danger-user").slideUp(500);
//         }, 3000);
//         }
//         else
//         {
//             $('#alert-danger-user-span').html('Some Error occured!');
//             $('#alert-danger-user').show();
//             setTimeout(function(){
//             $("#alert-danger-user").slideUp(500);
//         }, 3000);
//         }
//         console.log(error); // Handle error gracefully
//     }
//     });
// }


// function verifyMachine(id,idU){

//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });

//     $.ajax({
//     url: '{{ route('admin.verify_machine') }}', // Replace with your Laravel route URL
//     type: 'POST', // Adjust the request type as needed (GET or POST)
//     dataType: 'json',
//     data: {
//         id: id,
//         idU: idU, // Pass the condition value
//     },
//     success: function(response) {
//         ///////

//         $('#alert-success-machine-span').html('Machine is Verified Now!');
//         // Clear existing table rows
//         $('#data-table-machine tbody').empty();

//         // Iterate through the response data and populate the table
//         $.each(response, function(index, item) {
//         var status,status_bg ='';
//             if(item.active == '1')
//             {
//                 status = 'allowed';
//                 status_bg = 'success';
//             }
//             else
//             {
//                 status = 'restricted';
//                 status_bg = 'danger';
//             }
//             var row = '<tr>' +
//                         '<td>' + index + '</td>' +
//                         '<td>' + item.id + '</td>' +
//                         '<td>' + item.mac_address + '</td>' +
//                         '<td>' + item.hard_disk_serial + '</td>' +
//                         '<td><span class="status-p bg-'+status_bg+'">'+status+'</span></td>' +
//                         '<td><ul class="d-flex justify-content-center">' +
//                             '<li class="mr-3"><a  onClick="verifyMachine(' + item.id.toString()  + ',' + item.user_id.toString()  + ')" class="text-success"><i class="fa fa-check"></i></a></li>' +
//                                         '<li><a onClick="restrictMachine(' + item.id.toString()  + ',' + item.user_id.toString()  + ')" class="text-danger"><i class="fa fa-undo"></i></a></li>' +
//                                         '</ul>' +
//                                     '</td>' +
//                         '</tr>';
//             $('#data-table-machine tbody').append(row);
//             $('#alert-success-machine').show();
//             setTimeout(function(){
//             $("#alert-success-machine").slideUp(500);
//          }, 3000);

//         });

//     },
//     error: function(xhr, status, error) {
//         // if(xhr.status === 400)
//         // {
//         // $('#alert-danger-machine-span').html(response.message);
//         // $('#alert-danger-machine').show();
//         //     setTimeout(function(){
//         //     $("#alert-danger-user").slideUp(500);
//         // }, 3000);
//         // }
//         // else
//         // {
//             $('#alert-danger-machine-span').html('Some Error occured!');
//             $('#alert-danger-machine').show();
//             setTimeout(function(){
//             $("#alert-danger-machine").slideUp(500);
//          }, 3000);
//         // }
//         console.log(error); // Handle error gracefully
//     }
//     });
// }

// function restrictMachine(id,idU){
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });

//     $.ajax({
//     url: '{{ route('admin.restrict_machine') }}', // Replace with your Laravel route URL
//     type: 'POST', // Adjust the request type as needed (GET or POST)
//     dataType: 'json',
//     data: {
//         id: id,
//         idU: idU,  // Pass the condition value
//     },
//     success: function(response) {
//         ///////

//         $('#alert-success-machine-span').html('Machine is Restricted Now!');
//             // Clear existing table rows
//             $('#data-table-machine tbody').empty();

//             // Iterate through the response data and populate the table
//             $.each(response, function(index, item) {
//             var status,status_bg ='';
//                 if(item.active == '1')
//                 {
//                     status = 'allowed';
//                     status_bg = 'success';
//                 }
//                 else
//                 {
//                     status = 'restricted';
//                     status_bg = 'danger';
//                 }
//                 var row = '<tr>' +
//                             '<td>' + index + '</td>' +
//                             '<td>' + item.id + '</td>' +
//                             '<td>' + item.mac_address + '</td>' +
//                             '<td>' + item.hard_disk_serial + '</td>' +
//                             '<td><span class="status-p bg-'+status_bg+'">'+status+'</span></td>' +
//                             '<td><ul class="d-flex justify-content-center">' +
//                                 '<li class="mr-3"><a  onClick="verifyMachine(' + item.id.toString()  + ',' + item.user_id.toString()  + ')" class="text-success"><i class="fa fa-check"></i></a></li>' +
//                                             '<li><a onClick="restrictMachine(' + item.id.toString()  + ',' + item.user_id.toString()  + ')" class="text-danger"><i class="fa fa-undo"></i></a></li>' +
//                                             '</ul>' +
//                                         '</td>' +
//                             '</tr>';
//                 $('#data-table-machine tbody').append(row);

//             });
//             $('#alert-success-machine').show();
//             setTimeout(function(){
//             $("#alert-success-machine").slideUp(500);
//             }, 3000);

//     },
//     error: function(xhr, status, error) {
//         // if(xhr.status === 400)
//         // {
//         // $('#alert-danger-machine-span').html(response.message);
//         // $('#alert-danger-machine').show();
//         //     setTimeout(function(){
//         //     $("#alert-danger-user").slideUp(500);
//         // }, 3000);
//         // }
//         // else
//         // {
//             $('#alert-danger-machine-span').html('Some Error occured!');
//             $('#alert-danger-machine').show();
//             setTimeout(function(){
//             $("#alert-danger-machine").slideUp(500);
//         }, 3000);
//         //}
//         console.log(error); // Handle error gracefully
//     }
//     });
// }


</script>

@endpush



