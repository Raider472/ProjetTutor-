<script lang="ts">
    let string = "test"
    let url = "http://localhost:8100/"

    function commencerBoucle() {
        fetch(url+"?op=affichagePubs", {
            method: 'POST'
        })
            .then(function (response) {
                if(response.ok) {
                    return response.json()
                }
            })
            .then(function (json) {
                console.log(json)
            })
            .catch(function (erreur) {
                alert(erreur.message)
            })
    }
</script>

<h1>Test Interface pubs</h1>

<section>
    {string}
    <button on:click={commencerBoucle}>Test recevoir</button>
</section>