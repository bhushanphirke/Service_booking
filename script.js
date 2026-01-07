document.addEventListener("DOMContentLoaded", () => {

  const cards = document.querySelectorAll(".service-card");

  cards.forEach(card => {
    card.addEventListener("mouseenter", () => {
      card.style.transform = "translateY(-12px)";
    });

    card.addEventListener("mouseleave", () => {
      card.style.transform = "translateY(0)";
    });
  });

});
