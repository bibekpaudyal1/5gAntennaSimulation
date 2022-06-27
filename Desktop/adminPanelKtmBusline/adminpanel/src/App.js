import React from 'react'
import './App.css'
import {BrowserRouter,Routes,Route} from 'react-router-dom';
import {TooltipComponent } from '@syncfusion/ej2-react-popups';


import { FiSettings } from 'react-icons/fi';
//importing the React setting icons from react-icons/fi

//Importing all the components
import Navbar from './components/Navbar'; 
import Sidebar from './components/Sidebar';
import ThemeSetting from './components/ThemeSetting';

//importing all the pages 
 import  Area from './pages/Chart/Area';
 import Bar from './pages/Chart/Bar';
 import ColorMapping from './pages/Chart/ColorMapping';
 import Financial from './pages/Chart/Financial';
 import Line from './pages/Chart/Line';
 import Pie from './pages/Chart/Pie';
 import Pyramid from './pages/Chart/Pyramid';
 import Stacked from './components/Charts/Stacked';
 import Calendar from './pages/Calendar';
 import ColorPicker from './pages/ColorPicker';
 import Editor from './pages/Editor';
 import Kanban from './pages/Kanban';
import RouteName from './pages/RouteName';
import RouteInfo from './pages/RouteInfo';
import RoutePoint from './pages/RoutePoint';
import KathamanduBuslineSystem from './pages/KathamanduBuslineSystem';
import RouteAmount from './pages/RouteDistance';
import RouteDistance from './pages/RouteDistance';
import RouteBus from './pages/RouteBus';
import { BiFemaleSign } from 'react-icons/bi';


import { useStateContext } from './contexts/ContextProvider';

const App = () => {
  const { activeMenu } = useStateContext();
  return (
    <div>
   <BrowserRouter>
     <div className="flex relative dark:bg-main-dark-bg">
      <div className = "fixed right-4 bottom-4" style = {{ zIndex:'1000'}}>
      <TooltipComponent
      content="Settings" position="TOP">
        <button type ="button"
        className='text-3xl p-3
        hover:drop-shadow-xl
        hover:bg-light-gray text-white'
        style={{background:'blue',
               borderRadius :'50%'}}
        >
           <FiSettings />
        </button>
      </TooltipComponent>
      </div>
      {activeMenu? (
        <div className='w-72 fixed sidebar dark:bg-secondary-dark-bg 
        bg-white'>
        <Sidebar />
        </div>
      ):(
        <div className='w-0 dark:bg-secondary-dark-bg'>
        <Sidebar />
        </div>
      )
      }
      <div className = {activeMenu ? 
      'dark:bg-main-bg bg-main-bg min-h-screen md:ml-72 w-full':
      'dark:bg-main-bg bg-main-bg main-h-screen w-full flex-2'
      }>
      <div className='fixed md:static bg-main-bg dark:bg-main-dark-bg navbar w-full'>
       <Navbar />
       
      </div>
 
      
      <div>
        <Routes>
        {/* Dashboard */}
          <Route path ="/" 
          element = { <KathamanduBuslineSystem />} />
         
         <Route path ="/kathmanduBuslineSystem" 
          element = { <KathamanduBuslineSystem />} />

        {/* pages */}

        <Route path ="/route-name" 
          element = {<RouteName/>} />


        <Route path ="/routeAmount" 
          element = {<RouteAmount/>} />
        

        <Route path ="/routeBus" 
          element = {<RouteBus/>} />

        <Route path ="/routeDistance" 
          element = {<RouteDistance/>} />

        <Route path ="/routeInfo" 
          element = {<RouteInfo/>} /> 

        <Route path ="/routePoint" 
          element = {<RoutePoint/>} />   


        
        {/* apps  */}
        <Route path ="/kanban" 
          element = {<Kanban/>} />
        

        <Route path ="/editor" 
          element = {<Editor/>} />
        

        <Route path ="/calendar" 
          element = {<Calendar/>} />
        
        <Route path ="/color-picker" 
          element = {<ColorPicker/>} />
        
        {/* Chart Pages */}

        <Route path ="/area" 
          element = {<Area/>} />

        <Route path ="/bar" 
          element = {<Bar/>} />

         <Route path ="/colorMapping" 
          element = {<ColorMapping/>} /> 

           <Route path ="/financial" 
          element = {<Financial/>} /> 

           <Route path ="/line" 
          element = {<Line/>} />

           <Route path ="/pie" 
          element = {<Pie/>} />

           <Route path ="/pyramid" 
          element = {<Pyramid/>} />

           <Route path ="/stacked" 
          element = {<Stacked/>} />  

        


        </Routes>
        </div>
      </div>
     </div>
   </BrowserRouter>
   </div>
  )
}

export default App;