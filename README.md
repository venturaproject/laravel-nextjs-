# Laravel NextJs

![Laravel NextJs](https://i.ibb.co/W38tZ0B/laravel-project.png)

## Project Information

This project is designed as a decoupled application, showcasing the separation of concerns between the **Frontend** and **Backend** components.

### Backend

The backend is developed using **Laravel**, following a hexagonal architecture that utilizes bounded contexts. This design allows for better organization and separation of different aspects of the application. The backend implements the **CQRS** (Command Query Responsibility Segregation) pattern, utilizing both command and query buses for efficient management of information. This approach facilitates smooth registration, modification, and access to data within the system.

### Frontend

The frontend operates independently from the backend and is built using **Next.js** with **React**. It leverages **TypeScript** for improved type safety and developer experience. For styling and layout, the project integrates **Tailwind CSS**, allowing for a responsive and modern design without compromising performance. The decoupling of the frontend from the backend enables independent development, deployment, and scaling of both components.



## Installation

To install this project, follow these steps:

1. Clone the repository:
   ```bash
   git clone https://github.com/venturaproject/laravel-nextjs.git
   cd laravel-nextjs
   make run


## Architecture
   
   ```
├── Products
│   ├── Application
│   │   ├── Commands
│   │   │   ├── Create
│   │   │   │   ├── CreateProduct.php
│   │   │   │   ├── CreateProductDTO.php
│   │   │   │   └── CreateProductHandler.php
│   │   │   ├── Delete
│   │   │   │   ├── DeleteProduct.php
│   │   │   │   └── DeleteProductHandler.php
│   │   │   └── Update
│   │   │       ├── UpdateProduct.php
│   │   │       ├── UpdateProductDTO.php
│   │   │       └── UpdateProductHandler.php
│   │   ├── Queries
│   │   │   ├── GetAll
│   │   │   │   ├── GetAllProducts.php
│   │   │   │   └── GetAllProductsHandler.php
│   │   │   └── GetById
│   │   │       ├── GetProductById.php
│   │   │       └── GetProductByIdHandler.php
│   │   ├── Services
│   │   │   └── PriceCalculator.php
│   │   └── UseCases
│   │       └── ApplyDiscountToProduct.php
│   ├── Domain
│   │   ├── Events
│   │   │   └── ProductCreated.php
│   │   ├── Model
│   │   │   └── Product.php
│   │   └── Repository
│   │       └── ProductRepositoryInterface.php
│   └── Infrastructure
│       ├── Listeners
│       │   └── SendProductCreatedEmailListener.php
│       ├── Repository
│       │   └── ProductRepository.php
│       └── Requests
│           ├── CreateProductRequest.php
│           └── UpdateProductRequest.php
├── Shared
│   ├── Application
│   │   ├── Bus
│   │   │   ├── Command
│   │   │   │   ├── CommandBus.php
│   │   │   │   └── CommandBusInterface.php
│   │   │   └── Query
│   │   │       ├── QueryBus.php
│   │   │       └── QueryBusInterface.php
│   │   ├── Console
│   │   │   └── Commands
│   │   │       ├── ExportProductsCommand.php
│   │   │       ├── ShowInfoCommand.php
│   │   │       └── TestJob.php
│   │   └── Services
│   │       ├── EmailService.php
│   │       └── ExcelExportService.php
│   ├── Domain
│   │   └── Exceptions
│   │       ├── Handler.php
│   │       └── ProductNotFoundException.php
│   ├── Infrastructure
│   │   ├── Http
│   │   │   ├── Controllers
│   │   │   │   ├── Api
│   │   │   │   │   ├── AuthController.php
│   │   │   │   │   ├── ProductController.php
│   │   │   │   │   └── UserController.php
│   │   │   │   └── Controller.php
│   │   │   ├── Kernel.php
│   │   │   ├── Middleware
│   │   │   │   └── Authenticate.php
│   │   │   └── Requests
│   │   └── Providers
│   │       ├── AppServiceProvider.php
│   │       ├── BusServiceProvider.php
│   │       ├── ProductsServiceProvider.php
│   │       └── UsersServiceProvider.php
│   └── Utils
└── Users
    ├── Application
    │   ├── Commands
    │   │   ├── Create
    │   │   │   ├── CreateUser.php
    │   │   │   ├── CreateUserDTO.php
    │   │   │   └── CreateUserHandler.php
    │   │   ├── Delete
    │   │   │   ├── DeleteUser.php
    │   │   │   └── DeleteUserHandler.php
    │   │   ├── Password
    │   │   │   ├── ChangePassword.php
    │   │   │   ├── ChangePasswordDTO.php
    │   │   │   └── ChangePasswordHandler.php
    │   │   └── Update
    │   │       ├── UpdateUser.php
    │   │       ├── UpdateUserDTO.php
    │   │       └── UpdateUserHandler.php
    │   ├── Console
    │   │   └── CreateUserCommand.php
    │   ├── Queries
    │   │   ├── GetAll
    │   │   │   ├── GetAllUsers.php
    │   │   │   └── GetAllUsersHandler.php
    │   │   └── GetById
    │   │       ├── GetUserById.php
    │   │       └── GetUserByIdHandler.php
    │   ├── Services
    │   └── UseCases
    ├── Domain
    │   ├── Events
    │   │   └── PasswordUpdate.php
    │   ├── Model
    │   │   └── User.php
    │   └── Repository
    │       └── UserRepositoryInterface.php
    └── Infrastructure
        ├── Listeners
        │   └── SendPasswordUpdateEmailListener.php
        ├── Repository
        │   └── UserRepository.php
        └── Requests
            ├── CreateUserRequest.php
            ├── ChangePasswordRequest.php
            └── UpdateUserRequest.php