@extends('mail.layout')
@section('view')
    <div class="content">
        <p>
            Dear <b>{{$user->name}} {{$user->surname}}</b>,
            <br> You have sent a password reset request. To reset your password, visit the link below
        <hr>
        <a href="{{config('env.FRONT_URL')}}/auth/reset-password?token={{$token}}"><b>{{config('env.FRONT_URL')}}/auth/reset-password?token={{$token}}</b></a><br>
        </p>
    </div>
@endsection
