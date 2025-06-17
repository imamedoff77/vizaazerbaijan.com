@extends('mail.layout')
@section('title', 'Visa Application Decision')
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
        Thank you for your recent visa application. <br>
        We regret to inform you that, after careful consideration, your visa application has not been approved at this
        time. Please refer to the attached letter for details regarding the decision.
        <br>
        If you have any questions or wish to reapply in the future, you are welcome to contact us for further guidance.
        <br>
        We appreciate your interest and understanding. <br>
        Your service: <b>{{$visa->service->title}}</b> <br>
        Your application number: <b>{{$visa->application_number}}</b> <br><br>

        @if(isset($visa->rejected) && !empty($visa->rejected->message))
            Admin message: <u>{!! $visa->rejected->message !!}</u>
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
