/* function pour permettre le chargement complet la page pour réaliser l'action */
function sleep(milliseconds) {
    var start = new Date().getTime();
    for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds) {
            break;
        }
    }
}

/**** Load function des boutons ****/

window.onload = function () {
    var btnStart = document.getElementById("btnStart");
    var btnStop = document.getElementById("btnStop");
    var btnRestart = document.getElementById("btnRestart");
    var btnQuit = document.getElementById("btnQuit");
    btnStart.addEventListener("click", buttonActionStart);
    btnStart.addEventListener("click", detectionStart);
    btnStop.addEventListener("click", buttonActionStop);
    btnStop.addEventListener("click", detectionStop);
    btnRestart.addEventListener("click", actionRestart);
    btnQuit.addEventListener("click", actionQuit);
}

/**********************************/

/**** FUNCTION DES BOUTONS ****/

function detectionStart() {
    var start = window.open('http://172.23.40.235:8080/1/detection/start');
    sleep(10);
    start.close();
}

function detectionStop() {
    var stop = window.open('http://172.23.40.235:8080/1/detection/pause');
    sleep(10);
    stop.close();
}

function actionQuit() {
    var stop = window.open('http://172.23.40.235:8080/1/action/quit');
    sleep(10);
    stop.close();
}

function actionRestart() {
    var restart = window.open('http://172.23.40.235:8080/1/action/restart');
    sleep(10);
    restart.close();
}
/****************************/

/**** FUNCTION STATUS CHECKBOX CAPTURE MOTION ****/

function buttonActionStart() {
    if ((document.getElementById('fs').checked == false)) {
        document.getElementById('fs').checked = true;
    }
}

function buttonActionStop() {
    if ((document.getElementById('fs').checked == true)) {
        document.getElementById('fs').checked = false;
    }
}

/****************************/
