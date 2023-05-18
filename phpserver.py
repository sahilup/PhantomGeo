import subprocess
import psutil

def start_php_server(port, code_location):
    command = ["php", "-S", f"localhost:{port}", "-t", code_location]
    subprocess.Popen(command)
    print(f"PHP development server started on port {port}.")
    print(f"Code location: {code_location}")

def stop_php_server():
    # To find the process ID of the PHP development server
    php_process = None
    for proc in psutil.process_iter():
        if proc.name() == 'php':
            php_process = proc
            break
    
    if php_process:
        # TO terminate the PHP development server process
        php_process.terminate()
        print("PHP development server stopped.")
    else:
        print("No PHP development server found.")
