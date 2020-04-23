var filterBy = {
  province: 0,
  country: 0,
  type: 0,
  tree: 0
};

let url = new URL(window.location.href);
let searchParams = new URLSearchParams(url.search);
let params = searchParams.get('params');

if (params) {
  let param = params.split("-");

  filterBy.province = param[0];
  filterBy.country = param[1];
  filterBy.type = param[2];
  filterBy.tree = param[3];
}