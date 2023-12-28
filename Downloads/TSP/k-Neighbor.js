function euclideanDistance(point1, point2) {
  const dx = point1.x - point2.x;
  const dy = point1.y - point2.y;
  return Math.sqrt(dx * dx + dy * dy);
}

function kNearestNeighbors(points, k) {
  const n = points.length;
  const visited = new Array(n).fill(false);
  const path = [];
  let current = 0;
  visited[current] = true;
  path.push(current);

  for (let step = 1; step < n; step++) {
    let minDistance = Number.MAX_VALUE;
    let nextNode = -1;

    for (let neighbor = 0; neighbor < n; neighbor++) {
      if (!visited[neighbor]) {
        const distance = euclideanDistance(points[current], points[neighbor]);
        if (distance < minDistance) {
          minDistance = distance;
          nextNode = neighbor;
        }
      }
    }

    // Move to the next node
    visited[nextNode] = true;
    path.push(nextNode);
    current = nextNode;
  }

  return path;
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
  { x: 10, y: 10 },
  { x: 11, y: 11 },
  { x: 12, y: 12 },
  { x: 13, y: 13 },
  { x: 14, y: 14 },
  { x: 15, y: 15 },
];

const k = 2;

const startTime = performance.now();
const kNNPath = kNearestNeighbors(points, k);
const endTime = performance.now();
const executionTime = endTime - startTime;

console.log("k-NN Path:", kNNPath);
console.log("Total Distance:", calculateTotalDistance(points, kNNPath));
console.log("Execution Time:", executionTime, "ms");

function calculateTotalDistance(points, path) {
  let totalDistance = 0;
  for (let i = 0; i < path.length - 1; i++) {
    totalDistance += euclideanDistance(points[path[i]], points[path[i + 1]]);
  }
  return totalDistance;
}
