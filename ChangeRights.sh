#!/bin/bash

DIRECTORY=$1

chown jody:www-data -R $DIRECTORY

chmod g+rw -R $DIRECTORY
