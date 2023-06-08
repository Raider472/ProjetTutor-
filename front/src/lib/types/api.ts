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
    Desription: string;
    TypeFichier: TypeFichier;
}

export interface TypeFichier {
    TypeDeFichier: string;
    NomFormat: string;
    CategorieFichier: CategorieFichier;
}

export interface CategorieFichier {
    Id : number;
    TypeContenu : string;
}
