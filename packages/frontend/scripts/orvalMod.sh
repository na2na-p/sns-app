#!/usr/bin/env bash
# ../../../documents/api/schema.jsonの中から、servers[0].urlを取得する

SCHEMA_JSON_PATH=../../../documents/api/schema.json
# 1. schema.jsonを読み込む
SCHEMA_JSON=$(cat $SCHEMA_JSON_PATH)

# 2. servers[0].urlを取得する
SERVER_URL=$(echo "$SCHEMA_JSON" | jq -r '.servers[0].url')

# ../src/generated/default/default.tsの中で
# "/api/v1"を"${SERVER_URL}/api/v1"に置換する
sed -i -e "s|/api/v1|${SERVER_URL}/api/v1|g" ../src/generated/default/default.ts
