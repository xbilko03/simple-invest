# Simple Invest

## DESCRIPTION

This is a fullstack application for managing users, their transactions, and requests. The frontend (React) handles the user interface and interactions, while the backend (PHP) manages data and business logic.

## REQUIREMENTS

- **Frontend:**
  - React (v18.3.1)

- **Backend:**
  - PHP 8.1

## BACKEND STRUCTURE

The backend consists of the following key components:

- **index.php**: The core of the PHP server. This file handles incoming requests and redirects them to the appropriate API scripts in the `/trading/` folder.

- **/private/**: This directory contains the application data:
  - **users.csv**: CSV file that holds the data about users
  - **transactions.csv**: CSV file that holds the data about transactions
  - **tickets.csv**: CSV file that holds the data about tickets

- **/trading/**: This directory contains the API scripts:
  - **add.php**: API script to handle adding the app data
  - **authenticate.php**: API script to handle the authentication of a user
  - **common.php**: Common functionalities for the API scripts
  - **delete.php**: API script to handle deleting the app data
  - **download.php**: API script to handle downloading the app data
  - **get.php**: API script to handle reading the app data
  - **update.php**: API script to handle updating the app data
  - **upload.php**: API script to handle uploading the app data

## FRONTEND STRUCTURE