@extends('layouts.app')
@section('content')

<h3 align="center">SAS ADMIN</h3>
<div class="container">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#qualification" role="tab" aria-controls="qualification" aria-selected="true">Set Up qualification</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#registUniversity" role="tab" aria-controls="registUniversity" aria-selected="false">Register University</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#viewUniversity" role="tab" aria-controls="viewUniversity" aria-selected="false">View University</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="qualification" role="tabpanel" aria-labelledby="qualification-tab">
      <!-- Button trigger modal -->
      <button style="margin-top: 30px; margin-bottom: 30px;"type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Add Qualification
      </button>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Qualification</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="" action="sasAdmin/addQualification" method="post">
                @csrf
                <input class="form-control" type="text" placeholder="Qualification Name" name="name">
                <div class="row">
                  <div class="col-sm">
                    <p style="margin-top:15px;">Minimum Score</p>
                    <input class="form-control" type="number" placeholder="" name="min">
                  </div>
                  <div class="col-sm">
                    <p style="margin-top:15px;">Maximum Score</p>
                    <input class="form-control" type="number" placeholder="" name="max">
                  </div>
                  <div class="col-sm">
                    <p style="margin-top:15px;">Score Type</p>
                    <select class="form-control" name="scoreType">
                      <option>Point</option>
                      <option>Percent</option>
                    </select>
                  </div>
                </div>
                <p style="margin-top:15px;">Overall Calculation</p>
                <input class="form-control" style="margin-bottom:10px;" type="text" placeholder="" name="overall">

                <button type="submit" class="btn btn-primary">Save changes</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      @foreach($qualification as $qualification)
        <div class="card">
          <div class="card-body">
            <h3>{{$qualification->name}}</h3>
            <p>Minimum Score: {{$qualification->min}}</p>
            <p>Maximum Score: {{$qualification->max}}</p>

            <!-- Button trigger modal -->
            <button type="button" style="margin-top: 30px; margin-bottom: 30px;" class="btn btn-primary" data-toggle="modal" data-target="#editModal{{$qualification->id}}">
              Edit Qualification
            </button>

            <form class="" action="sasAdmin/deleteQualification" method="post">
              @csrf
              <input type="hidden" name="id" value="{{$qualification->id}}">
              <button type="submit" name="button" class="btn btn-danger">Delete</button>
            </form>

            <!-- Modal -->
            <div class="modal fade" id="editModal{{$qualification->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Qualification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form class="" action="sasAdmin/editQualification" method="post">
                      @csrf
                      <input type="hidden" name="id" value="{{$qualification->id}}">
                      <input class="form-control" type="text" placeholder="Qualification Name" name="name" value="{{$qualification->name}}"/>
                      <div class="row">
                        <div class="col-sm">
                          <p style="margin-top:15px;">Minimum Score</p>
                          <input class="form-control" type="number" placeholder="" name="min" value="{{$qualification->min}}"/>
                        </div>
                        <div class="col-sm">
                          <p style="margin-top:15px;">Maximum Score</p>
                          <input class="form-control" type="number" placeholder="" name="max" value="{{$qualification->max}}"/>
                        </div>
                        <div class="col-sm">
                          <p style="margin-top:15px;">Score Type</p>
                          <select class="form-control" name="scoreType">
                            <option value="point" {{ ( $qualification->scoreType == 'point') ? 'selected' : '' }}>Point</option>
                            <option value="percent" {{ ( $qualification->scoreType == 'percent') ? 'selected' : '' }}>Percent</option>
                          </select>
                        </div>
                      </div>
                      <p style="margin-top:15px;">Overall Calculation</p>
                      <input class="form-control" style="margin-bottom:10px;" type="text" placeholder="" name="overall" value="{{$qualification->overall}}">

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
    <div class="tab-pane fade" id="registUniversity" role="tabpanel" aria-labelledby="registUniversity-tab">
      <form style="margin-top:40px;"action="sasAdmin/AddUniversity" method="post">
        @csrf
        <div class="form-group">
          <label for="universityName">University Name</label>
          <input type="text" class="form-control" id="universityName" aria-describedby="emailHelp" name="name">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
    <div class="tab-pane fade" id="viewUniversity" role="tabpanel" aria-labelledby="viewUniversity-tab">
      @foreach($universities as $uni)
        <div class="card">
          <div class="card-body">
            <h4>{{ $uni->name }}</h4>
            <p>{{ $uni->universityDetails }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
