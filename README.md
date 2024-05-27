<h1>Desafio full stack para o processo seletivo Bry</h1>

Para o desafio, foi usado a versão 11.7.0 do framework Laravel.
No projeto, as rotas são definidas em routes/api.php, que utilizam os métodos GET, POST, PATCH, DELETE. Cada rota, tem sua função e endpoint atribuido, que é manipulado pelos arquivos EmployeeController.php e CompanyController.php, localizado dentro da pasta API app/Http/Controllers/Api.
Dentro de cada controller, temos a importação de seus Models para que as classes sejam usadas e seja possível interagir com o banco de dados usando modelos Eloquent no Laravel.

<h3>Melhorias para o projeto:</h4>

<h4>Backend:</h4> Poderia ser implementado funções para validar números de CPF e CNPJ, para garantir que não exista nenhum dado repetido, e que as informações sejam verídicas. Além disso, deveria ter sido feita a validação do campo login para textos com acentuação.

<h4>Nomes de Funções:</h4> Embora os nomes das funções parecem estar intuitivos, seria mais apropriado utilizar verbos que descrevam sua lógica para manter boas práticas e padrões de código.

<h4>Listagem:</h4>As funções para listar Employees e Companies poderiam ser paginadas, para otimizar a experiência do usuário, melhorar a performace e a vizualização.

<h4>Docker:</h4> A imagem Docker não foi criada devido à falta de conhecimento técnico necessário para o processo. Embora possua amigos capazes de auxiliar, optei por não prosseguir, pois exigiria um nível de habilidade que atualmente não possuo. Além disso, essa lacuna técnica poderia me prejudicar em uma eventual entrevista sobre o projeto, pois não seria capaz de explicar com propriedade o procedimento realizado.
