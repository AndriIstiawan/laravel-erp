$(function(){
	$.validator.setDefaults({
	});
	$('#signupForm').validate({
		rules:{
			firstname:'required',
			lastname:'required',
			username:{required:true,minlength:2},
			password:{required:true,minlength:5},
			confirm_password:{required:true,minlength:5,equalTo:'#password'},
			email:{
				required:true,
				email:true
			},
			agree:'required'
		},
		messages:{
			firstname:'Please enter your firstname',
			lastname:'Please enter your lastname',
			username:{
				required:'Please enter a username',
				minlength:'Your username must consist of at least 2 characters'
			},
			password:{
				required:'Please provide a password',
				minlength:'Your password must be at least 5 characters long'
			},
			confirm_password:{
				required:'Please provide a password',
				minlength:'Your password must be at least 5 characters long',
				equalTo:'Please enter the same password'
			},
			email:'Please enter a valid email address',
			agree:'Please accept our policy'
		},
		errorElement:'em',
		errorPlacement:function(error,element){
			error.addClass('invalid-feedback');
			if(element.prop('type')==='checkbox'){
				error.insertAfter(element.parent('label'));
			}else{
				error.insertAfter(element);
			}
		},
		highlight:function(element,errorClass,validClass){
			$(element).addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight:function(element,errorClass,validClass){
			$(element).addClass('is-valid').removeClass('is-invalid');
		}
	});
});