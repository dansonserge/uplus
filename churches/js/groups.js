$(function() {
    altair_contact_list.init()
}),
altair_contact_list = {
    init: function() {
        var t = $("#contact_list")
          , i = [];
        t.children().each(function() {
            var t = $(this).attr("data-uk-filter").split(",")
              , n = t.length;
            for ($i = 0; $i < n; $i++)
                -1 == $.inArray(t[$i], i) && i.push(t[$i])
        });
        var n = i.length
          , r = UIkit.grid(t, {
            controls: "#contact_list_filter",
            gutter: 20
        });
        $("#contact_list_search").keyup(function() {
            var t = $(this).val().toLowerCase();
            if (t.length > 2) {
                var a = "";
                for ($i = 0; $i < n; $i++)
                    -1 !== i[$i].indexOf(t) && (a += (a.length > 1 ? "," : "") + i[$i]);
                a ? r.filter(a) : r.filter("all")
            } else
                t.length > 0 && r.filter()
        }),
        r.on("afterupdate.uk.grid", function(t, i) {
            i.length > 0 ? $(".grid_no_results").fadeOut() : $(".grid_no_results").fadeIn()
        })
    }
};