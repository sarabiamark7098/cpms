function printGISinCE() {

    //unsa na div iyang e print
    var divElements = document.getElementById('gisce').innerHTML;;
    //nag gunit sa whole page 
    var oldPage = document.body.innerHTML;

    //gi set ang div as a whole page
    document.body.innerHTML =
        "<html><head><title></title></head><body>" +
        divElements + "</body>";
    //Print Page
    window.print();
    //gi balik ang old page
    document.body.innerHTML = oldPage;

    //setInputCOE(arr); //gi pang butang sa input ang mga input sa user
}

function printInformationSheet() {
    //unsa na div iyang e print
    var divElements = document.getElementById('isheet').innerHTML;;
    //nag gunit sa whole page 
    var oldPage = document.body.innerHTML;

    //gi set ang div as a whole page
    document.body.innerHTML =
        "<html><head><title></title></head><body>" +
        divElements + "</body>";
    //Print Page
    window.print();
    //gi balik ang old page
    document.body.innerHTML = oldPage;

    //setInputCOE(arr); //gi pang butang sa input ang mga input sa user
}

function printCOE() {

    //unsa na div iyang e print
    var divElements = document.getElementById('coe').innerHTML;;
    //nag gunit sa whole page 
    var oldPage = document.body.innerHTML;

    //gi set ang div as a whole page
    document.body.innerHTML =
        "<html><head><title></title></head><body>" +
        divElements + "</body>";
    //Print Page
    window.print();
    //gi balik ang old page
    document.body.innerHTML = oldPage;

    //setInputCOE(arr); //gi pang butang sa input ang mga input sa user
}