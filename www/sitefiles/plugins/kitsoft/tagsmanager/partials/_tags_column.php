<?= $record->tags ? implode(', ', $record->tags->lists('name')) : ''; ?>