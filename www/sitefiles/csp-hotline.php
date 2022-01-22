<?php

define('SUBJECT', 'CSP violation');

// Send `204 No Content` status code.
http_response_code(204);

$data = file_get_contents('php://input');

/** @noinspection PhpAssignmentInConditionInspection */
if ($data = json_decode($data)) {
    // Prettify the JSON-formatted data.
    $data = json_encode(
        $data,
        JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
    );
    // Mail the CSP violation report.
    error_log(
        __FILE__ . ':' . __LINE__
        . '  ' . SUBJECT
        . '  ' . $data
    );
} else {
    error_log(
        __FILE__ . ':' . __LINE__
        . ' ERROR, incorect JSON '
    );
}

