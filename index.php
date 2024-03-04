<?php

// DB-UNIVERSITY ESERCIZIO DEL 04/03/2024


/*Selezionare tutti gli studenti nati nel 1990 (160)*/

SELECT *
FROM `students`
WHERE YEAR(`date_of_birth`) = 1990;