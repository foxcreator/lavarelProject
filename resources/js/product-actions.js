import './bootstrap';
import $ from 'jquery';

$(document).ready(function (e) {

    $(document).on('change', '.star', function () {
        $(this).parents('.poststars').submit();
    });

});
