const btnAdd = document.querySelector(".btn_add");
const btnDelete = document.querySelector(".btn_delete");

btnAdd.addEventListener("click", () => {
  const containerFormAdd = document.querySelector(".container_form_add");
  containerFormAdd.style.display = "block";
  const containerFormDelete = document.querySelector(".container_form_delete");
  containerFormDelete.style.display = "none";
});

btnDelete.addEventListener("click", () => {
  const containerFormAdd = document.querySelector(".container_form_add");
  containerFormAdd.style.display = "none";
  const containerFormDelete = document.querySelector(".container_form_delete");
  containerFormDelete.style.display = "block";
});
