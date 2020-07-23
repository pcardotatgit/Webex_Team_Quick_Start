import ciscosparkapi
import json
import os
import requests

#first  : pip install ciscosparkapi

SPARK_ACCESS_TOKEN = "<Webex_Token>" #you Webex team Token
SPARK_ROOM_ID="<ROOM_ID>"

spark = ciscosparkapi.CiscoSparkAPI(SPARK_ACCESS_TOKEN)
message = spark.messages.create(SPARK_ROOM_ID,text='Hello - Test Message from My Python Script !')

print ('MESSAGE SENT !')
