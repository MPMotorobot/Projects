<?php
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

$connection = null;

try {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $connection = new mysqli(
        getenv('PROJECTS_DB_HOST') ?: 'localhost',
        getenv('PROJECTS_DB_USER') ?: 'root',
        getenv('PROJECTS_DB_PASSWORD') ?: '',
        getenv('PROJECTS_DB_NAME') ?: 'projects'
    );
    $connection->set_charset('utf8mb4');

    $result = $connection->query('SELECT * FROM projects ORDER BY id ASC');
    $projects = $result->fetch_all(MYSQLI_ASSOC);
    $projectRoot = realpath(__DIR__);

    foreach ($projects as &$project) {
        $linkParts = parse_url((string) ($project['link'] ?? ''));
        $relativePath = is_array($linkParts) && empty($linkParts['scheme']) && empty($linkParts['host'])
            ? ($linkParts['path'] ?? '')
            : '';
        $projectPath = is_string($relativePath) && $relativePath !== ''
            ? realpath(__DIR__ . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relativePath))
            : false;

        $project['link_available'] = $projectPath !== false
            && strpos($projectPath, $projectRoot . DIRECTORY_SEPARATOR) === 0
            && is_file($projectPath);
    }
    unset($project);

    echo json_encode(
        $projects,
        JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE | JSON_THROW_ON_ERROR
    );
} catch (Throwable $error) {
    error_log('getProjects.php: ' . $error->getMessage());
    http_response_code(500);
    echo json_encode(
        ['error' => 'Nie udało się załadować projektów.'],
        JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE
    );
} finally {
    if ($connection instanceof mysqli) {
        $connection->close();
    }
}
