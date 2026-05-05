# Library Project

A project to tidy up my own library and thoughts.

## Overview

You will be able to : 
- add your own books
- make your own lists
- have your own reviews and ratings
- private your lists, reviews and ratings

## Status

Current status: `in progress`

## Tech Stack

- PHP 8.4+
- Symfony 8
- Doctrine ORM
- Doctrine Migrations

INCOMING 

- React 19.2
- Typescript 6 +

## Project Structure

```text
.
├── backend/
│   ├── config/
│   ├── docs/
│   ├── migrations/
│   ├── public/
│   └── src/
├── frontend/
└── README.md
```

Describe any important folders here.

## Getting Started

### Prerequisites

List what is needed before running the project:
- PHP 8.4+
- Composer
- PostgreSQL 16

### Installation

```bash
git clone <repository-url>
cd library-project
```

```bash
cd backend
composer install
```

### Environment

## Running the Project

```bash
cd backend
symfony server:start
```

## Database

```bash
cd backend
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

## API

### Books

- `GET /api/books` - List books
- `GET /api/books/{id}` - Show one book
- `POST /api/books` - Create a book
- `PUT /api/books/{id}` - Update a book
- `DELETE /api/books/{id}` - Delete a book

## Data Model

- Database schema: [backend/docs/schema-bdd.md](backend/docs/schema-bdd.md)
- Database schema in picture: [backend/docs/schema-bdd.png](backend/docs/schema-bdd.png)


## Testing



