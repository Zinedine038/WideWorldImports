<script>
    function showResult(str) {
        if (str.length == 0) {
            document.getElementById("livesearch").innerHTML = "";
            document.getElementById("livesearch").style.border = "0px";
            return;
        }
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {  // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            // Deze functie wordt alleen aangeroepen als zijn status veranderd.
            if (this.readyState == 4 && this.status == 200) {
                // Geeft alleen resultaat als het verzoek om informatie te krijgen gelukt is aan de client-kant en server-kant.
                document.getElementById("livesearch").innerHTML = this.responseText;
                // Zet het resultaat van de zoekopdracht in de (zichtbare) zoekbalk.
                document.getElementById("livesearch").style.border = "1px solid #76eec6";
                // Geeft de resultatenbalk een rand eromheen.
            }
        }
        // Stuur het resultaat door naar de pagina livesearch.php
        xmlhttp.open("GET", "livesearch.php?q=" + str, true);
        xmlhttp.send();
    }
</script>

<div class="md-form">
    <input class="form-control" type="text" size="30" onkeyup="showResult(this.value)" placeholder="Zoeken"
           aria-label="Search">
    <div id="livesearch"></div>
</div>