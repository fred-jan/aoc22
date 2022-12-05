<?php

list ($stacks, $procedure) = \explode("\n\n", \file_get_contents(dirname(__FILE__) . '/input.txt'));

$crate_rows = \array_map(
    static fn(string $crate_row) => \array_map(static fn(string $crate) => ' ' !== $crate[1] ? $crate[1] : '',
        \str_split($crate_row, 4)), \array_slice(\explode("\n", $stacks), 0, -1)
);
$crate_columns = \array_map(
    static fn(int $column) => \array_column($crate_rows, $column),
    \range(0, \count($crate_rows))
);
$crate_stacks = \array_map(static fn(array $crate_column) => \array_reverse(\array_filter($crate_column)),
    $crate_columns);

$rearranged_stacks = \array_reduce(
    \explode("\n", \trim($procedure)),
    static function (array $crate_stacks, string $move) {
        \preg_match('/move (\d+) from (\d+) to (\d+)/', $move, $matches);
        $crate_stacks[$matches[3] - 1] = \array_merge(
            $crate_stacks[$matches[3] - 1],
            \array_reverse(\array_splice($crate_stacks[$matches[2] - 1], -$matches[1]))
        );
        return $crate_stacks;
    },
    $crate_stacks
);

\printf(
    "The message of the first rearrangement is \"%s\" (part 1)\n",
    \implode('', \array_map('array_pop', $rearranged_stacks))
);

$rearranged_stacks2 = \array_reduce(
    \explode("\n", \trim($procedure)),
    static function (array $crate_stacks, string $move) {
        \preg_match('/move (\d+) from (\d+) to (\d+)/', $move, $matches);
        $crate_stacks[$matches[3] - 1] = \array_merge(
            $crate_stacks[$matches[3] - 1],
            \array_splice($crate_stacks[$matches[2] - 1], -$matches[1])
        );
        return $crate_stacks;
    },
    $crate_stacks
);

\printf(
    "The message of the second rearrangement is \"%s\" (part 2)\n",
    \implode('', \array_map('array_pop', $rearranged_stacks2))
);