<!-- Bootstrap and necessary plugins -->
<script src="{{ asset('fiture-style/js/jquery.min.js') }}"></script>
<script src="{{ asset('js/vendor/popper.min.js') }}"></script>
<script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
<!-- <script src="{{ asset('js/vendor/pace.min.js') }}"></script> -->
<!-- Plugins and scripts required by all views -->
<!-- <script src="{{ asset('js/vendor/Chart.min.js') }}"></script> -->
<!-- CoreUI main scripts -->
<script src="{{ asset('js/app.js')}}"></script>
<script src="{{ asset('fiture-style/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('fiture-style/validation/jquery.validate.min.js') }}"></script>
<!-- Modal Popup -->
<script src="{{ asset('js/ext/modals.js')}}"></script>
<!-- Tooltip -->
<script src="{{ asset('js/ext/tooltip-convSlug.js')}}"></script>
<!-- Number Format -->
<script src="{{ asset('js/ext/number-format.js')}}"></script>
<!-- Swal MessageBox -->
<script src="{{ asset('fiture-style/swal-msgbox/sweetalert.min.js')}}"></script>

<!-- Toastr -->
<script>
	@if(isset($toastr))
		toastr.success('New {{$toastr}} successfully saved..', 'An {{$toastr}} has been created.');
	@endif
	@if(isset($_GET['new']))
		toastr.success('New {{$_GET['new']}} successfully saved..', '{{$_GET['new']}} has been created.');
	@endif
	@if(isset($_GET['edit']))
		toastr.success('Edit {{$_GET['edit']}} successfully saved..', '{{$_GET['edit']}} has been edited.');
	@endif
	@if(Session::get('update'))
		toastr.success('Edit {{Session::get('update')}} successfully saved..', 'An {{Session::get('update')}} has been edited.');
	@endif
	@if(Session::get('dlt'))
		toastr.success('Successful {{Session::get('dlt')}} deleted..', 'An {{Session::get('dlt')}} has been deleted.');
    @endif
</script>