# File manager

# Features
- Upload files
- Download files
- Delete files
- Create directories
- Display the content of a specified directory
- Delete directories
- Access on any device connected to your LAN

# Set Up
1. Clone this repository
    
    ```bash
    git clone https://github.com/yeguezn/file-manager.git
    ```

2. Get into the repositoy

    ## Linux
    ```bash
    cd file-manager
    ```
    ## Windows
    ```bash
    cd file-manager
    ```

3. Run the `docker compose up` command

    ## Linux
    ```bash
    sudo docker compose up -d
    ```

    ## Windows
    ```bash
    docker compose up -d
    ```

4. Run the following command to turn on the frontend server

    ## Linux
    ```bash
    sudo docker exec files-app npm run build
    ```
    ## Windows
    ```bash
    docker exec files-app npm run build
    ```

5. Open this link in your browser: [localhost:8000/](localhost:8000/)

Now you can use this app on your computer and on any device connected to your LAN (Local Area Network). If you want to access the app on your smart phone or other device you must put in the browser the IP address of the computer you are running the app on, followed by the port 8000.

Here is an example:

192.168.100.9:8000/