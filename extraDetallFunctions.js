function GenerateBars(){
    var hpBarContainer = document.getElementById("hpBar");
    var atkBarContainer = document.getElementById("atkBar");
    var defBarContainer = document.getElementById("defBar");
    var spatkBarContainer = document.getElementById("spatkBar");
    var spdefBarContainer = document.getElementById("spdefBar");
    var spdBarContainer = document.getElementById("spdBar");

    
    function getBarColor(width)
    {
        if(width < 10)
            return "red";
        else if(width < 20)
            return "#FAAC58";
        else if(width < 32)
            return "#F7D358";
        else if(width < 40)
            return "#F4FA58"
        else if(width < 50)
            return "#D9F763"
        else if(width < 60)
            return "#A6D050"
        else if(width < 70)
            return "#6EBC46"
        else if(width < 80)
            return "#4AA940"
        else if(width < 90)
            return "#3A9B37"
        else if(width < 100)
            return "#308530"
        else if(width == 100)
            return "#216E26"
    }

    var hpBar = document.createElement("div");
    var hpValue = parseInt(document.getElementById("hpValue").textContent);
    const percentageHp = (hpValue / 255) * 100;
    hpBar.className = "innerStatsBar";
    hpBar.style.width = percentageHp + "%";
    hpBar.style.backgroundColor = getBarColor(percentageHp);


    var atkBar = document.createElement("div");
    var atkValue = parseInt(document.getElementById("atkValue").textContent);
    const percentageAtk = (atkValue / 255) * 100;
    atkBar.className = "innerStatsBar";
    atkBar.style.width = percentageAtk + "%";
    atkBar.style.backgroundColor = getBarColor(percentageAtk);

    var defBar = document.createElement("div");
    var defValue = parseInt(document.getElementById("defValue").textContent);
    const percentageDef = (defValue / 255) * 100;
    defBar.className = "innerStatsBar";
    defBar.style.width = percentageDef + "%";
    defBar.style.backgroundColor = getBarColor(percentageDef);

    var spAtkBar = document.createElement("div");
    var spAtkValue = parseInt(document.getElementById("spatkValue").textContent);
    const percentageSpAtk = (spAtkValue / 255) * 100;
    spAtkBar.className = "innerStatsBar";
    spAtkBar.style.width = percentageSpAtk + "%";
    spAtkBar.style.backgroundColor = getBarColor(percentageSpAtk);

    var spDefBar = document.createElement("div");
    var spDefValue = parseInt(document.getElementById("spdefValue").textContent);
    const percentageSpDef = (spDefValue / 255) * 100;
    spDefBar.className = "innerStatsBar";
    spDefBar.style.width = percentageSpDef + "%";
    spDefBar.style.backgroundColor = getBarColor(percentageSpDef);

    var spdBar = document.createElement("div");
    var spdValue = parseInt(document.getElementById("spdValue").textContent);
    const percentageSpd = (spdValue / 255) * 100;
    spdBar.className = "innerStatsBar";
    spdBar.style.width = percentageSpd + "%";
    spdBar.style.backgroundColor = getBarColor(percentageSpd);
   
    hpBarContainer.appendChild(hpBar);
    atkBarContainer.appendChild(atkBar);
    defBarContainer.appendChild(defBar);
    spatkBarContainer.appendChild(spAtkBar);
    spdefBarContainer.appendChild(spDefBar);
    spdBarContainer.appendChild(spdBar);
}



function setButtonClicks(){
    var backButton = document.getElementById("backButton");
    var serebiiButton = document.getElementById("serebiiButton");


    const urlParams = new URLSearchParams(window.location.search);          
    const currentPokemon = urlParams.get('pokemon');

    var serebiiHref = "https://www.serebii.net/pokedex-swsh/" + currentPokemon;

    serebiiButton.addEventListener("click", function() {
         window.location.href = serebiiHref;
    });

    backButton.addEventListener("click", function() {
         window.history.back();    
    });



}