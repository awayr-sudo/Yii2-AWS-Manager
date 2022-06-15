Yii2 AWS Manager
====
Yii2 AWS Manager, An AWS Resource APIs based wrapper built as Yii2 component. An extension to the AWS SDK for PHP for interacting with AWS services using resource-oriented objects. 

## Support
The AWS Resource APIs currently supports 7 services (cloudformation, ec2, glacier, iam, s3, sns, sqs). 

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist awayr/aws-man "*"
```

or add

```
"awayr/aws-man": "*"
```

to the require section of your `composer.json` file.


## Usage

### 1. Configuration
Once the extension is installed,  locate main.php file and setup configurations below:
```php
'components' => [
	'aws' => [
		'class' => 'awayr\aws-man\Base',
		'key' => 'your_key',
		'secret' => 'your_secret',
		'region' => 'your_region',
		// optional config file
		//'configFile' => require_once('/path/to/aws.config.php'),
	]
]
```
after adding the configuration,  simply use it in your code by  :
```php
/* @var $aws awayr\aws-man\Base */
$aws = Yii::$app->aws;
$s3 = $aws->s3(['region' => 'eu-central-1']);
$bucket = $aws->s3->bucket('my-bucket');
$object = $bucket->object('image/bird.jpg');

```

