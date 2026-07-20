function getSelectedValue() {
    var maoni = document.getElementById('assess').value;
    document.getElementById('selection').value = maoni;
    $.ajax({
        type: "post",
        url: "fetch.php",
        data: { putangina: maoni },
        success: function(html) {
            var json = JSON.parse(html);
            $('#ass').val(json["sw_assessment"]);
            $('#prob').val(json["problem_presented"]);
        }
    });
}

function back(val) {
    var clientid = val;
    var dataString = 'backid=' + clientid;
    $.ajax({
        type: 'POST',
        url: 'fetch.php',
        data: dataString,
        cache: false,
        success: function(data) {
            window.location = 'home.php';
        }
    });
}

$('#clientdata').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var userid = button.data('id')
    var modal = $(this);
    var dataString = 'id=' + userid;
    $.ajax({
        type: "GET",
        url: "showClientData.php",
        data: dataString,
        cache: false,
        success: function(data) {
            modal.find('.showClientData').html(data);
        },
        error: function(err) {
        }
    });
})

$('#benedata').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var userid = button.data('id')
    var modal = $(this);
    var dataString = 'id=' + userid;
    $.ajax({
        type: "GET",
        url: "showBene.php",
        data: dataString,
        cache: false,
        success: function(data) {
            modal.find('.showBene').html(data);
        },
        error: function(err) {
        }
    });
})

$('#add_benedata').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var userid = button.data('id')
    var modal = $(this);
    var dataString = 'id=' + userid;
    $.ajax({
        type: "GET",
        url: "addBene.php",
        data: dataString,
        cache: false,
        success: function(data) {
            modal.find('.showBene').html(data);
        },
        error: function(err) {
        }
    });
})

$('.money').mask("#,000,000.00", { reverse: true });
$(document).on('change', 'input', function() {
    if ($('#client_num').val() != "") {
        document.getElementById('theNum').value = $('#client_num').val();
    }
    if ($('#approved').val() != "") {
        document.getElementById('signature').value = $('#approved').val();
    }
});

function rangeKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 46 && charCode != 45 && charCode > 31 &&
        (charCode < 48 || charCode > 57))
        return false;

    return true;
}

if (document.getElementById('update')) {
    var checkboxes = $('input[type="checkbox"][id="group"]');
    checkboxes.removeAttr('required');
    if (!checkboxes.is(':checked')) {
        checkboxes.attr('required', 'required');
    }

}
$('input[type="checkbox"][id="group"]').on('click', function(e) {
    var n = $("input:checked").length;
    var checkboxes = $('input[type="checkbox"][id="group"]');
    if ((checkboxes.is(':checked') && n >= 1)) {
        checkboxes.removeAttr('required');
    } else {
        checkboxes.attr('required', 'required');
    }
});

function typerequire() {
    type2 = $('#type2').val();
    if (type2 != "") {
        $("#a2").attr('required', '');
        $("#pur2").attr('required', '');
        $("#m2").attr('required', '');
        $("#f2").attr('required', '');
    } else {
        $("#a2").removeAttr('required');
        $("#pur2").removeAttr('required');
        $("#m2").removeAttr('required');
        $("#f2").removeAttr('required');
    }
}

