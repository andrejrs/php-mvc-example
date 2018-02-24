(function ($) {

    "use strict";

    var onDateChange = function () {
        window.location = "/home/from/"
                + $("#filterFrom").val()
                + "/to/" + $("#filterTo").val()
                + "/month/" + $("#filterMonth").val();
    };

    $("#filterFrom, #filterTo, #filterMonth").change(onDateChange);

    $(".monthPicker").datepicker({
        format: "yyyy-mm",
        viewMode: "months",
        minViewMode: "months"
    });


})(jQuery);