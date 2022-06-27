import React,{useEffect} from 'react'
import {AiOutlineMenu} from 'react-icons/ai';
import { BsChatLeft } from 'react-icons/bs';
import { RiNotification3Line } from 'react-icons/ri';
import { MdKeyboardArrowDown } from 'react-icons/md';

import { TooltipComponent } from '@syncfusion/ej2-react-popups';

import avatar from '../data/avatar.jpg';
import {Cart,Chat,Notification,userProfile} from '.';

// import { useStateContext } from '../contexts/ContextProvider';





const NavButton = (
  {title,customFunc,icon,color,dotColor}
) =>(
  <TooltipComponent
  content={title}
  position="BottomCenter"
  >
  <button
  type='button'
  onClick={customFunc}
  style = {{color}}
  className = "relative text-xl rounded-full p-3 hover:bg-light-gray"
  >
 <span style={{ background: dotColor}} 
  className = "absolute inline-flex rounded-full h-2 w-2 right-2 top-2" />
    {icon}
  </button>

  </TooltipComponent>
)

// const activeMenu = true;

const Navbar = () => {

  //use state for making the navBar Dynamic
//  const {activeMenu,SetActiveMenu} = useStateContext();
  return (
    <div className='flex justify-between p-0 md:mx-6 relative hover:shadow-lg'>
     <NavButton 
     title="Menu"
     customFunc={()=>{}}
    //  {()=>handleClick('menu')}
     dotColor="ebf0ed"
     color = "#000000"
    //  SetActiveMenu((prevActiveMenu)=>
    //  !prevActiveMenu )}
     icon={<AiOutlineMenu />}
    />
    <div className='flex'>
    <NavButton 
     title="chat"
     dotColor="ebf0ed"
     customFunc={()=>{}}
     color = "#000000"
     icon={<BsChatLeft />}
    />
    <NavButton 
     title="Notifications"
     dotColor="ebf0ed"
     customFunc={()=>{}}
     color = "#000000"
     icon={<RiNotification3Line />}
    />
    <TooltipComponent 
    content="profile"
    position="BottomCenter"
    >
      <div className='flex items-center gap-2 cursor-pointer p-1 hover:bg-light-gray rounded-lg '
      onClick={()=>{}}>
        <img className='rounded-full w-8 h-8'
        src = {avatar} />
        <p> <span className='text-gray-400 text-14'>Hi, </span>
        <span className='text-gray-400 font-bold ml-1 text-14'>Admin</span>
        </p>
        <MdKeyboardArrowDown className='text-gray-400 text-14' />
      </div>

    </TooltipComponent>
   {/* {isClicked.Cart && <Cart />}
   {isClicked.Cart && <Cart />}
   {isClicked.Cart && <Cart />}
   {isClicked.Cart && <Cart />} */}
    </div>


    </div>



  )
}

export default Navbar