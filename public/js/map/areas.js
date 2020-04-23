const loadData = (page) => {
  myChart.showLoading();
  axios.get('/api/areas?page=' + page)
    .then(res => {
      data.areas = [...data.areas, ...res.data.data];
      data.currentPage = res.data.current_page;
      data.lastPage = res.data.last_page;
      data.total = res.data.total;
      data.chart = false;

      if (data.currentPage < data.lastPage) {
        loadData(data.currentPage + 1);
      } else {
        localStorage.setItem('areas', JSON.stringify(data.areas));
        data.chart = true;
      }
    });
};

const loadDataFromStorage = () => {
  myChart.showLoading();
  let areas = JSON.parse(localStorage.getItem('areas'));
  data.areas = areas;
  data.chart = true;
};

const fetchAreaData = () => { 
  (!localStorage.getItem('areas'))
    ? loadData(data.currentPage)
    : loadDataFromStorage();
};
fetchAreaData();