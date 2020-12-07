<html>
<head>
    <meta http-equiv=Content-Type content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css">
        body, html {
            /* min-height: 100vh; */
            /* width: 100%;
            height: 100%; */
            /* margin: 0px; */
        }
        div.highlight{
            border-color: red !important;
        }
        div.dragme{
            position: absolute;
            left: 0;
            top: 0;
            /* set these so Chrome doesn't return 'auto' from getComputedStyle */
            width: 50%;
            background: rgba(255, 255, 255, 1);
            border: 2px solid rgba(0, 0, 0, 1);
            text-align: CENTER;
            opacity: 0.75;
            resize: both;
            overflow: auto;
            vertical-align: middle;
            border-radius: 4px;
            /* padding: 8px; */
        }
        @page { margin: 0px; }
    </style>
    <style>
        body {
            background-image: url({{base_path().'/public/storage/'.$template->image_template}});
            background-repeat: no-repeat;
        }
        img {
            user-drag: none; 
            user-select: none;
            -moz-user-select: none;
            -webkit-user-drag: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }
        //
    </style>
    
<script type="text/javascript" src="{{asset('example-escroll/wz_jsgraphics.js')}}"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

{{-- <div class="body"> --}}
    @if ($downloaded == 1)
        {{-- <img src="{{base_path().'/public/storage/'.$template->image_template}}"> --}}
            
        @if ($template->escrollSetup->name == 1)
            <div draggable="true" id="name" class="ui-widget-content" style="{{$template->name_position}}position:absolute;text-align: CENTER;" data-item="0"><span>{{$student->name}}</span></div>
        @endif
        @if ($template->escrollSetup->bachelor == 1)
            <div draggable="true" id="bachelor" class="ui-widget-content" style="{{$template->bachelor_position}}position:absolute;text-align: CENTER;" data-item="1"><span>{{$student->department->name}}</span></div>
        @endif
        @if ($template->escrollSetup->left_signature == 1)
            <div draggable="true" id="left" class="ui-widget-content" style="{{$template->left_signature_position}}position:absolute;text-align: CENTER;" data-item="2"><img src="{{base_path().'/public/storage/'.$dean->signature}}" alt="dean" style="max-width:100%;max-height:100%;" unselectable="on"></div>
        @endif
        @if ($template->escrollSetup->right_signature == 1)
            <div draggable="true" id="right" class="ui-widget-content" style="{{$template->right_signature_position}}position:absolute;text-align: CENTER;" data-item="3"><img src="{{base_path().'/public/storage/'.$rector->signature}}" alt="rector" style="max-width:100%;max-height:100%;" unselectable="on"></div>
        @endif
        @if ($template->escrollSetup->qr == 1)
            <div draggable="true" id="qr" class="ui-widget-content" style="{{$template->qr_position}}position:absolute;text-align: CENTER;" data-item="4"><img src="{{base_path().'/public/'.$student->qr_code_path}}" alt="qr" style="max-width:100%;max-height:100%;" unselectable="on"></div>
        @endif
        @if ($template->escrollSetup->serial_no == 1)
            <div draggable="true" id="serial_no" class="ui-widget-content" style="{{$template->qr_position}}position:absolute;text-align: CENTER;" data-item="4"><span>{{$student->serial_no}}</span></div>
        @endif
        @if ($template->escrollSetup->date_endorse == 1)
            <div draggable="true" id="qr" class="ui-widget-content" style="{{$template->qr_position}}position:absolute;text-align: CENTER;" data-item="4"><span>{{$student->date_endorse}}</span></div>
        @endif
    @else
        <img src="{{asset('storage/'.$template->image_template)}}">
        
        @if ($template->escrollSetup->name == 1)
            <div draggable="true" id="name" class="dragme ui-widget-content" style="{{$template->name_position}}" data-item="0"><span>{{$student->name}}</span></div>
        @endif
        @if ($template->escrollSetup->bachelor == 1)
            <div draggable="true" id="bachelor" class="dragme ui-widget-content" style="{{$template->bachelor_position}}" data-item="1"><span>{{$student->department->name}}</span></div>
        @endif
        @if ($template->escrollSetup->left_signature == 1)
            <div draggable="true" id="left" class="dragme ui-widget-content" style="{{$template->left_signature_position}}" data-item="2"><img src="{{asset('storage/'.$dean->signature)}}" alt="dean" style="max-width:100%;max-height:100%;" unselectable="on"></div>
        @endif
        @if ($template->escrollSetup->right_signature == 1)
            <div draggable="true" id="right" class="dragme ui-widget-content" style="{{$template->right_signature_position}}" data-item="3"><img src="{{asset('storage/'.$rector->signature)}}" alt="rector" style="max-width:100%;max-height:100%;" unselectable="on"></div>
        @endif
        @if ($template->escrollSetup->qr == 1)
            <div draggable="true" id="qr" class="dragme ui-widget-content" style="{{$template->qr_position}}" data-item="4"><img src="{{asset($student->qr_code_path)}}" alt="qr" style="max-width:100%;max-height:100%;" unselectable="on"></div>
        @endif
        @if ($template->escrollSetup->serial_no == 1)
            <div draggable="true" id="serial_no" class="dragme ui-widget-content" style="{{$template->qr_position}}" data-item="5"><span>{{$student->serial_no}}</span></div>
        @endif
        @if ($template->escrollSetup->date_endorse == 1)
            <div draggable="true" id="qr" class="dragme ui-widget-content" style="{{$template->qr_position}}" data-item="6"><span>{{$student->date_endorse}}</span></div>
        @endif
    @endif
    

