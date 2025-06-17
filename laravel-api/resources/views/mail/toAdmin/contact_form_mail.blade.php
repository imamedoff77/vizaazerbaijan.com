@extends('mail.layout')
@section('title', 'Contact Form Mail')
@section('view')
    <div class="content">
        <h2>Contact Form Mail:</h2>
        <p>
            Ad soyad: {{$contactMessage->name}} <br>
            E-mail: {{$contactMessage->email}} <br>
            App number: {{$contactMessage->application_number}} <br>
            Mesaj: {{$contactMessage->message}}
        </p>
    </div>
@endsection
