<script>
    function submitForm() {
        return confirm('Are you sure want to submit the form? Please make sure all data inputted correctly');
    }

    $(document).ready(function () {
        var counter = 0;
        $("#addMe").click(function () {
            counter++;
            if (counter == '1000000') {
                $("#addMe").prop('disabled', true);
                alert('You Can Only 1000000 Click Add More');
            } else {
                $("#addMe").prop('disabled', false);
            }
        });
    });

    function refProductChange() {
        $('.input_ .option-card1 .products').select2({
                theme: "bootstrap",
                placeholder: 'Please select'
            })
            .change(function () {
                var element = $(this).find('option:selected');
                var productType = element.attr('data-type');
                var productCode = element.attr('data-code');
                $(this).parent().parent().find('input[name="type[]"]').val(productType);
                $(this).parent().parent().find('input[name="code[]"]').val(productCode);
                $(this).valid();
            });
        $('.product-list .products').select2({
                theme: "bootstrap",
                placeholder: 'Please select'
            })
            .change(function () {
                var element = $(this).find('option:selected');
                var productType = element.attr('data-type');
                var productCode = element.attr('data-code');
                $(this).parent().parent().find('input[name="type[]"]').val(productType);
                $(this).parent().parent().find('input[name="code[]"]').val(productCode);
                $(this).valid();
            });
        $('.product-list .packaging').select2({
            theme: "bootstrap",
            placeholder: 'Please select'
        }).change(function () {
            $(this).valid();
        });
        $('.option-card1 .packaging').select2({
            theme: "bootstrap",
            placeholder: 'Please select'
        }).change(function () {
            $(this).valid();
        });
    }
    refProductChange();

    $('#tunggu').select2({
        theme: "bootstrap",
        placeholder: 'Please select'
    }).change(function () {
        $(this).valid();
    });
    $('#check').select2({
        theme: "bootstrap",
        placeholder: 'Please select'
    }).change(function () {
        $(this).valid();
    });
    $('#produksi').select2({
        theme: "bootstrap",
        placeholder: 'Please select'
    }).change(function () {
        $(this).valid();
    });
    $('#saless').select2({
        theme: "bootstrap",
        placeholder: 'Please select'
    }).change(function () {
        $(this).valid();
    });

    function findTotal(elm) {
        var elemTotal = elm.parent().parent().find('input[name="total[]"]');
        var elemPackaging = elm.parent().parent().find('select[name="packaging[]"]');
        var elemAmount = elm.parent().parent().find('input[name="amount[]"]');
        var valueTotal = parseInt(elemTotal.val());
        var valuePackaging = parseFloat(elemPackaging.find('option:selected').val());
        var valueAmount = valueTotal / valuePackaging;
        if (isNaN(valueTotal) || isNaN(valuePackaging)) {
            valueAmount = 0;
        }
        valueAmount = parseInt(valueAmount);
        elemAmount.val(valueAmount);
    }

    $('#tunggu').on('change', function () {
        $(this).addClass('is-valid').removeClass('is-invalid');
    });

    $('#sales').on('change', function () {
        $(this).addClass('is-valid').removeClass('is-invalid');
    });

    $('#produksi').on('change', function () {
        $(this).addClass('is-valid').removeClass('is-invalid');
    });

    $('#check').on('change', function () {
        $(this).addClass('is-valid').removeClass('is-invalid');
    });

    $('#package').on('change', function () {
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
        rules: {
            client: {
                required: true,
                minlength: 2
            },
            sales: {
                required: true
            },
            'product[]': {
                "allRequiredSelect": true
            },
            'total[]': {
                "allRequiredInput": true
            },
            'packaging[]': {
                "allRequiredSelect": true
            },
        },
        messages: {
            client: {
                required: 'Please enter a client',
                minlength: 'name client must consist of at least 2 characters'
            },
            sales: {
                required: 'Please select a sales'
            },
            'product[]': {
                "allRequiredSelect": 'each field are required'
            },
            'total[]': {
                "allRequiredInput": 'each field are required'
            },
            'packaging[]': {
                "allRequiredSelect": 'each field are required'
            },
        },
        errorElement: 'em',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
        },
        highlight: function (element, errorClass, validClass) {
            $('#jxForm1 input[name="' + $(element).attr('name') + '"]').addClass('is-invalid').removeClass(
                'is-valid');
            $('#jxForm select[name="' + $(element).attr('name') + '"]').addClass('is-invalid').removeClass(
                'is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $('#jxForm1 input[name="' + $(element).attr('name') + '"]').addClass('is-valid').removeClass(
                'is-invalid');
            $('#jxForm1 select[name="' + $(element).attr('name') + '"]').addClass('is-valid').removeClass(
                'is-invalid');
        }
    });
</script>