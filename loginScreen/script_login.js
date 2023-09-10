const btnRegister = document.querySelector(".btn_register");

btnRegister.addEventListener("click", () => {
  const login = document.querySelector(".login_enter");
  const register = document.querySelector(".register");
  login.style.display = "none";
  register.style.display = "flex";
});

const btnLogin = document.querySelector(".btn_login");

btnLogin.addEventListener("click", () => {
  const login = document.querySelector(".login_enter");
  const register = document.querySelector(".register");
  login.style.display = "flex";
  register.style.display = "none";
});
