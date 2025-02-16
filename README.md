# Asioso Test Project

Official Documentation for the Asioso Pimcore Project.

### Prerequisites

* Your user must be allowed to run docker commands (directly or via sudo).
* You must have docker compose installed.
* Your user must be allowed to change file permissions (directly or via sudo).

## Getting started

--> MAKE SURE NO PROCESSES ARE RUNNING ON PORT 80! <--

How to check:
```bash
1. sudo lsof -i :80 OR sudo netstat -tulnp | grep :80 # IDENTIFY THE PID OF THE PROCESS RUNNING ON PORT 80 TCP
2. sudo kill -9 <PID>
3. docker compose up -d (Restart the Docker container)
```

### Installation

Docker commands:
```bash
1. cd /asioso-test-project
2. docker compose (or docker-compose) up -d
```

DB Import Commands (Maridb):
```bash
1. docker ps 
( copy mariadb container id )
2. docker exec -i 319ea6cd587e(replace with your ContainerID) mysql -u root -pROOT pimcore < pimcore_db.sql ( sql dump file name) ( you need to run this command where your db.sql file located)
```
- Where to find the Mariadb Container ID:

![image](https://github.com/user-attachments/assets/6424740f-fb07-42c7-b03e-1b4e07ab5343)

