<div class="form-inline">
    <button type="button" class="btn btn-danger btn-sm form-inline" data-toggle="modal" data-target="#section-delete-{{ $academic->id }}" title="Delete">
        <i class="fas fa-trash-alt" aria-hidden="true"></i> 
    </button>

        <!-- Modal -->
    <div class="modal fade" id="section-delete-{{ $academic->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
    
                <form action="{{ route('admin.academic.destroy', $academic->id) }}" method="post">
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        <h5 class="text-center">Are you sure you want to delete <strong>{{ $academic->name }}</strong> ?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>