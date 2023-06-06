<script lang="ts">
    import type { PlaylistItem, PubItem } from "$lib/types/api";

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
            incrementation++
            if (incrementation === pubs.length) {
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
        nomPub = "Stop"
        nomPlaylist = "Stop"
        clearTimeout(timeOutId)
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
    <button on:click={fetchPlaylistInfo}>Test recevoir</button>
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