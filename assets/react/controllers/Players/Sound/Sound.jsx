import  React from 'react'
import { useEffect, useRef} from 'react';
import { Howl } from 'howler';


export default function Sound(props) {
//? objectif : Initialiser howler, recuperer la source via un propos et lire le son
//? 1. Initialiser howler²



    const soundRef = useRef(null);

    useEffect(() => {
        
        const sound = new Howl({
            src: [props.src]
        });
        console.log(props.src, 'src changed');
        soundRef.current = sound;

        return () => {
            // Nettoyage : arrêter le son et libérer les ressources
            soundRef.current.stop();
            soundRef.current.unload();
          };
    }, [props.src])

    useEffect(() => {
        if (props.play) {
          soundRef.current.play();
        } else {
          soundRef.current.pause();
        }
      }, [props.play]);
    
    return (
        <div>
            
            
        </div>
    )
}
