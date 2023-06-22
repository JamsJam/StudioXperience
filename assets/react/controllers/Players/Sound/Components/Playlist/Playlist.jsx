import React, { useCallback } from 'react'
import { useEffect } from 'react';
import { useState } from 'react';



export default function Playlist(props)  {
    
    const [list, setList] = useState([props.post]);
    const [currents, setCurrents] = useState(0);

    const newAudio = (audio) => {
        props.changeAudio(audio);
    }

    const fetchPlaylist = async () => {
        let newList = [];
        let response = await fetch(
            'http://localhost:8000/react/api/playlist/sound')
        let data = await response.json()
        await data.map((item) => {
            if(item.id !== props.post.id){

                newList.push(item);
            }
        })

        console.log(newList);
        newList = newList.toSpliced(0,0, props.post)
        setList(newList);
        
        
    }

    const useNextSound = () => {
        const nextSound = useCallback(() => {
            console.log('next');
            setCurrents(currents + 1);
        }, [currents])
    }

    useEffect(() => {
        //! fetch playlist
        fetchPlaylist();
        console.log('playlist');

    }, [])
    // console.log(list); 

    const changeSrc = (e) => {
        // console.log(e.target.getAttribute('data-key'));
        let id = e.target.getAttribute('data-key');
        let target = list.filter( item =>{
            return item.id == id
        });
        // console.log(target);
        
        setCurrents(list.indexOf(target[0]));

        // console.log(list[currents])


    }

    useEffect(() => {
        console.log('currents changed');
        // console.log(list[currents] );
        newAudio(list[currents]);
    }, [currents]
)


  return (
    <div>
        <ul>
            {list.map((item) => (
                    <li key={item.id} data-key={item.id} onClick={changeSrc}>
                        {item.titre}
                    </li>
                )
            )}
        </ul>
    </div>
  )
}
