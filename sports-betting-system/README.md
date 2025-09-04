# Sports Betting System

## Overview
This project is a sports betting system built using the MVC (Model-View-Controller) architecture. It allows users to register, log in, and place bets on various sports events. The application is structured into different folders for models, views, controllers, configuration, and public access.

## Project Structure
```
3. **Create a Dockerfile**: Create a `Dockerfile` in the root of the project with the following content:
   ```
   FROM php:7.4-apache
   COPY . /var/www/html/
   ```

4. **Build the Docker Image**:
   ```
   docker build -t sports-betting-system .
   ```

5. **Run the Docker Container**:
   ```
   docker run -d -p 8080:80 sports-betting-system
   ```

6. **Access the Application**:
   - Open your web browser and navigate to `http://localhost:8080/public/index.php`.

## Usage
- Users can register and log in through the provided forms.
- After logging in, users can view available sports events and place bets.

## Prompt Used
"Create a PHP project architecture using the MVC pattern for a sports betting system, structured into folders (models, views, controllers, config, public), including a database configuration file (PDO + MySQL), an initial SQL script for necessary tables (usuarios, eventos, apostas, transacoes), base files for each layer (generic controller + example controller for user registration/login, generic model + user model, initial view for login screen), examples of routes/controllers for user registration and authentication requirements, and document in README.md how to run the project locally (PHP + MySQL via XAMPP/Laragon or Docker) along with the prompt used."