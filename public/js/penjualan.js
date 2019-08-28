var Penjualan = function () {
    var handleForm = function () {
        $('.select-mobil').select2({
            placeholder: 'Select...',
            ajax: {
                url: BASE_URL + '/penjualan/get-mobil',
                dataType: 'json',
                type: 'post'
            },
            minimumInputLength: 1
        });

        $('.btn-pilih-mobil').on('click', function () {
            var $btn = $(this),
                $slcMobil = $('.select-mobil'),
                $tbody = $('#table_detail tbody'),
                $template = $('tr.template', $tbody),
                $newTr = $template.clone(),
                row = $('tr:not(.template)', $tbody).length;

            if (!$slcMobil.val()) return false;

            var data = $slcMobil.data('select2').data()[0];
            $.each(data, function (key, value) {
                if ($('.' + key, $newTr).length) {
                    $('.' + key, $newTr).html(value);
                } else if ($('[name="details[%INC%][' + key + ']"]', $newTr).length) {
                    $('[name="details[%INC%][' + key + ']"]', $newTr).val(value);
                }
            });
            $.each($(':input:not(button)', $newTr), function (i, e) {
                var $el = $(e);
                var name = $el.attr('name');
                name = name.replace(/%INC%/, row);
                $el.attr('name', name);
            });
            $(':input', $newTr).removeAttr('disabled');
            $newTr.removeClass('template hidden');
            $newTr.appendTo($tbody);
            $slcMobil.val('').trigger('change');
            handleCalc();
            handleButton();
        });
        handleButton();
        handleCalc();
    };

    var handleCalc = function () {
        $('.input-jumlah').off('keyup change').on('keyup change', function () {
            var $tr = $(this).closest('tr'),
                jumlah = isNaN($(this).val()) ? 0 : parseInt($(this).val()),
                harga = isNaN($('.input-harga', $tr).val()) ? 0 : parseInt($('.input-harga', $tr).val()),
                $subtotal = $('.input-subtotal', $tr);

            $subtotal.val(harga * jumlah);
        });
    };

    var handleButton = function () {
        $('.btn-delete-row').off('click').on('click', function () {
            var $btn = $(this),
                $tr = $btn.closest('tr');

            $tr.remove();
            handleDetailIndex();
        });
    };

    var handleDetailIndex = function () {
        var $tbody = $('#table_detail tbody');

        $.each($('tr:not(.template)', $tbody), function (i, e) {
            var $tr = $(e);
            $.each($(':input:not(button)', $tr), function (ii, ee) {
                var $el = $(ee);
                var name = $el.attr('name');
                name = name.replace(/\[\d+\]/, '[' + i + ']');
                $el.attr('name', name);
            });
        });
    };

    return {
        init: function () {

        },
        initForm: handleForm
    }
}();

$(document).ready(function () {
    Penjualan.init();
});