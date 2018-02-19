$(document).on("keypress", "._number", function (e) {
        // data length validate
        // Length | Num | Decimal | Comma | Dot
        //   14   |  9  |    2    |   2   | 1
        //   22   |  15 |    2    |   4   | 1

        var t = $(this);
        var value = t.val();
        if (e.keyCode >= 48 && e.keyCode <= 57 || e.keyCode == 46) {
            return true;
        } else {
            if ($(this).hasClass("_numzero") && e.keyCode == 45) {
                return true;
            } else {
                return false;
            }
        }
        if ((e.shiftKey || (e.keyCode < 46 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105) && e.keyCode != 110) {
            return false;
            e.preventDefault();
        }
    });
