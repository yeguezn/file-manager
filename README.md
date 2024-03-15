# File manager

## Features
- Upload files
- Download files
- Delete files
- Create directories
- Display the content of a specified directory
- Delete directories

# Set Up
1. Clone this repository
```bash
git clone https://github.com/yeguezn/file-manager.git
```
2. Get into the directory
```bash
cd file-manager
```

3. Rename the `.env.example` to `.env`

4. Run the following command in order to create a docker image
```bash
docker run -t files .
```
5. Create a docker volume in order to persistent the files you upload or the directories you create. For the volume name you can choose whatever you want (run this command only the first time you test this app)
```bash
docker volume create <YOUR-VOLUME-NAME>
```
6. Run the backend with this command
```bash
docker run -it -v <YOUR-VOLUME-NAME>:/app/storage/app/public/ -p 8000:8000 files
```
(If you want to use the app in any device connected to your LAN, then use the following command)
```bash
docker run -it -v <YOUR-VOLUME-NAME>:/app/storage/app/public/ -h <YOUR-IP-ADDRESS> -p 8000:8000 files
```
7. Open a new terminal tab and run the following command for the frontend
```bash
docker exec <CONTAINER-ID> npm run build
```
(You can get the CONTAINER-ID running the `docker ps` command)

8. Open the following link in the browser http://localhost:8000/
