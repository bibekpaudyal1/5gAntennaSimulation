var matrix_costs = [
  [0, 4, 2, 1, 3, 5, 6, 8, 9, 2, 4, 6, 7, 1, 3],
  [4, 0, 7, 3, 1, 5, 2, 9, 4, 7, 2, 8, 3, 6, 5],
  [2, 7, 0, 3, 0, 7, 1, 4, 6, 8, 3, 5, 2, 9, 1],
  [1, 3, 3, 0, 4, 6, 7, 2, 1, 5, 8, 9, 4, 1, 6],
  [3, 1, 0, 4, 0, 5, 3, 8, 2, 4, 7, 6, 9, 2, 1],
  [5, 5, 7, 6, 5, 0, 4, 3, 6, 1, 8, 2, 1, 7, 9],
  [6, 2, 1, 7, 3, 4, 0, 1, 5, 9, 2, 6, 3, 8, 4],
  [8, 9, 4, 2, 8, 3, 1, 0, 7, 4, 5, 1, 6, 2, 3],
  [9, 4, 6, 1, 2, 6, 5, 7, 0, 8, 9, 3, 5, 4, 2],
  [2, 7, 8, 5, 4, 1, 9, 4, 8, 0, 6, 7, 2, 3, 1],
  [4, 2, 3, 8, 7, 8, 2, 5, 9, 6, 0, 4, 1, 7, 3],
  [6, 8, 5, 9, 6, 2, 6, 1, 3, 7, 4, 0, 8, 5, 4],
  [7, 3, 2, 4, 9, 1, 3, 6, 5, 2, 1, 8, 0, 4, 7],
  [1, 6, 9, 1, 2, 7, 8, 2, 4, 3, 7, 5, 4, 0, 6],
  [3, 5, 1, 6, 1, 9, 4, 3, 2, 1, 3, 4, 7, 6, 0],
];

var nbNodes = 15;
var costs;
var minCost = 0;
var indMinCost;

function combinations(inputArr) {
  var results = [];

  function permute(arr, memo) {
    var cur,
      memo = memo || [];

    for (var i = 0; i < arr.length; i++) {
      cur = arr.splice(i, 1);
      if (arr.length === 0) {
        results.push(memo.concat(cur));
      }
      permute(arr.slice(), memo.concat(cur));
      arr.splice(i, 0, cur[0]);
    }
    return results;
  }
  return permute(inputArr);
}

function initialize(nbN) {
  var t = new Array();
  comb = new Array();

  for (var i = 1; i < nbN; i++) {
    t[i - 1] = i;
  }
  comb = combinations(t);
}

function calculateCosts(nbN) {
  costs = new Array();

  for (var i = 0; i < comb.length; i++) {
    costs[i] = matrix_costs[0][comb[i][0]];

    for (var j = 1; j < nbN - 1; j++) {
      costs[i] += matrix_costs[comb[i][j - 1]][comb[i][j]];
    }
    costs[i] += matrix_costs[comb[i][nbN - 2]][0];
  }
}

function minCosts() {
  indMinCost = 0;
  minCost = costs[0];
  for (var i = 0; i < costs.length; i++) {
    if (costs[i] < minCost) {
      minCost = costs[i];
      indMinCost = i;
    }
  }
}

function resolveExponential() {
  var t0 = performance.now();

  if (matrix_costs.length == 0 || nbNodes == 0)
    alert("number nodes = 0, or matrix_costs empty");
  else {
    initialize(nbNodes);
    calculateCosts(nbNodes);
    minCosts();
    var optimalPath = getPath(indMinCost, nbNodes);

    console.log("Optimal Path:", optimalPath);
    console.log("Minimum Cost:", minCost);
    console.log("Index of Minimum Cost:", indMinCost);
    console.log("Execution Time:", "exp" + (performance.now() - t0));
  }
}

function getPath(index, nbNodes) {
  var path = [0];
  var perm = comb[index];

  for (var i = 0; i < nbNodes - 1; i++) {
    path.push(perm[i]);
  }

  path.push(0);
  return path;
}

resolveExponential();
