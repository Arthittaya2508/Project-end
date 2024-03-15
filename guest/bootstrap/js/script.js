document.getElementById("loginBtn").addEventListener("click", function () {
  document.getElementById("loginModal").style.display = "block";
});

document
  .getElementsByClassName("close")[0]
  .addEventListener("click", function () {
    document.getElementById("loginModal").style.display = "none";
  });

window.addEventListener("click", function (event) {
  if (event.target == document.getElementById("loginModal")) {
    document.getElementById("loginModal").style.display = "none";
  }
});
