<?php

define('PRIORITIES', \array_flip(\str_split('_abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')));

$rucksacks = \array_map(
    'str_split',
    \array_filter(explode("\n", \file_get_contents(dirname(__FILE__) . '/input.txt')))
);

$duplicate_priorities = \array_map(
    static fn(array $rucksack_items) => PRIORITIES[\current(\array_intersect(
        \array_slice($rucksack_items, 0, \count($rucksack_items) / 2),
        \array_slice($rucksack_items, \count($rucksack_items) / 2)
    ))],
    $rucksacks
);

\printf("Sum of rucksack duplicate priorities is: %d (part 1)\n", \array_sum($duplicate_priorities));

$group_badge_priorities = \array_map(
    static fn(array $group) => PRIORITIES[\current(\array_intersect(...$group))],
    \array_chunk($rucksacks, 3)
);

\printf("Sum of group badge priorities is: %d (part 2)\n", \array_sum($group_badge_priorities));