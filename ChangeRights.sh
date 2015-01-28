#!/bin/bash

DIRECTORY=$1

chown petiteponette:www-data -R $DIRECTORY

chmod g+rw -R $DIRECTORY
