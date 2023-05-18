# PhantomGeo - Social Engineering Tool
NOTE: This project is still under development. 
PhantomGeo is a social engineering tool designed to capture location coordinates and camera access from a targeted user by deceiving them into believing they are in a video conference waiting room. This tool exploits the trust and familiarity users have with video conferencing interfaces, ultimately gaining unauthorized access to their location and camera data.

Please note that the use of this tool for any malicious or illegal activities is strictly prohibited. The purpose of PhantomGeo is to raise awareness about social engineering vulnerabilities and help organizations enhance their security measures against such attacks.
# Screenshots
![Screenshot1](https://github.com/sahilup/PhantomGeo/assets/133857367/d8b9f7ef-0d48-445b-813b-c91b4be41439)

![Screenshot (45)](https://github.com/sahilup/PhantomGeo/assets/133857367/d0ec3d4e-9ae1-44d6-b8e8-83ab3d9626c3)

![Screenshot (47)](https://github.com/sahilup/PhantomGeo/assets/133857367/ed2d30bd-0ea8-40b7-9612-660e96141ed7)
# Features
- Simulates a video conference waiting room to deceive the target.
- Captures location coordinates of the target user.
- Gains access to the camera feed of the target user.
- Provides detailed logs and information about the captured data.
# Installation
1. Clone the repository:
  git clone https://github.com/sahilup/PhantomGeo
2. Change to the project directory:
   $ cd PhantomGeo
3. Install the required dependencies: 
    $ sudo chmod +x ./install.sh && sudo bash ./install.sh
# Usage
1. Launch any browser of your choice.
2. Go to http://localhost:8000/ (This is the fake video conference waiting room. This link can be sent to the victim by using ngrok or by port forwading)
3. GO to http://localhost:8000/adminpanel.php
4. Login Credentials are: Username: root , Password: 12345 (Note: this can be changed in the login.php file)
5. Now you can accesss the google map link, IP address and device details of the user.(The details are also stored in the coordinates.txt file)
6. The images can be accessed in the captured-images foleder
