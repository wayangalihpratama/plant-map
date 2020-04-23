const loadTypes = (page) => {
  axios.get('/api/types?page=' + page)
    .then(res => {
      typeData.types = [...typeData.types, ...res.data.data];
      typeData.currentPage = res.data.current_page;
      typeData.lastPage = res.data.last_page;
      typeData.total = res.data.total;

      if (typeData.currentPage < typeData.lastPage) {
        loadTypes(typeData.currentPage + 1);
      } else {
        localStorage.setItem('types', JSON.stringify(typeData.types));
      }
    });
};

const loadTypesFromStorage = () => {
  let types = JSON.parse(localStorage.getItem('types'));
  typeData.types = types;
};

const fetchTypeData = () => { 
  (!localStorage.getItem('types'))
    ? loadTypes(typeData.currentPage)
    : loadTypesFromStorage();
};
fetchTypeData();