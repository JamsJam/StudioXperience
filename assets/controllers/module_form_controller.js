import { Controller } from '@hotwired/stimulus';
import { v4 as uuidv4 } from 'uuid';

export default class extends Controller {
    // Targets
    static targets = [
        'form', // Le formulaire
        'checkbox',
        'lightbox', // La light box
        'lightboxContainer', // Le container de la lightbox
        'displayModule', // Le contenaire des bouton pour choisir un module
        'moduleList', // La liste des modules
        'editContentContainer' // Le contenaire pour modifier le contenu d'un module
    ];

    // Values
    static values = {
        url: String,
        module: Array,
        listModule: Array
    }

    //!---------------------------------------------------------//
    //?-------------------- Initialisation  --------------------//
    //!---------------------------------------------------------//
    
    initialize() {
        this.changeUrlValue();
        this.changeModuleValue([]);
        this.changeListModule([]);
        this.hasModule();
        this.fetchModel();
    }

    //!---------------------------------------------------------//
    //?--------------------- Value Setter  ---------------------//
    //!---------------------------------------------------------//

    changeUrlValue() {
        this.urlValue = `${window.location.origin}/back/api/post`;
    }

    changeModuleValue(ModuleArray) {
        this.ModuleValue = ModuleArray;
    }

    changeListModule(listModuleArray) {
        this.listModuleValue = listModuleArray;
    }

    //!---------------------------------------------------------//
    //?--------------------- Ajax request  ---------------------//
    //!---------------------------------------------------------//

    async fetchModel() {
        const request = await fetch(this.urlValue);
        const response = await request.json();

        const newModuleValue = response.data.map(item => {
            return item;
        });
        this.changeModuleValue(newModuleValue);
    }

