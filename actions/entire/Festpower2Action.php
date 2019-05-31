<?php
/**
 * @copyright Copyright (C) 2015-2019 AIZAWA Hina
 * @license https://github.com/fetus-hina/stat.ink/blob/master/LICENSE MIT
 * @author AIZAWA Hina <hina@bouhime.com>
 */

declare(strict_types=1);

namespace app\actions\entire;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\web\ViewAction;

class Festpower2Action extends ViewAction
{
    public function run()
    {
        return $this->controller->render('festpower2', [
            'data' => $this->getData(),
        ]);
    }

    public function getData(): array
    {
        $my = '{{battle2}}.[[my_team_estimate_fest_power]]';
        $his = '{{battle2}}.[[his_team_estimate_fest_power]]';
        $diff = sprintf('ABS(%s - %s)', $my, $his);
        $query = (new Query())
            ->select([
                'diff' => $diff,
                'battles' => 'COUNT(*)',
                'higher_wins' => sprintf('SUM(CASE %s END)', implode(' ', [
                    "WHEN {$my} < {$his} AND {{battle2}}.[[is_win]] = FALSE THEN 1",
                    "WHEN {$my} > {$his} AND {{battle2}}.[[is_win]] = TRUE THEN 1",
                    'ELSE 0',
                ])),
                'mistake_battles' => sprintf('SUM(CASE %s END)', implode(' ', [
                    "WHEN {{battle2}}.[[period]] BETWEEN 212042 AND 212059 THEN 1",
                    "ELSE 0",
                ])),
                'mistake_higher_wins' => sprintf('SUM(CASE %s END)', implode(' ', [
                    "WHEN NOT({{battle2}}.[[period]] BETWEEN 212042 AND 212059) THEN 0",
                    "WHEN {$my} < {$his} AND {{battle2}}.[[is_win]] = FALSE THEN 1",
                    "WHEN {$my} > {$his} AND {{battle2}}.[[is_win]] = TRUE THEN 1",
                    'ELSE 0',
                ])),
            ])
            ->from('battle2')
            ->andWhere(['and',
                ['not', [$my => null]],
                ['not', [$his => null]],
                ['not', ['{{battle2}}.[[is_win]]' => null]],
                ['not', ['{{battle2}}.[[period]]' => null]],
            ])
            ->groupBy($diff)
            ->andHaving(['>=', 'COUNT(*)', 100])
            ->orderBy([$diff => SORT_ASC]);

        $prev = -10;
        return array_filter(ArrayHelper::map(
            $query->all(),
            'diff',
            function (array $row) use (&$prev): ?array {
                if ((int)$row['diff'] !== $prev + 10) {
                    return null;
                }
                $prev = (int)$row['diff'];
                return $row;
            }
        ));
    }
}