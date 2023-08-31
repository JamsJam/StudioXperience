import { Controller } from '@hotwired/stimulus';


/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static targets = ['form', 'checkbox','lightbox', 'lightboxContainer'];
    static values = { 
                        url: String, 
                        Module: Array,

                    }

    //!---------------------------------------------------------//
    //?-------------------- Initialisation  --------------------//
    //!---------------------------------------------------------//


    connect() {
        this.changeUrlValue();
        this.changeUrlValue([])
        this.fetchModel();
    }
    
    
    //!---------------------------------------------------------//
    //?--------------------- Value Setter  ---------------------//
    //!---------------------------------------------------------//

    changeUrlValue(){
        this.urlValue = `${window.location.origin}/back/api/post`;
    }

    changeModuleValue(ModuleArray){
        this.ModuleValue = ModuleArray;
    }



    //!---------------------------------------------------------//
    //?---------------- Open and close lightbox ----------------//
    //!---------------------------------------------------------//
    
    fireLightbox(){
        this.lightboxContainerTarget.classList.add('lightboxContainer--active');
        this.displayModule();
    }

    closeLightbox(){
        this.lightboxContainerTarget.classList.remove('lightboxContainer--active')
    }

    displayModule(){
        this.lightboxTarget.innerHTML = '';
        this.ModuleValue.forEach(element => {
            const newModule = document.createElement('button');
            newModule.classList.add('module');
            newModule.setAttribute('type', 'button')
            newModule.setAttribute('id', element.id)
            newModule.setAttribute('data-action', 'click->module-form#testGetValue')
            newModule.textContent = element.name;
            this.lightboxTarget.appendChild(newModule);
        });
    }


    testGetValue(e){
        console.log('le module est geré')
        this.closeLightbox()
        
    }

    //!---------------------------------------------------------//
    //?--------------------- Ajax request  ---------------------//
    //!---------------------------------------------------------//

    async fetchModel(){
        const request = await fetch(this.urlValue);
        const response = await request.json();

        
        const newModuleValue = response.data.map(item => {
            return item;
        });
        this.changeModuleValue(newModuleValue);
        
        
    }



}
