var hotspots = [];
if (typeof project_hotspots != 'undefined') {
    $.each(project_hotspots, function (index, value) { // object to array
        hotspots.push(value);
    });
} else {
    hotspots = [];
}
var projectWidth, projectHeight;

$(document).ready(function () {
    var hotspotX, hotspotY;
    projectWidth = $('#project-area img').width();
    projectHeight = $('#project-area img').height();

    placeHotspots(hotspots);

    console.log(hotspots);

    $('.point').live('click', function (e) {
        e.stopPropagation();
        var hotspointForm = $(this).parent().find('.hotspot-form');
        if (hotspointForm.is(':hidden')) {
            $('.hotspot-form').hide();
            hotspointForm.show();
        } else if (hotspointForm.is(':visible')) {
            hotspointForm.hide();
        }
    });

    $('#hotspot-modal').dialog({
        title: hotspotModalLabel,
        dialogClass: 'wp-dialog',
        autoOpen: false,
        draggable: false,
        width: 'auto',
        modal: true,
        resizable: false,
        closeOnEscape: true,
        position: {
            my: "center",
            at: "center",
            of: window
        },
        open: function () {
            // close dialog by clicking the overlay behind it
            $('.ui-widget-overlay').bind('click', function () {
                $('#hotspot-modal').dialog('close');
            })
        },
        create: function () {
            // style fix for WordPress admin
            $('.ui-dialog-titlebar-close').addClass('ui-button');
        },
    });

    $('.hotspot').live('click', function (e) {
        e.stopPropagation();
    });

    $('#project-area img').click(function (e) {
        e.preventDefault();
        $('.hotspot-form').hide();
        console.log(projectWidth + ' ' + projectHeight);
        hotspotX = e.pageX - $(this).offset().left;
        hotspotY = e.pageY - $(this).offset().top;

        hotspotX = parseFloat(hotspotX / projectWidth).toFixed(2);
        hotspotY = parseFloat(hotspotY / projectHeight).toFixed(2);

        console.log(hotspotX + ' ' + hotspotY);

        $('#hotspot-modal').dialog('open');
    });

    $('#hotspot-create').live('click', function (e) {
        e.preventDefault();

        var hotspotType = $('select[name="hotspot-type"]').val();

        hotspots.push({
            hotspotX: hotspotX,
            hotspotY: hotspotY,
            type: hotspotType,
            fields: {}
        });

        placeHotspots(hotspots);
        $('#hotspot-modal').dialog('close');
    });

    $('.hotspot-remove').live('click', function (e) {
        console.log(hotspots);
        e.preventDefault();
        var hotspot = $(this).closest('.hotspot').first();
        var hotspot_num = hotspot.attr('data-num');
        hotspot.remove();
        hotspots.splice(hotspot_num, 1);
        placeHotspots(hotspots);
    });
});

function placeHotspots(hotspots) {
    $.each(hotspots, function (index, hotspot) {
        $.ajax({
            context: $('#project-area'),
            url: ajaxurl,
            method: "POST",
            data: {
                action: "get_hotspot",
                num: index,
                hotspotX: hotspot.hotspotX,
                hotspotY: hotspot.hotspotY,
                type: hotspot.type,
                fields: hotspot.fields
            },
            beforeSend: function () {
                $('.hotspot').remove();
            },
            success: function (data) {
                this.append(data);
                $('.hotspot').each(function (num, hotspot) {
                    var hotspotX = $(this).attr('data-hotspoty');
                    var hotspotY = $(this).attr('data-hotspotx');

                    $('.hotspot-form').hide();

                    $(this).css({
                        top: projectHeight * hotspotX,
                        left: projectWidth * hotspotY
                    });
                });
            }
        });
    });
}