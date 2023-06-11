<script lang="ts">
    import type {PubItem} from "$lib/types/api"
    import { onDestroy, onMount } from "svelte";
    import { PUBLIC_API_ASSETS_URL } from '$env/static/public';

    import ImageInterfacePub from "$lib/components/ImageInterfacePub.svelte"
    import VideoInterfacePub from "$lib/components/VideoInterfacePub.svelte"
    import { fade } from "svelte/transition";
    import { invalidateAll } from "$app/navigation";
    import { browser } from "$app/environment";

    export let data
    console.log(data)

    $: playlist = data.playlistItem[0]

    const inTransition = {delay:250}
    const outTransition = {duration:250}

    let tailleMaxPlay: number
    let incrementation = 0
    let bouclePubs = false
    let timeOutId: number | null = null
    let pollingInterval: number | null = null

    let nomPub = "rien"

    let src : string
    let extensionSansPoint : string
    let typePubs : string
    let contenuPubs : string

    function startPlaylist() {
        bouclePubs = true
        bouclePlay(playlist.Pubs)
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
        }
    }

    function stopBoucle() {
        bouclePubs = false
        /*nomPub = "Stop"
        nomPlaylist = "Stop"
        contenuPubs = "stop"*/
        console.log("stopped")
        if(timeOutId) {
            window.clearTimeout(timeOutId)
            timeOutId = null
        }
    }

    function checkPlaying(isPlaying: boolean) {
        if(!browser) {
            return
        }
        console.log("checkPlaying")
        if(isPlaying) {
            if(timeOutId) {
                return
            }
            startPlaylist()
        } else {
            if(!timeOutId) {
                return
            }
            stopBoucle()
        }
    }

    $: checkPlaying(playlist.Playing)

    onMount(() => {
        pollingInterval = window.setInterval(() => {
            invalidateAll()
        }, 5000)
    })

    onDestroy(() => {
        if(timeOutId) {
            window.clearTimeout(timeOutId)
            timeOutId = null
        }
        if(pollingInterval) {
            window.clearInterval(pollingInterval)
            pollingInterval = null
        }
    })
</script>

<h1>Test Interface pubs</h1>

<section>
    <h1>Test</h1>
    <br>
    {playlist?.Nom ?? "Vide"}
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