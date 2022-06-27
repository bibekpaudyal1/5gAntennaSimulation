// import React ,{useState} from 'react'
// import Modal from 'react-bootstrap/Modal';
// import ModalHeader from 'react-bootstrap/ModalHeader'

// const RouteName = () => {
//     const [showModal, setShowModal] = useState(false);
    
//     // const handleClose = ()=> setShow(false);
//     // const handleShow = () => setShow(true);
    
//   return (
//       <>
//      <Button variant="primary" onClick={() => setShowModal(true)}>
//         Add Routes
//     </Button>
   
//     {showModal ? (
//         <>
//           <div className="flex justify-center items-center overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none">
//             <div className="relative w-auto my-6 mx-auto max-w-3xl">
//               <div className="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
//                 <div className="flex items-start justify-between p-5 border-b border-solid border-gray-300 rounded-t ">
//                   <h2 className="text-3xl font=semibold">Add Routes</h2>
//                   <button
//                     className="bg-transparent border-0 text-black float-right"
//                     onClick={() => setShowModal(false)}
//                   >
//                     <span className="text-black opacity-7 h-6 w-6 text-xl block bg-gray-400 py-0 rounded-full">
//                       x
//                     </span>
//                   </button>
//                 </div>
//                 <div className="relative p-6 flex-auto">
//                   <form className="bg-gray-200 shadow-md rounded px-8 pt-6 pb-8 w-full">
//                     <label className="block text-black text-sm font-bold mb-1">
//                       Route ID
//                     </label>
//                     <input className="shadow appearance-none border rounded w-full py-2 px-1 text-black" />
//                     <label className="block text-black text-sm font-bold mb-1">
//                       Route Name
//                     </label>
//                     <input className="shadow appearance-none border rounded w-full py-2 px-1 text-black" />
//                   </form>
//                 </div>
//                 <div className="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b">
//                   <button
//                     className="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1"
//                     type="button"
//                     onClick={() => setShowModal(false)}
//                   >
//                     Close
//                   </button>
//                   <button
//                     className="text-white bg-yellow-500 active:bg-yellow-700 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1"
//                     type="button"
//                     onClick={() => setShowModal(false)}
//                   >
//                     Add
//                   </button>
//                 </div>
//               </div>
//             </div>
//           </div>
//         </>
//       ) : null}
//     </>

//   )
// }

// export default RouteName




// // function Example() {
// //     const [show, setShow] = useState(false);
  
// //     const handleClose = () => setShow(false);
// //     const handleShow = () => setShow(true);
  
// //     return (
// //       <>
// //         <Button variant="primary" onClick={handleShow}>
// //           Launch demo modal
// //         </Button>
  
// //         <Modal show={show} onHide={handleClose}>
// //           <Modal.Header closeButton>
// //             <Modal.Title>Modal heading</Modal.Title>
// //           </Modal.Header>
// //           <Modal.Body>
// //             <Form>
// //               <Form.Group className="mb-3" controlId="exampleForm.ControlInput1">
// //                 <Form.Label>Email address</Form.Label>
// //                 <Form.Control
// //                   type="email"
// //                   placeholder="name@example.com"
// //                   autoFocus
// //                 />
// //               </Form.Group>
// //               <Form.Group
// //                 className="mb-3"
// //                 controlId="exampleForm.ControlTextarea1"
// //               >
// //                 <Form.Label>Example textarea</Form.Label>
// //                 <Form.Control as="textarea" rows={3} />
// //               </Form.Group>
// //             </Form>
// //           </Modal.Body>
// //           <Modal.Footer>
// //             <Button variant="secondary" onClick={handleClose}>
// //               Close
// //             </Button>
// //             <Button variant="primary" onClick={handleClose}>
// //               Save Changes
// //             </Button>
// //           </Modal.Footer>
// //         </Modal>
// //       </>
// //     );
// //   }
  
// //   render(<Example />);







//     {/* <Modal show = {show} onHide = {handleClose}>
//     <Modal.Header closeButton>
//         <Modal.Title>Add Routes</Modal.Title>

//     </Modal.Header>
//     <Modal.Body>
//     <Form.Group className="mb-3 mt-2" controlId="routeID.routeInput1">
//                 <Form.Label>Route.Id</Form.Label>
//                 <Form.Control
//                   type="text"
//                   placeholder="Route ID"
//                   autoFocus
//                 />
//               </Form.Group>

//               <Form.Group className="mb-3 mt-2" controlId="routeName.routeInput1">
//                 <Form.Label>Route Name</Form.Label>
//                 <Form.Control
//                   type="text"
//                   placeholder="Route Name"
//                   autoFocus
//                 />
//               </Form.Group>
        



//     </Modal.Body>
//     <Modal.Footer>
//             <Button variant="secondary" onClick={handleClose}>
//               Close
//             </Button>
//             <Button variant="primary" onClick={handleClose}>
//               Save Changes
//             </Button>
//           </Modal.Footer>
    
 
//     </Modal>
//     </> */}