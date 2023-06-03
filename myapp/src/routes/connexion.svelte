<script lang="ts">
  let login = "";
  let mdp = "";
  let labelMdp = "";
  let url = "http://localhost:8100";

  function connexion(): void {
    const data = new FormData();
    data.append("login", login);
    data.append("mdp", mdp);
    fetch(url + "?op=connexion", {
      method: "POST",
      body: data,
    })
      .then(function (response) {
        if (response.ok) {
          return response.json();
        }
      })
      .then(function (json) {
        console.log(json);
        if (json === true) {
          window.location.href = "/accueil";
        } else {
          labelMdp = "erreur connexion";
        }
      })
      .catch(function (erreur) {
        labelMdp = erreur.message;
      });
  }
</script>

<section>
  <div id="div_page">
    <div id="div_logo">
      <header class="tete" id="nomApp">
        <p id="nom_app">PlaylistsAPI</p>
      </header>
      <img id="logo" src="" alt="" />
      <br />
      <p>
        Diffusez vos pubs sur un ou plusieurs terminaux avec vos playlists personnalisées !      
      </p>
    </div>
    <div id="div_connexion">
      <header class="tete" id="nomPage" />
      <div id="int">
        <div id="div_login" class="tool_connexion">
          <label class="label" id="lab_login" for="edt_login">Login :</label>
          <br /><br />
          <input type="text" id="edt_login" bind:value={login} />
        </div>
        <br />
        <div id="div_mdp" class="tool_connexion">
          <label class="label" for="edt_mdp"> Mot de passe : </label>
          <br /><br />
          <input type="password" id="edt_mdp" bind:value={mdp} />
        </div>
        <div id="div_bouton" class="tool_connexion">
          <br />
          <button on:click={connexion} id="btn_connexion">Connexion</button>
          <h2>{labelMdp}</h2>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
  section {
    margin: 3em 3em 3em 3em;
  }

  #logo {
    margin-top: 10px;
    height: 150px;
    width: 150px;
  }
  #div_page {
    margin: auto;
    height: 30em;
    width: 70em;
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
    margin: 15% 20% 20% 35%;
  }

  #btn_connexion {
    margin-left: 50px;
    border-radius: 30px;
    border: 1px solid #888888;
    background-color: #888888;
    color: #FFFFFF;
  }

  .tool_connexion {
  }

  #div_logo {
    height: 100%;
    width: 35%;
    background-color: #888888;
    color: #FFFFFF;
    text-align: center;
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
