<?php
try {
    $pdo = new PDO('sqlite:database/database.sqlite');
    $stmt = $pdo->prepare('SELECT config_data FROM site_configurations WHERE config_type = ? AND is_active = 1 LIMIT 1');
    $stmt->execute(['site']);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($result) {
        $data = json_decode($result['config_data'], true);
        echo 'Favicon guardado: ' . ($data['favicon'] ?? 'NO_FAVICON') . PHP_EOL;
        echo 'Datos completos: ' . json_encode($data, JSON_PRETTY_PRINT) . PHP_EOL;
    } else {
        echo 'No hay configuración site guardada' . PHP_EOL;
    }
} catch(Exception $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}