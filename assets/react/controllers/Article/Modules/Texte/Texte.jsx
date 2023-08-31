import React from 'react';

export default function Texte(props) {
  return (
    < div id="test-id">
        <p className='text text--20-500'>
            {props.content.texte}
        </p>
    </div>
  )
}
