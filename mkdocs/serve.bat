@echo OFF
REM Go to the directory with this script
pushd "%~dp0" 

REM Create a Python virtualenv if it does not exist yet
if not exist "env" (
  echo "Creating virtualenv"
  virtualenv -p python3 env
)

REM Serve the website
call env/Scripts/activate
pip install -r requirements.txt
mkdocs serve