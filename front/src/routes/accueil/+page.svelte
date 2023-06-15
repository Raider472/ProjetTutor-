<script>

    import { enhance } from "$app/forms";
    let user = 'NAE Gabriel';

</script>


<title>Accueil</title>
<div id="pageAc">
    <div class="parent">
        <div class="entete-gauche">
            <p>Diffub</p>
        </div>
        <div class="entete-droit">
            <p>Bienvenue, {user}</p>
        </div>
        <div class="corps-gauche">
            <input id="btn_playlist" type="button" value="Playlists">
            <br>
            <input id="btn_utilisateurs" type="button" value="Utilisateurs">
            <br>
            <input id="btn_terminaux" type="button" value="Terminaux">
            <br>
            <br>
            <input id="btn_creer" type="button" value="Créer une playlist">
            <br>
            <input id="btn_supprimer" type="button" value="Supprimer une playlist">
            <br>
            <input id="btn_modifier" type="button" value="Modifier une playlist">
            <br>
            <input id="btn_historique" type="button" value="Historique d'une playlist">
            <br>
            
        </div>
        <div class="corps-droit">
            <div class="playlistDisplay">
                <p class="titlePlaylist">Playlist</p>
                <div class="testContents">
                <form use:enhance method="POST">
                    <input type="hidden" name="status" value="true">
                    <button class="buttonTest" id="btnStart" type="submit">start</button>
                </form>
                <form use:enhance method="POST">
                    <input type="hidden" name="status" value="false">
                    <button class="buttonTest" id="btnStop" type="submit">stop</button>
                    <label class="buttonTest" id="choixPlaylistLabel" for="choixPlaylist">Choix de playlist :</label>
                </form>
                <form use:enhance method="POST">
                    <select class="buttonTest" id="choixPlaylist" name="playlistSelect">
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style id="dark">
    #pageAc {
        position: relative;
        left: 200px;
        margin: -10px 0 0 0;
    }
    .parent {
        display: grid;
        grid-template-columns: repeat(10, 1fr);
        grid-template-rows: repeat(5, 1fr);
        grid-column-gap: 0px;
        grid-row-gap: 0px;
        height: 100vh;
    }

    .entete-gauche {
        grid-area: 1 / 1 / 2 / 3;
        background-color: #3c3c3c;
        color: white;
        text-align: center;
        font-size: 48px;
    }

    .entete-gauche > p {
        margin-top: 2em;
    }

    .entete-droit {
        grid-area: 1 / 3 / 2 / 9;
        background-color: #888888;
        color: white;
        text-align: left;
        font-size: 48px;
    }

    .entete-droit > p {
        margin-left: 2em;
        margin-top: 2em;
    }

    .corps-gauche {
        grid-area: 2 / 1 / 6 / 3;
        background-color: #888888;
        height: 100%;
        text-align: center;
    }
    .corps-gauche input{
        width: 75%;
        height: 5%;
        margin-top: 5%;
        margin-bottom: 5%;
        border-radius: 50px;
        font-size: 24px;
        background-color: #4E4E4E;
        color: white;
    }

    #btn_creer, #btn_modifier, #btn_supprimer, #btn_historique {
        font-style: italic;
    }

    .playlistDisplay {
        width: 75%;
        height: 15%;
        margin-left: 5em;
        margin-top: 5em;
        border-radius: 30px;
        background-color: #d9d9d99d;
        color: white;
    }

    .playlistDisplay .buttonTest {
        border-radius: 50px;
        font-size: 24px;
        background-color: #4E4E4E;
        color: white;
    }
    
    .playlistDisplay #btnStart {
        margin-left: 200px;
    }

    .playlistDisplay #btnStop {
        margin-right: 6em;
    }

    .playlistDisplay #choixPlaylist {
        position: relative;
        bottom: 2px;
        margin-right: 30px;
        padding: 3px 20px 3px 10px;
    }

    .playlistDisplay #choixPlaylistLabel {
        padding: 5px;
    }

    .playlistDisplay .testContents {
        display: flex;
        flex-direction: row;
        justify-content: space-evenly;
        position: relative;
        bottom: 90px;
        margin-left: 2%;
    }

    .titlePlaylist {
        position: relative;
        bottom: 10px;
        right: 20px;
        text-align: left;
        font-size: 38px;
        margin-left: 2em;
        padding-top: 1.5em;
    }

    .corps-droit {
        grid-area: 2 / 3 / 6 / 9;
        background-color: #3c3c3c;
        height: 100%;
    }
</style>