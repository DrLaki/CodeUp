#!/bin/bash

#first arg is the *.py
#second arg is input for the *.py file
#third arg is the execution time limit for that python code


output=$(timeout $3 python $1 $2 2>&1)

#timeout command returns 124 if python command is timed out
if [ $? -eq 124 ]
then
    echo "You have been timed out."
    exit 1
fi

IFS=
echo -e $output
exit 0
