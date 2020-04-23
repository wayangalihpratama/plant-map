const getProvinceCarbonData = (item) => {
  let provinceCarbon = [];
  let total_carbon = 0;

  item.childrens.map(x => {
    data.areas.filter(y => {
      if (y.location_id === x.id) { 
        y.area_trees.map(z => {
          provinceCarbon.push(parseFloat(z.total_carbon));
        });
      }
    });
  });

  total_carbon = provinceCarbon.reduce((total, num) => {
    return total + num;
  });

  return total_carbon;
};

const convertProvinceData = (locData) => {
  let provinceData = [];

  locData.map((item, index) => {
    if (filterBy.province != 0) {
      if (item.id == filterBy.province) {
        provinceData.push({
          value: getProvinceCarbonData(item),
          name: item.name
        });
      }
    }

    if (filterBy.province == 0) {
      provinceData.push({
        value: getProvinceCarbonData(item),
        name: item.name
      });
    }
  });

  return provinceData
};

const showPieChart = (data) => {
  pieChart.hideLoading();
  pieChart.setOption({
    title: {
      text: 'Carbon Offset by Province',
      subtext: 'Total carbon offset by province',
      left: 'center'
    },
    tooltip: {
      trigger: 'item',
      formatter: '{a} <br/>{b}: {c} ({d}%)'
    },
    series: [
      {
        name: 'Carbon Offset',
        type: 'pie',
        radius: ['35%', '70%'],
        avoidLabelOverlap: false,
        label: {
          show: false,
          position: 'center'
        },
        emphasis: {
          label: {
            show: true,
            fontSize: '13',
            fontWeight: 'bold'
          }
        },
        labelLine: {
          show: false
        },
        data: convertProvinceData(data)
      }
    ]
  });
};

(locationData.chart) ? showPieChart(locationData.locations) : null;

console.log(filterBy);