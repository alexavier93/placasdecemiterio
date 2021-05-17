// MERCADO PAGO
var valorTotal = $('#valorTotal').val();

const mp = new MercadoPago('TEST-5abd76b4-bdd0-482e-86f8-5db725e298fc', {
    locale: 'pt-BR'
})

const cardForm = mp.cardForm({
    amount: valorTotal,
    autoMount: true,
    processingMode: 'aggregator',
    form: {
        id: 'form-checkout',
        cardholderName: {
            id: 'form-checkout__cardholderName',
            placeholder: 'Titular do cartão',
        },
        cardNumber: {
            id: 'form-checkout__cardNumber',
            placeholder: 'Número do cartão',
        },
        cardExpirationMonth: {
            id: 'form-checkout__cardExpirationMonth',
            placeholder: 'MM'
        },
        cardExpirationYear: {
            id: 'form-checkout__cardExpirationYear',
            placeholder: 'AA'
        },
        securityCode: {
            id: 'form-checkout__securityCode',
            placeholder: 'CVV',
        },
        installments: {
            id: 'form-checkout__installments',
            placeholder: 'Parcelas'
        },
        identificationType: {
            id: 'form-checkout__identificationType'
        },
        identificationNumber: {
            id: 'form-checkout__identificationNumber',
            placeholder: 'Número do Documento'
        },
        issuer: {
            id: 'form-checkout__issuer',
            placeholder: 'Bandeira'
        }
    },
    callbacks: {
        onFormMounted: error => {
            if (error) return console.warn('Form Mounted handling error: ', error)
            console.log('Form mounted')
        },
        onFormUnmounted: error => {
            if (error) return console.warn('Form Unmounted handling error: ', error)
            console.log('Form unmounted')
        },
        onIdentificationTypesReceived: (error, identificationTypes) => {
            if (error) return console.warn('identificationTypes handling error: ', error)
            console.log('Identification types available: ', identificationTypes)
        },
        onPaymentMethodsReceived: (error, paymentMethods) => {

            if(error){
                $('.alert-warning').html('Esse cartão não é válido!');
                $('.alert-warning').fadeIn(500);
            }else{
                var arrayPayment = paymentMethods;
                arrayPayment.forEach((paymentMethods) => { 
                    $('.issuer_card img').attr('src', paymentMethods.thumbnail);
                });
            }

        },
        onIssuersReceived: (error, issuers) => {
            if (error) return console.warn('issuers handling error: ', error)
            console.log('Issuers available: ', issuers)
        },
        onInstallmentsReceived: (error, installments) => {
            if (error) return console.warn('installments handling error: ', error)
            console.log('Installments available: ', installments)
        },
        onCardTokenReceived: (error, token) => {

            if(error){

                var arrayError = error;

                arrayError.forEach(error => { 

                    var errors = error.code;

                    msg = getErrors(errors)
    
                    $('.alert-warning').html(msg);
                    $('.alert-warning').fadeIn(500);
                });
            }

        },
        onSubmit: (event) => {
            event.preventDefault();
            const cardData = cardForm.getCardFormData();
            let form = document.getElementById('form-checkout');
            if(cardData.token){
                form.submit();
            }
        }
    }
});



// Step #getIdentificationTypes

// Helper function to append option elements to a select input
function createSelectOptions(elem, options, labelsAndKeys = { label : "name", value : "id"}){
    const {label, value} = labelsAndKeys;
 
    elem.options.length = 0;
 
    const tempOptions = document.createDocumentFragment();
 
    options.forEach( option => {
        const optValue = option[value];
        const optLabel = option[label];
 
        const opt = document.createElement('option');
        opt.value = optValue;
        opt.textContent = optLabel;
 
        tempOptions.appendChild(opt);
    });
 
    elem.appendChild(tempOptions);
 }
 
 // Get Identification Types
 (async function getIdentificationTypes () {
    try {
        const identificationTypes = await mp.getIdentificationTypes();
        const docTypeElement = document.getElementById('docType');
 
        createSelectOptions(docTypeElement, identificationTypes)
    }catch(e) {
        return console.error('Error getting identificationTypes: ', e);
    }
 })()


function getErrors(errors){

    var error = {
        205: "Digite o número do seu cartão.",
        208: "Escolha um mês.",
        209: "Escolha um ano.",
        212: "Informe seu documento.",
        213: "Informe seu documento.",
        214: "Informe seu documento.",
        220: "Informe seu banco emissor.",
        221: "Digite o nome e sobrenome.",
        224: "Digite o código de segurança.",
        E301: "Há algo de errado com esse número. Digite novamente.",
        E302: "Confira o código de segurança.",
        316: "Por favor, digite um nome válido.",
        322: "Confira seu documento.",
        323: "Confira seu documento.",
        324: "Confira seu documento.",
        325: "Confira a data.",
        326: "Confira a data.",
    };

    if (errors in error) {
        return error[errors];
    } else {
        return "Confira os dados.";
    }
}

