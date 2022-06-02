import React from "react";
import {View, Text,TouchableOpacity,SafeAreaView,StyleSheet} from 'react-native';
import Colors from "../Constants/Colors";


const styles = StyleSheet.create({
    row:{
        paddingHorizontal:Colors.padding,
        marginBottom:10,

    },
    text:{
        fontSize:16,
        color:Colors.text,

    },
    seperator:{

    },

});

export default () => {


    return(
        <SafeAreaView>
         <TouchableOpacity style = {styles.row}>
           <Text>
               Themes
           </Text>
         </TouchableOpacity>


         <TouchableOpacity style = {styles.row}>
           <Text>
               React native Basics
           </Text>
         </TouchableOpacity>

         <TouchableOpacity style = {styles.row}>
           <Text>
               React native Components
           </Text>
         </TouchableOpacity>




         </SafeAreaView>


    );

}
