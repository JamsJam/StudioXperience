import React from 'react';

export default function Texte(props) {

  return (
    < div id="test-id">
        <p className='text text--20-500' id={`${props.content.idModule}--text`}>
            {props.content.content.texte == 'vide' ? props.content.content.texte : 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus quaerat numquam dolorum, expedita iure temporibus sunt repellendus nostrum itaque sequi id quisquam eos. Vitae unde placeat, excepturi odio ipsum maiores modi est!' }
        </p>
    </div>
  )
}
