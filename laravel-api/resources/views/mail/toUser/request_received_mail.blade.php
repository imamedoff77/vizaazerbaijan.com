@extends('mail.layout')
@section('title', 'Visa Application Form Submitted')
@section('view')
    @section('custom_styles')
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }

            table th, table td {
                padding: 8px;
                border: 1px solid #ddd;
                text-align: left;
            }

            table tr {
                background-color: #f2f2f2;
            }

            table td {
                background-color: #ddd;
            }
        </style>
    @endsection
    <div class="content">
        Dear {{$visa->given_name}}, <br><br>
        This is to confirm that your visa application form has been successfully submitted. <br>
        Our team will now begin processing your application. If any additional documents or information are required, we
        will contact you directly. <br>
        Thank you for your submission. We appreciate your patience during the review process. <br>
        Your service: <b>{{$visa->service->title}}</b> <br>
        Your application number: <b>{{$visa->application_number}}</b> <br><br>

        Best regards, <br>
        Support team <br>
        AzerbaijanViza
        <br><br>
        <hr>
        <br>
        <a href="{{config('env.FRONT_URL')}}">Home page</a>
    </div>
@endsection
