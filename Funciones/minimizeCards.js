   /* MINIMIZAR LA CARD  */

   document.addEventListener("DOMContentLoaded", function () {
    var cardHeaders = document.querySelectorAll(".card-header");
  
    cardHeaders.forEach(function (header) {
      var arrow = header.querySelector(".arrow");
      var cardContent = header.parentElement.querySelector(".cardContent");
  
      // Establece la rotación inicial hacia abajo
      arrow.style.transform = "rotate(90deg)";
  
      header.addEventListener("click", function () {
        cardContent.classList.toggle("minimized");
        arrow.style.transform = cardContent.classList.contains("minimized") ? "rotate(0deg)" : "rotate(90deg)";
      });
    });
  });
  
  