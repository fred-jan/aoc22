<?php

$calories_per_elf = \array_map(
    static fn(string $elf_calories) => \array_sum(\explode("\n", $elf_calories)),
    \explode("\n\n", \file_get_contents(dirname(__FILE__) . '/input.txt'))
);

\rsort($calories_per_elf);

\printf("Calories of elf with most calories is: %d (part 1)\n", \max($calories_per_elf));
\printf("Combined calories of top 3 elves is: %d (part 2)\n", \array_sum(\array_slice($calories_per_elf, 0, 3)));