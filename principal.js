let isDragging = false;
let startY;
let scrollTop;
const pokeballImage = document.querySelector('.pokeball img');
const pokemonList = document.querySelector('.pokemonlist');
window.selectedPokemon = "bulbasaur";

pokemonList.addEventListener('mousedown', (e) => {
  isDragging = true;
  startY = e.pageY - pokemonList.offsetTop;
  scrollTop = pokemonList.scrollTop;
});

pokemonList.addEventListener('mouseleave', () => {
  isDragging = false;
});

pokemonList.addEventListener('mouseup', () => {
  isDragging = false;
});

pokemonList.addEventListener('mousemove', (e) => {
  if (!isDragging) return;
  e.preventDefault();
  const y = e.pageY - pokemonList.offsetTop;
  const walk = (y - startY) * 1; // Adjust scroll speed
  pokemonList.scrollTop = scrollTop - walk;
});

// Touch events for mobile devices
pokemonList.addEventListener('touchstart', (e) => {
  isDragging = true;
  startY = e.touches[0].pageY - pokemonList.offsetTop;
  scrollTop = pokemonList.scrollTop;
});

pokemonList.addEventListener('touchend', () => {
  isDragging = false;
});

pokemonList.addEventListener('touchmove', (e) => {
  if (!isDragging) return;
  e.preventDefault();
  const y = e.touches[0].pageY - pokemonList.offsetTop;
  const walk = (y - startY) * 1;
  pokemonList.scrollTop = scrollTop - walk;
});


document.addEventListener('DOMContentLoaded', () => {
  const pokemonList = document.querySelector('.pokemonlist');
  const pokeballImage = document.querySelector('.pokeball img');
  const chk = document.querySelector('.checkbutton');

  const urlParams = new URLSearchParams(window.location.search);

  chk.addEventListener('click', () => {
    document.getElementById("button-press").play() ;
    const pokemon = window.selectedPokemon;
    if (pokemon) {
      // Load the page with the requested pokemon
      window.location.href = `PantallaDetall.php?pokemon=${pokemon}`;
    } else {
      console.log('No pokemon parameter in URL');
    }

    //carreguem la pagina amb el pokemon demanat
    window.location.href = `PantallaDetall.php?pokemon=${pokemon}`;
  });
  
  pokemonList.addEventListener('scroll', () => {
    const scrollPosition = pokemonList.scrollTop;

    // Calculate the rotation based on the current scroll position
    const rotationDegree = (scrollPosition / 3); // Wrap around to 0 after 360 degrees

    // Apply the rotation to the pokeball image
    pokeballImage.style.transform = `rotate(${rotationDegree}deg)`;

    console.log("Scroll Position:", scrollPosition, "Rotation:", rotationDegree);
  });
});

