var blank= "http://farm6.staticflickr.com/5445/8978337718_e3380f4a50_o.png";
var video_blank= "http://farm8.staticflickr.com/7410/8981883706_6ecb6e6311_o.png";
var blank_video= "http://farm4.staticflickr.com/3796/8980442649_20123cee4f_o.png";

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img_prev')
            .attr('src', e.target.result)
            .height(95);
        };
        reader.readAsDataURL(input.files[0]);
    }
    else {
        var img = input.value;
        $('#img_prev').attr('src',img).height(95);
    }
    $("#x").show();
}
function readURLL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img_prevv')
            .attr('src', e.target.result)
            .height(95);
        };

        reader.readAsDataURL(input.files[0]);
    }
    else {
        var img = input.value;
        $('#img_prevv').attr('src',img).height(95);
    }
    $("#xx").show();
}
function readURLLL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img_prevvv')
            .attr('src', e.target.result)
            .height(95);
        };

        reader.readAsDataURL(input.files[0]);
    }
    else {
        var img = input.value;
        $('#img_prevvv').attr('src',img).height(95);
    }
    $("#xxx").show();
}
function readURLLLL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img_prevvvv')
            .attr('src', video_blank)
            .height(95);
        };

        reader.readAsDataURL(input.files[0]);
    }
    else {
        var img = video_blank;
        $('#img_prevvvv').attr('src',img).height(95);
    }
    $("#xxxx").show();
}
$(document).ready(function() {
    $('#first_foto').bind('change', function() {
        //this.files[0].size gets the size of your file.
        if(this.files[0].size>5242880){
            $("p.child_p").text("Image is larger than 5MB");
            $(this).val("");
            $("#x").hide();
            $("#previewPane").addClass("too_big_img");
        }else $("#previewPane").removeClass("too_big_img");
    });
    $('#second_foto').bind('change', function() {
        //this.files[0].size gets the size of your file.
        if(this.files[0].size>5242880){
            $("p.child_pp").text("Image is larger than 5MB");
            $(this).val("");
            $("#xx").hide();
            $("#previewPanee").addClass("too_big_img");
        }else $("#previewPanee").removeClass("too_big_img");
    });
    $('#theird_foto').bind('change', function() {
        //this.files[0].size gets the size of your file.
        if(this.files[0].size>5242880){
            $("p.child_ppp").text("Image is larger than 5MB");
            $(this).val("");
            $("#xxx").hide();
            $("#previewPaneee").addClass("too_big_img");
        }else $("#previewPaneee").removeClass("too_big_img");
    });
    $('#video_pt').bind('change', function() {
        //this.files[0].size gets the size of your file.
        if(this.files[0].size>5242880){
            $("p.child_pppp").text("Video is larger than 5MB");
            $(this).val("");
            $("#xxxx").hide();
            $("#previewPaneeee").addClass("too_big_img");
        }else $("#previewPaneeee").removeClass("too_big_img");
    });
    $(".nav_menu_header .first").click(function() {
        $('html, body').animate({
            scrollTop: $(".txt_under_the_form").offset().top
        }, 2000);
    });
    $(".nav_menu_header .second").click(function() {
        $('html, body').animate({
            scrollTop: $(".footer_logo.sprite").offset().top
        }, 2000);
    });
    $(".nav_menu_header .theird").click(function() {
        $('html, body').animate({
            scrollTop: $("#colophon").offset().top
        }, 2000);
    });
    $("form :input").on("keypress", function(e) {
        return e.keyCode != 13;
    });
//    jQuery("#previewPane img").click(function(e){
//        jQuery(".for_inputt").fadeToggle('slow');
//
//        // bind the hide controls
//        var jpop=jQuery(".for_inputt");
//        jQuery(document).bind("click.hidethepop", function() {
//            jpop.fadeOut('slow');
//            // unbind the hide controls
//            jQuery(document).unbind("click.hidethepop");
//        });
//        // dont close thepop when you click on thepop
//        jQuery(".for_inputt").click(function(e) {
//            e.stopPropagation();
//        });
//        // and dont close thepop now 
//        e.stopPropagation();
//    });
//    jQuery("#previewPanee img").click(function(e){
//        jQuery(".for_inputtt").fadeToggle('slow');
//
//        // bind the hide controls
//        var jpop=jQuery(".for_inputtt");
//        jQuery(document).bind("click.hidethepop", function() {
//            jpop.fadeOut('slow');
//            // unbind the hide controls
//            jQuery(document).unbind("click.hidethepop");
//        });
//        // dont close thepop when you click on thepop
//        jQuery(".for_inputtt").click(function(e) {
//            e.stopPropagation();
//        });
//        // and dont close thepop now 
//        e.stopPropagation();
//    });
//    jQuery("#previewPaneee img").click(function(e){
//        jQuery(".for_inputttt").fadeToggle('slow');
//
//        // bind the hide controls
//        var jpop=jQuery(".for_inputttt");
//        jQuery(document).bind("click.hidethepop", function() {
//            jpop.fadeOut('slow');
//            // unbind the hide controls
//            jQuery(document).unbind("click.hidethepop");
//        });
//        // dont close thepop when you click on thepop
//        jQuery(".for_inputttt").click(function(e) {
//            e.stopPropagation();
//        });
//        // and dont close thepop now 
//        e.stopPropagation();
//    });
//    jQuery("#file_input_container").click(function(){
//        jQuery(".for_inputt").fadeOut('slow');
//    });
//    jQuery("#file_input_containerr").click(function(){
//        jQuery(".for_inputtt").fadeOut('slow');
//    });
//    jQuery("#file_input_containerrr").click(function(){
//        jQuery(".for_inputttt").fadeOut('slow');
//    });
//    jQuery("#video_pt").click(function(){
//        jQuery(".for_inputtttt").fadeOut('slow');
//    });
//    jQuery(".video_upload_area img").click(function(e){
//        jQuery(".for_inputtttt").fadeToggle('slow');
//
//        // bind the hide controls
//        var jpop=jQuery(".for_inputtttt");
//        jQuery(document).bind("click.hidethepop", function() {
//            jpop.fadeOut('slow');
//            // unbind the hide controls
//            jQuery(document).unbind("click.hidethepop");
//        });
//        // dont close thepop when you click on thepop
//        jQuery(".for_inputtttt").click(function(e) {
//            e.stopPropagation();
//        });
//        // and dont close thepop now 
//        e.stopPropagation();
//    });
    if(!Modernizr.input.placeholder){
        $("input").each(function(){
            if($(this).val()=="" && $(this).attr("placeholder")!=""){
                $(this).val($(this).attr("placeholder"));
                $(this).focus(function(){
                    if($(this).val()==$(this).attr("placeholder")) $(this).val("");
                });
                $(this).blur(function(){
                    if($(this).val()=="") $(this).val($(this).attr("placeholder"));
                });
            }
        });
    }
    $( ".question_title" ).each(function( index ) {
        $(this).text( index + ". " + $(this).text() );
    });
    
    $("#x").click(function() {
        $("#img_prev").attr("src",blank);
        $('#first_foto').val('');
        $("#first_input_img").val("");
        $(".child_p").text("");
        $("#x").hide();  
    });
    $("#xx").click(function() {
        $("#img_prevv").attr("src",blank);
        $('#second_foto').val('');
        $("#second_input_img").val("");
        $(".child_pp").text("");
        
        $("#xx").hide();  
    });
    $("#xxx").click(function() {
        $("#img_prevvv").attr("src",blank);
        $('#theird_foto').val('');
        $("#theird_input_img").val("");
        $(".child_ppp").text("");
        
        $("#xxx").hide();  
    });
    $("#xxxx").click(function() {
        $("#img_prevvvv").attr("src",blank_video);
        $('#video_pt').val('');
        $(".child_pppp").text("");
        
        $("#xxxx").hide();  
    });
    //    $("#get_image").click(function(){
    //        $("#x").show();
    //        $("#first_foto").val("");
    //        var value = $("#first_input_img").val().toLowerCase();
    //        if (value.indexOf("http://") > -1){
    //            if (value.indexOf(".jpg") > 8){
    //                $("p.child_p").text("");
    //                $("#previewPane img").attr("src", value);
    //                $(".for_inputt").fadeOut('slow');
    //            }
    //            else if (value.indexOf(".jpe") > 8){
    //                $(".for_inputt").fadeOut('slow');
    //                $("p.child_p").text("");
    //                $("#previewPane img").attr("src", value);
    //            }
    //            else if (value.indexOf(".jpeg") > 8){
    //                $(".for_inputt").fadeOut('slow');
    //                $("p.child_p").text("");
    //                $("#previewPane img").attr("src", value);
    //            }
    //            else if (value.indexOf(".gif") > 8){
    //                $(".for_inputt").fadeOut('slow');
    //                $("p.child_p").text("");
    //                $("#previewPane img").attr("src", value);
    //            }
    //            else if (value.indexOf(".png") > 8){
    //                $(".for_inputt").fadeOut('slow');
    //                $("p.child_p").text("");
    //                $("#previewPane img").attr("src", value);
    //            }
    //            else {
    //                $("p.child_p").text("Link is not valid");
    //                $("#img_prev").attr("src",blank);
    //                $("#x").hide(); 
    //            }
    //        } 
    //        else if (value.indexOf("https://") > -1){
    //            if (value.indexOf(".jpg") > 8){
    //                $(".for_inputt").fadeOut('slow');
    //                $("p.child_p").text("");
    //                $("#previewPane img").attr("src", value);
    //            }
    //            else if (value.indexOf(".jpe") > 8){
    //                $(".for_inputt").fadeOut('slow');
    //                $("p.child_p").text("");
    //                $("#previewPane img").attr("src", value);
    //            }
    //            else if (value.indexOf(".jpeg") > 8){
    //                $(".for_inputt").fadeOut('slow');
    //                $("p.child_p").text("");
    //                $("#previewPane img").attr("src", value);
    //            }
    //            else if (value.indexOf(".gif") > 8){
    //                $(".for_inputt").fadeOut('slow');
    //                $("p.child_p").text("");
    //                $("#previewPane img").attr("src", value);
    //            }
    //            else if (value.indexOf(".png") > 8){
    //                $(".for_inputt").fadeOut('slow');
    //                $("p.child_p").text("");
    //                $("#previewPane img").attr("src", value);
    //            }
    //            else {
    //                $("p.child_p").text("Link is not valid");
    //                $("#img_prev").attr("src",blank);
    //                $("#x").hide(); 
    //            }
    //        }
    //        else {
    //            $("p.child_p").text("Link is not valid");
    //            $("#img_prev").attr("src",blank);
    //            $("#x").hide(); 
    //        }
    //    });
    //    $("#get_imagee").click(function(){
    //        $("#xx").show();
    //        $("#second_foto").val("");
    //        var value = $("#second_input_img").val().toLowerCase();
    //        if (value.indexOf("http://") > -1){
    //            if (value.indexOf(".jpg") > 8){
    //                $(".for_inputtt").fadeOut('slow');
    //                $("p.child_pp").text("");
    //                $("#previewPanee img").attr("src", value);
    //            }
    //            else if (value.indexOf(".jpe") > 8){
    //                $(".for_inputtt").fadeOut('slow');
    //                $("p.child_pp").text("");
    //                $("#previewPanee img").attr("src", value);
    //            }
    //            else if (value.indexOf(".jpeg") > 8){
    //                $(".for_inputtt").fadeOut('slow');
    //                $("p.child_pp").text("");
    //                $("#previewPanee img").attr("src", value);
    //            }
    //            else if (value.indexOf(".gif") > 8){
    //                $(".for_inputtt").fadeOut('slow');
    //                $("p.child_pp").text("");
    //                $("#previewPanee img").attr("src", value);
    //            }
    //            else if (value.indexOf(".png") > 8){
    //                $(".for_inputtt").fadeOut('slow');
    //                $("p.child_pp").text("");
    //                $("#previewPanee img").attr("src", value);
    //            }
    //            else{
    //                $("p.child_pp").text("Link is not valid");
    //                $("#img_prevv").attr("src",blank);
    //                $("#xx").hide(); 
    //            }
    //        } 
    //        else if (value.indexOf("https://") > -1){
    //            if (value.indexOf(".jpg") > 8){
    //                $(".for_inputtt").fadeOut('slow');
    //                $("p.child_pp").text("");
    //                $("#previewPanee img").attr("src", value);
    //            }
    //            else if (value.indexOf(".jpe") > 8){
    //                $(".for_inputtt").fadeOut('slow');
    //                $("p.child_pp").text("");
    //                $("#previewPanee img").attr("src", value);
    //            }
    //            else if (value.indexOf(".jpeg") > 8){
    //                $(".for_inputtt").fadeOut('slow');
    //                $("p.child_pp").text("");
    //                $("#previewPanee img").attr("src", value);
    //            }
    //            else if (value.indexOf(".gif") > 8){
    //                $(".for_inputtt").fadeOut('slow');
    //                $("p.child_pp").text("");
    //                $("#previewPanee img").attr("src", value);
    //            }
    //            else if (value.indexOf(".png") > 8){
    //                $(".for_inputtt").fadeOut('slow');
    //                $("p.child_pp").text("");
    //                $("#previewPanee img").attr("src", value);
    //            }
    //            else{
    //                $("p.child_pp").text("Link is not valid");
    //                $("#img_prevv").attr("src",blank);
    //                $("#xx").hide(); 
    //            }
    //        } 
    //        else{
    //            $("p.child_pp").text("Link is not valid");
    //            $("#img_prevv").attr("src",blank);
    //            $("#xx").hide(); 
    //        }
    //    });
    //    $("#get_imageee").click(function(){
    //        $("#xxx").show();
    //        $("#theird_foto").val("");
    //        var value = $("#theird_input_img").val().toLowerCase();
    //        if (value.indexOf("http://") > -1){
    //            if (value.indexOf(".jpg") > 8){
    //                $(".for_inputttt").fadeOut('slow');
    //                $("p.child_ppp").text("");
    //                $("#previewPaneee img").attr("src", value);
    //            }
    //            else if (value.indexOf(".jpe") > 8){
    //                $(".for_inputttt").fadeOut('slow');
    //                $("p.child_ppp").text("");
    //                $("#previewPaneee img").attr("src", value);
    //            }
    //            else if (value.indexOf(".jpeg") > 8){
    //                $(".for_inputttt").fadeOut('slow');
    //                $("p.child_ppp").text("");
    //                $("#previewPaneee img").attr("src", value);
    //            }
    //            else if (value.indexOf(".gif") > 8){
    //                $(".for_inputttt").fadeOut('slow');
    //                $("p.child_ppp").text("");
    //                $("#previewPaneee img").attr("src", value);
    //            }
    //            else if (value.indexOf(".png") > 8){
    //                $(".for_inputttt").fadeOut('slow');
    //                $("p.child_ppp").text("");
    //                $("#previewPaneee img").attr("src", value);
    //            }
    //            else{
    //                $("p.child_ppp").text("Link is not valid");
    //                $("#img_prevvv").attr("src",blank);
    //                $("#xxx").hide(); 
    //            }
    //        } 
    //        else if (value.indexOf("https://") > -1){
    //            if (value.indexOf(".jpg") > 8){
    //                $(".for_inputttt").fadeOut('slow');
    //                $("p.child_ppp").text("");
    //                $("#previewPaneee img").attr("src", value);
    //            }
    //            else if (value.indexOf(".jpe") > 8){
    //                $(".for_inputttt").fadeOut('slow');
    //                $("p.child_ppp").text("");
    //                $("#previewPaneee img").attr("src", value);
    //            }
    //            else if (value.indexOf(".jpeg") > 8){
    //                $(".for_inputttt").fadeOut('slow');
    //                $("p.child_ppp").text("");
    //                $("#previewPaneee img").attr("src", value);
    //            }
    //            else if (value.indexOf(".gif") > 8){
    //                $(".for_inputttt").fadeOut('slow');
    //                $("p.child_ppp").text("");
    //                $("#previewPaneee img").attr("src", value);
    //            }
    //            else if (value.indexOf(".png") > 8){
    //                $(".for_inputttt").fadeOut('slow');
    //                $("p.child_ppp").text("");
    //                $("#previewPaneee img").attr("src", value);
    //            }
    //            else{
    //                $("p.child_ppp").text("Link is not valid");
    //                $("#img_prevvv").attr("src",blank);
    //                $("#xxx").hide(); 
    //            }
    //        } 
    //        else{
    //            $("p.child_ppp").text("Link is not valid");
    //            $("#img_prevvv").attr("src",blank);
    //            $("#xxx").hide(); 
    //        }
    //    });
    $("#file_input_container").click(function(){
        $("#first_input_img").val('');
        $("#img_prev").attr("src",blank);
        $("#x").hide();
        $("p.child_p").text("");
    });
    $("#file_input_containerr").click(function(){
        $("#second_input_img").val(''); 
        $("#img_prevv").attr("src",blank);
        $("#xx").hide();
        $("p.child_pp").text("");
    });
    $("#file_input_containerrr").click(function(){
        $("#theird_input_img").val('');
        $("#img_prevvv").attr("src",blank);
        $("#xxx").hide();
        $("p.child_ppp").text("");
    });
    $("#file_input_containerrrr").click(function(){
        $("#img_prevvvv").attr("src",blank_video);
        $("#xxxx").hide();
        $("p.child_pppp").text("");
    });
    
    // get_current url]
    if(window.location.href.indexOf("success") > -1) {
        $('#success_message').show();
        $('#main').css('margin-bottom','100px');
    }
    $('#img_prev').click(function() {
        $('#first_foto').click();
    });
    $('#img_prevv').click(function() {
        $('#second_foto').click();
    });
    $('#img_prevvv').click(function() {
        $('#theird_foto').click();
    });
    $('#img_prevvvv').click(function() {
        $('#video_pt').click();
    });
});