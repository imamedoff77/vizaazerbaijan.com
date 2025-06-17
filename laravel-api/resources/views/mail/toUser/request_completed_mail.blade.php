@extends('mail.layout')
@section('title', 'Visa Approval Notification')
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
        We are pleased to inform you that your visa application has been approved. <br>
        Please check the attached documents for further details and instructions regarding the next steps. If you have
        any questions, feel free to contact us.
        Congratulations, and we wish you a pleasant journey! <br>
        Your service: <b>{{$visa->service->title}}</b> <br>
        Your application number: <b>{{$visa->application_number}}</b> <br><br>

        @if(!empty($visa->completed_message))
            Admin message: <u>{!! $visa->completed_message !!}</u>
            <br><br>
        @endif


        Best regards, <br>
        Support team <br>
        AzerbaijanViza
        <br><br>
        <hr>
        <br>
        <a href="{{config('env.FRONT_URL')}}">Home page</a>
    </div>
@endsection
