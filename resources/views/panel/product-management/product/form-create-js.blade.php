<script>
    //refresh numberformat
    function refreshNumberFormat() {
        $('.idr-currency').on('change', function () {
            var number = $(this).val();
            number = number.replace('.', '');
            number = number.replace(',', '.');
            if (parseFloat(number)) {
                number = parseFloat(number);
            } else {
                number = parseFloat("0");
            }
            if (number == '0') {
                number = '';
            } else {
                number = number.toLocaleString('id-ID')
            }
            $(this).val(number);
        });

        $('.input-number').on('change', function () {
            var number = $(this).val();
            if (parseInt(number)) {
                number = parseInt(number);
                if (number < 1) {
                    number = '';
                }
            } else {
                number = '';
            }
            $(this).val(number);
        });
    }

    //Read Picture function
    function readURL(input, prodImage) {
        if (input.files && input.files[0] && input.files[0].size <= 1048576) {
            var reader = new FileReader();
            reader.onload = function (e) {
                if (prodImage) {
                    $('.fade .picture-card .picturePrev').attr('src', e.target.result);
                    $('.image-add').before($('.fade .picture-card').html());
                    $('.image-add').prev('.pull-left').find('.fade').remove();
                    $clone = $(input).clone();
                    $('.image-add').prev('.pull-left').append($clone);
                }else{
                    $(input).siblings('.vars-btn').find('.picturePrev').attr('src', e.target.result);
                }
            }
            reader.readAsDataURL(input.files[0]);
        }else{
            $(input).val('');
            toastr.warning('Image size max 1 MB ..', 'Please check image file');
        }
    }

    //Category select function
    function catSelect2() {
        if ($('.category').data('select2')) {
            $('.category').select2('destroy');
        }
        $('.category').select2({
            theme: "bootstrap",
            allowClear: true,
            placeholder: 'Please select'
        }).change(function () {
            $(this).find('option').each(function(){
                var selVal = $('.cat-'+$(this).val()+' select');
                if(selVal.val()){
                    selVal.val('');
                }
            });
            
            var dataParent = $(this).attr('data-parent');
            if ($(this).val() != '') {
                $('.' + dataParent + '-child').addClass('d-none');
                $('.cat-' + $(this).val()).removeClass('d-none');
                setTimeout(function () {
                    catSelect2();
                });
            } else {
                $('.' + dataParent + '-child').addClass('d-none');
            }
            $('.category').valid();
        });
    }
    catSelect2();

    //weight select2
    $('.weight-unit').select2({
        theme: "bootstrap",
        placeholder: 'Please select'
    });


    //variant add button (function variant)
    function funcVariant(action) {
        if (action == 'add') {
            $('.variant-col').html($('.fade .table-variant').html());
            $('.variant-btn').html($('.fade .variant-btn-action').html());
            $('.price-col').html($('.fade .price-range').html());
            $('.stock').prop('readonly', true);
            refreshNumberFormat();
        } else {
            $('.variant-col').html('');
            $('.variant-btn').html($('.fade .variant-btn-add').html());
            $('.price-col').html($('.fade .price-input').html());
            $('.stock').prop('readonly', false);
        }
    }

    //add method validate "allRequired"
    jQuery.validator.addMethod("allRequired", function (value, elem) {
        // Use the name to get all the inputs and verify them
        var name = elem.name;
        return $('#jxForm input[name="' + name + '"]').map(function (i, obj) {
            return $(obj).val();
        }).get().every(function (v) {
            return v;
        });
    });

    //variant price total and stock
    function priceStock(elm) {
        var number = 0;
        if (elm == 'price') {
            var minPrice = 0;
            var maxPrice = 0;
            $('#jxForm input[name="varPrice[]"]').each(function () {
                number = parseInt($(this).val().replace('.', '').replace(',', '.'));
                if (minPrice == 0 || minPrice > number) {
                    minPrice = number;
                }
                if (maxPrice == 0 || maxPrice < number) {
                    maxPrice = number;
                }
            });
            $('#jxForm input[name="minPrice"]').val(minPrice.toLocaleString('id-ID'));
            $('#jxForm input[name="maxPrice"]').val(maxPrice.toLocaleString('id-ID'));
        } else {
            var totalStock = 0;
            $('#jxForm input[name="varStock[]"]').each(function () {
                number = parseInt($(this).val().replace('.', '').replace(',', '.'));
                totalStock = totalStock + number;
            });
            $('#jxForm input[name="stock"]').val(totalStock);
        }
    }

    //all unique
    jQuery.validator.addMethod("allUnique", function (value, elem) {
        // Use the name to get all the inputs and verify them
        var formId = '#jxForm';
        var name = elem.name;
        var status = true;
        var arrList = [];
        $('#jxForm input[name="' + name + '"]').each(function () {
            if ($.inArray($(this).val(), arrList) != -1) {
                status = false;
            } else {
                arrList.push($(this).val());
            }
        });
        return status;
    });

    //validate form
    function validateForm() {
        $('#jxForm').validate({
            rules: {
                name: {
                    required: true
                },
                'category[]': {
                    required: true
                },
                'variants[]': {
                    "allRequired": true,
                    "allUnique": true
                },
                'varPrice[]': {
                    "allRequired": true
                },
                description: {
                    required: true
                },
                prodPrice: {
                    required: true
                },
                sku: {
                    remote: {
                        url: "{{ route('product.index') }}/find",
                        type: "post",
                        data: {
                            _token: '{{ csrf_token() }}',
                            slug: function () {
                                return $('#jxForm :input[name="sku"]').val();
                            }
                        }
                    }
                }
            },
            messages: {
                name: {
                    required: 'Please enter a product name'
                },
                'category[]': {
                    required: 'Please select category'
                },
                'variants[]': {
                    "allRequired": 'Please input each variant',
                    "allUnique": 'each variant must be unique'
                },
                'varPrice[]': {
                    "allRequired": 'Please input each variant price'
                },
                description: {
                    required: 'Please describe the product'
                },
                prodPrice: {
                    required: 'Please enter product price'
                },
                sku: {
                    remote: 'Sku must be unique key product/variant'
                }
            },
            errorElement: 'em',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
            },
            highlight: function (element, errorClass, validClass) {
                $('#jxForm input[name="' + $(element).attr('name') + '"]').addClass('is-invalid').removeClass(
                    'is-valid');
                $('#jxForm select[name="' + $(element).attr('name') + '"]').addClass('is-invalid').removeClass(
                    'is-valid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $('#jxForm input[name="' + $(element).attr('name') + '"]').addClass('is-valid').removeClass(
                    'is-invalid');
                $('#jxForm select[name="' + $(element).attr('name') + '"]').addClass('is-valid').removeClass(
                    'is-invalid');
            }
        });
    }
    validateForm();

    function save(action) {
        if ($('#jxForm').valid() && $('#jxForm input[name="image[]"]').length) {
            $('.showProgress').click();
            $.ajax({
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            $('.progress-bar').css({
                                width: percentComplete * 100 + '%'
                            });
                            if (percentComplete === 1) {}
                        }
                    }, false);
                    xhr.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            $('.progress-bar').css({
                                width: percentComplete * 100 + '%'
                            });
                        }
                    }, false);
                    return xhr;
                },
                url: "{{route('product.index')}}",
                type: 'POST',
                processData: false,
                contentType: false,
                data: new FormData($('#jxForm')[0]),
                success: function (response) {
                    setTimeout(function () {
                        $('#progressModal').modal('toggle');
                        $('input[name="id"]').val(response);
                        act(action);
                    }, {{env('SET_TIMEOUT', '500')}});
                },
                error: function (e) {}
            });
        } else {
            if($('#jxForm input[name="image[]"]').length == 0){
                toastr.warning('Please add product picture..', 'Product picture not found!');
            }else{
                toastr.warning('Please check your input..', 'Form not valid!');
            }
        }
    }

    function act(action) {
        switch (action) {
            case 'continue':
                toastr.success('Successfully saved..', '');
                break;
            case 'new':
                window.open("{{ route('product.create') }}/?new=variant", "_self");
                break;
            case 'exit':
                window.open("{{ route('product.index') }}/?new=variant", "_self");
        }
    }
</script>