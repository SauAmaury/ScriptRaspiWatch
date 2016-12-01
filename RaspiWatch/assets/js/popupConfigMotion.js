/* function pour permettre le chargement complet la page pour réaliser l'action */
function sleep(milliseconds) {
    var start = new Date().getTime();
        for (var i = 0; i < 1e7; i++) {
            if ((new Date().getTime() - start) > milliseconds){
              break;
            }
    }
}

function detectionStart()
{
    var start = window.open('http://172.23.40.235:8080/0/detection/start');  
    sleep(10);
    start.close();
}

function detectionStop()
{
    var stop = window.open('http://172.23.40.235:8080/0/detection/pause');  
    sleep(10);
    stop.close();
}

function detectionStatus()
{
        // à faire
}

function actionQuit()
{
    var stop = window.open('http://172.23.40.235:8080/0/action/quit');
    sleep(10);
    stop.close();
}

function actionRestart()
{
	var restart = window.open('http://172.23.40.235:8080/0/action/restart');
	sleep(10);
	restart.close();
}
