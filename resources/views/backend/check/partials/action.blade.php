<div class="form-inline">
    <button type="button" class="btn btn-primary btn-sm form-inline" data-toggle="modal" data-target="#section-edit-{{ $student->id }}" title="Edit">
        <i class="fas fa-pencil-alt" aria-hidden="true"></i> 
    </button>

        <!-- Modal -->
<div class="modal fade" id="section-edit-{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
  
        <form action="{{ route('admin.check.update', $student->id) }}" method="post">
        {{-- <input type="hidden" name="_method" value="PUT"> --}}
  
        {{ csrf_field() }}
  
  
        <div class="modal-header bg-primary">
          <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
  
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
  
        </div>
        <div class="modal-body">
          
        <div class="form-group row" style="margin-top: 5%;">
            <label for="matric_no" class="col-sm-4 col-form-label">Matric Number</label>
            <div class="col-sm-8">
                <input name="matric_no" type="text" placeholder="{{ $student->matric_no }}" value="{{ $student->matric_no }}" class="form-control" style="width:100%;">
            </div>
        </div>

        <div class="form-group row" style="margin-top: 5%;">
            <label for="name" class="col-sm-4 col-form-label">Name</label>
            <div class="col-sm-8">
                <input name="name" type="text" placeholder="{{ $student->name }}" value="{{ $student->name }}" class="form-control" style="width:100%;">
            </div>
        </div>

          <div class="form-group row" style="margin-top: 5%;">
            <label for="faculty" class="col-sm-4 col-form-label">Faculty</label>
            <div class="col-sm-8">
              <input name="faculty" type="text" placeholder="{{ $student->faculty }}" value="{{ $student->faculty }}" class="form-control" style="width:100%;">
            </div>
          </div>

          <div class="form-group row" style="margin-top: 5%;">
            <label for="programme" class="col-sm-4 col-form-label">Programme</label>
            <div class="col-sm-8">
              <input name="programme" type="text" placeholder="{{ $student->programme }}" value="{{ $student->programme }}" class="form-control" style="width:100%;">
            </div>
          </div>

          <div class="form-group row" style="margin-top: 5%;">
            <label for="citizenship" class="col-sm-4 col-form-label">Citizenship</label>
            <div class="col-sm-8">
              <input name="citizenship" type="text" placeholder="{{ $student->citizenship }}" value="{{ $student->citizenship }}" class="form-control" style="width:100%;">
            </div>
          </div>

          <div class="form-group row" style="margin-top: 5%;">
            <label for="serial_no" class="col-sm-4 col-form-label">Serial Number</label>
            <div class="col-sm-8">
              <input name="serial_no" type="text" placeholder="{{ $student->serial_no }}" value="{{ $student->serial_no }}" class="form-control" style="width:100%;">
            </div>
          </div>

          <div class="form-group row" style="margin-top: 5%;">
            <label for="date_endorse" class="col-sm-4 col-form-label">Date Endorsed</label>
            <div class="col-sm-8">
              <input name="date_endorse" type="datetime-local" placeholder="{{ $student->date_endorse }}" value="{{ \Carbon\Carbon::parse($student->date_endorse)->format("Y-m-d")."T".\Carbon\Carbon::parse($student->date_endorse)->format("H:i") }}" class="form-control" style="width:100%;">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
  
        </form>
  
      </div>
    </div>
  </div>
</div>