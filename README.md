## API COM LARAVEL 8
<p>
Esta Api possui os seguintes metodos GET, POST, PUT, DELETE, todos implementados no padr�o REST</p>

## TECNOLOGIAS UTILIZADAS<br>
### No Ambiente de Desenvolvimento<br>
<p><ul>
    <li>
    Foi utilizado o Laradocker para subir o ambiente de desenvolvimento Mysql, NGINX, PHPFPM</li>
    <li>IDE  VS Code</li>
    <li>Docker ver 20 </li>
    <li>Para Testes foi utilizado PhpUnit </li>
    <li>PHP ver 7.4</li>
    </ul>
</p>

## INSTALA��O<br>
### Instalando Lara docker<br>
<p>
<ul>
    
<li>
Crie uma pasta e acesse a mesma
</li>
<li>
git clone https://github.com/Laradock/laradock.git laradock
</li>
<li>
cd laradock 
</li>
<li>Crie um arquivo env, neste arquivo voc� deve colocar variaveis de ambiento dos container<br> cp env-example .env</li>
<li>docker-compose up -d nginx mysql</li>
<li>
<p>
E para alterar os dados de senha do MySql:<br>
MYSQL_DATABASE=Nome do database padr�o que ser� criado na primeira vez que rodar<br>
MYSQL_USER=Nome do usu�rio padr�o<br>
MYSQL_PASSWORD=Senha do usu�rio<br>
MYSQL_PORT=Porta que vai rodar<br>
MYSQL_ROOT_PASSWORD=Senha do usu�rio root</p>
</li>
</ul>
</p>

### Subindo projeto no ambiente de desenvolvimento<br>

<p>
<ol>
<li>
Ap�s fianizar instala��o do laradocker teremos a seguinte estrutura de pasta<br>
\meu_projeto\laradocker<br>
dentro da pasta "meu_projeto\" clonamos o nosso projeto

</li>
<li>Execute o git clone https://github.com/AdalgisioAlves/api_laravel.git</li>
<li>
Teremos agora: <br>
meu_projeto\<br>
&nbsp;&nbsp;&nbsp; ->\laradocker<br>
&nbsp;&nbsp;&nbsp; ->\api_laravel                         
</li>
<li>Agora precisamos configurar o Ngix para apontar para pasta "www\api_laravel\public"</li>
<li>Edite o arquivo meu_projeto\laradock\nginx\sites\default.conf</li>
<li>
Altere a linha  "root /var/www/" para "root /var/www/api_laravel/public;"<br>
O laradocker j� faz o mapeamento da pasta que est� abaixo da "laradocker"
</li>
<li>
 Rode o comando "composer install", dentro da pasta  "api_laravel", este comando vai instalar todas as dependencias do projeto.
  rode o comando docker-compose restart para reiniciar
</li>
<li>
Ent�o � s� reniciar que a api poder� ser acessada no http://localhost/api
</li>
</ol>
</p>

