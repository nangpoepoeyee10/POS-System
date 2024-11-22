const toggleBtn = document.querySelector(".toggle-btn");


document.querySelector("#sidebar").classList.toggle("expand");
  toggleBtn.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("unexpand");
});

// const sidelink= document.querySelector(".sidebar-nav");

// sidelink.addEventListener("click", function (event) {
//     event.preventDefault();
// });
