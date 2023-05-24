<section>
    <div id="div_page">
        <div id="div_logo">
            <header class="tete" id="nomApp"></header>
            <img src="" alt="">
            <br>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Accusantium commodi eligendi, eos ex laborum
                magni molestiae necessitatibus, nisi odio reprehenderit sint
                temporibus voluptas, voluptatibus. Esse explicabo fugit quidem. Ipsam, possimus.
            </p>

        </div>
        <div id="div_connexion">
            <header class="tete" id="nomPage"></header>
            <div id="int">
                <div id="div_login" class="tool_connexion">
                    <label class="label" id="lab_login">login :</label>
                    <br><br>
                    <input type="text" id="edt_login" bind:value={login}>
                </div>
                <br>
                <div id="div_mdp" class="tool_connexion">
                    <label class="label"> mot de passe : </label>
                    <br><br>
                    <input type="password" id="edt_mdp" bind:value={mdp} size="">
                </div>
                <div id="div_bouton" class="tool_connexion">
                    <br>
                    <button on:click={connexion} id="btn_connexion">Connexion</button>
                    <h2>{labelMdp}</h2>
                </div>
            </div>
        </div>

    </div>
</section>

<style>
    section {
        position: absolute;
        top: 25%;
        left: 25%;
        right: 25%;
        bottom: 25%;
    }

    #div_page {
        margin: auto;
        height: 500px;
        width: 1000px;
        display: flex;
        flex-direction: row;
        justify-content: center;


    }

    .label {
        color: white;
    }

    #div_connexion {
        width: 60%;
        height: 100%;
        background-color: #3c3c3c;

    }

    #int {
        margin-left: 200px;
        margin-top: 100px;
    }

    #btn_connexion {
    margin-left: 50px;
    }

    .tool_connexion {

    }

    #div_logo {
        height: 100%;
        width: 40%;
        background-color: #888888;
    }


    .tete {
        padding: 25px;
    }

    #nomApp {
        background-color: #3c3c3c;

    }

    #nomPage {
        background-color: #888888;
    }
</style>


<script lang="ts">
    let login = ""
    let mdp = ""
    let labelMdp = ""
    let url = "http://localhost:8100"

    function connexion(): void {
        const data = new FormData();
        data.append("login", login)
        data.append("mdp", mdp)
        fetch(url + "?op=connexion", {
            method: 'POST',
            body: data
        })
            .then(function (response) {
                if (response.ok) {
                    return response.json()
                }
            })
            .then(function (json) {
                console.log(json)
                if (json === true) {
                    window.location.href = '/accueil'
                } else {
                    labelMdp = "erreur connexion"
                }
            })
            .catch(function (erreur) {
                labelMdp = erreur.message
            })
    }
</script>

