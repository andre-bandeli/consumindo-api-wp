<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do banco de dados
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do banco de dados - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'wordpress' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'd6~zVv<V~c zVy]1Z17~PwNC7)* dGO7thi}SnVGo/r7&NsYdE{9+k()E1 I.WM ' );
define( 'SECURE_AUTH_KEY',  '9m0U,+`g4W&!FJ@W[ 2lZ%7gYjOqxmKEjdnQC4KgD8@.=;`kWF@d|;/)FM.:!xO+' );
define( 'LOGGED_IN_KEY',    '=xmEzElOTCs9J?Rsc;N2/6U@|KINe/h;[d[#fe;*pB!:PF{{^^q@8+CHwLCs+X!*' );
define( 'NONCE_KEY',        '!8[,//#RR6K5jb#)2:*[w)k[$BeWBpr2$([y ,v`U:}/k>:X&[.6yf)*qK=:jw|t' );
define( 'AUTH_SALT',        ':WZv:3zLb|Uq6IYYOV>|vPPc2a{}(!BPi=qI#Z>DqKAs -pe7@6611s`1f.yGw:a' );
define( 'SECURE_AUTH_SALT', 'Ag{xL;V-VhCxD.#dA)367>(G(?{w`xeE5K_>8{Y^2R^ VyAsBWKRH%iN`2MK(X_(' );
define( 'LOGGED_IN_SALT',   '+Q5im!??.Gml+R(orYPz-VQ+7b*=A=|eEO?YE2PW3{|>w>9RoVW%To)vS_bPmBGY' );
define( 'NONCE_SALT',       '82&{+&Du142Ni$*t*!;xPsglsK<+mGg&`2|D@[N[oy_e7jhl@1!]I%/1gK&JGc8X' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_wordpress';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Adicione valores personalizados entre esta linha até "Isto é tudo". */



/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
