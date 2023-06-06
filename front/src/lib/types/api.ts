export interface PlaylistItem {
    Id: number;
    Nom: string;
    Debut: string;
    Fin: string;
    Categorie: string;
    continuerLoop: boolean;
    Pubs: PubItem[];
}

export interface PubItem {
    Id: number;
    Nom: string;
    Duree: number;
}
