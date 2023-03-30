function supprimerPost(idPost) {
    const url = "./delete.php";

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
