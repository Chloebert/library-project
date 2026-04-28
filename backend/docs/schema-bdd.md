# bdd schema

```mermaid
erDiagram
    USER {
        int id PK
        string username
        string email UK
        string password
        datetime creation_date
        boolean active
    }

    LIST {
        int id PK
        int user_id FK
        string title
        string description
        datetime dateCreation
    }

    BOOK {
        int id PK
        string title
        string description
        datetime created_at
        int length
        date issue_date
    }

    REVIEW {
        int id PK
        int user_id FK
        int book_id FK
        int rating
        string comment
        datetime created_at
    }

    GENRE {
        int id PK
        string name
    }

    AUTHOR {
        int id PK
        string name
    }

    BOOK_GENRE {
        int book_id PK,FK
        int genre_id PK,FK
    }

    BOOK_AUTHOR {
        int book_id PK,FK
        int author_id PK,FK
    }

    LIST_BOOK {
        int list_id PK,FK
        int book_id PK,FK
    }

    USER ||--o{ LIST : "un utilisateur cree plusieurs listes"
    LIST ||--o{ LIST_BOOK : "une liste contient plusieurs livres"
    BOOK ||--o{ LIST_BOOK : "un livre peut apparaitre dans plusieurs listes"
    USER ||--o{ REVIEW : "un utilisateur ecrit plusieurs avis"
    BOOK ||--o{ REVIEW : "un livre recoit plusieurs avis"

    BOOK ||--o{ BOOK_GENRE : "un livre peut avoir plusieurs genres"
    GENRE ||--o{ BOOK_GENRE : "un genre peut concerner plusieurs livres"

    BOOK ||--o{ BOOK_AUTHOR : "un livre peut avoir plusieurs auteurs"
    AUTHOR ||--o{ BOOK_AUTHOR : "un auteur peut ecrire plusieurs livres"
```

## Lecture du schema

- `USER` et `LIST` sont en one-to-many : un utilisateur peut creer plusieurs listes, chaque liste appartient a un seul utilisateur.
- `LIST` et `BOOK` sont en many-to-many via `LIST_BOOK` : une liste contient plusieurs livres, et un livre peut apparaitre dans plusieurs listes.
- `REVIEW` relie un utilisateur a un livre avec une note et un commentaire.
- `BOOK_GENRE`, `BOOK_AUTHOR` et `LIST_BOOK` sont des tables de jointure.

## Legende des notations

- `||` : exactement un
- `o{` : zero a plusieurs
- `PK` : cle primaire
- `FK` : cle etrangere
- `UK` : contrainte d'unicite

Exemples :

- `USER ||--o{ LIST` : un utilisateur peut avoir plusieurs listes, mais une liste appartient a un seul utilisateur.
- `BOOK ||--o{ REVIEW` : un livre peut avoir zero, un ou plusieurs avis.
- `LIST ||--o{ LIST_BOOK` et `BOOK ||--o{ LIST_BOOK` : la relation entre listes et livres passe par une table de jointure, donc c'est un many-to-many.
