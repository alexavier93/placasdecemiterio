(function ($) {
    "use strict";


    /* ===================================
        Side Menu
    ====================================== */
    if ($("#sidemenu_toggle").length) {

        $("#sidemenu_toggle").on("click", function () {
            $(".pushwrap").toggleClass("active");
            $(".side-menu").addClass("side-menu-active"), $("#close_side_menu").fadeIn(700)
        }), $("#close_side_menu").on("click", function () {
            $(".side-menu").removeClass("side-menu-active"), $(this).fadeOut(200), $(".pushwrap").removeClass("active")
        }), $(".side-nav .navbar-nav").on("click", function () {
            $(".side-menu").removeClass("side-menu-active"), $("#close_side_menu").fadeOut(200), $(".pushwrap").removeClass("active")
        }), $("#btn_sideNavClose").on("click", function () {
            $(".side-menu").removeClass("side-menu-active"), $("#close_side_menu").fadeOut(200), $(".pushwrap").removeClass("active")
        });
    }

    // Navbar Scroll Function
    var $window = $(window);
    $window.scroll(function () {
        var $scroll = $window.scrollTop();
        var $navbar = $(".header-nav");
        if (!$navbar.hasClass("sticky-bottom")) {
            if ($scroll > 150) {
                $navbar.addClass("fixed-menu");
            } else {
                $navbar.removeClass("fixed-menu");
            }
        }
    });

    // BANNER 
    $('.banner-carousel').owlCarousel({
		animateOut: 'fadeOut',
	    animateIn: 'fadeIn',
		loop:true,
		margin:0,
		nav:true,
		dots: false,
		smartSpeed: 500,
		autoHeight: true,
		autoplay: true,
		autoplayTimeout:5000,
		navText: [ '<span class="fa fa-angle-left">', '<span class="fa fa-angle-right">' ],
		responsive:{
			0:{
				items:1,
                nav: false,
		        dots: true,
			},
			600:{
				items:1
			},
			1024:{
				items:1
			},
		}
    });


    // VALIDAÇÃO
    var form = $("#placaSteps");

    var formValidator = form.validate({
        errorElement: 'div',
        errorPlacement: function (error, element) {
            error.appendTo(element.parent().after());
        },
        rules: {
            size: { required: true },
            model: { required: true },
            design: { required: true },
            fonte: { required: true },
            name: { required: true },
            birthdate: { required: true },
            deathdate: { required: true },
            image: { required: true },
        },
        messages: {
            size: { required: "Por favor, selecione um tamanho." },
            background: { required: "Por favor, selecione um fundo." },
            model: { required: "Por favor, selecione um modelo." },
            design: { required: "Por favor, selecione uma moldura." },
            fonte: { required: "Por favor, selecione uma fonte." },
            name: { required: "Por favor, digite um nome e sobrenome." },
            birthdate: { required: "Por favor, digite a data de nascimento." },
            deathdate: { required: "Por favor, digite a data de falecimento." },
            image: { required: "Por favor, selecione uma imagem." },

        }
    });

    var formCostumer = $("#formCostumer");

    formCostumer.validate({
        errorElement: 'div',
        errorPlacement: function (error, element) {
            error.appendTo(element.parent().after());
        },
        rules: {
            email: {
                required: true,
                email: true
            },
            firstname: { required: true },
            lastname: { required: true },
            cpf: { required: true },
            birthdate: { required: true },
            phone: { required: true },
        },
        messages: {
            email: {
                required: "E-mail é obrigatório.",
                email: "Seu e-mail precisa ser válido Ex: nome@dominio.com"
            },
            firstname: { required: "Este campo é obrigatório." },
            lastname: { required: "Este campo é obrigatório." },
            cpf: { required: "Este campo é obrigatório." },
            phone: { required: "Este campo é obrigatório." },
            birthdate: { required: "Este campo é obrigatório." },
        }
        
    });

    var formAddress = $("#formAddress");

    formAddress.validate({
        errorElement: 'div',
        errorPlacement: function (error, element) {
            error.appendTo(element.parent().after());
        },
        rules: {
            cep: { required: true },
            logradouro: { required: true },
            numero: { required: true },
            bairro: { required: true },
            cidade: { required: true },
            uf: { required: true },
        },
        messages: {
            cep: { required: "Este campo é obrigatório." },
            logradouro: { required: "Este campo é obrigatório." },
            numero: { required: "Campo obrigatório." },
            bairro: { required: "Este campo é obrigatório." },
            cidade: { required: "Este campo é obrigatório." },
            uf: { required: "Campo brigatório." },
        }
        
    });

    $('.placaSteps').steps({

        onChange: function (currentIndex, newIndex, stepDirection) {

            if (currentIndex === 0) {

                if (stepDirection === 'forward') {
                    return form.valid();
                }

                if (stepDirection === 'backward') {
                    formValidator.resetForm();
                }

            }

            if (currentIndex === 1) {

                if (stepDirection === 'forward') {
                    return form.valid();
                }

                if (stepDirection === 'backward') {
                    formValidator.resetForm();
                }

            }

            if (currentIndex === 2) {

                if (stepDirection === 'forward') {
                    return form.valid();
                }

                if (stepDirection === 'backward') {
                    formValidator.resetForm();
                }

            }

            if (currentIndex === 3) {

                if (stepDirection === 'forward') {
                    return form.valid();
                }

                if (stepDirection === 'backward') {
                    formValidator.resetForm();
                }

            }

            return true;
        },

        onFinish: function (currentIndex) {
            form.submit();
        }

    });

    $('.cep').mask('00000-000');
    $('.cpf').mask('000.000.000-00', { reverse: true });
    $('.data').mask('00/00/0000');
    $('.validade').mask('00/0000');
    $('.creditcard').mask('0000 0000 0000 0000');

    $('.telefone').focusout(function () {
        var phone, element;
        element = $(this);
        element.unmask();
        phone = element.val().replace(/\D/g, '');
        if (phone.length > 10) {
            element.mask("(99) 99999-9999");
        } else {
            element.mask("(99) 9999-99999");
        }
    }).trigger('focusout');

    $(".youtube").fancybox({
        openEffect: 'none',
        closeEffect: 'none',
        helpers: {
            media: {}
        }
    });




})(jQuery, window, document);