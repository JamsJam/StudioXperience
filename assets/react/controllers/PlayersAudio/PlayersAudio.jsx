import React from "react"
import { useState, useEffect, useRef } from "react";
import { Howl } from 'howler';



export default function PlayersAudio(props) {

    const [play, setPlay] = useState(false);
    const soundRef = useRef(null);


    useEffect(() => {
      const sound = new Howl({
          src: [props.src],
          html5: true,
          volume: 0.5,
          autoplay: play,
          onend: () => setPlay(false)
      });
      soundRef.current = sound;
      console.log(soundRef.current)
      

      // Nettoyage après le démontage du composant
      return () => {
          newSound.stop();
      };
  }, [props.src]);

  const togglePlay = () => {
    const sound = soundRef.current;
      setPlay(!play);
      if (play) {
        sound.pause();
      } else {
        sound.play();
      }

  };

    
  return (
    <div>
        block audio 
        
            <button onClick ={togglePlay} >Click to play</button>
            
    </div>
  )
}
