function supprimerPost(idPost) {
    const url = "./delete.php";

    /* Il envoie une requête GET à l'url avec l'idPost en paramètre. */
    fetch(url + "?idPost=" + idPost)
    
    .then(
        response => {
            return response.json();
        }
    )
    .then(
        result => {
            if(result == 1){
                document.getElementById("supprimer" + idPost).remove();
            }
        }
    );
}
