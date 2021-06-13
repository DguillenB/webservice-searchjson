<?php

$response = array();

if($_SERVER['REQUEST_METHOD'] !== 'GET'){
    // Validación de método permitido
    $response['error']                  = array();
    $response['error']['code']          = 405;
    $response['error']['description']   = "Method Not Allowed";
    http_response_code(405);
}else{
    
    $searchText = isset($_REQUEST['texto']) ? strtolower($_REQUEST['texto']) : null;
    if(!is_null($searchText)){
        // Cargamos el archivo del filesystem a un array en memoria
        $jsonFile = file_get_contents("dataset.json");
        $arrayJson = json_decode($jsonFile, true);
        
        $arrayBooks = array();
        $arrayAuthors = array();
        foreach($arrayJson as $bookEntry) {
            // Realizamos la búsqueda del texto sobre los campos titulo y autor del array 
            // aplicamos strtolower para poder hacer búsquedas sin casesensitive para que se muestren todos los resultados
            if(strpos(strtolower($bookEntry['titulo']), $searchText) !== false){
                // Comprobación para evitar duplicados
                if(!in_array($bookEntry['titulo'], $arrayBooks) ){
                    $arrayBooks[] = $bookEntry['titulo'];                    
                }
            }
            if(strpos(strtolower($bookEntry['autor']), $searchText) !== false){
                if(!isset($arrayAuthors[$bookEntry['autor']])){
                    $arrayAuthors[$bookEntry['autor']] = array();
                }
                $index = count($arrayAuthors[$bookEntry['autor']]);
                if($index === 2){
                    // Solo se guardarán los dos últimos libros del autor
                    $firstBookDate  = intval($arrayAuthors[$bookEntry['autor']][0]['fecha_nov']);
                    $secondBookDate = intval($arrayAuthors[$bookEntry['autor']][1]['fecha_nov']);
                    $actualBookDate = intval($bookEntry['fecha_nov']);
                    if( ($firstBookDate > $secondBookDate ) && $secondBookDate < $actualBookDate){
                        $arrayAuthors[$bookEntry['autor']][1] = $bookEntry;
                    }else if( ($firstBookDate < $secondBookDate) && $firstBookDate < $actualBookDate ){
                        $arrayAuthors[$bookEntry['autor']][0] = $bookEntry;
                    }                    
                }else{
                    $arrayAuthors[$bookEntry['autor']][$index] = $bookEntry;
                }
            }
        }
        
        $response['status']             = "success";
        $response['data']['books']      = $arrayBooks;
        $response['data']['authors']    = $arrayAuthors;
        http_response_code(200);
    }else{
        // Petición mal formada, obligatorio parametro texto
        $response['error'] = array();
        $response['error']['code']          = 400;
        $response['error']['description']   = "Bad Request";
        http_response_code(400);
    }
}

// Retornamos respuesta
header('Content-Type: application/json');
echo json_encode($response);

