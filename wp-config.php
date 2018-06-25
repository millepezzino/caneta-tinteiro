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
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'caneta-tinteiro');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** Nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

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
define('AUTH_KEY',         ',5>$bFr/p:}%x1q<4 j@x&g)iA sqA>44ZsIgY>5#rf8i=CAE=uKF6bxq43kA.&5');
define('SECURE_AUTH_KEY',  '-t={G_?Y{g%n`cs-_S85?03lON[YW_Q_,c;q7>;@C|k,EWhwn =vr]7a#aGZ?4T(');
define('LOGGED_IN_KEY',    '!?Xi&%&*;GTAA:$O3n5~B&5Os)u_chG]f;vmed`a4j+0->SY|.FZ-n <O 2T$xC!');
define('NONCE_KEY',        'd.n.<G2@FOON/,CPOPab{]x22S,ErE}>t{ZBl_z$hv``]tX+qI-_WA@[B5+`%izv');
define('AUTH_SALT',        'BvJ}mdyz-[@)D}rbf!Fe9niyNP8<JdY$A~,iHG!I~7gJBj*Pe40rubCd8{1[,L.6');
define('SECURE_AUTH_SALT', '_WCM4kjL;W]a <! ?*?r&/Z[:&N`h/2%nL5h7)B`GIUpGg!HABYEX.MKzpn=YnXq');
define('LOGGED_IN_SALT',   '_56:63n-)z3}h7dh9)@3PEb~D,z;kdsRzoSk_<_lui2jc60rt1[o04@ceYFf$/IN');
define('NONCE_SALT',       'S(b=bi.iEybBR8Sp7../u45@bKfFNRd;Jadj>@<8@;.5zr<xnMCS2.{oU:^$|IR*');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix  = 'ct_';

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
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
