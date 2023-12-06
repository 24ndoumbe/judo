const sideLinks = document.querySelectorAll('.sidebar .side-menu li a:not(.logout)');

sideLinks.forEach(item => {
    const li = item.parentElement;
    item.addEventListener('click', () => {
        sideLinks.forEach(i => {
            i.parentElement.classList.remove('active');
        })
        li.classList.add('active');
    })
});

const menuBar = document.querySelector('.content nav .bx.bx-menu');
const sideBar = document.querySelector('.sidebar');

menuBar.addEventListener('click', () => {
    sideBar.classList.toggle('close');
});

const searchBtn = document.querySelector('.content nav form .form-input button');
const searchBtnIcon = document.querySelector('.content nav form .form-input button .bx');
const searchForm = document.querySelector('.content nav form');

searchBtn.addEventListener('click', function (e) {
    if (window.innerWidth < 576) {
        e.preventDefault;
        searchForm.classList.toggle('show');
        if (searchForm.classList.contains('show')) {
            searchBtnIcon.classList.replace('bx-search', 'bx-x');
        } else {
            searchBtnIcon.classList.replace('bx-x', 'bx-search');
        }
    }
});

window.addEventListener('resize', () => {
    if (window.innerWidth < 768) {
        sideBar.classList.add('close');
    } else {
        sideBar.classList.remove('close');
    }
    if (window.innerWidth > 576) {
        searchBtnIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
});

const toggler = document.getElementById('theme-toggle');

toggler.addEventListener('change', function () {
    if (this.checked) {
        document.body.classList.add('dark');
    } else {
        document.body.classList.remove('dark');
    }
});






/* pour afficher le  juste pour ne pas le perdre

document.addEventListener('DOMContentLoaded', function () {
    // Fonction pour récupérer les informations sur les cours depuis le serveur
    function getCours() {
        // Utilisez AJAX pour récupérer les données depuis le serveur
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Les données ont été récupérées avec succès
                var cours = JSON.parse(xhr.responseText);
                displayCours(cours);
            }
        };
        xhr.open('GET', 'http://localhost/club_judo/gestion.php', true);
        xhr.send();
    }


    // Fonction pour afficher les cours sur la page
    function displayCours(cours) {
        var coursContainer = document.getElementById('coursContainer');

// Boucle à travers les cours et ajoutez-les à la page
courses.forEach(function (cours) {
            var coursElement = document.createElement('div');
coursElement.innerHTML = "<p>" + cours.date + " - " + cours.heure_debut + " à " + cours.heure_fin + "</p>";
coursContainer.appendChild(coursElement);
        });
    }

// Appelez la fonction pour récupérer et afficher les cours
getCours();
});*/

