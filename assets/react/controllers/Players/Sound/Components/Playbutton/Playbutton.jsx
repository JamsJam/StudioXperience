import React from 'react'

export default function Playbutton(props) {
    const play = props.isPlaying;
    const handleplaypause = () => {
        props.togglePlay();
        
    }
  return (
    
         
        <button onClick={handleplaypause}>
            {play ? 'Pause' : 'Play'}
        </button>
  )
}
