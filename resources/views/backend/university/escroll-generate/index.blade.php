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
                <button id="generate">Generate PDF</button>
                <div class="panel-body">
                    <span id="success_message"></span>
                    <div class="form-group" id="process" style="display:none;">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                <span id="display-percentage" style="color:black;"></span>
                            </div>
                        </div>
                        <div>
                            <span id="display-time"></span>
                        </div>
                        <div id="zip-process">
                            <span class="spinner-border text-success"></span> <span>Zipping file and download...</span>
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
    var counter = 0;

    $(document).ready(function() {
        $('#zip-process').css('display', 'none');
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // $('.progress').atttr('display', 'none');
        $("#generate").click(function () {
            event.preventDefault();
            generate_pdf();
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
                error: reject
            });
        });
    }

    function get_percentage(totalStudents){
        $.ajax({
            type: 'POST',
            url: '{{route("admin.escroll.check-percentage")}}',
            data: {totalStudents: totalStudents},
            success: (data) => {
                $('.progress-bar').css('width', data.total+'%');
                console.log(data.total);
                $('#display-percentage').html(data.total_files+'/'+data.totalStudents+' ('+data.total+'%)');
                minit = parseInt(counter/60);
                second = (counter - minit*60);
                if(minit == 0 && second == 1){
                    $('#display-time').html('');
                    $('#display-time').html(second+' second elapsed');
                }
                else if(minit == 0){
                    $('#display-time').html('');
                    $('#display-time').html(second+' seconds elapsed');
                }
                else if((minit == 1 && second == 1) || (minit == 1 && second == 0)){
                    $('#display-time').html('');
                    $('#display-time').html(minit + ' minute ' +second+' second elapsed');
                }
                else {
                    $('#display-time').html('');
                    $('#display-time').html(minit + ' minutes ' +second+' seconds elapsed');
                }
                if(data.total >= 100){
                    $('.progress-bar').css('width', '100%');
                    clearInterval(clearTimer);
                    clearInterval(myInterval);
                    setTimeout(() => {
                        $('#zip-process').css('display', 'block');
                        download_zip();
                    }, 2000);
                }
                // $('#display-percentage').html('');

            },
            complete: () => {
            },
            error: (error) => {
                alert('Failed to check percentage');
                clearInterval(clearTimer);
                clearInterval(myInterval);
            }
        });
    }

    function generate_pdf(){
        $.ajax({
            type: 'POST',
            url: '{{route("admin.escroll.generate")}}',
            beforeSend: function () {
                $('#generate').attr('disabled', 'disabled');
                $('#process').css('display', 'block');
                clearTimer = setInterval(() => {
                    console.log('total_students' + totalStudents)
                    get_percentage(totalStudents);
                }, 1000);
                myInterval = setInterval(function () {
                ++counter;
                }, 1000);
            },
            success: (data) => {
            },
            complete: (data) => {
                $('#generate').attr('disabled', false);
            },
            error: (error) => {
                clearInterval(clearTimer);
                clearInterval(myInterval);
                alert(error.responseJSON.msg);
            },
        });
    }

    function download_zip(){
        $.ajax({
            type: 'POST',
            url: '{{route("admin.escroll.download-zip")}}',
            xhrFields: {
                    responseType: 'blob'
                },
            beforeSend: () => {
                $('#zip-process').css('display', 'block');
            },
            success: function(response){
                $('#zip-process').css('display', 'none');
                var blob = new Blob([response]);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "{{auth()->user()->university->acronym}}.zip";
                link.click();
            },
            complete: () => {
                $('#generate').attr('disabled', false);
            },
            error: function(blob){
            }
        })
    }
</script>
@endsection
