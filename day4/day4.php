<?php

$fully_overlapping_ranges = \count(\array_filter(\array_map(
    static fn (string $line) =>
        \preg_match('/(\d+)-(\d+),(\d+)-(\d+)/', $line, $matches)
            && \count(\array_intersect(\range($matches[1], $matches[2]), range($matches[3], $matches[4])))
                === \min($matches[2] - $matches[1], $matches[4] - $matches[3]) + 1,
    \array_filter(\explode("\n", \file_get_contents(dirname(__FILE__) . '/input.txt')))
)));

\printf("There are %d elf pairs with fully overlapping ranges (part 1)\n", $fully_overlapping_ranges);

$partially_overlapping_ranges = \count(\array_filter(\array_map(
    static fn (string $line) =>
        \preg_match('/(\d+)-(\d+),(\d+)-(\d+)/', $line, $matches)
        && \count(\array_intersect(\range($matches[1], $matches[2]), range($matches[3], $matches[4]))) > 0,
    \array_filter(\explode("\n", \file_get_contents(dirname(__FILE__) . '/input.txt')))
)));

\printf("There are %d elf pairs with overlapping ranges (part 2)\n", $partially_overlapping_ranges);