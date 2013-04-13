Etherpad_API_statistiques
=========================
Version 1.0

Date de sortie : 13 avril 2013

Développé par :

­ Gourgan Hicham
­ Ligeret Julien
­ Verger Cédric
­ Zephir Louis


1/ Principe de l’API

Etherpad : API Statistiques

Cette API renvoie des statistiques sur un etherpad installé en local.

Le résultat est un fichier Json contenant le résultat de la requête.

Vous pouvez tester cette API sur http://cedric­verger.fr/apiStats/texts

(exemple complet :
http://cedric­verger.fr/apiStats/texts/10.40.75.119/9001/boby/JrtaylTYVpCLvxagurJaQT5J
UNZE09Hf/stats/mostRepeated
)

Pour obtenir des statistiques sur vos propres etherpads installés en local :
­ Téléchargez l’API
­ Installez l’API sur le même serveur que vos etherpad.
­ Vous n’avez plus qu’a utiliser l’API en remplissant correctement les paramètres                     
de l’URI (IP, port, padId, clé secrète).

2/ Liste des méthodes disponibles
­  /texts ­­> Indique d’ajouter l’IP
­ /texts/%IP% ­­> indique d’ajouter le port
­ /texts/%IP%/%port% ­­> indique d’ajouter le padId
­ /texts/%IP%/%port%/%padId ­­> indique d’ajouter la clé secrète du pad
­ /texts/%IP%/%port%/%padId/%secretKey% ­­> indique d’ajouter "stats”
­ /texts/%IP%/%port%/%padId/%secretKey%/stats ­­> liste toutes les méthodes           
disponibles

­ /texts/%IP%/%port%/%padId/%secretKey%/stats/count/words ­> compte le       
nombre de mots que contient le pad

Exemple :
{
"nb_words" : "1205"
}

­ /texts/%IP%/%port%/%padId/%secretKey%/stats/count/chars ­> compte le nombre         
de caractères que contient le pad

Exemple :
{
"nb_chars" : "256"
}

­ /texts/%IP%/%port%/%padId/%secretKey%/stats/longest ­> Affiche le mot le plus             
long du pad et son nombre de caractères.

Exemple :
{
"longuest_word" : "Informatique",
“lenght” : “12”
}

­ /texts/%IP%/%port%/%padId/%secretKey%/stats/mostRepeated ­> Affiche pour       
chaque mot, le nombre de fois qu’il a été répété dans l’eterpad. Les mot sont triés du plus répété                                   
au moins répété.

Exemple :
{
"le" : "5",
“a” : “3”,
“chat” : “1”,
“chaussure” : “1”,
“chaussette” : “1”
}
