ifneq (,$(wildcard .env))
    include .env
    export
endif

PROJECT_NAME ?= project
PROJECT_REFERENCE ?= laravel-react-docker
APP_CONTAINER = laravel-${PROJECT_NAME}
FRONTEND_CONTAINER = react-${PROJECT_NAME}
DB_CONTAINER = db-${PROJECT_NAME}
SUPERVISOR_CONTAINER = supervisor-${PROJECT_NAME}

run:
	@docker-compose -f docker-compose.yml build --no-cache
	@docker-compose -f docker-compose.yml -p $(PROJECT_REFERENCE) up -d

down:
	@docker-compose down --remove-orphans

app-container:
	@docker exec -it $(APP_CONTAINER) bash

frontend-container:
	@docker exec -it $(FRONTEND_CONTAINER) bash

db-container:
	@docker exec -it $(DB_CONTAINER) bash

supervisor-container:
	@docker exec -it $(SUPERVISOR_CONTAINER) bash

	




