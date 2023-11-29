SCHEMA RELATIONNELLE
COURS ( id, date, heure_début, heure_fin, status )	
CREDENTIALS ( id, adresse mail, password )
PRESENT ( #id cours, #id crédentials)
USERS ( id, nom, prénom, date de naissance, age, poids, categorie, adresse mail, sexe, date_inscription, responsable, #id crédentials )