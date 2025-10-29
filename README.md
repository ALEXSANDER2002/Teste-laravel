# Instruções Simples - simpleshotel

## Pré-requisitos
- PHP 8.2+ instalado
- SQLite habilitado no PHP

## Como Rodar

### 1. Instalar Dependências
```bash
composer install
```

### 2. Configurar Banco de Dados
Já está configurado para usar SQLite (arquivo `database/database.sqlite`)

### 3. Criar Tabelas
```bash
php artisan migrate
```

### 4. Iniciar Servidor
```bash
php artisan serve
```

### 5. Acessar
Abra o navegador em: **http://localhost:8000**

---

## Comandos Úteis

### Limpar Cache
```bash
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

### Recriar Banco de Dados
```bash
php artisan migrate:fresh
```

### Ver Informações
```bash
php artisan about
```

---

## Primeiro Acesso
1. Clique em "Registrar"
2. Crie sua conta
3. Faça login
4. Comece a usar!
