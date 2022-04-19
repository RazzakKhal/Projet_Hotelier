Déploiement de l'application web sur heroku de la manière suivante:

Créer un depot git dans le projet 
Aller sur le site d'heroku, me suis connecté et j'ai cliqué New, create new app
Entrer le nom de mon application
Aller dans Setting, Reveal Config Vars, ajouter la variable d'environnement APP_ENV=prod
Aller dans Ressources, dans adds-on ajouter clearDB pour gérer la base de données 
Retourner dans setting, Reveal Confif Vars, ajouter la variable d'environnement DATABASE_URL=valeurclear-db_database
Creer un fichier Procfile à la source de mon projet sur phpstorm, mettre : web: heroku-php-apache2 public/
Faire git add -A, git commit, git push heroku main
Faire heroku run php bin/console doctrine:migrations:migrate


Le site est disponible sur : https://studi-hypnos-khalfallah.herokuapp.com/
Pour se connecter en tant qu'admin :   hypnosrazzak@gmail.com     /    admin
Pour se connecter en tant que manager : manager1@hotmail.fr    /     managera
Pour se connecter en tant que manager : manager2@hotmail.fr    /     managerb
Pour se connecter en tant que manager : manager3@hotmail.fr    /     managerc
Pour se connecter en tant que manager : manager4@hotmail.fr    /     managerd
Pour se connecter en tant que manager : manager5@hotmail.fr    /     managere
Pour se connecter en tant que manager : manager6@hotmail.fr    /     managerf
Pour se connecter en tant que manager : manager7@hotmail.fr    /     managerg
Pour se connecter en tant que utilisateur : test@gmail.com    /     1234          ou créer un utilisateur via le site