    fetchReact = async (content) => {
        const request = await fetch(`${window.location.origin}/back/api/post/react-refresh`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(content)
        });
        const response = await request.text();
        console.log(response);
        const doc = new DOMParser().parseFromString(response, 'text/html');
        const react = doc.querySelector('#react-container');
        document.querySelector('#react-container').replaceWith(react);
    }

    //!---------------------------------------------------------//
    //?---------------- Open and close lightbox ----------------//
    //!---------------------------------------------------------//
    
    fireLightbox() {
        this.lightboxContainerTarget.classList.add('lightboxContainer--active');
        this.displayModule();
    }

    closeLightbox() {
        this.lightboxContainerTarget.classList.remove('lightboxContainer--active');
    }

    //!---------------------------------------------------------//
    //?------------- Display Element in Container --------------//
    //!---------------------------------------------------------//

    displayModule() {
        this.displayModuleTarget.innerHTML = '';
        this.ModuleValue.forEach(element => {
            const newModule = document.createElement('button');
            newModule.classList.add('module');
            newModule.setAttribute('type', 'button');
            newModule.setAttribute('id', element.id);
            newModule.setAttribute('data-action', 'click->module-form#choiceModule');
            newModule.textContent = element.name;
            this.displayModuleTarget.appendChild(newModule);
        });
    }

    //!---------------------------------------------------------//
    //?------------------- Choisir un module -------------------//
    //!---------------------------------------------------------//

    choiceModule(event) {
        const module = event.currentTarget;
        const moduleID = module.getAttribute('id');
        const moduleValue = this.ModuleValue.find(element => element.id == moduleID);
        console.log(moduleValue);
        this.addToModuleList(moduleValue);
        this.closeLightbox();
    }

    //!---------------------------------------------------------//
    //?---------------------- CRUD module ----------------------//
    //!---------------------------------------------------------//
    
    //? --------- Add
    //!--------------
    addToModuleList(module) {
        const list = this.listModuleValue;
        const index = list.length + 1;
        module.index = index;
        const uui = uuidv4();
        module.content.idModule = `${module.content.module.replaceAll(' ',' __').toLowerCase()}--${uui}--${index}`;
        list.push(module);
        this.changeListModule(list);
        
        const newModule = document.createElement('div');
        newModule.classList.add('moduleChoosen__module');
        newModule.setAttribute('id', `${module.content.idModule}--list`);
        newModule.innerHTML = `<p class="titre titre--20--500">${module.name}</p>
                                        <div class="module__btns">
                                            <button type="button" 
                                            class="button button--format"
                                            data-action="click->module-form#editModuleContent"
                                            data-module-form-id-param="${module.content.idModule}"
                                            >Modifier</button>
                                            <button type="button" class="button button--format" 
                                            data-action="click->module-form#removeToModuleList" 
                                            data-module-form-id-param="${module.content.idModule}"
                                            >Supprimer</button>
                                        </div>`;
        this.moduleListTarget.appendChild(newModule);
        this.hasModule();
        this.fetchReact(this.listModuleValue);
    }

    //? --------- Remove
    //!--------------
    removeToModuleList(event) {
        const id = event.params.id;
        const listR = this.listModuleValue;
        const index = listR.findIndex(element => element.content.idModule == id);
        listR.splice(index, 1);
        this.changeListModule(listR);
        document.querySelector(`#${event.params.id}--list`).remove();
        this.hasModule();
        this.fetchReact(this.listModuleValue);
    }

    //? --------- Has
    //!--------------
    hasModule() {
        if (!this.listModuleValue.length > 0) {
            const newModule = document.createElement('div');
            newModule.classList.add('moduleChoosen__module');
            newModule.setAttribute('id', `noModule`);
            newModule.innerHTML = `<p class="titre titre--20--500" style="width:100%">Ajouter un nouveau module à votre article</p>`;
            this.moduleListTarget.appendChild(newModule);
        } else {
            if (document.querySelector(`#noModule`)) {
                document.querySelector(`#noModule`).remove();
                return;
            } 
            return;
        }
    }

    
    //? --------- Edit
    //!----------------
    editModuleContent(event) {
        const id = event.params.id;
        const module = this.listModuleValue.find(element => element.content.idModule == id);
        console.log(module, module.content.content.input);
        let inputs = module.content.content.input;
        const inputContainer = document.createElement('div');
        inputContainer.classList.add('ModuleInput__Container');
        console.log(inputs);
        let htmls = ['<div class="close" data-action="click->module-form#removeEditModal">Close</div>'];
        for (var input in inputs) {
            console.log([input , inputs[input]]);
            htmls.push(this.getModuleInput(inputs[input], module.content.idModule));
        }
        inputContainer.innerHTML = htmls.join('');

        let container = this.createUpdateModal();
        container.innerHTML = inputContainer.outerHTML;
        console.log(container);
        this.editContentContainerTarget.append(container);
    }

    removeEditModal() {
        //todo conservation des données initiales du module en cas d'annulation
        //todo créer un bouton pour valider les changements et refresh react après validation
        document.querySelector('#updateModal').remove();
    }

    updateModuleContent(event) {
        // console.log(event.params.id);
        const id = event.params.id;
        const idModule = id.slice(0,-9);
        document.querySelector(`#${idModule}`).innerText = event.target.value;
    }

    createUpdateModal() {
        let modal = document.createElement('div');
        modal.classList.add('formCP__modal');
        modal.setAttribute('id', 'updateModal');
        
        return modal;
    }

    /**
     * @param {*} el 
     * @param {*} moduleIdentifier 
     * @returns  {string} inputHtml  
     * permet de retourner un input en fonction du type du module
     */
    getModuleInput(el, moduleIdentifier) {
        let inputHtml = '';
        console.log(el);
        switch (el.type) {
            case 'text':
                inputHtml = `<input type="text"
                            class="input input__text"
                            data-action="input->module-form#updateModuleContent" 
                            data-module-form-id-param="${moduleIdentifier}--text--content" 
                            value="${el.value}";
                        >`;
                break;
            case 'textarea':
                inputHtml = `<textarea
                            class="input input__textarea" 
                            data-action="input->module-form#updateModuleContent" 
                            data-module-form-id-param="${moduleIdentifier}--text--content" 
                            placeholder="Votre texte"
                        > </textarea>`;
                break;

            case "mediatheque":
                inputHtml = `<button type="button"
                            class="button button--format"
                            id="openMediatheque"
                            data-action="click->module-form#openMediatheque"
                            data-module-form-id-param="${moduleIdentifier}--${el.type}--content"
                            data-module-form-value-param="${el.value}"
                        >
                                Ouvrir la médiathèque
                        </button>`;
                break;
            default:
                inputHtml = `<p class="text text--20--500">Aucun input n'a été trouvé</p>`;
                break;
        }
        return inputHtml;
    }

    //!---------------------------------------------------------//
    //?---------------------- Mediateque -----------------------//
    //!---------------------------------------------------------//


    openMediatheque(event) {
        //todo Designer la médiathèque
        //todo faire un formulaire indépendant qui va chercher les images 
        //todo faire un système pour ajouter des images à la médiathèque avec une requête ajax et en récupérant toutes les infos de l'image
        //todo faire un système pour supprimer des images de la médiathèque avec une requête ajax
        //todo faire un système pour modifier les infos d'une image de la médiathèque avec une requête ajax
        //todo Une fois les informations de l'image récupérées, les lier au module en cours
        //todo Faire un système de pagination pour les images
        //todo ajouter un bouton pour valider le choix
    }
}
