import React from 'react'


export default function Nextbutton({handleNext}) {

  const next = () => {
    handleNext();

  }


  return (
    <button onClick={next}>
        Next
    </button>
  )
}
