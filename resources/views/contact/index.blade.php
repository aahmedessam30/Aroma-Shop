@extends('layouts.main')

@section('title', 'Contact')

@section('content')
    <!-- ================ start banner area ================= -->
    <section class="blog-banner-area" id="contact">
        <div class="container h-100">
            <div class="blog-banner">
                <div class="text-center">
                    <h1>Contact Us</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ end banner area ================= -->

    <!-- ================ contact section start ================= -->
    <section class="section-margin--small">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-3 mb-4 mb-md-0">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>El-Dakahlia Egypt</h3>
                            <p>Mansoura</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-mobile"></i></span>
                        <div class="media-body">
                            <h3>01094286927</h3>
                            <p>Mon to Fri 9am to 6pm</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3>aahmedessam30@gmail.com</h3>
                            <p>Send us your query anytime!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-9">
                    <form class="form-contact contact_form" id="contactForm">
                        @csrf
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <input class="form-control" name="name" id="name" type="text"
                                        placeholder="Enter your name">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="email" id="email" type="email"
                                        placeholder="Enter email address">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="subject" id="subject" type="text"
                                        placeholder="Enter Subject">
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <textarea class="form-control different-control w-100" name="message" id="message"
                                        cols="30" rows="5" placeholder="Enter Message"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center text-md-right mt-3">
                            <button type="submit" class="button button--active button-contactForm">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
@endsection

@section('scripts')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#contactForm").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ route('contact.send') }}",
                    data: {
                        name: $("input[name='name']").val(),
                        email: $("input[name='email']").val(),
                        subject: $("input[name='subject']").val(),
                        message: $("textarea[name='message']").val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.err) {
                            toastr["error"](response.err);
                            toastr.options = {
                                "timeOut": "1000",
                            }
                        } else {
                            $("input[name='name']").val("");
                            $("input[name='email']").val("");
                            $("input[name='subject']").val("");
                            $("textarea[name='message']").val("");
                            toastr["success"](response.msg);
                            toastr.options = {
                                "timeOut": "1000",
                            }
                        }
                    },
                    error: function(response) {
                        $.each(response.responseJSON.errors, function(key, val) {
                            toastr["error"](val);
                            toastr.options = {
                                "timeOut": "1000",
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
