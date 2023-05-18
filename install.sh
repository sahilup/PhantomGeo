#!bin/sh
sudo apt update
sudo apt install -y python3
sudo apt install -y php
sudo apt install -y python3-pip
python3 -m pip install --upgrade pip
pip install colorama
python3 --version
php --version
sudo python3 startserver.py