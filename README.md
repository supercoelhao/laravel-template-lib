<div align="center" style="text-align: center;">

# Biblioteca MVC e CRUD

![PHP](https://img.shields.io/badge/PHP-8.0%2B-777BB4?logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-9.x-FF2D20?logo=laravel&logoColor=white)
![LTP](https://img.shields.io/badge/LTP-3-4B556)
![Template](https://img.shields.io/badge/Template%20para%20pr%C3%A1tica-0EA5E9)

Template para praticar a arquitetura MVC do Laravel implementando o cadastro de livros. As rotas e as Views ja estao prontas; a tarefa da turma e criar Model, Migration e Controller e conectar as camadas.

</div>

## Inicializacao

1. Clone o repositorio e entre na pasta do projeto.
2. Instale as dependencias:

   ```bash
   composer install
   ```

3. Crie o arquivo de ambiente e gere a chave da aplicacao:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure no `.env` a conexao com o banco de dados. Para MySQL, informe ao menos `DB_DATABASE`, `DB_USERNAME` e `DB_PASSWORD`.
5. Inicie o servidor:

   ```bash
   php artisan serve
   ```

6. Acesse `http://127.0.0.1:8000`. Antes da implementacao do Controller, a pagina apresentara um erro esperado: a classe `LivroController` ainda nao existe.

## Atividade: implementar o CRUD

### 1. Criar o Model

```bash
php artisan make:model Livro
```

Em `app/Models/Livro.php`, configure os campos liberados para atribuicao em massa com `$fillable`:

```php
protected $fillable = ['titulo', 'autor', 'ano_publicacao', 'isbn'];
```

### 2. Criar a Migration

```bash
php artisan make:migration create_livros_table --create=livros
```

Na migration, crie a tabela `livros` com os campos abaixo:

| Campo | Tipo sugerido | Regra |
| --- | --- | --- |
| `id` | id | chave primaria |
| `titulo` | string | obrigatorio |
| `autor` | string | obrigatorio |
| `ano_publicacao` | unsignedSmallInteger | obrigatorio |
| `isbn` | string | opcional |
| `created_at` e `updated_at` | timestamps | padrao do Laravel |

Depois execute:

```bash
php artisan migrate
```
 teste
### 3. Criar o Controller

```bash
php artisan make:controller LivroController --resource
```

Implemente os metodos do resource controller usando `App\Models\Livro`:

| Metodo | Responsabilidade |
| --- | --- |
| `index` | buscar os livros e retornar `livros.index` com a variavel `$livros` |
| `create` | retornar `livros.create` |
| `store` | validar, cadastrar e redirecionar para a listagem |
| `edit` | receber o `Livro` e retornar `livros.edit` com `$livro` |
| `update` | validar, atualizar e redirecionar para a listagem |
| `destroy` | excluir o livro e redirecionar para a listagem |

Sugestao de validacao:

```php
[
    'titulo' => ['required', 'string', 'max:255'],
    'autor' => ['required', 'string', 'max:255'],
    'ano_publicacao' => ['required', 'integer', 'min:1000', 'max:' . now()->year],
    'isbn' => ['nullable', 'string', 'max:20'],
]
```

## Rotas e Views fornecidas

A rota `Route::resource('livros', LivroController::class)` ja esta em `routes/web.php`. Ela cria as rotas de listagem, criacao, edicao, atualizacao e exclusao.

As Views estao organizadas para evidenciar a camada View:

- `resources/views/layouts/app.blade.php`: layout principal.
- `resources/views/partials/header.blade.php` e `footer.blade.php`: templates reutilizaveis.
- `resources/views/livros/index.blade.php`: listagem, botoes de edicao e exclusao.
- `resources/views/livros/create.blade.php` e `edit.blade.php`: telas de formulario.
- `resources/views/livros/_form.blade.php`: campos compartilhados pelos dois formularios.

O botao Excluir envia um formulario com os verbos `POST` e `DELETE`, incluindo a protecao CSRF do Laravel.
