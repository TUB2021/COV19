@extends('layouts.app')
@section('content')
  <div class="container">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Application Date</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($applicant as $key => $app)
        <tr>
            <th scope="row">{{++$key}}</th>
            <td>{{$app->name}}</td>
            <td>{{$app->email}}</td>
            <td>{{$app->applicationDate}}</td>
            <td>{{$app->status}}</td>
            <td>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detail{{$app->id}}">
                Details
              </button>
              <!-- Button trigger modal -->
              <a href="applicantqualification?application_id={{$app->application_id}}&user_id={{$app->id}}">
                <button type="button" class="btn btn-primary">
                  Qualification
                </button>
              </a>

            </td>

            <!-- Modal -->
            <div class="modal fade" id="detail{{$app->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Applicant Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm">
                        <h5>Name</h5>
                        <p>{{$app->name}}</p>
                      </div>

                      <div class="col-sm">
                        <h5>Birthdate</h5>
                        <p>{{$app->dateOfBirth}}</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm">
                        <h5>Email</h5>
                        <p>{{$app->email}}</p>
                      </div>
                      <div class="col-sm">
                        <h5>Mobile Number</h5>
                        <p>{{$app->mobileNo}}</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm">
                        <h5>ID TYPE</h5>
                        <p>{{$app->idType}}</p>
                      </div>
                      <div class="col-sm">
                        <h5>Number: </h5>
                        <p>{{$app->idNumber}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="qualification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Qualification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <h4>Applicant Name</h4>
                    <p>{{ $app->name }}</p>
                    <hr>
                    <h4>Qualification Name</h4>
                    <p id="qualificationName"></p>
                    <hr>
                    <h4>Score</h4>
                    <p id="score"></p>
                    <h4>Result</h4>
                    <p id="result"></p>
                  </div>
                  <div class="modal-footer">
                    <a href="acceptApplicant?user_id={{$app->user_id}}"><button type="submit" class="btn btn-success">Accept</button></a>
                    <a href="rejectApplicant?user_id={{$app->user_id}}"><button type="submit" class="btn btn-danger">Reject</button></a>
                  </div>
                </div>
              </div>
            </div>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
