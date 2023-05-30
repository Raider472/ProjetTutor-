<script lang="ts">
    import { json } from "@sveltejs/kit";
    import type { PlaylistItem } from "./Json.svelte";
    import type { PubItem } from "./Json.svelte";

    const string = "test"
    const url = "http://localhost:8100/"
    let playlist: PlaylistItem[]
    let pubs : PubItem[]
    let tailleMaxPlay: number
    let incrementation = 0
    let boolean = false

    let nomPlaylist : string
    let nomPub = "rien"

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
                throw new Error(erreur)
            })
    }

    function startPlaylist() {
        boolean = true
        bouclePlay(pubs[0].Duree, pubs)
    }

    function bouclePlay(seconde: number, arrayPub: PubItem[]) {
        if(boolean === true) {
            nomPub = arrayPub[incrementation].Nom
            incrementation++
            bouclePlay(arrayPub[incrementation].Duree, arrayPub)
        }
        else {
            nomPub = ""
            nomPlaylist = ""
        }
    }

    function stopBoucle() {
        boolean = false
    }

    function test() {
        console.log(playlist)
        console.log(pubs)
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
</section>