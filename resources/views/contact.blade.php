@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="recent">
                <button class="btn-primarys"><h3>Contact Us</h3></button>
                <hr style="margin: 0;">
            </div>
        </div>
    </div>
    {{--<div class="container">
        <div class="row">
            <div id="google-map" data-latitude="40.713732" data-longitude="-74.0092704"></div>
        </div>
    </div>--}}

    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="recent">
                    <button class="btn-primarys"><h3>Send us a message</h3></button>
                </div>

                <div id="sendmessage">Your message has been sent. Thank you!</div>
                <div id="errormessage"></div>
                <form role="form" class="contactForm">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                        <div class="validation"></div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                        <div class="validation"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                        <div class="validation"></div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                        <div class="validation"></div>
                    </div>

                    <button type="button" class="btn btn-default">Submit</button>
                </form>
            </div>

            <div class="col-lg-6">
                <div class="recent">
                    <button class="btn-primarys"><h3>Get in touch with us</h3></button>
                </div>
                <div class="contact-area">
                    <p>Nam liber tempor cum soluta nobis eleifend option
                        congue nihil imperdiet doming id quod mazim placerat
                        facer possim assum. Typi non habent claritatem insitam;
                        est usus legentis in iis qui facit eorum.</p>
                    <p>Nam liber tempor cum soluta nobis eleifend option
                        congue nihil imperdiet doming id quod mazim placerat
                        facer possim assum. Typi non habent claritatem insitam;
                        est usus legentis in iis qui facit eorum.</p>

                    <h4>Address:</h4>123 Street Texas,USA<br>
                    <h4>Telephone:</h4>123 456 789</br>
                    <h4>Fax:</h4>123 456 789
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
   {{-- <script src="https://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/js/functions.js') }}"></script>--}}
@endsection