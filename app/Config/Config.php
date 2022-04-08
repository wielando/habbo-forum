<?php

namespace app\Config;

final class Config {

    # page
    const PATH = 'http://127.0.0.1/habbohotel';
    const PAGE_NAME = 'Habbohotel';

    # mysql
    const MYSQL_HOST = '127.0.0.1';
    const MYSQL_USER = 'root';
    const MYSQL_PASSWORD = '';
    const MYSQL_DATABASE = 'habbohotel';
    const MYSQL_PORT = 3306;
    const CHARSET = 'utf8mb4';

    # pathing
    const MAIN_PATH = 'D:\Projects\habbohotel';
    const APP_PATH = Config::MAIN_PATH . '\app';
    const PAGE_PATH = Config::MAIN_PATH . '\web\pages';


}
