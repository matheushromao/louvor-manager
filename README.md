# Louvor Manager 🎵

Sistema web desenvolvido para gerenciamento de músicas, categorias e repertórios de louvor para igrejas e ministérios musicais.

---

# 📌 Sobre o Projeto

O **Louvor Manager** foi desenvolvido com foco em organização de repertórios de culto, cadastro de músicas e gerenciamento administrativo.

A proposta da aplicação é facilitar o controle das músicas utilizadas pelo ministério de louvor, permitindo criar repertórios de forma simples e organizada.

---

# 🚀 Funcionalidades

## 🔐 Autenticação

- Login de usuários
- Registro de usuários
- Logout
- Controle de acesso com Middleware

---

## 👑 Área Administrativa

Usuários administradores podem:

### Categorias
- Criar categorias
- Editar categorias
- Excluir categorias
- Listar categorias

### Músicas
- Criar músicas
- Editar músicas
- Excluir músicas
- Listar músicas
- Associar músicas a categorias
- Definir tom da música

### Repertórios
- Criar repertórios
- Associar várias músicas ao repertório
- Editar repertórios
- Excluir repertórios
- Visualizar músicas do repertório

---

# 🛠 Tecnologias Utilizadas

## Backend
- PHP 8.2
- Laravel 11

## Frontend
- Blade
- Tailwind CSS
- Vite

## Banco de Dados
- MySQL

## Arquitetura
- MVC
- Service Layer
- Form Requests
- Middleware
- Eloquent ORM

---

# 📂 Estrutura do Projeto

```txt
app/
├── Http/
│   ├── Controllers/
│   ├── Middleware/
│   └── Requests/
│
├── Models/
│
├── Services/
│
resources/
├── views/
│   ├── categorias/
│   ├── musicas/
│   ├── repertorios/
│   ├── components/
│   └── layouts/
```

---

# 🧠 Conceitos Aplicados

- CRUD Completo
- Relacionamentos One-to-Many
- Relacionamentos Many-to-Many
- Validação de formulários
- Componentização Blade
- Paginação
- Controle de permissões
- Código limpo
- Separação de responsabilidades

---

# 🔄 Relacionamentos do Banco

## Categoria → Músicas

Uma categoria pode possuir várias músicas.

```txt
Categoria 1:N Música
```

---

## Repertório → Músicas

Um repertório pode possuir várias músicas.

Uma música pode pertencer a vários repertórios.

```txt
Repertório N:N Música
```

---

# ⚙️ Como Rodar o Projeto

## 1️⃣ Clone o repositório

```bash
git clone https://github.com/seu-usuario/louvor-manager.git
```

---

## 2️⃣ Acesse a pasta

```bash
cd louvor-manager
```

---

## 3️⃣ Instale as dependências

```bash
composer install
```

```bash
npm install
```

---

## 4️⃣ Configure o .env

Copie o arquivo:

```bash
cp .env.example .env
```

Configure:
- banco de dados
- usuário
- senha

---

## 5️⃣ Gere a chave

```bash
php artisan key:generate
```

---

## 6️⃣ Rode as migrations

```bash
php artisan migrate
```

---

## 7️⃣ Inicie o servidor

```bash
php artisan serve
```

---

## 8️⃣ Rode o Vite

```bash
npm run dev
```

---

# 📸 Telas do Sistema

- Login
- Dashboard
- Categorias
- Músicas
- Repertórios

---

# 🔒 Controle de Permissões

O sistema possui controle de acesso utilizando Middleware:

- Usuário comum
- Administrador

Rotas administrativas são protegidas.

---

# 📈 Melhorias Futuras

- Upload de cifra
- Upload de PDF
- Busca dinâmica
- Filtro por tom
- Repertório por culto
- Tema escuro
- Exportação PDF
- API REST
- Aplicativo mobile Flutter

---

# 📚 Aprendizados no Projeto

Durante o desenvolvimento foram aplicados conceitos importantes como:

- Laravel Service Layer
- Form Requests
- Middleware
- Relacionamentos Eloquent
- Organização MVC
- Tailwind CSS
- Estruturação limpa de código

---

# 👨‍💻 Autor

Desenvolvido por Matheus Romão.

---

# 📄 Licença

Este projeto está sob a licença MIT.