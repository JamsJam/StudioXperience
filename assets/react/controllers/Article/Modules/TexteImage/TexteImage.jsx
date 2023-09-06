import React from 'react';
import './TexteImage.css';

export default function TexteImage(props) {

  return (
    <div className='textImageCss'>
        <p className='text text--20-500' id={`${props.content.idModule}--text`}>
        { props.content.content.texte != 'vide' ? props.content.content.texte : 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus    quaerat numquam dolorum, expedita iure temporibus sunt repellendus nostrum itaque sequi id quisquam eos. Vitae unde placeat, excepturi odio ipsum maiores modi est!' }
        </p>
        <img src={props.content.content.image} alt=""  id={`${props.content.idModule}--img`}/>
    </div>
  )
}
