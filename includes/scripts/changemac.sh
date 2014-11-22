#!/bin/bash
#·························#
#······ @mark__os ········#
#·························#

#Define Interface to use

if [ "$1" == "" ]
  then
    echo -e "\n Usage:\n"
    echo -e "  $0 <iface>\n"
    exit 1
  else
    IFACE=$1
fi

#Check if mon0 already exist. If exist, stop it.
ifconfig mon0 > /dev/null 2>&1
if [ "$?" == "0" ]
  then
    airmon-ng stop mon0 > /dev/null 2>&1
fi

#Change mac $IFACE interface
ifconfig $IFACE down
macchanger -A $IFACE > /dev/null 2>&1
ifconfig $IFACE up

#Mount $IFACE in monitor mode
airmon-ng start $IFACE > /dev/null 2>&1
sleep .5

#Get false mac asigned to $IFACE
FALSE_MAC=`ifconfig $IFACE | grep "HWaddr" | awk '{ print $5 }'`

#Change mon0 mac to the same of $IFACE
ifconfig mon0 down
macchanger --mac=$FALSE_MAC mon0 > /dev/null 2>&1
ifconfig mon0 up

#Check $IFACE and MON0 macs
MAC_IFACE=`ifconfig $IFACE | grep "HWaddr" | awk '{ print $5 }'`
MAC_MON=`ifconfig mon0 | grep "HWaddr" | awk '{ print $5 }' | awk -F- '{ print $1":"$2":"$3":"$4":"$5":"$6}' | tr '[:upper:]' '[:lower:]'`
if [ "$MAC_IFACE" == "$MAC_MON" ]
  then
    #exit 0 on success
    echo "OK"
    exit 0
  else
    #exit 1 on error
    echo "ERROR"
    exit 1
fi
