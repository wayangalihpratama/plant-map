const loadTrees = (page) => {
  axios.get('/api/trees?page=' + page)
    .then(res => {
      treeData.trees = [...treeData.trees, ...res.data.data];
      treeData.currentPage = res.data.current_page;
      treeData.lastPage = res.data.last_page;
      treeData.total = res.data.total;

      if (treeData.currentPage < treeData.lastPage) {
        loadTrees(treeData.currentPage + 1);
      } else {
        localStorage.setItem('trees', JSON.stringify(treeData.trees));
      }
    });
};

const loadTreesFromStorage = () => {
  let trees = JSON.parse(localStorage.getItem('trees'));
  treeData.trees = trees;
};

const fetchTreeData = () => {
  (!localStorage.getItem('trees'))
    ? loadTrees(treeData.currentPage)
    : loadTreesFromStorage();
};
fetchTreeData();
