<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />

    <title>Document</title>
</head>

<body>

<style>
    body {
        margin: 0;
        padding: 0;
    }

    #page {
        width: 100%;
        height: 100%;
    }

    #resizable {
        float: left;
        width: @if($width)
             {{$width}}%;
        @else
        400px;
        @endif
        background: #f6f6f6;
        height: 400px;
    }

    #content {
        background: #eee;
        overflow: hidden;
        border: 1px solid red;
        height: 400px;
    }

    #wrapper {
        float: left;
        width: 900px;
        height: 500px;
    }

    #irrelevant {
        background: #ddd;
    }

    #resizable,
    #content,
    #irrelevant {
        padding: 20px;
        text-align: center;
    }

    #input {
        margin: 20px auto;
        width: 350px;
    }

    #rwidth {
        width: 60px;
        padding: 0 5px;
    }

    /* overright jQuery UI borders */
    #resizable {
        border: 0 !important;
        border-right: 5px solid #333 !important;
    }

    .bdwn {
        border: 0 !important;
        border-bottom: 5px solid #333 !important;
    }

    #rheight {
        height: 60px;
        padding: 0 5px;
    }

    #sec2 {
        height: @if($height)
             {{$height}}%;
        @else
        125px ;
    @endif;
    }

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script>
    // var body_height = 50;
    // var body_heightdec = 50;
    // var startp = 0;
    // var endp = 0;
    // $(function () {

    //     $('.blocks').resizable({
    //         handles: "e, s"
    //     }, {
    //         alsoResize: '#body'
    //     }, {
    //         maxWidth: 500,
    //         minHeight: 32,
    //         minWidth: 15,
    //     }, {
    //         start: function (event, ui) {
    //             startp = ui.size.width;
    //         }
    //     }, {
    //         stop: function (event, ui) {
    //             endp = ui.size.width;
    //         }
    //     }, {
    //         resize: function () {

    //             console.log('start ' + startp + " " + "end " + endp);
    //         }
    //     });

    //     $('.blocks2').resizable({
    //         handles: "w, s"
    //     }, {
    //         alsoResize: '#body'
    //     }, {
    //         maxWidth: 150,
    //         minHeight: 32,
    //         minWidth: 15
    //     });

    // });

    function byId(id) {
        return document.getElementById(id);
    }

    function set_width() {
        var value = byId('rwidth').value;
        byId('resizable').style.width = value + "px";
    }

    function set_height() {
        var value = byId('rheight').value;
        byId('sec2').style.height = value + "px";
    }

    $(function () {
        $("#resizable").resizable({
            handles: "e"
        },{
            maxWidth: 1280,
            minWidth: 0

        }, {
            containment: "#wrapper"
        }, {
            stop: function (event, ui) {
                var parent = ui.element.parent();
                var per =Math.round(ui.size.width / parent.width() * 100);
                $.ajax({
                    type: 'POST', // the method (could be GET btw)
                    url: "{{ url('/setscreen') }}", // The file where my php code is
                    data: {
                        _token: "{{ csrf_token() }}",
                        'section':1,
                        'sendWidth': per// all variables i want to pass. In this case, only one.
                    },
                    success: function (data) { // in case of success get the output, i named data
                        alert("Width is set in DB "+per); // do something with the output, like an alert
                    }
                });
            }
        });
    });

    $(function () {
        $("#sec2").resizable({
            handles: "s"
        }, {
            maxHeight: 380,
            minHeight: 0,
        }, {
            stop: function (event, ui) {
                var parent = ui.element.parent();
                var per =Math.round(ui.size.height/ parent.height() * 100);
                $.ajax({
                    type: 'POST',
                    url: "{{ url('/setscreen') }}", // The file where my php code is
                    data: {
                        _token: "{{ csrf_token() }}",
                        'section':2,
                        'sendHeight': per // all variables i want to pass. In this case, only one.
                    },
                    success: function (data) { // in case of success get the output, i named data
                        alert("Height is set in DB "+per ); // do something with the output, like an alert
                    }
                });
            }
        });

    });
    console.log($('#sec3').width());
</script>
<!-- With containment:<br>
<div id="body">
    <div class="blocks">test my block</div>
    <div class="blocks">resize this to end</div>
</div>

<br><br><br>
<div style="color: #003c98;">As you can see, second with max-width, goes to next row, but i want to keep it to
    end if
    theres two or more of divs at inline position</div>

<div id="body2">
    <div class="blocks2">test my block</div>
    <div class="blocks2">resize this to end</div>
</div> -->
<div id="page" class="row">
    <div id="wrapper" class="col-lg">
        <div id="resizable">resizable</div>
        <div id="content">
            <div id="sec2" class="row bdwn">
                first
            </div>
                       <div id="sec3" class="row">
                second
            </div>
        </div>
    </div>
</div>


<!-- <div class="page">
    <div class="wrapper">
        <div id="c1" class="col-lg">
            <div id="resizable" style="border:solid;" class="ui-widget-content ui-resizable-helper">
                <h3 class="ui-widget-header">Pull my edges to resize me!!</h3>
            </div>
        </div>

        <div id="content" style="border:solid;" class="ui-widget-content">
            <h3 class="ui-widget-header">Pull my edges to resize me!!</h3>
        </div>

    </div>
</div> -->
</body>

</html>