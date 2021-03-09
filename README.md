# edt
projet web avancé

validators: 
- Nous avons cherché une solution pour qu'un professeur ne puisse pas être ajouté à deux cours le même jour à la même heure, et pour qu'une salle ne puisse pas être prise par deux cours à la même heure. Cette condition fonctionne mais uniquement si l'on met la même heure de début (par exemple, si un prof a un cours entre 10h et 12h, si l'on rajoute un cours le même jour qui commence à 10h pour ce même professeur, un message d'erreur va s'afficher, en revanche si le cours ne commence pas à la même heure mais est situé entre 10h et 12h, l'erreur ne va pas être prise en compte)
- Le validator permettant que la dateHeureDebut soit antérieure à la dateHeureFin fonctionne 
