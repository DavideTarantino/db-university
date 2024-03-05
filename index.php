<?php

// DB-UNIVERSITY ESERCIZIO DEL 04/03/2024


/*Selezionare tutti gli studenti nati nel 1990 (160)*/

SELECT *
FROM `students`
WHERE YEAR(`date_of_birth`) = 1990;


/*Selezionare tutti i corsi che valgono più di 10 crediti (479)*/

SELECT *
FROM `courses`
WHERE `cfu` > 10
ORDER BY `cfu` ASC;


/*Selezionare tutti gli studenti che hanno più di 30 anni*/

SELECT *
FROM `students`
WHERE YEAR(`date_of_birth`) < 1994;


/*Selezionare tutti i corsi del primo semestre del primo anno di un qualsiasi corso di laurea (286)*/

SELECT *
FROM `courses`
WHERE `period` = "I semestre"
AND `year` = 1;


/*Selezionare tutti gli appelli d'esame che avvengono nel pomeriggio (dopo le 14) del 20/06/2020 (21)*/

SELECT *
FROM `exams`
WHERE `date` = '2020/06/20'
AND `hour` > '14:00';


/*Selezionare tutti i corsi di laurea magistrale (38)*/

SELECT *
FROM `degrees`
WHERE `level` = "magistrale";


/*Da quanti dipartimenti è composta l'università? (12)*/

SELECT COUNT(`id`) AS `numero di diparimenti`
FROM `departments`;


/*Quanti sono gli insegnanti che non hanno un numero di telefono? (50)*/

SELECT COUNT(`id`) AS `insegnanti con numero di telefono`
FROM `teachers`
WHERE `phone` IS NOT NULL;


/*Contare quanti iscritti ci sono stati ogni anno*/

SELECT COUNT(`id`) AS `Numero di Studenti`, YEAR(`enrolment_date`) AS `Anno`
FROM `students`
GROUP BY YEAR(`enrolment_date`);


/*Contare gli insegnanti che hanno l'ufficio nello stesso edificio*/

SELECT COUNT(`id`) AS `Numero di Insegnanti`,`office_address` AS `Indirizzo dell' Ufficio`
FROM `teachers`
GROUP BY `office_address`;


/*Calcolare la media dei voti di ogni appello d'esame*/

SELECT AVG(`vote`) AS `Voto Medio`, `exam_id`
FROM `exam_student`
GROUP BY `exam_id`;


/*Contare quanti corsi di laurea ci sono per ogni dipartimento*/

SELECT COUNT(`name`)
FROM `degrees`
GROUP BY `department_id`;


/*Selezionare tutti gli studenti iscritti al Corso di Laurea in Economia*/

SELECT `students`.`name` AS `Nome Studente`, `students`.`surname` AS `Cognome studente`, `degrees`.`name` AS `Corso di Laurea`
FROM `students`
JOIN `degrees`
ON `students`.`degree_id` = `degrees`.`id`
WHERE `degrees`.`name` = 'Corso di Laurea in Economia';


/*Selezionare tutti i Corsi di Laurea Magistrale del Dipartimento di Neuroscienze*/

SELECT *
FROM `degrees`
JOIN `departments`
ON `departments`.`id` = `degrees`.`department_id`
WHERE `departments`.`name` = 'Dipartimento di Neuroscienze'
AND `degrees`.`level` = 'Magistrale';


/*Selezionare tutti i corsi in cui insegna Fulvio Amato (id=44)*/

SELECT *
FROM `courses`
JOIN `course_teacher`
ON `course_teacher`.`teacher_id` = `courses`.`id`
WHERE `course_teacher`.`teacher_id` = 44;


/*Selezionare tutti gli studenti con i dati relativi al corso di laurea a cui sono iscritti e il relativo dipartimento, in ordine alfabetico per cognome e nome*/

SELECT `students`.`name` AS `Nome dello Studente`, `students`.`surname` AS `Cognome dello Studente`, `degrees`.`name` AS `Corso di Laurea`, `departments`.`name` AS `Dipartimento di Appartenenza`
FROM `students`
JOIN `degrees`
ON `students`.`degree_id` = `degrees`.`id`
JOIN `departments`
ON `degrees`.`department_id` = `departments`.`id`
ORDER BY `students`.`surname` ASC, `students`.`name` ASC;


/*Selezionare tutti i corsi di laurea con i relativi corsi e insegnanti*/

SELECT `degrees`.`name` AS `Corso di Laurea`, `courses`.`name` AS `Corso`, `teachers`.`name` AS `Nome dell'Insegnante`, `teachers`.`surname` AS `Cognome dell'Insegnante`
FROM `degrees`
JOIN `courses`
ON `degrees`.`id` = `courses`.`degree_id`
JOIN `course_teacher`
ON `courses`.`id` = `course_teacher`.`course_id`
JOIN `teachers`
ON `teachers`.`id` = `course_teacher`.`teacher_id`;