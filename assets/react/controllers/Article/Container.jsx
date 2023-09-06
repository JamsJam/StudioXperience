import React from 'react';
import { useState, useEffect, lazy, Suspense } from 'react';
// import TexteImage from './Modules/TexteImage.jsx';
// import Texte from './Modules/Texte.jsx';

const importedModules = {};


export default function Container(props) {

  const [data, setData] = useState(props.content);

  console.log(JSON.parse(data));
  
  

  

  return (
    <div>
      
      {data && JSON.parse(data).map((item, index) => {
        // const modulePath = `./Modules/${item.content.module.slice(8)}/${item.module.slice(8)}.jsx`;
        
        // Si le module a déjà été importé, utilisez la référence existante
        console.log(item.content, item.content.module, item.content.module.slice(8), `${item.content.module.slice(8)}.jsx`);
        const  ChosedModule =  importedModules[`./Modules/${item.content.module.slice(8)}/${item.content.module.slice(8)}.jsx`] || lazy(() => import(`./Modules/${item.content.module.slice(8)}/${item.content.module.slice(8)}.jsx`));
        
        // Stockez la référence au module importé
        if (!importedModules[`./Modules/${item.content.module.slice(8)}/${item.content.module.slice(8)}.jsx`]) {
          importedModules[`./Modules/${item.content.module.slice(8)}/${item.content.module.slice(8)}.jsx`] = ChosedModule;
        }
        
        return (
          <div key={index}>
            
            <Suspense fallback={<div>Loading...</div>}>
              <br />
              <ChosedModule content={item.content} />
            </Suspense>
          </div>
        );
      })}
    
    </div>
  )
}
