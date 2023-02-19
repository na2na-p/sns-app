#!/bin/bash

# <none>:<none>とREPOSITORY:TAGは除外
images=$(docker images | awk '{print $1":"$2}'| grep -v "<none>:<none>" | grep -v "REPOSITORY:TAG")

echo "$images"

# for image in $images; do
# 	trivy image --exit-code 1 --severity HIGH,CRITICAL "$image"
# done
