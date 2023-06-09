<script lang="ts">
    import type {PubItem} from "$lib/types/api"
    import { onDestroy } from "svelte";
    import { PUBLIC_API_ASSETS_URL } from '$env/static/public';

    import ImageInterfacePub from "$lib/components/ImageInterfacePub.svelte"
    import VideoInterfacePub from "$lib/components/VideoInterfacePub.svelte"
    import { fade } from "svelte/transition";

    export let data
    console.log(data)

    const playlist = data.playlistItem[0]
    const pubs = playlist.Pubs

    const inTransition = {delay:250}
    const outTransition = {duration:250}

    let tailleMaxPlay: number
    let incrementation = 0
    let bouclePubs = false
    let timeOutId: number | null = null

    let nomPlaylist = playlist.Nom
    let nomPub = "rien"

    let src : string
    let extensionSansPoint : string
    let typePubs : string
    let contenuPubs : string

    function startPlaylist() {
        bouclePubs = true
        bouclePlay(pubs)
    }

    function bouclePlay(arrayPub: PubItem[]) {
        if(bouclePubs === true) {
            nomPub = arrayPub[incrementation].Nom
            typePubs = arrayPub[incrementation].TypeFichier.CategorieFichier.TypeContenu

            if(arrayPub[incrementation].TypeFichier.CategorieFichier.TypeContenu === "Image") {
                let nomImage = arrayPub[incrementation].Nom.replace(/ /g, '_')
                let extension = arrayPub[incrementation].TypeFichier.TypeDeFichier
                src = PUBLIC_API_ASSETS_URL + nomImage + extension
            } 
            else if (arrayPub[incrementation].TypeFichier.CategorieFichier.TypeContenu === "Vidéo") {
                let nomVideo= arrayPub[incrementation].Nom.replace(/ /g, '_')
                let extension = arrayPub[incrementation].TypeFichier.TypeDeFichier
                src = PUBLIC_API_ASSETS_URL + nomVideo + extension
                extensionSansPoint = extension.substring(1)
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
    <main>
        {#if typePubs === "Image"}
            <div in:fade={inTransition} out:fade={outTransition}>
                <ImageInterfacePub source={src} {nomPub}/>
            </div>
        {:else if typePubs === "Vidéo"}
            <div in:fade={inTransition} out:fade={outTransition}>
                <VideoInterfacePub source={src} videoExtension={extensionSansPoint}/>
            </div>
        {:else if typePubs === "Texte"}
            <p in:fade={inTransition} out:fade={outTransition}>{contenuPubs}</p>
        {/if}
    </main>
</section>