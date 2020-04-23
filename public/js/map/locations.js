const loadLocations = (page) => {
  pieChart.showLoading();
  barChart.showLoading();
  axios.get('/api/locations?page=' + page)
    .then(res => {
      locationData.locations = [...locationData.locations, ...res.data.data];
      locationData.currentPage = res.data.current_page;
      locationData.lastPage = res.data.last_page;
      locationData.total = res.data.total;
      locationData.chart = false;

      if (locationData.currentPage < locationData.lastPage) {
        loadLocations(locationData.currentPage + 1)
      } else {
        localStorage.setItem('locations', JSON.stringify(locationData.locations));
        locationData.chart = true;
      }
    });
};

const loadLocationsFromStorage = () => {
  pieChart.showLoading();
  barChart.showLoading();
  let locations = JSON.parse(localStorage.getItem('locations'));
  locationData.locations = locations;
  locationData.chart = true;
};

const fetchLocationData = () => { 
  (!localStorage.getItem('locations'))
    ? loadLocations(locationData.currentPage)
    : loadLocationsFromStorage();
};
fetchLocationData();