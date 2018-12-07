<script>
    $('.usd-format').on('change', function () {
        var number = $(this).val();
        number = number.replace(',', '');
        if (parseFloat(number)) {
            number = parseFloat(number).toFixed(2);
            if (number == 0) {
                number = '';
            } else {
                number = number.toLocaleString('en-US')
            }
        } else {
            number = '';
        }
        $(this).val(number);
    });

    $('.input-float').on('change', function () {
        var number = $(this).val();
        if (parseFloat(number)) {
            number = parseFloat(number).toFixed(3);
            if (number == 0) {
                number = '';
            }
        } else {
            number = '';
        }
        $(this).val(number);
    });

    $('#type').select2({
            theme: "bootstrap",
            placeholder: 'Type',
            tags: true
        })
        .change(function () {
            $(this).valid();
        });
    $('#category').select2({
            theme: "bootstrap",
            placeholder: 'Category',
            tags: true
        })
        .change(function () {
            $(this).valid();
        });
    $('#commercial').select2({
            theme: "bootstrap",
            placeholder: 'Commercial',
            tags: true
        })
        .change(function () {
            $(this).valid();
        });
    $('#currency').select2({
            theme: "bootstrap",
            placeholder: 'Curency',
            tags: true
        })
        .change(function () {
            $(this).valid();
        });

    $("#jxForm").validate({
        rules: {
            name: {
                required: true
            },
            type: {
                required: true
            },
            code: {
                required: true,
                required: true,
                remote:{
                    url: "{{ route('product.index') }}/find",
                    type: "post",
                    data:{
                        _token:'{{ csrf_token() }}',
                        id: "{{$product->id}}",
                        code: function(){
                            return $('#jxForm :input[name="code"]').val();
                        }
                    }
                }
            },
            commercial: {
                required: true
            },
            category: {
                required: true
            },
            stock: {
                required: true
            },
            satu: {
                required: true
            },
            dua: {
                required: true
            },
            tiga: {
                required: true
            },
            empat: {
                required: true
            },
            lima: {
                required: true
            },
            enam: {
                required: true
            },
            currency: {
                required: true
            }
        },
        messages: {
            name: {
                required: 'Please enter a name product'
            },
            type: {
                required: 'Please select a type'
            },
            code: {
                required: 'Please enter a code',
                remote: 'Code already use'
            },
            stock: {
                required: 'Please select a stock'
            },
            commercial: {
                required: 'Please select a commercial'
            },
            category: {
                required: 'Please enter a category'
            },
            satu: {
                required: 'Please fill the blank'
            },
            dua: {
                required: 'Please fill the blank'
            },
            tiga: {
                required: 'Please fill the blank'
            },
            empat: {
                required: 'Please fill the blank'
            },
            lima: {
                required: 'Please fill the blank'
            },
            enam: {
                required: 'Please fill the blank'
            },
            currency: {
                required: 'Please select a currency'
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