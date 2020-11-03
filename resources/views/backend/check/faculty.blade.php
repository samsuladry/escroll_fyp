@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Faculty'))

@section('content')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap.min.css">
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
    <div class="row">
        <div class="col">
            <div class="card text-center">
                <div class="card-header">
                    <strong>Students for Faculty {{ucwords(str_replace('-', ' ', $faculty)) }}</strong>
                    <form action="{{ route('admin.check.faculty.import', $faculty) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">Import & generate QR</button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="table-responsive-lg">
                            <table class="table table-striped table-bordered" id="students">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Matric Number</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Programme</th>
                                    <th scope="col">Citizenship</th>
                                    <th scope="col">Serial_no</th>
                                    <th scope="col">Date_endorse</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection

@push('after-scripts')
<script>
    $(document).ready(() => {
        $('#students').DataTable({
                processing: true,
                serverSide: true,
                pagingType: "full_numbers",
                ajax: '{!! route('admin.check.faculty', $faculty) !!}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'matric_no', name: 'matric_no' },
                    { data: 'name', name: 'name' },
                    { data: 'programme', name: 'programme' },
                    { data: 'citizenship', name: 'citizenship' },
                    { data: 'serial_no', name: 'serial_no' },
                    { data: 'date_endorse', name: 'date_endorse' },
                    { data: 'actions', name: 'actions' },
                ],
                aLengthMenu: [ [10, 20, 30, 40, 50,  -1], [10, 20, 30, 40, 50,  "All"] ],
                iDisplayLength: 10,
            });
    });
</script>
@endpush