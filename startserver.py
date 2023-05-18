import phpserver
import signal
from colorama import Fore, Back, Style
port = 8000
code_location = "web_html"

while True:
    phpserver.start_php_server(port, code_location)
    print(Fore.YELLOW+"login to localhost:"+str(port)+"/adminpanel.php"+Fore.GREEN+"to go to the login page of the admin panel. "+Fore.CYAN+"\n Note that you can use ngrok to access the site on the internet ")
    try:
        def handle_signal(signal, frame):
            if signal == signal.SIGTSTP: #SIGTSTP is sent when we press Ctrl+Z
                phpserver.stop_php_server
        signal.signal(signal.SIGTSTP, handle_signal)
        input("To kill the process press ctrl+z")
        exit()
    except:
        phpserver.stop_php_server
        exit()