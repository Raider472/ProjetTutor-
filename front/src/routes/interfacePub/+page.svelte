<script lang="ts">
    import type { PlaylistItem, PubItem, TypeFichier, CategorieFichier } from "$lib/types/api"
    import { onDestroy } from "svelte";

    export let data
    console.log(data)

    const playlist = data.playlistItem[0]
    const pubs = playlist.Pubs


    let tailleMaxPlay: number
    let incrementation = 0
    let bouclePubs = false
    let timeOutId: number | null = null

    let nomPlaylist = playlist.Nom
    let nomPub = "rien"
    let contenuPubs = ""

    function startPlaylist() {
        bouclePubs = true
        bouclePlay(pubs)
    }

    function bouclePlay(arrayPub: PubItem[]) {
        if(bouclePubs === true) {
            nomPub = arrayPub[incrementation].Nom

            if(arrayPub[incrementation].TypeFichier.CategorieFichier.TypeContenu === "Image") {
                let nomImage = arrayPub[incrementation].Nom.replace(/ /g, '_')
                let extension = arrayPub[incrementation].TypeFichier.TypeDeFichier
                let src = "http://localhost:8100/PHP/assets/" + nomImage + extension
                contenuPubs = `<img src = ${src} />`
            } 
            else if (arrayPub[incrementation].TypeFichier.CategorieFichier.TypeContenu === "Vidéo") {
                let nomVideo= arrayPub[incrementation].Nom.replace(/ /g, '_')
                let extension = arrayPub[incrementation].TypeFichier.TypeDeFichier
                let src = "http://localhost:8100/PHP/assets/" + nomVideo + extension
                let extensionSansPoint = extension.substring(1)
                console.log(extensionSansPoint)
                contenuPubs = `<video width="800" height="600" controls autoplay><source src = ${src} type = video/${extensionSansPoint}></video>`;
            }
            else {
                contenuPubs = arrayPub[incrementation].Desription
            }
            timeOutId = window.setTimeout(() => {
                bouclePlay(arrayPub);
            }, arrayPub[incrementation].Duree * 1000);
            incrementation++
            if (incrementation === arrayPub.length) {
                incrementation = 0
            }
        }
        else {
            nomPub = ""
            nomPlaylist = ""
        }
    }

    function stopBoucle() {
        bouclePubs = false
        /*nomPub = "Stop"
        nomPlaylist = "Stop"
        contenuPubs = "stop"*/
        if(timeOutId) {
            window.clearTimeout(timeOutId)
        }
    }

    onDestroy(()=> {
        if(timeOutId) {
            window.clearTimeout(timeOutId)
        }
    })

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
</script>

<h1>Test Interface pubs</h1>

<section>
    <h1>Test</h1>
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