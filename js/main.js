(function($) {
    "use strict";


    /*==================================================================
    [ Focus Contact2 ]*/
    $('.input100').each(function() {
        $(this).on('blur', function() {
            if ($(this).val().trim() != "") {
                $(this).addClass('has-val');
            } else {
                $(this).removeClass('has-val');
            }
        })
    })


    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit', function() {
        var check = true;

        for (var i = 0; i < input.length; i++) {
            if (validate(input[i]) == false) {
                showValidate(input[i]);
                check = false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function() {
        $(this).focus(function() {
            hideValidate(this);
        });
    });

    function validate(input) {
        if ($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if ($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        } else {
            if ($(input).val().trim() == '') {
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }


})(jQuery);

//GIS PART HERE
function printGIS() {
    var arr = getGISvalue();
    //console.log(arr);
    setContentGIS(arr);
    //var divElements = document.getElementById('gis_sheet').innerHTML;
    //Get the HTML of whole page
    /*var restorepage = $('body').html();
    var printcontent = $('#' + el).clone();
    $('body').empty().html(printcontent);
    window.print();
    $('body').html(restorepage);*/
    var restorepage = $('body').html();
    var printcontent = $('#gis_sheet').clone();
    $('body').empty().html(printcontent);
    window.print();
    $('body').html(restorepage);
    //var oldPage = document.body.innerHTML;
    //Reset the page's HTML with div's HTML only
    /*document.body.innerHTML = 
    "<html><head><title></title></head><body>" + 
    divElements + "</body>";*/
    //Print Page
    //window.print();
    //Restore orignal HTML
    //document.body.innerHTML = oldPage;
    setInputGIS(arr);
    uncheck();
}

function toCoe(val) {
    var clientid = val;
    window.location = 'coe.php?id=' + clientid + '';
}
//Mo hold sa mga value sa input
function getGISvalue() {
    //Pamilya 3kbouk
    var pangan1 = $('#p1').val();
    var pangan2 = $('#p2').val();
    var pangan3 = $('#p3').val();
    var edad1 = $('#e1').val();
    var edad2 = $('#e2').val();
    var edad3 = $('#e3').val();
    var trabaho1 = $('#t1').val();
    var trabaho2 = $('#t2').val();
    var trabaho3 = $('#t3').val();
    var sahod1 = $('#b1').val();
    var sahod2 = $('#b2').val();
    var sahod3 = $('#b3').val();
    //Assistance
    var c_num = $('#client_num').val();
    var mode_ad = $('#mode_ad').val(); //admission
    var approved = $('#approved').val();
    var ref_name = $('#ref_name').val();
    var service = checkbox(); // Type of services checked
    //console.log(approved);
    /*if(service.length == 1){ //para mawala ang fucking error, wa pod ko kbalo nganu pag print na error
        service[1] = '';
    }*/

    var type1 = $('#type1').val();
    var type2 = $('#type2').val();
    var purpose1 = $('#pur1').val();
    var purpose2 = $('#pur2').val();
    var amount1 = $('#a1').val();
    var amount2 = $('#a2').val();
    var moa1 = $('#m1').val();
    var moa2 = $('#m2').val();
    var fundSource1 = $('#f1').val();
    var fundSource2 = $('#f2').val();
    //
    var problem = $('#prob').val();
    var soc_ass = $('#ass').val();

    var arr = {
        "pangan1": pangan1,
        "pangan2": pangan2,
        "pangan3": pangan3,
        "edad1": edad1,
        "edad2": edad2,
        "edad3": edad3,
        "trabaho1": trabaho1,
        "trabaho2": trabaho2,
        "trabaho3": trabaho3,
        "sahod1": sahod1,
        "sahod2": sahod2,
        "sahod3": sahod3,
        "type1": type1,
        "type2": type2,
        "purpose1": purpose1,
        "purpose2": purpose2,
        "amount1": amount1,
        "amount2": amount2,
        "moa1": moa1,
        "moa2": moa2,
        "fundSource1": fundSource1,
        "fundSource2": fundSource2,
        "problem": problem,
        "soc_ass": soc_ass,
        "service": service,
        "c_num": c_num,
        "approved": approved,
        "mode_ad": mode_ad,
        "ref_name": ref_name
    };
    //$('#group:checked').attr('checked', false); //unchecked the checked checkbox
    return arr;
}

function setInputGIS(arr) { //sa input ni nga part
    document.getElementById('p1').value = arr["pangan1"];
    document.getElementById('p2').value = arr["pangan2"];
    document.getElementById('p3').value = arr["pangan3"];
    document.getElementById('e1').value = arr["edad1"];
    document.getElementById('e2').value = arr["edad2"];
    document.getElementById('e3').value = arr["edad3"];
    document.getElementById('t1').value = arr["trabaho1"];
    document.getElementById('t2').value = arr["trabaho2"];
    document.getElementById('t3').value = arr["trabaho3"];
    document.getElementById('b1').value = arr["sahod1"];
    document.getElementById('b2').value = arr["sahod2"];
    document.getElementById('b3').value = arr["sahod3"];
    document.getElementById('type1').value = arr["type1"];
    document.getElementById('type2').value = arr["type2"];
    document.getElementById('pur1').value = arr["purpose1"];
    document.getElementById('pur2').value = arr["purpose2"];
    document.getElementById('a1').value = arr["amount1"];
    document.getElementById('a2').value = arr["amount2"];
    document.getElementById('m1').value = arr["moa1"];
    document.getElementById('m2').value = arr["moa2"];
    document.getElementById('f1').value = arr["fundSource1"];
    document.getElementById('f2').value = arr["fundSource2"];
    document.getElementById('prob').value = arr["problem"];
    document.getElementById('ass').value = arr["soc_ass"];
    document.getElementById('client_num').value = arr["c_num"];
    document.getElementById('mode_ad').value = arr["mode_ad"];
    document.getElementById('approved').value = arr["approved"];
    service = arr["service"];
    if ($.inArray('Referral', service) != -1) {
        document.getElementsByName("ref")[0].checked = true; //setting up the value to checked
        document.getElementById("ref_name").value = arr['ref_name'];
    }
    if ($.inArray('Legal Assisstance', service) != -1) {
        document.getElementsByName("leg")[0].checked = true;
    }
    if ($.inArray('Psychosocial', service) != -1) {
        document.getElementsByName("psy")[0].checked = true;
    }
    if ($.inArray('Financial Assistance', service) != -1) {
        document.getElementsByName("fin")[0].checked = true;
    }
}

function setContentGIS(arr) {

    //komposisiyon sa pamilya
    document.getElementById('pangan1').innerHTML = arr['pangan1'];
    document.getElementById('pangan2').innerHTML = arr['pangan2'];
    document.getElementById('pangan3').innerHTML = arr['pangan3'];
    document.getElementById('edad1').innerHTML = arr['edad1'];
    document.getElementById('edad2').innerHTML = arr['edad2'];
    document.getElementById('edad3').innerHTML = arr['edad3'];
    document.getElementById('trabaho1').innerHTML = arr['trabaho1'];
    document.getElementById('trabaho2').innerHTML = arr['trabaho2'];
    document.getElementById('trabaho3').innerHTML = arr['trabaho3'];
    document.getElementById('sahod1').innerHTML = arr['sahod1'];
    document.getElementById('sahod2').innerHTML = arr['sahod2'];
    document.getElementById('sahod3').innerHTML = arr['sahod3'];
    //Assessment
    document.getElementById('problem').innerHTML = arr['problem'];
    document.getElementById('soc_ass').innerHTML = arr['soc_ass'];
    document.getElementById('theNum').innerHTML = arr["c_num"];
    str = arr["approved"].split('-');
    document.getElementById('signature').innerHTML = str[0];
    document.getElementById('s_position').innerHTML = str[1];
    service = arr["service"];
    //document.getElementById('theNum').value = arr["c_num"];
    //console.log(arr["c_num"]);
    //console.log(document.getElementById('theNum').value);
    //console.log(document.getElementById('signature').value);
    //Checkbox
    //$("#referral").attr("checked", true);
    if ($.inArray('Referral', service) > -1) {
        $("#referral").attr("checked", true); //setting up the value to checked
        document.getElementById("i_ref_name").innerHTML = arr["ref_name"];
    }
    if ($.inArray('Legal Assisstance', service) > -1) {
        $("#legal").attr("checked", true);
    }
    if ($.inArray('Psychosocial', service) > -1) {
        $("#psychosocial").attr("checked", true);
    }
    if ($.inArray('Financial Assistance', service) > -1) {
        $("#financial").attr("checked", true);
    }

    if ((arr['type1'].toLowerCase()).includes('medical')) {
        document.getElementById('medic-p').innerHTML = arr['purpose1'];
        document.getElementById('medic-a').innerHTML = arr['amount1'];
        document.getElementById('medic-m').innerHTML = arr['moa1'];
        document.getElementById('medic-f').innerHTML = arr['fundSource1'];
    } else if ((arr['type1'].toLowerCase()).includes('burial')) {
        document.getElementById('burial-p').innerHTML = arr['purpose1'];
        document.getElementById('burial-a').innerHTML = arr['amount1'];
        document.getElementById('burial-m').innerHTML = arr['moa1'];
        document.getElementById('burial-f').innerHTML = arr['fundSource1'];
    } else if ((arr['type1'].toLowerCase()).includes('trans')) {
        document.getElementById('trans-p').innerHTML = arr['purpose1'];
        document.getElementById('trans-a').innerHTML = arr['amount1'];
        document.getElementById('trans-m').innerHTML = arr['moa1'];
        document.getElementById('trans-f').innerHTML = arr['fundSource1'];
    } else if ((arr['type1'].toLowerCase()).includes('education')) {
        document.getElementById('educ-p').innerHTML = arr['purpose1'];
        document.getElementById('educ-a').innerHTML = arr['amount1'];
        document.getElementById('educ-m').innerHTML = arr['moa1'];
        document.getElementById('educ-f').innerHTML = arr['fundSource1'];
    } else if ((arr['type1'].toLowerCase()).includes('non')) {
        document.getElementById('non-p').innerHTML = arr['purpose1'];
        document.getElementById('non-a').innerHTML = arr['amount1'];
        document.getElementById('non-m').innerHTML = arr['moa1'];
        document.getElementById('non-f').innerHTML = arr['fundSource1'];
    } else if ((arr['type1'].toLowerCase()).includes('food')) {
        document.getElementById('food-p').innerHTML = arr['purpose1'];
        document.getElementById('food-a').innerHTML = arr['amount1'];
        document.getElementById('food-m').innerHTML = arr['moa1'];
        document.getElementById('food-f').innerHTML = arr['fundSource1'];
    } else if ((arr['type1'].toLowerCase()).includes('cash')) {
        document.getElementById('cash-p').innerHTML = arr['purpose1'];
        document.getElementById('cash-a').innerHTML = arr['amount1'];
        document.getElementById('cash-m').innerHTML = arr['moa1'];
        document.getElementById('cash-f').innerHTML = arr['fundSource1'];
    }
    if (arr['type2'] != "") {
        if ((arr['type2'].toLowerCase()).includes('medical')) {
            document.getElementById('medic-p').innerHTML = arr['purpose2'];
            document.getElementById('medic-a').innerHTML = arr['amount2'];
            document.getElementById('medic-m').innerHTML = arr['moa2'];
            document.getElementById('medic-f').innerHTML = arr['fundSource2'];
        } else if ((arr['type2'].toLowerCase()).includes('burial')) {
            document.getElementById('burial-p').innerHTML = arr['purpose2'];
            document.getElementById('burial-a').innerHTML = arr['amount2'];
            document.getElementById('burial-m').innerHTML = arr['moa2'];
            document.getElementById('burial-f').innerHTML = arr['fundSource2'];
        } else if ((arr['type2'].toLowerCase()).includes('trans')) {
            document.getElementById('trans-p').innerHTML = arr['purpose2'];
            document.getElementById('trans-a').innerHTML = arr['amount2'];
            document.getElementById('trans-m').innerHTML = arr['moa2'];
            document.getElementById('trans-f').innerHTML = arr['fundSource2'];
        } else if ((arr['type2'].toLowerCase()).includes('education')) {
            document.getElementById('educ-p').innerHTML = arr['purpose2'];
            document.getElementById('educ-a').innerHTML = arr['amount2'];
            document.getElementById('educ-m').innerHTML = arr['moa2'];
            document.getElementById('educ-f').innerHTML = arr['fundSource2'];
        } else if ((arr['type2'].toLowerCase()).includes('non')) {
            document.getElementById('non-p').innerHTML = arr['purpose2'];
            document.getElementById('non-a').innerHTML = arr['amount2'];
            document.getElementById('non-m').innerHTML = arr['moa2'];
            document.getElementById('non-f').innerHTML = arr['fundSource'];
        } else if ((arr['type2'].toLowerCase()).includes('food')) {
            document.getElementById('food-p').innerHTML = arr['purpose2'];
            document.getElementById('food-a').innerHTML = arr['amount2'];
            document.getElementById('food-m').innerHTML = arr['moa2'];
            document.getElementById('food-f').innerHTML = arr['fundSource2'];
        } else if ((arr['type2'].toLowerCase()).includes('cash')) {
            document.getElementById('cash-p').innerHTML = arr['purpose2'];
            document.getElementById('cash-a').innerHTML = arr['amount2'];
            document.getElementById('cash-m').innerHTML = arr['moa2'];
            document.getElementById('cash-f').innerHTML = arr['fundSource2'];
        }
    }
}


//LAST PART IS HERE
function printGLNow() {
    var arr = getGLvalue(); //hold ang mga value sa input text
    //console.log(arr);
    setContentGL(arr);
    //If isa lng xa, kani nga div iyang e print
    var divElements = document.getElementById('gl').innerHTML;
    //set una para pag set sa div na e print naa nay value
    //pag naa xay beneficiary ~ kani e prin
    //Get the HTML of whole page
    var oldPage = document.body.innerHTML;
    //Reset the page's HTML with div's HTML only
    document.body.innerHTML =
        "<html><head><title></title></head><body>" +
        divElements + "</body>";
    //Print Page
    window.print();
    //Restore orignal HTML
    document.body.innerHTML = oldPage;
    setInputGL(arr);
}

//LAST PART IS HERE
function printCAVNow() {
    var arr = getCAVvalue(); //hold ang mga value sa input text
    //console.log(arr);
    setContentCAV(arr);
    //If isa lng xa, kani nga div iyang e print
    var divElements = document.getElementById('cav').innerHTML;
    //set una para pag set sa div na e print naa nay value
    //pag naa xay beneficiary ~ kani e prin
    //Get the HTML of whole page
    var oldPage = document.body.innerHTML;
    //Reset the page's HTML with div's HTML only
    document.body.innerHTML =
        "<html><head><title></title></head><body>" +
        divElements + "</body>";
    //Print Page
    window.print();
    //Restore orignal HTML
    document.body.innerHTML = oldPage;
    setInputCAV(arr);
}

function getGLvalue() {
    if (document.getElementById("c_no")) { var c_no = document.getElementById('c_no').value; }

    if (document.getElementById("addressee")) { var addressee = document.getElementById('addressee').value; }
    if (document.getElementById("a_pos")) { var pos = document.getElementById('a_pos').value; }
    // if (document.getElementById("tomention")) { var to_mention = document.getElementById('tomention').value; }
    if (document.getElementById("comp_name")) { var c_name = document.getElementById('comp_name').value; }
    if (document.getElementById("address")) { var c_add = document.getElementById('address').value; }
    if (document.getElementById("gl_signatory")) { var signatory = document.getElementById('gl_signatory').value; }


    var arr = {
        "c_no": c_no,
        "addressee": addressee,
        "pos": pos,
        // "to_mention": to_mention,
        "c_name": c_name,
        "c_add": c_add,
        "signatory": signatory
    };
    return arr;
}

function getCAVvalue() {
    if (document.getElementById("payee")) { var payee = document.getElementById('payee').value; }
    if (document.getElementById("cash_address")) { var cash_add = document.getElementById('cash_address').value; }

    var array = {
        "cash_add": cash_add,
        "payee": payee
    };
    return array;
}

function setContentGL(arr) {
    //GL
    if (document.getElementById("number")) { document.getElementById('number').innerHTML = arr["c_no"]; }
    if (document.getElementById("c_add")) { document.getElementById('c_add').innerHTML = arr["c_add"]; }
    if (document.getElementById("c_name")) { document.getElementById('c_name').innerHTML = arr["c_name"]; }
    // if (document.getElementById("tomention")) { document.getElementById('tomention').innerHTML = arr["to_mention"]; }
    if (arr['signatory'] != undefined) { str = arr["signatory"].split('-'); }

    if (document.getElementById("signatory")) { document.getElementById('signatory').innerHTML = str[0]; }
    if (document.getElementById("s_position")) { document.getElementById('s_position').innerHTML = str[1]; }
    if (document.getElementById("signatory2")) { document.getElementById('signatory2').innerHTML = str[0]; }
    if (document.getElementById("s_position2")) { document.getElementById('s_position2').innerHTML = str[1]; }
    if (document.getElementById("gl_ini")) { document.getElementById('gl_ini').innerHTML = str[2]; } //initial sa GL_signa
    if (document.getElementById("gl_ini2")) { document.getElementById('gl_ini2').innerHTML = str[2]; } //initial sa GL2_signa


    //SHEET num2
    if (document.getElementById("number2")) { document.getElementById('number2').innerHTML = arr["c_no"]; }
    if (document.getElementById("c_add2")) { document.getElementById('c_add2').innerHTML = arr["c_add"]; }
    if (document.getElementById("c_name2")) { document.getElementById('c_name2').innerHTML = arr["c_name"]; }

    //GL -if walay addresse ang position ma bold
    if (arr["addressee"] == "") {
        if (document.getElementById("receiver")) { document.getElementById('receiver').innerHTML = arr["pos"]; }
        if (document.getElementById("position")) { document.getElementById('position').innerHTML = arr["addressee"]; }
        if (document.getElementById("receiver2")) { document.getElementById('receiver2').innerHTML = arr["pos"]; }
        if (document.getElementById("position2")) { document.getElementById('position2').innerHTML = arr["addressee"]; }
    } else {
        if (document.getElementById("position")) { document.getElementById('position').innerHTML = arr["pos"]; }
        if (document.getElementById("receiver")) { document.getElementById('receiver').innerHTML = arr["addressee"]; }
        if (document.getElementById("position2")) { document.getElementById('position2').innerHTML = arr["pos"]; }
        if (document.getElementById("receiver2")) { document.getElementById('receiver2').innerHTML = arr["addressee"]; }
    }

}

function setContentCAV(array) {
    //CASH

    if (document.getElementById("i_payee")) { document.getElementById('i_payee').innerHTML = arr["payee"]; }
    if (document.getElementById("cash_add")) { document.getElementById('cash_add').innerHTML = arr["cash_add"]; }
    if (document.getElementById("i_officer")) { document.getElementById('i_officer').innerHTML = arr["officer"]; }
}


function setInputGL(arr) {
    if (document.getElementById("c_no")) { document.getElementById('c_no').value = arr["c_no"]; }
    if (document.getElementById("addressee")) { document.getElementById('addressee').value = arr["addressee"]; }
    if (document.getElementById("a_pos")) { document.getElementById('a_pos').value = arr["pos"]; }
    // if (document.getElementById("tomention")) { document.getElementById('tomention').value = arr["to_mention"]; }
    if (document.getElementById("comp_name")) { document.getElementById('comp_name').value = arr["c_name"]; }
    if (document.getElementById("address")) { document.getElementById('address').value = arr["c_add"]; }
    if (document.getElementById("gl_signatory")) { document.getElementById('gl_signatory').value = arr['signatory']; }
}

function setInputCAV(array) {
    //CASH
    if (document.getElementById("payee")) { document.getElementById('payee').value = arr["payee"]; }
    if (document.getElementById("officer")) { document.getElementById('officer').value = arr["officer"]; }
    if (document.getElementById("cash_address")) { document.getElementById('cash_address').value = arr["cash_add"]; }
}

//e uncheck ang mga checkboxes sa print area/kay pag cancel checked jpon sya
function uncheck() {
    $("#referral").attr("checked", false);
    $("#legal").attr("checked", false);
    $("#psychosocial").attr("checked", false);
    $("#financial").attr("checked", false);
}

function checkbox() {
    var val = $('input[type="checkbox"]:checked').map(function() {
        return $(this).val();
    }).get();
    return val;
}

function date_time(id) {
    date = new Date;
    year = date.getFullYear();
    month = date.getMonth();
    months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    d = date.getDate();
    day = date.getDay();
    days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
    h = date.getHours();
    if (h < 10) {
        h = "0" + h;
    }
    m = date.getMinutes();
    if (m < 10) {
        m = "0" + m;
    }
    s = date.getSeconds();
    if (s < 10) {
        s = "0" + s;
    }
    result = '' + days[day] + ' ' + months[month] + ' ' + d + ', ' + year + ' ' + h + ':' + m + ':' + s;
    document.getElementById(id).innerHTML = result;
    setTimeout('date_time("' + id + '");', '1000');
    return true;
}
history.pushState(null, null, location.href);
window.onpopstate = function() {
    history.go(1);
};