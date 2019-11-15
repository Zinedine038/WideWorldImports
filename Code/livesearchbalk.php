<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zoek product</title>
    <script>
        function showResult(str) {
            if (str.length==0) {
                document.getElementById("livesearch").innerHTML="";
                document.getElementById("livesearch").style.border="0px";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function() { 
                    // Deze functie wordt alleen aangeroepen als zijn status veranderd.
                if (this.readyState==4 && this.status==200) {
                    // Geeft alleen resultaat als het verzoek om informatie te krijgen gelukt is aan de client-kant en server-kant.
                    document.getElementById("livesearch").innerHTML=this.responseText;
                    // Zet het resultaat van de zoekopdracht in de (zichtbare) zoekbalk.
                    document.getElementById("livesearch").style.border="1px solid #76eec6";
                    // Geeft de resultatenbalk een rand eromheen.
                }
            }
            // Stuur het resultaat door naar de pagina livesearch.php
            xmlhttp.open("GET","livesearch.php?q="+str,true);
            xmlhttp.send();
        }
    </script>
</head>
<body>

<style>
    /* Dit zal later de pagina donkerder maken als de muis over het menu gaat, zodat deze beter zichtbaar is.
    Dit gaat pas werken als de algemene stylesheet er is.
    #resultaattabel:hover ~ #pagina {
        opacity: 0.8;
        background-color: blue;
        color: green;
    }
    */
</style>
<form id="zoekform">
    <input type="text" size="30" onkeyup="showResult(this.value)">
    <div id="livesearch" style='width: 40%;'></div>
</form>

</body>
</html>