jQuery(document).ready(function ($) {
    // Handling click on Categories
    $('.navigation-mobile_cat').on('click', function (e) {
        if ($(e.target).is(this) || $(e.target).is($('i', this))) {
            e.preventDefault();
            $('.navigation-mobile_subcat').toggle();
        }
    });

    // Hide subcategories menu when click outside
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.navigation-mobile_cat').length) {
            $('.navigation-mobile_subcat').hide();
        }
    });

    $('#show_search').on('click', function (e) {
        e.preventDefault();
        $('#live_searchform').toggle();
    });
});


$('form[role="search"] button[type="submit"]').prop('disabled', true);
$('form[role="search"] input[type="text"]').on('input', function () {
    if ($(this).val().length > 0) {
        $('form[role="search"] button[type="submit"]').prop('disabled', false);
    } else {
        $('form[role="search"] button[type="submit"]').prop('disabled', true);
    }
});
