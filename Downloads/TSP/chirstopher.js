// Helper function to find the index of a node in a set of nodes
function euclideanDistance(point1, point2) {
  const dx = point1.x - point2.x;
  const dy = point1.y - point2.y;
  return Math.sqrt(dx * dx + dy * dy);
}

// Function to generate the distance matrix based on Euclidean distances
function getDistanceMatrix(points) {
  const n = points.length;
  const distances = Array.from({ length: n }, () => Array(n).fill(0));

  for (let i = 0; i < n; i++) {
    for (let j = i + 1; j < n; j++) {
      const distance = euclideanDistance(points[i], points[j]);
      distances[i][j] = distances[j][i] = distance;
    }
  }

  return distances;
}

// Helper function to find the index of a node in a set of nodes
function indexOfNode(set, node) {
  for (let i = 0; i < set.length; i++) {
    if (set[i] === node) {
      return i;
    }
  }
  return -1;
}
// Function to find the minimum spanning tree using Prim's algorithm
function minimumSpanningTree(distances) {
  const n = distances.length;
  const visited = new Array(n).fill(false);
  const treeEdges = [];

  // Start from the first node
  visited[0] = true;

  while (treeEdges.length < n - 1) {
    let minDistance = Number.MAX_VALUE;
    let minEdge = {};

    for (let i = 0; i < n; i++) {
      if (visited[i]) {
        for (let j = 0; j < n; j++) {
          if (!visited[j] && distances[i][j] < minDistance) {
            minDistance = distances[i][j];
            minEdge = { u: i, v: j, weight: minDistance };
          }
        }
      }
    }

    visited[minEdge.v] = true;
    treeEdges.push(minEdge);
  }

  return treeEdges;
}

// Function to find the minimum weight perfect matching using a greedy algorithm
function minimumWeightPerfectMatching(distances, treeEdges) {
  const n = distances.length;
  const matchingEdges = [];

  // Create a set of unmatched nodes
  const unmatchedNodes = Array.from({ length: n }, (_, i) => i);

  // Iterate through each edge in the minimum spanning tree
  treeEdges.forEach((edge) => {
    // Remove the nodes connected by the tree edge from the unmatched set
    unmatchedNodes.splice(indexOfNode(unmatchedNodes, edge.u), 1);
    unmatchedNodes.splice(indexOfNode(unmatchedNodes, edge.v), 1);

    // Add the tree edge to the matching
    matchingEdges.push(edge);
  });

  // Find the minimum weight edges for the remaining unmatched nodes
  while (unmatchedNodes.length > 1) {
    let minDistance = Number.MAX_VALUE;
    let minEdge = {};

    for (let i = 0; i < unmatchedNodes.length; i++) {
      for (let j = i + 1; j < unmatchedNodes.length; j++) {
        const u = unmatchedNodes[i];
        const v = unmatchedNodes[j];
        const distance = distances[u][v];

        if (distance < minDistance) {
          minDistance = distance;
          minEdge = { u, v, weight: minDistance };
        }
      }
    }

    // Remove the nodes connected by the matching edge from the unmatched set
    unmatchedNodes.splice(indexOfNode(unmatchedNodes, minEdge.u), 1);
    unmatchedNodes.splice(indexOfNode(unmatchedNodes, minEdge.v), 1);

    // Add the matching edge to the matching
    matchingEdges.push(minEdge);
  }

  return matchingEdges;
}

// Function to find an Eulerian circuit in the multigraph formed by the minimum spanning tree
// and the minimum weight perfect matching
function eulerianCircuit(graph) {
  const n = graph.length;
  const visitedEdges = Array(n).fill(false);
  const circuit = [];
  let current = 0;

  while (circuit.length < n * 2) {
    for (let i = 0; i < n; i++) {
      if (graph[i].u === current && !visitedEdges[i]) {
        visitedEdges[i] = true;
        circuit.push(graph[i].u, graph[i].v);
        current = graph[i].v;
      } else if (graph[i].v === current && !visitedEdges[i]) {
        visitedEdges[i] = true;
        circuit.push(graph[i].v, graph[i].u);
        current = graph[i].u;
      }
    }
  }

  return circuit;
}

function shortcutEulerianToHamiltonian(eulerianCircuit) {
  const n = eulerianCircuit.length / 2;
  const visited = new Array(n).fill(false);
  const hamiltonianCircuit = [];
  let current = 0; // Start from node 0

  visited[current] = true;
  hamiltonianCircuit.push(current);

  for (let i = 0; i < eulerianCircuit.length; i += 2) {
    const u = eulerianCircuit[i];
    const v = eulerianCircuit[i + 1];

    if (v === current && !visited[u]) {
      visited[u] = true;
      hamiltonianCircuit.push(u);
      current = u;
    } else if (u === current && !visited[v]) {
      visited[v] = true;
      hamiltonianCircuit.push(v);
      current = v;
    }
  }

  hamiltonianCircuit.push(hamiltonianCircuit[0]);

  return hamiltonianCircuit;
}

function christofidesAlgorithm(points) {
  const startTime = performance.now();

  const distances = getDistanceMatrix(points);
  const minimumSpanningTreeEdges = minimumSpanningTree(distances);
  const perfectMatchingEdges = minimumWeightPerfectMatching(
    distances,
    minimumSpanningTreeEdges
  );

  const combinedEdges = [...minimumSpanningTreeEdges, ...perfectMatchingEdges];

  const eulerianCircuitEdges = eulerianCircuit(combinedEdges);

  const hamiltonianCircuit =
    shortcutEulerianToHamiltonian(eulerianCircuitEdges);

  const endTime = performance.now();
  const executionTime = endTime - startTime;
  const numberOfNodes = points.length;

  return {
    hamiltonianCircuit,
    executionTime,
    numberOfNodes,
  };
}

const points = [
  { x: 0, y: 0 },
  { x: 1, y: 1 },
  { x: 2, y: 2 },
  { x: 3, y: 3 },
  { x: 4, y: 4 },
  { x: 5, y: 5 },
  { x: 6, y: 6 },
  { x: 7, y: 7 },
  { x: 8, y: 8 },
  { x: 9, y: 9 },
];

const result = christofidesAlgorithm(points);
console.log("Christofides Result:", result.hamiltonianCircuit);
console.log("Execution Time:", result.executionTime, "ms");
console.log("Number of Nodes:", result.numberOfNodes);
