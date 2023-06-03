<script lang="ts">






</script>

<body>
    <header>Ajout d'une pub</header>
    <form id="pubForm">
        <label for="urlVideoInput">Vidéo par URL Internet</label>
        <input type="search" id="urlInput" name="urlVideoInput">
        <label for="pubsdispInput">Contenu disponible dans la base de données</label>
        <input type="search" id="pubsdispInput" name="pubsdispInput">
        <div id="tabContenu">
            <table>
                <tr>
                    <th>Pub textuelle</th>
                    <th>Pub imagée</th>
                    <th>Pub vidéo</th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
          </table>
        <div id="boutonContenu">
            <button type="submit">Confirmer</button>
            <button type="submit">Retour</button>
        </div>

    </form>
    
</body>


<style>
    body {
        background-color: #9B9B9B;
        font-family: 'Roboto', sans-serif;
        text-align: center;
    }
    header {
        font-size: 2em;
        padding-bottom: 5%;
    }
    input {
        display : flex;
        justify-content: center;
        margin: 0 auto 2% auto;
        width: 595px;
        height: 34px;
    }
    #urlInput {
        background: url(../../assets/icons8-search-50.png) no-repeat right/5% rgb(255, 255, 255);
    }
    #pubsdispInput {
        background: url(../../assets/icons8-search-50.png) no-repeat right/5% rgb(255, 255, 255);
    }
    #tabContenu {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 25vh;
    }
    table,td {
        background: #E3E3E3;
        border: 1px solid #333;
    }
    td {
        padding: 30px 100px 30px 100px;
    }
    #boutonContenu {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    #boutonContenu button {
      margin: 0 10px;
      width: 287.11px;
      height: 30.02px;
    }
    
</style>