function verifyfirst() {
    t1 = '<?php echo $client_assisstance[1][' + type +'] ?>';
    p1 = '<?php echo $client_assisstance[1][' +
    purpose +'] ?>';
    a1 = '<?php echo $client_assisstance[1][' +
    amount +'] ?>';
    m1 = '<?php echo $client_assisstance[1][' +
    mode +'] ?>';
    f1 = '<?php echo $fundsourcedata[' +
    fundsource1 +'] ?>';
    $fund2 = '';
    $fund3 = '';
    $fund4 = '';
    $fund5 = '';
    if (!empty($fundsourcedata['fundsource2'])) {
        fund2 = '<?php echo $fundsourcedata[' +
        fundsource2 +'] ?>';
    }
    if (!empty($fundsourcedata['fundsource3'])) {
        fund3 = '<?php echo $fundsourcedata[' +
        fundsource3 +'] ?>';
    }
    if (!empty($fundsourcedata['fundsource4'])) {
        fund4 = '<?php echo $fundsourcedata[' +
        fundsource4 +'] ?>';
    }
    if (!empty($fundsourcedata['fundsource5'])) {
        fund5 = '<?php echo $fundsourcedata[' +
        fundsource5 +'] ?>';
    }
    t2 = $('#type1').val();
    p2 = $('#pur1').val();
    a2 = $('#a1').val();
    m2 = $('#m1').val();
    f2 = $('#f1').val();
    if (t1 != t2) {
        $('#toCOE').attr('disabled', 'disabled');
        $('#print').attr('disabled', 'disabled');
        $('#print').removeClass('btn-primary').addClass('btn-dark ');
        $(this).addClass('btn-success').removeClass('btn-primary ');
        $('#toCOE').removeClass('btn-success').addClass('btn-dark ');
        $(this).addClass('btn-success').removeClass('btn-success ');
    }
    if (p1 != p2) {
        $('#toCOE').attr('disabled', 'disabled');
        $('#print').attr('disabled', 'disabled');
        $('#print').removeClass('btn-primary').addClass('btn-dark ');
        $(this).addClass('btn-success').removeClass('btn-primary ');
        $('#toCOE').removeClass('btn-success').addClass('btn-dark ');
        $(this).addClass('btn-success').removeClass('btn-success ');
    }
    if (a1 != a2) {
        $('#toCOE').attr('disabled', 'disabled');
        $('#print').attr('disabled', 'disabled');
        $('#print').removeClass('btn-primary').addClass('btn-dark ');
        $(this).addClass('btn-success').removeClass('btn-primary ');
        $('#toCOE').removeClass('btn-success').addClass('btn-dark ');
        $(this).addClass('btn-success').removeClass('btn-success ');
    }
    if (m1 != m2) {
        $('#toCOE').attr('disabled', 'disabled');
        $('#print').attr('disabled', 'disabled');
        $('#print').removeClass('btn-primary').addClass('btn-dark ');
        $(this).addClass('btn-success').removeClass('btn-primary ');
        $('#toCOE').removeClass('btn-success').addClass('btn-dark ');
        $(this).addClass('btn-success').removeClass('btn-success ');
    }
    if (f1 != f2) {
        $('#toCOE').attr('disabled', 'disabled');
        $('#print').attr('disabled', 'disabled');
        $('#print').removeClass('btn-primary').addClass('btn-dark ');
        $(this).addClass('btn-success').removeClass('btn-primary ');
        $('#toCOE').removeClass('btn-success').addClass('btn-dark ');
        $(this).addClass('btn-success').removeClass('btn-success ');
    }
}

function verifysecond() {
    t1 = '<?php echo $client_assisstance[2]['+
    type +'] ?>';
    p1 = '<?php echo $client_assisstance[2]['+
    purpose +'] ?>';
    a1 = '<?php echo $client_assisstance[2]['+
    amount +'] ?>';
    m1 = '<?php echo $client_assisstance[2]['+
    mode +'] ?>';
    f1 = '<?php echo $client_assisstance[2]['+
    fund +'] ?>';
    t2 = $('#type2').val();
    p2 = $('#pur2').val();
    a2 = $('#a2').val();
    m2 = $('#m2').val();
    f2 = $('#f2').val();

    if (t1 != t2) {
        $('#toCOE').attr('disabled', 'disabled');
        $('#print').attr('disabled', 'disabled');
        $('#print').removeClass('btn-primary').addClass('btn-dark ');
        $(this).addClass('btn-success').removeClass('btn-primary ');
        $('#toCOE').removeClass('btn-success').addClass('btn-dark ');
        $(this).addClass('btn-success').removeClass('btn-success ');
    }
    if (p1 != p2) {
        $('#toCOE').attr('disabled', 'disabled');
        $('#print').attr('disabled', 'disabled');
        $('#print').removeClass('btn-primary').addClass('btn-dark ');
        $(this).addClass('btn-success').removeClass('btn-primary ');
        $('#toCOE').removeClass('btn-success').addClass('btn-dark ');
        $(this).addClass('btn-success').removeClass('btn-success ');
    }
    if (a1 != a2) {
        $('#toCOE').attr('disabled', 'disabled');
        $('#print').attr('disabled', 'disabled');
        $('#print').removeClass('btn-primary').addClass('btn-dark ');
        $(this).addClass('btn-success').removeClass('btn-primary ');
        $('#toCOE').removeClass('btn-success').addClass('btn-dark ');
        $(this).addClass('btn-success').removeClass('btn-success ');
    }
    if (m1 != m2) {
        $('#toCOE').attr('disabled', 'disabled');
        $('#print').attr('disabled', 'disabled');
        $('#print').removeClass('btn-primary').addClass('btn-dark ');
        $(this).addClass('btn-success').removeClass('btn-primary ');
        $('#toCOE').removeClass('btn-success').addClass('btn-dark ');
        $(this).addClass('btn-success').removeClass('btn-success ');
    }
    if (f1 != f2) {
        $('#toCOE').attr('disabled', 'disabled');
        $('#print').attr('disabled', 'disabled');
        $('#print').removeClass('btn-primary').addClass('btn-dark ');
        $(this).addClass('btn-success').removeClass('btn-primary ');
        $('#toCOE').removeClass('btn-success').addClass('btn-dark ');
        $(this).addClass('btn-success').removeClass('btn-success ');
    }
}