@extends('layouts.app')
@section('content')

<h3 align="center">Test Center Officer Dashboard</h3>
@isset($testCenter)
<h3 align="center">Location : {{ $testCenter->name }}</h3>
@endisset
<br>
<div class="container">
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Patient Type</th>
            <th scope="col">Symptomps</th>
            <th scope="col">Test Status</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patient as $key=>$patient)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$patient->name}}</td>
                <td>{{$patient->email}}</td>
                <td>{{$patient->patient_type}}</td>
                <td>{{$patient->symptomps}}</td>
                <td>{{$patient->status}}</td>
                <td>{{$patient->created_at}}</td>
                <td>{{$patient->updated_at}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
