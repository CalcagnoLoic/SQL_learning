/*Affiche toutes les données.*/
SELECT * 
FROM school;

SELECT * 
FROM students;

/*Affiche uniquement les prénoms.*/
SELECT prenom
FROM students;

/*Affiche les prénoms, les dates de naissance et l’école de chacun.*/
SELECT prenom, datenaissance, school
FROM students;

/*Affiche uniquement les élèves qui sont de sexe féminin.*/
SELECT * 
FROM students
WHERE genre = "F";

/*Affiche uniquement les élèves qui font partie de l’école Andy.*/
SELECT * 
FROM students
WHERE school = 1;


/*Affiche uniquement les prénoms des étudiants, par ordre inverse à l’alphabet (DESC). Ensuite, la même chose mais en limitant les résultats à 2.*/
SELECT prenom
FROM students
ORDER BY prenom DESC;

SELECT prenom
FROM students
ORDER BY prenom DESC LIMIT 2;

/*Ajoute Ginette Dalor, née le 01/01/1930 et affecte-la à Central, toujours en SQL.*/
INSERT INTO students(nom, prenom, datenaissance, genre, school)
VALUES ("Dalor", "Ginette", "1930-01-01", "F", 1);

/*Modifie Ginette (toujours en SQL) et change son sexe et son prénom en “Omer”.*/
UPDATE students
SET prenom = "Omer",
    genre = "M"
WHERE idStudent = 31;

/*Supprimer la personne dont l’ID est 3.*/
DELETE FROM students
WHERE idStudent = 3;

/*Modifier le contenu de la colonne School de sorte que "1" soit remplacé par "Central" et "2" soit remplacé par "Anderlecht". (attention au type de la colonne !)*/
ALTER TABLE students
MODIFY school VARCHAR(50);

UPDATE students
SET school = "Central"
WHERE school = 1;

UPDATE students
SET school = "Anderlecht"
WHERE school = '2';