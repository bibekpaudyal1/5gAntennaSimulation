import networkx as nx
import numpy as np
import itertools
import time
import matplotlib.pyplot as plt

# Function to generate a random graph
def generate_random_graph(num_cities, max_distance=100):
    G = nx.Graph()

    # Add nodes (cities)
    G.add_nodes_from(range(num_cities))

    # Add random edges with random distances
    for i in range(num_cities):
        for j in range(i + 1, num_cities):
            distance = np.random.randint(1, max_distance)
            G.add_edge(i, j, distance=distance)  # Explicitly adding 'distance' attribute
            G.add_edge(j, i, distance=distance)  # Undirected graph

    return G

# Function to calculate all the lengths of the shortest paths using Dijkstra's algorithm
def calculate_shortest_paths(graph):
    distance_matrix = {}
    for start_node in graph.nodes:
        distances = nx.single_source_dijkstra_path_length(graph, start_node)
        distance_matrix[start_node] = distances
    return distance_matrix

# Function to implement the Nearest Neighbor algorithm
def nearest_neighbor(graph):
    start_node = np.random.choice(list(graph.nodes))
    tour = [start_node]
    unvisited_nodes = set(graph.nodes - set([start_node]))

    while unvisited_nodes:
        current_node = tour[-1]
        nearest_node = min(unvisited_nodes, key=lambda node: graph[current_node][node]['distance'])
        tour.append(nearest_node)
        unvisited_nodes.remove(nearest_node)

    tour.append(start_node)  # Return to the starting point
    return tour

# Function to implement the Brute Force algorithm
def brute_force(graph):
    num_cities = graph.number_of_nodes()
    all_tours = itertools.permutations(graph.nodes)

    min_tour = None
    min_length = float('inf')

    for tour in all_tours:
        length = 0
        for i in range(len(tour) - 1):
            # Check if the edge exists before accessing its attributes
            if graph.has_edge(tour[i], tour[i + 1]):
                length += graph[tour[i]][tour[i + 1]]['distance']
            else:
                # Handle the case where the edge doesn't exist
                length = float('inf')
                break

        # Check if the last edge exists
        if length != float('inf') and graph.has_edge(tour[-1], tour[0]):
            length += graph[tour[-1]][tour[0]]['distance']
        else:
            length = float('inf')

        if length < min_length:
            min_length = length
            min_tour = tour

    if min_tour is not None:
        return list(min_tour)
    else:
        # Handle the case where no feasible tour is found
        return []


# Function to implement the shortcutting process for Christofides algorithm
def shortcut_tour(tour, graph):
    shortcuts = []
    for i in range(len(tour) - 1):
        u, v = tour[i], tour[i + 1]
        min_distance = float('inf')
        min_node = None

        for neighbor in graph.neighbors(u):
            if neighbor != v:
                distance = graph[u][neighbor]['distance'] + graph[v][neighbor]['distance']
                if distance < min_distance:
                    min_distance = distance
                    min_node = neighbor

        if min_node is not None:
            shortcuts.append((u, min_node, v))

    for u, v, w in shortcuts:
        tour.remove(v)
        tour.insert(tour.index(u) + 1, v)
        tour.insert(tour.index(v) + 1, w)

    return tour

# Function to implement the Christofides algorithm
def christofides_algorithm(graph):
    # Step 1: Find a minimum spanning tree
    if graph.number_of_nodes() == 0 or graph.number_of_edges() == 0:
        print("Graph is empty or has no edges. Cannot apply Christofides algorithm.")
        return []



    min_spanning_tree = nx.minimum_spanning_tree(graph)

    # Step 2: Find odd-degree vertices in the minimum spanning tree
    odd_degree_nodes = [node for node, degree in min_spanning_tree.degree if degree % 2 == 1]

    # Step 3: Find minimum-weight perfect matching for odd-degree vertices
    subgraph_odd_degree = graph.subgraph(odd_degree_nodes)
    min_weight_matching = nx.max_weight_matching(subgraph_odd_degree)

    # Step 4: Combine edges from the minimum spanning tree and the matching
    multigraph = nx.MultiGraph()
    multigraph.add_edges_from(min_spanning_tree.edges)
    multigraph.add_edges_from(min_weight_matching)

    # Step 5: Find an Eulerian circuit in the multigraph
    eulerian_circuit = list(nx.eulerian_circuit(multigraph))

    # Step 6: Remove duplicate nodes in the circuit
    tour = list(dict.fromkeys(itertools.chain.from_iterable(eulerian_circuit)))

    # Step 7: Improve the tour using shortcutting
    improved_tour = shortcut_tour(tour, graph)

    return improved_tour

