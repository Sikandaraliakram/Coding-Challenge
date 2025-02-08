(function ($) {
    $(document).off('click', '#import').on('click', '#import', function (event) {
        event.preventDefault();
        if ($('#sales_import_form #file').get(0).files.length === 0) {
            return false;
        }

        const data = new FormData($('#sales_import_form')[0]);
        $.ajax({
            url: "uploadSalesData",
            type: "POST",
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            data: data,
            dataType: 'json',
            success: function (data) {
                alert(data.msg);
                if (data.status === 'success') {
                    setTimeout(() => {
                        window.location.href = "./"
                    }, 1000);
                }
            }
        });
    });

    $(document).off('click', '#applyFilter').on('click', '#applyFilter', function (event) {
        event.preventDefault();
        const data = new FormData($('#filterForm')[0]);
        $.ajax({
            url: "filterSales",
            type: "POST",
            contentType: false,
            cache: false,
            processData: false,
            data: data,
            success: function (data) {
                $('#sales_list').html(data);
            }
        });
    });

    $(document).off('reset', '#filterForm').on('reset', '#filterForm', function (event) {
        setTimeout(function () {
            $('#applyFilter').trigger('click');
        }, 500)
    })
})(jQuery);
