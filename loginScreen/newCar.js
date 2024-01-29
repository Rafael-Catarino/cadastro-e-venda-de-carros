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

// Muda dinamicamente o nome da imagem no input file.
document.querySelector("#photograph1").addEventListener("change", (event) => {
  document.querySelector(".label_photograph1").textContent =
    event.target.files[0].name;
});

document.querySelector("#photograph2").addEventListener("change", (event) => {
  document.querySelector(".label_photograph2").textContent =
    event.target.files[0].name;
});
