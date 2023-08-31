import { Controller } from '@hotwired/stimulus';



/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* stimulusFetch: 'lazy' */
export default class extends Controller {
    
    static targets = ['reactContainer'];
    static values = { textValue: String };

    connect() {
        
        // this.textValue = `{&quot;content&quot;:&quot;[{\&quot;module\&quot;: \&quot;module--TexteImage\&quot;,\&quot;content\&quot;:{\&quot;texte\&quot;:\&quot;Data for Module A\&quot;,\&quot;image\&quot;: \&quot;https:\/\/picsum.photos\/200\/300.webp\&quot;}},{\&quot;module\&quot;: \&quot;module--Texte\&quot;,\&quot;content\&quot;:{\&quot;texte\&quot;: \&quot;${'premiertext'}\&quot;}},{\&quot;module\&quot;:\&quot;module--TexteImage\&quot;,\&quot;content\&quot;:{\&quot;texte\&quot;: \&quot;Data for Module A\&quot;,\&quot;image\&quot;: \&quot;https:\/\/picsum.photos\/200\/300.webp\&quot;}}]&quot;}`
        // this.renderContainer()

        
        
    }
    

    testFonction(e) {
        this.textValue = e.target.value
        document.querySelector('#test-id').textContent = this.textValue

    }       
}
