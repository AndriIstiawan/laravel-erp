@extends('master')
@section('content')
<link href="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<div class="container-fluid">
	<div class="animate fadeIn">
		<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-8">
				<p>
				<button type="button" class="btn btn-primary" onclick="window.history.back()">
					<i class="fa fa-backward"></i>&nbsp; Back to List
				</button>
				</p>
				<!--start card -->
				<div class="card">
					<div class="card-header">
						<i class="fa fa-align-justify"></i> Email
						<small></small>
					</div>
					<div class="card-body">
						<div class="tab-content" id="myTab1Content">
						<!-- TAB CONTENT -->
							<div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="general-tab">
								<div class="row">
									<div class="col-md-12">
										<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('mail.index') }}">
											{{ csrf_field() }}
											<input type="hidden" class="id" name="id">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label class="col-form-label" for="name">*Admin ID</label>
														<input type="text" class="form-control" id="adminId" name="adminId" placeholder="adminId" aria-describedby="adminId-error" value="{{$id}}" readonly>
													</div>
													<div class="form-group">
														<label class="col-form-label" for="name">*To</label>
														<input type="text" class="form-control" id="memberEmail" name="memberEmail" placeholder="subject"
															aria-describedby="memberEmail-error">
														<em id="subject-error" class="error invalid-feedback">Please enter an email </em>
													</div>
													<div class="form-group">
														<label class="col-form-label" for="name">*Subject</label>
														<input type="text" class="form-control" id="subject" name="subject" placeholder="subject"
															aria-describedby="name-error">
														<em id="subject-error" class="error invalid-feedback">Please enter a subject </em>
													</div>
													<div class="form-group">
														<label class="col-form-label" for="name">*Message</label>
														<textarea type="text" class="form-control" id="content" name="content" placeholder="content" aria-describedby="content-error"></textarea>
														<em id="name-error" class="error invalid-feedback">Please enter a message </em>
													</div>
													<div class="form-group">
														<label class="col-form-label" for="name">*Comment</label>
														<input type="text" class="form-control" id="comment" name="comment" placeholder="comment" aria-describedby="comment-error">
													</div>
												</div>
											</div>
											<hr>
											<p>
												<div class="modal-footer">
													<div class="form-group">
														<button type="submit" class="btn btn-primary" name="signup" value="Sign up">Save</button>
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													</div>
												</div>
											</p>
										</form>
									</div>
								</div>
							</div>
							<!-- end tab 1 -->
							
						</div>
					</div>
				</div>
				<!--end card -->
			</div>
		</div>
	</div>
</div>
@endsection

@section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
<script src="{{ URL::to('js/vendor//tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('fiture-style/bootstrap-fileinput/js/plugins/sortable.js') }}" type="text/javascript"></script>
<script src="{{ asset('fiture-style/bootstrap-fileinput/js/fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('fiture-style/bootstrap-fileinput/themes/fa/theme.js') }}" type="text/javascript"></script>
<script>
    //Category select function
    function catSelect2() {
        if ($('.email').data('select2')) {
            $('.email').select2('destroy');
        }
        $('.email').select2({
            theme: "bootstrap",
            allowClear: true,
            placeholder: 'Please select'
        }).change(function () {
            var dataParent = $(this).attr('data-parent');

            if ($(this).val() != '') {
                $('.' + dataParent + '-child').addClass('d-none');
                $('.cat-' + $(this).val()).removeClass('d-none');
                validateForm();
                setTimeout(function () {
                    catSelect2();
                });
            } else {
                $('.' + dataParent + '-child').addClass('d-none');
                validateForm();
            }
        });
    }
    catSelect2();

    
    $("#jxForm1").validate({
		rules:{
			adminId:{required:true,minlength:2},
			memberEmail:{required:true},
			subject:{required:true,minlength:2},
			content:{required:true,minlength:2},
			comment:{required:true,minlength:2},
		},
		messages:{
			
			memberEmail:{
				required:'Please enter a name user',
				minlength:'Name must consist of at least 2 characters'
			},
			subject:{
				required:'Please enter a name user',
				minlength:'Name must consist of at least 2 characters'
			},
			content:{
				required:'Please enter a name user',
				minlength:'Name must consist of at least 2 characters'
			},
			comment:{
				required:'Please enter a name user',
				minlength:'Name must consist of at least 2 characters'
			}
		},
		errorElement:'em',
		errorPlacement:function(error,element){
			error.addClass('invalid-feedback');
		},
		highlight:function(element,errorClass,validClass){
			$(element).addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight:function(element,errorClass,validClass){
			$(element).addClass('is-valid').removeClass('is-invalid');
		}
	});
	
	
	function postData(formAct1,formAct2,action,sendForm){
		if(!progressStat){
			$('.showProgress').click();
			progressStat = true;
		}
		
		$.ajax({
			url : "{{ route('slider.index') }}",
			type: 'POST',
			processData: false,
        	contentType: false,
			data : new FormData($(sendForm)[0]),
			success : function(response){
				if($('.id').val() == ''){
					$('.id').val(response);
				}
				
				if(formAct1 != '' && formAct2 != ''){
					save('',formAct2,action);
				}else{
					setTimeout(function(){
						progressStat = false;
						$('#progressModal').modal('toggle');
						act(action);
					}, {{env('SET_TIMEOUT', '500')}});
				}
			},
			error : function(e){
				setTimeout(function(){
					progressStat = false;
					$('#progressModal').modal('toggle'); 
					alert(' Error : ' + e.statusText);
				}, {{env('SET_TIMEOUT', '500')}});
			}
		});
	}
	
	function act(action){
		switch(action) {
		    case 'continue':
		        toastr.success('Successfully saved..', '');
		        break;
		    case 'new':
		        window.open("{{ route('mail.create') }}", "_self");
		        break;
		    case 'exit':
		        window.open("{{ route('mail.index') }}", "_self");
		}
	}
</script>
<script>
 var editor_config = {
      path_absolute : "{{ URL::to('/') }}/",
      selector : "textarea",
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
      relative_urls: false,
      file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.grtElementByTagName('body')[0].clientHeight;
        var cmsURL = editor_config.path_absolute+'laravel-filemanaget?field_name'+field_name;
        if (type = 'image') {
          cmsURL = cmsURL+'&type=Images';
        } else {
          cmsUrl = cmsURL+'&type=Files';
        }

        tinyMCE.activeEditor.windowManager.open({
          file : cmsURL,
          title : 'Filemanager',
          width : x * 0.8,
          height : y * 0.8,
          resizeble : 'yes',
          close_previous : 'no'
        });
      }
    };

    tinymce.init(editor_config);
</script>﻿

<script>
var progressStat = false;
	
		 $('#email').select2({theme:"bootstrap", placeholder:'Please select'});
		 $('#email').on('change', function(){
		    $(this).addClass('is-valid').removeClass('is-invalid');
		 });

		$('#jxForm').validate({
		rules:{
			email:{required:true},
			subject:{required:true,minlength:1},
			message:{required:true,minlength:1},
		},
		messages:{
			email:{
				required:'Please enter an email',
				minlength:'fill the blank'
			},
			subject:{
				required:'Please enter a subject',
				minlength:'fill the subject'
			},
			message:{
				required:'Please enter a message',
				minlength:'fill the message'
			}
		},
		errorElement:'em',
		errorPlacement:function(error,element){
			error.addClass('invalid-feedback');
		},
		highlight:function(element,errorClass,validClass){
			$(element).addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight:function(element,errorClass,validClass){
			$(element).addClass('is-valid').removeClass('is-invalid');
		}
	});

</script>

@endsection