function SetDivsClick(){
    const container = document.querySelector(".actualsprite");
    const divs = document.querySelectorAll('.grid-item');
    divs.forEach(div => {
        div.addEventListener('click', function() {
            const text = this.textContent.toLowerCase();
  
            const encodedText = encodeURIComponent(text);
            var apiUrl = "https://pokeapi.co/api/v2/pokemon/" + encodedText;
            window.selectedPokemon = encodedText;
            async function getPokemonData (){
                const response = await fetch(apiUrl);
                if(!response.ok) throw new Error("No response");
                const data = await response.json();
  
                container.innerHTML = "";
                const img = document.createElement('img');
                var imgLink = data.sprites.front_default;
                if(imgLink == null)
                    imgLink = data.sprites.other["official-artwork"].front_default;
                img.src = imgLink;
                img.alt = data.name + " front image";
                container.appendChild(img);
            }
            getPokemonData();
        });
    });    
  }

  function LoadFirstPokemonSprite(){
    const container = document.querySelector(".actualsprite");
    const img = document.createElement('img');
    const firstPokemon = document.querySelector('.grid-item');
    fetch("https://pokeapi.co/api/v2/pokemon/" + firstPokemon.textContent.toLowerCase())
        .then(response => response.json())
        .then(data => img.src = data.sprites.front_default)
        .then(container.appendChild(img))
        .catch(error => console.error('Error:', error));
  }

  function PlayClickSound(){  
    const chk = document.getElementById("informationButton");
    
    chk.addEventListener('click', () => {
        var audio = document.getElementById("button-press");
        audio.volume = .5;
    });
  }
  
  function SetCheckPokemonClick(){
      const chk = document.getElementById("informationButton");
    
      chk.addEventListener('click', () => {
        const pokemon = window.selectedPokemon;
        if (pokemon) {
            window.location.href = `PantallaDetall.php?pokemon=${pokemon}`;
        } else {
          console.log('No pokemon parameter in URL');
        }
      });
  }
  
  
  function SetSearcherClick(){
  
      var searchButtonDiv = document.getElementById("searchButtonDiv")
      var searchButton =document.getElementById("searchButton");
      searchButtonDiv.addEventListener('click', function() {
          document.getElementById("button-press").play() ;
  
          var inputValue = document.getElementById("pokemonSearcher").value.trim();
          var newHref = `principal.php?searchBy=${encodeURIComponent(inputValue)}`;
          
          const urlParams = new URLSearchParams(window.location.search);
          
          const currentPokemon = urlParams.get('searchBy');
  
          if(!(!currentPokemon && inputValue==""))
          {
              if (inputValue && inputValue !== currentPokemon) {
                setTimeout(() => {
                    // Use replaceState to update the URL without adding a new history entry
                    history.replaceState(null, '', newHref);
                    window.location.href = newHref;
                  }, 750);
              } else if (!inputValue) {
                setTimeout(() => {
                    history.replaceState(null, '', 'principal.php');
                    window.location.href = 'principal.php';
                  }, 750);
              }
              
          }
      });
      searchButtonDiv.addEventListener('mousedown', function() {
          searchButton.src = "./res/searchbuttonpressed.png";
      });
      searchButtonDiv.addEventListener('mouseup', function() {
          searchButton.src = "./res/searchbutton.png";
      });
  }
  function SetCurrentSearchValue(){
      const searcherInput =document.getElementById("pokemonSearcher");
                  
      const urlParams = new URLSearchParams(window.location.search);
  
      const currentPokemon = urlParams.get('searchBy');
      if(currentPokemon !== ""){
          searcherInput.value =currentPokemon;
      }
  }