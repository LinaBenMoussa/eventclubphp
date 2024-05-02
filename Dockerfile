# Utilisation d'une image de base avec Apache préinstallé
FROM php:7.4-apache

# Définition du répertoire de travail dans le conteneur
WORKDIR /var/www/html/projetPFE

# Copie de tous les fichiers de votre projet dans le répertoire de travail du conteneur
COPY . /var/www/html/projetPFE

# Exposition du port 80 (par défaut pour Apache)
EXPOSE 80