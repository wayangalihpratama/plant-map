const getAreaCarbonData = (item) => {
  let carbons = [];
  let total_carbon = 0;

  carbons = item.area_trees.map((item, index) => {
    return parseFloat(item.total_carbon);
  });
  
  total_carbon = carbons.reduce((total, num) => {
    return total + num;
  });

  return total_carbon;
};

const convertData = (data) => {
  let mapData = [];
  
  if (filterBy.province != 0) {
    let countries = getCountries(locationData.locations);
    countries.filter(country => {
      if (country.parent_id == filterBy.province) {
        data.map((item, index) => {
          if (item.location_id == country.id) {
            mapData.push({
              name: item.name,
              value: [
                ...item.geometry.coordinates,
                getAreaCarbonData(item)
              ]
            });
          }
        });
      };     
    });
  }

  if (filterBy.province == 0) {
    data.map((item, index) => {
      mapData.push({
        name: item.name,
        value: [
          ...item.geometry.coordinates,
          getAreaCarbonData(item)
        ]
      });
    });
  }

  return mapData;
};

const showChart = (data) => {
  myChart.hideLoading();          
  // draw chart
  myChart.setOption({
    title: {
      text: 'Carbon Offet by Plantation',
      subtext: 'In All Area',
      left: 'center'
    },
    tooltip : {
      trigger: 'item'
    },
    bmap: {
      center: [50.114129, 37.550339],
      zoom: 5,
      roam: false,
      mapStyle: {
        styleJson: [
          {
            'featureType': 'water',
            'elementType': 'all',
            'stylers': {
                'color': '#d1d1d1'
            }
          }, 
          {
            'featureType': 'land',
            'elementType': 'all',
            'stylers': {
                'color': '#f3f3f3'
            }
          }, 
          {
            'featureType': 'railway',
            'elementType': 'all',
            'stylers': {
                'visibility': 'off'
            }
          }, 
          {
            'featureType': 'highway',
            'elementType': 'all',
            'stylers': {
                'color': '#fdfdfd'
            }
          }, 
          {
            'featureType': 'highway',
            'elementType': 'labels',
            'stylers': {
                'visibility': 'off'
            }
          }, 
          {
            'featureType': 'arterial',
            'elementType': 'geometry',
            'stylers': {
                'color': '#fefefe'
            }
          }, 
          {
            'featureType': 'arterial',
            'elementType': 'geometry.fill',
            'stylers': {
                'color': '#fefefe'
            }
          }, 
          {
            'featureType': 'poi',
            'elementType': 'all',
            'stylers': {
                'visibility': 'off'
            }
          }, 
          {
            'featureType': 'green',
            'elementType': 'all',
            'stylers': {
                'visibility': 'off'
            }
          }, 
          {
            'featureType': 'subway',
            'elementType': 'all',
            'stylers': {
                'visibility': 'off'
            }
          }, 
          {
            'featureType': 'manmade',
            'elementType': 'all',
            'stylers': {
                'color': '#d1d1d1'
            }
          }, 
          {
            'featureType': 'local',
            'elementType': 'all',
            'stylers': {
                'color': '#d1d1d1'
            }
          }, 
          {
            'featureType': 'arterial',
            'elementType': 'labels',
            'stylers': {
                'visibility': 'off'
            }
          }, 
          {
            'featureType': 'boundary',
            'elementType': 'all',
            'stylers': {
                'color': '#fefefe'
            }
          }, 
          {
            'featureType': 'building',
            'elementType': 'all',
            'stylers': {
                'color': '#d1d1d1'
            }
          }, 
          {
            'featureType': 'label',
            'elementType': 'labels.text.fill',
            'stylers': {
                'color': '#999999'
            }
          }
        ]
      }
    },
    series: [
      {
        name: 'Carbon Offset',
        type: 'scatter',
        coordinateSystem: 'bmap',
        data: convertData(data),
        symbolSize: function (val) {
          return val[2] / 800;
        },
        label: {
          formatter: '{b}',
          position: 'right',
          show: false
        },
        itemStyle: {
          color: 'purple'
        },
        emphasis: {
          label: {
            show: true
          }
        }
      }
    ]
  });
};

(data.chart) ? showChart(data.areas) : null;
