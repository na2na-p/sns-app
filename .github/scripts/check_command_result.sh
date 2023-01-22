#!/bin/bash

function succeeded () {
  status=$(aws ssm get-command-invocation --command-id "$1" --instance-id "$2")
	# "Status": の後の文字列を取得
	status=$(echo "$status" | sed -e 's/^.*Status": "//' -e 's/".*$//')
  if [ "$status" = "Success" ]; then
    echo true
  else
    echo false
  fi
}

function getTargets () {
	response=$(aws ec2 describe-instances --filters "Name=tag:Name,Values=na2na-sns-app-backend" "Name=instance-state-name,Values=running" --query "Reservations[*].Instances[*].InstanceId")
	targetId=$(echo "$response" | jq '.[][]')
	targetId=$(echo "$targetId" | sed -e 's/^"//' -e 's/"$//')
	echo $targetId
}

commandId=$1
commandId=$(echo "$commandId" | sed -e 's/^"//' -e 's/"$//')
targetId=$(getTargets)

i=1

while [ $i -le 10 ];
do
  succeeded=$(succeeded "$commandId" "$targetId")
  if [ "$succeeded" ]; then
    exit 0
  fi
  i=$($i + 1 )
  sleep 30
done

exit 1
