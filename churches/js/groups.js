//Groups design
//Sorting and searching
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


//Map
var google;
function initMap() {
    var kigali = {lat:-1.991019, lng:30.096819};
    var map = new google.maps.Map(document.getElementById('group_map'), {
      zoom: 10,
      center: kigali
    });
    var marker = new google.maps.Marker({
      position: kigali,
      map: map
    });

    var autocomplete = new google.maps.places.Autocomplete(document.getElementById('loctest1'));
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        alert(0)
        var place = autocomplete.getPlace();
        placename = place.name;
        lat = place.geometry.location.lat();
        lng = place.geometry.location.lng();
        log(placename)
    });
};

//When the group's going to be created
$("#launch_group_create").on('click', function(){
    var autocomplete = new google.maps.places.Autocomplete(document.getElementById('loctestF'));
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        alert(0)
        var place = autocomplete.getPlace();
        placename = place.name;
        lat = place.geometry.location.lat();
        lng = place.geometry.location.lng();
        log(placename)
    });
})