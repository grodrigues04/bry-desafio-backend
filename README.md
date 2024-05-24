<h4>Desafio full stack para o processo seletivo Bry</h4>
Para o desafio, foi usado a versão 11.7.0 do framework Laravel
No projeto, as rotas são definidas em routes/api.php, que utilizam os métodos GET, POST, PATCH, DELETE.Cada rota, tem sua função e endpoint atribuido, que é manipulado pelos arquivos EmployeeController.php e CompanyController.php, que está Dentro da pasta API => app/Http/Controllers/Api.

Dentro de cada controller, temos a importação de seus Models para que as classes sejam usadas e seja possível interagir com o banco de dados usando modelos Eloquent no Laravel.

<h3>Melhorias para o projeto:</h4>

<h4>Backend:</h4> No backend, poderia ser implementado funções para validar numeros de CPF e CNPJ, para garantir que não exista nenhum dado repetido, e que as informações sejam verídicas. Além não foi feita a validação do campo login para textos com acentuação.

<h4>Nomes de Funções:</h4> Embora Os nomes das funções parecem estar intuitivos,seria mais apropriado a utilização verbos que descrevam sua lógica para manter boas práticas e padrões de código

<h4>Listagem:</h4>As funções para listar Employees e Companies poderiam ser paginadas, para otimizar a experiência do usuário, melhorar a performace e a vizualização.
