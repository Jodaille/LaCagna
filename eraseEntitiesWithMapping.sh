#!/bin/bash


rm -Rf ./module/LaCagnaProduct/src/Product/Entity

php public/index.php orm:generate-entities module/LaCagnaProduct/src

php public/index.php orm:schema-tool:update --force
