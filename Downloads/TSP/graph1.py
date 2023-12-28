import networkx as nx
import matplotlib.pyplot as plt

# Create a graph
graph = nx.Graph()
graph.add_edges_from([
    ('A', 'B'), ('A', 'C'), ('B', 'D'), ('B', 'E'), ('C', 'F'), ('E', 'F')
])

def maximal_independent_set(graph):
    sorted_vertices = sorted(graph, key=lambda x: len(graph[x]))
    independent_set = set()

    for vertex in sorted_vertices:
        if vertex not in independent_set and all(neighbour not in independent_set for neighbour in graph[vertex]):
            independent_set.add(vertex)

    return independent_set

# Find a maximal independent set
mis = maximal_independent_set(graph)

print(f"Maximal Independent Set: {mis}")

# Draw the graph
pos = nx.spring_layout(graph)
nx.draw_networkx(graph, pos, with_labels=True)

# Highlight nodes in maximal independent set
nx.draw_networkx_nodes(graph, pos, nodelist=mis, node_color='r')

plt.show()
