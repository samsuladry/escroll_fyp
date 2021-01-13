<div class="form-inline">
    <button type="button" class="btn btn-primary btn-sm form-inline" data-toggle="modal" data-target="#section-edit-{{ $academic->id }}" title="Edit">
        <i class="fas fa-pencil-alt" aria-hidden="true"></i> 
    </button>

        <!-- Modal -->
    <div class="modal fade" id="section-edit-{{ $academic->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
    
                <form action="{{ route('admin.academic.update', $academic->id) }}" method="post">
                    @csrf
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row" style="margin-top: 5%;">
                            <label for="name" class="col-sm-4 col-form-label">Name</label>
                            <div class="col-sm-8">
                                <input name="name" type="text" placeholder="{{ $academic->name }}" value="{{ $academic->name }}" class="form-control" style="width:100%;">
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