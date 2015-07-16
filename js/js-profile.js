$(function(){
        //var url = "http://postpayer";
        //$("#nameSurname, #residence, #mobile, #emailDiv, #mobileCode, #passwordDiv, #passwordCode, #bankAccount").hide();

        $(".showAddressForm").click(function(){
                id = $(this).prop('id');  
                $('.'+id).toggle();
        })

        $("#checkOib").click(function(){
                val= $('#personal_number').val();
                name = $("#name").val();
                surname = $("#surname").val();
                clearMessage();

                if(val == '')
                    $('#personal_number').addClass('inputError');

                if(name == '')
                    $('#name').addClass('inputError');


                if(surname == '')
                    $('#surname').addClass('inputError');

                if(surname != '' && name != '' && val != ''){
                    var request = $.ajax({
                            url: "/customer/profile/CheckOib",
                            type: "POST",
                            data: {fname : name, lname: surname, boi_jmbg: val},
                            dataType: "html"
                    });
                    request.done(function(msg) {
                            //if(msg == "success") {
                            window.location = url + '/customer/profile';
                            /* } else {
                            $("#msgS").hide();
                            $("#eMessage").fadeIn().html(msg);
                            }*/
                    });
                }
                return false;
        });

        $("#sendSMS").click(function(){
                email = $('#email').val();
                emailR = $('#emailR').val();
                clearMessage();

                if(!IsEmail(email) || !IsEmail(emailR)) {
                    $("#eMessage").fadeIn().html(errorEmail);
                    return false;
                }

                var request = $.ajax({
                        url: "/customer/profile/sendSMS",
                        type: "POST",
                        data: {email : email, emailR: emailR},
                        dataType: "html"
                });
                request.done(function(msg) {
                        window.location = url + '/customer/profile';
                        /*msg = msg.split("|");
                        if(msg[0] != 'error') {
                        $("#mobileCode").show();
                        $("#sMessage").fadeIn().html(msg[1]);
                        $('#emailH').val(msg[0]);
                        } else {
                        $("#msgS").hide();
                        $("#eMessage").fadeIn().html(msg[1]);
                        }*/
                });
                return false;
        });

        $("#sendPassword").click(function(){
                oldPasswordI =$('#oldPassword').val();
                newPasswordI = $('#newPassword').val();
                reNewPasswordI = $('#reNewPassword').val();
                clearMessage();

                var request = $.ajax({
                        url: "/customer/profile/sendPassword",
                        type: "POST",
                        data: {oldPassword : oldPasswordI, newPassword : newPasswordI, reNewPassword: reNewPasswordI},
                        dataType: "html"
                });
                request.done(function(msg) {
                        window.location = url + '/customer/profile';
                        /*msg = msg.split("|");
                        if(msg[0] != 'error') {
                        $("#passwordCode").show();
                        $("#sMessage").fadeIn().html(msg[1]);
                        $('#passwordH').val(msg[0]);
                        } else {
                        $("#msgS").hide();
                        $("#eMessage").fadeIn().html(msg[1]);
                        }*/
                });
                return false;
        });

        $("#checkCode").click(function(){
                code = $('#code').val();
                emailH = $('#emailH').val();
                clearMessage();

                var request = $.ajax({
                        url: "/customer/profile/checkCodeEmail",
                        type: "POST",
                        data: {code: code, email : emailH},
                        dataType: "html"
                });
                request.done(function(msg) {
                        window.location = url + '/customer/profile';
                        /*msg = msg.split("|");
                        if(msg[0] != 'error') {
                        window.location = url + '/customer/profile';
                        } else {
                        $("#msgS").hide();
                        $("#eMessage").fadeIn().html(msg[1]);
                        }*/
                });
                return false;
        });

        $("#checkCodePassword").click(function(){
                codePassword = $('#codePassword').val();
                passwordH = $('#passwordH').val();
                clearMessage();

                var request = $.ajax({
                        url: "/customer/profile/checkCodePassword",
                        type: "POST",
                        data: {codePassword: codePassword, passwordH : passwordH},
                        dataType: "html"
                });
                request.done(function(msg) {
                        window.location = url + '/customer/profile';   
                        /* msg = msg.split("|");
                        if(msg[0] != 'error') {
                        window.location = url + '/customer/profile';
                        } else {
                        $("#msgS").hide();
                        $("#eMessage").fadeIn().html(msg[1]);
                        }*/
                });
                return false;
        });

        $('.shipping_button').click(function(){
                primary = $(this).val();

                var request = $.ajax({
                        url: "/customer/address/shippingPrimary",
                        type: "POST",
                        data: {primary: primary},
                        dataType: "html"
                });

        });

        $('.sending_button').click(function(){
                primary1 = $(this).val();

                var request = $.ajax({
                        url: "/customer/address/sendingPrimary",
                        type: "POST",
                        data: {primary1: primary1},
                        dataType: "html"
                });

        });

        $('tr.pointer').click(function(){
                var rel = $(this).attr('rel');
                if(rel!='')
                    $('#'+rel).toggle();
        });

});

function clearMessage() {
    $("#eMessage, #sMessage, #eMessage_e").hide();
    $('input').removeClass('inputError');
}