@extends('layouts.app')
@section('content')

<h3 align="center">DASHBOARD TESTER</h3>
<div class="container">

@if(Session::has('status'))
  <div class="alert {{ Session::get('alert-class') }} alert-dismissible fade show" role="alert">
    {{ Session::get('status') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Record Test</a>
  </div>
</nav>

<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <!-- Button trigger modal -->
    <button style="margin-top: 30px; margin-bottom: 30px;"type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Record Test
    </button>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Record Test</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="" action="tester/addnewtest" method="post">
              @csrf
              <input class="form-control" type="text" placeholder="Patient Name" name="name">
              <br>
              <input class="form-control" type="email" placeholder="Email" name="email">
              <br>
              <input class="form-control" type="password" placeholder="Password" name="password">
              <br>
              <select class="form-control" aria-label="Patient Type" name="patientType">
                <option selected disable>Select Patient Type</option>
                <option value="Returnee">Returnee</option>
                <option value="Quarantined">Quarantined</option>
                <option value="Close Contact">Close Contact</option>
                <option value="Infected">Infected</option>
                <option value="Suspected">Suspected</option>
              </select>
              <br>
              <input class="form-control" type="symptomps" placeholder="Symptomps" name="symptomps">
              <br>
              <!--
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
              </div> -->

              <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- data list -->
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">History</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($patient as $key=>$patient)
            <tr>
              <th scope="row">{{$key+1}}</th>
              <td>{{$patient->name}}</td>
              <td>{{$patient->email}}</td>
              <td>{{$patient->created_at}}</td>
              <td>{{$patient->updated_at}}</td>
              <td>
                <!-- Button trigger modal -->
                <a href="tester/patienthistory/{{$patient->id}}">Show History</a>
              </td>
              <td>
                <!-- Button trigger modal -->
                <button type="button" style="float: left;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$key}}">
                  Edit
                </button>

                <form class="" action="tester/deleteTestRecord" method="post" >
                  @method('DELETE')
                  @csrf
                  <input type="hidden" name="id" value="{{$patient->id}}">
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">
                    Delete
                  </button>
                </form>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Test</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form class="" action="tester/updatePatient" method="post">
                          @method('PUT')
                          @csrf
                          <input type="hidden" name="user_id" value="{{$patient->id}}">
                          <input class="form-control" type="text" placeholder="Name" name="name" value="{{$patient->name}}">
                          <br>
                          <input class="form-control" type="email" placeholder="Email" name="email" value="{{$patient->email}}">
                          <br>
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                      </div>
                    </div>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
  </div>
</div>
</div>
</div>
@endsection
