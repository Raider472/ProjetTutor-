<script lang="ts" async>
    let url = "http://localhost:8100/"
    let pseudo = ""
    let mdp = ""
    let categorie = ""
    function RecevoirJson(): void {
        fetch(url)
            .then(function (response) {
                if(response.ok) {
                    return response.json()
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
        const data = new FormData();
        data.append("login", pseudo)
        data.append("mdp", mdp)
        data.append("idCategorie", categorie)
        fetch(url+"?op=ajout", {
            method: 'POST',
            body: data
        })
            .then(function (response) {
                if(response.ok) {
                    return console.log("success")
                }
            })
            .catch(function (erreur) {
                alert(erreur.message)
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
        <input type="text" bind:value={pseudo}>
    </label>
    <br>
    <label>
        mot de passe
        <input type="text" bind:value={mdp}>
    </label>
    <br>
    <label>
        Categorie
        <input type="text" bind:value={categorie}>
    </label>
</section>
