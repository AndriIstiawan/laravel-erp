<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('category.update',['id' => $category->id]) }}">
    <div class="modal-header">
        <h4 class="modal-title">Edit Category</h4>
    </div>
    <div class="modal-body">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="form-group">
            <label class="col-form-label" for="name">*Category Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-describedby="name-error" 
                value="{{$category->name}}">
            <em id="name-error" class="error invalid-feedback">Please enter a name categories</em>
        </div>
        <div class="form-group">
            <label class="col-form-label" for="name">*Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{$category->slug}}" readonly>
        </div>
        <div class="form-group">
			<label class="col-form-label" for="parent">Parent</label>
			<select id="parent" class="form-control" name="parent[]" multiple>
				<option value=""></option>
                @foreach($category->parent as $catParent)
                <option value="{{$catParent['slug']}}" selected>{{$catParent['name']}}</option>
                @endforeach
                @foreach($categories as $cat)
                <option value="{{$cat->slug}}">{{$cat->name}}</option>
                @endforeach
			</select>
        </div>
    </div>
    <div class="modal-footer">
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</form>
<script>
    setTimeout(() => {
        $('#parent').select2({
            theme: "bootstrap",
            placeholder: 'Please select'
        });
    }, 100);
    
    $('.selectJx').select2({
        theme: "bootstrap",
        placeholder: 'Please select',
        allowClear: true
    });
    $('#type').on('change', function () {
        $(this).addClass('is-valid').removeClass('is-invalid');
    });
    $('#type').on('change', function () {
        if (this.value == 'yes') {
            $('#collapseE').addClass('show');
        } else {
            $('#collapseE').removeClass('show');
        }
    })
    $('#jxForm').validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            }
        },
        messages: {
            name: {
                required: 'Please enter a name category',
                minlength: 'Name must consist of at least 2 characters'
            }
        },
        errorElement: 'em',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        }
    });
</script>