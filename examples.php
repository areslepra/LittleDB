<?php
require('class.littledb.php');


// DB Logger se utiliza al ejecutar una consulta, ésta se envía a la función
// dada por $dblogger para su posterior guardado en un log.
$dblogger = 'funcion_de_loggeo_de_datos';

$db = new LittleDB('localhost', 'user', 'password', 'db_name', $dblogger);

// Conectar al Servidor (no es automatico)
$db->connect();

// Consulta Común
// $db->(CONSULTA, VALORES, RETORNAR_DATOS);
// RETORNAR_DATOS = true | retorna un arreglo assosiativo
// RETORNAR_DATOS = false | retorna un objeto Query
$id = 1;
$query = $db->query('SELECT * FROM usuarios WHERE id = ?', $id, true);

// Obtener datos de una consulta previa (Unicamente si en $query no se retornaron datos)
echo 'json + fetchrow() = '.json_encode($query->fetchrow()).'<br />';

// Obtener la cantidad de Tablas afectadas por $query
echo '$db->numrows() = '.$query->numrows().'<br />';

// Insert
// $db->insert(TABLA, COLUMNAS_Y_VALORES, CONDICIONANTES, RETORNAR_ID_FILA);
$insert = $db->insert('usuarios', array('nick' => 'Cody xD Roodaka', 'pass' => 'cody22' ), true);

// Update
// $db->insert(TABLA, COLUMNAS_Y_VALORES, CONDICIONANTES, RETORNAR_ID_FILA);
echo $db->update('usuarios', array('nombre' => 'Cody Alberto Roodaka'), array('id' => $insert), true);

// Se devuelve a sí mismo como un objeto (para usarse dentro de otra clase)
$db->get_instance();


// Anteriormente era necesario desconectar, ahora es automático
//$db->disconnect();