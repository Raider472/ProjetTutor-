<script lang="ts">
    let login = ""
    let mdp = ""
    let labelMdp = ""
    let url = "http://localhost:8100/PHP/API.php"

    function connexion(): void {
        const data = new FormData();
        data.append("login", login)
        data.append("mdp", mdp)
        fetch(url+"?op=connexion", {
            method: 'POST',
            body: data
        })
            .then(function (response) {
                if(response.ok) {
                    return response.json()
                }
            })
            .then(function (json) {
                console.log(json)
                if(json === true) {
                    window.location.href = '/accueil'
                }
                else {
                    labelMdp = "erreur connexion"
                }
            })
            .catch(function (erreur) {
                labelMdp = erreur.message
            })
    }
</script>

<section>
    <label>
        login
        <input type="text" bind:value={login}>
    </label>
    <br>
    <label>
        mot de passe
        <input type="text" bind:value={mdp}>
    </label>
    <br>
    <button on:click={connexion}>
        Connexion
    </button>
    <h2>{labelMdp}</h2>
</section>