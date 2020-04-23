const createDefaultOption = (value, text) => {
  let option = document.createElement('option');
  option.value = value;
  option.textContent = text;

  return option;
};

const selectProvince = document.getElementById('filterProvince');
const optionProvince = (locData) => {
  locData.map(item => {
    selectProvince.appendChild(createDefaultOption(item.id, item.name));
  });
};
optionProvince(locationData.locations);


const selectCountry = document.getElementById('filterCountry');
const optionCountry = (locData) => { 
  let countries = getCountries(locData);

  if (filterBy.province != 0) {
    countries.filter(item => {
      if (item.parent_id == filterBy.province) { 
        selectCountry.appendChild(createDefaultOption(item.id, item.name));
      }
    }); 
  } else {
    countries.map(item => {
      selectCountry.appendChild(createDefaultOption(item.id, item.name));
    });
  }
};
optionCountry(locationData.locations);

const selectType = document.getElementById('filterType');
const optionType = (datas) => {
  datas.map(item => {
    selectType.appendChild(createDefaultOption(item.id, item.name));
  });
};
optionType(typeData.types);

const selectTree = document.getElementById('filterTree');
const optionTree = (datas) => {
  if (filterBy.type != 0) {
    datas.filter(item => {
      if (item.type_id == filterBy.type) { 
        selectTree.appendChild(createDefaultOption(item.id, item.name));
      }
    }); 
  } else {
    datas.map(item => {
      selectTree.appendChild(createDefaultOption(item.id, item.name));
    });
  }
};
optionTree(treeData.trees);

const filterProvinceOnChange = (value) => {
  filterBy.province = value;
  selectCountry.options.length = 0;
  selectCountry.appendChild(createDefaultOption("0", "Default"));
  optionCountry(locationData.locations);
  filterChartData();
};

const filterCountryOnChange = (value) => {
  filterBy.country = value;
  filterChartData();
};

const filterTypeOnChange = (value) => {
  filterBy.type = value;
  selectTree.options.length = 0;
  selectTree.appendChild(createDefaultOption("0", "Default"));
  optionTree(treeData.trees);
  filterChartData();
};

const filterTreeOnChange = (value) => {
  filterBy.tree = value;
  filterChartData();
};

const filterChartData = () => {
  const { province, country, type, tree } = filterBy;
  let params = "filter?params=" + province + "-" + country + "-" + type + "-" + tree;
  window.location = "http://plantmap.localhost/" + params;
};

// Select Option selected
selectProvince.value = filterBy.province;
selectCountry.value = filterBy.country;
selectType.value = filterBy.type;
selectTree.value = filterBy.tree;