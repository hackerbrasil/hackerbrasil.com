#!/bin/bash
file="inc"
if  test -s "$file"
then
    . inc/make
else
    echo "baixando inc..."
    git clone git@github.com:aicoutodasilva/inc.git
fi
