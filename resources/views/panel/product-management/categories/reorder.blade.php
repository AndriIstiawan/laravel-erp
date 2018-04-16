@extends('master') @section('content')
<link href="{{ asset('fiture-style/nested-js/nested-style.css') }}" rel="stylesheet">
<div class="container-fluid">
    <div class="animate fadeIn">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <p>
                    <a class="btn btn-primary" href="{{route('category.index')}}">
                        <i class="fa fa-backward"></i>&nbsp; Back to List
                    </a>
                    <button type="button" class="btn btn-success" onclick="save('exit')">
                        &nbsp; Save all and Exit
                    </button>
                </p>
                <!--start card -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Reorder
                        <small>Categories</small>
                    </div>
                    <div class="card-body">
                        <div class="dd" id="nestable3">
                            <?php
                                function nested($listArr, $categories){
                                    echo '<ol class="dd-list">';
                                    foreach($listArr as $la){
                                        ?>
                                <li class="dd-item dd3-item" data-slug="{{$la['slug']}}" data-name="{{$la['name']}}">
                                    <div class="dd-handle dd3-handle">Drag</div>
                                    <div class="dd3-content">{{$la['name']}}</div>
                                    <?php
                                    $like = $la['slug'];
                                    $temp = [];
                                    foreach($categories as $cat){
                                        if(array_search($like, array_column($cat['parent'], 'slug')) > -1){
                                            array_push($temp, $cat);
                                        }
                                    }
                                    nested($temp, $categories);
                                    ?>
                                </li>
                                <?php
                                    }
                                    echo '</ol>';
                                }
                                nested($catParent, $categories);
                            ?>
                        </div>
                        <!-- output nestable json -->
                        <form id="jxForm1">
                            {{ method_field('PUT') }} {{ csrf_field() }}
                            <input type="hidden" id="nestable-output" name="nestableOutput">
                        </form>
                        <!-- END output nestable json -->
                    </div>
                    <!-- END CARD BODY -->
                    <div class="card-footer">
                        <div class="btn-group">
                            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <button type="button" class="btn btn-success" onclick="save('continue')">Save and Continue</button>
                            <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="javascript:void(0)" onclick="save('exit')">Save and Exit</a>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                            <i class="fa fa-times-rectangle"></i>&nbsp; Cancel
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/nested-js/jquery.nestable.js') }}"></script>
<script src="{{ asset('fiture-style/nested-js/nestable.js') }}"></script>
<script>
    function save(act) {
        $('.showProgress').click();
        $.ajax({
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        console.log(percentComplete);
                        $('.progress-bar').css({
                            width: percentComplete * 100 + '%'
                        });
                        if (percentComplete === 1) {}
                    }
                }, false);
                xhr.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        console.log(percentComplete);
                        $('.progress-bar').css({
                            width: percentComplete * 100 + '%'
                        });
                    }
                }, false);
                return xhr;
            },
            url: "{{ route('category.update',['id' => 'reorder']) }}",
            type: 'POST',
            processData: false,
            contentType: false,
            data: new FormData($('#jxForm1')[0]),
            success: function (response) {
                setTimeout(function () {
                    $('#progressModal').modal('toggle');

                    if (act == 'continue') {
                        toastr.success('successfully saved..', 'Setting');
                    } else {
                        window.open("{{ route('category.index') }}/?edit=categories", "_self");
                    }
                }, {{env('SET_TIMEOUT', '500')}} );
            },
            error: function (e) {}
        });

    }
</script>
@endsection