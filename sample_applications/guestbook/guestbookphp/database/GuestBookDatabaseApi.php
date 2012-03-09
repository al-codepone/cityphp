<?php

require_once(CITY_PHP . 'database/DatabaseAdapter.php');
require_once(GUEST_BOOK_PHP . 'database/IGuestBookDatabaseApi.php');
require_once(GUEST_BOOK_PHP . 'database/MessageData.php');

abstract class GuestBookDatabaseApi extends DatabaseAdapter implements IGuestBookDatabaseApi {
    protected function getMessageData(array $data) {
        return new MessageData($data['message_id'], $data['creation_date'], $data['message']);
    }
}

?>
