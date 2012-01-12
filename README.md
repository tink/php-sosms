# php-sosms

php-sosms é uma biblioteca PHP para acessar os serviços de envio de mensagens em massa do [SoSMS](http://sosms.com.br) da [tink!](http://tink.com.br).
O SoSMS permite que você mande mensagens SMS para vários destinatários ao mesmo tempo, permitindo você saber o status de cada mensagem enviada com detalhes.

## Utilização
Para usar a biblioteca você deverá copiar o projeto php-sosms dentro de sua aplicação PHP e importar as classes conforme o exemplo abaixo:

```php
	<?php
		require_once 'php-sosms/src/SoSMS/Client.php';
		require_once 'php-sosms/src/SoSMS/Configuration.php';
	?>
```

Após importar as classe como mostrado acima você deverá configurar a biblioteca adicionando sua chave secreta para o SoSMS, conforme o exemplo abaixo:

```php
	<?php
		require_once 'php-sosms/src/SoSMS/Client.php';
		require_once 'php-sosms/src/SoSMS/Configuration.php';

		$config = new SoSMS\Configuration('123456');
		$client = new SoSMS\Client($config);
	?>
```

Para resgatar o seu código de segurança [acesse sua conta](http://sosms.com.br/usuarios/acessar) e verifique sua chave secreta na página da [documentação](http://sosms.com.br/pagina/documentacao#chave).

Para que você possa enviar suas mensagens é necessário que você confirme o número de celular informado no momento do cadastro. Para mais detalhes acesse a [documentação](http://sosms.com.br/pagina/documentacao#ativacao).

## Funcionalidades

### Enviando uma mensagem

O SoSMS permite o envio de uma mesma mensagem para vários destinatários ao mesmo tempo.

Para isto você deverá utilizar o método sendMessage da classe SoSMS\Client conforme o exemplo abaixo:

```php
	<?php
		$message = $client->sendMessage("Bem Vindo!", "Maria:1187965545,Luana:8189965474,Francisco:8388496535");
	?>
```

O primeiro parâmetro é o texto da mensagem a ser enviado. Este deve conter no máximo 140 caracteres. Já o segundo parâmetro é um array de strings contendo os dados dos destinatários.
Cada destinatário deve possuir um nome e um número de telefone que devem ser separados pelo caractere de dois pontos (:).
Os números de telefone deverão possuir DDD e o número, totalizando 10 caracteres.
Caso haja mais de um destinatário, os mesmos devem ser separados por vírgula (,).

No exemplo acima será enviada uma mensagem com o texto "Bem Vindo!" para três destinatários:

 - Maria - (11) 8796-5545
 - Luana - (81) 8996-5474
 - Francisco - (83) 8879-6535

Este método retorna um objeto do tipo SoSMS\Message que possui as seguintes características:

```php
	<?php
		$message->id // O identificador da mensagem
		$message->text // A mensagem enviada aos destinatários
		$message->dispaches // Uma lista com os envios para cada destinatário, do tipo SoSMSMessageDispach
	?>
```

Cada dispach (SoSMS\MessageDispach) possui as seguintes características:

```php
	<?php
		foreach($message->dispaches as $messageDispach) {
			$messageDispach->phoneNumber // O número do telefone do destinatário no formato "(99) 9999-9999"
			$messageDispach->status // O status da entrega da mensagem para o destinatário
		}
	?>
```

Para mais informações sobre os possíveis status de retorno verifique a [documentação](http://sosms.com.br/pagina/documentacao#resposta).

### Resgatando o status de uma mensagem

```php
	<?php
		$message = $client->getMessage(1002);
	?>
```

Este método retorna um objeto do tipo SoSMS\Message descrito acima.

### Saldo da conta

Para saber qual o saldo atual da sua conta você pode usar o seguinte código:

```php
	<?php
		$client->getBalance().value;
	?>
```

Este código retorna um valor inteiro com o saldo atual da sua conta.

## Exceções

Caso o serviço do SoSMS retorne alguma mensagem de erro será lançada uma exceção do tipo SoSMS\Exception, conforme o exemplo abaixo:

```php
	<?php
		require_once 'php-sosms/src/SoSMS/Client.php';
		require_once 'php-sosms/src/SoSMS/Configuration.php';

		$config = new SoSMS\Configuration('Chave não existente');
		$client = new SoSMS\Client($config);

		try {
			$client->getBalance(); // Vai lançar um erro pois a chave secreta não é válida
		} catch(SoSMS\Exception $ex) {
			echo $ex->getMessage();
		}
	?>
```

## Documentação oficial
Toda a documentação da API pode ser encontrada no site do [SoSMS](http://sosms.com.br/pagina/documentacao).

## Créditos
Parte da implementação desta biblioteca foi baseada no projeto [php-airbrake](https://github.com/nodrew/php-airbrake) mantido por [Drew Butler](https://github.com/nodrew).
