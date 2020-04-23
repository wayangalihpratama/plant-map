// initialize echarts instance with prepared DOM
const pieChart = echarts.init(document.getElementById('pie'));
const barChart = echarts.init(document.getElementById('pieCountry'));
const myChart = echarts.init(document.getElementById('main'));

// Global Variabel
var data = {
  areas: [],
  currentPage: 1,
  lastPage: 0,
  total: 0,
  chart: false,
};

var locationData = {
  locations: [],
  currentPage: 1,
  lastPage: 0,
  total: 0,
  chart: false,
};

var treeData = {
  trees: [],
  currentPage: 1,
  lastPage: 0,
  total: 0,
};

var typeData = {
  types: [],
  currentPage: 1,
  lastPage: 0,
  total: 0,
};