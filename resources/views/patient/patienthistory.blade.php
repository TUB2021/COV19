@extends('layouts.app')
@section('content')

<h3 align="center">PATIENT HISTORY</h3>
<br>
<div class="container">
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Patient Type</th>
            <th scope="col">Symptomps</th>
            <th scope="col">Test Status</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patientHistory as $key=>$patientHistory)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$patientHistory->patient_type}}</td>
                <td>{{$patientHistory->symptomps}}</td>
                <td>{{$patientHistory->status}}</td>
                <td>{{$patientHistory->created_at}}</td>
                <td>{{$patientHistory->updated_at}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
