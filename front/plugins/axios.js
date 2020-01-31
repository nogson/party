export default ({ $axios }) => {
  $axios.setHeader("X-Requested-With", "XMLHttpRequest");
}