<!DOCTYPE html>
<head>
    @include('admin.layouts.partial.head')
</head>
<body class="body-bg">
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- main wrapper start -->
    <div class="horizontal-main-wrapper">
    <div class="login-area login-s2">
        <div class="container">
            <div class="login-box ptb--100">
                <form>
                    <div class="login-form-head">
                        <h4>Sign In</h4>
                        <p>Hello there, Sign in and start managing your Admin Template</p>
                    </div>
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
                    <div class="login-form-body">

                        <div class="form-gp">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" id="emailInput" name="emailInput">
                            <i class="ti-email"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" id="passwordInput" name="passwordInput">
                            <i class="ti-lock"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                    {{-- <label class="custom-control-label" for="customControlAutosizing">Remember Me</label> --}}
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                {{-- <a href="#">Forgot Password?</a> --}}
                            </div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="submitBtn" type="submit">Submit <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            {{-- <p class="text-muted">Don't have an account? <a href="register.html">Sign up</a></p> --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

 $(document).ready(function() {
    $('.alert-dismiss').hide();
});

$(document).ready(function() {
    $('#submitBtn').click(function() {
  // Get the input values
  var email = $('#emailInput').val();
  var password = $('#passwordInput').val();

  // Prepare the request data
  $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json',
                'Authorization': 'Bearer eyJhbGciOiJSUzI1NiIsImtpZCI6IkUzN0QzMkZCNTNDQjUwNjZFNEFGOUFCN0RFNUI0QjA2NUE5OUE1RkMiLCJ0eXAiOiJhdCtqd3QiLCJ4NXQiOiI0MzB5LTFQTFVHYmtyNXEzM2x0TEJscVpwZncifQ.eyJuYmYiOjE2NTU4NzMyNTksImV4cCI6MTY1NTg4MDQ1OSwiaXNzIjoiaHR0cHM6Ly9pcTRkZXZzZXJ2ZXIucmFpbmJpcmQuY29tL2NvcmVpZGVudGl0eXNlcnZlciIsImF1ZCI6ImNvcmVBUEkiLCJjbGllbnRfaWQiOiJDMzI1NENEMS03Q0Y1LTQ2N0YtODUyNy1CQzBERUFDNEU3NUEiLCJzdWIiOiIxNjc4IiwiYXV0aF90aW1lIjoxNjU1ODcyMjI5LCJpZHAiOiJsb2NhbCIsIm5hbWUiOiJUZW5zb3IiLCJsb2NhbGUiOiJlbi1VUyIsImNvbXBhbnlfaWQiOiIxMzciLCJ1c2VyX2lkIjoiMTY3OCIsImN1bHR1cmVfaWQiOiIyMTc2Iiwic2l0ZV90eXBlIjoiQ29tbWVyY2lhbCIsImdyb3VwX2xldmVsIjoiNTAiLCJzY29wZSI6WyJwcm9maWxlIiwib3BlbmlkIiwiY29yZUFQSS53cml0ZSIsImNvcmVBUEkucmVhZCJdLCJhbXIiOlsicHdkIl19.X5Nh4kn0TFXTRJjjtqtV_skY07jxzmct8sKJFc5odIq8PccxSTWWZuU_HXzROQ0JnClWqYMJDP67iDgyIzJFtDnhamptxUYnfFCglLjJUCt8Chefe3tG5RmqCMZrP146osEb8Ta84FVAKsmh71lH_dg9csWOy11k_yjCaQIU-sAtrQMnt5P4uxX-l_987_KIonM9rHcS0O4VXuL9WawqsTGB1ya62i2T22VvbcEPgnqrzKeYVhPimUVujt67tpxx8t_VGdbLGodEDAgkN2on39WqJt6Tlce2CRHbKamSsOI36288G-b7RBYniGTHoFxxS_FghulkWeJoIrXJxAGLLQ'
            }
        });


  // Send the API request
  $.ajax({
    url: '/api/admin/verify-user',
    type: 'POST',
    dataType: 'json',
    data : {
        email: email,
        password: password,
    },
    success: function(response) {
        console.log("Working1!");
      // Check the response code
      if (response.code === 200) {
        // Successful login, handle the response
        $('#alert-success-user-span').html(response.message);
        $('#alert-success-user').show();
        setTimeout(function() {
          $("#alert-success-user").slideUp(500);
        }, 4000);
      } else {
        // Login failed, handle the response
        $('#alert-danger-user-span').html(response.message);
        $('#alert-danger-user').show();
        setTimeout(function() {
          $("#alert-danger-user").slideUp(500);
        }, 3000);
      }
      console.log("Working2!");
     },
    error: function(xhr, status, error) {
        console.log("Working3!");

      // Error in login, handle the response
      $('#alert-danger-user-span').html('Error');
      $('#alert-danger-user').show();
      setTimeout(function() {
        $("#alert-danger-user").slideUp(500);
      }, 3000);
      console.log("Working4!");

    }
  });
});
});
</script>

@include('admin.layouts.partial.script')

</div>
</body>

</html>
