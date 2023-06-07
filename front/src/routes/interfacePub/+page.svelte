<script lang="ts">
    import type { PlaylistItem, PubItem, TypeFichier, CategorieFichier } from "$lib/types/api";

    const string = "test"
    const url = "http://localhost:8100/"
    let playlist: PlaylistItem[]
    let pubs : PubItem[]

    let tailleMaxPlay: number
    let incrementation = 0
    let boolean = false
    let timeOutId: ReturnType<typeof setTimeout>

    let nomPlaylist : string
    let nomPub = "rien"
    let contenuPubs = ""

    async function fetchPlaylistInfo() {
        return fetch(url+"?op=affichagePubs", {
            method: 'POST'
        })
            .then(function (response) {
                if(response.ok) {
                    return response.json()
                }
            })
            .then(function (json) {
                playlist = json
                pubs = json[0].Pubs

                tailleMaxPlay = pubs.length
                nomPlaylist = json[0].Nom

            })
            .catch(function (erreur) {
                console.error(erreur)
            })
    }

    function startPlaylist() {
        boolean = true
        bouclePlay(pubs)
    }

    function bouclePlay(arrayPub: PubItem[]) {
        if(boolean === true) {
            console.log(incrementation)
            nomPub = arrayPub[incrementation].Nom
            console.log(arrayPub[incrementation].TypeFichier.CategorieFichier.TypeContenu)
            if(arrayPub[incrementation].TypeFichier.CategorieFichier.TypeContenu === "Image") {
                let nomImage = arrayPub[incrementation].Nom.replace(/ /g, '_')
                let extension = arrayPub[incrementation].TypeFichier.TypeDeFichier
                let src = "./src/lib/assets/" + nomImage + extension
                contenuPubs = "<img src = \"" + src + "\" />"
            } else if (arrayPub[incrementation].TypeFichier.CategorieFichier.TypeContenu === "Vidéo") {
                let nomVideo= arrayPub[incrementation].Nom.replace(/ /g, '_')
                let extension = arrayPub[incrementation].TypeFichier.TypeDeFichier
                let src = "./src/lib/assets/" + nomVideo + extension
                let extensionSansPoint = extension.replace(/./g, '');
                contenuPubs = "<video width=\"800\" height=\"600\" controls autoplay> <source src = \"" + src  + "\"" + "type = video/mp4 \"\"></video>";
            }
            else {
                contenuPubs =   arrayPub[incrementation].TypeFichier.NomFormat
            }
            incrementation++
            if (incrementation === arrayPub.length) {
                incrementation = 0
            }
            timeOutId = setTimeout(() => {
                bouclePlay(arrayPub);
            }, arrayPub[incrementation].Duree * 1000);
        }
        else {
            nomPub = ""
            nomPlaylist = ""
        }
    }

    function stopBoucle() {
        boolean = false
        /*nomPub = "Stop"
        nomPlaylist = "Stop"
        contenuPubs = "stop"*/

        clearTimeout(timeOutId)
    }

    function test() {
        console.log(playlist)
        console.log(pubs)
        console.log(pubs[0].TypeFichier.NomFormat)
        console.log(pubs[0].TypeFichier.TypeDeFichier)
        console.log(pubs[0].TypeFichier.CategorieFichier)
        let test = pubs[0].TypeFichier.CategorieFichier
        console.log(test)
        console.log(test.Id)
        console.log(test.TypeContenu)
        console.log(tailleMaxPlay)
        console.log(incrementation)
    }
    fetchPlaylistInfo()
</script>

<h1>Test Interface pubs</h1>

<section>
    {string}
    <button on:click={test}>Test recevoir</button>
    <br>
    <button on:click={startPlaylist}>start</button>
    <br>
    <button on:click={stopBoucle}>stop</button>
    <br>
    <br>
    {nomPlaylist}
    <br>
    {nomPub}
    <br>
    {@html contenuPubs}
</section>