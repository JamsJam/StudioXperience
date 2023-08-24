











//! =========================================================================
//? ========================================= Gestion du responsive du footer
//! =========================================================================


function footerResponsiveLogo(elementHTML){
    let element = document.createElement('div');
    element.setAttribute('id', 'footer--logoStudio');
    element.innerHTML = elementHTML;
    document.querySelector('#footer--logoStudio').replaceWith(element);
}

function changeTextFooter(){
    footerText = document.querySelector('#footer--text-resaux');
    footerText.textContent =  'Nous suivre:'
    footerText.style.textAlign = 'center';

}
function changeTextFooter2(){
    footerText = document.querySelector('#footer--text-resaux');
    footerText.textContent =  'Partager :'
    footerText.style.textAlign = 'left';

}

//! =========================================================================
//! ========================================= Gestion du responsive du footer
//! =========================================================================



