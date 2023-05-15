<script lang="ts">
    let url = "http://localhost:8100/"
    function RecevoirJson() {
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
</script>

<h1>Test API</h1>
<section>
    <button on:click={RecevoirJson}>
        Reçevoir données
    </button>
    <button>
        Envoyer Données
    </button>
    <input type="text">
</section>
