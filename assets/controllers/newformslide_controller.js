import { Controller } from '@hotwired/stimulus';



/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* stimulusFetch: 'lazy' */
export default class extends Controller {
    static targets = ['formslide' , 'previous' , 'next', 'btnformpart', 'loader'] ;


//!==============================
//?====< on Load >========
//!==============================

    initialize() {
        this.index = 0;
        this.showCurrentForm();
    }

    loaderTargetConnected() {
        setTimeout(() => {
            this.removeLoader();
        }, 1000);
        
        
    }

    removeLoader(){
        this.loaderTarget.remove();
    }





//!==============================
//?====< Slide controle >========
//!==============================

    next() {
        this.index++;
        this.showCurrentForm();
    }

    previous() {
        this.index--;
        this.showCurrentForm();
    }
    


//!==============================
//?====< Slide change >========
//!==============================

    /**
     * Go to the index of the form
     * @param {Event} event
     * @returns {void}
     * @private
     */
    goToIndex(event){
        this.index = event.params.index;
        this.showCurrentForm();

    }






    /**
     * Show the current form
     * @returns {void}
     * @private
     */
    showCurrentForm() {
        this.formslideTargets.forEach((element, index) => {
            element.style.display = 'none';
            

            if (index === this.index) {
                element.removeAttribute('style');
            }
            this.removebutton();
            this.activateButton(this.index);
        });
    }

    activateButton(currentIndex){
        
        this.btnformpartTargets.forEach((element, index) => {
            element.classList.remove('button--format--active');
            if (index === this.index) {
                element.classList.add('button--format--active');
            }
        })
    }

        /**
     * Remove the button if the form is the first or the last
     * @returns {void}
     * @private
     */
        removebutton(){
            if(this.index == 0){
                this.previousTarget.style.display = 'none';
            } else{
                this.previousTarget.removeAttribute('style');
            }
    
            if(this.index == this.formslideTargets.length - 1){
                this.nextTarget.style.display = 'none';
            }else{
                this.nextTarget.removeAttribute('style');
            }
        }


}
