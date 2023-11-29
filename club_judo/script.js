
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
