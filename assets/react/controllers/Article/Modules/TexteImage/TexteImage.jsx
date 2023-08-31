import React from 'react';
import './TexteImage.css';

export default function TexteImage(props) {
  return (
    <div className='textImageCss'>
        <p className='text text--20-500'>
          {props.content.texte}
        </p>
        <img src={props.content.image} alt="" />
    </div>
  )
}
