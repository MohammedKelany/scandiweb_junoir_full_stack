# Scandiweb Test Assignment

This Repository if For Junior Fullstack Test Assignment for Scandiweb. The Assignment is built using the following technologies:

- **Backend**: PHP, MySQL, GraphQL
- **Frontend**: React.js, Apollo Client, Plain css
- **Utilities**:
   - *backend* phpdotenv, FastRoute
   - *frontend* dotenv, react-toastify, dompurify, html-react-parser

## Table of Contents For Application

- [Scandiweb Assignment](#scandiweb-test-assignment)
  - [Table of Contents](#table-of-contents-for-application)
  - [Overview](#overview)
  - [Prerequisites](#prerequisites)
  - [Project Structure](#project-structure)


## Overview

This application provides a simple eCommerce platform featuring product listings and cart functionality. It includes two main pages:

1. **Categories Page**

   - Displays a list of products within a selected category comming from Database.
   - The default view of the website, and as default it returns the first category.

2. **Product Details Page (PDP)**
   - Shows detailed information about a selected product, including images and descriptions.
   - Allows users to configure their product options before adding the item to the cart.
   - "Add to Cart" button for adding products to cart after selecting the needed attributes .

## Prerequisites

Ensure you have the following softwares installed on your system to run the project without any errors:

- [PHP](https://www.php.net/) (Hypertext Preprocessor)
- [MySQL](https://www.mysql.com/) (or any other compatible relational database)
- [Composer](https://getcomposer.org/) (Dependency Manager for PHP)
- [NPM](https://nodejs.org/en/download) (Node Package Manager needed for Reactjs)


## Project Structure

The project structure is designed to maintain clarity and organization. Here's a brief overview of the key directories:

- **react-view/**: This directory is the Location for the ReactJS frontend, where the user interface is developed and managed. All frontend-related assets and components are organized within this section and withen the src directory there are:

  - **assets/**: Contains static assets like images.

  - **components/**: Contains reusable React components that form the building blocks of the user interface.and that comonents are:
    - *Layout*: Contains the Layout of the applicaion.
    - *Partials*: Contains the differant partials like Header, Card and so on.
    - *Pages*: Contains the Pages and the OverlayView for the applicaion 

  - **graphql/**: Holds all graphql mutations and queries for the appliction.\

  - **client/**: Holds the Apollo Client for the applicaion that handels graphql requests and responses.

  - **contexts**: Has the ContextProvider that Defines the data context for the application. This context is used to share data and state across different components without prop drilling, making state management more efficient.

  - **router.jsx**: Contains the app routes and routing logic. This file defines how different URLs map to specific Pages.

- **src/**: This Directory defines the core classes for the backend:

  - **Database.php**: Class responsible for managing the database connection, providing methods to connect and interact with the database and appling migraions.

  - **Application.php**: Class responsable for holding the database as a singletone accross the applicaion.

  - **Controller.php**: Abstract Class that have the needed functions for any controller to have.

  - **Seeder.php**: Class that extends the Database.php class and seed have static funcion seed to seed the data inside the database. 
  
  - **support/**: Holds helpers.php for simple helper functions.

- **config/**: Contains Config class that holds the configration data for the application.

- **app/**: Holds the main logic for applicaion backend and it contains:

  - **graphql/**: Manages the GraphQL types, inputs and Register class that register types and inputs.

  - **models/**: Contains the models associated with the application that holds the data for each type and input in Graphql.

  - **Controller/**: Holds the business logic for the applicaion.


- **public/**: Serves as the entry point for the backend applicaion.

- **migrations/**: That Directory Holds all migraions classes. Each class implements the MigrationInterface.php that has two funcions up and down that all migration classes should has. By adding a migration file to migraions file and running commands\migraions.php all migrations will be applied including that migration.

- **commands/**: Running files inside them will apply a needed command for us:

  - **migrations.php**: That file will apply the migrions inside migrations directory.

  - **seed.php**: That file will seed the database with the provided data. 

- **.env.example**: Example environment configuration file. Rename to `.env` with the specific configuration settings.

- **schema.sql**: SQL script for setting up the database schema. It includes the necessary table definitions and relations required data by the application.

- **docker/**: Docker installation for both frontend and backend.