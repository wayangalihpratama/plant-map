const getCountries = (locData) => {
  let countries = [];
  locData.map((item) => {
    item.childrens.map(x => {
      countries.push(x);
    });
  });

  return countries;
};

const getCountryCarbonData = (item) => { 
  let countryCarbon = [];
  let total_carbon = 0;

  data.areas.filter(x => {
    if (x.location_id === item.id) {
      x.area_trees.map(y => {
        countryCarbon.push(parseFloat(y.total_carbon));
      });
    }
  });

  total_carbon = countryCarbon.reduce((total, num) => {
    return total + num;
  });

  return total_carbon;
};


const convertCountryData = (locData) => {
  let countries = getCountries(locData);
  let countryName = [];
  let countryValue = [];

  countries.map(item => {
    if (filterBy.province != 0) {
      if (item.parent_id == filterBy.province) {
        countryName.push(item.name);
        countryValue.push(getCountryCarbonData(item));
      }
    }

    if (filterBy.province == 0) {
      countryName.push(item.name);
      countryValue.push(getCountryCarbonData(item));
    }
  });

  return { countryName, countryValue };
};

const showBarChart = (data) => {
  let barData = convertCountryData(data);
  barChart.hideLoading();
  
  barChart.setOption({
    title: {
      text: 'Carbon Offset by Country',
      subtext: 'Total carbon offset by country',
      left: 'center'
    },
    tooltip: {
      trigger: 'item'
    },
    xAxis: {
      type: 'category',
      data: barData.countryName
    },
    yAxis: {
      type: 'value'
    },
    series: [
      {
        name: 'Carbon Offset',
        data: barData.countryValue,
        type: 'bar'
      }
    ]
  });
};

(locationData.chart) ? showBarChart(locationData.locations) : null;