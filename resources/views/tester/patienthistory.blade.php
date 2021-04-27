@extends('layouts.app')
@section('content')

<h3 align="center">PATIENT HISTORY</h3>
<br>
<div class="container">
    <div class="row">
        <div class="col-3">
            <p>Name : {{ $user->name }}</p>
            <p>Email : {{ $user->email }}</p>
            <p>Tester : {{ $tester->name }}</p>
            <p>Test Location : {{ $tester->test_center_name }}</h3>
            <br>
            <button type="button" style="margin-top: 20px; width: 100%" class="btn btn-primary" data-toggle="modal" data-target="#update">
                Update
            </button>
            </div>
        <div class="col-sm">
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
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Test</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" action="/tester/updatetestrecord" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <select class="form-control" aria-label="Patient Type" name="patientType">
                    <option value="Returnee">Returnee</option>
                    <option value="Quarantined">Quarantined</option>
                    <option value="Close Contact">Close Contact</option>
                    <option value="Infected">Infected</option>
                    <option value="Suspected">Suspected</option>
                    </select>
                    <br>
                    <select class="form-control" aria-label="Patient Type" name="status">
                    <option value="pending">pending</option>
                    <option value="complete">complete</option>
                    </select>
                    <br>
                    <input class="form-control" type="text" placeholder="Symptomps" name="symptomps">
                    <br>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
