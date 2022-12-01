import Data.List

type Calories = Int
type Inventory = [Calories]
type CaloriesPerElf = [[Calories]]
type TotalCaloriesPerElf = [Calories]

loadInventory :: IO Inventory
loadInventory = do
    input <- readFile "input.txt"
    return $ map (\x -> if x /= "" then read x :: Int else 0) $ lines input

groupByElf :: Inventory -> CaloriesPerElf
groupByElf xs = case 0 `elemIndex` xs of
    Just i -> [take i xs] ++ groupByElf (drop (i+1) xs)
    Nothing -> []

sumByElf :: Inventory -> TotalCaloriesPerElf
sumByElf xs = map sum $ groupByElf xs

maxElfCalories :: Inventory -> Calories
maxElfCalories xs = maximum $ sumByElf xs

caloriesOfTop3Elves :: Inventory -> Calories
caloriesOfTop3Elves xs = sum $ take 3 $ reverse $ sort $ sumByElf xs

main = do
    inventory <- loadInventory
    putStrLn ("Elf with most calories has " ++ (show $ maxElfCalories inventory) ++ " calories. (part 1)")
    putStrLn ("Top 3 elves have " ++ (show $ caloriesOfTop3Elves inventory) ++ " calories combined. (part 2)")
