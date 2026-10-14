
---

# 📄 **Material Didático: Sistema de Login em PHP com `$_SESSION`**

> **Disciplina:** Linguagem e Técnicas de Programação    
> **Tema:** Variáveis de entrada e saída – Uso de sessões em PHP  
> **Professor:** José Carlos Flores  
> **Curso:** Engenharia de Software  
> **Objetivo:** Ensinar o uso de `$_SESSION` com separação de camadas (HTML, CSS, PHP)

---

## 🎯 Objetivo da Atividade

Ensinar como:
- Usar `$_SESSION` para manter dados do usuário
- Validar acesso a páginas protegidas
- Separar estilo (CSS) do conteúdo (HTML)
- Organizar arquivos em uma estrutura de pastas clara

---

## 🧩 Conceitos Abordados

| Conceito | Descrição |
|--------|---------|
| `session_start()` | Inicia ou retoma a sessão |
| `$_SESSION` | Armazena dados do usuário no servidor |
| `header('Location: ...')` | Redireciona para outra página |
| `session_destroy()` | Encerra a sessão |
| CSS externo | Boa prática de separação de camadas |
| Estrutura de pastas | Organização de projeto web |

---

## 📁 Estrutura do Projeto

```
sistema-login/
│
├── login.html     → Formulário de login
├── valida.php     → Valida login e inicia sessão
├── painel.php     → Página protegida
├── logout.php     → Encerra a sessão
└── css/
    └── estilo.css → Estilos compartilhados
```

> ✅ Todos os arquivos devem estar em:  
> `C:\xampp\htdocs\sistema-login\`

---

## ✅ 1. Arquivo CSS Externo: `css/estilo.css`

```css
/* estilo.css - Estilos para todo o sistema */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f0f2f5;
    line-height: 1.6;
}

.container {
    max-width: 400px;
    margin: 60px auto;
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.container.full {
    max-width: 500px;
}

h2 {
    margin-bottom: 20px;
    color: #333;
    font-size: 1.5em;
}

p {
    color: #555;
    margin-bottom: 20px;
}

label {
    display: block;
    text-align: left;
    margin: 10px 0 5px;
    font-weight: 600;
    color: #333;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
    transition: border-color 0.3s;
}

input[type="text"]:focus,
input[type="password"]:focus {
    border-color: #007cba;
    outline: none;
}

button {
    background: #007cba;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    width: 100%;
    transition: background 0.3s;
}

button:hover {
    background: #005a87;
}

a {
    color: #007cba;
    text-decoration: none;
    font-weight: 500;
}

a:hover {
    text-decoration: underline;
}

.logout {
    margin-top: 20px;
    font-size: 0.9em;
}

/* Cores específicas por página */
.container.login h2 {
    color: #1a5fb4;
}

.container.painel h2 {
    color: #2e7d32;
}

.container.error h2 {
    color: #c62828;
}
```

---

## ✅ 2. `login.html` – Formulário com CSS Externo

```html
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container login">
        <h2>🔐 Login</h2>
        <form action="valida.php" method="POST">
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
```

---

## ✅ 3. `valida.php` – Validação com Sessão

```php
<?php
// valida.php - Processa o login e inicia a sessão

session_start();

// Dados simulados (em produção: use banco de dados)
$usuario_correto = 'admin';
$senha_correta = '12345';

$usuario = $_POST['usuario'] ?? '';
$senha = $_POST['senha'] ?? '';

if ($usuario === $usuario_correto && $senha === $senha_correta) {
    // Armazena na sessão
    $_SESSION['logado'] = true;
    $_SESSION['usuario'] = $usuario;
    
    // Redireciona
    header('Location: painel.php');
    exit;
} else {
    // Página de erro com estilo
    echo "
    <!DOCTYPE html>
    <html lang='pt-BR'>
    <head>
        <meta charset='UTF-8'>
        <title>Erro</title>
        <link rel='stylesheet' href='css/estilo.css'>
    </head>
    <body>
        <div class='container error'>
            <h2>❌ Login inválido!</h2>
            <p>Usuário ou senha incorretos.</p>
            <a href='login.html'>Tentar novamente</a>
        </div>
    </body>
    </html>";
}
?>
```

---

## ✅ 4. `painel.php` – Página Protegida

```php
<?php
// painel.php - Página de boas-vindas

session_start();

// Protege a página
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: login.html');
    exit;
}

