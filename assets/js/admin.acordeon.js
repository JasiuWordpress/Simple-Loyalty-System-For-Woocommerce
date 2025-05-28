const accordeon_buttons = document.querySelectorAll('.SimpleLoyalty_accordeon_toggle');

if(accordeon_buttons){
accordeon_buttons.forEach(button => {
    button.addEventListener('click', () => {
        let accordeon_body = button.parentElement.nextElementSibling;
        let atr = accordeon_body.getAttribute('aria-hidden');

        if(atr == 'true'){
            accordeon_body.setAttribute('aria-hidden',false);
            button.classList.add('opened');
        }else{
            accordeon_body.setAttribute('aria-hidden',true);
            button.classList.remove('opened');
        }

    })
})
}