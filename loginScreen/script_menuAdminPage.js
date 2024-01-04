const liMenu = document.querySelectorAll(".menu_admin_li");
const divMenu = document.querySelectorAll("div");

for (let i = 0; i < liMenu.length; i++) {
  liMenu[i].addEventListener("mouseover", () => {
    divMenu[i].style.display = "block";
  });
  liMenu[i].addEventListener("mouseout", () => {
    divMenu[i].style.display = "none";
  });
}
