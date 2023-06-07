import { SECRET_API_URL } from '$env/static/private';
import type { PlaylistItem } from '$lib/types/api.js';

export const load = async ({fetch}) => {
    const res = await fetch(`${SECRET_API_URL}?op=affichagePubs`)
    const playlistItem = await res.json() as PlaylistItem[]

    return {
        playlistItem: structuredClone(playlistItem)
    }
}