# Function to compare execution times and tour lengths for different algorithms


# Helper function to calculate the total length of a tour
def calculate_tour_length(tour, graph):
    total_length = 0

    for i in range(len(tour) - 1):
        # Use the edge data to get the distance
        edge_data = graph.get_edge_data(tour[i], tour[i + 1])
        if edge_data is not None:
            total_length += edge_data['distance']

    # Add the distance from the last node back to the starting node
    edge_data = graph.get_edge_data(tour[-1], tour[0])
    if edge_data is not None:
        total_length += edge_data['distance']

    return total_length

# Modify compare_algorithms function to include visualization
def visualize_execution_time_growth(num_cities_range):
    nn_times = []
    bf_times = []
    ch_times = []

    for num_cities in num_cities_range:
        nn_time, bf_time, ch_time = compare_algorithms(num_cities)
        nn_times.append(nn_time)
        bf_times.append(bf_time)
        ch_times.append(ch_time)

    plt.plot(num_cities_range, nn_times, label='Nearest Neighbor')
    plt.plot(num_cities_range, bf_times, label='Brute Force')
    plt.plot(num_cities_range, ch_times, label='Christofides')
    plt.xlabel('Number of Cities')
    plt.ylabel('Execution Time (seconds)')
    plt.title('Execution Time Growth with Number of Cities')
    plt.legend()
    plt.show()




# Modify compare_algorithms function to include visualization
def visualize_execution_time_growth(num_cities_range, execution_times):
    nn_times, bf_times, ch_times = zip(*execution_times)

    plt.figure(figsize=(12, 8))

    # Plot all algorithms on the primary y-axis with a linear scale
    plt.plot(num_cities_range, nn_times, label='Christofides', marker='o', color='red')
    plt.plot(num_cities_range, bf_times, label='Brute Force', marker='o', color='green')
    plt.plot(num_cities_range, ch_times, label='Nearest Neighbor', marker='o', color='orange')

    plt.xlabel('Number of Cities')
    plt.ylabel('Execution Time (log scale)')
    plt.title('Execution Time Growth with Number of Cities')
    plt.legend()

    # Use a logarithmic scale for the y-axis
    plt.yscale('log')

    plt.show()

# Modify compare_algorithms function to include visualization
def compare_algorithms(num_cities):
    graph = generate_random_graph(num_cities)

    # Nearest Neighbor Algorithm
    start_time = time.time()
    nearest_neighbor_tour = nearest_neighbor(graph)
    nn_execution_time = time.time() - start_time

    # Brute Force Algorithm
    start_time = time.time()
    brute_force_tour = brute_force(graph)
    bf_execution_time = time.time() - start_time

    # Christofides Algorithm
    start_time = time.time()
    christofides_tour = christofides_algorithm(graph)
    ch_execution_time = time.time() - start_time

    print(f"Number of cities: {num_cities}")
    print(f"Nearest Neighbor Execution Time: {nn_execution_time} seconds")
    print(f"Brute Force Execution Time: {bf_execution_time} seconds")
    print(f"Christofides Execution Time: {ch_execution_time} seconds")
    print()

    return num_cities, nn_execution_time, bf_execution_time, ch_execution_time

# Example usage for cities ranging from 10 to 20
results = []

for num_cities in range(4, 13):
    result = compare_algorithms(num_cities)
    results.append(result)

    # Print the result after each iterati


# Visualize the execution time growth
visualize_execution_time_growth([result[0] for result in results], [result[1:] for result in results])


# Function to visualize the execution time growth

# Example usage for cities ranging from 10 to 20
