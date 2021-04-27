@extends('layouts.app')
@section('content')
<div class="container">

    <h4>Applicant Name</h4>
    <p>{{ $data['username']->name }}</p>
    <hr>
    <h4>Qualification Name</h4>
    <p>{{$data['qualificationName']}}</p>
    <hr>
    <h4>Score</h4>
    <p>{{$data['count']}}</p>
    <h4>Result</h4>
    <p>
      @foreach($data['qualification'] as $qualification)
        {{ $qualification->subject }}: {{ $qualification->grade }},
      @endforeach
    </p>

    <hr>

    <a href="acceptApplicant?application_id={{$data['application_id']}}"><button type="submit" class="btn btn-success">Accept</button></a>
    <a href="rejectApplicant?application_id={{$data['application_id']}}"><button type="submit" class="btn btn-danger">Reject</button></a>

</div>
@endsection
