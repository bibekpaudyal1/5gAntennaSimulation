import React from "react";
import { FlatList } from "react-native";
import MovieCard from "../components/MovieCard";
import watchlist from "./MovieScreen";

const WatchlistScreen = ({ navigation }) => {
  const { watchlist } = route.params;
  return (
    <FlatList
      data={watchlist}
      keyExtractor={(item) => item.id.toString()}
      renderItem={({ item }) => (
        <MovieCard
          movie={item}
          onPress={() => navigation.navigate("Movie", { movieId: item.id })}
        />
      )}
    />
  );
};

export default WatchlistScreen;
