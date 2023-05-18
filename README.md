# PhantomGeo - Social Engineering Tool
NOTE: This project is still under development. 
PhantomGeo is a social engineering tool designed to capture location coordinates and camera access from a targeted user by deceiving them into believing they are in a video conference waiting room. This tool exploits the trust and familiarity users have with video conferencing interfaces, ultimately gaining unauthorized access to their location and camera data.

Please note that the use of this tool for any malicious or illegal activities is strictly prohibited. The purpose of PhantomGeo is to raise awareness about social engineering vulnerabilities and help organizations enhance their security measures against such attacks.

# Screenshots
![Screenshot1](https://github.com/sahilup/PhantomGeo/assets/120382518/727f703c-c461-45d1-9720-4850d18a2f8f)

![Screenshot (45)](https://github.com/sahilup/PhantomGeo/assets/133857367/d0ec3d4e-9ae1-44d6-b8e8-83ab3d9626c3)

![Screenshot (47)](https://github.com/sahilup/PhantomGeo/assets/120382518/0c1ffc0d-ec0c-4270-bc5e-3c00c56db53d)

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
    ( Note: install.sh starts the php development server automatically. To start it manually, use $ sudo python3 startserver.py)
    
# Usage
1. Launch any browser of your choice.
2. Go to http://localhost:8000/ (This is the fake video conference waiting room. This link can be sent to the victim by using ngrok or by port forwading)
3. GO to http://localhost:8000/adminpanel.php
4. Login Credentials are: Username: root , Password: 12345 (Note: this can be changed in the login.php file)
5. Now you can accesss the google map link, IP address and device details of the user.(The details are also stored in the coordinates.txt file)
6. The images can be accessed in the captured-images folder
