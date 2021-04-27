@extends('layouts.app')
@section('content')

@if(Session::has('code'))
  @if(Session::get('code') == '1')
    <script type="text/javascript">
      alert({{ Session::get('message') }})
    </script>
  @else
    <script type="text/javascript">
      alert({{ Session::get('message') }})
    </script>
  @endif
@endif

<h3 align="center">STUDENT</h3>
<div class="container">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#universityList" role="tab" aria-controls="qualification" aria-selected="true">University List</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#applicantStatus" role="tab" aria-controls="registUniversity" aria-selected="false">Applicant Status</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent" style="margin-top: 30px;">
    <div class="tab-pane fade show active" id="universityList" role="tabpanel" aria-labelledby="qualification-tab">
      @foreach($university as $uni)
        <div class="card" style="width: 20rem; float: left;">
          <div class="card-body">
            <h4>{{$uni->name}} - {{$uni->programmeName}}</h4>
            <p>{{$uni->universityDetails}}</p>
            <hr>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$uni->id}}">
              Apply
            </button>

            <!-- Modal -->
            @if($data)
              <div class="modal fade" id="exampleModal{{$uni->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Qualification</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="deleteAllSubject{{$uni->id}}()">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form class="" action="addApplicantQualification" method="post">
                        @csrf
                        <input type="hidden" name="programme_id" value="{{$uni->id}}">
                        <div class="form-group">
                          <label for="idType">Qualification</label>
                          <select class="form-control" name="qualification" id="qualification{{$uni->id}}">
                              <option value="" selected disabled>Choose</option>
                              @foreach($qualification as $qual)
                                <option value="{{$qual->id}}">{{$qual->name}}</option>
                              @endforeach
                          </select>
                          <script type="text/javascript">
                          $(document).ready(function () {
                              $('select[id="qualification{{$uni->id}}"]').on('change', function() {
                                $("#subjectTable{{$uni->id}} tr").remove();
                                $.ajax({
                                     url: "getQualification",
                                     method: 'GET',
                                     data: "qualification_id="+$(this).val(),
                                     success: function(data) {
                                       console.log('success')
                                         $('#input{{$uni->id}}').html(
                                           '<label for="grade" style="margin-right: 20px;">Grade</label><br>' +
                                           '<input style="float: left"type="number" id="grade{{$uni->id}}" class="form-control" min="'+data.min+'" max="'+data.max+'">' +
                                           '<small style="color: red">min grade: '+data.min+' and max grade: '+data.max+'</small>' +
                                           '<button onclick="addSubject{{$uni->id}}()" id="btnAddSubject{{$uni->id}}" style="float: right; margin-top: 20px;" type="button" name="button" class="btn btn-primary">ADD</button>'
                                         );
                                     }
                                 });
                              });

                          });

                          function deleteAllSubject{{$uni->id}}(){
                            $("#subjectTable{{$uni->id}} tr").remove();
                            $.ajax({
                                 url: "deleteAllSubject",
                                 method: 'GET',
                                 success: function(data) {
                                   console.log('delete success')
                                 }
                             });
                          }
                          function addSubject{{$uni->id}}(){
                            var grade = $('#grade{{$uni->id}}').val();
                            var subject = $('#subject{{$uni->id}}').val();

                            if (grade == 'null' || subject == 'null'){
                                console.log('null')
                            }else{
                              $.ajax({
                                   url: "addSubject",
                                   method: 'GET',
                                   data: {subject: subject, grade: grade},
                                   success: function(data) {
                                     console.log('success')
                                     var trHTML = '';
                                      $.each(data, function (i, item) {
                                          trHTML += '<tr><td>' + item.subject + '</td><td>' + item.grade + '</td> <td><button onclick="deleteSubject{{$uni->id}}('+item.id+')" type="button" class="btn btn-danger">Delete</button></td></tr>';
                                      });
                                      $("#subjectTable{{$uni->id}} tr").remove();
                                      $('#subjectTable{{$uni->id}}').append(trHTML);
                                   }
                               });
                             }
                          }

                          function deleteSubject{{$uni->id}}(id){
                            $.ajax({
                                 url: "deleteSubject",
                                 method: 'GET',
                                 data: {id: id},
                                 success: function(data) {
                                   console.log('success')
                                   var trHTML = '';
                                    $.each(data, function (i, item) {
                                        trHTML += '<tr><td>' + item.subject + '</td><td>' + item.grade + '</td> <td><button onclick="deleteSubject('+item.id+')" type="button" class="btn btn-danger">Delete</button></td></tr>';
                                    });
                                    $("#subjectTable{{$uni->id}} tr").remove();
                                    $('#subjectTable{{$uni->id}}').append(trHTML);
                                 }
                             });
                          }
                          </script>
                        </div>
                        <div class="row">
                          <div class="col-sm">
                            <div class="form-group">
                              <label for="subject">Subject Name</label>
                              <input type="text" name="subject" id="subject{{$uni->id}}" value="" class="form-control">
                            </div>
                          </div>
                          <div class="col-sm">
                            <div class="form-group" id="input{{$uni->id}}">
                            </div>
                          </div>
                        </div>
                        <hr>
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Subject Name</th>
                              <th scope="col">Grade</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody id="subjectTable{{$uni->id}}">
                          </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            @else
              <div class="modal fade" id="exampleModal{{$uni->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Applicants Data</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form class="" action="student/addApplicantData" method="post">
                        @csrf
                        <div class="form-group">
                          <label for="idType">ID Type</label>
                          <select class="form-control" id="idType" name="idType">
                            <option value="id">ID</option>
                            <option value="passport">PASSPORT</option>
                            <option value="drivinglicense">DRIVING LICENSE</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="idNumber">Id Number</label>
                          <input type="text" class="form-control" id="idNumber" name="idNumber">
                        </div>
                        <div class="form-group">
                          <label for="mobileNo">Mobile Number</label>
                          <input type="number" class="form-control" id="mobileNo" name="mobileNo">
                        </div>
                        <div class="form-group">
                          <label for="dateOfBirth">Date of Birth</label>
                          <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth">
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          </div>
        </div>
      @endforeach
    </div>
    <div class="tab-pane fade" id="applicantStatus" role="tabpanel" aria-labelledby="qualification-tab">
      @foreach($applicantStatus as $status)
        <div class="card">
          <div class="card-body">
            <h3 style="float: left;">{{$status->name}} - {{$status->programmeName}}</h3>
            <h4 style="float: right;">{{$status->status}}</h4>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
