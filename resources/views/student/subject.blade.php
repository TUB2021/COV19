@extends('layouts.app')
@section('content')
<div class="container">
  <form class="" action="student/..." method="post">
    @csrf
    <div class="form-group">
      <label for="idType">Qualification</label>
      <select class="form-control" name="qualification" id="qualification">
          <option value="" selected disabled>Choose</option>
        @foreach($qualification as $qualification)
          <option value="{{$qualification->id}}">{{$qualification->name}}</option>
        @endforeach
      </select>
      <script type="text/javascript">
      $(document).ready(function () {
          $('select[name="qualification"]').on('change', function() {
            $.ajax({
                 url: "getQualification",
                 method: 'GET',
                 data: "qualification_id="+$(this).val(),
                 success: function(data) {
                   console.log('success')
                     $('#input').html(
                       '<label for="grade" style="margin-right: 20px;">Grade</label>' +
                       '<input style="float: left"type="number" id="grade" class="form-control" min="'+data.min+'" max="'+data.max+'">' +
                       '<small style="color: red">min grade: '+data.min+' and max grade: '+data.max+'</small>' +
                       '<button onclick="addSubject()" id="btnAddSubject" style="float: right; margin-top: 20px;" type="button" name="button" class="btn btn-primary">ADD</button>'
                     );
                 }
             });
          });

      });

      function addSubject(){
        var grade = $('#grade').val();
        var subject = $('#subject').val();

        $.ajax({
             url: "addSubject",
             method: 'GET',
             data: {subject: subject, grade: grade},
             success: function(data) {
               console.log(data.stat)

             }
         });
      }
      </script>
    </div>
    <div class="row">
      <div class="col-sm">
        <div class="form-group">
          <label for="subject">Subject Name</label>
          <input type="text" name="subject" id="subject" value="" class="form-control">
        </div>
      </div>
      <div class="col-sm">
        <div class="form-group" id="input">
        </div>
      </div>
    </div>
    <hr>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Subject Name</th>
          <th scope="col">Grade</th>
        </tr>
      </thead>
      <tbody>
        @if(Session::has('subject'))
          @foreach($subject as $key => $sub)
            <tr>
              <td>{{$sub['subject']}}</td>
              <td>{{$sub['grade']}}</td>
            </tr>
          @endforeach
        @endif
      </tbody>
    </table>
    <button type="submit" class="btn btn-primary">Save changes</button>
  </form>
</div>
@endsection
