const valueSelectBrand = document.querySelector("#brand");
const valueSelectModel = document.querySelectorAll("#model option");

valueSelectBrand.addEventListener("change", () => {
  valueSelectModel.forEach((model) => {
    if (valueSelectBrand.value == model.dataset.idbrand) {
      model.style.display = "";
    } else {
      model.style.display = "none";
    }
  });
});
