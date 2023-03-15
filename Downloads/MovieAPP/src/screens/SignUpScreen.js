// // import React, { useState } from "react";
// // import { View, Text, TextInput, TouchableOpacity } from "react-native";

// // const SignUpScreen = () => {
// //   const [name, setName] = useState("");
// //   const [email, setEmail] = useState("");
// //   const [password, setPassword] = useState("");
// //   const [users, setUsers] = useState([]);

// //   const registerUser = () => {
// //     // Create a new user object with the current input values
// //     const newUser = {
// //       name,
// //       email,
// //       password,
// //     };

// //     // Add the new user to the array of existing users
// //     setUsers([...users, newUser]);

// //     // Clear the input fields after successful sign up
// //     setName("");
// //     setEmail("");
// //     setPassword("");
// //   };

// //   return (
// //     <View>
// //       <Text>Sign Up</Text>
// //       <TextInput
// //         placeholder="Name"
// //         onChangeText={(text) => setName(text)}
// //         value={name}
// //       />
// //       <TextInput
// //         placeholder="Email"
// //         onChangeText={(text) => setEmail(text)}
// //         value={email}
// //       />
// //       <TextInput
// //         placeholder="Password"
// //         secureTextEntry={true}
// //         onChangeText={(text) => setPassword(text)}
// //         value={password}
// //       />
// //       <TouchableOpacity onPress={registerUser}>
// //         <Text>Sign Up</Text>
// //       </TouchableOpacity>
// //       <Text>Existing users:</Text>
// //       {users.map((user, index) => (
// //         <Text key={index}>
// //           {user.name} - {user.email} - {user.password}
// //         </Text>
// //       ))}
// //     </View>
// //   );
// // };

// // export default SignUpScreen;

// import React, { useState } from "react";
// import {
//   View,
//   Text,
//   TextInput,
//   TouchableOpacity,
//   AsyncStorage,
// } from "react-native";

// const SignUpScreen = () => {
//   const [name, setName] = useState("");
//   const [email, setEmail] = useState("");
//   const [password, setPassword] = useState("");
//   const [users, setUsers] = useState([]);

//   const registerUser = () => {
//     // Create a new user object with the current input values
//     const newUser = {
//       name,
//       email,
//       password,
//     };

//     // Retrieve the existing users array from AsyncStorage
//     AsyncStorage.getItem("registeredUsers", (error, result) => {
//       if (!error) {
//         const storedUsers = JSON.parse(result) || [];

//         // Add the new user to the array of existing users
//         const updatedUsers = [...storedUsers, newUser];

//         // Convert the updated array to a string and store it in AsyncStorage
//         AsyncStorage.setItem(
//           "registeredUsers",
//           JSON.stringify(updatedUsers),
//           () => {
//             // Update the state of the component with the updated array of users
//             setUsers(updatedUsers);
//           }
//         );
//       }
//     });

//     // Clear the input fields after successful sign up
//     setName("");
//     setEmail("");
//     setPassword("");
//   };

//   return (
//     <View>
//       <Text>Sign Up</Text>
//       <TextInput
//         placeholder="Name"
//         onChangeText={(text) => setName(text)}
//         value={name}
//       />
//       <TextInput
//         placeholder="Email"
//         onChangeText={(text) => setEmail(text)}
//         value={email}
//       />
//       <TextInput
//         placeholder="Password"
//         secureTextEntry={true}
//         onChangeText={(text) => setPassword(text)}
//         value={password}
//       />
//       <TouchableOpacity onPress={registerUser}>
//         <Text>Sign Up</Text>
//       </TouchableOpacity>
//       {/* <Text>Existing users:</Text> */}
//       {/* {users.map((user, index) => (
//         <Text key={index}>
//           {user.name} - {user.email} - {user.password}
//         </Text>
//       ))} */}
//     </View>
//   );
// };

// export default SignUpScreen;

import React, { useState } from "react";
import { View, Text, TextInput, TouchableOpacity } from "react-native";
import AsyncStorage from "@react-native-async-storage/async-storage";

const SignUpScreen = () => {
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [users, setUsers] = useState([]);

  const registerUser = async () => {
    // Create a new user object with the current input values
    const newUser = {
      name,
      email,
      password,
    };

    try {
      // Retrieve the existing users array from AsyncStorage
      const storedUsers =
        JSON.parse(await AsyncStorage.getItem("registeredUsers")) || [];

      // Add the new user to the array of existing users
      const updatedUsers = [...storedUsers, newUser];

      // Convert the updated array to a string and store it in AsyncStorage
      await AsyncStorage.setItem(
        "registeredUsers",
        JSON.stringify(updatedUsers)
      );

      // Update the state of the component with the updated array of users
      setUsers(updatedUsers);
    } catch (error) {
      console.error(error);
    }

    // Clear the input fields after successful sign up
    setName("");
    setEmail("");
    setPassword("");
  };

  return (
    <View>
      <Text>Sign Up</Text>
      <TextInput
        placeholder="Name"
        onChangeText={(text) => setName(text)}
        value={name}
      />
      <TextInput
        placeholder="Email"
        onChangeText={(text) => setEmail(text)}
        value={email}
      />
      <TextInput
        placeholder="Password"
        secureTextEntry={true}
        onChangeText={(text) => setPassword(text)}
        value={password}
      />
      <TouchableOpacity onPress={registerUser}>
        <Text>Sign Up</Text>
      </TouchableOpacity>
      <Text>Existing users:</Text>
      {users.map((user, index) => (
        <Text key={index}>
          {user.name} - {user.email} - {user.password}
        </Text>
      ))}
    </View>
  );
};

export default SignUpScreen;
