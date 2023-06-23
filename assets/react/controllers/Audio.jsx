import React, { useEffect } from 'react';
import { useState } from 'react';
import Sound from './Players/Sound/Sound'
import Playbutton from './Players/Sound/Components/Playbutton/Playbutton'
import Previusbutton from './Players/Sound/Components/Previusbutton/Previusbutton';
import Nextbutton from './Players/Sound/Components/Nextbutton/Nextbutton';
import Playlist from './Players/Sound/Components/Playlist/Playlist';



export default function Audio(props) {

    const [isPlaying, setIsPlaying] = useState(false);
    const [current, setCurrent] = useState(props.post);
    const [source, setSource] = useState(props.src);
    const [count, setCount] = useState(0);
    // const [currents, setCurrents] = useState(0);
  
    

    const togglePlay = () => {
        setIsPlaying(!isPlaying);
        

    };

    const handleNext = () => {
        console.log('next');

      }
    
    const changeAudio = (audio) => {
        //! pour le moment, je change l'audio à chaque fois que je clique sur un titre

        if(count % 2 == 0){
            setCount(count + 1);
            console.log('change audio');
            setSource('/sound/Minamo.mp3');
        }else{
            setCount(count + 1);
            console.log('change audio');
            console.log(audio.titre, audio.id, audio.src);
            setSource(audio.src);
        }
        setCurrent(audio);
    }


    useEffect(() => {
        console.log('audio');

    },[current])


  return (
    <div className='audio'>
        Je suis le contenaire du player audio
        <Sound 
            play={isPlaying}
            src={source}
        />
        <Playbutton 
            isPlaying={isPlaying} 
            togglePlay={togglePlay}
        />
        <Previusbutton

        />
        <Nextbutton
            handleNext={handleNext}
        />
        <Playlist
            post={props.post}
            handleNext={handleNext}
            changeAudio={changeAudio}
        />
    </div>
  )
}
