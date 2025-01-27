# Teste prático - Desenvolvedor Donald

## **Requisitos do Sistema**

- **PHP**: versão 8.1 ou superior  
- **Composer**: 2.x  
- **Node.js**: versão 16.x ou superior  
- **NPM** ou **Yarn**  
- **MySQL** ou outro banco de dados compatível  
- **Git**   

---

## **Como Rodar o Projeto**

### Backend

#### 1. Clone o Repositório do Backend

```bash
git clone https://github.com/seu-usuario/seu-projeto-backend.git
cd seu-projeto-backend
```

#### 2. Instale as Dependências do Backend

```bash
composer install
```

#### 3. Configure o Ambiente do Backend
Crie o arquivo .env a partir do exemplo .env.example:

```bash
cp .env.example .env
```

Edite o arquivo .env e configure as seguintes variáveis para conectar ao banco de dados:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

#### 4. Gere a Chave da Aplicação

```bash
php artisan key:generate
```

#### 5. Configure o Banco de Dados

```bash
php artisan migrate
```

#### 6. Inicie o Servidor

```bash
php artisan serve
```

O servidor estará acessível em [http://localhost:8000](http://localhost:8000).

---

#### 7. Instale as Dependências do Frontend

```bash
npm install
```

#### 3. Compile os Arquivos Frontend

```bash
npm run dev
```
