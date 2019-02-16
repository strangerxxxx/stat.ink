<?php
declare(strict_types=1);

use yii\web\UrlNormalizer;

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'enableStrictParsing' => true,
    'normalizer' => [
        'class' => UrlNormalizer::class,
        'normalizeTrailingSlash' => false,
    ],
    'rules' => [
        'login'         => 'user/login',
        'logout'        => 'user/logout',
        'profile'       => 'user/profile',
        'register'      => 'user/register',

        'u/<screen_name:\w+>/<battle:\d+>' => 'show-compat/battle',
        'u/<screen_name:\w+>/<battle:\d+>/edit' => 'show-compat/edit-battle',
        'u/<screen_name:\w+>/<battle:\d+>.atom' => 'ostatus/battle-atom',
        'u/<screen_name:\w+>/<id_from:\d+>-<id_to:\d+>' => 'show-compat/user-fromto',
        'u/<screen_name:\w+>/stat/report/<year:\d+>/<month:\d+>' => 'show-compat/user-stat-report-ym',
        'u/<screen_name:\w+>/stat/report/<year:\d+>' => 'show-compat/user-stat-report-y',
        //'u/<screen_name:\w+>/stat/<by:[\w-]+>' => 'show-compat/user-stat-by',
        'u/<screen_name:\w+>' => 'show-compat/user',
        'u/<screen_name:\w+>.<lang:[\w-]+>.<type:rss|atom>' => 'feed/compat-user',
        'u/<screen_name:\w+>-ostatus.atom' => 'ostatus/feed',

        '@<screen_name:\w+>' => 'show-user/profile',
        '@<screen_name:\w+>/spl1/<battle:\d+>' => 'show/battle',
        '@<screen_name:\w+>/spl1/<battle:\d+>/edit' => 'show/edit-battle',
        // 'u/<screen_name:\w+>/<battle:\d+>.atom' => 'ostatus/battle-atom',
        '@<screen_name:\w+>/spl1/<id_from:\d+>-<id_to:\d+>' => 'show/user',
        '@<screen_name:\w+>/spl1/stat/report/<year:\d+>/<month:\d+>' => 'show/user-stat-report',
        '@<screen_name:\w+>/spl1/stat/report/<year:\d+>' => 'show/user-stat-report',
        '@<screen_name:\w+>/spl1/stat/<by:[\w-]+>' => 'show/user-stat-<by>',
        '@<screen_name:\w+>/spl1/' => 'show/user',
        '@<screen_name:\w+>.spl1.<lang:[\w-]+>.<type:rss|atom>' => 'feed/user',
        // 'u/<screen_name:\w+>-ostatus.atom' => 'ostatus/feed',

        '@<screen_name:\w+>/spl2/<battle:\d+>' => 'show-v2/battle',
        '@<screen_name:\w+>/spl2/<battle:\d+>/edit' => 'show-v2/edit-battle',
        // '@<screen_name:\w+>/2/<battle:\d+>.atom' => 'ostatus/battle-atom',
        '@<screen_name:\w+>/spl2/<id_from:\d+>-<id_to:\d+>' => 'show-v2/user',
        '@<screen_name:\w+>/spl2/stat/report/<year:\d+>/<month:\d+>' => 'show-v2/user-stat-report',
        '@<screen_name:\w+>/spl2/stat/report/<year:\d+>' => 'show-v2/user-stat-report',
        '@<screen_name:\w+>/spl2/stat/<by:[\w-]+>' => 'show-v2/user-stat-<by>',
        '@<screen_name:\w+>/spl2/' => 'show-v2/user',
        '@<screen_name:\w+>.2.<lang:[\w-]+>.<type:rss|atom>' => 'feed/user-v2',

        '@<screen_name:\w+>/salmon' => 'salmon/index',
        '@<screen_name:\w+>/salmon/<id:\d+>' => 'salmon/view',
        '@<screen_name:\w+>/salmon/<id:\d+>/edit' => 'salmon/edit',
        '@<screen_name:\w+>/salmon/<id:\d+>/delete' => 'salmon/delete',
        '@<screen_name:\w+>/salmon/index.<lang:[\w-]+>.<type:rss|atom>' => 'salmon/feed',

        'fest/<region:\w+>/<order:\d+>' => 'fest/view',
        'entire/weapons/<weapon:\w+>/<rule:\w+>' => 'entire/weapon',
        'entire/weapons/<weapon:\w+>' => 'entire/weapon',
        'entire/weapons2/<weapon:\w+>/<rule:\w+>' => 'entire/weapon2',
        'entire/users/combined-<b32name:[A-Za-z2-7]+>' => 'entire/combined-agent',
        'entire/users/<b32name:[A-Za-z2-7]+>' => 'entire/agent',
        'stages/<year:\d+>/<month:\d+>' => 'stage/month',
        'stages/<map:[a-z]+>/<rule:[a-z0-9_]+>.json' => 'stage/map-history-json',
        'stages/<map:[a-z]+>/<rule:[a-z0-9_]+>' => 'stage/map-detail',
        'stages/<map:[a-z]+>' => 'stage/map',
        'stages' => 'stage/index',
        'api/v1/<action:[\w-]+>' => 'api-v1/<action>',
        'GET,HEAD api/v2/battle' => 'api-v2-battle/index',
        'GET,HEAD api/v2/user-battle' => 'api-v2-battle/index-with-auth',
        'GET,HEAD api/v2/battle/<id:\d+>' => 'api-v2-battle/view',
        'POST api/v2/battle'     => 'api-v2-battle/create',
        'OPTIONS api/v2/battle'  => 'api-v2-battle/options',
        'OPTIONS api/v2/battle-with-auth' => 'api-v2-battle/options',
        'OPTIONS api/v2/battle/<id:\d+>' => 'api-v2-battle/options',

        // Splatoon 2 Salmon Run
        'OPTIONS api/v2/salmon/<id:\d+>' => 'api-v2-salmon/options',
        'OPTIONS api/v2/salmon-stats' => 'api-v2-salmon/options',
        'OPTIONS api/v2/salmon' => 'api-v2-salmon/options',
        'OPTIONS api/v2/user-salmon' => 'api-v2-salmon/options',
        'GET,HEAD api/v2/salmon/<id:\d+>' => 'api-v2-salmon/view',
        'GET,HEAD api/v2/salmon-stats' => 'api-v2-salmon/view-stats',
        'GET,HEAD api/v2/salmon' => 'api-v2-salmon/index',
        'GET,HEAD api/v2/user-salmon' => 'api-v2-salmon/index-with-auth',
        'POST api/v2/salmon-stats' => 'api-v2-salmon/create-stats',
        'POST api/v2/salmon' => 'api-v2-salmon/create',
        'entire/salmon/<action:[\w-]+>' => 'entire/salmon-<action>',

        'api/v2/<action:[\w-]+>.<format:[\w]+>' => 'api-v2/<action>',
        'api/v2/<action:[\w-]+>' => 'api-v2/<action>',
        'api/internal/theme' => 'api-theme/set',
        'api/internal/<action:[\w-]+>' => 'api-internal/<action>',
        '.well-known/host-meta' => 'ostatus/host-meta',
        '.well-known/webfinger' => 'ostatus/webfinger',
        'api/salmon/<screen_name:\w+>' => 'ostatus/salmon',
        'downloads' => 'download-stats/index',
        '<action:[\w-]+>'  => 'site/<action>',
        '<controller:[\w-]+>/<action:[\w-]+>' => '<controller>/<action>',
        'robots.txt'    => 'site/robots',
        ''              => 'site/index',
    ],
];
