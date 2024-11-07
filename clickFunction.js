// Get all div elements with class 'item'
const divs = document.querySelectorAll('.grid-item');
var pkmName = '';

// Add event listeners to each div
divs.forEach(div => {
    div.addEventListener('click', function() {
        // Get the text content of the clicked div
        const text = this.textContent.toLowerCase();

        // Encode the text to safely use it in the URL
        const encodedText = encodeURIComponent(text);
        pkmName = encodedText;

        // Redirect to another page with the text as a GET parameter
    });
});




window.location.href = `PantallaDetall.php?pokemon=${pkmName}`;
