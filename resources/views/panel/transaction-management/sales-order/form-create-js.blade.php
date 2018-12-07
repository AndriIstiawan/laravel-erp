<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
<script>
    
    $('#delivery').select2({theme:"bootstrap", placeholder:'Dikirim via'/*,tags: true*/});
    $('#delivery').on('change', function(){
       $(this).valid();
    });

$('#packkayu').select2({theme:"bootstrap", placeholder:'Kemasan'/*,tags: true*/});
    $('#packkayu').on('change', function(){
       $(this).valid();
    });

    var submit = false;
    var count = 1;
    $('#client').select2({
        theme: "bootstrap",
        placeholder: 'Nama Customer'
    }).change(function () {
        clientChange($(this));
        if (submit) {
            $(this).valid();
        }
    });

    $('.product-order-list select[name="product1"]').select2({
        theme: "bootstrap",
        placeholder: 'Kode - Produk - Tipe'
    }).change(function () {
        if (submit) {
            $(this).valid();
        }
    });

    $('.product-order-list select[name="package1"]').select2({
        theme: "bootstrap",
        placeholder: 'Jenis Kemasan'
    }).change(function () {
        packageChange($(this));
        if (submit) {
            $(this).valid();
        }
    });

    $('.product-order-list select[name="weight1"]').select2({
        theme: "bootstrap",
        placeholder: 'Kemasan',
        language: {
            noResults: function (params) {
            return "";
            }
        }
    }).change(function () {
        if (submit) {
            $(this).valid();
        }
    });

    function clientChange(elm) {
        html = "";
        if ($('.divisi-' + elm.val()).html()) {
            html += $('.divisi-' + elm.val()).html();
        }

        $('.divisi-list').html(html);
        $('.divisi-list select').attr('id', 'divisi');
        $('.fa-info-circle').tooltip();
        //-----------set divisi client
        $('#divisi').select2({
            theme: "bootstrap",
            placeholder: 'Divisi - Sales'
        }).change(function () {
            $(this).valid();
        });

        $('#divisi').rules("add", {
            required: true,
            messages: {
                required: "Mohon pilih divisi"
            }
        });
        //-----------end set divisi client

        //-----------setting billing client
        $('#billing').val($('.billing-' + elm.val()).html());
        //-----------end setting billing client

        //-----------setting shipping client
        $('.shipping-list').html($('.shipping-' + elm.val()).html());
        //set select2 divisi 
        $('.shipping-list .shipping-valid').select2({
            theme: "bootstrap",
            placeholder: 'Alamat Pengiriman'
        }).change(function () {
            $(this).valid();
        });

        $('.shipping-list .shipping-valid').rules("add", {
            required: true,
            messages: {
                required: "Mohon pilih shipment tujuan"
            }
        });
        //-----------end setting shipping client

    }

    //add method validate "allRequired"
    jQuery.validator.addMethod("quantityOrder", function (value, elem) {
        var status = true;
        var nameCount = elem.name.replace('quantity','');
        var weight = $('.product-order-list select[name="weight'+nameCount+'"]');
        var total = $('.product-order-list input[name="total'+nameCount+'"]');

        weight = parseInt(weight.val());
        total = parseInt(total.val())*1000;
        if(!isNaN(weight)&&!isNaN(total)){
            if(value == '-'){
                status = false;
            }
        }

        return status;
    });

    //validation
    $('#jxForm').validate({
        rules: {
            client: {
                required: true
            },
            delivery: {
                required: true
            },
            TOP: {
                required: true
            },
            product1: {
                required: true
            },
            package1: {
                required: true
            },
            quantity1: {
                "quantityOrder": true
            },
            weight1: {
                required: true
            },
            total1: {
                required: true
            },
            realisasi1: {
                required: true
            },
        },
        messages: {
            client: {
                required: 'Mohon pilih client'
            },
            delivery: {
                required: 'Mohon pilih kurir pengiriman'
            },
            TOP: {
                required: 'Mohon input terms of payment'
            },
            product1: {
                required: 'Mohon pilih product'
            },
            package1: {
                required: 'Mohon pilih package'
            },
            quantity1: {
                "quantityOrder": 'quantity invalid'
            },
            weight1: {
                required: 'Mohon pilih berat'
            },
            total1: {
                required: 'Mohon input total'
            },
            realisasi1: {
                required: 'Mohon input realisasi'
            },
        },
        errorElement: 'em',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
            if (element.name.indexOf("quantity") < 0){
                $(element).closest('div').find('.select2-selection').attr('style',
                'border-color:#f86c6b');
            }
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass('is-valid').removeClass('is-invalid');
            if (element.name.indexOf("quantity") < 0){
                $(element).closest('div').find('.select2-selection').attr('style',
                'border-color:#4dbd74');
            }
        }
    });

    function save(){
        submit = true;
        $('.fa-save').prop('disabled', true);
        if(!$('#jxForm').valid()){
            $('.fa-save').prop('disabled', false);
            toastr.warning('Mohon cek kembali data inputan anda', 'Form not valid');
        }
    }

    function addProduct(){
        count++;
        $('.product-order-items .arrProduct').val(count);
        //set product items
        $('.product-order-items .products').attr('name','product'+count).attr('aria-describedby','product'+count+'-error');
        $('.product-order-items .products-em').attr('id','product'+count+'-error');

        //set package items
        $('.product-order-items .packages').attr('name','package'+count).attr('aria-describedby','package'+count+'-error');
        $('.product-order-items .packages-em').attr('id','package'+count+'-error');

        //set weight items
        $('.product-order-items .quantity').attr('name','quantity'+count);
        $('.product-order-items .quantity-em').attr('id','quantity'+count+'-error');
        $('.product-order-items .weights').attr('name','weight'+count).attr('aria-describedby','weight'+count+'-error');
        $('.product-order-items .weights-em').attr('id','weight'+count+'-error');

        //set total value items
        $('.product-order-items .totals').attr('name','total'+count).attr('aria-describedby','total'+count+'-error');
        $('.product-order-items .totals-em').attr('id','total'+count+'-error');

        //set realisasi items
        $('.product-order-items .realisasi').attr('name','realisasi'+count).attr('aria-describedby','realisasi'+count+'-error');
        $('.product-order-items .realisasi-em').attr('id','realisasi'+count+'-error');

        //set to product list
        $('.product-order-list').append($('.product-order-items').html());

        //set new select2 product order
        $('.product-order-list select[name="product'+count+'"]').select2({
            theme: "bootstrap",
            placeholder: 'Kode - Produk - Tipe'
        }).change(function () {
            if (submit) {
                $(this).valid();
            }
        });
        $('.product-order-list select[name="package'+count+'"]').select2({
            theme: "bootstrap",
            placeholder: 'Jenis Kemasan'
        }).change(function () {
            packageChange($(this));
            if (submit) {
                $(this).valid();
            }
        });
        $('.product-order-list select[name="weight'+count+'"]').select2({
            theme: "bootstrap",
            placeholder: 'Kemasan'
        }).change(function () {
            if (submit) {
                $(this).valid();
            }
        });

        //validate new product order
        $('.product-order-list select[name="product'+count+'"]').rules("add", {
            required: true,
            messages: {
                required: "Mohon pilih product"
            }
        });
        $('.product-order-list select[name="package'+count+'"]').rules("add", {
            required: true,
            messages: {
                required: "Mohon pilih package"
            }
        });
        $('.product-order-list select[name="weight'+count+'"]').rules("add", {
            required: true,
            messages: {
                required: "Mohon pilih berat"
            }
        });
        $('.product-order-list input[name="quantity'+count+'"]').rules("add", {
            "quantityOrder": true,
            messages: {
                "quantityOrder": "quantity invalid"
            }
        });
        $('.product-order-list input[name="total'+count+'"]').rules("add", {
            required: true,
            messages: {
                required: "Mohon input total"
            }
        });
        $('.product-order-list input[name="realisasi'+count+'"]').rules("add", {
            required: true,
            messages: {
                required: "Mohon input realisasi"
            }
        });
        
        $('.fa-info-circle').tooltip();
    }

    //change select weight on change package
    function packageChange(elm){
        var weightClosest = elm.closest('.div-items').find('.weights');
        var new250g = new Option('250 gr', '250', true, true);
        var new500g = new Option('500 gr', '500', true, true);
        var new1kg = new Option('1 kg', '1000', true, true);
        var new5kg = new Option('5 kg', '5000', true, true);
        var new25kg = new Option('25 kg', '25000', true, true);
        var new30kg = new Option('30 kg', '30000', true, true);
        //clear option
        weightClosest.empty();

        switch(elm.val()){
            case "Plastik" :
                weightClosest.append(new250g);
                weightClosest.append(new500g);
                weightClosest.append(new1kg);
                break;
            case "Aluminium" :
                weightClosest.append(new250g);
                weightClosest.append(new500g);
                weightClosest.append(new1kg);
                break;
            case "Jerigen" :
                weightClosest.append(new5kg);
                weightClosest.append(new25kg);
                weightClosest.append(new30kg);
                break;
            case "Drum" :
                weightClosest.append(new25kg);
                break;
        }
        //return empty select
        weightClosest.val('').trigger('change');
    }

    function countTotal(elm){
        var weight = elm.closest('.div-items').find('.weights');
        var total = elm.closest('.div-items').find('.totals');
        var realisasi = elm.closest('.div-items').find('.realisasi');
        var qty = '-';
        var realisasi = '';

        weight = parseInt(weight.val());
        total = parseFloat(total.val())*1000;

        if(!isNaN(weight)&&!isNaN(total)){
            console.log('masuk weight & total number');
            if(total/weight >= 1){
                console.log(total/weight);
                qty = parseInt(total/weight);
                realisasi = (qty*weight)/1000;
            }

            elm.closest('.div-items').find('.quantity').val(qty);
            elm.closest('.div-items').find('.realisasi').val(realisasi);
        }
        elm.closest('.div-items').find('.quantity').valid();
    }
</script>