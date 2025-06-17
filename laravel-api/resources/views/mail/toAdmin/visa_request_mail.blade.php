@extends('mail.layout')
@section('title', 'Visa request mail')
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
        <h2>New Visa request:</h2>
        <table class="table table-bordered table-striped">
            <tbody>
            <tr>
                <th>İd</th>
                <td>{{$visa->id}}</td>
            </tr>
            <tr>
                <th>App number</th>
                <td>{{$visa->application_number}}</td>
            </tr>
            <tr>
                <th>Servis</th>
                <td>{{$visa->service->title}}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    {{\App\Enums\VisaStatusEnum::getStatusName($visa->status)}}
                </td>
            </tr>
            <tr>
                <th>Nationality</th>
                <td>{{\App\Services\CommonService::getEligibleCountry($visa->nationality)?->name}}</td>
            </tr>
            <tr>
                <th>Travel Document</th>
                <td>{{$visa->travel_document}}</td>
            </tr>
            <tr>
                <th>Purpose</th>
                <td>{{$visa->purpose}}</td>
            </tr>
            <tr>
                <th>Arrival Date</th>
                <td>{{ $visa->arrival_date }}</td>
            </tr>
            <tr>
                <th>Surname</th>
                <td>{{ $visa->surname }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $visa->given_name }}</td>
            </tr>
            <tr>
                <th>Birthday</th>
                <td>{{ $visa->birthday }}</td>
            </tr>
            <tr>
                <th>Country of birth</th>
                <td>{{ $visa->country_of_birth }}</td>
            </tr>
            <tr>
                <th>Place of birth</th>
                <td>{{ $visa->place_of_birth }}</td>
            </tr>
            <tr>
                <th>Sex</th>
                <td>{{ $visa->sex }}</td>
            </tr>
            <tr>
                <th>Occupation</th>
                <td>{{ $visa->occupation }}</td>
            </tr>
            <tr>
                <th>Phone number</th>
                <td>{{ $visa->phone_number }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $visa->address }}</td>
            </tr>
            <tr>
                <th>E-mail</th>
                <td>{{ $visa->email }}</td>
            </tr>
            <tr>
                <th>Passport issue date</th>
                <td>{{ $visa->passport_issue_date }}</td>
            </tr>
            <tr>
                <th>Passport expire date</th>
                <td>{{ $visa->passport_expire_date }}</td>
            </tr>
            <tr>
                <th>Address in Azerbaijan</th>
                <td>{{ $visa->address_in_azerbaijan }}</td>
            </tr>
            <tr>
                <th>Created at</th>
                <td>{{ $visa->created_at }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
