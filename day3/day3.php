<?php

define('PRIORITIES', \array_flip(\str_split('_abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')));

$rucksacks = explode("\n", \file_get_contents(dirname(__FILE__) . '/input.txt'));
$duplicate_priorities = \array_map(
    static fn(array $rucksack_items) => PRIORITIES[\current(\array_intersect(
        \array_slice($rucksack_items, 0, \count($rucksack_items) / 2),
        \array_slice($rucksack_items, \count($rucksack_items) / 2)
    ))],
    \array_map('str_split', $rucksacks)
);

\printf("Sum of rucksack duplicates is: %d (part 1)\n", \array_sum($duplicate_priorities));