$usuario = htmlspecialchars($_SESSION['usuario'], ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container painel">
        <h2>✅ Bem-vindo, <?php echo $usuario; ?>!</h2>
        <p>Você está logado com sucesso no sistema.</p>
        
        <div class="logout">
            <a href="logout.php">Sair do sistema</a>
        </div>
    </div>
</body>
</html>
```

---

## ✅ 5. `logout.php` – Encerra a Sessão

```php
<?php
// logout.php - Encerra a sessão

session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Sair</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container">
        <h2>👋 Você saiu do sistema.</h2>
        <p>Sua sessão foi encerrada com segurança.</p>
        <a href="login.html">Fazer login novamente</a>
    </div>
</body>
</html>
```

---

## 🌐 Como testar

1. Crie a pasta: `C:\xampp\htdocs\sistema-login\`
2. Coloque todos os arquivos conforme a estrutura
3. Inicie o **Apache** no XAMPP
4. Acesse:  
   ```
   http://localhost/sistema-login/login.html
   ```
5. Faça login com:
   - **Usuário:** `admin`
   - **Senha:** `12345`

---

## 🧠 Atividades para os alunos

1. **Modifique o CSS** para um tema escuro.
2. Adicione um campo **"nível de acesso"** na sessão e mostre mensagens diferentes.
3. Crie uma página `perfil.php` acessível apenas pelo `admin`.
4. Armazene a data do login na sessão e exiba no painel.

---

## 📝 Boas práticas ensinadas

| Prática | Benefício |
|-------|----------|
| CSS externo | Reutilização, manutenção |
| `session_start()` no início | Evita erros |
| `htmlspecialchars()` | Prevenção contra XSS |
| `exit` após `header()` | Segurança |
| Estrutura de pastas | Organização profissional |

---

## 🔗 Recursos Complementares

- [PHP: Sessões – Manual Oficial](https://www.php.net/manual/pt_BR/book.session.php)
- [XAMPP – Baixe aqui](https://www.apachefriends.org)
- [CSS Básico – W3Schools](https://www.w3schools.com/css/)

---

## 📎 Créditos

Material elaborado por:  
**Prof. José Carlos Flores**  
Disciplina: Linguagem e Técnicas de Programação  
Instituição: Unicesumar  
Ano: 2025

---

## Respostas do Questionário

### Parte 1 — Questões objetivas

1. Qual é a finalidade da função session_start()?
B) Iniciar ou retomar uma sessão.

2. Onde os dados de $_SESSION são armazenados?
C) No servidor web.

3. Qual arquivo é responsável por validar o login no sistema?
D) valida.php.

4. Qual método HTTP é usado no formulário de login?
D) POST.

5. Por que usamos header('Location: painel.php')?
B) Para redirecionar o usuário.

6. O que acontece se session_start() for chamado após saída para o navegador?
B) Um erro de cabeçalho (headers already sent) ocorre.

7. Qual superglobal armazena dados entre páginas com sessão?
D) $_SESSION.

8. Como impedimos o acesso direto a painel.php por usuários não logados?
B) Verificando $_SESSION['logado'].

9. Qual é o caminho correto para o arquivo CSS no sistema?
A) css/estilo.css.

10. O que faz session_destroy()?
A) Apaga todos os dados da sessão.

11. Por que usamos htmlspecialchars() ao exibir o nome do usuário?
B) Para prevenir ataques XSS.

12. Qual tag HTML vincula um arquivo CSS externo?
C) <link>.

13. O que significa HTTP 405?
B) Método não permitido.

14. Onde devem estar os arquivos PHP para funcionar com XAMPP?
B) Em C:\xampp\htdocs\.

15. Qual é a finalidade do exit; após header('Location: ...')?
B) Evitar execução de código posterior.

16. O que é $_POST['usuario'] ?? ''?
C) Um operador de coalescência nula.

17. Qual é o valor de $_SESSION['logado'] após login bem-sucedido?
C) true.

18. Qual arquivo não contém código PHP?
C) login.html.

19. O que acontece ao acessar logout.php?
B) A sessão é destruída e o usuário sai.

20. Qual é a porta padrão do Apache no XAMPP?
D) 80.

### Parte 2 — Questões discursivas

21. Explique por que $_SESSION é mais seguro que $_COOKIE para armazenar dados de login.
Os dados associados à sessão ficam armazenados no servidor; o navegador guarda normalmente apenas o identificador da sessão. Com cookies, os valores são armazenados no navegador do usuário e ficam mais expostos a leitura ou alteração no cliente.

22. Por que não devemos usar $_REQUEST em vez de $_POST ou $_GET em formulários?
$_REQUEST pode reunir valores de diferentes fontes, como GET, POST e cookies, deixando menos claro de onde veio cada dado. $_POST e $_GET identificam o método esperado pelo formulário; neste sistema, o formulário envia os dados por POST.

23. O que é separação de camadas e como ela foi aplicada neste sistema?
É separar as responsabilidades do projeto. login.html apresenta o formulário, css/estilo.css define a aparência e os arquivos PHP validam o login, controlam a sessão, mostram o painel e encerram a sessão.

24. Qual é a diferença entre echo e print em PHP?
Ambos exibem conteúdo. print retorna o valor 1 e recebe um argumento; echo não retorna valor e pode receber mais de um argumento.

25. Por que o arquivo estilo.css está em uma pasta separada chamada css?
Para organizar o projeto e manter os estilos separados da estrutura HTML e da lógica PHP. O mesmo CSS pode ser compartilhado pelas páginas do sistema.

26. Como você modificaria o sistema para aceitar dois usuários: admin e usuario?
O valida.php atual aceita apenas admin com a senha 12345. Para aceitar também usuario, eu alteraria a validação para conferir os dois nomes e suas respectivas senhas, por exemplo, usando uma lista de usuários permitidos, e só então iniciaria a sessão para a conta correspondente.

27. Explique o papel do header('Location: ...') no fluxo do sistema.
Ele envia uma resposta de redirecionamento ao navegador. Após um login correto, o valida.php redireciona para painel.php; se alguém sem sessão tentar abrir o painel, painel.php redireciona para login.html.

28. Por que é importante usar session_start() em todas as páginas que usam $_SESSION?
Porque a função inicia ou recupera a sessão e disponibiliza seus dados em $_SESSION. Ela deve ser chamada antes de qualquer saída para o navegador.

29. Cite duas boas práticas de segurança usadas neste sistema.
O painel verifica $_SESSION['logado'] antes de exibir conteúdo protegido, e htmlspecialchars() escapa o nome do usuário exibido para ajudar a prevenir XSS. O sistema também usa exit após os redirecionamentos.

30. Proponha uma melhoria para o sistema.
Uma melhoria seria permitir que o usuário alterasse sua senha diretamente pelo sistema.
