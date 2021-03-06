// Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('header').outerHeight();

$(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = $(this).scrollTop();
    
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;
    
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight){
        // Scroll Down
        $('header').removeClass('nav-down').addClass('nav-up');
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('header').removeClass('nav-up').addClass('nav-down');
        }
    }
    
    lastScrollTop = st;
}

var produto1 = document.getElementById("produto1"),
    produto2 = document.getElementById("produto2"),
    produto3 = document.getElementById("produto3"),
    produto4 = document.getElementById("produto4");

function valida(){

    var nome = document.getElementById("nome");
    var email = document.getElementById("email");
    var mensagem = document.getElementById("mensagem");

    if((nome.value == "") || (email.value == "") || (mensagem.value == "")){
        alert("Preencha os campos obrigatórios (*)");
    } else {
        document.formulario.submit();
    }

}

function cr_valida() {
    var nome = document.getElementById("cr_nome");
    var email = document.getElementById("cr_email");
    var pdf = document.getElementById("cr_pdf");

    if((nome.value == "") || (email.value == "") || (pdf.value == "")){
        alert("Preencha os campos obrigatórios (*)");
        return false;
    } else {
        document.cr_form.submit();
        return true;
    }
}

function simulate_click (btn) {
    var el = document.getElementById(btn);

    // Firefox
    if (document.createEvent) {
        var event = document.createEvent("MouseEvents");
        event.initEvent("click", true, true);
        el.dispatchEvent(event);
    }
    // IE
    else if (el.click) {
        el.click();
    }
}

function viewService(arg){
    $('#service1').removeClass("fade in").addClass('fade out ocultar');
    $('#service2').removeClass("fade in").addClass('fade out ocultar');
    $('#service3').removeClass("fade in").addClass('fade out ocultar');

    $('#'+arg).removeClass('fade out ocultar').addClass("fade in");
}

function viewProduct(arg){
    $('#produto1').removeClass("fade in").addClass('fade out ocultar');
    $('#produto2').removeClass("fade in").addClass('fade out ocultar');
    $('#produto3').removeClass("fade in").addClass('fade out ocultar');
    $('#produto4').removeClass("fade in").addClass('fade out ocultar');

    $('#'+arg).removeClass('fade out ocultar').addClass("fade in");
    closeItens();
}

function closeItens() {
    var elements = document.querySelectorAll("div.item"), i;
    for (i=0; i<elements.length; i++) {
        if(hasClass(elements[i], 'over')===true) {
            $(elements[i]).removeClass('over');
        }
    }
}

function viewItem (arg) {
    if(hasClass(arg, 'over')===false) {
        $(arg).addClass('over');
    }else {
        $(arg).removeClass('over');
    }
}

function hasClass(element, cls) {
    return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
}