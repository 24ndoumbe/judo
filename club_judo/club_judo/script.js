


document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var currentDate = moment().format('YYYY-MM-DD');

    var events = [
        {
            title: 'Présence',
            start: currentDate,
            backgroundColor: 'green',
            url: 'http://localhost/club_judo/connexion.html',
        },
        {
            title: 'Absence',
            start: currentDate,
            backgroundColor: 'red',
            url: 'http://localhost/club_judo/connexion.html',
        },
    ];

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,
        events: events,
        /*dayRender: function (info) {
            info.el.innerHTML += "<button class='dayButton' data-date='" + info.date + "'>Click me</button>";
            info.el.style.padding = "20px 0 0 10px";
        },*/
        select: function (info) {
            var selectedDate = info.startStr;

            // Redirection vers la page de connexion
            window.location.href = 'http://localhost/club_judo/connexion.html';


            // Pour annuler la sélection du calendrier
            calendar.unselect();
        }

    });


    calendar.render();

    var buttons = document.querySelectorAll(".dayButton");
    buttons.forEach(function (btn) {
        btn.addEventListener("click", function (e) {
            alert("clicked button on " + this.dataset.date);
        });
    });

    function calculateAge() {
        var date_de_naissance = document.getElementById('date_de_naissance').value;
        var today = new Date();
        var birthDate = new Date(date_de_naissance);
        var age = today.getFullYear() - birthDate.getFullYear();

        if (today.getMonth() < birthDate.getMonth() || (today.getMonth() === birthDate.getMonth() && today.getDate() < birthDate.getDate())) {
            age--;
        }

        document.getElementById('age').value = age;
    };
});


document.addEventListener("DOMContentLoaded", function () {
    // Charger les cours existants lors du chargement de la page
    chargerCours();

    // Fonction pour charger les cours
    function chargerCours() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "chargerCours.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var coursExistants = JSON.parse(xhr.responseText);
                afficherCours(coursExistants);
            }
        };
        xhr.send();
    }

    // Fonction pour ajouter un cours à la page
    function ajouterCoursALaPage(cours) {
        var nouvelElement = document.createElement("div");
        nouvelElement.textContent = "Nouveau cours : " + cours.nom; // Personnalisez selon votre structure de cours

        var conteneurCours = document.getElementById("conteneurCours");
        conteneurCours.appendChild(nouvelElement);
    }

    // Fonction pour afficher les cours existants
    function afficherCours(cours) {
        var conteneurCours = document.getElementById("conteneurCours");
        cours.forEach(function (cours) {
            var nouvelElement = document.createElement("div");
            nouvelElement.textContent = "Cours existant : " + cours.nom; // Personnalisez selon votre structure de cours
            conteneurCours.appendChild(nouvelElement);
        });
    }
});
