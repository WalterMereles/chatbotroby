<?php
// conectando a la base de datos
$conn = mysqli_connect("localhost", "root", "", "chatbot") or die("Database Error");

// obteniendo el mensaje del usuario a través de ajax
$getMesg = mysqli_real_escape_string($conn, $_POST['text']);

//comprobando la consulta del usuario a la consulta de la base de datos
$check_data = "SELECT nombres FROM persona WHERE personaci LIKE '%$getMesg%'";
$run_query = mysqli_query($conn, $check_data) or die("Error");

$pruebadata = "SELECT personaci FROM persona WHERE personaci LIKE '%$getMesg%'";
$pruebaquery= mysqli_query($conn, $pruebadata) or die("Error");

//////////////////////////////////
$consul = mysqli_fetch_assoc($pruebaquery);
//almacenando la respuesta a una variable que enviaremos a ajax

if (is_null($consul)) {
    
    if($_POST['text'] == 'si' || $_POST['text'] == 'Si'){
        echo "Estas son las categorias de nuestros productos: ";
        echo "<a target='_blank' href='categoria'> Categoria </a>";
    
    }if($_POST['text'] == 'no' || $_POST['text'] == 'No'){
        echo "Se comunicara con usted un asesor: Hablar";
    
    }if ($_POST['text'] == 'Hablar' || $_POST['text'] == 'hablar') {
        echo "En un momento se comunica un asesor con usted gracias por su preferencia";
    }
    
} else {

    $prueba = $consul['personaci'];
    $msgb= $getMesg;
    $msgcon= $prueba;

    // si la consulta del usuario coincide con la consulta de la base de datos, mostraremos la respuesta; de lo contrario, irá a otra declaración

        if (mysqli_num_rows($run_query) > 0) {
            //saluda con nombre
            if ($msgb == $msgcon) {

            //recuperando la reproducción de la base de datos de acuerdo con la consulta del usuario
            $fetch_data = mysqli_fetch_assoc($run_query);
            //almacenando la respuesta a una variable que enviaremos a ajax
            $replay = $fetch_data['nombres'];
            echo 'hola '.$replay.', en que puedo ayudarte?';
            
            echo ' Quieres hacer una compra?: Si o No';

            }else{
                echo "<a target='_blank' href='https://www.php.net/manual/es/language.operators.comparison.php'> Regitrar </a>";
            };
    
        } else {
            echo "¡Lo siento, no puedo ayudarte con este inconveniente! Favor comunícate con el administrador en el siguiente enlace:
            </br><a href='hola'>Contacto</a>";
        }
}

/*
echo "buen dia no tenemos registro de su CI favor registrarse en:";
echo "<a target='_blank' href='https://www.php.net/manual/es/language.operators.comparison.php'> Regitrar </a>";
*/