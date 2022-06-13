@extends('front-end.include.layout')
@section('page_title', 'Home')
{{-- @push('custom_styles') --}}
{{-- <link href="{{ asset('assets/css/simulator/dashboard.css') }}" rel="stylesheet" /> --}}

{{-- @endpush --}}
@section('container')
<div class="container">
    {{-- Section 1 --}}
    <div class="row">
        <div class="col-md-6 my-5">
            <h1 style="font-size: 3.20875rem; font-weight: 900;"><b> Schedule<br> <span>events</span> <span class="text-primary"> easily </span></b></h1>
            <p>Event Scheduler is provide easiest way for scheduling meetings professionally and efficiently,
                eliminating all the time consuming task so you can get back to work.</p>
               <p>Event & activity booking software that automates registrations, attendee database management, event marketing, & analytics so that you can focus on delivering memorable experiences</p> 
             <button class="btn btn-outline-primary btn-lg">Get Started</button>   
        </div>
        <div class="col-md-6 text-end d-sm-none d-md-block">
          <img src="{{asset("assets/Schedule.gif")}}" style="width: 75%" alt="Schedule">
        </div>
    </div>
    {{-- Section 2 --}}
    <div class="row my-5 p-4">
      <div class="col-md-12 my-3 text-center ">
        <h2>Simplified scheduling for more than <br> <b class="text-primary">10,000,000</b> users worldwide </h2>
      </div>
      <div class="col-md-4 my-2">
        <div class="card">
          <div class="card-body">
            <i class="fa-regular fa-circle-check fa-xl text-primary"></i>
            <h5 class="card-title my-2">Create simple rules</h5>
            <p>Let Calendly know your availability preferences and it’ll do the work for you.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 my-2">
        <div class="card">
          <div class="card-body">
            <i class="fa-regular fa-circle-check fa-xl text-primary"></i>
            <h5 class="card-title my-2">Share your link</h5>
            <p>Send guests your Calendly link or embed it on your website.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 my-2">
        <div class="card">
          <div class="card-body">
            <i class="fa-regular fa-circle-check fa-xl text-primary"></i>
            <h5 class="card-title my-2">Get booked</h5>
            <p>They pick a time and the event is added to your calendar.</p>
          </div>
        </div>
      </div>
    </div>
</div>
    <!-- Auth Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex">
                                    <h3 class="p-2 flex-grow-1 auth-title">Sign In</h3>
                                    <button type="button" class="btn-close p-2 m-2" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <p><span class="auth_form_msg">Don't have an account?</span> <span
                                        class="text-primary login_alternate_btn" btn_value="sign_up"
                                        style="cursor: pointer;">Sign Up </span></p>
                                <form id="auth_form" method="post" action="{{ url('auth') }}">
                                    @csrf
                                    <div class="form-floating mb-3 first_name" style="display: none">
                                        <input type="text" name="first_name" class="form-control first_name_field"
                                            placeholder="Eliot" value="-">
                                        <label for="floatingInput">First Name</label>
                                    </div>
                                    <div class="form-floating mb-3 last_name" style="display: none">
                                        <input type="text" name="last_name" class="form-control last_name_field"
                                            placeholder="Alderson" value="-">
                                        <label for="floatingInput">Last Name</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" name="email" class="form-control email"
                                            placeholder="eliot@gmail.com">
                                        <label for="floatingInput">Email address</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="password" name="password" class="form-control password"
                                            placeholder="Password">
                                        <label for="floatingPassword">Password</label>
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary my-3 auth_submit_btn">Sign
                                        In</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom_script')
    @if (session('error'))
        <script>
               swal({
                title: `{{ session('error') }}`,
                icon: "warning",
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $(".login_alternate_btn").click(function() {
                let btn_value = $(this).attr("btn_value")
                if (btn_value == "sign_up") {
                    $('.auth-title').text("Sign Up");
                    $('.first_name_field').attr("value", "");
                    $('.last_name_field').attr("value", "");
                    $('.first_name').show();
                    $('.last_name').show();
                    $('.auth_form_msg').text("Already have an account?");
                    $(this).text("Sign In");
                    $(this).attr("btn_value", "sign_in");
                    $('.auth_submit_btn').text("Sign Up");
                } else if (btn_value == "sign_in") {
                    $('.auth-title').text("Sign In");
                    $('.first_name_field').attr("value", "-");
                    $('.last_name_field').attr("value", "-");
                    $('.first_name').hide();
                    $('.last_name').hide();
                    $('.auth_form_msg').text("Don't have an account?");
                    $(this).text("Sign Up");
                    $(this).attr("btn_value", "sign_up");
                    $('.auth_submit_btn').text("Sign In");
                }
            });


           
            $(document).on("click", ".auth_submit_btn", function() {

                $.validator.addMethod("lettersonly", function(value, element) {
                        return this.optional(element) || /^[a-z\s]+$/i.test(value);
                    },
                    "Only alphabetical characters"
                );
                $("#auth_form").validate({
                    rules: {
                        first_name: {
                            required: true,
                            lettersonly: true,
                        },
                        last_name: {
                            required: true,
                            lettersonly: true,
                        },
                        email: {
                            required: true,
                            email: true,
                        },
                        password: {
                            required: true,
                            minlength: 5
                        },
                    },
                    messages: {
                        first_name: {
                            required: "Please Enter First Name",
                            lettersonly: "Only Letters Allowed",
                        },
                        last_name: {
                            required: "Please Enter Last Name",
                            lettersonly: "Only Letters Allowed",
                        },
                        email: {
                            required: "Please Enter Email Address",
                        },
                        password: {
                            required: "Please Enter Password",
                            minlength: "Your password must be at least 5 characters long"
                        },
                    },
                    errorElement: "div",
                    errorPlacement: function(error, element) {
                        error.addClass("invalid-feedback");
                        error.insertAfter(element);
                    },
                    // submitHandler: function(form) {
                        // $.ajax({
                        //     url: `{{ url('auth') }}`,
                        //     type: "POST",
                        //     data: $('#auth_form').serialize(),
                        //     dataType: "JSON",
                        //     success: function(result) {
                        //         if (result.success) {
                        //             $('#exampleModal').modal('hide');
                        //             $('#auth_form')[0].reset();
                        //             swal({
                        //                 title: `${result.msg}`,
                        //                 icon: "success",
                        //             });
                        //             // $('.key1').val(result.key);
                        //             // $(".userLoggedIn").click();

                        //             // // $(".userLoggedIn").submit();
                        //             // userLoggedIn(result.key);
                        //         } else {
                        //             $('#auth_form')[0].reset();
                        //             swal({
                        //                 title: `${result.msg}`,
                        //                 icon: "warning",
                        //             });
                        //         }
                        //     },
                        // });
                    // },
                });
            });

            // const userLoggedIn = (email) => {
            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });
            //     $.ajax({
            //         url: `{{ url('dashboard') }}`,
            //         type: "POST",
            //         data: `key = ${email}`,
            //         dataType: "JSON",
            //         success: function(result) {
            //             console.log(result);
            //         },
            //     });
            // }

         });
    </script>
@endsection
