
$(document).ready(function() {
    $(".datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: '2000:2020'
    });
    new Cleave('#phone', {
        phone: true,
        phoneRegionCode: 'us'
    });
    var current_fs, next_fs, previous_fs;
    var left, opacity, scale;
    var animating;
    $(".steps").validate({
        errorClass: 'invalid',
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.insertAfter(element.next('span').children());
        },
        highlight: function(element) {
            $(element).next('span').show();
        },
        unhighlight: function(element) {
            $(element).next('span').hide();
        }
    });
    $(".next").click(function() {
        $(".steps").validate({
            debug:true,
            errorClass: 'invalid',
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.insertAfter(element.next('span').children());
            },
            highlight: function(element) {
                $(element).next('span').show();
            },
            unhighlight: function(element) {
                $(element).next('span').hide();
            }
        });
        if ((!$('.steps').valid())) {
            return true;
        }
        if ($(this).attr('data-page') == 4) {
            if ($('#pad_data').val() == '') {
                $('#pad_data').next().css('display', 'block')
                return true;
            }else{
                $('#pad_data').next().css('display', 'none')
            }
        }
        if (animating) return false;
        animating = true;
        current_fs = $(this).parent().parent();
        next_fs = $(this).parent().parent().next();
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
        next_fs.show();
        current_fs.animate({
            opacity: 0
        }, {
            step: function(now, mx) {
                scale = 1 - (1 - now) * 0.2;
                left = (now * 50) + "%";
                opacity = 1 - now;
                current_fs.css({
                    'transform': 'scale(' + scale + ')'
                });
                next_fs.css({
                    'left': left,
                    'opacity': opacity
                });
            },
            duration: 800,
            complete: function() {
                current_fs.hide();
                animating = false;
            },
            easing: 'easeInOutExpo'
        });
    });
    $("#submit").click(function() {
        var response = grecaptcha.getResponse();
        if (!$("#accept").prop("checked")) {
            return;
        }
        // if(response.length == 0){
        //     return;
        // }
        var data = $('form.steps').serialize();
        $.ajax({
            url: './api.php',
            data: data,
            type: 'post',
            beforeSend: function() {
                $('#final_previous').attr('disabled', 'disabled')
                $('#submit').attr('disabled', 'disabled')
                $('#submit').val('Processing...')
            },
            success: function(data){

                if (animating) return false;
                animating = true;
                current_fs = $("#submit").parent().parent();
                next_fs = $("#submit").parent().parent().next();
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                next_fs.show();
                current_fs.animate(
                    {
                        opacity: 0
                    },
                    {
                        step: function(now, mx) {
                            scale = 1 - (1 - now) * 0.2;
                            left = (now * 50) + "%";
                            opacity = 1 - now;
                            current_fs.css({
                                'transform': 'scale(' + scale + ')'
                            });
                            next_fs.css({
                                'left': left,
                                'opacity': opacity
                            });
                        },
                        duration: 800,
                        complete: function() {
                            current_fs.hide();
                            animating = false;
                        },
                        easing: 'easeInOutExpo'
                    }
                );
            }
        })
        
    });
    $(".previous").click(function() {
        $("#accept").prop("checked", false)
        if ($(this).attr('data-page') == 4) {
            $('#pad_data').next().css('display', 'none')
        }
        if (animating) return false;
        animating = true;
        current_fs = $(this).parent().parent();
        previous_fs = $(this).parent().parent().prev();
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
        previous_fs.show();
        current_fs.animate({
            opacity: 0
        }, {
            step: function(now, mx) {
                scale = 0.8 + (1 - now) * 0.2;
                left = ((1 - now) * 50) + "%";
                opacity = 1 - now;
                current_fs.css({
                    'left': left
                });
                previous_fs.css({
                    'transform': 'scale(' + scale + ')',
                    'opacity': opacity
                });
            },
            duration: 800,
            complete: function() {
                current_fs.hide();
                animating = false;
            },
            easing: 'easeInOutExpo'
        });
    });

    $("#customFile").change(function() {
        readURL(this);
    });
    var num = 0;
    $('.add_another').click(function(){
        ++ num;
        $('.new_child').append(`
        <div class="form-item-wrapper">
            <div class="form-item child_name">
                <input id="child_full_name_${num}" class="form-text hs-input" name="child_full_name_${num}" required="required" type="text" data-rule-required="true" data-msg-required="Requierd field">
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
            <div class="form-item">
                <input id="child_birthday_${num}" class="datepicker form-text hs-input" name="child_birthday_${num}" required="required" type="text" data-rule-required="true" data-msg-required="Requierd field">
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
        </div>
        `)
        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true
        });
    })

    $('#reset_1').click(function(){
        $(this).parent().parent().find('input[type=text]').val('');
    })
    $('#reset_2').click(function(){
        if ( num > 0) {
            $('#child_full_name_'+num).parent().parent().remove()
            num --
        }else{
            $(this).parent().parent().find('input[type=text]').val('');
            num = 0
        }
    })

    $('.final-button').click(function(){
        $('.review_name').text($('#fullname').val())
        $('.review_street').text($('#street').val())
        $('.review_city').text($('#city').val())
        $('.review_state').text($('#state').val())
        $('.review_code').text($('#zip_code').val())
        $('.review_phone').text($('#phone').val())
        $('.child_review').html('');
        $('.child_review').append(`
            <div class="form-item-wrapper">
                <div class="form-item">
                    <p>${$('#child_full_name').val()}</p>
                </div>
                <div class="form-item">
                    <p>${$('#child_birthday').val()}</p>
                </div>
            </div>
        `)
        if (num > 0) {
            for (let i = 1; i <= num; i++) {
                $('.child_review').append(`
                <div class="form-item-wrapper">
                    <div class="form-item">
                        <p>${$('#child_full_name_'+num).val()}</p>
                    </div>
                    <div class="form-item">
                        <p>${$('#child_birthday_'+num).val()}</p>
                    </div>
                </div>
                `)
            }
        }
        $('.review_driver').attr('src', $('#driver_lience').attr('src'));
        $('.review_sigPad').signaturePad({displayOnly:true}).regenerate($('#pad_data').val());
        var canvas = document.getElementById("pad");
        $('#signature_img').val(canvas.toDataURL("image/png"))
        $('#driver_lience_hidden').val($('#driver_lience').attr('src'))
        $('#number').val(num);
    })

});

function readURL(input) {
    if (input.files && input.files[0]) {
    let reader = new FileReader();
    
    reader.onload = function(e) {
        $('#driver_lience').attr('src', e.target.result);
        $('#driver_lience').css('display', 'block');
    }
    
    reader.readAsDataURL(input.files[0]);
    }
}

