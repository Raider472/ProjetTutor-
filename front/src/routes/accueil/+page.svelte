<script>

    import { enhance } from "$app/forms";

</script>
<title>Accueil</title>

<div id="pageAc">
    <div class="parent">
        <div class="entete-gauche">
            NOM APP
        </div>
        <div class="entete-droit">Bienvenue</div>
        <div class="corps-gauche">
            <input id="btn_playlist" type="button" value="Playlists">
            <br>
            <input id="btn_utilisateurs" type="button" value="Utilisateurs">
            <br>
            <input id="btn_terminaux" type="button" value="Terminaux">
            <br>
            <br>
            <input id="btn_creer" type="button" value="crÃ©er">
            <br>
            <input id="btn_supprimer" type="button" value="supprimer">
            <br>
            <input id="btn_modifier" type="button" value="modifier">
            <br>
            <input type="button" value="Historique">
            <br>
            <form use:enhance method="POST">
                <input type="hidden" name="status" value="true">
                <button type="submit">start</button>
            </form>
            <form use:enhance method="POST">
                <input type="hidden" name="status" value="false">
                <button type="submit">stop</button>
            </form>
        </div>
        <div class="corps-droit"></div>
    </div>
</div>

<style>
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
    }

    .entete-droit {
        grid-area: 1 / 3 / 2 / 9;
        background-color: #888888;
        color: white;
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

    .corps-droit {
        grid-area: 2 / 3 / 6 / 9;
        background-color: #3c3c3c;
        height: 100%;
    }
</style>
