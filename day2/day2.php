<?php

const OUTCOMES_PART1 = [
    'A X' => 1 + 3,
    'A Y' => 2 + 6,
    'A Z' => 3 + 0,
    'B X' => 1 + 0,
    'B Y' => 2 + 3,
    'B Z' => 3 + 6,
    'C X' => 1 + 6,
    'C Y' => 2 + 0,
    'C Z' => 3 + 3,
];

const OUTCOMES_PART2 = [
    'A X' => 0 + 3,
    'A Y' => 3 + 1,
    'A Z' => 6 + 2,
    'B X' => 0 + 1,
    'B Y' => 3 + 2,
    'B Z' => 6 + 3,
    'C X' => 0 + 2,
    'C Y' => 3 + 3,
    'C Z' => 6 + 1,
];

$rounds = \array_filter(\explode("\n", \file_get_contents(dirname(__FILE__) . '/input.txt')));
$score_part1 = \array_sum(array_map(static fn(string $entry) => OUTCOMES_PART1[$entry], $rounds));
$score_part2 = \array_sum(array_map(static fn(string $entry) => OUTCOMES_PART2[$entry], $rounds));

\printf("Total score of part 1: %d\n", $score_part1);
\printf("Total score of part 2: %d\n", $score_part2);