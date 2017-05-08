    //kann ein Element aus dem Array entfernen
    Array.remove = function(array, from, to) {
        var rest = array.slice((to || from) + 1 || array.length);
        array.length = from < 0 ? array.length + from : from;
        return array.push.apply(array, rest);
    };

    //definiert die maximale Anzahl an Pop-Ups in Abhängigkeit vom Viewport
    var total_popups = 0;

    //Array mit den Popup-ID'S
    var popups = [];

    //schließt ein Pop-Up
    function close_popup(id) {
        for(var iii = 0; iii < popups.length; iii++) {
            if(id == popups[iii]) {
                Array.remove(popups, iii);
                document.getElementById(id).style.display = "none";
                calculate_popups();
                return;
            }
        }
    }

    //zeigt die Pop-Up's an - Anzahl der Pop-Up's ist abhängig von der maximalen Anzahl an Pop-Up's, die mit dem aktuellen Viewport angezeigt werden können
    function display_popups() {
        var right = 220;

        var iii = 0;
        for(iii; iii < total_popups; iii++) {
            if(popups[iii] != undefined) {
                var element = document.getElementById(popups[iii]);
                element.style.right = right + "px";
                right = right + 320;
                element.style.display = "block";
            }
        }

        for(var jjj = iii; jjj < popups.length; jjj++) {
            var element = document.getElementById(popups[jjj]);
            element.style.display = "none";
        }
    }

    //generiert den HTML-Code für neue Pop-Up's und fügt die Pop-Up-ID dem Array hinzu
    function register_popup(id, name) {

        for(var iii = 0; iii < popups.length; iii++) {
            //wenn ID schon bekannt, bringe Pop-Up nach vorne
            if(id == popups[iii]) {
                Array.remove(popups, iii);
                popups.unshift(id);
                calculate_popups();
                return;
            }
        }

        var element = '<div class="popup-box chat-popup" id="'+ id +'">';
        element = element + '<div class="popup-head">';
        element = element + '<div class="popup-head-left">'+ name +'</div>';
        element = element + '<div class="popup-head-right"><a href="javascript:close_popup(\''+ id +'\');">&#10005;</a></div>';
        element = element + '<div style="clear: both"></div></div><div class="popup-messages"><div class="chat_container">';
        element = element + '<div class="chat_massage_container"><div class="chat_massage_a">Jo Jan, was hältst du vom neuen Chat?</div></div><div class="chat_massage_container"><div class="chat_massage_b">Ich denke er funktioniert noch nicht! xD</div></div>';
        element = element + '<div class="chat_massage_container"><div class="chat_massage_a">Ja leider! -.-</div></div><div class="chat_massage_container"><div class="chat_massage_b">Aber Kopf hoch... wird schon! ^^</div></div><div class="chat_massage_container"><div class="chat_massage_a">Jajajaja... eines schönen Tages!</div></div><div class="form-group"><textarea class="form-control chat_input" rows="1" id=""></textarea></div></div></div></div>';
        document.getElementsByTagName("body")[0].innerHTML = document.getElementsByTagName("body")[0].innerHTML + element;
        popups.unshift(id);
        calculate_popups();
    }

    //berechnet die maximale Anzahl an Pop-Up's und speichert den Wert in die "total_popups"-Variable (s.o.)
    function calculate_popups() {
        var width = window.innerWidth;
        if(width < 540) {
            total_popups = 0;
        } else {
            width = width - 200;
            //320 ist die Breite eines einzelnen Pop-Up's
            total_popups = parseInt(width/320);
        }
        display_popups();
    }

    //berechnet Anzahl an Pop-Up's neu, sobald Seite neu geladen wird oder Fenster skaliert wird
    window.addEventListener("resize", calculate_popups);
    window.addEventListener("load", calculate_popups);
