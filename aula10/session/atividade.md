# Atividade — Sistema de login com sessões em PHP

## Parte 1 — Questões objetivas

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

## Parte 2 — Questões discursivas

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
