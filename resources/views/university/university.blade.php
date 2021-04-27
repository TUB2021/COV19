@extends('layouts.app')
@section('content')

<h3 align="center">UNIVERSITY ADMIN</h3>
<div class="container">
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Programme</a>
    <a class="nav-item nav-link" id="nav-applicant-tab" data-toggle="tab" href="#nav-applicant" role="tab" aria-controls="nav-applicant" aria-selected="false">Applicants</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="false">University Details</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <!-- Button trigger modal -->
    <button style="margin-top: 30px; margin-bottom: 30px;"type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Add Programme
    </button>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Programme</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="" action="university/addProgramme" method="post">
              @csrf
              <input class="form-control" type="text" placeholder="Programme Name" name="programmeName">

              <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
              </div>

              <p style="margin-top:15px;">Closing Date</p>
              <input class="form-control" type="date" name="closeDate">
              <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- programme list -->
    @foreach($programme as $programme)
      <div class="card" >
        <div class="card-body">
          <h4>{{$programme->programmeName}}</h4>
          <p>{{$programme->description}}</p>
          <small>Closing Date: {{$programme->closeDate}}</small>
          <br>
          <!-- Button trigger modal -->
          <button style="margin-top: 30px; margin-bottom: 30px;"type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProgramme{{$programme->id}}">
            Edit Programme
          </button>
          <form class="" action="university/deleteProgramme" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$programme->id}}">
            <button type="submit" name="button" class="btn btn-danger">Delete</button>
          </form>
          <!-- Modal -->
          <div class="modal fade" id="editProgramme{{$programme->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Programme</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form class="" action="university/editProgramme" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$programme->id}}">
                    <input class="form-control" type="text" placeholder="Programme Name" name="programmeName" value="{{$programme->programmeName}}">

                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Description</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" >{{$programme->description}}</textarea>
                    </div>

                    <p style="margin-top:10px;" >Closing Date</p>
                    <input class="form-control" type="date" name="closeDate" value="{{$programme->closeDate}}">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    @endforeach
  </div>
  <div class="tab-pane fade" id="nav-applicant" role="tabpanel" aria-labelledby="nav-applicant-tab" style="padding-top: 50px;">
    @foreach($applicant as $applicant)
      <div class="card" style="width: 18rem;float: left;">
        <div class="card-body">
          <h4>{{$applicant->programmeName}}</h4>
          <p>{{$applicant->description}}</p>
          <small>Closing Date: {{$applicant->closeDate}}</small>
          <br>
          <!-- Button trigger modal -->
          <form class="" action="getApplicant" method="get">
            <input type="hidden" name="programme_id" value="{{$applicant->id}}">
            <button style="margin-top: 30px; margin-bottom: 30px;"type="submit" class="btn btn-primary">
              View Applicant ( {{$applicant->countApplicant}} )
            </button>
          </form>
        </div>
      </div>
    @endforeach
  </div>
  <div class="tab-pane fade" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
    <form class="" action="university/updateDetails" method="post">
      @csrf
      <div class="form-group">
        <p style="margin-top:10px;" ></p>
        <label for="exampleFormControlTextarea1">University Description</label>
        @foreach($univdetail as $univdetail)
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="universityDetails" value=''>{{$univdetail->universityDetails}}</textarea>
        @endforeach
        <button type="submit" style="margin-top:10px;" class="btn btn-primary">Save changes</button>
      </div>
    </form>
  </div>
</div>
</div>
</div>
@endsection