{{-- </div> --}}

<script>
    var modified = 0;

    $(document).ready(function () {
        
        $('body').keydown(function (e) {
            if($('.highlight')[0]){
                position = $('.highlight').position();
                switch(e.keyCode){
                    case 37: position.left -= 1; break;     //left
                    case 38: position.top -= 1; break;      //up
                    case 39: position.left += 1; break;     //right
                    case 40: position.top += 1; break;      //down
                }
                
                $('.highlight').css(position);

                // Don't scroll page
                e.preventDefault();
            }
        });

        window.onbeforeunload = confirmExit;
        function confirmExit() {
            if (modified == 1) {
                return "New information not saved. Do you wish to leave the page?";
            }
        }
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    $('body').keydown(function(event) {
        if (event.keyCode == 83 && event.ctrlKey){
            data = {
                name_position               : $('#name').css(["left", "top", "width", "height"]),
                bachelor_position           : $('#bachelor').css(["left", "top", "width", "height"]),
                left_signature_position     : $('#left').css(["left", "top", "width", "height"]),
                right_signature_position    : $('#right').css(["left", "top", "width", "height"]),
                qr_position                 : $('#qr').css(["left", "top", "width", "height"]),
            };
            $.ajax({
                type: 'PUT',
                url: "{{route('admin.update-template', $template->id)}}",
                data: data,
                success:function(){
                    myfunction();
                },
            });
            return false;
        }

        if (event.keyCode == 80 && event.ctrlKey){
            $.ajax({
                type: 'GET',
                url: '{{route("admin.download-escroll", $template->id)}}',
                // data: data,
                cache:false,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response){
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "Sample.pdf";
                    link.click();
                },
                error: function(blob){
                    console.log(blob);
                }
            });
            return false;
        }
    });
        
    // This timeout, started on mousedown, triggers the beginning of a hold
    var holdStarter = null;

    // This is how many milliseconds to wait before recognizing a hold
    var holdDelay = 100;

    // This flag indicates the user is currently holding the mouse down
    var holdActive = false;

    // MouseDown
    $('.dragme').mousedown(function () {
        dragme = $(this);
        holdStarter = setTimeout(function () {
            holdStarter = null;
            holdActive = true;
            // begin hold-only operation here, if desired
            $('.dragme').removeClass('highlight');
            dragme.addClass('highlight');
        }, holdDelay);
    });

    // MouseUp
    $('.dragme').mouseup(function () {
        if (holdStarter) {
            clearTimeout(holdStarter);
            // run click-only operation here
            if($('.highlight')[0]){
                $('.dragme').removeClass('highlight');
            }
            else{
                $('.dragme').removeClass('highlight');
                $(this).addClass('highlight');
            }
        }
        // Otherwise, if the mouse was being held, end the hold
        else if (holdActive) {
            holdActive = false;
            // end hold-only operation here, if desired
            $('.dragme').removeClass('highlight');
            $(this).addClass('highlight');
        }
    });

</script>
<script>
    function drag_start(event) {
        var style = window.getComputedStyle(event.target, null);
        event.dataTransfer.setData("text/plain", (parseInt(style.getPropertyValue("left"), 10) - event.clientX) + ',' + (parseInt(style.getPropertyValue("top"), 10) - event.clientY) + ',' + event.target.getAttribute('data-item'));
    }

    function drag_over(event) {
        event.preventDefault();
        return false;
    }

    function drop(event) {
        modified = 1
        console.log(event);
        var offset = event.dataTransfer.getData("text/plain").split(',');
        var dm = document.getElementsByClassName('dragme');
        dm[parseInt(offset[2])].style.left = (event.clientX + parseInt(offset[0], 10)) + 'px';
        dm[parseInt(offset[2])].style.top = (event.clientY + parseInt(offset[1], 10)) + 'px';
        event.preventDefault();
        return false;
    }

    var dm = document.getElementsByClassName('dragme');
    for (var i = 0; i < dm.length; i++) {
        dm[i].addEventListener('dragstart', drag_start, false);
        document.body.addEventListener('dragover', drag_over, false);
        document.body.addEventListener('drop', drop, false);
    }

    function myfunction(){
        modified = 0;
        alert("Saved");
    }

</script>
</body>
</html>
