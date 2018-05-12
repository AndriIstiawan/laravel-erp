<script>	
	function refProductChange() {
	$('.option-card1 .sales').select2({theme:"bootstrap", placeholder:'Please select Sales'})
		.change(function(){
			var element= $(this).find('option:selected');
			$(this).valid();
		});

	$('.option-card1 .type').select2({theme:"bootstrap", placeholder:'Please select Type'})
		.change(function(){
			$(this).valid();
		});

	$('.option-card2 .sales').select2({theme:"bootstrap", placeholder:'Please select Sales'})
		.change(function(){
			var element= $(this).find('option:selected');
			$(this).valid();
		});

	$('.option-card2 .type').select2({theme:"bootstrap", placeholder:'Please select Type'})
		.change(function(){
			$(this).valid();
		});
	}
    refProductChange();
	
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e){ $('.picturePrev').attr('src', e.target.result); }
			reader.readAsDataURL(input.files[0]);
		}
	}

	/*$(document).on('click', '#save', function(e) {
        e.preventDefault();
        if($('#jxForm1').valid()){
            swal({
                title: "Are you sure want to submit the form?",
                text: "Please make sure all data inputted correctly",
                buttons: true,
            }).then((confirm) => {
                if(confirm){ $('#jxForm1').submit(); }
            });
        }
    });*/

	$("#picture").change(function (){ readURL(this); });

	$('#pasar').select2({theme:"bootstrap", placeholder:'Please select Segmen Pasar'});
	$('#pasar').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
  	});

  	$('#title').select2({theme:"bootstrap", placeholder:'Please select Title'});
  	$('#title').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
  	});

  	//add method validate "allRequired"
    jQuery.validator.addMethod("allRequiredSelect", function (value, elem) {
        // Use the name to get all the inputs and verify them
        var name = elem.name;
        return $('#jxForm1 select[name="' + name + '"]').map(function (i, obj) {
            console.log($(obj).val());
            return $(obj).val();
        }).get().every(function (v) {
            console.log(v);
            return v;
        });
    });

    //add method validate "allRequired"
    jQuery.validator.addMethod("allRequiredInput", function (value, elem) {
        // Use the name to get all the inputs and verify them
        var name = elem.name;
        return $('#jxForm1 input[name="' + name + '"]').map(function (i, obj) {
            console.log($(obj).val());
            return $(obj).val();
        }).get().every(function (v) {
            console.log(v);
            return v;
        });
    });

	$("#jxForm1").validate({
		rules:{
			name:{required:true,minlength:2},
			address:{required:true,minlength:2},
			phone:{required:true},
			'shipaddress[]':{
                "allRequiredInput": true
            },
			'nameSub[]':{
                "allRequiredInput": true
            },
            'type[]':{
                "allRequiredSelect": true
            },
            'sales[]':{
                "allRequiredSelect": true
            },
			password:{required:true,minlength:5},
			confirm_password:{required:true,equalTo:'#password'},
			email:{
				required:true,
				email:true,
				remote:{
					url: '{{ route('master-client.index') }}/find',
					type: "post",
					data:{
						_token:'{{ csrf_token() }}',
						id: $('.id').val(),
						email: function(){
							return $('#jxForm1 :input[name="email"]').val();
						}
					}
				}
			}
		},
		messages:{
			name:{
				required:'Please enter a name site',
				minlength:'Name must consist of at least 2 characters'
			},
			'shipaddress[]':{
				"allRequiredInput": 'each field are required'
			},
			address:{
				required:'Please enter a name site',
				minlength:'Name must consist of at least 2 characters'
			},
			'nameSub[]': {
                "allRequiredInput": 'each field are required'
            },
			'type[]': {
                "allRequiredSelect": 'each field are required'
            },
			'sales[]': {
                "allRequiredSelect": 'each field are required'
            },
			phone:{ required:'Please enter a phone number' 
			},
			dompet:{ required:'Please enter a dompet' 
			},
			koin:{ required:'Please enter a koin' 
			},
			password:{
				required:'Please provide a password',
				minlength:'Password must be at least 5 characters long'
			},
			confirm_password:{
				required:'Please provide a password',
				minlength:'Password must be at least 5 characters long',
				equalTo:'Please enter the same password'
			},
			email: {
				email:'Please enter a valid email address',
				remote:'Email address already in use. Please use other email.'
			}
		},
		errorElement:'em',
		errorPlacement:function(error,element){
			error.addClass('invalid-feedback');
		},
		highlight:function(element,errorClass,validClass){
			$('#jxForm1 input[name="' + $(element).attr('name') + '"]').addClass('is-invalid').removeClass(
                'is-valid');
            $('#jxForm1 select[name="' + $(element).attr('name') + '"]').addClass('is-invalid').removeClass(
                'is-valid');
		},
		unhighlight:function(element,errorClass,validClass){
			$('#jxForm1 input[name="' + $(element).attr('name') + '"]').addClass('is-valid').removeClass(
                'is-invalid');
            $('#jxForm1 select[name="' + $(element).attr('name') + '"]').addClass('is-valid').removeClass(
                'is-invalid');
		}
	});

	$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_btn-primary"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="option-card"><div class="form-group"><div id="address" class="control-group input-group" style="margin-top:10px"><input type="text" name="shipaddress[]" class="form-control" placeholder="Address" aria-describedby="shipaddress-error"><div class="input-group-btn"><button class="btn btn-danger remove" type="button"><i class="fa fa-close"></i></button></div><em id="shipaddress-error" class="error invalid-feedback">Please enter a address</em></div></div></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
	$(document).ready(function() {
  //here it will remove the current value of the remove button which has been pressed
      $("body").on("click",".remove",function(){ 
          $(this).closest('.form-group').remove();
          });
  });
	
</script>