<script lang="ts" async>
    let url = "http://localhost:8100/"
    function RecevoirJson(): void {
        fetch(url)
            .then(function (response) {
                if(response.ok) {
                    return response.json()
                }
                else {
                    alert("problème")
                }
            })
            .catch(function (erreur) {
                alert(erreur.message)
            })
            .then(function (utilisateur) {
                console.log(utilisateur)
            })
    }

    function envoyerDonnées(): void {
        let pseudo = document.querySelector("#pseudo") as HTMLInputElement
        let mdp = document.querySelector("#mdp") as HTMLInputElement
        let categorie = document.querySelector("#categorie") as HTMLInputElement
        const data = new FormData();
        data.append("login", pseudo.value)
        data.append("mdp", mdp.value)
        data.append("idCategorie", categorie.value)

        fetch(url+"?op=ajout", {
            method: 'POST',
            body: data
        })
    }
</script>

<h1>Test API</h1>
<section>
    <button on:click={RecevoirJson}>
        Reçevoir données
    </button>
    <button on:click={envoyerDonnées}>
        Envoyer Données
    </button>
    <br>
    <label>
        pseudo
        <input type="text" id="pseudo">
    </label>
    <br>
    <label>
        mot de passe
        <input type="text" id="mdp">
    </label>
    <br>
    <label>
        Categorie
        <input type="text" id="categorie">
    </label>
</section>
