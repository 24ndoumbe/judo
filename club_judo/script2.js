document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true, // Permet la sélection de dates
        events: 'presence.php', // L'URL qui renvoie les événements

        eventDidMount: function (info) {
            // Personnalisez l'affichage des événements ici
            if (info.event.extendedProps.status === 'Présent') {
                info.el.style.backgroundColor = 'green'; // Couleur pour "Présent"
            } else if (info.event.extendedProps.status === 'Absence') {
                info.el.style.backgroundColor = 'red'; // Couleur pour "Absence"
            }
        },

        select: function (info) {
            // La plage de dates sélectionnée
            var startDate = info.startStr;
            var endDate = info.endStr;

            // Afficher les boutons "Présence" et "Absence" directement sur le calendrier
            showPresenceAbsenceButtons(calendar, startDate, endDate);

            // Effacer la sélection après traitement
            calendar.unselect();
        },
        // ... autres options ...
    });

    calendar.render();

    // Fonction pour afficher les boutons "Présence" et "Absence"
    function showPresenceAbsenceButtons(calendar, startDate, endDate) {
        // Créer les boutons
        var btnPresence = document.createElement('button');
        btnPresence.innerHTML = 'Présence';
        btnPresence.addEventListener('click', function () {
            addEvent(calendar, startDate, endDate, 'Présent');
            removeButtons();
        });

        var btnAbsence = document.createElement('button');
        btnAbsence.innerHTML = 'Absence';
        btnAbsence.addEventListener('click', function () {
            addEvent(calendar, startDate, endDate, 'Absence');
            removeButtons();
        });

        // Ajouter les boutons au conteneur du calendrier
        var calendarContainer = calendarEl.closest('.fc-view-container');
        calendarContainer.appendChild(btnPresence);
        calendarContainer.appendChild(btnAbsence);

        // Fonction pour supprimer les boutons
        function removeButtons() {
            calendarContainer.removeChild(btnPresence);
            calendarContainer.removeChild(btnAbsence);
        }
    }

    // Fonction pour ajouter un événement
    function addEvent(calendar, startDate, endDate, status) {
        // Ajoutez l'événement avec le statut spécifié
        calendar.addEvent({
            title: status,
            start: startDate,
            end: endDate,
            backgroundColor: (status === 'Présent') ? 'green' : 'red',
            status: status // Ajoutez une propriété pour stocker le statut
        });
    }
});

//premier projet 
// Récupérez le contexte du canevas
var ctx = document.getElementById('barChart').getContext('2d');

// Définissez les données du diagramme à barres
var data = {
    labels: ['cours suivis', 'cours non suivis', 'cours annulés'],
    datasets: [{
        label: 'nombre de cours',
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1,
        data: [700, 900, 860]
    }]
};

// Configurez le type de diagramme et affichez-le
var myChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var currentDate = moment().format('YYYY-MM-DD');

    var events = [
        {
            title: 'Présence',
            //start: currentDate,
            backgroundColor: 'green'
        },
        {
            title: 'Absence',
            //start: currentDate,
            backgroundColor: 'red'
        },
    ];

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,
        events: events,
        dayRender: function (info) {
            info.el.innerHTML += "<button class='dayButton' data-date='" + info.date + "'>Click me</button>";
            info.el.style.padding = "20px 0 0 10px";
        },

        select: function (info) {
            var startTime = info.startStr;
            var endTime = info.endStr;
            console.log(startTime)

            var confirmation = confirm('Serez-vous présent(e) au cours de ' + startTime + ' à ' + endTime + ' ?');

            var status = prompt('Serez-vous présent(e) ou absent(e) au cours de ' + startTime + ' à ' + endTime + ' ?');

            if (status !== null && (status === 'Présent' || status === 'Absent')) {
                calendar.addEvent({
                    title: status,
                    start: startTime,
                    end: endTime,
                    backgroundColor: (status === 'Présent') ? 'green' : 'red',
                    status: 'present'
                });
            }

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

    // Fonction pour sauvegarder la présence
    function savePresence(date, startTime, endTime, status) {
        $.ajax({
            type: 'POST',
            url: 'presence.php',
            data: { date: date, startTime: startTime, endTime: endTime, status: status },
            success: function (response) {
                calendar.refetchEvents();
            },
            error: function () {
                console.error('Erreur lors de l\'enregistrement du statut de présence/absence.');
            }
        });
    }

    // Fonction pour calculer l'âge automatiquement
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

