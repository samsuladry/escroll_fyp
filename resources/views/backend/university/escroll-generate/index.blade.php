@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Template'))

@section('content')
<div class="row">
    <div class="col">
        <div class="card text-center">
            <div class="card-header">
                <strong>Generate PDF</strong>
            </div>
            <div class="card-body">
                <button id="generate" disabled>Generate PDF</button>
                <div class="panel-body">
                    <span id="success_message"></span>
                    <div class="form-group" id="process" style="display:block;">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div><!--card-body-->
        </div><!--card-->
    </div><!--col-->
</div><!--row-->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    var totalStudents = 0;

    $(document).ready(function() {
        console.log('test');
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#generate").click(function () {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: '{{route("admin.escroll.dean-count")}}',
                beforeSend: function () {
                    $('#generate').attr('disabled', 'disabled');
                    $('#process').css('display', 'block');
                    clearTimer = setInterval(() => {
                        get_updated_percentage(totalStudents);
                    }, 1000);
                },
                success: (data) => {
                    console.log(data);
                    $.each(data.data, (k, v) => {
                        var stop = 0;
                        while( stop == 0 ){
                            console.log('while not stop');
                            generate_pdf_by_batch(v)
                            .then(result => {
                                stop = result.finish;
                            })
                            .catch(err => {
                                alert('failed to generate pdf for studenst');
                            });
                        }
                    });
                },
                error: () => {
                    alert('failed to generate pdf for studenst1');
                },
            });
        });

        get_total_students()
        .then(result => {
            totalStudents = result.total;
        })
        .catch(err => {
            alert('Error getting total students');
        });
    });

    function get_total_students(){
        return new Promise((resolve, reject) => {
            $.ajax({
                type:"POST",
                url: '{{route("admin.escroll.total-students")}}',
                success: resolve,
                error: reject,
            });
        });
    }

    function get_updated_percentage(data){
        $.ajax({
            type: 'POST',
            url: '{{route("admin.escroll.check-percentage")}}',
            data: {totalStudents: data},
            success: (data) => {
                $('.progress-bar').css('width', data+'%');
                if(data >= 100){
                    $('.progress-bar').css('width', '100%');
                    $('#generate').attr('disabled', false);
                    clearInterval(clearTimer);
                }
            },
            error: (error) => {
                alert('Failed to check percentage');
            }
        })
    }

    async function generate_pdf_by_batch(dean){
        return new Promise((resolve, reject) => {
            $.ajax({
                type: 'POST',
                url: '{{route("admin.escroll.generate")}}',
                data: {dean_id: dean},
                success: resolve,
                error: reject,
            });
        });
    }
</script>
@endsection
