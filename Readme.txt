J'ai déployé mon application web sur heroku de la manière suivante:

J'ai crée un depot git dans le projet 
J'ai été sur le site d'heroku, me suis connecté et j'ai cliqué New, create new app
J'ai entré le nom de mon application
Je suis allé dans Setting, Reveal Config Vars, j'ai ajouté ma variable d'environnement APP_ENV=prod
Je suis ensuite allé dans Ressources, dans adds-on j’ajoute clearDB pour gérer ma base de données 
Je retourne dans setting, Reveal Confif Vars, j'ai ajouté ma variable d'environnement DATABASE_URL=valeurclear-db_database
J'ai crée un fichier Procfile à la source de mon projet sur phpstorm, j’y ai mis : web: heroku-php-apache2 public/
J'ai ensuite fais git add -A, git commit, git push heroku main
Et enfin j'ai fais heroku run php bin/console doctrine:migrations:migrate
