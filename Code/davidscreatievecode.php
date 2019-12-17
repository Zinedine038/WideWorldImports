<script>
    //scripts voor inlogpagina
    function formVul() {
        if (document.getElementById("voornaam") != null) {
            var voornaam = document.getElementById("voornaam").value;
            document.getElementById("voornaam2").value = voornaam;
        }

        if (document.getElementById("tussenvoegsel") != null) {
            var tussenvoegsel1 = document.getElementById("tussenvoegsel").value;
            document.getElementById("tussenvoegsel2").value = tussenvoegsel1;
        }

        if (document.getElementById("achternaam") != null) {
            var achternaam1 = document.getElementById("achternaam").value;
            document.getElementById("achternaam2").value = achternaam1;
        }

        if (document.getElementById("email") != null) {
            var email1 = document.getElementById("email").value;
            document.getElementById("email2").value = email1;
        }

        if (document.getElementById("wachtwoord") != null) {
            var wachtwoord1 = document.getElementById("wachtwoord").value;
            document.getElementById("wachtwoord2").value = wachtwoord1;
        }

        if (document.querySelector('.checkboxbericht').checked) {
            document.getElementById("spam2").value = 1;
        } else {
            document.getElementById("spam2").value = 0;
        }
    }

    function formKlopt() {
        var huisnummerbestaat = document.getElementById("huisnummer2").value;
        var postcodebestaat = document.getElementById("postcode2").value;
        var straatbestaat = document.getElementById("straatnaam2").value;
        var plaatsbestaat = document.getElementById("plaats2").value;
        if (document.getElementById("huisnummertoe") != null) {
            var huisnummertoe = document.getElementById("huisnummertoe").value;
        }

        <?php if (isset($_POST["postcode2"])) {
        $postcode = $_GET["postcode2"];
    }
        if (isset($_POST["huisnummer2"])) {
            $huisnummer = $_GET["huisnummer2"];
        }
        if (isset($_POST["huisnummertoe"])) {
            $huisnummertoe = $_POST["huisnummertoe"];
        } ?>

        if (!(document.querySelector('.checkboxbericht').checked)) {
            var check = document.getElementsByClassName('checkboxbericht');
            if (check) {
                for (var ie = 0; ie < check.length; ie++) {
                    check[ie].removeAttribute('checked');
                }
            }
            document.getElementById("spam").value = 0;
        }
    }

    //script voor overal donker achtergrond bij hover livesearch.
    function hoverOver() {
        if (document.getElementById('paginaalles') != null) {
            var a = document.getElementById('paginaalles');
        }

        if (document.getElementById('bodyalles') != null) {
            var b = document.getElementById('bodyalles');
        }

        if (document.getElementById('productnaam') != null) {
            var c = document.getElementById('productnaam');
        }

        if (a) {
            document.getElementById('paginaalles').style.backgroundColor = 'rgba(0,0,0,0.5)';
        }

        if (b) {
            document.getElementById('bodyalles').style.backgroundColor = 'rgba(0,0,0,0.5)';
        }

        if (c) {
            document.getElementById('productnaam').style.color = 'rgba(0,0,0,0.8)';
        }

        var elements1 = document.getElementsByClassName('product-img');
        if (elements1) {
            for (var i1 = 0; i1 < elements1.length; i1++) {
                elements1[i1].setAttribute('style', 'filter: brightness(45%) !important');
            }
        }

        var elements2 = document.getElementsByClassName('h-25');
        if (elements2) {
            for (var i2 = 0; i2 < elements2.length; i2++) {
                elements2[i2].setAttribute('style', 'filter: brightness(45%) !important');
            }
        }

        var elements3 = document.getElementsByClassName('cart-items');
        if (elements3) {
            for (var i3 = 0; i3 < elements3.length; i3++) {
                elements3[i3].setAttribute('style', 'filter: brightness(45%) !important');
            }
        }

        var elements4 = document.getElementsByClassName('plaatjescomponent');
        if (elements4) {
            for (var i4 = 0; i4 < elements4.length; i4++) {
                elements4[i4].setAttribute('style', 'filter: brightness(45%) !important');
            }
        }

        var elements5 = document.getElementsByClassName('price');
        if (elements5) {
            for (var i5 = 0; i5 < elements5.length; i5++) {
                elements5[i5].style.color = 'rgba(0,0,0,0.8)';
            }
        }

        var elements6 = document.getElementsByClassName('card-title');
        if (elements6) {
            for (var i6 = 0; i6 < elements6.length; i6++) {
                elements6[i6].style.color = 'rgba(0,0,0,0.8)';
            }
        }

        var elements7 = document.getElementsByClassName('shadow');
        if (elements7) {
            for (var i7 = 0; i7 < elements7.length; i7++) {
                elements7[i7].setAttribute('style', 'background-color:rgba(0,0,0,0.5) !important');
            }
        }

        var elements8 = document.getElementsByClassName('btn');
        if (elements8) {
            for (var i8 = 0; i8 < elements8.length; i8++) {
                elements8[i8].setAttribute('style', 'filter: brightness(40%) !important');
            }
        }

        var elements9 = document.getElementsByClassName('btn-warning');
        if (elements9) {
            for (var i9 = 0; i9 < elements9.length; i9++) {
                elements9[i9].setAttribute('style', 'background-color:rgba(0,0,0,0.4); border:rgba(0,0,0,0.5); !important');
            }
        }

        var elements10 = document.getElementsByClassName('px5');
        if (elements10) {
            for (var i10 = 0; i10 < elements10.length; i10++) {
                elements10[i10].setAttribute('style', 'background-color:rgba(0,0,0,0.5) !important');
            }
        }

        var elements11 = document.getElementsByClassName('text-secondary');
        if (elements11) {
            for (var i11 = 0; i11 < elements11.length; i11++) {
                elements11[i11].setAttribute('style', 'filter: brightness(40%) !important');
            }
        }


        var elements12 = document.getElementsByClassName('header-img');
        if (elements12) {
            for (var i12 = 0; i12 < elements12.length; i12++) {
                elements12[i12].setAttribute('style', 'filter: brightness(40%) !important')
            }
        }

        var elements13 = document.getElementsByClassName('card');
        if (elements13) {
            for (var i13 = 0; i13 < elements13.length; i13++) {
                elements13[i13].setAttribute('style', 'filter: brightness(40%) !important')
            }
        }

        var elements14 = document.getElementsByClassName('fas');
        if (elements14) {
            for (var i14 = 0; i14 < elements14.length; i14++) {
                elements14[i14].setAttribute('style', 'filter: brightness(40%) !important')
            }
        }

    }
    function hoverAway() {
        var elements1 = document.getElementsByClassName('h-25');
        if (elements1) {
            for (var i1 = 0; i1 < elements1.length; i1++) {
                elements1[i1].removeAttribute('style');
            }
        }

        var elements2 = document.getElementsByClassName('cart-items');
        if (elements2) {
            for (var i2 = 0; i2 < elements2.length; i2++) {
                elements2[i2].removeAttribute('style');
            }
        }

        var elements3 = document.getElementsByClassName('plaatjescomponent');
        if (elements3) {
            for (var i3 = 0; i3 < elements3.length; i3++) {
                elements3[i3].removeAttribute('style');
            }
        }

        var elements4 = document.getElementsByClassName('card-title');
        if (elements4) {
            for (var i4 = 0; i4 < elements4.length; i4++) {
                elements4[i4].style.color = 'rgba(69,194,227,1)';
            }
        }

        var elements5 = document.getElementsByClassName('price');
        if (elements5) {
            for (var i5 = 0; i5 < elements5.length; i5++) {
                elements5[i5].style.color = 'rgba(69,194,227,1)';
            }
        }

        var elements6 = document.getElementsByClassName('shadow');
        if (elements6) {
            for (var i6 = 0; i6 < elements6.length; i6++) {
                elements6[i6].removeAttribute('style');
            }
        }

        var elements7 = document.getElementsByClassName('px5');
        if (elements7) {
            for (var i7 = 0; i7 < elements7.length; i7++) {
                elements7[i7].removeAttribute('style');
            }
        }

        var elements8 = document.getElementsByClassName('btn-warning');
        if (elements8) {
            for (var i8 = 0; i8 < elements8.length; i8++) {
                elements8[i8].removeAttribute('style');
            }
        }

        var elements9 = document.getElementsByClassName('product-img');
        if (elements9) {
            for (var i9 = 0; i9 < elements9.length; i9++) {
                elements9[i9].removeAttribute('style');
            }
        }

        var elements10 = document.getElementsByClassName('px5');
        if (elements10) {
            for (var iii2 = 0; iii2 < elements10.length; iii2++) {
                elements10[iii2].removeAttribute('style');
            }
        }

        var elements11 = document.getElementsByClassName('text-secondary');
        if (elements11) {
            for (var i11 = 0; i11 < elements11.length; i11++) {
                elements11[i11].removeAttribute('style');
            }
        }

        var elements12 = document.getElementsByClassName('header-img');
        if (elements12) {
            for (var i12 = 0; i12 < elements12.length; i12++) {
                elements12[i12].removeAttribute('style');
            }
        }

        var elements13 = document.getElementsByClassName('card');
        if (elements13) {
            for (var i13 = 0; i13 < elements13.length; i13++) {
                elements13[i13].removeAttribute('style');
            }
        }

        var elements14 = document.getElementsByClassName('fas');
        if (elements14) {
            for (var i14 = 0; i14 < elements14.length; i14++) {
                elements14[i14].removeAttribute('style');
            }
        }




        var elements100 = document.getElementsByClassName('btn');
        if (elements100) {
            for (var i100 = 0; i100 < elements100.length; i100++) {
                elements100[i100].removeAttribute('style');
            }
        }



        document.getElementById('paginaalles').style.backgroundColor = 'rgba(255,255,255,1)';
        document.getElementById('bodyalles').style.backgroundColor = 'rgba(255,255,255,1)';

        if (document.getElementById('productnaam') != null) {
            document.getElementById('productnaam').style.color = 'rgba(69,194,227,1)';
        }

    }
</script>