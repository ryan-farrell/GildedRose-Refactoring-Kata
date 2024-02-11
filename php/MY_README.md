# STEPS & THOUGHTS ON THE GILDED ROSE KATA (PHP) :rose:

A very nice introduction to Approval Testing and its power working with legacy systems. It allows you to refactor the
code with confidence always comparing the output of the refactored code with the original output.

During refactoring I would simply approach the refactoring of the code with a TDD approach as normal with
the confidence that the Approval base test ApprovalTest.approved.txt is your aim to match.

## My Steps :runner:

1. Forked the repo and got setup with the necessary docker image and docker-composer files for PHP8 which included Composer and Xdebug.

2. `composer-installed` and ran initial Checks
    - easy coding standards (ecs) - Fixed to Green
    - php stan - Fixed to Green
    - php tests - Failed as expected
    - and then with coverage report to check the report was working and accessible

3. Read up and looked into Approval testing and how it works.
4. Approval tests suggest it pairs well with traditional unit testing but particular shines working with legacy systems code, with no test coverage.
5. After learning about Approval testing, I ran the tests again and saw the output of the expected approval file.
    - Moved the output from thirty days received file to approve file, and ran tests again. Now we have GREEN and a base line to give us confidence that the refactoring or new code is replicating the original.

    :exclamation: NOTE that this form of Approval testing is based on the confirmation of human approval on the original codes output and that the system is working as expected. :exclamation:

6. Re read requirements and started to refactor new methods with TDD approach.
    - :white_check_mark: FIRST GOAL Create refactored code in parallel with the original, with a side by side approach of the new methods and the original one. Aim to create a new text file and compare/match to `ApprovalTest.testThirtyDaysOriginal.approved.txt` file.

7. Didn't replace the original method `updateQuality()` with the newer `updateItems()` left that for what would be the final step, and so I can refer back to in during an at the end, plus reference in the future.

8. Finished by running all composer cmds checked still all was green. :green_heart:

## Outcome :diamond_shape_with_a_dot_inside:

1. Refactored `GildedRose::class` into smaller methods all individually covered with unit tests
2. Additional 3 snapshots unit tests created against original ApprovalTest.txt file for additional confidence
3. Created new ApprovalTest Refactored file to confirm string output matches that of the original ApprovalFile, moved files into `tests/comparison` dir and added them as a unit test (would be deleted, left for reference)
4. Discovered possible bug with caged "Aged Brie". Noted it with a `@todo`, and would check requirements with stakeholder. For now matched legacy output.
5. Similar check for the SellIn requirements of "Sulfuras" as if it never has to be sold do we need to bother updating the sell in, for now matched legacy output.
6. Added new functionality to handle any "Conjured" items with unit tests now `Conjured Mana Cake` item will updated properly.

## Pre-requisites :whale:
Docker installed and running on your machine, would be easiest to match the environment in use.

## Instructions & Setup :clipboard: :wrench:

1. Clone `this` repo
2. `cd` into the directory
3. Run :

```shell script
docker compose up --build
```
4. Once the container is running, run :

```shell script
docker ps
```
```shell script
docker exec -it {YOUR_CONTAINER_ID} /bin/sh
```
5. Run composer checks as noted in the [php/README.md](README.md)

```shell script
composer tests
composer test-coverage
composer check-cs
composer phpstan
```

6. Swap out `updateQuality()` method with the new `updateItems()` on line 39 of the `/php/fixtures/texttest_fixture.php` which will
see no change in any of the other items, and you will now get item updates working for 'Conjured Mana Cake' item.

# :thumbsup: