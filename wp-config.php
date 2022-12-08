<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'u51239_test' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'u51239_test' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', '368700_tz' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'l7lp(DSqSJ|enxE1pKI9$r7b[MhIiB<>IoOkv>L> 0Ez>QUI9<f&=[*df>JZ49*p' );
define( 'SECURE_AUTH_KEY',  'e>buSq2aOxV1$h^/%f}5q4e-A^yB 1kD$h-o<MIamyC4R^wx0 cnH8>-W={.xQa5' );
define( 'LOGGED_IN_KEY',    '[^1f(Vqlb!(<lHiqIyl]n%:rLO$(G+4q*>[ozrq]|qSp59MnqtVqcH9}Lta26`[m' );
define( 'NONCE_KEY',        'Ime6zrQNP*wg-wmhBE3O72rPcVdu#vo>t_43~,h9O{a&QGF)MI{8| L1pS]r(Gpx' );
define( 'AUTH_SALT',        '^Pc<|&%D4bTg+Mt>~d/Qc$Cem,GXt^DSb,n~S5*baV{ymBP2x)W4t!Mm[nO@lmC8' );
define( 'SECURE_AUTH_SALT', 'jMdyc j/Wn6b:C-++3Wz]G>t]bag/ZR&!gs+|6[NN+``6e`O}4m4>P-k S$lz>nZ' );
define( 'LOGGED_IN_SALT',   'w6)(mrn/1{..zS-I>tpq;{@]d7Ld]hi%>7${Y4n~6{$L^-q9.8LsZnb`yC8FL+jy' );
define( 'NONCE_SALT',       'CI.yME/h}P7v,R_]yPFUOTKONj3Q^P-AzR2QlcZB!P5dpX/W]i{g=%^3>g_?K?nr' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
